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
 * ITILEventService class.
 * This represents a software, service, or metric on a host device that is able to be monitored.
 *
 * @since 10.0.0
 */
class ITILEventService extends CommonDBTM {

   /**
    * Name of the type
    *
    * @param $nb : number of item in the type
   **/
   static function getTypeName($nb = 0) {
      return _n('Service', 'Services', $nb);
   }

   public function post_getFromDB() {
      $template = new ITILEventServiceTemplate();
      $template->getFromDB($this->fields['itileventservicetemplates_id']);
      foreach($template->fields as $field => $value) {
         if ($field !== 'id' && $value > -2) {
            $this->fields[$field] = $value;
         }
      }
   }

   public function isScheduledDown() {
      return ScheduledDowntime::isServiceScheduledDown($this->getID());
   }

   public function getActiveAlerts() {
      global $DB;

   }

   public function isHostless() {
      return $this->fields['hosts_id'] < 0;
   }
}