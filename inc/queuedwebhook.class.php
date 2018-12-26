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


/** QueuedWebhook class
 *
 * @since 10.0.0
**/
class QueuedWebhook extends CommonDBTM {

   static $rightname = 'queuedwebhook';

   static function getTypeName($nb = 0) {
      return __('Webhook queue');
   }

   static function canCreate() {
      // Everybody can create : human and cron
      return Session::getLoginUserID(false);
   }

   static function getForbiddenActionsForMenu() {
      return ['add'];
   }

   function getForbiddenStandardMassiveAction() {

      $forbidden   = parent::getForbiddenStandardMassiveAction();
      $forbidden[] = 'update';
      return $forbidden;
   }

   function getSpecificMassiveActions($checkitem = null, $is_deleted = false) {

      $isadmin = static::canUpdate();
      $actions = parent::getSpecificMassiveActions($checkitem);

      if ($isadmin && !$is_deleted) {
         $actions[__CLASS__.MassiveAction::CLASS_ACTION_SEPARATOR.'sendwebhook'] = _x('button', 'Send');
      }

      return $actions;
   }

   static function processMassiveActionsForOneItemtype(MassiveAction $ma, CommonDBTM $item,
                                                       array $ids) {
      switch ($ma->getAction()) {
         case 'sendwebhook' :
            foreach ($ids as $id) {
               if ($item->canEdit($id)) {
                  if ($item->sendById($id)) {
                     $ma->itemDone($item->getType(), $id, MassiveAction::ACTION_OK);
                  } else {
                     $ma->itemDone($item->getType(), $id, MassiveAction::ACTION_KO);
                  }
               } else {
                  $ma->itemDone($item->getType(), $id, MassiveAction::ACTION_NORIGHT);
               }
            }
            return;
      }
      parent::processMassiveActionsForOneItemtype($ma, $item, $ids);
   }

   function prepareInputForAdd($input) {
      global $DB;

      if (!isset($input['create_time']) || empty($input['create_time'])) {
         $input['create_time'] = $_SESSION["glpi_currenttime"];
      }
      if (!isset($input['send_time']) || empty($input['send_time'])) {
         $input['send_time'] = $_SESSION["glpi_currenttime"];
      }
      $input['sent_try'] = 0;

      return $input;
   }

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

      $tab[] = [
         'id'                 => '16',
         'table'              => $this->getTable(),
         'field'              => 'create_time',
         'name'               => __('Creation date'),
         'datatype'           => 'datetime',
         'massiveaction'      => false
      ];

      $tab[] = [
         'id'                 => '3',
         'table'              => $this->getTable(),
         'field'              => 'send_time',
         'name'               => __('Expected send date'),
         'datatype'           => 'datetime',
         'massiveaction'      => false
      ];

      $tab[] = [
         'id'                 => '4',
         'table'              => $this->getTable(),
         'field'              => 'sent_time',
         'name'               => __('Send date'),
         'datatype'           => 'datetime',
         'massiveaction'      => false
      ];

      $tab[] = [
         'id'                 => '11',
         'table'              => $this->getTable(),
         'field'              => 'url',
         'name'               => __('URL'),
         'datatype'           => 'string',
         'massiveaction'      => false
      ];

      $tab[] = [
         'id'                 => '12',
         'table'              => $this->getTable(),
         'field'              => 'payload',
         'name'               => __('Payload'),
         'datatype'           => 'text',
         'massiveaction'      => false,
         'htmltext'           => true
      ];

      $tab[] = [
         'id'                 => '15',
         'table'              => $this->getTable(),
         'field'              => 'sent_try',
         'name'               => __('Number of tries of sent'),
         'datatype'           => 'integer',
         'massiveaction'      => false
      ];

      $tab[] = [
         'id'                 => '80',
         'table'              => 'glpi_entities',
         'field'              => 'completename',
         'name'               => __('Entity'),
         'massiveaction'      => false,
         'datatype'           => 'dropdown'
      ];

