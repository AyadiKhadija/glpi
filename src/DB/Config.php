<?php

/**
 * ---------------------------------------------------------------------
 *
 * GLPI - Gestionnaire Libre de Parc Informatique
 *
 * http://glpi-project.org
 *
 * @copyright 2015-2022 Teclib' and contributors.
 * @copyright 2003-2014 by the INDEPNET Development Team.
 * @licence   https://www.gnu.org/licenses/gpl-3.0.html
 *
 * ---------------------------------------------------------------------
 *
 * LICENSE
 *
 * This file is part of GLPI.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 *
 * ---------------------------------------------------------------------
 */

namespace Glpi\DB;

use Doctrine\DBAL\Connections\PrimaryReadReplicaConnection;

class Config
{
    public static function createMainConfig(string $driver, string $host, string $user, string $password, string $dbname)
    {
        $config_file = GLPI_CONFIG_DIR . "/config_db.json";
        //TODO Support feature flags
        $config = [
            'driver' => $driver,
            'host' => $host,
            'user' => $user,
            'password' => $password,
            'dbname' => $dbname,
        ];
        $config = json_encode($config, JSON_PRETTY_PRINT);
        return (bool) file_put_contents($config_file, $config);
    }

    public static function getFromLegacyConfigFile()
    {
        if (!file_exists(GLPI_CONFIG_DIR . '/config_db.php')) {
            throw new \RuntimeException('GLPI DB config file not found');
        }
        include_once(GLPI_CONFIG_DIR . "/config_db.php");
        $main_config = new \DB();
        if (file_exists(GLPI_CONFIG_DIR . "/config_db_slave.php")) {
            include_once(GLPI_CONFIG_DIR . "/config_db_slave.php");
            $slave_config = new \DBSlave();
        } else {
            $slave_config = null;
        }

        $config = [
            'driver'   => 'pdo_mysql'
        ];

        if ($slave_config) {
            $config['wrapperClass'] = PrimaryReadReplicaConnection::class;
            $config['primary'] = [
                'user'     => $main_config->dbuser,
                'password' => $main_config->dbpassword,
                'dbname'   => $main_config->dbdefault,
                'host'     => $main_config->dbhost,
            ];
            $config['replica'] = [
                [
                    'user'     => $slave_config->dbuser,
                    'password' => $slave_config->dbpassword,
                    'dbname'   => $slave_config->dbdefault,
                    'host'     => $slave_config->dbhost,
                ]
            ];
        } else {
            $config['user'] = $main_config->dbuser;
            $config['password'] = $main_config->dbpassword;
            $config['dbname'] = $main_config->dbdefault;
            $config['host'] = $main_config->dbhost;
        }

        return $config;
    }

    public static function getFromConfigFile()
    {
        $config_file = GLPI_CONFIG_DIR . "/config_db.json";
        if (file_exists($config_file)) {
            $config = json_decode(file_get_contents($config_file), true, 512, JSON_THROW_ON_ERROR);
        } else {
            $config = self::getFromLegacyConfigFile();
        }
        return $config;
    }
}
