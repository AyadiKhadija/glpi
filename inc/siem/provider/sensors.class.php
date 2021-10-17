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

namespace Glpi\Siem\Provider;

use Glpi\Siem\Provider\Sensor\Core;
use Glpi\Siem\Provider\Sensor\SensorProviderInterface;

final class Sensors {

   public static function getDefaultProviders(): array {
      return [
         Core::class
      ];
   }

   public static function getPluginProviders(): array {
      global $PLUGIN_HOOKS;
      $plugin_providers = [];

      if (isset($PLUGIN_HOOKS['siem_sensor_providers'])) {
         foreach ($PLUGIN_HOOKS['siem_sensor_providers'] as $plugin => $providers) {
            /** @noinspection SlowArrayOperationsInLoopInspection */
            $plugin_providers = array_merge($plugin_providers, $providers);
         }
      }
      return $plugin_providers;
   }

   public static function getSensors(): ?array {
      static $sensors = null;

      if ($sensors === null) {
         $sensors = [];
         $providers = self::getDefaultProviders();
         $providers = array_merge($providers, self::getPluginProviders());
         /** @var SensorProviderInterface $provider */
         foreach ($providers as $provider) {
            /** @noinspection SlowArrayOperationsInLoopInspection */
            $sensors = array_merge($sensors, $provider::getSensors());
         }
      }

      return $sensors;
   }

   public static function getSensor(string $sensor): array {
      return self::getSensors()[$sensor];
   }

   public static function getDropdownItems() {
      $sensors = self::getSensors();
      return array_diff(array_combine(array_keys($sensors), array_column($sensors, 'name')), [null]);
   }
}
