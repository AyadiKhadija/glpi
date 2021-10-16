<?php

namespace Glpi\Siem;

use Calendar;
use CommonDBTM;
use CommonGLPI;
use Glpi\Application\View\TemplateRenderer;
use Html;
use Toolbox;

class Host extends CommonDBTM {
   use Monitored;

   public static $rightname = 'siem_host';

   public static function getTypeName($nb = 0): string {
      return _n('Host', 'Hosts', $nb);
   }

   public function defineTabs($options = []): array {
      $ong = [];
      $this->addDefaultFormTab($ong)
         ->addStandardTab(Service::class, $ong, $options);
      return $ong;
   }

   public function getTabNameForItem(CommonGLPI $item, $withtemplate = 0) {
      if (!$withtemplate) {
         switch ($item->getType()) {
            case __CLASS__ :
               return self::getTypeName();
            default:
               return self::createTabEntry('Event Management');
         }
      }
      return '';
   }

   public static function getFormURLWithID($id = 0, $full = true): string {
      global $DB;
      $iterator = $DB->request([
         'SELECT' => [
            'itemtype',
            'items_id'
         ],
         'FROM'   => self::getTable(),
         'WHERE'  => ['id' => $id]
      ]);
      $event_class = Event::class;
      if ($iterator->count()) {
         $item = $iterator->current();
         return $item['itemtype']::getFormURLWithID($item['items_id'], $full) . "&forcetab={$event_class}$1";
      }
      return '#';
   }

   public static function getSpecificValueToDisplay($field, $values, array $options = []) {
      global $DB;

      switch ($field) {
         case 'name':
            $iterator = $DB->request([
               'SELECT'    => ['name'],
               'FROM'      => $values['itemtype']::getTable(),
               'WHERE'     => ['id' => $values['items_id']]
            ]);
            if ($iterator->count()) {
               return $iterator->current()['name'];
            } else {
               return null;
            }
      }
      return parent::getSpecificValueToDisplay($field, $values, $options);
   }

   public function rawSearchOptions(): array {
      $service_table = Service::getTable();

      $tab = [];
      $tab[] = [
         'id' => 'common',
         'name' => __('Characteristics')
      ];
      $tab[] = [
         'id' => '2',
         'table' => self::getTable(),
         'field' => 'id',
         'name' => __('ID'),
         'massiveaction' => false,
         'datatype' => 'itemlink'
      ];
      $tab[] = [
         'id' => '3',
         'table' => self::getTable(),
         'field' => 'itemtype',
         'name' => __('Item type'),
         'datatype' => 'itemtypename'
      ];
      $tab[] = [
         'id' => '4',
         'table' => self::getTable(),
         'field' => 'items_id',
         'name' => __('Item ID'),
         'datatype' => 'number'
      ];
      $tab[] = [
         'id' => '7',
         'table' => $service_table,
         'field' => 'name',
         'linkfield' => 'plugin_siem_services_id_availability',
         'name' => __('Availability service'),
         'datatype' => 'itemlink'
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
         'id' => '121',
         'table' => self::getTable(),
         'field' => 'date_creation',
         'name' => __('Creation date'),
         'datatype' => 'datetime',
         'massiveaction' => false
      ];
      //TODO Add availability service search options
      return $tab;
   }

   /**
    * Loads the host's availability service and then caches and returns it.
    * @return Service The loaded availability service or null if it could not be loaded.
    * @since 1.0.0
    */
   public function getAvailabilityService(): ?Service {
      if (!$this->fields['services_id_availability'] || $this->fields['services_id_availability'] < 0) {
         return null;
      }
      // Load and cache availability service in case of multiple calls per page
      static $service = null;
      if ($service === null) {
         $service = new Service();
         if (!$service->getFromDB($this->fields['services_id_availability'])) {
            return null;
         }
      }
      return $service;
   }

   public function checkNow(): bool {
      return $this->getAvailabilityService()->checkNow();
   }

