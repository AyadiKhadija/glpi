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

/**
 * Item_MaintenanceSchedule Class
 *
 *  Relation between an item and a Maintenance Schedule
**/
class Item_MaintenanceSchedule extends CommonDBRelation {

   // From CommonDBRelation
   static public $itemtype_1          = 'MaintenanceSchedule';
   static public $items_id_1          = 'maintenanceschedules_id';

   static public $itemtype_2          = 'itemtype';
   static public $items_id_2          = 'items_id';


   /**
    * Get maintenance schedules for an item
    *
    * @since 0.84
    *
    * @param integer $groups_id Group ID
    * @param array   $condition Query extra condition (default [])
    *
    * @return array
   **/
   static function getItemSchedules($itemtype, $items_id, $condition = []) {
      global $DB;

      $schedules = [];

      $iterator = $DB->request([
         'SELECT' => [
            'glpi_maintenaceschedules.*',
            'glpi_items_maintenaceschedules.id AS IDD',
            'glpi_items_maintenaceschedules.id AS linkID'
         ],
         'FROM'   => self::getTable(),
         'LEFT JOIN'    => [
            $itemtype::getTable() => [
               'ON' => [
                  $itemtype::getTable() => 'id',
                  self::getTable()  => 'maintenanceschedules_id'
               ]
            ]
         ],
         'WHERE'        => [
            'glpi_items_maintenaceschedules.itemtype' => $itemtype,
            'glpi_items_maintenaceschedules.items_id' => $items_id
         ] + $condition,
         'ORDER'        => "{$itemtype::getTable()}.name"
      ]);
      while ($row = $iterator->next()) {
         $schedules[] = $row;
      }

      return $schedules;
   }

