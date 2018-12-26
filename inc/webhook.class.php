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
 * Webhook Class
 *
 * @since 10.0.0
**/
class Webhook extends CommonDBTM {

   static $rightname = 'webhook';

   static $tags = ['[ITEMTYPE]', '[ACTION]'];

   //TODO Fix/Add historical for Webhook

   static function getTypeName($nb = 0) {
      return _n('Webhook', 'Webhooks', $nb);
   }

   function defineTabs($options = []) {

      $ong = [];
      $this->addDefaultFormTab($ong);
      $this->addStandardTab(__CLASS__, $ong, $options);
      $this->addStandardTab('Log', $ong, $options);

      return $ong;
   }

   function getTabNameForItem(CommonGLPI $item, $withtemplate = 0) {

      if (!$withtemplate) {
         switch ($item->getType()) {
            case 'Webhook' :
               $ong[2] = __('Webhook Triggers');
               return $ong;
         }
      }
      return '';
   }

   static function displayTabContentForItem(CommonGLPI $item, $tabnum = 1, $withtemplate = 0) {

      if ($item->getType() == __CLASS__) {
         switch ($tabnum) {
            case 2 :
               WebhookTrigger::showForWebhook($item);
               break;
         }
      }
      return true;
   }

   public static function canView() {
      return Session::haveRight(self::$rightname, READ);
   }

   public static function canUpdate() {
      return Session::haveRight(self::$rightname, UPDATE);
   }

   public static function canCreate() {
      return Session::haveRight(self::$rightname, CREATE);
   }

   public static function canPurge() {
      return Session::haveRight(self::$rightname, PURGE);
   }

   public function canViewItem() {
      if (!$this->checkEntity()) {
         return false;
      }
      return Session::haveRight(self::$rightname, READ);
   }

   public function canUpdateItem() {
      if (!$this->checkEntity()) {
         return false;
      }
      return Session::haveRight(self::$rightname, UPDATE);
   }

   public function canCreateItem() {
      if (!$this->checkEntity()) {
         return false;
      }
      return Session::haveRight(self::$rightname, CREATE);
   }

   public function canPurgeItem() {
      if (!$this->checkEntity()) {
         return false;
      }
      return Session::haveRight(self::$rightname, PURGE);
   }

   function cleanDBonPurge() {
      $this->deleteChildrenAndRelationsFromDb(
         [
            WebhookTrigger::class,
         ]
      );

      parent::cleanDBonPurge();

   }

   function getRights($interface = 'central') {

      if ($interface != 'central') {
         return [];
      }

      return [
         READ => __('Read'),
         UPDATE => __('Update'),
         CREATE => __('Create'),
         PURGE => __('Purge'),
      ];
   }

   /**
    * Send all webhooks that are triggered by the specified action
    * @param type $item The item that triggered the action
    * @param type $action The action that was triggered
    * @return void
    * @since 10.0.0
    */
   public static function postWebhookAction($item, $action) {
      global $DB;

      $iterator = $DB->request([
         'SELECT' => [
            'glpi_webhooks.id',
            'entities_id'
         ],
         'FROM'   => 'glpi_webhooks',
         'LEFT JOIN' => [
            'glpi_webhooktriggers' => [
               'FKEY' => [
                  'glpi_webhooktriggers' => 'webhooks_id',
                  'glpi_webhooks' => 'id'
               ]
            ]
         ],
         'WHERE'  => [
            'target'  => $item->getType(),
            'action'  => $action,
            'entities_id' => $item->fields['entities_id']
         ],
      ]);

      $webhook = new Webhook();
      while ($data = $iterator->next()) {
         $webhook->getFromDB($data['id']);
         if ($webhook->fields['is_active']) {
            $webhook->postWebhook($item, $action);
         }
      }
   }

