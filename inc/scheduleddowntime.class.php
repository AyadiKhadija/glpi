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
 * ScheduledDowntime class.
 * This represents a period of time when a host or service will be down and all alerts during that time can be ignored.
 *
 * @since 10.0.0
 */
class ScheduledDowntime extends CommonDBTM {

   /**
    * Name of the type
    *
    * @param $nb : number of item in the type
   **/
   static function getTypeName($nb = 0) {
      return _n('Scheduled Downtime', 'Scheduled Downtimes', $nb);
   }

   public static function isHostScheduledDown(int $hosts_id) {
      global $DB;

      $downtimetable = self::getTable();
      $now = $_SESSION['glpi_currenttime'];

      $iterator = $DB->request([
         'SELECT' => [
            'COUNT'  => ['glpi_scheduleddowntimes.id AS cpt']
         ],
         'FROM'   => $downtimetable,
         'LEFT JOIN' => [
            ITILEventHost::getTable()  => 'id',
            $downtimetable             => 'items_id_target'
         ],
         'WHERE'  => [
            "$downtimetable.items_id_target" => $hosts_id,
            "$downtimetable.is_service"      => 1,
            $now  => ['<=', 'end_date'],
            $now  => ['>=', 'begin_date']
         ]
      ]);

      return $iterator->next()['cpt'] > 0;
   }

   public static function isServiceScheduledDown(int $services_id) {
      global $DB;

      $service = new ITILEventService();
      $service->getFromDB($services_id);

      if ($service->fields['hosts_id'] >= 0) {
         // If the host is scheduled to be down, the service is too
         if (self::isHostScheduledDown($service->fields['hosts_id'])) {
            return true;
         }
      }

      $downtimetable = self::getTable();
      $now = $_SESSION['glpi_currenttime'];

      $iterator = $DB->request([
         'SELECT' => [
            'COUNT'  => ['glpi_scheduleddowntimes.id AS cpt']
         ],
         'FROM'   => $downtimetable,
         'LEFT JOIN' => [
            ITILEventService::getTable()  => 'id',
            $downtimetable                => 'items_id_target'
         ],
         'WHERE'  => [
            "$downtimetable.items_id_target" => $services_id,
            "$downtimetable.is_service"      => 1,
            $now  => ['<=', 'end_date'],
            $now  => ['>=', 'begin_date']
         ]
      ]);

      return $iterator->next()['cpt'] > 0;
   }
}