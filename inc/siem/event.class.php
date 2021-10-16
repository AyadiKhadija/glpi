<?php

namespace Glpi\Siem;

use CommonDBTM;
use CommonGLPI;
use CommonITILActor;
use CommonITILObject;
use CronTask;
use DBmysqlIterator;
use Dropdown;
use Glpi\Application\View\TemplateRenderer;
use Html;
use mysqli_result;
use Plugin;
use QueryExpression;
use Toolbox;

class Event extends CommonDBTM {

   /**
    * An event that doesn't require any response
    */
   public const INFORMATION = 0;

   /**
    * An event that indicates a potential issue that requires monitoring or preventative measures.
    */
   public const WARNING = 1;

   /**
    * An event that indicates an issue and requires a response.
    */
   public const EXCEPTION = 2;

   public static function getTypeName($nb = 0): string {
      return _n('Event', 'Events', $nb);
   }

   public function getTabNameForItem(CommonGLPI $item, $withtemplate = 0) {
      if (!$withtemplate) {
         $nb = 0;
         switch ($item->getType()) {
            case self::class :
               return '';
            default:
               return self::createTabEntry('Event Management');
         }
      }
      return '';
   }

   public static function displayTabContentForItem(CommonGLPI $item, $tabnum = 1, $withtemplate = 0): bool {
      switch ($item->getType()) {
         case self::class :
            //self::showForSIEMEvent($item);
            break;
         default:
            self::showEventManagementTab($item);
            break;
      }
      return true;
   }

   public function prepareInputForAdd($input) {
      $input = parent::prepareInputForAdd($input);
      // All events must be associated to a service or have a service id of -1 for internal
      $service_fk = Service::getForeignKeyField();
      if (!isset($input[$service_fk]) && $input[$service_fk] !== -1) {
         return false;
      }
      if (isset($input['_sensor_fault'])) {
         $input['significance'] = self::EXCEPTION;
         $input['name'] = 'sensor_fault';
      }
      if (isset($input['content']) && !is_string($input['content'])) {
         $input['content'] = json_encode($input['content']);
      }
      if (!isset($input['significance']) || $input['significance'] < 0 || $input['significance'] > 2) {
         $input['significance'] = self::INFORMATION;
      }

      return $input;
   }

   public function post_addItem(): void {
      if (!isset($this->input['correlation_id']) && !isset($this->fields['correlation_id'])) {
         // Create a new correlation ID in case one isn't assigned by the correlation engine
         $this->fields['correlation_id'] = uniqid('', true);
      }
      $this->update([
         'id' => $this->getID(),
         'correlation_id' => $this->fields['correlation_id']
      ]);

      // Update the related service
      Service::onEventAdd($this);

      parent::post_addItem();
   }

   public function cleanDBonPurge(): void {
      $this->deleteChildrenAndRelationsFromDb(
         [
            Itil_Event::class
         ]
      );
      parent::cleanDBonPurge();
   }

   /**
    * Gets the name of a significance level from the int value
    *
    * @param int $significance The significance level
    *
    * @return string The significance level name
    * @since 10.0.0
    *
    */
   public static function getSignificanceName($significance): string {
      switch ($significance) {
         case 1:
            return __('Warning');
         case 2:
            return __('Exception');
         case 0:
         default:
            return __('Information');
      }
   }

   /**
    * Displays or gets a dropdown menu of significance levels.
    * The default functionality is to display the dropdown.
    *
    * @param array $options Dropdown options
    *
    * @return string
    * @since 10.0.0
    *
    * @see Dropdown::showFromArray()
    */
   public static function dropdownSignificance(array $options = []): string {
      $p = [
         'name' => 'significance',
         'value' => 0,
         'showtype' => 'normal',
         'display' => true,
      ];
      if (is_array($options) && count($options)) {
         foreach ($options as $key => $val) {
            $p[$key] = $val;
         }
      }
      $values = [];
      $values[0] = self::getSignificanceName(0);
      $values[1] = self::getSignificanceName(1);
      $values[2] = self::getSignificanceName(2);
      return Dropdown::showFromArray($p['name'], $values, $p);
   }

