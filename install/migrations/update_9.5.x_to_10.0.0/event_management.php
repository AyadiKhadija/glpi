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

use Glpi\Siem\Event;

if (!$DB->tableExists('glpi_siems_events')) {
   $query = "CREATE TABLE `glpi_siems_events` (
         `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
         `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
         `date` datetime DEFAULT NULL,
         `content` longtext COLLATE utf8_unicode_ci,
         `date_creation` datetime DEFAULT NULL,
         `significance` tinyint(4) NOT NULL,
         `correlation_id` VARCHAR(23) DEFAULT NULL,
         `date_mod` datetime DEFAULT NULL,
         `siems_services_id` int(11) NOT NULL,
         PRIMARY KEY (`id`),
         KEY `name` (`name`),
         KEY `date` (`date`),
         KEY `date_creation` (`date_creation`),
         KEY `significance` (`significance`),
         KEY `correlation_id` (`correlation_id`),
         KEY `siems_services_id` (`siems_services_id`)
         ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
   $DB->queryOrDie($query, "10.0.0 add table glpi_siems_events");
}

if (!$DB->tableExists('glpi_siems_itils_events')) {
   $query = "CREATE TABLE `glpi_siems_itils_events` (
         `id` int(11) NOT NULL AUTO_INCREMENT,
         `itemtype` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
         `items_id` int(11) NOT NULL DEFAULT '0',
         `plugin_siems_events_id` int(11) unsigned NOT NULL DEFAULT '0',
         PRIMARY KEY (`id`)
         ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
   $DB->queryOrDie($query, "10.0.0 add table glpi_siems_itils_events");
}

if (!$DB->tableExists('glpi_siems_hosts')) {
   $query = "CREATE TABLE `glpi_siems_hosts` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `itemtype` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
      `items_id` int(11) NOT NULL,
      `siems_services_id_availability` int(11) DEFAULT NULL,
      `is_reachable` tinyint(1) NOT NULL DEFAULT '1',
      `date_mod` timestamp NULL DEFAULT NULL,
      `date_creation` timestamp NULL DEFAULT NULL,
      PRIMARY KEY (`id`),
      KEY `item` (`items_id`,`itemtype`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
   $DB->queryOrDie($query, "10.0.0 add table glpi_siems_hosts");
}

if (!$DB->tableExists('glpi_siems_services')) {
   $query = "CREATE TABLE `glpi_siems_services` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `siems_hosts_id` int(11) NOT NULL DEFAULT -1,
      `siems_servicetemplates_id` int(11) NOT NULL,
      `last_check` timestamp NULL DEFAULT NULL,
      `status` tinyint(3) NOT NULL DEFAULT '2',
      `is_hard_status` tinyint(1) NOT NULL DEFAULT '1',
      `status_since` timestamp NULL DEFAULT NULL,
      `is_flapping` tinyint(1) NOT NULL DEFAULT '0',
      `is_active` tinyint(1) NOT NULL DEFAULT '1',
      `flap_state_cache` longtext COLLATE utf8_unicode_ci,
      `current_check` int(11) NOT NULL DEFAULT '0',
      `suppress_informational` tinyint(1) NOT NULL DEFAULT '0',
      `is_acknowledged` tinyint(1) NOT NULL DEFAULT '0',
      `date_mod` timestamp NULL DEFAULT NULL,
      `date_creation` timestamp NULL DEFAULT NULL,
      PRIMARY KEY (`id`),
      KEY `siems_servicetemplates_id` (`siems_servicetemplates_id`),
      KEY `plugin_siems_hosts_id` (`siems_hosts_id`),
      KEY `is_flapping` (`is_flapping`),
      KEY `is_acknowledged` (`is_acknowledged`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
   $DB->queryOrDie($query, "10.0.0 add table glpi_siems_services");
}

if (!$DB->tableExists('glpi_siems_servicetemplates')) {
   $query = "CREATE TABLE `glpi_siems_servicetemplates` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
      `comment` text COLLATE utf8_unicode_ci DEFAULT NULL,
      `priority` tinyint(3) NOT NULL DEFAULT 3,
      `calendars_id` int(11) DEFAULT NULL,
      `notificationinterval` int(11) DEFAULT NULL,
      `check_interval` int(11) DEFAULT NULL COMMENT 'Ignored when check_mode is passive',
      `use_flap_detection` tinyint(1) NOT NULL DEFAULT '0',
      `check_mode` tinyint(3) NOT NULL DEFAULT '0',
      `plugins_id` int(11) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Indicates which plugin (or the core) logged this event. Used to delegate translations and other functions',
      `sensor` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
      `is_stateless` tinyint(1) NOT NULL DEFAULT '0',
      `flap_threshold_low` tinyint(3) NOT NULL DEFAULT '15',
      `flap_threshold_high` tinyint(3) NOT NULL DEFAULT '30',
      `max_checks` tinyint(3) NOT NULL DEFAULT '1',
      `date_mod` timestamp NULL DEFAULT NULL,
      `date_creation` timestamp NULL DEFAULT NULL,
      PRIMARY KEY (`id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
   $DB->queryOrDie($query, "10.0.0 add table glpi_siems_servicetemplates");
}

$migration->addConfig([
   'default_event_filter_action' => 0
], 'core');

CronTask::register(Event::class, 'pollevents', 60, [
   'state' => CronTask::STATE_WAITING
]);