   public function getHostInfoDisplay(): string {
      global $DB;

      $twig_vars = [
         'host_info_bg'    => Service::getBackgroundColorClass($this->getStatus()),
         'toolbar_buttons' => [
            [
               'label' => __('Check now'),
               'action' => "window.pluginSiem.hostCheckNow({$this->getID()})",
            ],
            [
               'label' => __('Schedule downtime'),
               'action' => "hostScheduleDowntime({$this->getID()})",
            ],
            [
               'label' => sprintf(__('Add %s'), Service::getTypeName(1)),
               'action' => "window.pluginSiem.addHostService({$this->getID()})",
            ]
         ],
         'status'       => $this->getCurrentStatusName(),
         'host_stats'   => []
      ];

      if ($this->getAvailabilityService()) {
         $status_since_diff = Html::timestampToRelativeStr($this->getLastStatusChange());
         $last_check_diff = Html::timestampToRelativeStr($this->getLastStatusCheck());
         $twig_vars['host_stats'] = [
            __('Last status change') => ($status_since_diff ?? __('No change')),
            __('Last check') => ($last_check_diff ?? __('Not checked')),
            __('Flapping') => $this->isFlapping() ? __('Yes') : __('No')
         ];
      } else {
         $twig_vars['host_stats'] = [
            __('Host availability not monitored') => __('Set the availability service to monitor the host')
         ];
      }
      if (in_array($this->getStatus(), [Service::STATUS_CRITICAL, Service::STATUS_WARNING], true)) {
         $twig_vars['toolbar_buttons'][] = [
            'label' => sprintf(__('Acknowledge %s'), self::getTypeName(1)),
            'action' => "acknowledge({$this->getID()})",
         ];
      }
      if ($this->getAvailabilityService()) {
         $host_service = $this->getAvailabilityService();
         $calendar_name = __('Unspecified');
         if ($host_service->fields['calendars_id'] !== null) {
            $iterator = $DB->request([
               'SELECT' => ['name'],
               'FROM' => Calendar::getTable(),
               'WHERE' => ['id' => $host_service->fields['calendars_id']]
            ]);
            if ($iterator->count()) {
               $calendar_name = $iterator->current()['name'];
            }
         }
         $service_name = $host_service->fields['name'];
         $check_mode = Service::getCheckModeName($host_service->fields['check_mode']);
         $check_interval = $host_service->fields['check_interval'] ?? __('Unspecified');
         $notif_interval = $host_service->fields['notificationinterval'] ?? __('Unspecified');
         $twig_vars['service_stats'] = [
            [
               __('Name') => $service_name,
               __('Check mode') => $check_mode,
            ],
            [
               __('Check interval') => $check_interval,
               __('Notification interval') => $notif_interval,
            ],
            [
               __('Calendar') => $calendar_name,
               __('Flap detection') => $host_service->fields['use_flap_detection'] ? __('Yes') : __('No')
            ]
         ];
      } else {
         $form_url = self::getFormURL(true);
         $add_form = "<form method='POST' action='$form_url'>";
         $add_form .= Html::hidden('id', ['value' => $this->fields['id']]);
         $add_form .= '<fieldset>';
         $add_form .= '<legend>' . __('Service') . '</legend>';
         $add_form .= Service::getDropdownForHost($this->getID());
         $add_form .= Html::submit(__('Set availability service'), [
            'name' => 'set_host_service',
            'id' => '#btn-set-hostservice'
         ]);
         $add_form .= '</fieldset>';
         $add_form .= Html::closeForm(false);
         $twig_vars['add_availability_service_form'] = $add_form;
      }
      return TemplateRenderer::getInstance()->render('components/siem/host_info.html.twig', $twig_vars);
   }

   public function getServices(): array {
      global $DB;
      static $services = null;
      if ($services === null) {
         $service_table = Service::getTable();
         $template_table = ServiceTemplate::getTable();
         $template_fk = ServiceTemplate::getForeignKeyField();

         $iterator = $DB->request([
            'SELECT' => [
               $service_table.'.*',
               $template_table.'.name',
               $template_table.'.plugins_id',
               $template_table.'.sensor'
            ],
            'FROM' => $service_table,
            'LEFT JOIN' => [
               $template_table => [
                  'FKEY' => [
                     $service_table => $template_fk,
                     $template_table => 'id'
                  ]
               ]
            ],
            'WHERE' => [
               self::getForeignKeyField() => $this->getID()
            ]
         ]);
         $services = [];
         foreach ($iterator as $data) {
            $services[$data['id']] = $data;
         }
      }
      return $services;
   }

   /**
    * Sets the given service as the availability service for its host. If another availability service is already set, it is replaced.
    * @param integer $services_id The ID of the service that already belongs to the host.
    * @return boolean True if the availability service was successfully saved.
    */
   public function setAvailabilityService($services_id): bool {
      global $DB;
      $service = new Service();
      $match = $service->find([
         'id'  => $services_id
      ]);
      if (count($match) && reset($match)[self::getForeignKeyField()] === $this->getID()) {
         $DB->update(self::getTable(), ['services_id_availability' => $services_id], ['id' => $this->getID()]);
         return true;
      }
      return false;
   }

   /**
    * Gets the info for the item that this host is tied to
    */
   public function getItemInfo() {
      $itemtype = $this->fields['itemtype'];
      /** @var CommonDBTM $item */
      $item = new $itemtype();
      $match = $item->find(['id' => $this->fields['items_id']]);
      return reset($match);
   }

   /**
    * Gets the item that this host is tied to
    * @return ?CommonDBTM
    */
   public function getItem(): ?CommonDBTM {
      $itemtype = $this->fields['itemtype'];
      /** @var CommonDBTM $item */
      $item = new $itemtype();
      $result = $item->getFromDB($this->fields['items_id']);
      return $result ? $item : null;
   }
}
