<?php
/**
 * ---------------------------------------------------------------------
 * GLPI - Gestionnaire Libre de Parc Informatique
 * Copyright (C) 2015-2018 Teclib' and contributors.
 *
 * http://glpi-project.org
 *
 * based on GLPI - Gestionnaire Libre de Parc Informatique
 * Copyright (C) 2003-2014 by the INDEPNET Development Team.
 *
 * ---------------------------------------------------------------------
 *
 * LICENSE
 *
 * This file is part of GLPI.
 *
 * GLPI is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * GLPI is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with GLPI. If not, see <http://www.gnu.org/licenses/>.
 * ---------------------------------------------------------------------
 */

if (!defined('GLPI_ROOT')) {
   die("Sorry. You can't access this file directly");
}

/**
 * ITILEvent class
 * @since 10.0.0
 */
class ITILEvent extends CommonDBTM
{

   /**
    * An event that doesn't require any response
    */
   const INFORMATION = 0;

   /**
    * An event that indicates a potential issue that requires monitoring or preventative measures.
    */
   const WARNING = 1;

   /**
    * An event that indicates an issue and requires a response.
    */
   const EXCEPTION = 2;

   //TODO Handle status workflows as described by each status.
   // Try to factorize the workflow as much as possible to make it easy to replace in the future.

   /**
    * An event that was logged but not acted on. For informational alerts, this is the only valid status.
    */
   const STATUS_NEW = 0;

   /**
    * An event that has been acknowledged by a technician. Duplicate alerts should be dropped for a period of time.
    */
   const STATUS_ACKNOWLEDGED = 1;

   /**
    * An event that is currently being remediated by a technician or automatically.
    * Similar to acknowledged events, duplicate events are dropped
    */
   const STATUS_REMEDIATING = 2;

   /**
    * An event that may be resolved. The event will be considered resolved after a time.
    * If a duplicate event is logged, it is linked and this event is downgraded to acknowledged.
    */
   const STATUS_MONITORING = 3;

   /**
    * An event that has been determined to be resolved either manually or automatically after a time period.
    * If a duplicate alert comes in, it is treated as a new event and not linked.
    */
   const STATUS_RESOLVED = 4;

   /**
    * An event that went so long without being resolved that another event has replaced it through correlation rules or a timeout period.
    * This event will be linked to the replacement event if one exists.
    * If there is no replacement (timeout), then new events will not be linked.
    */
   const STATUS_EXPIRED = 5;

   static $rightname                = 'event';


   static function getForbiddenActionsForMenu() {
      return ['add'];
   }

   static function getTypeName($nb = 0)
   {
      return _n('Event', 'Events', $nb);
   }

   function prepareInputForAdd($input)
   {
      $input = parent::prepareInputForAdd($input);

      // Process event filtering rules
      $rules = new RuleITILEventFilterCollection();

      $input['_accept'] = true;
      $input = $rules->processAllRules($input,
                                       $input,
                                       ['recursive' => true],
                                       ['condition' => RuleITILEvent::ONADD]);
      $input = Toolbox::stripslashes_deep($input);

      if (!$input['_accept']) {
         // Drop the event
         return false;
      } else {
         return $input;
      }
   }

   function post_addItem()
   {
      // Process event business rules. Only used for correlation, notifications, and tracking
      $rules = new RuleITILEventCollection();
      $input = $rules->processAllRules($this->fields, $this->fields, ['recursive' => true], ['condition' => RuleITILEvent::ONADD]);
      $input = Toolbox::stripslashes_deep($input);

      // If no correlation UUID is assigned from rules, create a new UUID
      if (!isset($input['correlation_uuid'])) {
         $input['correlation_uuid'] = uniqid();
      }

      $this->update([
         'id' => $this->getID()
      ] + $input);
      parent::post_addItem();
   }

