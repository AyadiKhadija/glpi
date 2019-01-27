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

class MaintenanceSchedule extends CommonDBTM {

   public $dohistory       = true;
   static $rightname       = 'maintenance_schedule';
   protected $usenotepad  = true;


   static function getTypeName($nb = 0) {
      return _n('Maintenance Schedule', 'Maintenance Schedules', $nb);
   }

   /**
    * @see CommonGLPI::getTabNameForItem()
   **/
   function getTabNameForItem(CommonGLPI $item, $withtemplate = 0) {

      // can exists for template
      if (static::canView()) {
         $nb = 0;
         if ($_SESSION['glpishow_count_on_tabs']) {
            $nb = countElementsInTable($this->getTable(),
                                       [$item->getForeignKeyField() => $item->getID()]);
         }
         return self::createTabEntry(self::getTypeName(Session::getPluralNumber()), $nb);
      }
      return '';
   }

   /**
    * @param $item            CommonGLPI object
    * @param $tabnum          (default 1)
    * @param $withtemplate    (default 0)
   **/
   static function displayTabContentForItem(CommonGLPI $item, $tabnum = 1, $withtemplate = 0) {

      self::showForItem($item, $withtemplate);
      return true;
   }

   function cleanDBonPurge() {

      $this->deleteChildrenAndRelationsFromDb(
         [
            Item_MaintenanceSchedule::class
         ]
      );

      //TODO Clean rules
   }

   function rawSearchOptions() {
      $tab = [];

      $tab[] = [
         'id'                 => 'common',
         'name'               => __('Characteristics')
      ];

      $tab[] = [
         'id'                 => '1',
         'table'              => $this->getTable(),
         'field'              => 'name',
         'name'               => __('Name'),
         'searchtype'         => 'contains',
         'datatype'           => 'itemlink',
         'massiveaction'      => false
      ];

      $tab[] = [
         'id'                 => '2',
         'table'              => $this->getTable(),
         'field'              => 'id',
         'name'               => __('ID'),
         'massiveaction'      => false,
         'datatype'           => 'number'
      ];

      $tab[] = [
         'id'                 => '7',
         'table'              => $this->getTable(),
         'field'              => 'notice',
         'name'               => __('Notice'),
         'datatype'           => 'number',
         'max'                => 100,
         'unit'               => 'day'
      ];

      $tab[] = [
         'id'                 => '11',
         'table'              => $this->getTable(),
         'field'              => 'maintenance_window',
         'name'               => __('Maintenance window'),
         'datatype'           => 'number',
         'max'                => 100,
         'unit'               => 'day'
      ];

      $tab[] = [
         'id'                 => '12',
         'table'              => $this->getTable(),
         'field'              => 'begin_date',
         'name'               => __('Start date'),
         'datatype'           => 'date'
      ];

      $tab[] = [
         'id'                 => '13',
         'table'              => $this->getTable(),
         'field'              => 'periodicity',
         'name'               => __('Periodicity'),
         'datatype'           => 'number',
         'min'                => 1,
         'max'                => 120*MONTH_TIMESTAMP,
         'unit'               => 'day'
      ];

      $tab[] = [
         'id'                 => '16',
         'table'              => $this->getTable(),
         'field'              => 'comment',
         'name'               => __('Comments'),
         'datatype'           => 'text'
      ];

      $tab[] = [
         'id'                 => '80',
         'table'              => 'glpi_entities',
         'field'              => 'completename',
         'name'               => __('Entity'),
         'massiveaction'      => false,
         'datatype'           => 'dropdown'
      ];

      $tab[] = [
         'id'                 => '19',
         'table'              => $this->getTable(),
         'field'              => 'date_mod',
         'name'               => __('Last update'),
         'datatype'           => 'datetime',
         'massiveaction'      => false
      ];

      $tab[] = [
         'id'                 => '121',
         'table'              => $this->getTable(),
         'field'              => 'date_creation',
         'name'               => __('Creation date'),
         'datatype'           => 'datetime',
         'massiveaction'      => false
      ];

      return $tab;
   }

   /**
    * Print the maintenance schedule form
    *
    * @param $ID        integer ID of the item
    * @param $options   array
    *     - target for the Form
    *
    * @return boolean
   **/
   function showForm($ID, $options = []) {

      $this->initForm($ID, $options);
      $this->showFormHeader($options);

      echo "<tr class='tab_bg_1'>";
      echo "<td>".__('Name')."</td>";
      echo "<td>";
      Html::autocompletionTextField($this, "name");
      echo "</td>";
      echo "<td rowspan='10' class='middle'>".__('Comments')."</td>";
      echo "<td class='middle' rowspan='10'>";
      Html::textarea([
         'cols'   => 45,
         'rows'   => 8,
         'name'   => 'comment',
         'value'  => $this->fields['comment']
      ]);
      echo "</td></tr>";

      echo "<tr class='tab_bg_1'>";
      echo "<td>".__('Active')."</td>";
      echo "<td>";
      Dropdown::showYesNo('is_active', $this->fields['is_active']);
      echo "</td></tr>";

      echo "<tr class='tab_bg_1'>";
      echo "<td>".__('Begin date')."</td>";
      echo "<td>";
      Html::showDateField('begin_date', ['value' => $this->fields['begin_date']]);
      echo "</td></tr>";

      echo "<tr class='tab_bg_1'>";
      echo "<td>".__('Periodicity')."</td>";
      echo "<td>";
      Dropdown::showNumber('periodicity', [
         'value'  => $this->fields['periodicity'],
         'unit'   => 'day',
         'min'    => 1,
         'max'    => 365
      ]);
      echo "</td></tr>";

      echo "<tr class='tab_bg_1'>";
      echo "<td>".__('Notice')."</td>";
      echo "<td>";
      Dropdown::showNumber('notice', [
         'value'  => $this->fields['notice'],
         'unit'   => 'day',
         'min'    => 0,
         'max'    => 100
      ]);
      echo "</td></tr>";

      echo "<tr class='tab_bg_1'>";
      echo "<td>".__('Maintenance window')."</td>";
      echo "<td>";
      Dropdown::showNumber('maintenance_window', [
         'value'  => $this->fields['maintenance_window'],
         'unit'   => 'day',
         'min'    => 1,
         'max'    => 100
      ]);
      echo "</td></tr>";

      $this->showFormButtons($options);

      return true;
   }
}