      return $tab;
   }

   /**
    * Give cron information
    *
    * @param $name : task's name
    *
    * @return arrray of information
   **/
   static function cronInfo($name) {

      switch ($name) {
         case 'queuedwebhook' :
            return ['description' => __('Send webhooks in queue'),
                         'parameter'   => __('Maximum webhooks to send at once')];
         case 'queuedwebhookclean' :
            return ['description' => __('Clean webhook queue'),
                         'parameter'   => __('Days to keep sent webhooks')];
      }
      return [];
   }

   /**
    * Get pending webhooks in queue
    *
    * @param string  $send_time   Maximum sent_time
    * @param integer $limit       Query limit clause
    * @param array   $extra_where Extra params to add to the where clause
    *
    * @return array
    */
   static public function getPendings($send_time = null, $limit = 20, $extra_where = []) {
      global $DB;

      if ($send_time === null) {
         $send_time = date('Y-m-d H:i:s');
      }

      $pendings = $DB->request([
         'FROM'   => self::getTable(),
         'WHERE'  => [
            'is_deleted'   => 0,
            'send_time'    => ['<', $send_time],
         ] +  $extra_where,
         'ORDER'  => 'send_time ASC',
         'START'  => 0,
         'LIMIT'  => $limit
      ]);

      return $pendings;
   }

   /**
    * Cron action on webhook queue: send webhooks in queue
    *
    * @param CommonDBTM $task for log (default NULL)
    *
    * @return integer either 0 or 1
   **/
   static function cronQueuedWebhook($task = null) {
      $cron_status = 0;

      // Send notifications at least 1 minute after adding in queue to be sure that process on it is finished
      $send_time = date("Y-m-d H:i:s", strtotime("+1 minutes"));

      $pendings = self::getPendings(
         $send_time,
         $task->fields['param']
      );

      $queued = new self();
      foreach ($pendings as $data) {
         $queued->getFromDB($data['id']);
         $queued->update([
             'id' => $data['id'],
             'sent_try' => $queued->fields['sent_try'] + 1
         ]);
         $result = Webhook::sendWebhookData($data['url'], $data['payload']);
         if ($result !== false) {
            $queued->delete(['id' => $data['id']]);
            $cron_status = 1;
            if (!is_null($task)) {
               $task->addVolume($result);
            }
         }
      }

      return $cron_status;
   }

   /**
    * Cron action on queued webhook: clean webhook queue
    *
    * @param CommonDBTM $task for log (default NULL)
    *
    * @return integer either 0 or 1
   **/
   static function cronQueuedWebhookClean($task = null) {
      global $DB;

      $vol = 0;

      // Expire webhooks in queue
      if ($task->fields['param'] > 0) {
         $secs      = $task->fields['param'] * DAY_TIMESTAMP;
         $send_time = date("U") - $secs;
         $vol = $DB->delete(
            self::getTable(), [
               'is_deleted'   => 1,
               new \QueryExpression('UNIX_TIMESTAMP('.$DB->quoteName('send_time').') < '.$DB->quoteValue($send_time).')')
            ]
         );
      }

      $task->setVolume($vol);
      return ($vol > 0 ? 1 : 0);
   }

   /**
    * Send webhook in queue
    *
    * @param integer $ID Id
    *
    * @return boolean
    */
   public function sendById($ID) {
      if ($this->getFromDB($ID)) {
         return Webhook::sendWebhookData($this->fields['url'], $this->fields['payload']);
      } else {
         return false;
      }
   }

   /**
    * Print the queued webhook form
    *
    * @param integer $ID      ID of the item
    * @param array   $options Options
    *
    * @return true if displayed  false if item not found or not right to display
   **/
   function showForm($ID, $options = []) {
      global $CFG_GLPI;

      if (!Session::haveRight("queuedwebhook", READ)) {
         return false;
      }

      $this->check($ID, READ);
      $options['canedit'] = false;

      $this->showFormHeader($options);
      echo "<tr class='tab_bg_1'>";
      echo "<td>".__('Creation date')."</td>";
      echo "<td>";
      echo Html::convDateTime($this->fields['create_time']);
      echo "</td><td>".__('Expected send date')."</td>";
      echo "<td>".Html::convDateTime($this->fields['send_time'])."</td>";
      echo "</tr>";

      echo "<tr class='tab_bg_1'>";
      echo "<td>".__('Send date')."</td>";
      echo "<td>".Html::convDateTime($this->fields['sent_time'])."</td>";
      echo "<td>".__('Number of tries of sent')."</td>";
      echo "<td>".$this->fields['sent_try']."</td>";
      echo "</tr>";

      echo "<tr><th colspan='4'>".__('Webhook')."</th></tr>";
      echo "<tr class='tab_bg_1'>";
      echo "<td>".__('URL')."</td>";
      echo "<td>".$this->fields['url']."</td>";
      echo "<td>".__('Payload')."</td>";
      echo "<td>".htmlentities($this->fields['payload'])."</td>";
      echo "</tr>";

      $this->showFormButtons($options);

      return true;
   }
}