   public static function getEventsForHostOrService($items_id, $is_service = true, $params = []): array {
      global $DB;
      $p = [
         'start' => 0,
         'limit' => -1
      ];
      $p = array_replace($p, $params);
      $events = [];
      $service_table = Service::getTable();
      $service_fk = Service::getForeignKeyField();
      $host_table = Host::getTable();
      $host_fk = Host::getForeignKeyField();
      $event_table = self::getTable();
      $criteria = [
         'SELECT' => [
            "{$event_table}.*",
         ],
         'FROM' => $event_table,
         'LEFT JOIN' => [
            $service_table => [
               'FKEY' => [
                  $service_table => 'id',
                  $event_table => $service_fk
               ]
            ]
         ],
         'ORDERBY' => ['date DESC']
      ];
      if ($p['start'] > 0) {
         $criteria['START'] = $p['start'];
      }
      if ($p['limit'] > 1) {
         $criteria['LIMIT'] = $p['limit'];
      }
      if ($is_service) {
         $criteria['WHERE'] = [
            $service_fk => $items_id
         ];
      } else {
         $criteria['SELECT'][] = "{$service_table}.{$host_fk}";
         $criteria['WHERE'] = [
            $host_fk => $items_id
         ];
         $criteria['LEFT JOIN'][$host_table] = [
            'FKEY' => [
               $host_table => 'id',
               $service_table => $host_fk
            ]
         ];
      }
      $iterator = $DB->request($criteria);
      foreach ($iterator as $data) {
         $events[] = $data;
      }
      return $events;
   }

   /**
    * Gets all events with the same correlation UUID as this event
    *
    * @param bool $exclusive True if the results should not include this event
    * @return DBmysqlIterator
    * @since 10.0.0
    *
    */
   public function getCorrelated(bool $exclusive = true): DBmysqlIterator {
      global $DB;
      $query = [
         'FROM' => self::getTable(),
         'WHERE' => [
            'correlation_id' => $this->fields['correlation_id']
         ]
      ];
      if ($exclusive) {
         $query['WHERE'][] = [
            'NOT' => ['id' => $this->getID()]
         ];
      }
      return $DB->request($query);
   }

   /**
    * Update all events with the same correlation UUID
    *
    * @param array $params Query parameters ([:field name => field value)
    * @param array $where WHERE clause
    * @param bool $exclusive True if this event should also be updated
    * @return mysqli_result|boolean
    * @since 10.0.0
    *
    */
   public function updateCorrelated($params, $where = [], $exclusive = true) {
      global $DB;
      $where = [
            'NOT' => [
               'id' => $this->getID()
            ],
            'correlation_id' => $this->fields['correlation_id']
         ] + $where;
      if ($exclusive) {
         $where[] = [
            'NOT' => ['id' => $this->getID()]
         ];
      }
      return $DB->update(self::getTable(), $params, $where);
   }

   /**
    * Gets the translated event name from the event's logger ID (GLPI or plugin)
    *
    * @param string $name The unlocalized event name
    * @param string $plugins_id The plugin that created the event or null if made by GLPI
    * @return string The localized name if possible, otherwise the unlocalized name is returned
    * @since 10.0.0
    *
    */
   public static function getLocalizedEventName(string $name, string $plugins_id): string {
      if ($name === 'sensor_fault') {
         return __('Sensor fault', 'siem');
      }
      if ($plugins_id !== null && isset(Plugin::getPlugins()[$plugins_id])) {
         $plugin_name = Plugin::getPlugins()[$plugins_id];
         return Plugin::doOneHook($plugin_name, 'translateEventName', $name);
      }
      return $name;
   }

   /**
    * Get an associative array of event properties from the content JSON field
    *
    * @param $content
    * @param $plugins_id
    * @param array $params
    * @return array|string Associative array or HTML display of event properties
    * @since 10.0.0
    */
   public static function getEventProperties($content, $plugins_id, array $params = []) {
      $p = [
         'translate' => true,
         'format' => 'array'
      ];
      $p = array_replace($p, $params);
      if (!in_array($p['format'], ['array', 'pretty', 'plain'])) {
         $p['format'] = 'array';
      }
      if ($content !== null) {
         $properties = json_decode($content, true);
      } else {
         return '';
      }
      if ($properties === null) {
         return '';
      }
      $props = [];
      foreach ($properties as $key => $value) {
         $props[$key] = [
            'name' => $key, // Potentially localized property name
            'value' => $value // Property value
         ];
      }
      if ($p['translate']) {
         if ($plugins_id !== null && isset(Plugin::getPlugins()[$plugins_id])) {
            $plugin_name = Plugin::getPlugins()[$plugins_id];
            $props_t = Plugin::doOneHook($plugin_name, 'translateEventProperties', $props);
            if ($props_t) {
               $props = $props_t;
            }
         } else {
            //Glpi\Event::translateEventProperties($props);
         }
      }
      if ($p['format'] === 'array') {
         return $props;
      } else {
         $text_content = '';
         foreach ($props as $event_property) {
            $propname = strip_tags($event_property['name']);
            $propvalue = strip_tags($event_property['value']);
            if ($p['format'] === 'pretty') {
               $text_content .= "<b>{$propname}</b>: {$propvalue}<br>";
            } else {
               $text_content .= "{$propname}: {$propvalue}<br>";
            }
         }
         return $text_content;
      }
   }