   function cleanDBonPurge()
   {
      $this->deleteChildrenAndRelationsFromDb(
            [
               Item_ITILEvent::class
            ]
         );

         parent::cleanDBonPurge();
   }
   /**
    * Gets the name of a significance level from the int value
    * @param int $significance The significance level
    * @return string The significance level name
    * @since 10.0.0
    */
   static function getSignificanceName($significance)
   {
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
    * @param array $options Dropdown options
    * @see Dropdown::showFromArray()
    * @return void|string
    * @since 10.0.0
    */
   static function dropdownSignificance(array $options = [])
   {
      global $CFG_GLPI;

      $p = [
         'name'     => 'significance',
         'value'    => 0,
         'showtype' => 'normal',
         'display'  => true,
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

   /**
    * Gets the name of an event status from the int value
    * @param int $status The event status
    * @return string The event status name
    * @since 10.0.0
    */
   static function getStatusName($status) : string
   {
      switch ($status) {
         case 0:
            return __('New');
         case 1:
            return __('Acknowledged');
         case 2:
            return __('Remediating');
         case 3:
            return __('Monitoring');
         case 4:
            return __('Resolved');
         case 5:
            return __('Expired');
         default:
            return __('Unknown');
      }
   }

   /**
    * Displays or gets a dropdown menu of event statuses.
    * The default functionality is to display the dropdown.
    * @param array $options Dropdown options
    * @see Dropdown::showFromArray()
    * @return void|string
    * @since 10.0.0
    */
   static function dropdownStatus(array $options = [])
   {
      global $CFG_GLPI;

      $p = [
         'name'     => 'status',
         'value'    => 0,
         'showtype' => 'normal',
         'display'  => true,
      ];

      if (is_array($options) && count($options)) {
         foreach ($options as $key => $val) {
            $p[$key] = $val;
         }
      }
      $values = [];
      $values[0] = self::getStatusName(0);
      $values[1] = self::getStatusName(1);
      $values[2] = self::getStatusName(2);
      $values[3] = self::getStatusName(3);
      $values[4] = self::getStatusName(4);
      $values[5] = self::getStatusName(5);

      return Dropdown::showFromArray($p['name'], $values, $p);
   }

   public static function getActiveStatusArray()
   {
      return [self::STATUS_NEW, self::STATUS_REMEDIATING];
   }

   public static function getEventData($item, int $start = 0, int $limit = 0, array $sqlfilters = []) : DBmysqlIterator
   {
      global $DB;

      $eventtable = self::getTable();

      $query = [
         'FROM' => $eventtable,
         'WHERE' => [],
         'ORDERBY' => ['date DESC']
      ];

      if ($item != null) {
         switch ($item->getType()) {
            case 'Ticket' :
            case 'Change' :
            case 'Problem' :
               $itemeventtable = Itil_ITILEvent::getTable();
            default :
               $itemeventtable = Item_ITILEvent::getTable();
         }
         $query['WHERE'][] = [
            "{$itemeventtable}.itemtype" => $item->getType(),
            "{$itemeventtable}.items_id" => $item->getID()
         ];
         $query['LEFT JOIN'] = [
            $itemeventtable => [
               'FKEY' => [
                  $eventtable       => 'id',
                  $itemeventtable   => 'itilevents_id'
               ]
            ]
         ];
      }
      if (isset($sqlfilters['category'])) {
         $query['WHERE'][] = [
            "$eventtable.itileventcategories_id" => $sqlfilters['category']
         ];
         unset($sqlfilters['category']);
      }
      $query['WHERE'] = array_merge_recursive($query['WHERE'], $sqlfilters);
      if ($limit) {
         $query['START'] = (int)$start;
         $query['LIMIT'] = (int)$limit;
      }
      $iterator = $DB->request($query);
      return $iterator;
   }

   //TODO Implement card based dashboard, have a static view, or rely on a plugin?
   public static function showDashboard()
   {
      echo "<h2 class='center'>".__('Event Management Dashboard')."</h2>";
      echo "<div class='siem-dashboard'>";
      self::showDashboardCard('count-alerts-day');
      self::showDashboardCard('count-active-warnings');
      self::showDashboardCard('count-active-exceptions');
      self::showDashboardCard('count-new');
      self::showDashboardCard('count-remediating');
      self::showDashboardCard('list-historical', ['colspan' => 5]);
      echo "</div>";
   }

   public static function getDashboardCardTitle(string $cardname)
   {
      switch ($cardname) {
         case 'count-alerts-day':
            return __('Total Alerts (24 hours)');
         case 'count-active-warnings':
            return __('Active Warnings');
         case 'count-active-exceptions':
            return __('Active Exceptions');
         case 'count-new':
            return __('New Events');
         case 'count-remediating':
            return __('Remediating Events');
         case 'list-historical':
            return __('Historical Events');
         default:
            return $cardname;
      }
   }

   public static function showDashboardCard(string $cardname, $params = [])
   {
      global $DB;

      $p = [
         'colspan' => 1,
         'rowspan' => 1
      ];
      $p = array_replace($p, $params);

      // Get some event data and cache it
      $iterator = $DB->request([
         'SELECT' => [
            'id',
            'significance',
            'status'
         ],
         'FROM' => self::getTable(),
         'WHERE' => [
            'status'       => self::getActiveStatusArray(),
            'significance' => [self::WARNING, self::EXCEPTION]
         ]
      ]);

      $daily_alerts = $DB->request([
         'COUNT' => 'cpt',
         'FROM' => self::getTable(),
         'WHERE' => [
            new \QueryExpression("date > DATE_ADD(now(), INTERVAL -1 DAY)"),
            'significance' => [self::WARNING, self::EXCEPTION]
         ]
      ]);

      static $counters = null;
      if ($counters === null) {
         $counters = array_fill_keys(['warning', 'exception', 'new', 'remediating'], 0);
         $counters['daily_alerts'] = $daily_alerts->next()['cpt'];
         while ($data = $iterator->next()) {
            if ($data['significance'] == self::WARNING) {
               $counters['warning'] += 1;
            } else if ($data['significance'] == self::EXCEPTION) {
               $counters['exception'] += 1;
            }
            if ($data['status'] == self::STATUS_NEW) {
               $counters['new'] += 1;
            } else if ($data['status'] == self::STATUS_REMEDIATING) {
               $counters['remediating'] += 1;
            }
         }
      }

      $title = self::getDashboardCardTitle($cardname);
      $style = '';
      if (is_numeric($p['colspan']) && $p['colspan'] > 1) {
         $style .= '--colspan:'.$p['colspan'];
      }
      if (is_numeric($p['rowspan']) && $p['rowspan'] > 1) {
         $style .= '--rowspan:'.$p['rowspan'];
      }

      echo "<div class='siem-dashboard-card' style='{$style}'><h3>{$title}</h3><div class='card-content'>";
      switch ($cardname) {
         case 'count-alerts-day':
            echo "<p>".$counters['daily_alerts']."</p>";
            break;
         case 'count-active-warnings':
            echo "<p>".$counters['warning']."</p>";
            break;
         case 'count-active-exceptions':
            echo "<p>".$counters['exception']."</p>";
            break;
         case 'count-new':
            echo "<p>".$counters['new']."</p>";
            break;
         case 'count-remediating':
            echo "<p>".$counters['remediating']."</p>";
            break;
         case 'list-historical':
            self::showList();
            break;
         default:
            echo "<p>".__("Invalid dashboard card")."</p>";
      }
      echo "</div></div>";
   }

   public static function showHeatmap()
   {
      global $DB;
      // TODO Feature idea
      // Show a geographic heatmap based on assets with active alerts
      // Should calculate initial view to be center of all active alerts and set an appropriate zoom level
      $heat_data = [];
      $active_events = ITILEvent::getEventData(null);

      while ($event = $active_events->next()) {
         $item_iterator = $DB->request([
            'SELECT' => ['itemtype', 'items_id'],
            'FROM' => Item_ITILEvent::getTable(),
            'WHERE' => ['itilevents_id' => $event['id']]
         ]);

         while ($item = $item_iterator->next()) {
            $itemtable = $item['itemtype']::getTable();
            $location_iterator = $DB->request([
               'SELECT' => [
                  'glpi_locations.latitude',
                  'glpi_locations.longitude'
               ],
               'FROM' => $itemtable,
               'LEFT JOIN' => [
                  'glpi_locations' => [
                     'FKEY' => [
                        $itemtable        => 'locations_id',
                        'glpi_locations'  => 'id'
                     ]
                  ]
               ]
            ]);
            $location = $location_iterator->next();
            if ($location) {
               $heat_data[] = [
                  $location['latitude'],
                  $location['longitude'],
                  ($event['significance'] == ITILEvent::WARNING) ? 0.5 : 1.0
               ];
            }
         }
      }

      $heat_data = json_encode($heat_data);

      $js = "$(function() {
               var map = initMap($('#heatmap'), 'siem-heatmap', '400px');
               _loadMap(map);
            });

         var _loadMap = function(map_elt) {
            var heat = L.heatLayer({$heat_data}, {radius: 50, max: 1.0}).addTo(map_elt);
            map_elt.redraw();
         }

         ";
         echo Html::scriptBlock($js);
         echo "<div id='heatmap'></div>";
   }

   public static function showList($activeonly = false, CommonDBTM $item = null, $display = true)
   {

      if (!$display) {
         ob_start();
      }
      $header_text = $activeonly ? __('Active events') : __('Historical events');
      $selftable = self::getTable();

      if (isset($_GET["start"])) {
         $start = intval($_GET["start"]);
      } else {
         $start = 0;
      }
      $sql_filters = self::convertFiltersValuesToSqlCriteria(isset($_GET['listfilters']) ? $_GET['listfilters'] : []);
      if ($activeonly) {
         $sql_filters['status'] = self::getActiveStatusArray();
         $sql_filters['NOT']['significance'] = self::INFORMATION;
      }

      $iterator = ITILEvent::getEventData($item, $start, $_SESSION['glpilist_limit'], $sql_filters);
      
      // Display the pager
      $additional_params = isset($_GET['listfilters']) ? http_build_query(['listfilters' => $_GET['listfilters']]) : '';
      Html::printAjaxPager($header_text, $start, $iterator->count(), '', true, $additional_params);


      echo "<div class='firstbloc'>";

      echo "<table class='tab_cadre_fixehov'><tr>";

      //TODO Find a clean way to show associated items in list entry (Useful for dashboard view)
      // Should items be grouped together in the same row, or have some sort of expandable information panel
      // Alternative is to only allow a single item link per Event
      $header = "<tr><th>".__('ID')."</th>";
      $header .= "<th>".__('Name')."</th>";
      $header .= "<th>".__('Significance')."</th>";
      $header .= "<th>".__('Date')."</th>";
      if (!$activeonly) {
         $header .= "<th>".__('Status')."</th>";
      }
      $header .= "<th>".__('Category')."</th>";
      $header .= "<th>".__('Correlation ID')."</th></tr>";
      $colcount = $activeonly ? 6 : 7;

      echo "<thead>";
      echo $header;
      if (isset($_GET['listfilters'])) {
         echo "<tr class='log_history_filter_row'>";
         echo "<th>";
         echo "<input type='hidden' name='listfilters[active]' value='1' />";
         echo "<input type='hidden' name='items_id' value='{$item->getID()}' />";
         echo "</th>";
         echo "<th>";
         echo Html::input('listfilters[name]');
         echo "</th>";
         echo "<th>";
         ITILEvent::dropdownSignificance([
            'name'                  => 'listfilters[significance]',
            'value'                 => '',
            'values'                => isset($_GET['listfilters']['significance']) ?
                                          $_GET['listfilters']['significance'] : [],
            'multiple'              => true,
            'width'                 => '100%'
         ]);
         echo "</th>";
         $dateValue = isset($_GET['filters']['date']) ? Html::cleanInputText($_GET['listfilters']['date']) : null;
         echo "<th><input type='date' name='listfilters[date]' value='$dateValue' /></th>";
         if (!$activeonly) {
            echo "<th>";
            ITILEvent::dropdownStatus([
               'name'                  => 'listfilters[status]',
               'value'                 => '',
               'values'                => isset($_GET['listfilters']['status']) ?
                                             $_GET['listfilters']['status'] : [],
               'multiple'              => true,
               'width'                 => '100%'
            ]);
            echo "</th>";
         }
         echo "<th>";
         ITILEventCategory::dropdown([
            'name'                  => 'listfilters[category]',
            'value'                 => '',
            'values'                => isset($_GET['listfilters']['category']) ?
                                          $_GET['listfilters']['category'] : [],
            'multiple'              => true,
            'width'                 => '100%',
            'comments'              => false
         ]);
         echo "</th>";
         echo "</tr>";
      } else {
         echo "<tr>";
         echo "<th colspan='{$colcount}'>";
         echo "<a href='#' class='show_list_filters'>" . __('Show filters') . " <span class='fa fa-filter pointer'></span></a>";
         echo "</th>";
         echo "</tr>";
      }
      echo "</thead>";

      echo "<tfoot>$header</tfoot>";

      if (!count($iterator)) {
         echo "<tr class='tab_bg_2'>";
         echo "<td class='center' colspan='{$colcount}'>".__('No event')."</td></tr>\n";
      } else {
         echo "<tbody>";
         while ($data = $iterator->next()) {
            $style = '';
            if ($data['significance'] == ITILEvent::WARNING) {
               $style = "style='background-color: {$_SESSION['glpieventwarning_color']}'";
            } else if ($data['significance'] == ITILEvent::EXCEPTION) {
               $style = "style='background-color: {$_SESSION['glpieventexception_color']}'";
            }
            echo "<tr class='tab_bg_2' $style>";
            echo "<td class='center'>".$data['id']."</td>";
            echo "<td class='center'>".$data['name']."</td>";
            //echo "<td class='center'>".substr(nl2br($data['content']), 0, 100)."</td>";
            echo "<td class='center'>".ITILEvent::getSignificanceName($data['significance'])."</td>";
            echo "<td class='center'>".Html::convDateTime($data['date'])."</td>";
            if (!$activeonly) {
               echo "<td class='center'>".ITILEvent::getStatusName($data['status'])."</td>";
            }
            echo "<td class='center'>".ITILEventCategory::getCategoryName($data['itileventcategories_id'])."</td>";
            echo "<td class='center'>".$data['correlation_uuid']."</td>";
            echo "</tr>\n";
         }
         echo "</tbody>";
      }
      echo "</table></div>";
      Html::printAjaxPager($header_text, $start, $iterator->count(), '', true, $additional_params);
      if (!$display) {
         return ob_end_flush();
      }
   }

   /**
    * Convert filters values into SQL filters usable in 'WHERE' condition of request build with 'DBmysqlIterator'.
    *
    * @param array $filters  Filters values
    * @return array
    *
    * @since 10.0.0
    **/
   static function convertFiltersValuesToSqlCriteria(array $filters)
   {
      $sql_filters = [];

      if (isset($filters['name']) && !empty($filters['name'])) {
         $sql_filters['name'] = ['LIKE', "%{$filters['name']}%"];
      }

      if (isset($filters['date']) && !empty($filters['date'])) {
         $sql_filters['date_mod'] = ['LIKE', "%{$filters['date']}%"];
      }

      if (isset($filters['status']) && !empty($filters['status'])) {
         $sql_filters['status'] = $filters['status'];
      }

      if (isset($filters['significance']) && !empty($filters['significance'])) {
         $sql_filters['significance'] = $filters['significance'];
      }

      if (isset($filters['category']) && !empty($filters['category'])) {
         $sql_filters['category'] = $filters['category'];
      }

      return $sql_filters;
   }

   /**
    * Gets all events with the same correlation UUID as this event
    * 
    * @param bool $exclusive True if the results should not include this event
    * @return DBmysqlIterator
    */
   public function getCorrelated(bool $exclusive = false)
   {
      global $DB;
      $query = [
         'FROM' => self::getTable(),
         'WHERE' => [
            'correlation_uuid' => $this->fields['correlation_uuid']
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
    * Update all events with the same correlaiton UUID (exclusive)
    * 
    * @param array $params Query parameters ([:field name => field value)
    * @param array $where  WHERE clause
    */
   public function updateCorrelated(array $params, array $where = [])
   {
      global $DB;

      $where = [
         'NOT' => [
            'id' => $this->getID()
         ],
         'correlation_uuid' => $this->fields['correlation_uuid']
      ] + $where;

      $DB->update(self::getTable(), $params, $where);
   }
}