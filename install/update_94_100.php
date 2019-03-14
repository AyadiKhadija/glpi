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

use Glpi\Application\LocalConfigurationManager;
use Glpi\ConfigParams;
use Symfony\Component\PropertyAccess\PropertyAccessor;
use Symfony\Component\Yaml\Yaml;

/**
 * Update from 9.4 to 10.0
 *
 * @return bool for success (will die for most error)
**/
function update94to100() {
   global $DB, $migration, $CFG_GLPI;
   $dbutils = new DbUtils();

   $current_config   = Config::getConfigurationValues('core');
   $updateresult     = true;
   $ADDTODISPLAYPREF = [];
   $config_to_drop = [];

   //TRANS: %s is the number of new version
   $migration->displayTitle(sprintf(__('Update to %s'), '10.0.0'));
   $migration->setVersion('10.0.0');

   /** Add main column on displaypreferences */
   if ($migration->addField(
         'glpi_displaypreferences',
         'is_main',
         'bool',
         ['value' => 1]
      )) {
      $migration->addKey('glpi_displaypreferences', 'is_main');
      $migration->dropKey('glpi_displaypreferences', 'unicity');
      $migration->migrationOneTable('glpi_displaypreferences');
      $migration->addKey(
         'glpi_displaypreferences',
         ['users_id', 'itemtype', 'num', 'is_main'],
         'unicity',
         'UNIQUE'
      );
   }

   /** add display preferences for sub items */
   $ADDTODISPLAYPREF['Contract'] = [3, 4, 29, 5];
   $ADDTODISPLAYPREF['Item_Disk'] = [2, 3, 4, 5, 6, 7, 8];
   $ADDTODISPLAYPREF['Certificate'] = [7, 4, 8, 121, 10, 31];
   $ADDTODISPLAYPREF['Notepad'] = [200, 201, 202, 203, 204];
   $ADDTODISPLAYPREF['SoftwareVersion'] = [3, 31, 2, 122, 123, 124];
   foreach ($ADDTODISPLAYPREF as $type => $tab) {
      $rank = 1;
      foreach ($tab as $newval) {
         $query = "REPLACE INTO `glpi_displaypreferences`
                           (`itemtype` ,`num` ,`rank` ,`users_id`, `is_main`)
                     VALUES ('$type', '$newval', '".$rank++."', '0', '0')";
         $DB->query($query);
      }
   }

   //Add over-quota option to software licenses to allow assignment after all alloted licenses are used
   if (!$DB->fieldExists('glpi_softwarelicenses', 'allow_overquota')) {
      if ($migration->addField('glpi_softwarelicenses', 'allow_overquota', 'bool')) {
         $migration->addKey('glpi_softwarelicenses', 'allow_overquota');
      }
   }

   /** Encrypted FS support  */
   if (!$DB->fieldExists("glpi_items_disks", "encryption_status")) {
      $migration->addField("glpi_items_disks", "encryption_status", "integer", [
            'after'  => "is_dynamic",
            'value'  => 0
         ]
      );
   }

   if (!$DB->fieldExists("glpi_items_disks", "encryption_tool")) {
      $migration->addField("glpi_items_disks", "encryption_tool", "string", [
            'after'  => "encryption_status"
         ]
      );
   }

   if (!$DB->fieldExists("glpi_items_disks", "encryption_algorithm")) {
      $migration->addField("glpi_items_disks", "encryption_algorithm", "string", [
            'after'  => "encryption_tool"
         ]
      );
   }

   if (!$DB->fieldExists("glpi_items_disks", "encryption_type")) {
      $migration->addField("glpi_items_disks", "encryption_type", "string", [
            'after'  => "encryption_algorithm"
         ]
      );
   }
   /** /Encrypted FS support  */

   /** move cache configuration into local configuration file */
   try {
      $localConfigManager = new LocalConfigurationManager(
         GLPI_CONFIG_DIR,
         new PropertyAccessor(),
         new Yaml()
      );
      $localConfigManager->setCacheValuesFromLegacyConfig(new ConfigParams($CFG_GLPI), GLPI_CACHE_DIR);
      $localConfigManager->setParameterValue('[cache_uniq_id]', uniqid(), false);
      $config_to_drop[] = 'cache_db';
      $config_to_drop[] = 'cache_trans';
   } catch (\Exception $exception) {
      $migration->displayWarning(
          sprintf(
              __('Unable to write cache configuration into local configuration file. Message was: "%s".'),
              $exception->getMessage()
          )
      );
   }
   /** /move cache configuration into local configuration file */

   //Add webhooks table
   if (!$DB->tableExists('glpi_webhooks')) {
      $query = "CREATE TABLE `glpi_webhooks` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `entities_id` int(11) NOT NULL DEFAULT '0',
                  `name` varchar(255) NOT NULL,
                  `comment` text,
                  `url` varchar(255) NOT NULL,
                  `payload` text NOT NULL,
                  `is_recursive` tinyint(1) NOT NULL DEFAULT '0',
                  `is_active` tinyint(1) NOT NULL DEFAULT '0',
                  `date_creation` datetime DEFAULT NULL,
                  `date_mod` datetime DEFAULT NULL,
                  `is_plaintextpayload` tinyint(1) NOT NULL DEFAULT '1',
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
      $DB->queryOrDie($query, "10.0.0 add table glpi_webhooks");
   }

   //Add webhook triggers table
   if (!$DB->tableExists('glpi_webhooktriggers')) {
      $query = "CREATE TABLE `glpi_webhooktriggers` (
                 `id` INT(11) NOT NULL,
                 `webhooks_id` INT(11) NOT NULL,
                 `itemtype` VARCHAR(100) NOT NULL,
                 `action` VARCHAR(255) NOT NULL,
                 PRIMARY KEY (`id`),
                 KEY `webhookaction` (`itemtype`,`webhooks_id`,`action`)
               ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
      $DB->queryOrDie($query, "10.0.0 add table glpi_webhooktriggers");
   }

   if (!$DB->tableExists('glpi_queuedwebhooks')) {
      $query = "CREATE TABLE `glpi_queuedwebhooks` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `payload` text NOT NULL,
                  `url` varchar(255) NOT NULL,
                  `date_creation` datetime,
                  `date_send` datetime,
                  `date_sent` datetime,
                  `sent_try` int(11) NOT NULL DEFAULT '0',
                  `entities_id` int(11) NOT NULL DEFAULT '0',
                  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
      $DB->queryOrDie($query, "10.0.0 add table glpi_queuedwebhooks");
   }

   $DB->updateOrInsert("glpi_crontasks", [
      'frequency'       => "60",
      'param'           => "50",
      'state'           => "1",
      'mode'            => "1",
      'allowmode'       => "3",
      'hourmin'         => "0",
      'hourmax'         => "24",
      'logs_lifetime'   => "30",
      'lastrun'         => null,
      'lastcode'        => null,
      'comment'         => null
   ], [
      'itemtype'  => "QueuedWebhook",
      'name'      => "queuedwebhook"
   ]);

   $DB->updateOrInsert("glpi_crontasks", [
      'frequency'       => "86400",
      'param'           => "30",
      'state'           => "1",
      'mode'            => "1",
      'allowmode'       => "3",
      'hourmin'         => "0",
      'hourmax'         => "24",
      'logs_lifetime'   => "10",
      'lastrun'         => null,
      'lastcode'        => null,
      'comment'         => null
   ], [
      'itemtype'  => "QueuedWebhook",
      'name'      => "queuedwebhookclean"
   ]);

   $migration->addRight('webhook');
   $migration->addRight('queuedwebhook');

   // ************ Keep it at the end **************
   Config::deleteConfigurationValues('core', $config_to_drop);

   $migration->executeMigration();

   return $updateresult;
}