   public static function getVisibilityCriteria(): array {
      $service_table = Service::getTable();
      $service_fk = Service::getForeignKeyField();
      $servicetemplate_table = ServiceTemplate::getTable();
      $servicetemplate_fk = ServiceTemplate::getForeignKeyField();
      $event_table = self::getTable();
      return [
         'LEFT JOIN' => [
            $service_table => [
               $service_table => 'id',
               $event_table => $service_fk
            ],
            $servicetemplate_table => [
               $servicetemplate_table => 'id',
               $service_table => $servicetemplate_fk
            ]
         ]
      ];
   }

   /**
    * Create a ticket, change, or problem from this event
    *
    * @param string $tracking_type The tracking class (Ticket, Change, or Problem)
    * @return boolean True if the tracking was created successfully
    * @since 10.0.0
    *
    */
   public function createTracking(string $tracking_type): bool {
      global $DB;
      if (is_subclass_of($tracking_type, CommonITILObject::class)) {
         $tracking = new $tracking_type();
         $content = self::getEventProperties($this->fields['content'], $this->fields['plugins_id'], [
            'format' => 'plain'
         ]);
         $tracking_id = $tracking->add([
            'name' => $this->fields['name'],
            'content' => $content,
            '_correlation_id' => $this->fields['correlation_id']
         ]);
         if (!$tracking_id) {
            return false;
         } else {
            // Add related items if they exist
            if ($tracking_type === 'Change') {
               $items_tracking = 'glpi_items_changes';
            } else if ($tracking_type === 'Problem') {
               $items_tracking = 'glpi_items_problems';
            } else {
               $items_tracking = 'glpi_items_tickets';
            }

            $iterator = $DB->request([
                  'SELECT' => ['itemtype', 'items_id'],
                  'FROM' => Host::getTable(),
                  'WHERE' => [
                     'siem_events_id_availability' => $this->getID()
                  ]
               ] + self::getVisibilityCriteria());
            $actors_responsible = ['user' => [], 'group' => []];
            foreach ($iterator as $data) {
               $DB->insert($items_tracking, [
                  'itemtype' => $data['itemtype'],
                  'items_id' => $data['items_id'],
                  $tracking::getForeignKeyField() => $tracking_id
               ]);
               // Get responsible tech and group
               $actors = $DB->request([
                  'SELECT' => ['users_id_tech', 'groups_id_tech'],
                  'FROM' => $data['itemtype']::getTable(),
                  'WHERE' => ['id' => $data['items_id']]
               ])->current();
               if ($actors['users_id_tech'] !== null) {
                  $actors_responsible['user'][] = $actors['users_id_tech'];
               }
               if ($actors['groups_id_tech'] !== null) {
                  $actors_responsible['group'][] = $actors['groups_id_tech'];
               }
            }
            // Assign responsible actors
            // TODO Respect Entity assignment settings?
            $tracking_user = new $tracking->userlinkclass();
            $tracking_group = new $tracking->grouplinkclass();
            foreach ($actors_responsible as $type => $actor_id) {
               if ($type === 'user') {
                  $tracking_user->add([
                     'type' => CommonITILActor::ASSIGN,
                     'users_id' => $actor_id[0],
                     $tracking::getForeignKeyField() => $tracking_id
                  ]);
               } else if ($type === 'group') {
                  $tracking_group->add([
                     'type' => CommonITILActor::ASSIGN,
                     'groups_id' => $actor_id[0],
                     $tracking::getForeignKeyField() => $tracking_id
                  ]);
               }
            }
            $itil_siemevent = new Itil_Event();
            $itil_siemevent->add([
               'itemtype' => $tracking_type,
               'items_id' => $tracking_id,
               'plugin_siem_events_id' => $this->getID()
            ]);
         }
      } else {
         Toolbox::logError(__('Tracking type must be a subclass of CommonITILObject'));
         return false;
      }
      return true;
   }

