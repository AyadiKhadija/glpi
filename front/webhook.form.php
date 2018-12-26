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

if (empty($_GET["id"])) {
   $_GET["id"] = "";
}

$webhook = new Webhook();

if (isset($_POST["add"])) {
   $webhook->check(-1, CREATE, $_POST);

   // Pas de nom pas d'ajout
   if (!empty($_POST["name"])
       && ($newID = $webhook->add($_POST))) {
      Event::log($newID, "webhooks", 4, "setup",
                 sprintf(__('%1$s adds the item %2$s'), $_SESSION["glpiname"], $_POST["name"]));
      if ($_SESSION['glpibackcreated']) {
         Html::redirect($webhook->getLinkURL());
      }
   }
   Html::back();

} else if (isset($_POST["delete"])) {
   $webhook->check($_POST['id'], DELETE);
   $webhook->delete($_POST);
   Event::log($_POST["id"], "webhooks", 4, "setup",
              //TRANS: %s is the user login
              sprintf(__('%s deletes an item'), $_SESSION["glpiname"]));
   $webhook->redirectToList();

} else if (isset($_POST["purge"])) {
   $webhook->check($_POST['id'], PURGE);
   $webhook->delete($_POST, 1);
   Event::log($_POST["id"], "webhooks", 4, "setup",
              sprintf(__('%s purges an item'), $_SESSION["glpiname"]));
   $webhook->redirectToList();

} else if (isset($_POST["update"])) {
   $webhook->check($_POST['id'], UPDATE);
   $webhook->update($_POST);
   Event::log($_POST['id'], "webhooks", 5, "setup",
              //TRANS: %s is the user login
              sprintf(__('%s updates an item'), $_SESSION["glpiname"]));
   Html::back();

} else {
   Session::checkRight("webhook", READ);
   Html::header(Webhook::getTypeName(Session::getPluralNumber()), '', "config", "webhook");
   $webhook->display(['id' => $_GET["id"]]);
   Html::footer();
}
