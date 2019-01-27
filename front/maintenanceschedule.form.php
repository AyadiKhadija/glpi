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

use Glpi\Event;

include ('../inc/includes.php');

Session::checkRight(MaintenanceSchedule::$rightname, READ);

if (empty($_GET['id'])) {
   $_GET['id'] = '';
}

$schedule = new MaintenanceSchedule();
$item_schedule = new Item_MaintenanceSchedule();

if (isset($_POST['add'])) {
   $schedule->check(-1, CREATE, $_POST);
   if ($newID = $schedule->add($_POST)) {
      Event::log($newID, 'maintenance_schedules', 4, 'management',
                 sprintf(__('%1$s adds the item %2$s'), $_SESSION['glpiname'], $_POST['name']));
      if ($_SESSION['glpibackcreated']) {
         Html::redirect($group->getLinkURL());
      }
   }
   Html::back();

} else if (isset($_POST['purge'])) {
   $schedule->check($_POST['id'], PURGE);
   if ($schedule->isUsed()
         && empty($_POST['forcepurge'])) {
      Html::header($schedule->getTypeName(1), $_SERVER['PHP_SELF'], 'management', 'MaintenanceSchedule',
      str_replace('glpi_', '', $schedule->getTable()));

      $schedule->showDeleteConfirmForm($_SERVER['PHP_SELF']);
      Html::footer();
   } else {
      $schedule->delete($_POST, 1);
      Event::log($_POST['id'], 'maintenance_schedules', 4, 'management',
                 //TRANS: %s is the user login
                 sprintf(__('%s purges an item'), $_SESSION['glpiname']));
      $schedule->redirectToList();
   }

} else if (isset($_POST['update'])) {
   $schedule->check($_POST['id'], UPDATE);
   $schedule->update($_POST);
   Event::log($_POST['id'], 'maintenance_schedules', 4, 'management',
              //TRANS: %s is the user login
              sprintf(__('%s updates an item'), $_SESSION['glpiname']));
   Html::back();

} else if (isset($_GET['_in_modal'])) {
   Html::popHeader(Group::getTypeName(Session::getPluralNumber()), $_SERVER['PHP_SELF']);
   $schedule->showForm($_GET['id']);
   Html::popFooter();

} else if (isset($_POST['replace'])) {
   $schedule->check($_POST['id'], PURGE);
   $schedule->delete($_POST, 1);

   Event::log($_POST['id'], 'maintenance_schedules', 4, 'management',
              //TRANS: %s is the user login
              sprintf(__('%s replaces an item'), $_SESSION['glpiname']));
   $schedule->redirectToList();

} else if (isset($_POST['addschedule'])) {
   $item_schedule->check(-1, CREATE, $_POST);
   if ($item_schedule->add($_POST)) {
      Event::log($_POST["maintenanceschedules_id"], "maintenance_schedules", 4, "management",
                 //TRANS: %s is the user login
                 sprintf(__('%s adds a maintenance schedule to an item'), $_SESSION["glpiname"]));
   }
   Html::back();

} else if (isset($_POST['deleteschedule'])) {
   if (count($_POST["item"])) {
      foreach (array_keys($_POST["item"]) as $key) {
         if ($item_schedule->can($key, DELETE)) {
            $item_schedule->delete(['id' => $key]);
         }
      }
   }
   Event::log($_POST["maintenanceschedules_id"], "maintenance_schedules", 4, "management",
              //TRANS: %s is the user login
              sprintf(__('%s deletes maintenance schedules from an item'), $_SESSION["glpiname"]));
   Html::back();

} else {
   Html::header(MaintenanceSchedule::getTypeName(Session::getPluralNumber()), $_SERVER['PHP_SELF'], 'management', 'MaintenanceSchedule');
   $schedule->display(['id' =>$_GET['id']]);
   Html::footer();
}