   public function rawSearchOptions(): array {
      $tab = [];
      $tab[] = [
         'id' => 'common',
         'name' => __('Characteristics')
      ];
      $tab[] = [
         'id' => '1',
         'table' => self::getTable(),
         'field' => 'name',
         'name' => __('Name'),
         'datatype' => 'itemlink',
         'massiveaction' => false
      ];
      $tab[] = [
         'id' => '2',
         'table' => self::getTable(),
         'field' => 'id',
         'name' => __('ID'),
         'massiveaction' => false,
         'datatype' => 'number'
      ];
      $tab[] = [
         'id' => '3',
         'table' => self::getTable(),
         'field' => 'significance',
         'name' => __('Significance'),
         'datatype' => 'specific',
      ];
      $tab[] = [
         'id' => '4',
         'table' => self::getTable(),
         'field' => 'correlation_id',
         'name' => __('Correlation ID'),
         'datatype' => 'string',
      ];
      $tab[] = [
         'id' => '5',
         'table' => self::getTable(),
         'field' => 'plugins_id',
         'name' => __('Plugin'),
         'datatype' => 'string',
      ];
      $tab[] = [
         'id' => '16',
         'table' => self::getTable(),
         'field' => 'content',
         'name' => __('Content'),
         'datatype' => 'text'
      ];
      $tab[] = [
         'id' => '19',
         'table' => self::getTable(),
         'field' => 'date_mod',
         'name' => __('Last update'),
         'datatype' => 'datetime',
         'massiveaction' => false
      ];
      $tab[] = [
         'id' => '80',
         'table' => 'glpi_entities',
         'field' => 'completename',
         'name' => __('Entity'),
         'massiveaction' => false,
         'datatype' => 'dropdown'
      ];
      $tab[] = [
         'id' => '86',
         'table' => self::getTable(),
         'field' => 'is_recursive',
         'name' => __('Child entities'),
         'datatype' => 'bool'
      ];
      $tab[] = [
         'id' => '121',
         'table' => self::getTable(),
         'field' => 'date_creation',
         'name' => __('Creation date'),
         'datatype' => 'datetime',
         'massiveaction' => false
      ];
      return $tab;
   }

   public static function showEventManagementTab(CommonDBTM $item): void {
      $eventhost = new Host();
      $eventservice = new Service();
      $matchinghosts = $eventhost->find(['items_id' => $item->getID(), 'itemtype' => $item::getType()], [], 1);
      $has_host = (count($matchinghosts) === 1);

      if (!$has_host) {
         $has_services = false;
      } else {
         $matchinghost = reset($matchinghosts);
         $eventhost->getFromDB($matchinghost['id']);
         $matchingservices = $eventservice->find([Host::getForeignKeyField() => $eventhost->getID()]);
         $has_services = (count($matchingservices) > 0);
      }
      if (!$has_host && !$has_services) {
         echo "<div class='alert alert-warning'>" . __('This host is not monitored by any plugin') . '</div>';
         Html::showSimpleForm(Host::getFormURL(),
            'add', __('Enable monitoring'),
            ['itemtype' => $item->getType(),
             'items_id' => $item->getID()]);
         return;
      } else if (!$has_services) {
         echo "<div class='alert alert-warning'>" . __('No services on this host are monitored by any plugin') . '</div>';
      } else if (!$eventhost->getAvailabilityService()) {
         echo "<div class='alert alert-warning'>" . __('No host availability service set') . '</div>';
      }
      $out = $eventhost->getHostInfoDisplay();
      $out .= Service::getFormForHost($eventhost);
      $out .= self::getListForHostOrService($eventhost->getID(), false);
      echo $out;
   }

   public static function getListForHostOrService($items_id, $is_service = true, $params = []): string {
      $p = [
         'start' => 0
      ];
      $p = array_replace($p, $params);

      $events = self::getEventsForHostOrService($items_id, $is_service, [
         'start' => $p['start'],
         'limit' => $_SESSION['glpilist_limit']
      ]);

      $temp_service = new Service();
      foreach ($events as &$event) {
         $temp_service->getFromDB($event[Service::getForeignKeyField()]);

         $icon = 'fas fa-info-circle';
         $event_class = 'tab_bg_2 ';
         if ($event['significance'] === self::WARNING) {
            $event_class .= 'bg-warning ';
            $icon = 'fas fa-exclamation-triangle';
         } else if ($event['significance'] === self::EXCEPTION) {
            $event_class .= 'bg-danger ';
            $icon = 'fas fa-exclamation-circle';
         }
         // Replace some event properties with the translated and formatted versions
         $event['name'] = self::getLocalizedEventName($event['name'], $temp_service->fields['plugins_id']);
         $event['css_class'] = $event_class;
         $event['icon'] = $icon;
         $event['significance'] = self::getSignificanceName($event['significance']);
         $event['content'] = self::getEventProperties($event['content'], $temp_service->fields['plugins_id'], [
            'format' => 'pretty'
         ]);
      }

      return TemplateRenderer::getInstance()->render('components/siem/events_historical.html.twig', [
         'ajax_pages'   => Html::printAjaxPager('', $p['start'], count($events), '', false),
         'events'       => $events
      ]);
   }

