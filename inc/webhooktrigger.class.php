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
 * WebhookTrigger Class
 *
 * @since 10.0.0
**/
class WebhookTrigger extends CommonDBChild {

   public $prefix          = '';
   // From CommonDBChild
   static public $itemtype = 'Webhook';
   static public $items_id = 'webhooks_id';
   public $table           = 'glpi_webhooktriggers';

   // From CommonDBTM
   public $dohistory       = true;

   static function getTable($classname = null) {
      return parent::getTable(__CLASS__);
   }

   static function getTypeName($nb = 0) {
      return _n('Webhook trigger', 'Webhook triggers', $nb);
   }

   /**
    * Returns an array of all webhook triggers from the core and all plugins
    * @return array Webhook triggers from core and plugins
    * @since 10.0.0
    */
   static function getTriggerOptions() {
      global $CFG_GLPI;

      static $triggers = [];
      if (count($triggers)) {
         return $triggers;
      }

      $searchitem_actions = [
         'add'       => __('Add'),
         'update'    => __('Update'),
         'create'    => __('Create'),
         'delete'    => __('Delete'),
         'purge'     => __('Purge'),
         'restore'   => __('Restore')
      ];

      $options = [];
      foreach ($CFG_GLPI['globalsearch_types'] as $searchopt) {
         $options[$searchopt]['add'] = __('Add');
         $options[$searchopt]['update'] = __('Update');
         $options[$searchopt]['create'] = __('Create');
         $options[$searchopt]['purge'] = __('Purge');
         $item = new $searchopt();
         $item->getEmpty();
         if ($item->maybeDeleted()) {
            $options[$searchopt]['delete'] = __('Delete');
            $options[$searchopt]['restore'] = __('Restore');
         }
      }

      $triggers = array_merge_recursive($options, Plugin::getWebhookTriggers());
      return $triggers;
   }

   /**
    * Print the webhook trigger form.
    *
    * @param integer $ID    ID of the webhook trigger
    * @param array   $options Options
    *     - string   parent   The parent webhook
    * @see CommonDBTM::showFormButtons() For other valid options parameter values
    *
    * @return boolean
    */
   function showForm($ID, array $options = []) {
      global $CFG_GLPI;

      if (isset($options['parent']) && !empty($options['parent'])) {
         $item = $options['parent'];
      }

      if ($ID > 0) {
         $this->check($ID, READ);
      } else {
         $options[static::$items_id] = $item->getField('id');
         $this->check(-1, CREATE, $options);
      }

      if ($ID > 0) {
         $items_id = $this->fields[static::$items_id];
      } else {
         $items_id = $options['parent']->fields["id"];
      }

      $item = new static::$itemtype();
      if (!$item->getFromDB($items_id)) {
         return false;
      }

      $this->showFormHeader($options);
      echo Html::hidden(self::$items_id, ['value' => $items_id]);
      echo "<tr class='tab_bg_1'>";
      echo "<td><label for='target'>" . __('Trigger target') . "</label></td><td>";
      
      $rand = mt_rand();
      Dropdown::showItemType(array_keys(self::getTriggerOptions()), [
         'name' => 'target',
         'value' => $this->fields['target'],
         'display_emptychoice' => false,
         'rand'   => $rand
      ]);
      $params = [
         'target' => '__VALUE__',
         'rand'     => $rand
      ];

      Ajax::updateItemOnSelectEvent("dropdown_target$rand", "trigger_action",
            $CFG_GLPI["root_doc"]."/ajax/webhooktriggertarget.php", $params);
      //We don't support blank values so trigger the change event to show actions immediately
      echo Html::scriptBlock("$('#dropdown_target$rand').change()");
      echo "</td>";
      echo "<td id='trigger_action'>";
      echo "</td>";
      echo "</tr>";

      $this->showFormButtons($options);

      return true;
   }

   /**
    * Print the webhook triggers
    *
    * @param Webhook $item
    *
    * @return void
   **/
   static function showForWebhook($item) {
      global $DB, $CFG_GLPI;

      $ID = $item->fields['id'];

      if (!$item->getFromDB($ID)
          || !$item->canViewItem()
          || !static::canView()) {
         return false;
      }
      $canedit = $item->canUpdateItem();

      echo "<div class='center'>";

      $iterator = $DB->request([
         'FROM'   => static::getTable(),
         'WHERE'  => [
            static::$items_id   => $ID
         ]
      ]);

      $rand   = mt_rand();

      if ($canedit) {
         echo "<div id='viewtrigger".$ID."_$rand'></div>\n";
         echo "<script type='text/javascript' >\n";
         echo "function viewAddTrigger".$ID."_$rand() {\n";
         $params = ['type'             => static::getType(),
                         'parenttype'       => static::$itemtype,
                         static::$items_id  => $ID,
                         'id'               => -1];
         Ajax::updateItemJsCode("viewtrigger".$ID."_$rand",
                                $CFG_GLPI["root_doc"]."/ajax/viewsubitem.php", $params);
         echo "};";
         echo "</script>\n";
         if (static::canCreate()) {
            echo "<div class='center firstbloc'>".
                   "<a class='vsubmit' href='javascript:viewAddTrigger".$ID."_$rand();'>";
            echo __('Add a new trigger')."</a></div>\n";
         }
      }

      echo "<table class='tab_cadre_fixehov'>";
      echo "<tr class='noHover'>";
      echo "<th colspan='7'>".self::getTypeName(count($iterator))."</th>";
      echo "</tr>";

      if (count($iterator)) {
         echo "<tr>";
         echo "<th>".__('ID')."</th>";
         echo "<th>".__('Trigger target')."</th>";
         echo "<th>".__('Action')."</th>";
         echo "</tr>";
         Session::initNavigateListItems(static::getType(),
                           //TRANS : %1$s is the itemtype name,
                           //        %2$s is the name of the item (used for headings of a list)
                                          sprintf(__('%1$s = %2$s'),
                                                $item->getTypeName(1), $item->getName()));

         while ($data = $iterator->next()) {
            echo "<tr class='tab_bg_2' ".
                     ($canedit
                     ? "style='cursor:pointer' onClick=\"viewEditTrigger".$data[static::$items_id]."_".
                        $data['id']."_$rand();\"": '') .">";

            echo "<td>{$data['id']}";
            if ($canedit) {
               echo "\n<script type='text/javascript' >\n";
               echo "function viewEditTrigger" .$data[static::$items_id]."_". $data["id"]. "_$rand() {\n";
               $params = ['type'            => static::getType(),
                              'parenttype'       => static::$itemtype,
                              static::$items_id  => $data[static::$items_id],
                              'id'               => $data["id"]];
               Ajax::updateItemJsCode("viewtrigger".$ID."_$rand",
                                       $CFG_GLPI["root_doc"]."/ajax/viewsubitem.php", $params);
               echo "};";
               echo "</script>\n";
            }
            echo "</td>";
            echo "<td>".$data['target']::getTypeName(1)."</td>";
            echo "<td>".$data['action']."</td>";
            echo "</tr>";
            Session::addToNavigateListItems(static::getType(), $data['id']);
         }
         $colspan = 4;
      } else {
         echo "<tr><th colspan='9'>".__('No item found')."</th></tr>";
      }
      echo "</table>";
      echo "</div><br>";
   }
}
