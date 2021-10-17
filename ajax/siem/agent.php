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

use Glpi\Siem\Provider\Agents;

$AJAX_INCLUDE = 1;
include ('../../inc/includes.php');

Session::checkLoginUser();
Html::header_nocache();

header("Content-Type: application/json; charset=UTF-8");
$path_info = explode('/', ltrim($_SERVER['PATH_INFO'] ?? '', '/'));

if (empty($path_info) || $path_info == ['']) {
   if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      $sensor_filter = $_GET['sensor'] ?? null;
      $agents = Agents::getDropdownItems($sensor_filter);
      try {
         echo json_encode($agents, JSON_THROW_ON_ERROR);
         die();
      } catch (JsonException $e) {
         http_response_code(500);
         die();
      }
   }
}
http_response_code(400);
die();