   /**
    * Checks for any active or hybrid services that are due to check for events.
    * Then, signals the service's logger to poll for the events.
    * @param CronTask $task
    * @return int
    * @since 10.0.0
    */
   public static function cronPollEvents(CronTask $task): int {
      global $DB;
      $event = new self();
      $service_table = Service::getTable();
      $to_poll = $DB->request([
         'SELECT' => ["{$service_table}.id", 'plugins_id', 'sensor'],
         'FROM' => $service_table,
         'LEFT JOIN' => [
            ServiceTemplate::getTable() => [
               'FKEY' => [
                  $service_table => ServiceTemplate::getForeignKeyField(),
                  ServiceTemplate::getTable() => 'id',
               ]
            ]
         ],
         'WHERE' => [
            'OR' => [
               'last_check'   => null,
               new QueryExpression('DATE_ADD(last_check, INTERVAL check_interval MINUTE) <= NOW()'),
            ],
            'check_mode' => [Service::CHECK_MODE_ACTIVE, Service::CHECK_MODE_HYBRID],
            'is_active' => 1,
            new QueryExpression('plugins_id IS NOT NULL'),
            new QueryExpression('sensor IS NOT NULL'),
         ]
      ]);
      $eventdatas = [];
      $allservices = [];
      $poll_queue = [];
      foreach ($to_poll as $data) {
         $allservices[] = $data['id'];
         $poll_queue[$data['plugins_id']][$data['sensor']][] = $data['id'];
      }
      $plugin = new Plugin();
      foreach ($poll_queue as $logger => $sensors) {
         $plugin->getFromDB($logger);
         foreach ($sensors as $sensor => $service_ids) {
            $results = Plugin::doOneHook($plugin->fields['directory'], 'poll_sensor', ['sensor' => $sensor, 'service_ids' => $service_ids]);
            $eventdatas[$plugin->fields['directory']][$sensor] = $results;
         }
      }

      $service_fk = Service::getForeignKeyField();

      // Array of service ids that had some data from the sensors
      $reported = [];
      // Create event from the results
      foreach ($eventdatas as $logger => $sensors) {
         foreach ($sensors as $sensor => $results) {
            if ($results !== null && is_array($results)) {
               foreach ($results as $service_id => $result) {
                  if ($result !== null && is_array($result)) {
                     $input = $result;
                     $input[$service_fk] = $service_id;
                     $event->add($input);
                     $reported[] = $service_id;
                  }
               }
            }
         }
      }
      // Report sensor fault for all services that had no data
      $faulted = array_diff($allservices, $reported);
      foreach ($faulted as $service_id) {
         // This will create a sensor fault event
         $event->add([
            '_sensor_fault' => true,
            $service_fk => $service_id,
            'date' => $_SESSION['glpi_currenttime']
         ]);
      }
      $task->addVolume(count($reported));
      return (count($reported) > 0) ? 1 : 0;
   }

   public static function getActiveAlerts(): array {
      // TODO Needs reimplemented. Events shouldn't have a status on their own!
      global $DB;
      $event_table = self::getTable();
      $service_table = Service::getTable();
      $service_fk = Service::getForeignKeyField();

      $iterator = $DB->request([
         'SELECT' => [
            "{$event_table}.*",
            "{$service_table}.name AS service_name",
            "{$service_table}.is_stateless AS service_stateless"
         ],
         'FROM' => $event_table,
         'LEFT JOIN' => [
            $service_table => [
               'FKEY' => [
                  $service_table => 'id',
                  $event_table => $service_fk
               ]
            ]
         ],
         'WHERE' => [
         ]
      ]);
      $alerts = [];
      foreach ($iterator as $data) {
         $alerts[] = $data;
      }
      return $alerts;
   }
}