   /**
    * Posts this webhook for a specific item
    * @since 10.0.0
    * @param object  $item The item that generated the webhook call
    *                   - Can be null to send a static payload
    * @param string  $action The action that triggered this call.
    *                   - Default is null (Not specified)
    * @return boolean True if the webhook request was successfully queued
   */
   public function postWebhook($item, $action = null) {

      //TODO Improve link tags or use a seperate system. Maybe add ACTION and FORM_URL tags
      if ($item != null) {
         $url = $this->fields['url'];
         $payload = $this->fields['payload'];
         //Process webhook-specific tags
         if (strstr($url, "[ITEMTYPE]")) {
            $url = str_replace("[ITEMTYPE]", $item->getTypeName(1), $url);
         }
         if (strstr($payload, "[ITEMTYPE]")) {
            $payload = str_replace("[ITEMTYPE]", $item->getTypeName(1), $payload);
         }
         if ($action == null) {
            $action = __('Unspecified');
         }
         if (strstr($url, "[ACTION]")) {
            $url = str_replace("[ACTION]", $action, $url);
         }
         if (strstr($payload, "[ACTION]")) {
            $payload = str_replace("[ACTION]", $action, $payload);
         }
         if (strstr($payload, "[FORM_URL]")) {
            $payload = str_replace("[FORM_URL]", $item->getFormURLWithID(), $payload);
         }
         $url = Link::generateLinkContents($url, $item)[0];
         $payload = Link::generateLinkContents($payload, $item)[0];
      } else {
         $url = $this->fields['url'];
         $payload = $this->fields['payload'];
      }

      if ($this->fields['is_plaintextpayload']) {
         $payload = strip_tags(html_entity_decode($payload));
      }

      $queued = new QueuedWebhook();
      return $queued->add([
          'url' => $url,
          'payload' => $payload,
          'entities_id' => $this->fields['entities_id']
      ]);
   }

   /**
    * Sends a webhook without queuing or processing the url or payload
    * @param string $url The URL to send the webhook data to
    * @param string $payload The JSON webhook payload
    * @return type
    */
   public static function sendWebhookData(string $url, string $payload) {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
      curl_setopt($ch, CURLOPT_TIMEOUT, 10);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      //TODO Support other payload types (XML)
      curl_setopt($ch, CURLOPT_HTTPHEADER, [                                                                          
         'Content-Type: application/json',                                                                                
         'Content-Length: ' . strlen($payload)
      ]); 
      $result = curl_exec($ch);
      curl_close ($ch);
      return $result;
   }
   /**
    * Print the webhook form.
    *
    * @param integer $ID      ID of the webhook
    * @param array   $options Options
    * @see CommonDBTM::showFormButtons() For valid options parameter values
    * @return boolean true if user found, false otherwise
    */
   function showForm($ID, array $options = []) {

      if (!self::canViewItem($ID)) {
         return false;
      }

      $this->initForm($ID, $options);
      $this->showFormHeader($options);

      $rand = mt_rand();

      echo "<tr class='tab_bg_1'>";
      echo "<td><label for='name'>" . __('Name') . "</label></td><td>";
      Html::autocompletionTextField($this, "name");
      echo "</td>";
      echo "<td rowspan='2'>".__('Comments')."</td>";
      echo "<td rowspan='2'>";
      Html::textarea([
         'name' => 'comment',
         'cols'   => 45,
         'rows'   => 8,
         'value'  => $this->fields['comment']
      ]);
      echo "</td></tr>";

      echo "<tr class='tab_bg_1'>";
      echo "<td><label for='url'>" . __('URL') . "</label></td><td>";
      Html::autocompletionTextField($this, "url");
      echo "</td></tr>";

      echo "<tr class='tab_bg_1'>";
      echo "<td>".__('Payload')."</td><td>";
      Html::textarea([
         'name' => 'payload',
         'cols'   => 45,
         'rows'   => 2,
         'value'  => $this->fields['payload']
      ]);
      echo "</td><td><label for='is_active'>" . __('Is active') . "</label></td><td>";
      Dropdown::showYesNo('is_active', $this->fields['is_active']);
      echo "</td></tr>";

      echo "<tr class='tab_bg_1'>";
      echo "<td><label for='is_plaintextpayload'>" . __('Use plaintext payload') . "</label></td><td>";
      Dropdown::showYesNo('is_plaintextpayload', $this->fields['is_plaintextpayload']);
      echo "</td></tr>";

      $this->showFormButtons($options);

      return true;
   }
}