   /**
    * Show maintenance schedules form for an item
    * 
    * @param object  $item          Any item of type in CFG_GLPI['maint_types']
    * @param boolean $withtemplate  Template or basic item (default 0)
    */
   static function showForItem($item, $withtemplate = 0) {
      global $CFG_GLPI;

      $ID = $item->getID();
      if (!MaintenanceSchedule::canView() || !$item->can($ID, READ)) {
         return false;
      }

      $canedit = $item->can($ID, UPDATE);

      $rand    = mt_rand();

      $iterator = self::getListForItem($item);
      $schedules = [];
      $used    = [];
      while ($data = $iterator->next()) {
         $used[$data["id"]] = $data["id"];
         $schedules[] = $data;
      }

      if ($canedit) {
         echo "<div class='firstbloc'>";
         echo "<form name='itemschedule_form$rand' id='itemschedule_form$rand' method='post'";
         echo " action='".Toolbox::getItemTypeFormURL('MaintenanceSchedule')."'>";

         echo "<table class='tab_cadre_fixe'>";
         echo "<tr class='tab_bg_1'><th colspan='6'>".__('Associate a maintenance schedule')."</th></tr>";
         echo "<tr class='tab_bg_2'><td class='center'>";
         echo Html::hidden('items_id', ['value' => $ID]);

         $params = [
            'used'      => $used,
            'condition' => [
                  'OR' => [
                  ['entities_id' => $_SESSION['glpiactive_entity']],
                  [
                     'AND' => [
                        'entities_id' => array_merge([0], $_SESSION['glpiactiveentities']),
                        'is_recursive' => 1
                     ]
                  ]
               ]
            ]
         ];
         MaintenanceSchedule::dropdown($params);

         echo "</td><td class='tab_bg_2 center'>";
         echo Html::submit(_sx('button', 'Add'), ['name' => 'addschedule']);

         echo "</td></tr>";
         echo "</table>";
         Html::closeForm();
         echo "</div>";
      }

      echo "<div class='spaced'>";
      if ($canedit && count($used)) {
         $rand = mt_rand();
         Html::openMassiveActionsForm('mass'.__CLASS__.$rand);
         echo "<input type='hidden' name='users_id' value='".$item->fields['id']."'>";
         $massiveactionparams = ['num_displayed' => min($_SESSION['glpilist_limit'], count($used)),
                           'container'     => 'mass'.__CLASS__.$rand];
         Html::showMassiveActions($massiveactionparams);
      }
      echo "<table class='tab_cadre_fixehov'>";
      $header_begin  = "<tr>";
      $header_top    = '';
      $header_bottom = '';
      $header_end    = '';

      if ($canedit && count($used)) {
         $header_begin  .= "<th width='10'>";
         $header_top    .= Html::getCheckAllAsCheckbox('mass'.__CLASS__.$rand);
         $header_bottom .= Html::getCheckAllAsCheckbox('mass'.__CLASS__.$rand);
         $header_end    .= "</th>";
      }
      $header_end .= "<th>".MaintenanceSchedule::getTypeName(1)."</th>";
      //$header_end .= "<th>".__('Name')."</th>";
      $header_end .= "<th>".__('Active')."</th>";
      $header_end .= "<th>".__('Begin date')."</th>";
      $header_end .= "<th>".__('Periodicity')."</th>";
      $header_end .= "<th>".__('Maintenance window')."</th></tr>";
      echo $header_begin.$header_top.$header_end;

      $schedule = new MaintenanceSchedule();
      if (!empty($schedules)) {
         Session::initNavigateListItems('MaintenanceSchedule',
                              //TRANS : %1$s is the itemtype name,
                              //        %2$s is the name of the item (used for headings of a list)
                                        sprintf(__('%1$s = %2$s'),
                                                $item::getTypeName(1), $item->getName()));

         foreach ($schedules as $data) {
            if (!$schedule->getFromDB($data["id"])) {
               continue;
            }
            Session::addToNavigateListItems('MaintenanceSchedule', $data["id"]);
            echo "<tr class='tab_bg_1'>";

            if ($canedit && count($used)) {
               echo "<td width='10'>";
               Html::showMassiveActionCheckBox(__CLASS__, $data["linkid"]);
               echo "</td>";
            }
            echo "<td>".$schedule->getLink()."</td>";
            //echo "<td class='center'>" . $item->fields['name'] . "</td>";
            echo "<td class='center'>" . $item->fields['is_active'] . "</td>";
            echo "<td class='center'>" . $item->fields['begin_date'] . "</td>";
            echo "<td class='center'>" . $item->fields['periodicity'] . "</td>";
            echo "<td class='center'>" . $item->fields['maintenance_window'] . "</td>";
            echo "</tr>";
         }
         echo $header_begin.$header_bottom.$header_end;

      } else {
         echo "<tr class='tab_bg_1'>";
         echo "<td colspan='5' class='center'>".__('None')."</td></tr>";
      }
      echo "</table>";

      if ($canedit && count($used)) {
         $massiveactionparams['ontop'] = false;
         Html::showMassiveActions($massiveactionparams);
         Html::closeForm();
      }
      echo "</div>";
   }

   /**
    * Get search function for the class
    *
    * @return array of search option
   **/
   function rawSearchOptions() {
      $tab = [];

      $tab[] = [
         'id'                 => 'common',
         'name'               => __('Characteristics')
      ];

      $tab[] = [
         'id'                 => '2',
         'table'              => $this->getTable(),
         'field'              => 'id',
         'name'               => __('ID'),
         'massiveaction'      => false,
         'datatype'           => 'number'
      ];

      return $tab;
   }

   function getTabNameForItem(CommonGLPI $item, $withtemplate = 0) {

      // can exists for template
      if (MaintenanceSchedule::canView()) {
         $nb = 0;
         if ($_SESSION['glpishow_count_on_tabs']) {
            $nb = countElementsInTable($this->getTable(),
                                       [$item->getForeignKeyField() => $item->getID(), 'itemtype' => $item->getType()]);
         }
         return self::createTabEntry(MaintenanceSchedule::getTypeName(Session::getPluralNumber()), $nb);
      }
      return '';
   }


   static function displayTabContentForItem(CommonGLPI $item, $tabnum = 1, $withtemplate = 0) {

      self::showForItem($item, $withtemplate);
      return true;
   }
}
