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

namespace Glpi\Security;

use Profile;
use Profile_User;
use ProfileRight;
use QueryExpression;

/**
 * Permission manager class.
 *
 * @since 10.1.0
 */
final class PermissionManager
{
    /**
     * Gets all profiles assigned to the provided user for a given entity.
     *
     * @param int $users_id The user's ID or -1 for the current user.
     * @param int $entities_id The entity's ID.
     * @return array Array of profile IDs
     */
    private static function getAllProfilesForUser(int $users_id, int $entities_id): array
    {
        global $DB;

        $profiles = [];

        $parent_entities = getAncestorsOf('glpi_entities', $entities_id);

        if ($users_id === -1) {
            $profiles = array_filter($_SESSION['glpiprofiles'], static function ($profile, $pid) use ($parent_entities) {
                return $profile['entities_id'] === $pid ||
                    ($profile['is_recursive'] && in_array($profile['entities_id'], $parent_entities, true));
            }, ARRAY_FILTER_USE_BOTH);
            return array_keys($profiles);
        }

        $profile_table = Profile::getTable();
        $iterator = $DB->request([
            'SELECT' => ['profiles_id'],
            'FROM' => Profile_User::getTable(),
            'LEFT JOIN' => [
                $profile_table => [
                    'ON'    => [
                        $profile_table => 'id',
                        Profile_User::getTable() => 'profiles_id', [
                            'AND' => [
                                Profile_User::getTableField('users_id') => $users_id,
                            ]
                        ]
                    ]
                ]
            ],
            'WHERE' => [
                'OR' => [
                    Profile_User::getTableField('entities_id') => $entities_id,
                    'AND' => [
                        Profile_User::getTableField('entities_id') => $parent_entities,
                        Profile_User::getTableField('is_recursive') => 1
                    ]
                ]
            ]
        ]);
        foreach ($iterator as $row) {
            $profiles[] = $row['profiles_id'];
        }

        return $profiles;
    }

    /**
     * Combines the permissions granted by all the provided profiles.
     *
     * @param array $profiles Array of profile IDs.
     * @return array Array of rights combined from all provided profiles
     */
    public static function getAggregatedRights(array $profiles): array
    {
        global $DB;

        if (empty($profiles)) {
            return [];
        }

        $rights = [];

        $iterator = $DB->request([
            'SELECT' => ['name', 'rights'],
            'FROM'   => ProfileRight::getTable(),
            'WHERE'  => [
                ProfileRight::getTableField('profiles_id') => $profiles
            ]
        ]);

        foreach ($iterator as $row) {
            $right_name = $row['name'];
            if (!isset($rights[$right_name])) {
                $rights[$right_name] = 0;
            }
            $rights[$right_name] |= $row['rights'];
        }

        return $rights;
    }

    /**
     * @param int $users_id The user's ID or -1 for the current user.
     *                      While you could pass the actual ID of the current user, it is not recommended as it would
     *                      bypass optimizations that are made by using data already available in the session.
     * @param string $module The module to check. Typically, this is a $rightname property of a class.
     * @param int $right The individual right/permission to check. Common values are defined by the constants:
     *                   {@link READ}, {@link UPDATE}, {@link CREATE}, {@link DELETE}, {@link PURGE}, {@link PURGE},
     *                   {@link ALLSTANDARDRIGHT}, {@link READNOTE}, {@link UPDATENOTE}, and {@link UNLOCK}.
     *                   Rights unique to a module may be defined as constants within their related class.
     *                   Not all the common rights are valid for all modules. For example, an item that cannot be soft-deleted
     *                   would only have the {@link PURGE} right and not the {@link DELETE} right.
     * @param bool $all_profiles If this is true or if the provided user ID is not -1, every profile assigned to the user will be checked.
     *                           Otherwise, if the users_id is -1 and this is false, only the active profile is checked.
     * @param int $entities_id The entity to check. If -1 provided, the current entity is used.
     *
     * @return bool
     */
    public static function haveRight(int $users_id, string $module, int $right, bool $all_profiles = false, int $entities_id = -1): bool
    {
        global $DB;

        if ($entities_id === -1) {
            $entities_id = (int) $_SESSION['glpiactive_entity'];
        }

        if ($users_id === -1) {
            if ($all_profiles) {
                $profiles = array_keys($_SESSION['glpiprofiles']) ?? [];
                $parent_entities = getAncestorsOf('glpi_entities', $entities_id);

                $profiles = array_filter($profiles, static function ($profile) use ($entities_id, $parent_entities) {
                    $profile_entities = $profile['entities'];
                    foreach ($profile_entities as $e) {
                        if ((int) $e['id'] === $entities_id || ($e['is_recursive'] && in_array((int) $e['id'], $parent_entities, true))) {
                            return true;
                        }
                    }
                    return false;
                });
            } else {
                $module_rights = $_SESSION['glpiactiveprofile'][$module] ?? [];
                return (!empty($module_rights) && ($module_rights & $right) === $right);
            }
        } else {
            $profiles = self::getAllProfilesForUser($users_id, $entities_id);
        }
        if (empty($profiles)) {
            return false;
        }

        $iterator = $DB->request([
            'SELECT' => ['id'],
            'FROM'   => ProfileRight::getTable(),
            'WHERE'  => [
                ProfileRight::getTableField('profiles_id') => $profiles,
                ProfileRight::getTableField('name')        => $module,
                new QueryExpression('(rights & ' . $right . ') = ' . $right)
            ],
            'LIMIT'  => 1
        ]);

        return $iterator->count() > 0;
    }

    /**
     * Returns an array of all profiles with the specified right.
     *
     * @param string $module
     * @param int $right
     * @return array Array of applicable profiles where the profile ID is the key and the value is the full rights on the specified module.
     *               The array is sorted so that the profiles with the lower rights on the module are first.
     */
    public static function getPossibleProfiles(string $module, int $right): array
    {
        global $DB;

        $profiles = [];

        $iterator = $DB->request([
            'SELECT' => ['profiles_id', 'rights'],
            'FROM'   => ProfileRight::getTable(),
            'WHERE' => [
                ProfileRight::getTableField('name') => $module,
                new QueryExpression('(rights & ' . $right . ') = ' . $right)
            ]
        ]);

        foreach ($iterator as $row) {
            $profiles[$row['profiles_id']] = $row['rights'];
        }

        sort($profiles);
        return $profiles;
    }

    /**
     * Check if a user has a specific profile.
     *
     * @param int $users_id The user's ID or -1 for the current user.
     *                      While you could pass the actual ID of the current user, it is not recommended as it would
     *                      bypass optimizations that are made by using data already available in the session.
     * @param int $profiles_id The profile ID to check.
     * @return bool
     */
    public static function hasProfile(int $users_id, int $profiles_id): bool
    {
        global $DB;

        if ($users_id === -1) {
            return isset($_SESSION['glpiprofiles'][$profiles_id]);
        }

        $iterator = $DB->request([
            'SELECT' => ['id'],
            'FROM'  => Profile_User::getTable(),
            'WHERE' => [
                'users_id'      => $users_id,
                'profiles_id'   => $profiles_id
            ],
            'LIMIT' => 1
        ]);

        return $iterator->count() > 0;
    }
}
