<?php
/**
 * ---------------------------------------------------------------------
 * GLPI - Gestionnaire Libre de Parc Informatique
 * Copyright (C) 2015-2021 Teclib' and contributors.
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
 * @var DB $DB
 * @var Migration $migration
 */

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
      `date_creation` TIMESTAMP NULL DEFAULT NULL,
      `date_mod` TIMESTAMP NULL DEFAULT NULL,
      `is_plaintextpayload` tinyint(1) NOT NULL DEFAULT '1',
      PRIMARY KEY (`id`)
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
   $DB->queryOrDie($query, "10.0.0 add table glpi_webhooks");
}

//Add webhook triggers table
if (!$DB->tableExists('glpi_webhooktriggers')) {
   $query = "CREATE TABLE `glpi_webhooktriggers` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `webhooks_id` int(11) NOT NULL,
      `itemtype` varchar(100) NOT NULL,
      `action` varchar(255) NOT NULL,
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
      `date_creation` TIMESTAMP NULL DEFAULT NULL,
      `date_send` TIMESTAMP NULL DEFAULT NULL,
      `date_sent` TIMESTAMP NULL DEFAULT NULL,
      `sent_try` int(11) NOT NULL DEFAULT '0',
      `entities_id` int(11) NOT NULL DEFAULT '0',
      `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
      PRIMARY KEY (`id`)
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
   $DB->queryOrDie($query, "10.0.0 add table glpi_queuedwebhooks");
}

CronTask::register(QueuedWebhook::class, 'queuedwebhook', 60, [
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
]);

CronTask::register(QueuedWebhook::class, 'queuedwebhookclean', 86400, [
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
]);

$migration->addRight('webhook');
$migration->addRight('queuedwebhook');
