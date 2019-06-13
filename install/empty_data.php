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

function createTables() {
   global $DB;

   $tables['glpi_alerts'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'itemtype' => [
              'type' => 'varchar(100)',
              'default_value' => null,
              'no_default' => true,
          ],
          'items_id' => [
              'type' => 'integer',
          ],
          'type' => [
              'type' => 'integer',
              'comment' => 'see define.php ALERT_* constant',
          ],
          'date' => [
              'type' => 'timestamp',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['itemtype', 'items_id', 'type'],
          ],
          'KEY' => [
              'type' => ['type'],
              'date' => ['date'],
          ],
      ]
   ];

   $tables['glpi_apiclients'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'name' => [
              'type' => 'string',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'is_active' => [
              'type' => 'bool',
          ],
          'ipv4_range_start' => [
              'type' => 'bigint(20)',
              'default_value' => null,
          ],
          'ipv4_range_end' => [
              'type' => 'bigint(20)',
              'default_value' => null,
          ],
          'ipv6' => [
              'type' => 'string',
          ],
          'app_token' => [
              'type' => 'string',
          ],
          'app_token_date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'dolog_method' => [
              'type' => 'tinyint(4)',
              'default_value' => '0',
          ],
          'comment' => [
              'type' => 'text',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'date_mod' => ['date_mod'],
              'is_active' => ['is_active'],
          ],
      ]
   ];

   $tables['glpi_authldapreplicates'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'authldaps_id' => [
              'type' => 'integer',
          ],
          'host' => [
              'type' => 'string',
          ],
          'port' => [
              'type' => 'integer',
              'default_value' => '389',
          ],
          'name' => [
              'type' => 'string',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'authldaps_id' => ['authldaps_id'],
          ],
      ]
   ];

   $tables['glpi_authldaps'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'host' => [
              'type' => 'string',
          ],
          'basedn' => [
              'type' => 'string',
          ],
          'rootdn' => [
              'type' => 'string',
          ],
          'port' => [
              'type' => 'integer',
              'default_value' => '389',
          ],
          'condition' => [
              'type' => 'text',
          ],
          'login_field' => [
              'type' => 'string',
              'default_value' => 'uid',
          ],
          'sync_field' => [
              'type' => 'string',
          ],
          'use_tls' => [
              'type' => 'bool',
          ],
          'group_field' => [
              'type' => 'string',
          ],
          'group_condition' => [
              'type' => 'text',
          ],
          'group_search_type' => [
              'type' => 'integer',
          ],
          'group_member_field' => [
              'type' => 'string',
          ],
          'email1_field' => [
              'type' => 'string',
          ],
          'realname_field' => [
              'type' => 'string',
          ],
          'firstname_field' => [
              'type' => 'string',
          ],
          'phone_field' => [
              'type' => 'string',
          ],
          'phone2_field' => [
              'type' => 'string',
          ],
          'mobile_field' => [
              'type' => 'string',
          ],
          'comment_field' => [
              'type' => 'string',
          ],
          'use_dn' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'time_offset' => [
              'type' => 'integer',
              'comment' => 'in seconds',
          ],
          'deref_option' => [
              'type' => 'integer',
          ],
          'title_field' => [
              'type' => 'string',
          ],
          'category_field' => [
              'type' => 'string',
          ],
          'language_field' => [
              'type' => 'string',
          ],
          'entity_field' => [
              'type' => 'string',
          ],
          'entity_condition' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'comment' => [
              'type' => 'text',
          ],
          'is_default' => [
              'type' => 'bool',
          ],
          'is_active' => [
              'type' => 'bool',
          ],
          'rootdn_passwd' => [
              'type' => 'string',
          ],
          'registration_number_field' => [
              'type' => 'string',
          ],
          'email2_field' => [
              'type' => 'string',
          ],
          'email3_field' => [
              'type' => 'string',
          ],
          'email4_field' => [
              'type' => 'string',
          ],
          'location_field' => [
              'type' => 'string',
          ],
          'responsible_field' => [
              'type' => 'string',
          ],
          'pagesize' => [
              'type' => 'integer',
          ],
          'ldap_maxlimit' => [
              'type' => 'integer',
          ],
          'can_support_pagesize' => [
              'type' => 'bool',
          ],
          'picture_field' => [
              'type' => 'string',
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'inventory_domain' => [
              'type' => 'string',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'date_mod' => ['date_mod'],
              'is_default' => ['is_default'],
              'is_active' => ['is_active'],
              'date_creation' => ['date_creation'],
              'sync_field' => ['sync_field'],
          ],
      ]
   ];

   $tables['glpi_authmails'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'connect_string' => [
              'type' => 'string',
          ],
          'host' => [
              'type' => 'string',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'comment' => [
              'type' => 'text',
          ],
          'is_active' => [
              'type' => 'bool',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'date_mod' => ['date_mod'],
              'is_active' => ['is_active'],
          ],
      ]
   ];

   $tables['glpi_autoupdatesystems'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
          ],
      ]
   ];

   $tables['glpi_blacklistedmailcontents'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'content' => [
              'type' => 'text',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_blacklists'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'type' => [
              'type' => 'integer',
          ],
          'name' => [
              'type' => 'string',
          ],
          'value' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'type' => ['type'],
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_budgets'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'begin_date' => [
              'type' => 'date',
              'default_value' => null,
          ],
          'end_date' => [
              'type' => 'date',
              'default_value' => null,
          ],
          'value' => [
              'type' => 'decimal(20,4)',
              'default_value' => '0.0000',
          ],
          'is_template' => [
              'type' => 'bool',
          ],
          'template_name' => [
              'type' => 'string',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'locations_id' => [
              'type' => 'integer',
          ],
          'budgettypes_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'is_recursive' => ['is_recursive'],
              'entities_id' => ['entities_id'],
              'is_deleted' => ['is_deleted'],
              'begin_date' => ['begin_date'],
              'end_date' => ['end_date'],
              'is_template' => ['is_template'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
              'locations_id' => ['locations_id'],
              'budgettypes_id' => ['budgettypes_id'],
          ],
      ]
   ];

   $tables['glpi_budgettypes'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_businesscriticities'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'businesscriticities_id' => [
              'type' => 'integer',
          ],
          'completename' => [
              'type' => 'text',
          ],
          'level' => [
              'type' => 'integer',
          ],
          'ancestors_cache' => [
              'type' => 'longtext',
          ],
          'sons_cache' => [
              'type' => 'longtext',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['businesscriticities_id', 'name'],
          ],
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_calendars'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'cache_duration' => [
              'type' => 'text',
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_calendars_holidays'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'calendars_id' => [
              'type' => 'integer',
          ],
          'holidays_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['calendars_id', 'holidays_id'],
          ],
          'KEY' => [
              'holidays_id' => ['holidays_id'],
          ],
      ]
   ];

   $tables['glpi_calendarsegments'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'calendars_id' => [
              'type' => 'integer',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'day' => [
              'type' => 'bool',
              'default_value' => '1',
              'comment' => 'numer of the day based on date(w)',
          ],
          'begin' => [
              'type' => 'time',
              'default_value' => null,
          ],
          'end' => [
              'type' => 'time',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'calendars_id' => ['calendars_id'],
              'day' => ['day'],
          ],
      ]
   ];

   $tables['glpi_cartridgeitems'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'name' => [
              'type' => 'string',
          ],
          'ref' => [
              'type' => 'string',
          ],
          'locations_id' => [
              'type' => 'integer',
          ],
          'cartridgeitemtypes_id' => [
              'type' => 'integer',
          ],
          'manufacturers_id' => [
              'type' => 'integer',
          ],
          'users_id_tech' => [
              'type' => 'integer',
          ],
          'groups_id_tech' => [
              'type' => 'integer',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'alarm_threshold' => [
              'type' => 'integer',
              'default_value' => '10',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'entities_id' => ['entities_id'],
              'manufacturers_id' => ['manufacturers_id'],
              'locations_id' => ['locations_id'],
              'users_id_tech' => ['users_id_tech'],
              'cartridgeitemtypes_id' => ['cartridgeitemtypes_id'],
              'is_deleted' => ['is_deleted'],
              'alarm_threshold' => ['alarm_threshold'],
              'groups_id_tech' => ['groups_id_tech'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_cartridgeitems_printermodels'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'cartridgeitems_id' => [
              'type' => 'integer',
          ],
          'printermodels_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['printermodels_id', 'cartridgeitems_id'],
          ],
          'KEY' => [
              'cartridgeitems_id' => ['cartridgeitems_id'],
          ],
      ]
   ];

   $tables['glpi_cartridgeitemtypes'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_cartridges'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'cartridgeitems_id' => [
              'type' => 'integer',
          ],
          'printers_id' => [
              'type' => 'integer',
          ],
          'date_in' => [
              'type' => 'date',
              'default_value' => null,
          ],
          'date_use' => [
              'type' => 'date',
              'default_value' => null,
          ],
          'date_out' => [
              'type' => 'date',
              'default_value' => null,
          ],
          'pages' => [
              'type' => 'integer',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'cartridgeitems_id' => ['cartridgeitems_id'],
              'printers_id' => ['printers_id'],
              'entities_id' => ['entities_id'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_certificates'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'serial' => [
              'type' => 'string',
          ],
          'otherserial' => [
              'type' => 'string',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'is_template' => [
              'type' => 'bool',
          ],
          'template_name' => [
              'type' => 'string',
          ],
          'certificatetypes_id' => [
              'type' => 'integer',
              'comment' => 'RELATION to glpi_certificatetypes (id)',
          ],
          'dns_name' => [
              'type' => 'string',
          ],
          'dns_suffix' => [
              'type' => 'string',
          ],
          'users_id_tech' => [
              'type' => 'integer',
              'comment' => 'RELATION to glpi_users (id)',
          ],
          'groups_id_tech' => [
              'type' => 'integer',
              'comment' => 'RELATION to glpi_groups (id)',
          ],
          'locations_id' => [
              'type' => 'integer',
              'comment' => 'RELATION to glpi_locations (id)',
          ],
          'manufacturers_id' => [
              'type' => 'integer',
              'comment' => 'RELATION to glpi_manufacturers (id)',
          ],
          'contact' => [
              'type' => 'string',
          ],
          'contact_num' => [
              'type' => 'string',
          ],
          'users_id' => [
              'type' => 'integer',
          ],
          'groups_id' => [
              'type' => 'integer',
          ],
          'is_autosign' => [
              'type' => 'bool',
          ],
          'date_expiration' => [
              'type' => 'date',
              'default_value' => null,
          ],
          'states_id' => [
              'type' => 'integer',
              'comment' => 'RELATION to states (id)',
          ],
          'command' => [
              'type' => 'text',
          ],
          'certificate_request' => [
              'type' => 'text',
          ],
          'certificate_item' => [
              'type' => 'text',
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'entities_id' => ['entities_id'],
              'is_template' => ['is_template'],
              'is_deleted' => ['is_deleted'],
              'certificatetypes_id' => ['certificatetypes_id'],
              'users_id_tech' => ['users_id_tech'],
              'groups_id_tech' => ['groups_id_tech'],
              'groups_id' => ['groups_id'],
              'users_id' => ['users_id'],
              'locations_id' => ['locations_id'],
              'manufacturers_id' => ['manufacturers_id'],
              'states_id' => ['states_id'],
              'date_creation' => ['date_creation'],
              'date_mod' => ['date_mod'],
          ],
      ]
   ];

   $tables['glpi_certificates_items'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'certificates_id' => [
              'type' => 'integer',
          ],
          'items_id' => [
              'type' => 'integer',
              'comment' => 'RELATION to various $tables, according to itemtype (id)',
          ],
          'itemtype' => [
              'type' => 'varchar(100)',
              'default_value' => null,
              'no_default' => true,
              'comment' => 'see .class.php file',
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['certificates_id', 'itemtype', 'items_id'],
          ],
          'KEY' => [
              'device' => ['items_id', 'itemtype'],
              'item' => ['itemtype', 'items_id'],
              'date_creation' => ['date_creation'],
              'date_mod' => ['date_mod'],
          ],
      ]
   ];

   $tables['glpi_certificatetypes'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'name' => ['name'],
              'date_creation' => ['date_creation'],
              'date_mod' => ['date_mod'],
          ],
      ]
   ];

   $tables['glpi_changecosts'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'changes_id' => [
              'type' => 'integer',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'begin_date' => [
              'type' => 'date',
              'default_value' => null,
          ],
          'end_date' => [
              'type' => 'date',
              'default_value' => null,
          ],
          'actiontime' => [
              'type' => 'integer',
          ],
          'cost_time' => [
              'type' => 'decimal(20,4)',
              'default_value' => '0.0000',
          ],
          'cost_fixed' => [
              'type' => 'decimal(20,4)',
              'default_value' => '0.0000',
          ],
          'cost_material' => [
              'type' => 'decimal(20,4)',
              'default_value' => '0.0000',
          ],
          'budgets_id' => [
              'type' => 'integer',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'changes_id' => ['changes_id'],
              'begin_date' => ['begin_date'],
              'end_date' => ['end_date'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'budgets_id' => ['budgets_id'],
          ],
      ]
   ];

   $tables['glpi_changes'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'status' => [
              'type' => 'integer',
              'default_value' => '1',
          ],
          'content' => [
              'type' => 'longtext',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'solvedate' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'closedate' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'time_to_resolve' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'users_id_recipient' => [
              'type' => 'integer',
          ],
          'users_id_lastupdater' => [
              'type' => 'integer',
          ],
          'urgency' => [
              'type' => 'integer',
              'default_value' => '1',
          ],
          'impact' => [
              'type' => 'integer',
              'default_value' => '1',
          ],
          'priority' => [
              'type' => 'integer',
              'default_value' => '1',
          ],
          'itilcategories_id' => [
              'type' => 'integer',
          ],
          'impactcontent' => [
              'type' => 'longtext',
          ],
          'controlistcontent' => [
              'type' => 'longtext',
          ],
          'rolloutplancontent' => [
              'type' => 'longtext',
          ],
          'backoutplancontent' => [
              'type' => 'longtext',
          ],
          'checklistcontent' => [
              'type' => 'longtext',
          ],
          'global_validation' => [
              'type' => 'integer',
              'default_value' => '1',
          ],
          'validation_percent' => [
              'type' => 'integer',
          ],
          'actiontime' => [
              'type' => 'integer',
          ],
          'begin_waiting_date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'waiting_duration' => [
              'type' => 'integer',
          ],
          'close_delay_stat' => [
              'type' => 'integer',
          ],
          'solve_delay_stat' => [
              'type' => 'integer',
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'is_deleted' => ['is_deleted'],
              'date' => ['date'],
              'closedate' => ['closedate'],
              'status' => ['status'],
              'priority' => ['priority'],
              'date_mod' => ['date_mod'],
              'itilcategories_id' => ['itilcategories_id'],
              'users_id_recipient' => ['users_id_recipient'],
              'solvedate' => ['solvedate'],
              'urgency' => ['urgency'],
              'impact' => ['impact'],
              'time_to_resolve' => ['time_to_resolve'],
              'global_validation' => ['global_validation'],
              'users_id_lastupdater' => ['users_id_lastupdater'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_changes_groups'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'changes_id' => [
              'type' => 'integer',
          ],
          'groups_id' => [
              'type' => 'integer',
          ],
          'type' => [
              'type' => 'integer',
              'default_value' => '1',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['changes_id', 'type', 'groups_id'],
          ],
          'KEY' => [
              'group' => ['groups_id', 'type'],
          ],
      ]
   ];

   $tables['glpi_changes_items'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'changes_id' => [
              'type' => 'integer',
          ],
          'itemtype' => [
              'type' => 'varchar(100)',
              'default_value' => null,
          ],
          'items_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['changes_id', 'itemtype', 'items_id'],
          ],
          'KEY' => [
              'item' => ['itemtype', 'items_id'],
          ],
      ]
   ];

   $tables['glpi_changes_problems'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'changes_id' => [
              'type' => 'integer',
          ],
          'problems_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['changes_id', 'problems_id'],
          ],
          'KEY' => [
              'problems_id' => ['problems_id'],
          ],
      ]
   ];

   $tables['glpi_changes_suppliers'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'changes_id' => [
              'type' => 'integer',
          ],
          'suppliers_id' => [
              'type' => 'integer',
          ],
          'type' => [
              'type' => 'integer',
              'default_value' => '1',
          ],
          'use_notification' => [
              'type' => 'bool',
          ],
          'alternative_email' => [
              'type' => 'string',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['changes_id', 'type', 'suppliers_id'],
          ],
          'KEY' => [
              'group' => ['suppliers_id', 'type'],
          ],
      ]
   ];

   $tables['glpi_changes_tickets'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'changes_id' => [
              'type' => 'integer',
          ],
          'tickets_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['changes_id', 'tickets_id'],
          ],
          'KEY' => [
              'tickets_id' => ['tickets_id'],
          ],
      ]
   ];

   $tables['glpi_changes_users'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'changes_id' => [
              'type' => 'integer',
          ],
          'users_id' => [
              'type' => 'integer',
          ],
          'type' => [
              'type' => 'integer',
              'default_value' => '1',
          ],
          'use_notification' => [
              'type' => 'bool',
          ],
          'alternative_email' => [
              'type' => 'string',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['changes_id', 'type', 'users_id', 'alternative_email'],
          ],
          'KEY' => [
              'user' => ['users_id', 'type'],
          ],
      ]
   ];

   $tables['glpi_changetasks'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'changes_id' => [
              'type' => 'integer',
          ],
          'taskcategories_id' => [
              'type' => 'integer',
          ],
          'state' => [
              'type' => 'integer',
          ],
          'date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'begin' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'end' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'users_id' => [
              'type' => 'integer',
          ],
          'users_id_editor' => [
              'type' => 'integer',
          ],
          'users_id_tech' => [
              'type' => 'integer',
          ],
          'groups_id_tech' => [
              'type' => 'integer',
          ],
          'content' => [
              'type' => 'longtext',
          ],
          'actiontime' => [
              'type' => 'integer',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'tasktemplates_id' => [
              'type' => 'integer',
          ],
          'timeline_position' => [
              'type' => 'bool',
          ],
          'is_private' => [
              'type' => 'bool',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'changes_id' => ['changes_id'],
              'state' => ['state'],
              'users_id' => ['users_id'],
              'users_id_editor' => ['users_id_editor'],
              'users_id_tech' => ['users_id_tech'],
              'groups_id_tech' => ['groups_id_tech'],
              'date' => ['date'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
              'begin' => ['begin'],
              'end' => ['end'],
              'taskcategories_id' => ['taskcategories_id'],
              'tasktemplates_id' => ['tasktemplates_id'],
              'is_private' => ['is_private'],
          ],
      ]
   ];

   $tables['glpi_changevalidations'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'users_id' => [
              'type' => 'integer',
          ],
          'changes_id' => [
              'type' => 'integer',
          ],
          'users_id_validate' => [
              'type' => 'integer',
          ],
          'comment_submission' => [
              'type' => 'text',
          ],
          'comment_validation' => [
              'type' => 'text',
          ],
          'status' => [
              'type' => 'integer',
              'default_value' => '2',
          ],
          'submission_date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'validation_date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'timeline_position' => [
              'type' => 'bool',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'users_id' => ['users_id'],
              'users_id_validate' => ['users_id_validate'],
              'changes_id' => ['changes_id'],
              'submission_date' => ['submission_date'],
              'validation_date' => ['validation_date'],
              'status' => ['status'],
          ],
      ]
   ];

   $tables['glpi_computerantiviruses'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'computers_id' => [
              'type' => 'integer',
          ],
          'name' => [
              'type' => 'string',
          ],
          'manufacturers_id' => [
              'type' => 'integer',
          ],
          'antivirus_version' => [
              'type' => 'string',
          ],
          'signature_version' => [
              'type' => 'string',
          ],
          'is_active' => [
              'type' => 'bool',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'is_uptodate' => [
              'type' => 'bool',
          ],
          'is_dynamic' => [
              'type' => 'bool',
          ],
          'date_expiration' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'antivirus_version' => ['antivirus_version'],
              'signature_version' => ['signature_version'],
              'is_active' => ['is_active'],
              'is_uptodate' => ['is_uptodate'],
              'is_dynamic' => ['is_dynamic'],
              'is_deleted' => ['is_deleted'],
              'computers_id' => ['computers_id'],
              'date_expiration' => ['date_expiration'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_computermodels'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'product_number' => [
              'type' => 'string',
          ],
          'weight' => [
              'type' => 'integer',
          ],
          'required_units' => [
              'type' => 'integer',
              'default_value' => '1',
          ],
          'depth' => [
              'type' => 'float',
              'default_value' => '1',
          ],
          'power_connections' => [
              'type' => 'integer',
          ],
          'power_consumption' => [
              'type' => 'integer',
          ],
          'is_half_rack' => [
              'type' => 'bool',
          ],
          'picture_front' => [
              'type' => 'text',
          ],
          'picture_rear' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
              'product_number' => ['product_number'],
          ],
      ]
   ];

   $tables['glpi_computers'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'name' => [
              'type' => 'string',
          ],
          'serial' => [
              'type' => 'string',
          ],
          'otherserial' => [
              'type' => 'string',
          ],
          'contact' => [
              'type' => 'string',
          ],
          'contact_num' => [
              'type' => 'string',
          ],
          'users_id_tech' => [
              'type' => 'integer',
          ],
          'groups_id_tech' => [
              'type' => 'integer',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'autoupdatesystems_id' => [
              'type' => 'integer',
          ],
          'locations_id' => [
              'type' => 'integer',
          ],
          'domains_id' => [
              'type' => 'integer',
          ],
          'networks_id' => [
              'type' => 'integer',
          ],
          'computermodels_id' => [
              'type' => 'integer',
          ],
          'computertypes_id' => [
              'type' => 'integer',
          ],
          'is_template' => [
              'type' => 'bool',
          ],
          'template_name' => [
              'type' => 'string',
          ],
          'manufacturers_id' => [
              'type' => 'integer',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'is_dynamic' => [
              'type' => 'bool',
          ],
          'users_id' => [
              'type' => 'integer',
          ],
          'groups_id' => [
              'type' => 'integer',
          ],
          'states_id' => [
              'type' => 'integer',
          ],
          'ticket_tco' => [
              'type' => 'decimal(20,4)',
              'default_value' => '0.0000',
          ],
          'uuid' => [
              'type' => 'string',
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'date_mod' => ['date_mod'],
              'name' => ['name'],
              'is_template' => ['is_template'],
              'autoupdatesystems_id' => ['autoupdatesystems_id'],
              'domains_id' => ['domains_id'],
              'entities_id' => ['entities_id'],
              'manufacturers_id' => ['manufacturers_id'],
              'groups_id' => ['groups_id'],
              'users_id' => ['users_id'],
              'locations_id' => ['locations_id'],
              'computermodels_id' => ['computermodels_id'],
              'networks_id' => ['networks_id'],
              'states_id' => ['states_id'],
              'users_id_tech' => ['users_id_tech'],
              'computertypes_id' => ['computertypes_id'],
              'is_deleted' => ['is_deleted'],
              'groups_id_tech' => ['groups_id_tech'],
              'is_dynamic' => ['is_dynamic'],
              'serial' => ['serial'],
              'otherserial' => ['otherserial'],
              'uuid' => ['uuid'],
              'date_creation' => ['date_creation'],
              'is_recursive' => ['is_recursive'],
          ],
      ]
   ];

   $tables['glpi_computers_items'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'items_id' => [
              'type' => 'integer',
              'comment' => 'RELATION to various table, according to itemtype (ID)',
          ],
          'computers_id' => [
              'type' => 'integer',
          ],
          'itemtype' => [
              'type' => 'varchar(100)',
              'default_value' => null,
              'no_default' => true,
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'is_dynamic' => [
              'type' => 'bool',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'computers_id' => ['computers_id'],
              'item' => ['itemtype', 'items_id'],
              'is_deleted' => ['is_deleted'],
              'is_dynamic' => ['is_dynamic'],
          ],
      ]
   ];

   $tables['glpi_computers_softwarelicenses'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'computers_id' => [
              'type' => 'integer',
          ],
          'softwarelicenses_id' => [
              'type' => 'integer',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'is_dynamic' => [
              'type' => 'bool',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'computers_id' => ['computers_id'],
              'softwarelicenses_id' => ['softwarelicenses_id'],
              'is_deleted' => ['is_deleted'],
              'is_dynamic' => ['is_dynamic'],
          ],
      ]
   ];

   $tables['glpi_computers_softwareversions'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'computers_id' => [
              'type' => 'integer',
          ],
          'softwareversions_id' => [
              'type' => 'integer',
          ],
          'is_deleted_computer' => [
              'type' => 'bool',
          ],
          'is_template_computer' => [
              'type' => 'bool',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'is_dynamic' => [
              'type' => 'bool',
          ],
          'date_install' => [
              'type' => 'date',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['computers_id', 'softwareversions_id'],
          ],
          'KEY' => [
              'softwareversions_id' => ['softwareversions_id'],
              'computers_info' => ['entities_id', 'is_template_computer', 'is_deleted_computer'],
              'is_template' => ['is_template_computer'],
              'is_deleted' => ['is_deleted_computer'],
              'is_dynamic' => ['is_dynamic'],
              'date_install' => ['date_install'],
          ],
      ]
   ];

   $tables['glpi_computertypes'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_computervirtualmachines'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'computers_id' => [
              'type' => 'integer',
          ],
          'name' => [
              'type' => 'string',
              'default_value' => '',
          ],
          'virtualmachinestates_id' => [
              'type' => 'integer',
          ],
          'virtualmachinesystems_id' => [
              'type' => 'integer',
          ],
          'virtualmachinetypes_id' => [
              'type' => 'integer',
          ],
          'uuid' => [
              'type' => 'string',
              'default_value' => '',
          ],
          'vcpu' => [
              'type' => 'integer',
          ],
          'ram' => [
              'type' => 'string',
              'default_value' => '',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'is_dynamic' => [
              'type' => 'bool',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'computers_id' => ['computers_id'],
              'entities_id' => ['entities_id'],
              'name' => ['name'],
              'virtualmachinestates_id' => ['virtualmachinestates_id'],
              'virtualmachinesystems_id' => ['virtualmachinesystems_id'],
              'vcpu' => ['vcpu'],
              'ram' => ['ram'],
              'is_deleted' => ['is_deleted'],
              'is_dynamic' => ['is_dynamic'],
              'uuid' => ['uuid'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_configs'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'context' => [
              'type' => 'varchar(150)',
              'default_value' => null,
          ],
          'name' => [
              'type' => 'varchar(150)',
              'default_value' => null,
          ],
          'value' => [
              'type' => 'text',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['context', 'name'],
          ],
      ]
   ];

   $tables['glpi_consumableitems'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'name' => [
              'type' => 'string',
          ],
          'ref' => [
              'type' => 'string',
          ],
          'locations_id' => [
              'type' => 'integer',
          ],
          'consumableitemtypes_id' => [
              'type' => 'integer',
          ],
          'manufacturers_id' => [
              'type' => 'integer',
          ],
          'users_id_tech' => [
              'type' => 'integer',
          ],
          'groups_id_tech' => [
              'type' => 'integer',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'alarm_threshold' => [
              'type' => 'integer',
              'default_value' => '10',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'otherserial' => [
              'type' => 'string',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'entities_id' => ['entities_id'],
              'manufacturers_id' => ['manufacturers_id'],
              'locations_id' => ['locations_id'],
              'users_id_tech' => ['users_id_tech'],
              'consumableitemtypes_id' => ['consumableitemtypes_id'],
              'is_deleted' => ['is_deleted'],
              'alarm_threshold' => ['alarm_threshold'],
              'groups_id_tech' => ['groups_id_tech'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
              'otherserial' => ['otherserial'],
          ],
      ]
   ];

   $tables['glpi_consumableitemtypes'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_consumables'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'consumableitems_id' => [
              'type' => 'integer',
          ],
          'date_in' => [
              'type' => 'date',
              'default_value' => null,
          ],
          'date_out' => [
              'type' => 'date',
              'default_value' => null,
          ],
          'itemtype' => [
              'type' => 'varchar(100)',
              'default_value' => null,
          ],
          'items_id' => [
              'type' => 'integer',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'date_in' => ['date_in'],
              'date_out' => ['date_out'],
              'consumableitems_id' => ['consumableitems_id'],
              'entities_id' => ['entities_id'],
              'item' => ['itemtype', 'items_id'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_contacts'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'name' => [
              'type' => 'string',
          ],
          'firstname' => [
              'type' => 'string',
          ],
          'phone' => [
              'type' => 'string',
          ],
          'phone2' => [
              'type' => 'string',
          ],
          'mobile' => [
              'type' => 'string',
          ],
          'fax' => [
              'type' => 'string',
          ],
          'email' => [
              'type' => 'string',
          ],
          'contacttypes_id' => [
              'type' => 'integer',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'usertitles_id' => [
              'type' => 'integer',
          ],
          'address' => [
              'type' => 'text',
          ],
          'postcode' => [
              'type' => 'string',
          ],
          'town' => [
              'type' => 'string',
          ],
          'state' => [
              'type' => 'string',
          ],
          'country' => [
              'type' => 'string',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'entities_id' => ['entities_id'],
              'contacttypes_id' => ['contacttypes_id'],
              'is_deleted' => ['is_deleted'],
              'usertitles_id' => ['usertitles_id'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_contacts_suppliers'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'suppliers_id' => [
              'type' => 'integer',
          ],
          'contacts_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['suppliers_id', 'contacts_id'],
          ],
          'KEY' => [
              'contacts_id' => ['contacts_id'],
          ],
      ]
   ];

   $tables['glpi_contacttypes'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_contractcosts'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'contracts_id' => [
              'type' => 'integer',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'begin_date' => [
              'type' => 'date',
              'default_value' => null,
          ],
          'end_date' => [
              'type' => 'date',
              'default_value' => null,
          ],
          'cost' => [
              'type' => 'decimal(20,4)',
              'default_value' => '0.0000',
          ],
          'budgets_id' => [
              'type' => 'integer',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'contracts_id' => ['contracts_id'],
              'begin_date' => ['begin_date'],
              'end_date' => ['end_date'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'budgets_id' => ['budgets_id'],
          ],
      ]
   ];

   $tables['glpi_contracts'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'name' => [
              'type' => 'string',
          ],
          'num' => [
              'type' => 'string',
          ],
          'contracttypes_id' => [
              'type' => 'integer',
          ],
          'begin_date' => [
              'type' => 'date',
              'default_value' => null,
          ],
          'duration' => [
              'type' => 'integer',
          ],
          'notice' => [
              'type' => 'integer',
          ],
          'periodicity' => [
              'type' => 'integer',
          ],
          'billing' => [
              'type' => 'integer',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'accounting_number' => [
              'type' => 'string',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'week_begin_hour' => [
              'type' => 'time',
              'default_value' => '00:00:00',
          ],
          'week_end_hour' => [
              'type' => 'time',
              'default_value' => '00:00:00',
          ],
          'saturday_begin_hour' => [
              'type' => 'time',
              'default_value' => '00:00:00',
          ],
          'saturday_end_hour' => [
              'type' => 'time',
              'default_value' => '00:00:00',
          ],
          'use_saturday' => [
              'type' => 'bool',
          ],
          'monday_begin_hour' => [
              'type' => 'time',
              'default_value' => '00:00:00',
          ],
          'monday_end_hour' => [
              'type' => 'time',
              'default_value' => '00:00:00',
          ],
          'use_monday' => [
              'type' => 'bool',
          ],
          'max_links_allowed' => [
              'type' => 'integer',
          ],
          'alert' => [
              'type' => 'integer',
          ],
          'renewal' => [
              'type' => 'integer',
          ],
          'template_name' => [
              'type' => 'string',
          ],
          'is_template' => [
              'type' => 'bool',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'begin_date' => ['begin_date'],
              'name' => ['name'],
              'contracttypes_id' => ['contracttypes_id'],
              'entities_id' => ['entities_id'],
              'is_deleted' => ['is_deleted'],
              'use_monday' => ['use_monday'],
              'use_saturday' => ['use_saturday'],
              'alert' => ['alert'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_contracts_items'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'contracts_id' => [
              'type' => 'integer',
          ],
          'items_id' => [
              'type' => 'integer',
          ],
          'itemtype' => [
              'type' => 'varchar(100)',
              'default_value' => null,
              'no_default' => true,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['contracts_id', 'itemtype', 'items_id'],
          ],
          'KEY' => [
              'FK_device' => ['items_id', 'itemtype'],
              'item' => ['itemtype', 'items_id'],
          ],
      ]
   ];

   $tables['glpi_contracts_suppliers'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'suppliers_id' => [
              'type' => 'integer',
          ],
          'contracts_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['suppliers_id', 'contracts_id'],
          ],
          'KEY' => [
              'contracts_id' => ['contracts_id'],
          ],
      ]
   ];

   $tables['glpi_contracttypes'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_crontasklogs'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'crontasks_id' => [
              'type' => 'integer',
              'default_value' => null,
              'no_default' => true,
          ],
          'crontasklogs_id' => [
              'type' => 'integer',
              'default_value' => null,
              'no_default' => true,
              'comment' => "id of 'start' event",
          ],
          'date' => [
              'type' => 'timestamp',
          ],
          'state' => [
              'type' => 'integer',
              'default_value' => null,
              'no_default' => true,
              'comment' => '0:start, 1:run, 2:stop',
          ],
          'elapsed' => [
              'type' => 'float',
              'default_value' => null,
              'no_default' => true,
              'comment' => 'time elapsed since start',
          ],
          'volume' => [
              'type' => 'integer',
              'default_value' => null,
              'no_default' => true,
              'comment' => 'for statistics',
          ],
          'content' => [
              'type' => 'string',
              'comment' => 'message',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'date' => ['date'],
              'crontasks_id' => ['crontasks_id'],
              'crontasklogs_id_state' => ['crontasklogs_id', 'state'],
          ],
      ]
   ];

   $tables['glpi_crontasks'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'itemtype' => [
              'type' => 'varchar(100)',
              'default_value' => null,
              'no_default' => true,
          ],
          'name' => [
              'type' => 'varchar(150)',
              'default_value' => null,
              'no_default' => true,
              'comment' => 'task name',
          ],
          'frequency' => [
              'type' => 'integer',
              'default_value' => null,
              'no_default' => true,
              'comment' => 'second between launch',
          ],
          'param' => [
              'type' => 'integer',
              'default_value' => null,
              'comment' => 'task specify parameter',
          ],
          'state' => [
              'type' => 'integer',
              'default_value' => '1',
              'comment' => '0:disabled, 1:waiting, 2:running',
          ],
          'mode' => [
              'type' => 'integer',
              'default_value' => '1',
              'comment' => '1:internal, 2:external',
          ],
          'allowmode' => [
              'type' => 'integer',
              'default_value' => '3',
              'comment' => '1:internal, 2:external, 3:both',
          ],
          'hourmin' => [
              'type' => 'integer',
          ],
          'hourmax' => [
              'type' => 'integer',
              'default_value' => '24',
          ],
          'logs_lifetime' => [
              'type' => 'integer',
              'default_value' => '30',
              'comment' => 'number of days',
          ],
          'lastrun' => [
              'type' => 'timestamp',
              'default_value' => null,
              'comment' => 'last run date',
          ],
          'lastcode' => [
              'type' => 'integer',
              'default_value' => null,
              'comment' => 'last run return code',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['itemtype', 'name'],
          ],
          'KEY' => [
              'mode' => ['mode'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_datacenters'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'locations_id' => [
              'type' => 'integer',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'locations_id' => ['locations_id'],
              'is_deleted' => ['is_deleted'],
          ],
      ]
   ];

   $tables['glpi_dcrooms'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'locations_id' => [
              'type' => 'integer',
          ],
          'vis_cols' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'vis_rows' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'blueprint' => [
              'type' => 'text',
          ],
          'datacenters_id' => [
              'type' => 'integer',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'locations_id' => ['locations_id'],
              'datacenters_id' => ['datacenters_id'],
              'is_deleted' => ['is_deleted'],
          ],
      ]
   ];

   $tables['glpi_devicebatteries'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'designation' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'manufacturers_id' => [
              'type' => 'integer',
          ],
          'voltage' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'capacity' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'devicebatterytypes_id' => [
              'type' => 'integer',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'devicebatterymodels_id' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'designation' => ['designation'],
              'manufacturers_id' => ['manufacturers_id'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
              'devicebatterymodels_id' => ['devicebatterymodels_id'],
              'devicebatterytypes_id' => ['devicebatterytypes_id'],
          ],
      ]
   ];

   $tables['glpi_devicebatterymodels'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'product_number' => [
              'type' => 'string',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'product_number' => ['product_number'],
          ],
      ]
   ];

   $tables['glpi_devicebatterytypes'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_devicecasemodels'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'product_number' => [
              'type' => 'string',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'product_number' => ['product_number'],
          ],
      ]
   ];

   $tables['glpi_devicecases'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'designation' => [
              'type' => 'string',
          ],
          'devicecasetypes_id' => [
              'type' => 'integer',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'manufacturers_id' => [
              'type' => 'integer',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'devicecasemodels_id' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'designation' => ['designation'],
              'manufacturers_id' => ['manufacturers_id'],
              'devicecasetypes_id' => ['devicecasetypes_id'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
              'devicecasemodels_id' => ['devicecasemodels_id'],
          ],
      ]
   ];

   $tables['glpi_devicecasetypes'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_devicecontrolmodels'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'product_number' => [
              'type' => 'string',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'product_number' => ['product_number'],
          ],
      ]
   ];

   $tables['glpi_devicecontrols'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'designation' => [
              'type' => 'string',
          ],
          'is_raid' => [
              'type' => 'bool',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'manufacturers_id' => [
              'type' => 'integer',
          ],
          'interfacetypes_id' => [
              'type' => 'integer',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'devicecontrolmodels_id' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'designation' => ['designation'],
              'manufacturers_id' => ['manufacturers_id'],
              'interfacetypes_id' => ['interfacetypes_id'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
              'devicecontrolmodels_id' => ['devicecontrolmodels_id'],
          ],
      ]
   ];

   $tables['glpi_devicedrivemodels'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'product_number' => [
              'type' => 'string',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'product_number' => ['product_number'],
          ],
      ]
   ];

   $tables['glpi_devicedrives'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'designation' => [
              'type' => 'string',
          ],
          'is_writer' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'speed' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'manufacturers_id' => [
              'type' => 'integer',
          ],
          'interfacetypes_id' => [
              'type' => 'integer',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'devicedrivemodels_id' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'designation' => ['designation'],
              'manufacturers_id' => ['manufacturers_id'],
              'interfacetypes_id' => ['interfacetypes_id'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
              'devicedrivemodels_id' => ['devicedrivemodels_id'],
          ],
      ]
   ];

   $tables['glpi_devicefirmwaremodels'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'product_number' => [
              'type' => 'string',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'product_number' => ['product_number'],
          ],
      ]
   ];

   $tables['glpi_devicefirmwares'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'designation' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'manufacturers_id' => [
              'type' => 'integer',
          ],
          'date' => [
              'type' => 'date',
              'default_value' => null,
          ],
          'version' => [
              'type' => 'string',
          ],
          'devicefirmwaretypes_id' => [
              'type' => 'integer',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'devicefirmwaremodels_id' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'designation' => ['designation'],
              'manufacturers_id' => ['manufacturers_id'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
              'devicefirmwaremodels_id' => ['devicefirmwaremodels_id'],
              'devicefirmwaretypes_id' => ['devicefirmwaretypes_id'],
          ],
      ]
   ];

   $tables['glpi_devicefirmwaretypes'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_devicegenericmodels'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'product_number' => [
              'type' => 'string',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'product_number' => ['product_number'],
          ],
      ]
   ];

   $tables['glpi_devicegenerics'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'designation' => [
              'type' => 'string',
          ],
          'devicegenerictypes_id' => [
              'type' => 'integer',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'manufacturers_id' => [
              'type' => 'integer',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'locations_id' => [
              'type' => 'integer',
          ],
          'states_id' => [
              'type' => 'integer',
          ],
          'devicegenericmodels_id' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'designation' => ['designation'],
              'manufacturers_id' => ['manufacturers_id'],
              'devicegenerictypes_id' => ['devicegenerictypes_id'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'locations_id' => ['locations_id'],
              'states_id' => ['states_id'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
              'devicegenericmodels_id' => ['devicegenericmodels_id'],
          ],
      ]
   ];

   $tables['glpi_devicegenerictypes'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
          ],
      ]
   ];

   $tables['glpi_devicegraphiccardmodels'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'product_number' => [
              'type' => 'string',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'product_number' => ['product_number'],
          ],
      ]
   ];

   $tables['glpi_devicegraphiccards'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'designation' => [
              'type' => 'string',
          ],
          'interfacetypes_id' => [
              'type' => 'integer',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'manufacturers_id' => [
              'type' => 'integer',
          ],
          'memory_default' => [
              'type' => 'integer',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'devicegraphiccardmodels_id' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'chipset' => [
              'type' => 'string',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'designation' => ['designation'],
              'manufacturers_id' => ['manufacturers_id'],
              'interfacetypes_id' => ['interfacetypes_id'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'chipset' => ['chipset'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
              'devicegraphiccardmodels_id' => ['devicegraphiccardmodels_id'],
          ],
      ]
   ];

   $tables['glpi_deviceharddrivemodels'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'product_number' => [
              'type' => 'string',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'product_number' => ['product_number'],
          ],
      ]
   ];

   $tables['glpi_deviceharddrives'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'designation' => [
              'type' => 'string',
          ],
          'rpm' => [
              'type' => 'string',
          ],
          'interfacetypes_id' => [
              'type' => 'integer',
          ],
          'cache' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'manufacturers_id' => [
              'type' => 'integer',
          ],
          'capacity_default' => [
              'type' => 'integer',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'deviceharddrivemodels_id' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'designation' => ['designation'],
              'manufacturers_id' => ['manufacturers_id'],
              'interfacetypes_id' => ['interfacetypes_id'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
              'deviceharddrivemodels_id' => ['deviceharddrivemodels_id'],
          ],
      ]
   ];

   $tables['glpi_devicememories'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'designation' => [
              'type' => 'string',
          ],
          'frequence' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'manufacturers_id' => [
              'type' => 'integer',
          ],
          'size_default' => [
              'type' => 'integer',
          ],
          'devicememorytypes_id' => [
              'type' => 'integer',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'devicememorymodels_id' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'designation' => ['designation'],
              'manufacturers_id' => ['manufacturers_id'],
              'devicememorytypes_id' => ['devicememorytypes_id'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
              'devicememorymodels_id' => ['devicememorymodels_id'],
          ],
      ]
   ];

   $tables['glpi_devicememorymodels'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'product_number' => [
              'type' => 'string',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'product_number' => ['product_number'],
          ],
      ]
   ];

   $tables['glpi_devicememorytypes'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_devicemotherboardmodels'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'product_number' => [
              'type' => 'string',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'product_number' => ['product_number'],
          ],
      ]
   ];

   $tables['glpi_devicemotherboards'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'designation' => [
              'type' => 'string',
          ],
          'chipset' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'manufacturers_id' => [
              'type' => 'integer',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'devicemotherboardmodels_id' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'designation' => ['designation'],
              'manufacturers_id' => ['manufacturers_id'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
              'devicemotherboardmodels_id' => ['devicemotherboardmodels_id'],
          ],
      ]
   ];

   $tables['glpi_devicenetworkcardmodels'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'product_number' => [
              'type' => 'string',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'product_number' => ['product_number'],
          ],
      ]
   ];

   $tables['glpi_devicenetworkcards'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'designation' => [
              'type' => 'string',
          ],
          'bandwidth' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'manufacturers_id' => [
              'type' => 'integer',
          ],
          'mac_default' => [
              'type' => 'string',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'devicenetworkcardmodels_id' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'designation' => ['designation'],
              'manufacturers_id' => ['manufacturers_id'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
              'devicenetworkcardmodels_id' => ['devicenetworkcardmodels_id'],
          ],
      ]
   ];

   $tables['glpi_devicepcimodels'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'product_number' => [
              'type' => 'string',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'product_number' => ['product_number'],
          ],
      ]
   ];

   $tables['glpi_devicepcis'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'designation' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'manufacturers_id' => [
              'type' => 'integer',
          ],
          'devicenetworkcardmodels_id' => [
              'type' => 'integer',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'devicepcimodels_id' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'designation' => ['designation'],
              'manufacturers_id' => ['manufacturers_id'],
              'devicenetworkcardmodels_id' => ['devicenetworkcardmodels_id'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
              'devicepcimodels_id' => ['devicepcimodels_id'],
          ],
      ]
   ];

   $tables['glpi_devicepowersupplies'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'designation' => [
              'type' => 'string',
          ],
          'power' => [
              'type' => 'string',
          ],
          'is_atx' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'manufacturers_id' => [
              'type' => 'integer',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'devicepowersupplymodels_id' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'designation' => ['designation'],
              'manufacturers_id' => ['manufacturers_id'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
              'devicepowersupplymodels_id' => ['devicepowersupplymodels_id'],
          ],
      ]
   ];

   $tables['glpi_devicepowersupplymodels'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'product_number' => [
              'type' => 'string',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'product_number' => ['product_number'],
          ],
      ]
   ];

   $tables['glpi_deviceprocessormodels'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'product_number' => [
              'type' => 'string',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'product_number' => ['product_number'],
          ],
      ]
   ];

   $tables['glpi_deviceprocessors'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'designation' => [
              'type' => 'string',
          ],
          'frequence' => [
              'type' => 'integer',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'manufacturers_id' => [
              'type' => 'integer',
          ],
          'frequency_default' => [
              'type' => 'integer',
          ],
          'nbcores_default' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'nbthreads_default' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'deviceprocessormodels_id' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'designation' => ['designation'],
              'manufacturers_id' => ['manufacturers_id'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
              'deviceprocessormodels_id' => ['deviceprocessormodels_id'],
          ],
      ]
   ];

   $tables['glpi_devicesensormodels'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'product_number' => [
              'type' => 'string',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'product_number' => ['product_number'],
          ],
      ]
   ];

   $tables['glpi_devicesensors'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'designation' => [
              'type' => 'string',
          ],
          'devicesensortypes_id' => [
              'type' => 'integer',
          ],
          'devicesensormodels_id' => [
              'type' => 'integer',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'manufacturers_id' => [
              'type' => 'integer',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'locations_id' => [
              'type' => 'integer',
          ],
          'states_id' => [
              'type' => 'integer',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'designation' => ['designation'],
              'manufacturers_id' => ['manufacturers_id'],
              'devicesensortypes_id' => ['devicesensortypes_id'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'locations_id' => ['locations_id'],
              'states_id' => ['states_id'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_devicesensortypes'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
          ],
      ]
   ];

   $tables['glpi_devicesimcards'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'designation' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'manufacturers_id' => [
              'type' => 'integer',
          ],
          'voltage' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'devicesimcardtypes_id' => [
              'type' => 'integer',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'allow_voip' => [
              'type' => 'bool',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'designation' => ['designation'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'devicesimcardtypes_id' => ['devicesimcardtypes_id'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
              'manufacturers_id' => ['manufacturers_id'],
          ],
      ]
   ];

   $tables['glpi_devicesimcardtypes'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
              'default_value' => '',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_devicesoundcardmodels'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'product_number' => [
              'type' => 'string',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'product_number' => ['product_number'],
          ],
      ]
   ];

   $tables['glpi_devicesoundcards'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'designation' => [
              'type' => 'string',
          ],
          'type' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'manufacturers_id' => [
              'type' => 'integer',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'devicesoundcardmodels_id' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'designation' => ['designation'],
              'manufacturers_id' => ['manufacturers_id'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
              'devicesoundcardmodels_id' => ['devicesoundcardmodels_id'],
          ],
      ]
   ];

   $tables['glpi_displaypreferences'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'itemtype' => [
              'type' => 'varchar(100)',
              'default_value' => null,
              'no_default' => true,
          ],
          'num' => [
              'type' => 'integer',
          ],
          'rank' => [
              'type' => 'integer',
          ],
          'users_id' => [
              'type' => 'integer',
          ],
          'is_main' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['users_id', 'itemtype', 'num', 'is_main'],
          ],
          'KEY' => [
              'rank' => ['rank'],
              'num' => ['num'],
              'itemtype' => ['itemtype'],
              'is_main' => ['is_main'],
          ],
      ]
   ];

   $tables['glpi_documentcategories'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'documentcategories_id' => [
              'type' => 'integer',
          ],
          'completename' => [
              'type' => 'text',
          ],
          'level' => [
              'type' => 'integer',
          ],
          'ancestors_cache' => [
              'type' => 'longtext',
          ],
          'sons_cache' => [
              'type' => 'longtext',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['documentcategories_id', 'name'],
          ],
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_documents'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'name' => [
              'type' => 'string',
          ],
          'filename' => [
              'type' => 'string',
              'comment' => 'for display and transfert',
          ],
          'filepath' => [
              'type' => 'string',
              'comment' => 'file storage path',
          ],
          'documentcategories_id' => [
              'type' => 'integer',
          ],
          'mime' => [
              'type' => 'string',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'comment' => [
              'type' => 'text',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'link' => [
              'type' => 'string',
          ],
          'users_id' => [
              'type' => 'integer',
          ],
          'tickets_id' => [
              'type' => 'integer',
          ],
          'sha1sum' => [
              'type' => 'char(40)',
              'default_value' => null,
          ],
          'is_blacklisted' => [
              'type' => 'bool',
          ],
          'tag' => [
              'type' => 'string',
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'date_mod' => ['date_mod'],
              'name' => ['name'],
              'entities_id' => ['entities_id'],
              'tickets_id' => ['tickets_id'],
              'users_id' => ['users_id'],
              'documentcategories_id' => ['documentcategories_id'],
              'is_deleted' => ['is_deleted'],
              'sha1sum' => ['sha1sum'],
              'tag' => ['tag'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_documents_items'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'documents_id' => [
              'type' => 'integer',
          ],
          'items_id' => [
              'type' => 'integer',
          ],
          'itemtype' => [
              'type' => 'varchar(100)',
              'default_value' => null,
              'no_default' => true,
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'users_id' => [
              'type' => 'integer',
          ],
          'timeline_position' => [
              'type' => 'bool',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['documents_id', 'itemtype', 'items_id'],
          ],
          'KEY' => [
              'item' => ['itemtype', 'items_id', 'entities_id', 'is_recursive'],
              'users_id' => ['users_id'],
          ],
      ]
   ];

   $tables['glpi_documenttypes'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'ext' => [
              'type' => 'string',
          ],
          'icon' => [
              'type' => 'string',
          ],
          'mime' => [
              'type' => 'string',
          ],
          'is_uploadable' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['ext'],
          ],
          'KEY' => [
              'name' => ['name'],
              'is_uploadable' => ['is_uploadable'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_domains'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_dropdowntranslations'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'items_id' => [
              'type' => 'integer',
          ],
          'itemtype' => [
              'type' => 'varchar(100)',
              'default_value' => null,
          ],
          'language' => [
              'type' => 'varchar(5)',
              'default_value' => null,
          ],
          'field' => [
              'type' => 'varchar(100)',
              'default_value' => null,
          ],
          'value' => [
              'type' => 'text',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['itemtype', 'items_id', 'language', 'field'],
          ],
          'KEY' => [
              'typeid' => ['itemtype', 'items_id'],
              'language' => ['language'],
              'field' => ['field'],
          ],
      ]
   ];

   $tables['glpi_enclosuremodels'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'product_number' => [
              'type' => 'string',
          ],
          'weight' => [
              'type' => 'integer',
          ],
          'required_units' => [
              'type' => 'integer',
              'default_value' => '1',
          ],
          'depth' => [
              'type' => 'float',
              'default_value' => '1',
          ],
          'power_connections' => [
              'type' => 'integer',
          ],
          'power_consumption' => [
              'type' => 'integer',
          ],
          'is_half_rack' => [
              'type' => 'bool',
          ],
          'picture_front' => [
              'type' => 'text',
          ],
          'picture_rear' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
              'product_number' => ['product_number'],
          ],
      ]
   ];

   $tables['glpi_enclosures'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'locations_id' => [
              'type' => 'integer',
          ],
          'serial' => [
              'type' => 'string',
          ],
          'otherserial' => [
              'type' => 'string',
          ],
          'enclosuremodels_id' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'users_id_tech' => [
              'type' => 'integer',
          ],
          'groups_id_tech' => [
              'type' => 'integer',
          ],
          'is_template' => [
              'type' => 'bool',
          ],
          'template_name' => [
              'type' => 'string',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'orientation' => [
              'type' => 'bool',
              'default_value' => null,
          ],
          'power_supplies' => [
              'type' => 'bool',
          ],
          'states_id' => [
              'type' => 'integer',
              'comment' => 'RELATION to states (id)',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'manufacturers_id' => [
              'type' => 'integer',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'locations_id' => ['locations_id'],
              'enclosuremodels_id' => ['enclosuremodels_id'],
              'users_id_tech' => ['users_id_tech'],
              'group_id_tech' => ['groups_id_tech'],
              'is_template' => ['is_template'],
              'is_deleted' => ['is_deleted'],
              'states_id' => ['states_id'],
              'manufacturers_id' => ['manufacturers_id'],
          ],
      ]
   ];

   // glpi_entities does not have an AUTO_INCREMENT 'id' field
   $tables['glpi_entities'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'integer',
          ],
          'name' => [
              'type' => 'string',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'completename' => [
              'type' => 'text',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'level' => [
              'type' => 'integer',
          ],
          'sons_cache' => [
              'type' => 'longtext',
          ],
          'ancestors_cache' => [
              'type' => 'longtext',
          ],
          'address' => [
              'type' => 'text',
          ],
          'postcode' => [
              'type' => 'string',
          ],
          'town' => [
              'type' => 'string',
          ],
          'state' => [
              'type' => 'string',
          ],
          'country' => [
              'type' => 'string',
          ],
          'website' => [
              'type' => 'string',
          ],
          'phonenumber' => [
              'type' => 'string',
          ],
          'fax' => [
              'type' => 'string',
          ],
          'email' => [
              'type' => 'string',
          ],
          'admin_email' => [
              'type' => 'string',
          ],
          'admin_email_name' => [
              'type' => 'string',
          ],
          'admin_reply' => [
              'type' => 'string',
          ],
          'admin_reply_name' => [
              'type' => 'string',
          ],
          'notification_subject_tag' => [
              'type' => 'string',
          ],
          'ldap_dn' => [
              'type' => 'string',
          ],
          'tag' => [
              'type' => 'string',
          ],
          'authldaps_id' => [
              'type' => 'integer',
          ],
          'mail_domain' => [
              'type' => 'string',
          ],
          'entity_ldapfilter' => [
              'type' => 'text',
          ],
          'mailing_signature' => [
              'type' => 'text',
          ],
          'cartridges_alert_repeat' => [
              'type' => 'integer',
              'default_value' => '-2',
          ],
          'consumables_alert_repeat' => [
              'type' => 'integer',
              'default_value' => '-2',
          ],
          'use_licenses_alert' => [
              'type' => 'integer',
              'default_value' => '-2',
          ],
          'send_licenses_alert_before_delay' => [
              'type' => 'integer',
              'default_value' => '-2',
          ],
          'use_certificates_alert' => [
              'type' => 'integer',
              'default_value' => '-2',
          ],
          'send_certificates_alert_before_delay' => [
              'type' => 'integer',
              'default_value' => '-2',
          ],
          'use_contracts_alert' => [
              'type' => 'integer',
              'default_value' => '-2',
          ],
          'send_contracts_alert_before_delay' => [
              'type' => 'integer',
              'default_value' => '-2',
          ],
          'use_infocoms_alert' => [
              'type' => 'integer',
              'default_value' => '-2',
          ],
          'send_infocoms_alert_before_delay' => [
              'type' => 'integer',
              'default_value' => '-2',
          ],
          'use_reservations_alert' => [
              'type' => 'integer',
              'default_value' => '-2',
          ],
          'autoclose_delay' => [
              'type' => 'integer',
              'default_value' => '-2',
          ],
          'notclosed_delay' => [
              'type' => 'integer',
              'default_value' => '-2',
          ],
          'calendars_id' => [
              'type' => 'integer',
              'default_value' => '-2',
          ],
          'auto_assign_mode' => [
              'type' => 'integer',
              'default_value' => '-2',
          ],
          'tickettype' => [
              'type' => 'integer',
              'default_value' => '-2',
          ],
          'max_closedate' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'inquest_config' => [
              'type' => 'integer',
              'default_value' => '-2',
          ],
          'inquest_rate' => [
              'type' => 'integer',
          ],
          'inquest_delay' => [
              'type' => 'integer',
              'default_value' => '-10',
          ],
          'inquest_URL' => [
              'type' => 'string',
          ],
          'autofill_warranty_date' => [
              'type' => 'string',
              'default_value' => '-2',
          ],
          'autofill_use_date' => [
              'type' => 'string',
              'default_value' => '-2',
          ],
          'autofill_buy_date' => [
              'type' => 'string',
              'default_value' => '-2',
          ],
          'autofill_delivery_date' => [
              'type' => 'string',
              'default_value' => '-2',
          ],
          'autofill_order_date' => [
              'type' => 'string',
              'default_value' => '-2',
          ],
          'tickettemplates_id' => [
              'type' => 'integer',
              'default_value' => '-2',
          ],
          'entities_id_software' => [
              'type' => 'integer',
              'default_value' => '-2',
          ],
          'default_contract_alert' => [
              'type' => 'integer',
              'default_value' => '-2',
          ],
          'default_infocom_alert' => [
              'type' => 'integer',
              'default_value' => '-2',
          ],
          'default_cartridges_alarm_threshold' => [
              'type' => 'integer',
              'default_value' => '-2',
          ],
          'default_consumables_alarm_threshold' => [
              'type' => 'integer',
              'default_value' => '-2',
          ],
          'delay_send_emails' => [
              'type' => 'integer',
              'default_value' => '-2',
          ],
          'is_notif_enable_default' => [
              'type' => 'integer',
              'default_value' => '-2',
          ],
          'inquest_duration' => [
              'type' => 'integer',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'autofill_decommission_date' => [
              'type' => 'string',
              'default_value' => '-2',
          ],
          'suppliers_as_private' => [
              'type' => 'integer',
              'default_value' => '-2',
          ],
          'enable_custom_css' => [
              'type' => 'integer',
              'default_value' => '-2',
          ],
          'custom_css_code' => [
              'type' => 'text',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['entities_id', 'name'],
          ],
          'KEY' => [
              'entities_id' => ['entities_id'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_entities_knowbaseitems'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'knowbaseitems_id' => [
              'type' => 'integer',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'knowbaseitems_id' => ['knowbaseitems_id'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
          ],
      ]
   ];

   $tables['glpi_entities_reminders'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'reminders_id' => [
              'type' => 'integer',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'reminders_id' => ['reminders_id'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
          ],
      ]
   ];

   $tables['glpi_entities_rssfeeds'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'rssfeeds_id' => [
              'type' => 'integer',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'rssfeeds_id' => ['rssfeeds_id'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
          ],
      ]
   ];

   $tables['glpi_events'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'items_id' => [
              'type' => 'integer',
          ],
          'type' => [
              'type' => 'string',
          ],
          'date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'service' => [
              'type' => 'string',
          ],
          'level' => [
              'type' => 'integer',
          ],
          'message' => [
              'type' => 'text',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'date' => ['date'],
              'level' => ['level'],
              'item' => ['type', 'items_id'],
          ],
      ]
   ];

   $tables['glpi_fieldblacklists'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
              'default_value' => '',
          ],
          'field' => [
              'type' => 'string',
              'default_value' => '',
          ],
          'value' => [
              'type' => 'string',
              'default_value' => '',
          ],
          'itemtype' => [
              'type' => 'string',
              'default_value' => '',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_fieldunicities'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
              'default_value' => '',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'itemtype' => [
              'type' => 'string',
              'default_value' => '',
          ],
          'entities_id' => [
              'type' => 'integer',
              'default_value' => '-1',
          ],
          'fields' => [
              'type' => 'text',
          ],
          'is_active' => [
              'type' => 'bool',
          ],
          'action_refuse' => [
              'type' => 'bool',
          ],
          'action_notify' => [
              'type' => 'bool',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_filesystems'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_fqdns'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'name' => [
              'type' => 'string',
          ],
          'fqdn' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'entities_id' => ['entities_id'],
              'name' => ['name'],
              'fqdn' => ['fqdn'],
              'is_recursive' => ['is_recursive'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_groups'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'ldap_field' => [
              'type' => 'string',
          ],
          'ldap_value' => [
              'type' => 'text',
          ],
          'ldap_group_dn' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'groups_id' => [
              'type' => 'integer',
          ],
          'completename' => [
              'type' => 'text',
          ],
          'level' => [
              'type' => 'integer',
          ],
          'ancestors_cache' => [
              'type' => 'longtext',
          ],
          'sons_cache' => [
              'type' => 'longtext',
          ],
          'is_requester' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'is_watcher' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'is_assign' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'is_task' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'is_notify' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'is_itemgroup' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'is_usergroup' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'is_manager' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'ldap_field' => ['ldap_field'],
              'entities_id' => ['entities_id'],
              'date_mod' => ['date_mod'],
              'ldap_value' => ['ldap_value'],
              'ldap_group_dn' => ['ldap_group_dn'],
              'groups_id' => ['groups_id'],
              'is_requester' => ['is_requester'],
              'is_watcher' => ['is_watcher'],
              'is_assign' => ['is_assign'],
              'is_notify' => ['is_notify'],
              'is_itemgroup' => ['is_itemgroup'],
              'is_usergroup' => ['is_usergroup'],
              'is_manager' => ['is_manager'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_groups_knowbaseitems'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'knowbaseitems_id' => [
              'type' => 'integer',
          ],
          'groups_id' => [
              'type' => 'integer',
          ],
          'entities_id' => [
              'type' => 'integer',
              'default_value' => '-1',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'knowbaseitems_id' => ['knowbaseitems_id'],
              'groups_id' => ['groups_id'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
          ],
      ]
   ];

   $tables['glpi_groups_problems'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'problems_id' => [
              'type' => 'integer',
          ],
          'groups_id' => [
              'type' => 'integer',
          ],
          'type' => [
              'type' => 'integer',
              'default_value' => '1',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['problems_id', 'type', 'groups_id'],
          ],
          'KEY' => [
              'group' => ['groups_id', 'type'],
          ],
      ]
   ];

   $tables['glpi_groups_reminders'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'reminders_id' => [
              'type' => 'integer',
          ],
          'groups_id' => [
              'type' => 'integer',
          ],
          'entities_id' => [
              'type' => 'integer',
              'default_value' => '-1',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'reminders_id' => ['reminders_id'],
              'groups_id' => ['groups_id'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
          ],
      ]
   ];

   $tables['glpi_groups_rssfeeds'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'rssfeeds_id' => [
              'type' => 'integer',
          ],
          'groups_id' => [
              'type' => 'integer',
          ],
          'entities_id' => [
              'type' => 'integer',
              'default_value' => '-1',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'rssfeeds_id' => ['rssfeeds_id'],
              'groups_id' => ['groups_id'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
          ],
      ]
   ];

   $tables['glpi_groups_tickets'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'tickets_id' => [
              'type' => 'integer',
          ],
          'groups_id' => [
              'type' => 'integer',
          ],
          'type' => [
              'type' => 'integer',
              'default_value' => '1',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['tickets_id', 'type', 'groups_id'],
          ],
          'KEY' => [
              'group' => ['groups_id', 'type'],
          ],
      ]
   ];

   $tables['glpi_groups_users'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'users_id' => [
              'type' => 'integer',
          ],
          'groups_id' => [
              'type' => 'integer',
          ],
          'is_dynamic' => [
              'type' => 'bool',
          ],
          'is_manager' => [
              'type' => 'bool',
          ],
          'is_userdelegate' => [
              'type' => 'bool',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['users_id', 'groups_id'],
          ],
          'KEY' => [
              'groups_id' => ['groups_id'],
              'is_manager' => ['is_manager'],
              'is_userdelegate' => ['is_userdelegate'],
          ],
      ]
   ];

   $tables['glpi_holidays'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'begin_date' => [
              'type' => 'date',
              'default_value' => null,
          ],
          'end_date' => [
              'type' => 'date',
              'default_value' => null,
          ],
          'is_perpetual' => [
              'type' => 'bool',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'begin_date' => ['begin_date'],
              'end_date' => ['end_date'],
              'is_perpetual' => ['is_perpetual'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_infocoms'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'items_id' => [
              'type' => 'integer',
          ],
          'itemtype' => [
              'type' => 'varchar(100)',
              'default_value' => null,
              'no_default' => true,
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'buy_date' => [
              'type' => 'date',
              'default_value' => null,
          ],
          'use_date' => [
              'type' => 'date',
              'default_value' => null,
          ],
          'warranty_duration' => [
              'type' => 'integer',
          ],
          'warranty_info' => [
              'type' => 'string',
          ],
          'suppliers_id' => [
              'type' => 'integer',
          ],
          'order_number' => [
              'type' => 'string',
          ],
          'delivery_number' => [
              'type' => 'string',
          ],
          'immo_number' => [
              'type' => 'string',
          ],
          'value' => [
              'type' => 'decimal(20,4)',
              'default_value' => '0.0000',
          ],
          'warranty_value' => [
              'type' => 'decimal(20,4)',
              'default_value' => '0.0000',
          ],
          'sink_time' => [
              'type' => 'integer',
          ],
          'sink_type' => [
              'type' => 'integer',
          ],
          'sink_coeff' => [
              'type' => 'float',
              'default_value' => '0',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'bill' => [
              'type' => 'string',
          ],
          'budgets_id' => [
              'type' => 'integer',
          ],
          'alert' => [
              'type' => 'integer',
          ],
          'order_date' => [
              'type' => 'date',
              'default_value' => null,
          ],
          'delivery_date' => [
              'type' => 'date',
              'default_value' => null,
          ],
          'inventory_date' => [
              'type' => 'date',
              'default_value' => null,
          ],
          'warranty_date' => [
              'type' => 'date',
              'default_value' => null,
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'decommission_date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'businesscriticities_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['itemtype', 'items_id'],
          ],
          'KEY' => [
              'buy_date' => ['buy_date'],
              'alert' => ['alert'],
              'budgets_id' => ['budgets_id'],
              'suppliers_id' => ['suppliers_id'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
              'businesscriticities_id' => ['businesscriticities_id'],
          ],
      ]
   ];

   $tables['glpi_interfacetypes'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_ipaddresses'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'items_id' => [
              'type' => 'integer',
          ],
          'itemtype' => [
              'type' => 'varchar(100)',
              'default_value' => null,
              'no_default' => true,
          ],
          'version' => [
              'type' => 'tinyint(3) unsigned',
              'default_value' => '0',
          ],
          'name' => [
              'type' => 'string',
          ],
          'binary_0' => [
              'type' => 'int(10) unsigned',
              'default_value' => '0',
          ],
          'binary_1' => [
              'type' => 'int(10) unsigned',
              'default_value' => '0',
          ],
          'binary_2' => [
              'type' => 'int(10) unsigned',
              'default_value' => '0',
          ],
          'binary_3' => [
              'type' => 'int(10) unsigned',
              'default_value' => '0',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'is_dynamic' => [
              'type' => 'bool',
          ],
          'mainitems_id' => [
              'type' => 'integer',
          ],
          'mainitemtype' => [
              'type' => 'string',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'entities_id' => ['entities_id'],
              'textual' => ['name'],
              'binary' => ['binary_0', 'binary_1', 'binary_2', 'binary_3'],
              'is_deleted' => ['is_deleted'],
              'is_dynamic' => ['is_dynamic'],
              'item' => ['itemtype', 'items_id', 'is_deleted'],
              'mainitem' => ['mainitemtype', 'mainitems_id', 'is_deleted'],
          ],
      ]
   ];

   $tables['glpi_ipaddresses_ipnetworks'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'ipaddresses_id' => [
              'type' => 'integer',
          ],
          'ipnetworks_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['ipaddresses_id', 'ipnetworks_id'],
          ],
          'KEY' => [
              'ipnetworks_id' => ['ipnetworks_id'],
              'ipaddresses_id' => ['ipaddresses_id'],
          ],
      ]
   ];

   $tables['glpi_ipnetworks'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'ipnetworks_id' => [
              'type' => 'integer',
          ],
          'completename' => [
              'type' => 'text',
          ],
          'level' => [
              'type' => 'integer',
          ],
          'ancestors_cache' => [
              'type' => 'longtext',
          ],
          'sons_cache' => [
              'type' => 'longtext',
          ],
          'addressable' => [
              'type' => 'bool',
          ],
          'version' => [
              'type' => 'tinyint(3) unsigned',
              'default_value' => '0',
          ],
          'name' => [
              'type' => 'string',
          ],
          'address' => [
              'type' => 'varchar(40)',
              'default_value' => null,
          ],
          'address_0' => [
              'type' => 'int(10) unsigned',
              'default_value' => '0',
          ],
          'address_1' => [
              'type' => 'int(10) unsigned',
              'default_value' => '0',
          ],
          'address_2' => [
              'type' => 'int(10) unsigned',
              'default_value' => '0',
          ],
          'address_3' => [
              'type' => 'int(10) unsigned',
              'default_value' => '0',
          ],
          'netmask' => [
              'type' => 'varchar(40)',
              'default_value' => null,
          ],
          'netmask_0' => [
              'type' => 'int(10) unsigned',
              'default_value' => '0',
          ],
          'netmask_1' => [
              'type' => 'int(10) unsigned',
              'default_value' => '0',
          ],
          'netmask_2' => [
              'type' => 'int(10) unsigned',
              'default_value' => '0',
          ],
          'netmask_3' => [
              'type' => 'int(10) unsigned',
              'default_value' => '0',
          ],
          'gateway' => [
              'type' => 'varchar(40)',
              'default_value' => null,
          ],
          'gateway_0' => [
              'type' => 'int(10) unsigned',
              'default_value' => '0',
          ],
          'gateway_1' => [
              'type' => 'int(10) unsigned',
              'default_value' => '0',
          ],
          'gateway_2' => [
              'type' => 'int(10) unsigned',
              'default_value' => '0',
          ],
          'gateway_3' => [
              'type' => 'int(10) unsigned',
              'default_value' => '0',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'network_definition' => ['entities_id', 'address', 'netmask'],
              'address' => ['address_0', 'address_1', 'address_2', 'address_3'],
              'netmask' => ['netmask_0', 'netmask_1', 'netmask_2', 'netmask_3'],
              'gateway' => ['gateway_0', 'gateway_1', 'gateway_2', 'gateway_3'],
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_ipnetworks_vlans'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'ipnetworks_id' => [
              'type' => 'integer',
          ],
          'vlans_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'link' => ['ipnetworks_id', 'vlans_id'],
          ],
      ]
   ];

   $tables['glpi_items_devicebatteries'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'items_id' => [
              'type' => 'integer',
          ],
          'itemtype' => [
              'type' => 'string',
          ],
          'devicebatteries_id' => [
              'type' => 'integer',
          ],
          'manufacturing_date' => [
              'type' => 'date',
              'default_value' => null,
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'is_dynamic' => [
              'type' => 'bool',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'serial' => [
              'type' => 'string',
          ],
          'otherserial' => [
              'type' => 'string',
          ],
          'locations_id' => [
              'type' => 'integer',
          ],
          'states_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'computers_id' => ['items_id'],
              'devicebatteries_id' => ['devicebatteries_id'],
              'is_deleted' => ['is_deleted'],
              'is_dynamic' => ['is_dynamic'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'serial' => ['serial'],
              'item' => ['itemtype', 'items_id'],
              'otherserial' => ['otherserial'],
          ],
      ]
   ];

   $tables['glpi_items_devicecases'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'items_id' => [
              'type' => 'integer',
          ],
          'itemtype' => [
              'type' => 'string',
          ],
          'devicecases_id' => [
              'type' => 'integer',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'is_dynamic' => [
              'type' => 'bool',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'serial' => [
              'type' => 'string',
          ],
          'otherserial' => [
              'type' => 'string',
          ],
          'locations_id' => [
              'type' => 'integer',
          ],
          'states_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'computers_id' => ['items_id'],
              'devicecases_id' => ['devicecases_id'],
              'is_deleted' => ['is_deleted'],
              'is_dynamic' => ['is_dynamic'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'serial' => ['serial'],
              'item' => ['itemtype', 'items_id'],
              'otherserial' => ['otherserial'],
              'locations_id' => ['locations_id'],
              'states_id' => ['states_id'],
          ],
      ]
   ];

   $tables['glpi_items_devicecontrols'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'items_id' => [
              'type' => 'integer',
          ],
          'itemtype' => [
              'type' => 'string',
          ],
          'devicecontrols_id' => [
              'type' => 'integer',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'is_dynamic' => [
              'type' => 'bool',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'serial' => [
              'type' => 'string',
          ],
          'busID' => [
              'type' => 'string',
          ],
          'otherserial' => [
              'type' => 'string',
          ],
          'locations_id' => [
              'type' => 'integer',
          ],
          'states_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'computers_id' => ['items_id'],
              'devicecontrols_id' => ['devicecontrols_id'],
              'is_deleted' => ['is_deleted'],
              'is_dynamic' => ['is_dynamic'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'serial' => ['serial'],
              'busID' => ['busID'],
              'item' => ['itemtype', 'items_id'],
              'otherserial' => ['otherserial'],
              'locations_id' => ['locations_id'],
              'states_id' => ['states_id'],
          ],
      ]
   ];

   $tables['glpi_items_devicedrives'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'items_id' => [
              'type' => 'integer',
          ],
          'itemtype' => [
              'type' => 'string',
          ],
          'devicedrives_id' => [
              'type' => 'integer',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'is_dynamic' => [
              'type' => 'bool',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'serial' => [
              'type' => 'string',
          ],
          'busID' => [
              'type' => 'string',
          ],
          'otherserial' => [
              'type' => 'string',
          ],
          'locations_id' => [
              'type' => 'integer',
          ],
          'states_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'computers_id' => ['items_id'],
              'devicedrives_id' => ['devicedrives_id'],
              'is_deleted' => ['is_deleted'],
              'is_dynamic' => ['is_dynamic'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'serial' => ['serial'],
              'busID' => ['busID'],
              'item' => ['itemtype', 'items_id'],
              'otherserial' => ['otherserial'],
              'locations_id' => ['locations_id'],
              'states_id' => ['states_id'],
          ],
      ]
   ];

   $tables['glpi_items_devicefirmwares'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'items_id' => [
              'type' => 'integer',
          ],
          'itemtype' => [
              'type' => 'string',
          ],
          'devicefirmwares_id' => [
              'type' => 'integer',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'is_dynamic' => [
              'type' => 'bool',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'serial' => [
              'type' => 'string',
          ],
          'otherserial' => [
              'type' => 'string',
          ],
          'locations_id' => [
              'type' => 'integer',
          ],
          'states_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'computers_id' => ['items_id'],
              'devicefirmwares_id' => ['devicefirmwares_id'],
              'is_deleted' => ['is_deleted'],
              'is_dynamic' => ['is_dynamic'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'serial' => ['serial'],
              'item' => ['itemtype', 'items_id'],
              'otherserial' => ['otherserial'],
          ],
      ]
   ];

   $tables['glpi_items_devicegenerics'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'items_id' => [
              'type' => 'integer',
          ],
          'itemtype' => [
              'type' => 'string',
          ],
          'devicegenerics_id' => [
              'type' => 'integer',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'is_dynamic' => [
              'type' => 'bool',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'serial' => [
              'type' => 'string',
          ],
          'otherserial' => [
              'type' => 'string',
          ],
          'locations_id' => [
              'type' => 'integer',
          ],
          'states_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'computers_id' => ['items_id'],
              'devicegenerics_id' => ['devicegenerics_id'],
              'is_deleted' => ['is_deleted'],
              'is_dynamic' => ['is_dynamic'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'serial' => ['serial'],
              'item' => ['itemtype', 'items_id'],
              'otherserial' => ['otherserial'],
          ],
      ]
   ];

   $tables['glpi_items_devicegraphiccards'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'items_id' => [
              'type' => 'integer',
          ],
          'itemtype' => [
              'type' => 'string',
          ],
          'devicegraphiccards_id' => [
              'type' => 'integer',
          ],
          'memory' => [
              'type' => 'integer',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'is_dynamic' => [
              'type' => 'bool',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'serial' => [
              'type' => 'string',
          ],
          'busID' => [
              'type' => 'string',
          ],
          'otherserial' => [
              'type' => 'string',
          ],
          'locations_id' => [
              'type' => 'integer',
          ],
          'states_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'computers_id' => ['items_id'],
              'devicegraphiccards_id' => ['devicegraphiccards_id'],
              'specificity' => ['memory'],
              'is_deleted' => ['is_deleted'],
              'is_dynamic' => ['is_dynamic'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'serial' => ['serial'],
              'busID' => ['busID'],
              'item' => ['itemtype', 'items_id'],
              'otherserial' => ['otherserial'],
              'locations_id' => ['locations_id'],
              'states_id' => ['states_id'],
          ],
      ]
   ];

   $tables['glpi_items_deviceharddrives'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'items_id' => [
              'type' => 'integer',
          ],
          'itemtype' => [
              'type' => 'string',
          ],
          'deviceharddrives_id' => [
              'type' => 'integer',
          ],
          'capacity' => [
              'type' => 'integer',
          ],
          'serial' => [
              'type' => 'string',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'is_dynamic' => [
              'type' => 'bool',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'busID' => [
              'type' => 'string',
          ],
          'otherserial' => [
              'type' => 'string',
          ],
          'locations_id' => [
              'type' => 'integer',
          ],
          'states_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'computers_id' => ['items_id'],
              'deviceharddrives_id' => ['deviceharddrives_id'],
              'specificity' => ['capacity'],
              'is_deleted' => ['is_deleted'],
              'is_dynamic' => ['is_dynamic'],
              'serial' => ['serial'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'busID' => ['busID'],
              'item' => ['itemtype', 'items_id'],
              'otherserial' => ['otherserial'],
              'locations_id' => ['locations_id'],
              'states_id' => ['states_id'],
          ],
      ]
   ];

   $tables['glpi_items_devicememories'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'items_id' => [
              'type' => 'integer',
          ],
          'itemtype' => [
              'type' => 'string',
          ],
          'devicememories_id' => [
              'type' => 'integer',
          ],
          'size' => [
              'type' => 'integer',
          ],
          'serial' => [
              'type' => 'string',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'is_dynamic' => [
              'type' => 'bool',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'busID' => [
              'type' => 'string',
          ],
          'otherserial' => [
              'type' => 'string',
          ],
          'locations_id' => [
              'type' => 'integer',
          ],
          'states_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'computers_id' => ['items_id'],
              'devicememories_id' => ['devicememories_id'],
              'specificity' => ['size'],
              'is_deleted' => ['is_deleted'],
              'is_dynamic' => ['is_dynamic'],
              'serial' => ['serial'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'busID' => ['busID'],
              'item' => ['itemtype', 'items_id'],
              'otherserial' => ['otherserial'],
              'locations_id' => ['locations_id'],
              'states_id' => ['states_id'],
          ],
      ]
   ];

   $tables['glpi_items_devicemotherboards'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'items_id' => [
              'type' => 'integer',
          ],
          'itemtype' => [
              'type' => 'string',
          ],
          'devicemotherboards_id' => [
              'type' => 'integer',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'is_dynamic' => [
              'type' => 'bool',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'serial' => [
              'type' => 'string',
          ],
          'otherserial' => [
              'type' => 'string',
          ],
          'locations_id' => [
              'type' => 'integer',
          ],
          'states_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'computers_id' => ['items_id'],
              'devicemotherboards_id' => ['devicemotherboards_id'],
              'is_deleted' => ['is_deleted'],
              'is_dynamic' => ['is_dynamic'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'serial' => ['serial'],
              'item' => ['itemtype', 'items_id'],
              'otherserial' => ['otherserial'],
              'locations_id' => ['locations_id'],
              'states_id' => ['states_id'],
          ],
      ]
   ];

   $tables['glpi_items_devicenetworkcards'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'items_id' => [
              'type' => 'integer',
          ],
          'itemtype' => [
              'type' => 'string',
          ],
          'devicenetworkcards_id' => [
              'type' => 'integer',
          ],
          'mac' => [
              'type' => 'string',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'is_dynamic' => [
              'type' => 'bool',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'serial' => [
              'type' => 'string',
          ],
          'busID' => [
              'type' => 'string',
          ],
          'otherserial' => [
              'type' => 'string',
          ],
          'locations_id' => [
              'type' => 'integer',
          ],
          'states_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'computers_id' => ['items_id'],
              'devicenetworkcards_id' => ['devicenetworkcards_id'],
              'specificity' => ['mac'],
              'is_deleted' => ['is_deleted'],
              'is_dynamic' => ['is_dynamic'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'serial' => ['serial'],
              'busID' => ['busID'],
              'item' => ['itemtype', 'items_id'],
              'otherserial' => ['otherserial'],
              'locations_id' => ['locations_id'],
              'states_id' => ['states_id'],
          ],
      ]
   ];

   $tables['glpi_items_devicepcis'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'items_id' => [
              'type' => 'integer',
          ],
          'itemtype' => [
              'type' => 'string',
          ],
          'devicepcis_id' => [
              'type' => 'integer',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'is_dynamic' => [
              'type' => 'bool',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'serial' => [
              'type' => 'string',
          ],
          'busID' => [
              'type' => 'string',
          ],
          'otherserial' => [
              'type' => 'string',
          ],
          'locations_id' => [
              'type' => 'integer',
          ],
          'states_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'computers_id' => ['items_id'],
              'devicepcis_id' => ['devicepcis_id'],
              'is_deleted' => ['is_deleted'],
              'is_dynamic' => ['is_dynamic'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'serial' => ['serial'],
              'busID' => ['busID'],
              'item' => ['itemtype', 'items_id'],
              'otherserial' => ['otherserial'],
              'locations_id' => ['locations_id'],
              'states_id' => ['states_id'],
          ],
      ]
   ];

   $tables['glpi_items_devicepowersupplies'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'items_id' => [
              'type' => 'integer',
          ],
          'itemtype' => [
              'type' => 'string',
          ],
          'devicepowersupplies_id' => [
              'type' => 'integer',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'is_dynamic' => [
              'type' => 'bool',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'serial' => [
              'type' => 'string',
          ],
          'otherserial' => [
              'type' => 'string',
          ],
          'locations_id' => [
              'type' => 'integer',
          ],
          'states_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'computers_id' => ['items_id'],
              'devicepowersupplies_id' => ['devicepowersupplies_id'],
              'is_deleted' => ['is_deleted'],
              'is_dynamic' => ['is_dynamic'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'serial' => ['serial'],
              'item' => ['itemtype', 'items_id'],
              'otherserial' => ['otherserial'],
              'locations_id' => ['locations_id'],
              'states_id' => ['states_id'],
          ],
      ]
   ];

   $tables['glpi_items_deviceprocessors'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'items_id' => [
              'type' => 'integer',
          ],
          'itemtype' => [
              'type' => 'string',
          ],
          'deviceprocessors_id' => [
              'type' => 'integer',
          ],
          'frequency' => [
              'type' => 'integer',
          ],
          'serial' => [
              'type' => 'string',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'is_dynamic' => [
              'type' => 'bool',
          ],
          'nbcores' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'nbthreads' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'busID' => [
              'type' => 'string',
          ],
          'otherserial' => [
              'type' => 'string',
          ],
          'locations_id' => [
              'type' => 'integer',
          ],
          'states_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'computers_id' => ['items_id'],
              'deviceprocessors_id' => ['deviceprocessors_id'],
              'specificity' => ['frequency'],
              'is_deleted' => ['is_deleted'],
              'is_dynamic' => ['is_dynamic'],
              'serial' => ['serial'],
              'nbcores' => ['nbcores'],
              'nbthreads' => ['nbthreads'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'busID' => ['busID'],
              'item' => ['itemtype', 'items_id'],
              'otherserial' => ['otherserial'],
              'locations_id' => ['locations_id'],
              'states_id' => ['states_id'],
          ],
      ]
   ];

   $tables['glpi_items_devicesensors'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'items_id' => [
              'type' => 'integer',
          ],
          'itemtype' => [
              'type' => 'string',
          ],
          'devicesensors_id' => [
              'type' => 'integer',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'is_dynamic' => [
              'type' => 'bool',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'serial' => [
              'type' => 'string',
          ],
          'otherserial' => [
              'type' => 'string',
          ],
          'locations_id' => [
              'type' => 'integer',
          ],
          'states_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'computers_id' => ['items_id'],
              'devicesensors_id' => ['devicesensors_id'],
              'is_deleted' => ['is_deleted'],
              'is_dynamic' => ['is_dynamic'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'serial' => ['serial'],
              'item' => ['itemtype', 'items_id'],
              'otherserial' => ['otherserial'],
          ],
      ]
   ];

   $tables['glpi_items_devicesimcards'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'items_id' => [
              'type' => 'integer',
              'comment' => 'RELATION to various table, according to itemtype (id)',
          ],
          'itemtype' => [
              'type' => 'varchar(100)',
              'default_value' => null,
              'no_default' => true,
          ],
          'devicesimcards_id' => [
              'type' => 'integer',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'is_dynamic' => [
              'type' => 'bool',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'serial' => [
              'type' => 'string',
          ],
          'otherserial' => [
              'type' => 'string',
          ],
          'states_id' => [
              'type' => 'integer',
          ],
          'locations_id' => [
              'type' => 'integer',
          ],
          'lines_id' => [
              'type' => 'integer',
          ],
          'pin' => [
              'type' => 'string',
              'default_value' => '',
          ],
          'pin2' => [
              'type' => 'string',
              'default_value' => '',
          ],
          'puk' => [
              'type' => 'string',
              'default_value' => '',
          ],
          'puk2' => [
              'type' => 'string',
              'default_value' => '',
          ],
          'msin' => [
              'type' => 'string',
              'default_value' => '',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'item' => ['itemtype', 'items_id'],
              'devicesimcards_id' => ['devicesimcards_id'],
              'is_deleted' => ['is_deleted'],
              'is_dynamic' => ['is_dynamic'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'serial' => ['serial'],
              'otherserial' => ['otherserial'],
              'states_id' => ['states_id'],
              'locations_id' => ['locations_id'],
              'lines_id' => ['lines_id'],
          ],
      ]
   ];

   $tables['glpi_items_devicesoundcards'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'items_id' => [
              'type' => 'integer',
          ],
          'itemtype' => [
              'type' => 'string',
          ],
          'devicesoundcards_id' => [
              'type' => 'integer',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'is_dynamic' => [
              'type' => 'bool',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'serial' => [
              'type' => 'string',
          ],
          'busID' => [
              'type' => 'string',
          ],
          'otherserial' => [
              'type' => 'string',
          ],
          'locations_id' => [
              'type' => 'integer',
          ],
          'states_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'computers_id' => ['items_id'],
              'devicesoundcards_id' => ['devicesoundcards_id'],
              'is_deleted' => ['is_deleted'],
              'is_dynamic' => ['is_dynamic'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'serial' => ['serial'],
              'busID' => ['busID'],
              'item' => ['itemtype', 'items_id'],
              'otherserial' => ['otherserial'],
              'locations_id' => ['locations_id'],
              'states_id' => ['states_id'],
          ],
      ]
   ];

   $tables['glpi_items_disks'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'itemtype' => [
              'type' => 'string',
          ],
          'items_id' => [
              'type' => 'integer',
          ],
          'name' => [
              'type' => 'string',
          ],
          'device' => [
              'type' => 'string',
          ],
          'mountpoint' => [
              'type' => 'string',
          ],
          'filesystems_id' => [
              'type' => 'integer',
          ],
          'totalsize' => [
              'type' => 'integer',
          ],
          'freesize' => [
              'type' => 'integer',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'is_dynamic' => [
              'type' => 'bool',
          ],
          'encryption_status' => [
              'type' => 'integer',
          ],
          'encryption_tool' => [
              'type' => 'string',
          ],
          'encryption_algorithm' => [
              'type' => 'string',
          ],
          'encryption_type' => [
              'type' => 'string',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'device' => ['device'],
              'mountpoint' => ['mountpoint'],
              'totalsize' => ['totalsize'],
              'freesize' => ['freesize'],
              'itemtype' => ['itemtype'],
              'items_id' => ['items_id'],
              'item' => ['itemtype', 'items_id'],
              'filesystems_id' => ['filesystems_id'],
              'entities_id' => ['entities_id'],
              'is_deleted' => ['is_deleted'],
              'is_dynamic' => ['is_dynamic'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_items_enclosures'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'enclosures_id' => [
              'type' => 'integer',
              'default_value' => null,
              'no_default' => true,
          ],
          'itemtype' => [
              'type' => 'string',
              'no_default' => true,
          ],
          'items_id' => [
              'type' => 'integer',
              'default_value' => null,
              'no_default' => true,
          ],
          'position' => [
              'type' => 'integer',
              'default_value' => null,
              'no_default' => true,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'item' => ['itemtype', 'items_id'],
          ],
          'KEY' => [
              'relation' => ['enclosures_id', 'itemtype', 'items_id'],
          ],
      ]
   ];

   $tables['glpi_items_operatingsystems'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'items_id' => [
              'type' => 'integer',
          ],
          'itemtype' => [
              'type' => 'string',
          ],
          'operatingsystems_id' => [
              'type' => 'integer',
          ],
          'operatingsystemversions_id' => [
              'type' => 'integer',
          ],
          'operatingsystemservicepacks_id' => [
              'type' => 'integer',
          ],
          'operatingsystemarchitectures_id' => [
              'type' => 'integer',
          ],
          'operatingsystemkernelversions_id' => [
              'type' => 'integer',
          ],
          'license_number' => [
              'type' => 'string',
          ],
          'licenseid' => [
              'type' => 'string',
          ],
          'operatingsystemeditions_id' => [
              'type' => 'integer',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'is_dynamic' => [
              'type' => 'bool',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['items_id', 'itemtype', 'operatingsystems_id', 'operatingsystemarchitectures_id'],
          ],
          'KEY' => [
              'items_id' => ['items_id'],
              'item' => ['itemtype', 'items_id'],
              'operatingsystems_id' => ['operatingsystems_id'],
              'operatingsystemservicepacks_id' => ['operatingsystemservicepacks_id'],
              'operatingsystemversions_id' => ['operatingsystemversions_id'],
              'operatingsystemarchitectures_id' => ['operatingsystemarchitectures_id'],
              'operatingsystemkernelversions_id' => ['operatingsystemkernelversions_id'],
              'operatingsystemeditions_id' => ['operatingsystemeditions_id'],
              'is_deleted' => ['is_deleted'],
              'is_dynamic' => ['is_dynamic'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
          ],
      ]
   ];

   $tables['glpi_items_problems'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'problems_id' => [
              'type' => 'integer',
          ],
          'itemtype' => [
              'type' => 'varchar(100)',
              'default_value' => null,
          ],
          'items_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['problems_id', 'itemtype', 'items_id'],
          ],
          'KEY' => [
              'item' => ['itemtype', 'items_id'],
          ],
      ]
   ];

   $tables['glpi_items_projects'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'projects_id' => [
              'type' => 'integer',
          ],
          'itemtype' => [
              'type' => 'varchar(100)',
              'default_value' => null,
          ],
          'items_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['projects_id', 'itemtype', 'items_id'],
          ],
          'KEY' => [
              'item' => ['itemtype', 'items_id'],
          ],
      ]
   ];

   $tables['glpi_items_racks'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'racks_id' => [
              'type' => 'integer',
              'default_value' => null,
              'no_default' => true,
          ],
          'itemtype' => [
              'type' => 'string',
              'no_default' => true,
          ],
          'items_id' => [
              'type' => 'integer',
              'default_value' => null,
              'no_default' => true,
          ],
          'position' => [
              'type' => 'integer',
              'default_value' => null,
              'no_default' => true,
          ],
          'orientation' => [
              'type' => 'bool',
              'default_value' => null,
          ],
          'bgcolor' => [
              'type' => 'varchar(7)',
              'default_value' => null,
          ],
          'hpos' => [
              'type' => 'bool',
          ],
          'is_reserved' => [
              'type' => 'bool',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'item' => ['itemtype', 'items_id', 'is_reserved'],
          ],
          'KEY' => [
              'relation' => ['racks_id', 'itemtype', 'items_id'],
          ],
      ]
   ];

   $tables['glpi_items_tickets'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'itemtype' => [
              'type' => 'string',
          ],
          'items_id' => [
              'type' => 'integer',
          ],
          'tickets_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['itemtype', 'items_id', 'tickets_id'],
          ],
          'KEY' => [
              'tickets_id' => ['tickets_id'],
          ],
      ]
   ];

   $tables['glpi_itilcategories'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'itilcategories_id' => [
              'type' => 'integer',
          ],
          'name' => [
              'type' => 'string',
          ],
          'completename' => [
              'type' => 'text',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'level' => [
              'type' => 'integer',
          ],
          'knowbaseitemcategories_id' => [
              'type' => 'integer',
          ],
          'users_id' => [
              'type' => 'integer',
          ],
          'groups_id' => [
              'type' => 'integer',
          ],
          'ancestors_cache' => [
              'type' => 'longtext',
          ],
          'sons_cache' => [
              'type' => 'longtext',
          ],
          'is_helpdeskvisible' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'tickettemplates_id_incident' => [
              'type' => 'integer',
          ],
          'tickettemplates_id_demand' => [
              'type' => 'integer',
          ],
          'is_incident' => [
              'type' => 'integer',
              'default_value' => '1',
          ],
          'is_request' => [
              'type' => 'integer',
              'default_value' => '1',
          ],
          'is_problem' => [
              'type' => 'integer',
              'default_value' => '1',
          ],
          'is_change' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'knowbaseitemcategories_id' => ['knowbaseitemcategories_id'],
              'users_id' => ['users_id'],
              'groups_id' => ['groups_id'],
              'is_helpdeskvisible' => ['is_helpdeskvisible'],
              'itilcategories_id' => ['itilcategories_id'],
              'tickettemplates_id_incident' => ['tickettemplates_id_incident'],
              'tickettemplates_id_demand' => ['tickettemplates_id_demand'],
              'is_incident' => ['is_incident'],
              'is_request' => ['is_request'],
              'is_problem' => ['is_problem'],
              'is_change' => ['is_change'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_itilfollowups'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'itemtype' => [
              'type' => 'varchar(100)',
              'default_value' => null,
              'no_default' => true,
          ],
          'items_id' => [
              'type' => 'integer',
          ],
          'date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'users_id' => [
              'type' => 'integer',
          ],
          'users_id_editor' => [
              'type' => 'integer',
          ],
          'content' => [
              'type' => 'longtext',
          ],
          'is_private' => [
              'type' => 'bool',
          ],
          'requesttypes_id' => [
              'type' => 'integer',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'timeline_position' => [
              'type' => 'bool',
          ],
          'sourceitems_id' => [
              'type' => 'integer',
          ],
          'sourceof_items_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'itemtype' => ['itemtype'],
              'item_id' => ['items_id'],
              'item' => ['itemtype', 'items_id'],
              'date' => ['date'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
              'users_id' => ['users_id'],
              'users_id_editor' => ['users_id_editor'],
              'is_private' => ['is_private'],
              'requesttypes_id' => ['requesttypes_id'],
              'sourceitems_id' => ['sourceitems_id'],
              'sourceof_items_id' => ['sourceof_items_id'],
          ],
      ]
   ];

   $tables['glpi_itils_projects'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'itemtype' => [
              'type' => 'varchar(100)',
              'default_value' => '',
          ],
          'items_id' => [
              'type' => 'integer',
          ],
          'projects_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['itemtype', 'items_id', 'projects_id'],
          ],
          'KEY' => [
              'projects_id' => ['projects_id'],
          ],
      ]
   ];

   $tables['glpi_itilsolutions'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'itemtype' => [
              'type' => 'varchar(100)',
              'default_value' => null,
              'no_default' => true,
          ],
          'items_id' => [
              'type' => 'integer',
          ],
          'solutiontypes_id' => [
              'type' => 'integer',
          ],
          'solutiontype_name' => [
              'type' => 'string',
          ],
          'content' => [
              'type' => 'longtext',
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_approval' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'users_id' => [
              'type' => 'integer',
          ],
          'user_name' => [
              'type' => 'string',
          ],
          'users_id_editor' => [
              'type' => 'integer',
          ],
          'users_id_approval' => [
              'type' => 'integer',
          ],
          'user_name_approval' => [
              'type' => 'string',
          ],
          'status' => [
              'type' => 'integer',
              'default_value' => '1',
          ],
          'itilfollowups_id' => [
              'type' => 'integer',
              'default_value' => null,
              'comment' => 'Followup reference on reject or approve a solution',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'itemtype' => ['itemtype'],
              'item_id' => ['items_id'],
              'item' => ['itemtype', 'items_id'],
              'solutiontypes_id' => ['solutiontypes_id'],
              'users_id' => ['users_id'],
              'users_id_editor' => ['users_id_editor'],
              'users_id_approval' => ['users_id_approval'],
              'status' => ['status'],
              'itilfollowups_id' => ['itilfollowups_id'],
          ],
      ]
   ];

   $tables['glpi_knowbaseitemcategories'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'knowbaseitemcategories_id' => [
              'type' => 'integer',
          ],
          'name' => [
              'type' => 'string',
          ],
          'completename' => [
              'type' => 'text',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'level' => [
              'type' => 'integer',
          ],
          'sons_cache' => [
              'type' => 'longtext',
          ],
          'ancestors_cache' => [
              'type' => 'longtext',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['entities_id', 'knowbaseitemcategories_id', 'name'],
          ],
          'KEY' => [
              'name' => ['name'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_knowbaseitems'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'knowbaseitemcategories_id' => [
              'type' => 'integer',
          ],
          'name' => [
              'type' => 'text',
          ],
          'answer' => [
              'type' => 'longtext',
          ],
          'is_faq' => [
              'type' => 'bool',
          ],
          'users_id' => [
              'type' => 'integer',
          ],
          'view' => [
              'type' => 'integer',
          ],
          'date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'begin_date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'end_date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'users_id' => ['users_id'],
              'knowbaseitemcategories_id' => ['knowbaseitemcategories_id'],
              'is_faq' => ['is_faq'],
              'date_mod' => ['date_mod'],
              'begin_date' => ['begin_date'],
              'end_date' => ['end_date'],
              'fulltext' => ['name', 'answer'],
              'name' => ['name'],
              'answer' => ['answer'],
          ],
      ]
   ];

   $tables['glpi_knowbaseitems_comments'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'knowbaseitems_id' => [
              'type' => 'integer',
              'default_value' => null,
              'no_default' => true,
          ],
          'users_id' => [
              'type' => 'integer',
          ],
          'language' => [
              'type' => 'varchar(5)',
              'default_value' => null,
          ],
          'comment' => [
              'type' => 'text',
              'no_default' => true,
          ],
          'parent_comment_id' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
      ]
   ];

   $tables['glpi_knowbaseitems_items'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'knowbaseitems_id' => [
              'type' => 'integer',
              'default_value' => null,
              'no_default' => true,
          ],
          'itemtype' => [
              'type' => 'varchar(100)',
              'default_value' => null,
              'no_default' => true,
          ],
          'items_id' => [
              'type' => 'integer',
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['itemtype', 'items_id', 'knowbaseitems_id'],
          ],
          'KEY' => [
              'itemtype' => ['itemtype'],
              'item_id' => ['items_id'],
              'item' => ['itemtype', 'items_id'],
          ],
      ]
   ];

   $tables['glpi_knowbaseitems_profiles'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'knowbaseitems_id' => [
              'type' => 'integer',
          ],
          'profiles_id' => [
              'type' => 'integer',
          ],
          'entities_id' => [
              'type' => 'integer',
              'default_value' => '-1',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'knowbaseitems_id' => ['knowbaseitems_id'],
              'profiles_id' => ['profiles_id'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
          ],
      ]
   ];

   $tables['glpi_knowbaseitems_revisions'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'knowbaseitems_id' => [
              'type' => 'integer',
              'default_value' => null,
              'no_default' => true,
          ],
          'revision' => [
              'type' => 'integer',
              'default_value' => null,
              'no_default' => true,
          ],
          'name' => [
              'type' => 'text',
          ],
          'answer' => [
              'type' => 'longtext',
          ],
          'language' => [
              'type' => 'varchar(5)',
              'default_value' => null,
          ],
          'users_id' => [
              'type' => 'integer',
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['knowbaseitems_id', 'revision', 'language'],
          ],
          'KEY' => [
              'revision' => ['revision'],
          ],
      ]
   ];

   $tables['glpi_knowbaseitems_users'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'knowbaseitems_id' => [
              'type' => 'integer',
          ],
          'users_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'knowbaseitems_id' => ['knowbaseitems_id'],
              'users_id' => ['users_id'],
          ],
      ]
   ];

   $tables['glpi_knowbaseitemtranslations'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'knowbaseitems_id' => [
              'type' => 'integer',
          ],
          'language' => [
              'type' => 'varchar(5)',
              'default_value' => null,
          ],
          'name' => [
              'type' => 'text',
          ],
          'answer' => [
              'type' => 'longtext',
          ],
          'users_id' => [
              'type' => 'integer',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'item' => ['knowbaseitems_id', 'language'],
              'users_id' => ['users_id'],
              'fulltext' => ['name', 'answer'],
              'name' => ['name'],
              'answer' => ['answer'],
          ],
      ]
   ];

   $tables['glpi_lineoperators'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
              'default_value' => '',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'mcc' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'mnc' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['mcc', 'mnc'],
          ],
          'KEY' => [
              'name' => ['name'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_lines'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
              'default_value' => '',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'caller_num' => [
              'type' => 'string',
              'default_value' => '',
          ],
          'caller_name' => [
              'type' => 'string',
              'default_value' => '',
          ],
          'users_id' => [
              'type' => 'integer',
          ],
          'groups_id' => [
              'type' => 'integer',
          ],
          'lineoperators_id' => [
              'type' => 'integer',
          ],
          'locations_id' => [
              'type' => 'integer',
          ],
          'states_id' => [
              'type' => 'integer',
          ],
          'linetypes_id' => [
              'type' => 'integer',
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'comment' => [
              'type' => 'text',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'users_id' => ['users_id'],
              'lineoperators_id' => ['lineoperators_id'],
          ],
      ]
   ];

   $tables['glpi_linetypes'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_links'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'name' => [
              'type' => 'string',
          ],
          'link' => [
              'type' => 'string',
          ],
          'data' => [
              'type' => 'text',
          ],
          'open_window' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'entities_id' => ['entities_id'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_links_itemtypes'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'links_id' => [
              'type' => 'integer',
          ],
          'itemtype' => [
              'type' => 'varchar(100)',
              'default_value' => null,
              'no_default' => true,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['itemtype', 'links_id'],
          ],
          'KEY' => [
              'links_id' => ['links_id'],
          ],
      ]
   ];

   $tables['glpi_locations'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'name' => [
              'type' => 'string',
          ],
          'locations_id' => [
              'type' => 'integer',
          ],
          'completename' => [
              'type' => 'text',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'level' => [
              'type' => 'integer',
          ],
          'ancestors_cache' => [
              'type' => 'longtext',
          ],
          'sons_cache' => [
              'type' => 'longtext',
          ],
          'address' => [
              'type' => 'text',
          ],
          'postcode' => [
              'type' => 'string',
          ],
          'town' => [
              'type' => 'string',
          ],
          'state' => [
              'type' => 'string',
          ],
          'country' => [
              'type' => 'string',
          ],
          'building' => [
              'type' => 'string',
          ],
          'room' => [
              'type' => 'string',
          ],
          'latitude' => [
              'type' => 'string',
          ],
          'longitude' => [
              'type' => 'string',
          ],
          'altitude' => [
              'type' => 'string',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['entities_id', 'locations_id', 'name'],
          ],
          'KEY' => [
              'locations_id' => ['locations_id'],
              'name' => ['name'],
              'is_recursive' => ['is_recursive'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_logs'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'itemtype' => [
              'type' => 'varchar(100)',
              'default_value' => '',
          ],
          'items_id' => [
              'type' => 'integer',
          ],
          'itemtype_link' => [
              'type' => 'varchar(100)',
              'default_value' => '',
          ],
          'linked_action' => [
              'type' => 'integer',
              'comment' => 'see define.php HISTORY_* constant',
          ],
          'user_name' => [
              'type' => 'string',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'id_search_option' => [
              'type' => 'integer',
              'comment' => 'see search.constant.php for value',
          ],
          'old_value' => [
              'type' => 'string',
          ],
          'new_value' => [
              'type' => 'string',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'date_mod' => ['date_mod'],
              'itemtype_link' => ['itemtype_link'],
              'item' => ['itemtype', 'items_id'],
              'id_search_option' => ['id_search_option'],
          ],
      ]
   ];

   $tables['glpi_mailcollectors'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'host' => [
              'type' => 'string',
          ],
          'login' => [
              'type' => 'string',
          ],
          'filesize_max' => [
              'type' => 'integer',
              'default_value' => '2097152',
          ],
          'is_active' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'comment' => [
              'type' => 'text',
          ],
          'passwd' => [
              'type' => 'string',
          ],
          'accepted' => [
              'type' => 'string',
          ],
          'refused' => [
              'type' => 'string',
          ],
          'use_kerberos' => [
              'type' => 'bool',
          ],
          'errors' => [
              'type' => 'integer',
          ],
          'use_mail_date' => [
              'type' => 'bool',
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'requester_field' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'is_active' => ['is_active'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_manufacturers'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_monitormodels'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'product_number' => [
              'type' => 'string',
          ],
          'weight' => [
              'type' => 'integer',
          ],
          'required_units' => [
              'type' => 'integer',
              'default_value' => '1',
          ],
          'depth' => [
              'type' => 'float',
              'default_value' => '1',
          ],
          'power_connections' => [
              'type' => 'integer',
          ],
          'power_consumption' => [
              'type' => 'integer',
          ],
          'is_half_rack' => [
              'type' => 'bool',
          ],
          'picture_front' => [
              'type' => 'text',
          ],
          'picture_rear' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
              'product_number' => ['product_number'],
          ],
      ]
   ];

   $tables['glpi_monitors'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'name' => [
              'type' => 'string',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'contact' => [
              'type' => 'string',
          ],
          'contact_num' => [
              'type' => 'string',
          ],
          'users_id_tech' => [
              'type' => 'integer',
          ],
          'groups_id_tech' => [
              'type' => 'integer',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'serial' => [
              'type' => 'string',
          ],
          'otherserial' => [
              'type' => 'string',
          ],
          'size' => [
              'type' => 'decimal(5,2)',
              'default_value' => '0.00',
          ],
          'have_micro' => [
              'type' => 'bool',
          ],
          'have_speaker' => [
              'type' => 'bool',
          ],
          'have_subd' => [
              'type' => 'bool',
          ],
          'have_bnc' => [
              'type' => 'bool',
          ],
          'have_dvi' => [
              'type' => 'bool',
          ],
          'have_pivot' => [
              'type' => 'bool',
          ],
          'have_hdmi' => [
              'type' => 'bool',
          ],
          'have_displayport' => [
              'type' => 'bool',
          ],
          'locations_id' => [
              'type' => 'integer',
          ],
          'monitortypes_id' => [
              'type' => 'integer',
          ],
          'monitormodels_id' => [
              'type' => 'integer',
          ],
          'manufacturers_id' => [
              'type' => 'integer',
          ],
          'is_global' => [
              'type' => 'bool',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'is_template' => [
              'type' => 'bool',
          ],
          'template_name' => [
              'type' => 'string',
          ],
          'users_id' => [
              'type' => 'integer',
          ],
          'groups_id' => [
              'type' => 'integer',
          ],
          'states_id' => [
              'type' => 'integer',
          ],
          'ticket_tco' => [
              'type' => 'decimal(20,4)',
              'default_value' => '0.0000',
          ],
          'is_dynamic' => [
              'type' => 'bool',
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'is_template' => ['is_template'],
              'is_global' => ['is_global'],
              'entities_id' => ['entities_id'],
              'manufacturers_id' => ['manufacturers_id'],
              'groups_id' => ['groups_id'],
              'users_id' => ['users_id'],
              'locations_id' => ['locations_id'],
              'monitormodels_id' => ['monitormodels_id'],
              'states_id' => ['states_id'],
              'users_id_tech' => ['users_id_tech'],
              'monitortypes_id' => ['monitortypes_id'],
              'is_deleted' => ['is_deleted'],
              'groups_id_tech' => ['groups_id_tech'],
              'is_dynamic' => ['is_dynamic'],
              'serial' => ['serial'],
              'otherserial' => ['otherserial'],
              'date_creation' => ['date_creation'],
              'is_recursive' => ['is_recursive'],
          ],
      ]
   ];

   $tables['glpi_monitortypes'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_netpoints'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'locations_id' => [
              'type' => 'integer',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'complete' => ['entities_id', 'locations_id', 'name'],
              'location_name' => ['locations_id', 'name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_networkaliases'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'networknames_id' => [
              'type' => 'integer',
          ],
          'name' => [
              'type' => 'string',
          ],
          'fqdns_id' => [
              'type' => 'integer',
          ],
          'comment' => [
              'type' => 'text',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'entities_id' => ['entities_id'],
              'name' => ['name'],
              'networknames_id' => ['networknames_id'],
          ],
      ]
   ];

   $tables['glpi_networkequipmentmodels'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'product_number' => [
              'type' => 'string',
          ],
          'weight' => [
              'type' => 'integer',
          ],
          'required_units' => [
              'type' => 'integer',
              'default_value' => '1',
          ],
          'depth' => [
              'type' => 'float',
              'default_value' => '1',
          ],
          'power_connections' => [
              'type' => 'integer',
          ],
          'power_consumption' => [
              'type' => 'integer',
          ],
          'is_half_rack' => [
              'type' => 'bool',
          ],
          'picture_front' => [
              'type' => 'text',
          ],
          'picture_rear' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
              'product_number' => ['product_number'],
          ],
      ]
   ];

   $tables['glpi_networkequipments'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'name' => [
              'type' => 'string',
          ],
          'ram' => [
              'type' => 'string',
          ],
          'serial' => [
              'type' => 'string',
          ],
          'otherserial' => [
              'type' => 'string',
          ],
          'contact' => [
              'type' => 'string',
          ],
          'contact_num' => [
              'type' => 'string',
          ],
          'users_id_tech' => [
              'type' => 'integer',
          ],
          'groups_id_tech' => [
              'type' => 'integer',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'comment' => [
              'type' => 'text',
          ],
          'locations_id' => [
              'type' => 'integer',
          ],
          'domains_id' => [
              'type' => 'integer',
          ],
          'networks_id' => [
              'type' => 'integer',
          ],
          'networkequipmenttypes_id' => [
              'type' => 'integer',
          ],
          'networkequipmentmodels_id' => [
              'type' => 'integer',
          ],
          'manufacturers_id' => [
              'type' => 'integer',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'is_template' => [
              'type' => 'bool',
          ],
          'template_name' => [
              'type' => 'string',
          ],
          'users_id' => [
              'type' => 'integer',
          ],
          'groups_id' => [
              'type' => 'integer',
          ],
          'states_id' => [
              'type' => 'integer',
          ],
          'ticket_tco' => [
              'type' => 'decimal(20,4)',
              'default_value' => '0.0000',
          ],
          'is_dynamic' => [
              'type' => 'bool',
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'is_template' => ['is_template'],
              'domains_id' => ['domains_id'],
              'entities_id' => ['entities_id'],
              'manufacturers_id' => ['manufacturers_id'],
              'groups_id' => ['groups_id'],
              'users_id' => ['users_id'],
              'locations_id' => ['locations_id'],
              'networkequipmentmodels_id' => ['networkequipmentmodels_id'],
              'networks_id' => ['networks_id'],
              'states_id' => ['states_id'],
              'users_id_tech' => ['users_id_tech'],
              'networkequipmenttypes_id' => ['networkequipmenttypes_id'],
              'is_deleted' => ['is_deleted'],
              'date_mod' => ['date_mod'],
              'groups_id_tech' => ['groups_id_tech'],
              'is_dynamic' => ['is_dynamic'],
              'serial' => ['serial'],
              'otherserial' => ['otherserial'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_networkequipmenttypes'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_networkinterfaces'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
          ],
      ]
   ];

   $tables['glpi_networknames'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'items_id' => [
              'type' => 'integer',
          ],
          'itemtype' => [
              'type' => 'varchar(100)',
              'default_value' => null,
              'no_default' => true,
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'fqdns_id' => [
              'type' => 'integer',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'is_dynamic' => [
              'type' => 'bool',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'entities_id' => ['entities_id'],
              'FQDN' => ['name', 'fqdns_id'],
              'name' => ['name'],
              'fqdns_id' => ['fqdns_id'],
              'is_deleted' => ['is_deleted'],
              'is_dynamic' => ['is_dynamic'],
              'item' => ['itemtype', 'items_id', 'is_deleted'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_networkportaggregates'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'networkports_id' => [
              'type' => 'integer',
          ],
          'networkports_id_list' => [
              'type' => 'text',
              'comment' => 'array of associated networkports_id',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'networkports_id' => ['networkports_id'],
          ],
          'KEY' => [
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_networkportaliases'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'networkports_id' => [
              'type' => 'integer',
          ],
          'networkports_id_alias' => [
              'type' => 'integer',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'networkports_id' => ['networkports_id'],
          ],
          'KEY' => [
              'networkports_id_alias' => ['networkports_id_alias'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_networkportdialups'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'networkports_id' => [
              'type' => 'integer',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'networkports_id' => ['networkports_id'],
          ],
          'KEY' => [
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_networkportethernets'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'networkports_id' => [
              'type' => 'integer',
          ],
          'items_devicenetworkcards_id' => [
              'type' => 'integer',
          ],
          'netpoints_id' => [
              'type' => 'integer',
          ],
          'type' => [
              'type' => 'varchar(10)',
              'default_value' => '',
              'comment' => 'T, LX, SX',
          ],
          'speed' => [
              'type' => 'integer',
              'default_value' => '10',
              'comment' => 'Mbit/s: 10, 100, 1000, 10000',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'networkports_id' => ['networkports_id'],
          ],
          'KEY' => [
              'card' => ['items_devicenetworkcards_id'],
              'netpoint' => ['netpoints_id'],
              'type' => ['type'],
              'speed' => ['speed'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_networkportfiberchannels'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'networkports_id' => [
              'type' => 'integer',
          ],
          'items_devicenetworkcards_id' => [
              'type' => 'integer',
          ],
          'netpoints_id' => [
              'type' => 'integer',
          ],
          'wwn' => [
              'type' => 'varchar(16)',
              'default_value' => '',
          ],
          'speed' => [
              'type' => 'integer',
              'default_value' => '10',
              'comment' => 'Mbit/s: 10, 100, 1000, 10000',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'networkports_id' => ['networkports_id'],
          ],
          'KEY' => [
              'card' => ['items_devicenetworkcards_id'],
              'netpoint' => ['netpoints_id'],
              'wwn' => ['wwn'],
              'speed' => ['speed'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_networkportlocals'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'networkports_id' => [
              'type' => 'integer',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'networkports_id' => ['networkports_id'],
          ],
          'KEY' => [
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_networkports'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'items_id' => [
              'type' => 'integer',
          ],
          'itemtype' => [
              'type' => 'varchar(100)',
              'default_value' => null,
              'no_default' => true,
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'logical_number' => [
              'type' => 'integer',
          ],
          'name' => [
              'type' => 'string',
          ],
          'instantiation_type' => [
              'type' => 'string',
          ],
          'mac' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'is_dynamic' => [
              'type' => 'bool',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'on_device' => ['items_id', 'itemtype'],
              'item' => ['itemtype', 'items_id'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'mac' => ['mac'],
              'is_deleted' => ['is_deleted'],
              'is_dynamic' => ['is_dynamic'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_networkports_networkports'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'networkports_id_1' => [
              'type' => 'integer',
          ],
          'networkports_id_2' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['networkports_id_1', 'networkports_id_2'],
          ],
          'KEY' => [
              'networkports_id_2' => ['networkports_id_2'],
          ],
      ]
   ];

   $tables['glpi_networkports_vlans'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'networkports_id' => [
              'type' => 'integer',
          ],
          'vlans_id' => [
              'type' => 'integer',
          ],
          'tagged' => [
              'type' => 'bool',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['networkports_id', 'vlans_id'],
          ],
          'KEY' => [
              'vlans_id' => ['vlans_id'],
          ],
      ]
   ];

   $tables['glpi_networkportwifis'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'networkports_id' => [
              'type' => 'integer',
          ],
          'items_devicenetworkcards_id' => [
              'type' => 'integer',
          ],
          'wifinetworks_id' => [
              'type' => 'integer',
          ],
          'networkportwifis_id' => [
              'type' => 'integer',
              'comment' => 'only useful in case of Managed node',
          ],
          'version' => [
              'type' => 'varchar(20)',
              'default_value' => null,
              'comment' => 'a, a/b, a/b/g, a/b/g/n, a/b/g/n/y',
          ],
          'mode' => [
              'type' => 'varchar(20)',
              'default_value' => null,
              'comment' => 'ad-hoc, managed, master, repeater, secondary, monitor, auto',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'networkports_id' => ['networkports_id'],
          ],
          'KEY' => [
              'card' => ['items_devicenetworkcards_id'],
              'essid' => ['wifinetworks_id'],
              'version' => ['version'],
              'mode' => ['mode'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_networks'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_notepads'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'itemtype' => [
              'type' => 'varchar(100)',
              'default_value' => null,
          ],
          'items_id' => [
              'type' => 'integer',
          ],
          'date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'users_id' => [
              'type' => 'integer',
          ],
          'users_id_lastupdater' => [
              'type' => 'integer',
          ],
          'content' => [
              'type' => 'longtext',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'item' => ['itemtype', 'items_id'],
              'date_mod' => ['date_mod'],
              'date' => ['date'],
              'users_id_lastupdater' => ['users_id_lastupdater'],
              'users_id' => ['users_id'],
          ],
      ]
   ];

   $tables['glpi_notifications'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'itemtype' => [
              'type' => 'varchar(100)',
              'default_value' => null,
              'no_default' => true,
          ],
          'event' => [
              'type' => 'string',
              'no_default' => true,
          ],
          'comment' => [
              'type' => 'text',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'is_active' => [
              'type' => 'bool',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'itemtype' => ['itemtype'],
              'entities_id' => ['entities_id'],
              'is_active' => ['is_active'],
              'date_mod' => ['date_mod'],
              'is_recursive' => ['is_recursive'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_notifications_notificationtemplates'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'notifications_id' => [
              'type' => 'integer',
          ],
          'mode' => [
              'type' => 'varchar(20)',
              'default_value' => null,
              'no_default' => true,
              'comment' => 'See Notification_NotificationTemplate::MODE_* constants',
          ],
          'notificationtemplates_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['notifications_id', 'mode', 'notificationtemplates_id'],
          ],
          'KEY' => [
              'notifications_id' => ['notifications_id'],
              'notificationtemplates_id' => ['notificationtemplates_id'],
              'mode' => ['mode'],
          ],
      ]
   ];

   $tables['glpi_notificationtargets'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'items_id' => [
              'type' => 'integer',
          ],
          'type' => [
              'type' => 'integer',
          ],
          'notifications_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'items' => ['type', 'items_id'],
              'notifications_id' => ['notifications_id'],
          ],
      ]
   ];

   $tables['glpi_notificationtemplates'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'itemtype' => [
              'type' => 'varchar(100)',
              'default_value' => null,
              'no_default' => true,
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'comment' => [
              'type' => 'text',
          ],
          'css' => [
              'type' => 'text',
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'itemtype' => ['itemtype'],
              'date_mod' => ['date_mod'],
              'name' => ['name'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_notificationtemplatetranslations'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'notificationtemplates_id' => [
              'type' => 'integer',
          ],
          'language' => [
              'type' => 'char(5)',
              'default_value' => '',
          ],
          'subject' => [
              'type' => 'string',
              'no_default' => true,
          ],
          'content_text' => [
              'type' => 'text',
          ],
          'content_html' => [
              'type' => 'text',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'notificationtemplates_id' => ['notificationtemplates_id'],
          ],
      ]
   ];

   $tables['glpi_notimportedemails'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'from' => [
              'type' => 'string',
              'no_default' => true,
          ],
          'to' => [
              'type' => 'string',
              'no_default' => true,
          ],
          'mailcollectors_id' => [
              'type' => 'integer',
          ],
          'date' => [
              'type' => 'timestamp',
          ],
          'subject' => [
              'type' => 'text',
          ],
          'messageid' => [
              'type' => 'string',
              'no_default' => true,
          ],
          'reason' => [
              'type' => 'integer',
          ],
          'users_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'users_id' => ['users_id'],
              'mailcollectors_id' => ['mailcollectors_id'],
          ],
      ]
   ];

   $tables['glpi_objectlocks'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'itemtype' => [
              'type' => 'varchar(100)',
              'default_value' => null,
              'no_default' => true,
              'comment' => 'Type of locked object',
          ],
          'items_id' => [
              'type' => 'integer',
              'default_value' => null,
              'no_default' => true,
              'comment' => 'RELATION to various $tables, according to itemtype (ID)',
          ],
          'users_id' => [
              'type' => 'integer',
              'default_value' => null,
              'no_default' => true,
              'comment' => 'id of the locker',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'comment' => 'Timestamp of the lock',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'item' => ['itemtype', 'items_id'],
          ],
      ]
   ];

   $tables['glpi_olalevelactions'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'olalevels_id' => [
              'type' => 'integer',
          ],
          'action_type' => [
              'type' => 'string',
          ],
          'field' => [
              'type' => 'string',
          ],
          'value' => [
              'type' => 'string',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'olalevels_id' => ['olalevels_id'],
          ],
      ]
   ];

   $tables['glpi_olalevelcriterias'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'olalevels_id' => [
              'type' => 'integer',
          ],
          'criteria' => [
              'type' => 'string',
          ],
          'condition' => [
              'type' => 'integer',
              'comment' => 'see define.php PATTERN_* and REGEX_* constant',
          ],
          'pattern' => [
              'type' => 'string',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'olalevels_id' => ['olalevels_id'],
              'condition' => ['condition'],
          ],
      ]
   ];

   $tables['glpi_olalevels'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'olas_id' => [
              'type' => 'integer',
          ],
          'execution_time' => [
              'type' => 'integer',
              'default_value' => null,
              'no_default' => true,
          ],
          'is_active' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'match' => [
              'type' => 'char(10)',
              'default_value' => null,
              'comment' => 'see define.php *_MATCHING constant',
          ],
          'uuid' => [
              'type' => 'string',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'is_active' => ['is_active'],
              'olas_id' => ['olas_id'],
          ],
      ]
   ];

   $tables['glpi_olalevels_tickets'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'tickets_id' => [
              'type' => 'integer',
          ],
          'olalevels_id' => [
              'type' => 'integer',
          ],
          'date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['tickets_id', 'olalevels_id'],
          ],
          'KEY' => [
              'tickets_id' => ['tickets_id'],
              'olalevels_id' => ['olalevels_id'],
          ],
      ]
   ];

   $tables['glpi_olas'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'type' => [
              'type' => 'integer',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'number_time' => [
              'type' => 'integer',
              'default_value' => null,
              'no_default' => true,
          ],
          'calendars_id' => [
              'type' => 'integer',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'definition_time' => [
              'type' => 'string',
          ],
          'end_of_working_day' => [
              'type' => 'bool',
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'slms_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
              'calendars_id' => ['calendars_id'],
              'slms_id' => ['slms_id'],
          ],
      ]
   ];

   $tables['glpi_operatingsystemarchitectures'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_operatingsystemeditions'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
          ],
      ]
   ];

   $tables['glpi_operatingsystemkernels'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
          ],
      ]
   ];

   $tables['glpi_operatingsystemkernelversions'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'operatingsystemkernels_id' => [
              'type' => 'integer',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'operatingsystemkernels_id' => ['operatingsystemkernels_id'],
          ],
      ]
   ];

   $tables['glpi_operatingsystems'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_operatingsystemservicepacks'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_operatingsystemversions'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_pdumodels'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'product_number' => [
              'type' => 'string',
          ],
          'weight' => [
              'type' => 'integer',
          ],
          'required_units' => [
              'type' => 'integer',
              'default_value' => '1',
          ],
          'depth' => [
              'type' => 'float',
              'default_value' => '1',
          ],
          'power_connections' => [
              'type' => 'integer',
          ],
          'max_power' => [
              'type' => 'integer',
          ],
          'is_half_rack' => [
              'type' => 'bool',
          ],
          'picture_front' => [
              'type' => 'text',
          ],
          'picture_rear' => [
              'type' => 'text',
          ],
          'is_rackable' => [
              'type' => 'bool',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'is_rackable' => ['is_rackable'],
              'product_number' => ['product_number'],
          ],
      ]
   ];

   $tables['glpi_pdus'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'locations_id' => [
              'type' => 'integer',
          ],
          'serial' => [
              'type' => 'string',
          ],
          'otherserial' => [
              'type' => 'string',
          ],
          'pdumodels_id' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'users_id_tech' => [
              'type' => 'integer',
          ],
          'groups_id_tech' => [
              'type' => 'integer',
          ],
          'is_template' => [
              'type' => 'bool',
          ],
          'template_name' => [
              'type' => 'string',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'states_id' => [
              'type' => 'integer',
              'comment' => 'RELATION to states (id)',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'manufacturers_id' => [
              'type' => 'integer',
          ],
          'pdutypes_id' => [
              'type' => 'integer',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'locations_id' => ['locations_id'],
              'pdumodels_id' => ['pdumodels_id'],
              'users_id_tech' => ['users_id_tech'],
              'group_id_tech' => ['groups_id_tech'],
              'is_template' => ['is_template'],
              'is_deleted' => ['is_deleted'],
              'states_id' => ['states_id'],
              'manufacturers_id' => ['manufacturers_id'],
              'pdutypes_id' => ['pdutypes_id'],
          ],
      ]
   ];

   $tables['glpi_pdus_plugs'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'plugs_id' => [
              'type' => 'integer',
          ],
          'pdus_id' => [
              'type' => 'integer',
          ],
          'number_plugs' => [
              'type' => 'integer',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'plugs_id' => ['plugs_id'],
              'pdus_id' => ['pdus_id'],
          ],
      ]
   ];

   $tables['glpi_pdus_racks'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'racks_id' => [
              'type' => 'integer',
          ],
          'pdus_id' => [
              'type' => 'integer',
          ],
          'side' => [
              'type' => 'integer',
          ],
          'position' => [
              'type' => 'integer',
              'default_value' => null,
              'no_default' => true,
          ],
          'bgcolor' => [
              'type' => 'varchar(7)',
              'default_value' => null,
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'racks_id' => ['racks_id'],
              'pdus_id' => ['pdus_id'],
          ],
      ]
   ];

   $tables['glpi_pdutypes'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'name' => ['name'],
              'date_creation' => ['date_creation'],
              'date_mod' => ['date_mod'],
          ],
      ]
   ];

   $tables['glpi_peripheralmodels'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'product_number' => [
              'type' => 'string',
          ],
          'weight' => [
              'type' => 'integer',
          ],
          'required_units' => [
              'type' => 'integer',
              'default_value' => '1',
          ],
          'depth' => [
              'type' => 'float',
              'default_value' => '1',
          ],
          'power_connections' => [
              'type' => 'integer',
          ],
          'power_consumption' => [
              'type' => 'integer',
          ],
          'is_half_rack' => [
              'type' => 'bool',
          ],
          'picture_front' => [
              'type' => 'text',
          ],
          'picture_rear' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
              'product_number' => ['product_number'],
          ],
      ]
   ];

   $tables['glpi_peripherals'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'name' => [
              'type' => 'string',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'contact' => [
              'type' => 'string',
          ],
          'contact_num' => [
              'type' => 'string',
          ],
          'users_id_tech' => [
              'type' => 'integer',
          ],
          'groups_id_tech' => [
              'type' => 'integer',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'serial' => [
              'type' => 'string',
          ],
          'otherserial' => [
              'type' => 'string',
          ],
          'locations_id' => [
              'type' => 'integer',
          ],
          'peripheraltypes_id' => [
              'type' => 'integer',
          ],
          'peripheralmodels_id' => [
              'type' => 'integer',
          ],
          'brand' => [
              'type' => 'string',
          ],
          'manufacturers_id' => [
              'type' => 'integer',
          ],
          'is_global' => [
              'type' => 'bool',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'is_template' => [
              'type' => 'bool',
          ],
          'template_name' => [
              'type' => 'string',
          ],
          'users_id' => [
              'type' => 'integer',
          ],
          'groups_id' => [
              'type' => 'integer',
          ],
          'states_id' => [
              'type' => 'integer',
          ],
          'ticket_tco' => [
              'type' => 'decimal(20,4)',
              'default_value' => '0.0000',
          ],
          'is_dynamic' => [
              'type' => 'bool',
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'is_template' => ['is_template'],
              'is_global' => ['is_global'],
              'entities_id' => ['entities_id'],
              'manufacturers_id' => ['manufacturers_id'],
              'groups_id' => ['groups_id'],
              'users_id' => ['users_id'],
              'locations_id' => ['locations_id'],
              'peripheralmodels_id' => ['peripheralmodels_id'],
              'states_id' => ['states_id'],
              'users_id_tech' => ['users_id_tech'],
              'peripheraltypes_id' => ['peripheraltypes_id'],
              'is_deleted' => ['is_deleted'],
              'date_mod' => ['date_mod'],
              'groups_id_tech' => ['groups_id_tech'],
              'is_dynamic' => ['is_dynamic'],
              'serial' => ['serial'],
              'otherserial' => ['otherserial'],
              'date_creation' => ['date_creation'],
              'is_recursive' => ['is_recursive'],
          ],
      ]
   ];

   $tables['glpi_peripheraltypes'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_phonemodels'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'product_number' => [
              'type' => 'string',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
              'product_number' => ['product_number'],
          ],
      ]
   ];

   $tables['glpi_phonepowersupplies'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_phones'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'name' => [
              'type' => 'string',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'contact' => [
              'type' => 'string',
          ],
          'contact_num' => [
              'type' => 'string',
          ],
          'users_id_tech' => [
              'type' => 'integer',
          ],
          'groups_id_tech' => [
              'type' => 'integer',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'serial' => [
              'type' => 'string',
          ],
          'otherserial' => [
              'type' => 'string',
          ],
          'locations_id' => [
              'type' => 'integer',
          ],
          'phonetypes_id' => [
              'type' => 'integer',
          ],
          'phonemodels_id' => [
              'type' => 'integer',
          ],
          'brand' => [
              'type' => 'string',
          ],
          'phonepowersupplies_id' => [
              'type' => 'integer',
          ],
          'number_line' => [
              'type' => 'string',
          ],
          'have_headset' => [
              'type' => 'bool',
          ],
          'have_hp' => [
              'type' => 'bool',
          ],
          'manufacturers_id' => [
              'type' => 'integer',
          ],
          'is_global' => [
              'type' => 'bool',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'is_template' => [
              'type' => 'bool',
          ],
          'template_name' => [
              'type' => 'string',
          ],
          'users_id' => [
              'type' => 'integer',
          ],
          'groups_id' => [
              'type' => 'integer',
          ],
          'states_id' => [
              'type' => 'integer',
          ],
          'ticket_tco' => [
              'type' => 'decimal(20,4)',
              'default_value' => '0.0000',
          ],
          'is_dynamic' => [
              'type' => 'bool',
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'is_template' => ['is_template'],
              'is_global' => ['is_global'],
              'entities_id' => ['entities_id'],
              'manufacturers_id' => ['manufacturers_id'],
              'groups_id' => ['groups_id'],
              'users_id' => ['users_id'],
              'locations_id' => ['locations_id'],
              'phonemodels_id' => ['phonemodels_id'],
              'phonepowersupplies_id' => ['phonepowersupplies_id'],
              'states_id' => ['states_id'],
              'users_id_tech' => ['users_id_tech'],
              'phonetypes_id' => ['phonetypes_id'],
              'is_deleted' => ['is_deleted'],
              'date_mod' => ['date_mod'],
              'groups_id_tech' => ['groups_id_tech'],
              'is_dynamic' => ['is_dynamic'],
              'serial' => ['serial'],
              'otherserial' => ['otherserial'],
              'date_creation' => ['date_creation'],
              'is_recursive' => ['is_recursive'],
          ],
      ]
   ];

   $tables['glpi_phonetypes'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_planningrecalls'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'items_id' => [
              'type' => 'integer',
          ],
          'itemtype' => [
              'type' => 'varchar(100)',
              'default_value' => null,
              'no_default' => true,
          ],
          'users_id' => [
              'type' => 'integer',
          ],
          'before_time' => [
              'type' => 'integer',
              'default_value' => '-10',
          ],
          'when' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['itemtype', 'items_id', 'users_id'],
          ],
          'KEY' => [
              'users_id' => ['users_id'],
              'before_time' => ['before_time'],
              'when' => ['when'],
          ],
      ]
   ];

   $tables['glpi_plugins'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'directory' => [
              'type' => 'string',
              'no_default' => true,
          ],
          'name' => [
              'type' => 'string',
              'no_default' => true,
          ],
          'version' => [
              'type' => 'string',
              'no_default' => true,
          ],
          'state' => [
              'type' => 'integer',
              'comment' => 'see define.php PLUGIN_* constant',
          ],
          'author' => [
              'type' => 'string',
          ],
          'homepage' => [
              'type' => 'string',
          ],
          'license' => [
              'type' => 'string',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['directory'],
          ],
          'KEY' => [
              'state' => ['state'],
          ],
      ]
   ];

   $tables['glpi_plugs'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_printermodels'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'product_number' => [
              'type' => 'string',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
              'product_number' => ['product_number'],
          ],
      ]
   ];

   $tables['glpi_printers'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'name' => [
              'type' => 'string',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'contact' => [
              'type' => 'string',
          ],
          'contact_num' => [
              'type' => 'string',
          ],
          'users_id_tech' => [
              'type' => 'integer',
          ],
          'groups_id_tech' => [
              'type' => 'integer',
          ],
          'serial' => [
              'type' => 'string',
          ],
          'otherserial' => [
              'type' => 'string',
          ],
          'have_serial' => [
              'type' => 'bool',
          ],
          'have_parallel' => [
              'type' => 'bool',
          ],
          'have_usb' => [
              'type' => 'bool',
          ],
          'have_wifi' => [
              'type' => 'bool',
          ],
          'have_ethernet' => [
              'type' => 'bool',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'memory_size' => [
              'type' => 'string',
          ],
          'locations_id' => [
              'type' => 'integer',
          ],
          'domains_id' => [
              'type' => 'integer',
          ],
          'networks_id' => [
              'type' => 'integer',
          ],
          'printertypes_id' => [
              'type' => 'integer',
          ],
          'printermodels_id' => [
              'type' => 'integer',
          ],
          'manufacturers_id' => [
              'type' => 'integer',
          ],
          'is_global' => [
              'type' => 'bool',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'is_template' => [
              'type' => 'bool',
          ],
          'template_name' => [
              'type' => 'string',
          ],
          'init_pages_counter' => [
              'type' => 'integer',
          ],
          'last_pages_counter' => [
              'type' => 'integer',
          ],
          'users_id' => [
              'type' => 'integer',
          ],
          'groups_id' => [
              'type' => 'integer',
          ],
          'states_id' => [
              'type' => 'integer',
          ],
          'ticket_tco' => [
              'type' => 'decimal(20,4)',
              'default_value' => '0.0000',
          ],
          'is_dynamic' => [
              'type' => 'bool',
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'is_template' => ['is_template'],
              'is_global' => ['is_global'],
              'domains_id' => ['domains_id'],
              'entities_id' => ['entities_id'],
              'manufacturers_id' => ['manufacturers_id'],
              'groups_id' => ['groups_id'],
              'users_id' => ['users_id'],
              'locations_id' => ['locations_id'],
              'printermodels_id' => ['printermodels_id'],
              'networks_id' => ['networks_id'],
              'states_id' => ['states_id'],
              'users_id_tech' => ['users_id_tech'],
              'printertypes_id' => ['printertypes_id'],
              'is_deleted' => ['is_deleted'],
              'date_mod' => ['date_mod'],
              'groups_id_tech' => ['groups_id_tech'],
              'last_pages_counter' => ['last_pages_counter'],
              'is_dynamic' => ['is_dynamic'],
              'serial' => ['serial'],
              'otherserial' => ['otherserial'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_printertypes'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_problemcosts'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'problems_id' => [
              'type' => 'integer',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'begin_date' => [
              'type' => 'date',
              'default_value' => null,
          ],
          'end_date' => [
              'type' => 'date',
              'default_value' => null,
          ],
          'actiontime' => [
              'type' => 'integer',
          ],
          'cost_time' => [
              'type' => 'decimal(20,4)',
              'default_value' => '0.0000',
          ],
          'cost_fixed' => [
              'type' => 'decimal(20,4)',
              'default_value' => '0.0000',
          ],
          'cost_material' => [
              'type' => 'decimal(20,4)',
              'default_value' => '0.0000',
          ],
          'budgets_id' => [
              'type' => 'integer',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'problems_id' => ['problems_id'],
              'begin_date' => ['begin_date'],
              'end_date' => ['end_date'],
              'entities_id' => ['entities_id'],
              'budgets_id' => ['budgets_id'],
          ],
      ]
   ];

   $tables['glpi_problems'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'status' => [
              'type' => 'integer',
              'default_value' => '1',
          ],
          'content' => [
              'type' => 'longtext',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'solvedate' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'closedate' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'time_to_resolve' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'users_id_recipient' => [
              'type' => 'integer',
          ],
          'users_id_lastupdater' => [
              'type' => 'integer',
          ],
          'urgency' => [
              'type' => 'integer',
              'default_value' => '1',
          ],
          'impact' => [
              'type' => 'integer',
              'default_value' => '1',
          ],
          'priority' => [
              'type' => 'integer',
              'default_value' => '1',
          ],
          'itilcategories_id' => [
              'type' => 'integer',
          ],
          'impactcontent' => [
              'type' => 'longtext',
          ],
          'causecontent' => [
              'type' => 'longtext',
          ],
          'symptomcontent' => [
              'type' => 'longtext',
          ],
          'actiontime' => [
              'type' => 'integer',
          ],
          'begin_waiting_date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'waiting_duration' => [
              'type' => 'integer',
          ],
          'close_delay_stat' => [
              'type' => 'integer',
          ],
          'solve_delay_stat' => [
              'type' => 'integer',
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'is_deleted' => ['is_deleted'],
              'date' => ['date'],
              'closedate' => ['closedate'],
              'status' => ['status'],
              'priority' => ['priority'],
              'date_mod' => ['date_mod'],
              'itilcategories_id' => ['itilcategories_id'],
              'users_id_recipient' => ['users_id_recipient'],
              'solvedate' => ['solvedate'],
              'urgency' => ['urgency'],
              'impact' => ['impact'],
              'time_to_resolve' => ['time_to_resolve'],
              'users_id_lastupdater' => ['users_id_lastupdater'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_problems_suppliers'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'problems_id' => [
              'type' => 'integer',
          ],
          'suppliers_id' => [
              'type' => 'integer',
          ],
          'type' => [
              'type' => 'integer',
              'default_value' => '1',
          ],
          'use_notification' => [
              'type' => 'bool',
          ],
          'alternative_email' => [
              'type' => 'string',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['problems_id', 'type', 'suppliers_id'],
          ],
          'KEY' => [
              'group' => ['suppliers_id', 'type'],
          ],
      ]
   ];

   $tables['glpi_problems_tickets'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'problems_id' => [
              'type' => 'integer',
          ],
          'tickets_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['problems_id', 'tickets_id'],
          ],
          'KEY' => [
              'tickets_id' => ['tickets_id'],
          ],
      ]
   ];

   $tables['glpi_problems_users'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'problems_id' => [
              'type' => 'integer',
          ],
          'users_id' => [
              'type' => 'integer',
          ],
          'type' => [
              'type' => 'integer',
              'default_value' => '1',
          ],
          'use_notification' => [
              'type' => 'bool',
          ],
          'alternative_email' => [
              'type' => 'string',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['problems_id', 'type', 'users_id', 'alternative_email'],
          ],
          'KEY' => [
              'user' => ['users_id', 'type'],
          ],
      ]
   ];

   $tables['glpi_problemtasks'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'problems_id' => [
              'type' => 'integer',
          ],
          'taskcategories_id' => [
              'type' => 'integer',
          ],
          'date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'begin' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'end' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'users_id' => [
              'type' => 'integer',
          ],
          'users_id_editor' => [
              'type' => 'integer',
          ],
          'users_id_tech' => [
              'type' => 'integer',
          ],
          'groups_id_tech' => [
              'type' => 'integer',
          ],
          'content' => [
              'type' => 'longtext',
          ],
          'actiontime' => [
              'type' => 'integer',
          ],
          'state' => [
              'type' => 'integer',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'tasktemplates_id' => [
              'type' => 'integer',
          ],
          'timeline_position' => [
              'type' => 'bool',
          ],
          'is_private' => [
              'type' => 'bool',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'problems_id' => ['problems_id'],
              'users_id' => ['users_id'],
              'users_id_editor' => ['users_id_editor'],
              'users_id_tech' => ['users_id_tech'],
              'groups_id_tech' => ['groups_id_tech'],
              'date' => ['date'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
              'begin' => ['begin'],
              'end' => ['end'],
              'state' => ['state'],
              'taskcategories_id' => ['taskcategories_id'],
              'tasktemplates_id' => ['tasktemplates_id'],
              'is_private' => ['is_private'],
          ],
      ]
   ];

   $tables['glpi_profilerights'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'profiles_id' => [
              'type' => 'integer',
          ],
          'name' => [
              'type' => 'string',
          ],
          'rights' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['profiles_id', 'name'],
          ],
      ]
   ];

   $tables['glpi_profiles'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'interface' => [
              'type' => 'string',
              'default_value' => 'helpdesk',
          ],
          'is_default' => [
              'type' => 'bool',
          ],
          'helpdesk_hardware' => [
              'type' => 'integer',
          ],
          'helpdesk_item_type' => [
              'type' => 'text',
          ],
          'ticket_status' => [
              'type' => 'text',
              'comment' => 'json encoded array of from/dest allowed status change',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'comment' => [
              'type' => 'text',
          ],
          'problem_status' => [
              'type' => 'text',
              'comment' => 'json encoded array of from/dest allowed status change',
          ],
          'create_ticket_on_login' => [
              'type' => 'bool',
          ],
          'tickettemplates_id' => [
              'type' => 'integer',
          ],
          'change_status' => [
              'type' => 'text',
              'comment' => 'json encoded array of from/dest allowed status change',
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'interface' => ['interface'],
              'is_default' => ['is_default'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_profiles_reminders'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'reminders_id' => [
              'type' => 'integer',
          ],
          'profiles_id' => [
              'type' => 'integer',
          ],
          'entities_id' => [
              'type' => 'integer',
              'default_value' => '-1',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'reminders_id' => ['reminders_id'],
              'profiles_id' => ['profiles_id'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
          ],
      ]
   ];

   $tables['glpi_profiles_rssfeeds'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'rssfeeds_id' => [
              'type' => 'integer',
          ],
          'profiles_id' => [
              'type' => 'integer',
          ],
          'entities_id' => [
              'type' => 'integer',
              'default_value' => '-1',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'rssfeeds_id' => ['rssfeeds_id'],
              'profiles_id' => ['profiles_id'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
          ],
      ]
   ];

   $tables['glpi_profiles_users'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'users_id' => [
              'type' => 'integer',
          ],
          'profiles_id' => [
              'type' => 'integer',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'is_dynamic' => [
              'type' => 'bool',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'entities_id' => ['entities_id'],
              'profiles_id' => ['profiles_id'],
              'users_id' => ['users_id'],
              'is_recursive' => ['is_recursive'],
              'is_dynamic' => ['is_dynamic'],
          ],
      ]
   ];

   $tables['glpi_projectcosts'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'projects_id' => [
              'type' => 'integer',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'begin_date' => [
              'type' => 'date',
              'default_value' => null,
          ],
          'end_date' => [
              'type' => 'date',
              'default_value' => null,
          ],
          'cost' => [
              'type' => 'decimal(20,4)',
              'default_value' => '0.0000',
          ],
          'budgets_id' => [
              'type' => 'integer',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'projects_id' => ['projects_id'],
              'begin_date' => ['begin_date'],
              'end_date' => ['end_date'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'budgets_id' => ['budgets_id'],
          ],
      ]
   ];

   $tables['glpi_projects'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'code' => [
              'type' => 'string',
          ],
          'priority' => [
              'type' => 'integer',
              'default_value' => '1',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'projects_id' => [
              'type' => 'integer',
          ],
          'projectstates_id' => [
              'type' => 'integer',
          ],
          'projecttypes_id' => [
              'type' => 'integer',
          ],
          'date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'users_id' => [
              'type' => 'integer',
          ],
          'groups_id' => [
              'type' => 'integer',
          ],
          'plan_start_date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'plan_end_date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'real_start_date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'real_end_date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'percent_done' => [
              'type' => 'integer',
          ],
          'show_on_global_gantt' => [
              'type' => 'bool',
          ],
          'content' => [
              'type' => 'longtext',
          ],
          'comment' => [
              'type' => 'longtext',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'projecttemplates_id' => [
              'type' => 'integer',
          ],
          'is_template' => [
              'type' => 'bool',
          ],
          'template_name' => [
              'type' => 'string',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'code' => ['code'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'projects_id' => ['projects_id'],
              'projectstates_id' => ['projectstates_id'],
              'projecttypes_id' => ['projecttypes_id'],
              'priority' => ['priority'],
              'date' => ['date'],
              'date_mod' => ['date_mod'],
              'users_id' => ['users_id'],
              'groups_id' => ['groups_id'],
              'plan_start_date' => ['plan_start_date'],
              'plan_end_date' => ['plan_end_date'],
              'real_start_date' => ['real_start_date'],
              'real_end_date' => ['real_end_date'],
              'percent_done' => ['percent_done'],
              'show_on_global_gantt' => ['show_on_global_gantt'],
              'date_creation' => ['date_creation'],
              'projecttemplates_id' => ['projecttemplates_id'],
              'is_template' => ['is_template'],
          ],
      ]
   ];

   $tables['glpi_projectstates'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'color' => [
              'type' => 'string',
          ],
          'is_finished' => [
              'type' => 'bool',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'is_finished' => ['is_finished'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_projecttasks'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'content' => [
              'type' => 'longtext',
          ],
          'comment' => [
              'type' => 'longtext',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'projects_id' => [
              'type' => 'integer',
          ],
          'projecttasks_id' => [
              'type' => 'integer',
          ],
          'date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'plan_start_date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'plan_end_date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'real_start_date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'real_end_date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'planned_duration' => [
              'type' => 'integer',
          ],
          'effective_duration' => [
              'type' => 'integer',
          ],
          'projectstates_id' => [
              'type' => 'integer',
          ],
          'projecttasktypes_id' => [
              'type' => 'integer',
          ],
          'users_id' => [
              'type' => 'integer',
          ],
          'percent_done' => [
              'type' => 'integer',
          ],
          'is_milestone' => [
              'type' => 'bool',
          ],
          'projecttasktemplates_id' => [
              'type' => 'integer',
          ],
          'is_template' => [
              'type' => 'bool',
          ],
          'template_name' => [
              'type' => 'string',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'projects_id' => ['projects_id'],
              'projecttasks_id' => ['projecttasks_id'],
              'date' => ['date'],
              'date_mod' => ['date_mod'],
              'users_id' => ['users_id'],
              'plan_start_date' => ['plan_start_date'],
              'plan_end_date' => ['plan_end_date'],
              'real_start_date' => ['real_start_date'],
              'real_end_date' => ['real_end_date'],
              'percent_done' => ['percent_done'],
              'projectstates_id' => ['projectstates_id'],
              'projecttasktypes_id' => ['projecttasktypes_id'],
              'projecttasktemplates_id' => ['projecttasktemplates_id'],
              'is_template' => ['is_template'],
              'is_milestone' => ['is_milestone'],
          ],
      ]
   ];

   $tables['glpi_projecttasks_tickets'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'tickets_id' => [
              'type' => 'integer',
          ],
          'projecttasks_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['tickets_id', 'projecttasks_id'],
          ],
          'KEY' => [
              'projects_id' => ['projecttasks_id'],
          ],
      ]
   ];

   $tables['glpi_projecttaskteams'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'projecttasks_id' => [
              'type' => 'integer',
          ],
          'itemtype' => [
              'type' => 'varchar(100)',
              'default_value' => null,
          ],
          'items_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['projecttasks_id', 'itemtype', 'items_id'],
          ],
          'KEY' => [
              'item' => ['itemtype', 'items_id'],
          ],
      ]
   ];

   $tables['glpi_projecttasktemplates'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'name' => [
              'type' => 'string',
          ],
          'description' => [
              'type' => 'longtext',
          ],
          'comment' => [
              'type' => 'longtext',
          ],
          'projects_id' => [
              'type' => 'integer',
          ],
          'projecttasks_id' => [
              'type' => 'integer',
          ],
          'plan_start_date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'plan_end_date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'real_start_date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'real_end_date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'planned_duration' => [
              'type' => 'integer',
          ],
          'effective_duration' => [
              'type' => 'integer',
          ],
          'projectstates_id' => [
              'type' => 'integer',
          ],
          'projecttasktypes_id' => [
              'type' => 'integer',
          ],
          'users_id' => [
              'type' => 'integer',
          ],
          'percent_done' => [
              'type' => 'integer',
          ],
          'is_milestone' => [
              'type' => 'bool',
          ],
          'comments' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'projects_id' => ['projects_id'],
              'projecttasks_id' => ['projecttasks_id'],
              'date_creation' => ['date_creation'],
              'date_mod' => ['date_mod'],
              'users_id' => ['users_id'],
              'plan_start_date' => ['plan_start_date'],
              'plan_end_date' => ['plan_end_date'],
              'real_start_date' => ['real_start_date'],
              'real_end_date' => ['real_end_date'],
              'percent_done' => ['percent_done'],
              'projectstates_id' => ['projectstates_id'],
              'projecttasktypes_id' => ['projecttasktypes_id'],
              'is_milestone' => ['is_milestone'],
          ],
      ]
   ];

   $tables['glpi_projecttasktypes'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_projectteams'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'projects_id' => [
              'type' => 'integer',
          ],
          'itemtype' => [
              'type' => 'varchar(100)',
              'default_value' => null,
          ],
          'items_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['projects_id', 'itemtype', 'items_id'],
          ],
          'KEY' => [
              'item' => ['itemtype', 'items_id'],
          ],
      ]
   ];

   $tables['glpi_projecttypes'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_queuednotifications'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'itemtype' => [
              'type' => 'varchar(100)',
              'default_value' => null,
          ],
          'items_id' => [
              'type' => 'integer',
          ],
          'notificationtemplates_id' => [
              'type' => 'integer',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'sent_try' => [
              'type' => 'integer',
          ],
          'create_time' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'send_time' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'sent_time' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'name' => [
              'type' => 'text',
          ],
          'sender' => [
              'type' => 'text',
          ],
          'sendername' => [
              'type' => 'text',
          ],
          'recipient' => [
              'type' => 'text',
          ],
          'recipientname' => [
              'type' => 'text',
          ],
          'replyto' => [
              'type' => 'text',
          ],
          'replytoname' => [
              'type' => 'text',
          ],
          'headers' => [
              'type' => 'text',
          ],
          'body_html' => [
              'type' => 'longtext',
          ],
          'body_text' => [
              'type' => 'longtext',
          ],
          'messageid' => [
              'type' => 'text',
          ],
          'documents' => [
              'type' => 'text',
          ],
          'mode' => [
              'type' => 'varchar(20)',
              'default_value' => null,
              'no_default' => true,
              'comment' => 'See Notification_NotificationTemplate::MODE_* constants',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'item' => ['itemtype', 'items_id', 'notificationtemplates_id'],
              'is_deleted' => ['is_deleted'],
              'entities_id' => ['entities_id'],
              'sent_try' => ['sent_try'],
              'create_time' => ['create_time'],
              'send_time' => ['send_time'],
              'sent_time' => ['sent_time'],
              'mode' => ['mode'],
          ],
      ]
   ];

   $tables['glpi_rackmodels'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'product_number' => [
              'type' => 'string',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'product_number' => ['product_number'],
          ],
      ]
   ];

   $tables['glpi_racks'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'locations_id' => [
              'type' => 'integer',
          ],
          'serial' => [
              'type' => 'string',
          ],
          'otherserial' => [
              'type' => 'string',
          ],
          'rackmodels_id' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'manufacturers_id' => [
              'type' => 'integer',
          ],
          'racktypes_id' => [
              'type' => 'integer',
          ],
          'states_id' => [
              'type' => 'integer',
          ],
          'users_id_tech' => [
              'type' => 'integer',
          ],
          'groups_id_tech' => [
              'type' => 'integer',
          ],
          'width' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'height' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'depth' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'number_units' => [
              'type' => 'integer',
          ],
          'is_template' => [
              'type' => 'bool',
          ],
          'template_name' => [
              'type' => 'string',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'dcrooms_id' => [
              'type' => 'integer',
          ],
          'room_orientation' => [
              'type' => 'integer',
          ],
          'position' => [
              'type' => 'varchar(50)',
              'default_value' => null,
          ],
          'bgcolor' => [
              'type' => 'varchar(7)',
              'default_value' => null,
          ],
          'max_power' => [
              'type' => 'integer',
          ],
          'mesured_power' => [
              'type' => 'integer',
          ],
          'max_weight' => [
              'type' => 'integer',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'locations_id' => ['locations_id'],
              'rackmodels_id' => ['rackmodels_id'],
              'manufacturers_id' => ['manufacturers_id'],
              'racktypes_id' => ['racktypes_id'],
              'states_id' => ['states_id'],
              'users_id_tech' => ['users_id_tech'],
              'group_id_tech' => ['groups_id_tech'],
              'is_template' => ['is_template'],
              'is_deleted' => ['is_deleted'],
              'dcrooms_id' => ['dcrooms_id'],
          ],
      ]
   ];

   $tables['glpi_racktypes'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'name' => ['name'],
              'date_creation' => ['date_creation'],
              'date_mod' => ['date_mod'],
          ],
      ]
   ];

   $tables['glpi_registeredids'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'items_id' => [
              'type' => 'integer',
          ],
          'itemtype' => [
              'type' => 'varchar(100)',
              'default_value' => null,
              'no_default' => true,
          ],
          'device_type' => [
              'type' => 'varchar(100)',
              'default_value' => null,
              'no_default' => true,
              'comment' => 'USB, PCI ...',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'item' => ['items_id', 'itemtype'],
              'device_type' => ['device_type'],
          ],
      ]
   ];

   $tables['glpi_reminders'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'users_id' => [
              'type' => 'integer',
          ],
          'name' => [
              'type' => 'string',
          ],
          'text' => [
              'type' => 'text',
          ],
          'begin' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'end' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'is_planned' => [
              'type' => 'bool',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'state' => [
              'type' => 'integer',
          ],
          'begin_view_date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'end_view_date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'date' => ['date'],
              'begin' => ['begin'],
              'end' => ['end'],
              'users_id' => ['users_id'],
              'is_planned' => ['is_planned'],
              'state' => ['state'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_reminders_users'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'reminders_id' => [
              'type' => 'integer',
          ],
          'users_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'reminders_id' => ['reminders_id'],
              'users_id' => ['users_id'],
          ],
      ]
   ];

   $tables['glpi_requesttypes'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'is_helpdesk_default' => [
              'type' => 'bool',
          ],
          'is_followup_default' => [
              'type' => 'bool',
          ],
          'is_mail_default' => [
              'type' => 'bool',
          ],
          'is_mailfollowup_default' => [
              'type' => 'bool',
          ],
          'is_active' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'is_ticketheader' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'is_itilfollowup' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'is_helpdesk_default' => ['is_helpdesk_default'],
              'is_followup_default' => ['is_followup_default'],
              'is_mail_default' => ['is_mail_default'],
              'is_mailfollowup_default' => ['is_mailfollowup_default'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
              'is_active' => ['is_active'],
              'is_ticketheader' => ['is_ticketheader'],
              'is_itilfollowup' => ['is_itilfollowup'],
          ],
      ]
   ];

   $tables['glpi_reservationitems'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'itemtype' => [
              'type' => 'varchar(100)',
              'default_value' => null,
              'no_default' => true,
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'items_id' => [
              'type' => 'integer',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'is_active' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'is_active' => ['is_active'],
              'item' => ['itemtype', 'items_id'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'is_deleted' => ['is_deleted'],
          ],
      ]
   ];

   $tables['glpi_reservations'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'reservationitems_id' => [
              'type' => 'integer',
          ],
          'begin' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'end' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'users_id' => [
              'type' => 'integer',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'group' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'begin' => ['begin'],
              'end' => ['end'],
              'reservationitems_id' => ['reservationitems_id'],
              'users_id' => ['users_id'],
              'resagroup' => ['reservationitems_id', 'group'],
          ],
      ]
   ];

   $tables['glpi_rssfeeds'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'users_id' => [
              'type' => 'integer',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'url' => [
              'type' => 'text',
          ],
          'refresh_rate' => [
              'type' => 'integer',
              'default_value' => '86400',
          ],
          'max_items' => [
              'type' => 'integer',
              'default_value' => '20',
          ],
          'have_error' => [
              'type' => 'bool',
          ],
          'is_active' => [
              'type' => 'bool',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'users_id' => ['users_id'],
              'date_mod' => ['date_mod'],
              'have_error' => ['have_error'],
              'is_active' => ['is_active'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_rssfeeds_users'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'rssfeeds_id' => [
              'type' => 'integer',
          ],
          'users_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'rssfeeds_id' => ['rssfeeds_id'],
              'users_id' => ['users_id'],
          ],
      ]
   ];

   $tables['glpi_ruleactions'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'rules_id' => [
              'type' => 'integer',
          ],
          'action_type' => [
              'type' => 'string',
              'comment' => 'VALUE IN (assign, regex_result, append_regex_result, affectbyip, affectbyfqdn, affectbymac)',
          ],
          'field' => [
              'type' => 'string',
          ],
          'value' => [
              'type' => 'string',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'rules_id' => ['rules_id'],
              'field_value' => ['field', 'value'],
          ],
      ]
   ];

   $tables['glpi_rulecriterias'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'rules_id' => [
              'type' => 'integer',
          ],
          'criteria' => [
              'type' => 'string',
          ],
          'condition' => [
              'type' => 'integer',
              'comment' => 'see define.php PATTERN_* and REGEX_* constant',
          ],
          'pattern' => [
              'type' => 'text',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'rules_id' => ['rules_id'],
              'condition' => ['condition'],
          ],
      ]
   ];

   $tables['glpi_rulerightparameters'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'value' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
              'no_default' => true,
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_rules'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'sub_type' => [
              'type' => 'string',
              'default_value' => '',
          ],
          'ranking' => [
              'type' => 'integer',
          ],
          'name' => [
              'type' => 'string',
          ],
          'description' => [
              'type' => 'text',
          ],
          'match' => [
              'type' => 'char(10)',
              'default_value' => null,
              'comment' => 'see define.php *_MATCHING constant',
          ],
          'is_active' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'uuid' => [
              'type' => 'string',
          ],
          'condition' => [
              'type' => 'integer',
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'entities_id' => ['entities_id'],
              'is_active' => ['is_active'],
              'sub_type' => ['sub_type'],
              'date_mod' => ['date_mod'],
              'is_recursive' => ['is_recursive'],
              'condition' => ['condition'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_savedsearches'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'type' => [
              'type' => 'integer',
              'comment' => 'see SavedSearch:: constants',
          ],
          'itemtype' => [
              'type' => 'varchar(100)',
              'default_value' => null,
              'no_default' => true,
          ],
          'users_id' => [
              'type' => 'integer',
          ],
          'is_private' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'entities_id' => [
              'type' => 'integer',
              'default_value' => '-1',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'path' => [
              'type' => 'string',
          ],
          'query' => [
              'type' => 'text',
          ],
          'last_execution_time' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'do_count' => [
              'type' => 'tinyint(1)',
              'default_value' => '2',
              'comment' => 'Do or do not count results on list display see SavedSearch::COUNT_* constants',
          ],
          'last_execution_date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'counter' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'type' => ['type'],
              'itemtype' => ['itemtype'],
              'entities_id' => ['entities_id'],
              'users_id' => ['users_id'],
              'is_private' => ['is_private'],
              'is_recursive' => ['is_recursive'],
              'last_execution_time' => ['last_execution_time'],
              'last_execution_date' => ['last_execution_date'],
              'do_count' => ['do_count'],
          ],
      ]
   ];

   $tables['glpi_savedsearches_alerts'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'savedsearches_id' => [
              'type' => 'integer',
          ],
          'name' => [
              'type' => 'string',
          ],
          'is_active' => [
              'type' => 'bool',
          ],
          'operator' => [
              'type' => 'bool',
              'default_value' => null,
              'no_default' => true,
          ],
          'value' => [
              'type' => 'integer',
              'default_value' => null,
              'no_default' => true,
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['savedsearches_id', 'operator', 'value'],
          ],
          'KEY' => [
              'name' => ['name'],
              'is_active' => ['is_active'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_savedsearches_users'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'users_id' => [
              'type' => 'integer',
          ],
          'itemtype' => [
              'type' => 'varchar(100)',
              'default_value' => null,
              'no_default' => true,
          ],
          'savedsearches_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['users_id', 'itemtype'],
          ],
          'KEY' => [
              'savedsearches_id' => ['savedsearches_id'],
          ],
      ]
   ];

   $tables['glpi_slalevelactions'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'slalevels_id' => [
              'type' => 'integer',
          ],
          'action_type' => [
              'type' => 'string',
          ],
          'field' => [
              'type' => 'string',
          ],
          'value' => [
              'type' => 'string',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'slalevels_id' => ['slalevels_id'],
          ],
      ]
   ];

   $tables['glpi_slalevelcriterias'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'slalevels_id' => [
              'type' => 'integer',
          ],
          'criteria' => [
              'type' => 'string',
          ],
          'condition' => [
              'type' => 'integer',
              'comment' => 'see define.php PATTERN_* and REGEX_* constant',
          ],
          'pattern' => [
              'type' => 'string',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'slalevels_id' => ['slalevels_id'],
              'condition' => ['condition'],
          ],
      ]
   ];

   $tables['glpi_slalevels'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'slas_id' => [
              'type' => 'integer',
          ],
          'execution_time' => [
              'type' => 'integer',
              'default_value' => null,
              'no_default' => true,
          ],
          'is_active' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'match' => [
              'type' => 'char(10)',
              'default_value' => null,
              'comment' => 'see define.php *_MATCHING constant',
          ],
          'uuid' => [
              'type' => 'string',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'is_active' => ['is_active'],
              'slas_id' => ['slas_id'],
          ],
      ]
   ];

   $tables['glpi_slalevels_tickets'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'tickets_id' => [
              'type' => 'integer',
          ],
          'slalevels_id' => [
              'type' => 'integer',
          ],
          'date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['tickets_id', 'slalevels_id'],
          ],
          'KEY' => [
              'tickets_id' => ['tickets_id'],
              'slalevels_id' => ['slalevels_id'],
          ],
      ]
   ];

   $tables['glpi_slas'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'type' => [
              'type' => 'integer',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'number_time' => [
              'type' => 'integer',
              'default_value' => null,
              'no_default' => true,
          ],
          'calendars_id' => [
              'type' => 'integer',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'definition_time' => [
              'type' => 'string',
          ],
          'end_of_working_day' => [
              'type' => 'bool',
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'slms_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
              'calendars_id' => ['calendars_id'],
              'slms_id' => ['slms_id'],
          ],
      ]
   ];

   $tables['glpi_slms'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'calendars_id' => [
              'type' => 'integer',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'calendars_id' => ['calendars_id'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_softwarecategories'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'softwarecategories_id' => [
              'type' => 'integer',
          ],
          'completename' => [
              'type' => 'text',
          ],
          'level' => [
              'type' => 'integer',
          ],
          'ancestors_cache' => [
              'type' => 'longtext',
          ],
          'sons_cache' => [
              'type' => 'longtext',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'softwarecategories_id' => ['softwarecategories_id'],
          ],
      ]
   ];

   $tables['glpi_softwarelicenses'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'softwares_id' => [
              'type' => 'integer',
          ],
          'softwarelicenses_id' => [
              'type' => 'integer',
          ],
          'completename' => [
              'type' => 'text',
          ],
          'level' => [
              'type' => 'integer',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'number' => [
              'type' => 'integer',
          ],
          'softwarelicensetypes_id' => [
              'type' => 'integer',
          ],
          'name' => [
              'type' => 'string',
          ],
          'serial' => [
              'type' => 'string',
          ],
          'otherserial' => [
              'type' => 'string',
          ],
          'softwareversions_id_buy' => [
              'type' => 'integer',
          ],
          'softwareversions_id_use' => [
              'type' => 'integer',
          ],
          'expire' => [
              'type' => 'date',
              'default_value' => null,
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'is_valid' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'locations_id' => [
              'type' => 'integer',
          ],
          'users_id_tech' => [
              'type' => 'integer',
          ],
          'users_id' => [
              'type' => 'integer',
          ],
          'groups_id_tech' => [
              'type' => 'integer',
          ],
          'groups_id' => [
              'type' => 'integer',
          ],
          'is_helpdesk_visible' => [
              'type' => 'bool',
          ],
          'is_template' => [
              'type' => 'bool',
          ],
          'template_name' => [
              'type' => 'string',
          ],
          'states_id' => [
              'type' => 'integer',
          ],
          'manufacturers_id' => [
              'type' => 'integer',
          ],
          'contact' => [
              'type' => 'string',
          ],
          'contact_num' => [
              'type' => 'string',
          ],
          'allow_overquota' => [
              'type' => 'bool',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'is_template' => ['is_template'],
              'serial' => ['serial'],
              'otherserial' => ['otherserial'],
              'expire' => ['expire'],
              'softwareversions_id_buy' => ['softwareversions_id_buy'],
              'entities_id' => ['entities_id'],
              'softwarelicensetypes_id' => ['softwarelicensetypes_id'],
              'softwareversions_id_use' => ['softwareversions_id_use'],
              'date_mod' => ['date_mod'],
              'softwares_id_expire_number' => ['softwares_id', 'expire', 'number'],
              'locations_id' => ['locations_id'],
              'users_id_tech' => ['users_id_tech'],
              'users_id' => ['users_id'],
              'groups_id_tech' => ['groups_id_tech'],
              'groups_id' => ['groups_id'],
              'is_helpdesk_visible' => ['is_helpdesk_visible'],
              'is_deleted' => ['is_deleted'],
              'date_creation' => ['date_creation'],
              'manufacturers_id' => ['manufacturers_id'],
              'states_id' => ['states_id'],
              'allow_overquota' => ['allow_overquota'],
          ],
      ]
   ];

   $tables['glpi_softwarelicensetypes'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'softwarelicensetypes_id' => [
              'type' => 'integer',
          ],
          'level' => [
              'type' => 'integer',
          ],
          'ancestors_cache' => [
              'type' => 'longtext',
          ],
          'sons_cache' => [
              'type' => 'longtext',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'completename' => [
              'type' => 'text',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
              'softwarelicensetypes_id' => ['softwarelicensetypes_id'],
          ],
      ]
   ];

   $tables['glpi_softwares'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'locations_id' => [
              'type' => 'integer',
          ],
          'users_id_tech' => [
              'type' => 'integer',
          ],
          'groups_id_tech' => [
              'type' => 'integer',
          ],
          'is_update' => [
              'type' => 'bool',
          ],
          'softwares_id' => [
              'type' => 'integer',
          ],
          'manufacturers_id' => [
              'type' => 'integer',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'is_template' => [
              'type' => 'bool',
          ],
          'template_name' => [
              'type' => 'string',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'users_id' => [
              'type' => 'integer',
          ],
          'groups_id' => [
              'type' => 'integer',
          ],
          'ticket_tco' => [
              'type' => 'decimal(20,4)',
              'default_value' => '0.0000',
          ],
          'is_helpdesk_visible' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'softwarecategories_id' => [
              'type' => 'integer',
          ],
          'is_valid' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'date_mod' => ['date_mod'],
              'name' => ['name'],
              'is_template' => ['is_template'],
              'is_update' => ['is_update'],
              'softwarecategories_id' => ['softwarecategories_id'],
              'entities_id' => ['entities_id'],
              'manufacturers_id' => ['manufacturers_id'],
              'groups_id' => ['groups_id'],
              'users_id' => ['users_id'],
              'locations_id' => ['locations_id'],
              'users_id_tech' => ['users_id_tech'],
              'softwares_id' => ['softwares_id'],
              'is_deleted' => ['is_deleted'],
              'is_helpdesk_visible' => ['is_helpdesk_visible'],
              'groups_id_tech' => ['groups_id_tech'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_softwareversions'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'softwares_id' => [
              'type' => 'integer',
          ],
          'states_id' => [
              'type' => 'integer',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'operatingsystems_id' => [
              'type' => 'integer',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'softwares_id' => ['softwares_id'],
              'states_id' => ['states_id'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'operatingsystems_id' => ['operatingsystems_id'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_solutiontemplates'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'name' => [
              'type' => 'string',
          ],
          'content' => [
              'type' => 'text',
          ],
          'solutiontypes_id' => [
              'type' => 'integer',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'is_recursive' => ['is_recursive'],
              'solutiontypes_id' => ['solutiontypes_id'],
              'entities_id' => ['entities_id'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_solutiontypes'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_ssovariables'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
              'no_default' => true,
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_states'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'states_id' => [
              'type' => 'integer',
          ],
          'completename' => [
              'type' => 'text',
          ],
          'level' => [
              'type' => 'integer',
          ],
          'ancestors_cache' => [
              'type' => 'longtext',
          ],
          'sons_cache' => [
              'type' => 'longtext',
          ],
          'is_visible_computer' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'is_visible_monitor' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'is_visible_networkequipment' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'is_visible_peripheral' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'is_visible_phone' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'is_visible_printer' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'is_visible_softwareversion' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'is_visible_softwarelicense' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'is_visible_line' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'is_visible_certificate' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'is_visible_rack' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'is_visible_enclosure' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'is_visible_pdu' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['states_id', 'name'],
          ],
          'KEY' => [
              'name' => ['name'],
              'is_visible_computer' => ['is_visible_computer'],
              'is_visible_monitor' => ['is_visible_monitor'],
              'is_visible_networkequipment' => ['is_visible_networkequipment'],
              'is_visible_peripheral' => ['is_visible_peripheral'],
              'is_visible_phone' => ['is_visible_phone'],
              'is_visible_printer' => ['is_visible_printer'],
              'is_visible_softwareversion' => ['is_visible_softwareversion'],
              'is_visible_softwarelicense' => ['is_visible_softwarelicense'],
              'is_visible_line' => ['is_visible_line'],
              'is_visible_certificate' => ['is_visible_certificate'],
              'is_visible_rack' => ['is_visible_rack'],
              'is_visible_enclosure' => ['is_visible_enclosure'],
              'is_visible_pdu' => ['is_visible_pdu'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_suppliers'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'name' => [
              'type' => 'string',
          ],
          'suppliertypes_id' => [
              'type' => 'integer',
          ],
          'address' => [
              'type' => 'text',
          ],
          'postcode' => [
              'type' => 'string',
          ],
          'town' => [
              'type' => 'string',
          ],
          'state' => [
              'type' => 'string',
          ],
          'country' => [
              'type' => 'string',
          ],
          'website' => [
              'type' => 'string',
          ],
          'phonenumber' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'fax' => [
              'type' => 'string',
          ],
          'email' => [
              'type' => 'string',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'is_active' => [
              'type' => 'bool',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'entities_id' => ['entities_id'],
              'suppliertypes_id' => ['suppliertypes_id'],
              'is_deleted' => ['is_deleted'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
              'is_active' => ['is_active'],
          ],
      ]
   ];

   $tables['glpi_suppliers_tickets'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'tickets_id' => [
              'type' => 'integer',
          ],
          'suppliers_id' => [
              'type' => 'integer',
          ],
          'type' => [
              'type' => 'integer',
              'default_value' => '1',
          ],
          'use_notification' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'alternative_email' => [
              'type' => 'string',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['tickets_id', 'type', 'suppliers_id'],
          ],
          'KEY' => [
              'group' => ['suppliers_id', 'type'],
          ],
      ]
   ];

   $tables['glpi_suppliertypes'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_taskcategories'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'taskcategories_id' => [
              'type' => 'integer',
          ],
          'name' => [
              'type' => 'string',
          ],
          'completename' => [
              'type' => 'text',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'level' => [
              'type' => 'integer',
          ],
          'ancestors_cache' => [
              'type' => 'longtext',
          ],
          'sons_cache' => [
              'type' => 'longtext',
          ],
          'is_active' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'is_helpdeskvisible' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'knowbaseitemcategories_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'taskcategories_id' => ['taskcategories_id'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'is_active' => ['is_active'],
              'is_helpdeskvisible' => ['is_helpdeskvisible'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
              'knowbaseitemcategories_id' => ['knowbaseitemcategories_id'],
          ],
      ]
   ];

   $tables['glpi_tasktemplates'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'name' => [
              'type' => 'string',
          ],
          'content' => [
              'type' => 'text',
          ],
          'taskcategories_id' => [
              'type' => 'integer',
          ],
          'actiontime' => [
              'type' => 'integer',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'state' => [
              'type' => 'integer',
          ],
          'is_private' => [
              'type' => 'bool',
          ],
          'users_id_tech' => [
              'type' => 'integer',
          ],
          'groups_id_tech' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'is_recursive' => ['is_recursive'],
              'taskcategories_id' => ['taskcategories_id'],
              'entities_id' => ['entities_id'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
              'is_private' => ['is_private'],
              'users_id_tech' => ['users_id_tech'],
              'groups_id_tech' => ['groups_id_tech'],
          ],
      ]
   ];

   $tables['glpi_ticketcosts'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'tickets_id' => [
              'type' => 'integer',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'begin_date' => [
              'type' => 'date',
              'default_value' => null,
          ],
          'end_date' => [
              'type' => 'date',
              'default_value' => null,
          ],
          'actiontime' => [
              'type' => 'integer',
          ],
          'cost_time' => [
              'type' => 'decimal(20,4)',
              'default_value' => '0.0000',
          ],
          'cost_fixed' => [
              'type' => 'decimal(20,4)',
              'default_value' => '0.0000',
          ],
          'cost_material' => [
              'type' => 'decimal(20,4)',
              'default_value' => '0.0000',
          ],
          'budgets_id' => [
              'type' => 'integer',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'tickets_id' => ['tickets_id'],
              'begin_date' => ['begin_date'],
              'end_date' => ['end_date'],
              'entities_id' => ['entities_id'],
              'budgets_id' => ['budgets_id'],
          ],
      ]
   ];

   $tables['glpi_ticketrecurrents'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'is_active' => [
              'type' => 'bool',
          ],
          'tickettemplates_id' => [
              'type' => 'integer',
          ],
          'begin_date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'periodicity' => [
              'type' => 'string',
          ],
          'create_before' => [
              'type' => 'integer',
          ],
          'next_creation_date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'calendars_id' => [
              'type' => 'integer',
          ],
          'end_date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
              'is_active' => ['is_active'],
              'tickettemplates_id' => ['tickettemplates_id'],
              'next_creation_date' => ['next_creation_date'],
          ],
      ]
   ];

   $tables['glpi_tickets'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'name' => [
              'type' => 'string',
          ],
          'date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'closedate' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'solvedate' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'users_id_lastupdater' => [
              'type' => 'integer',
          ],
          'status' => [
              'type' => 'integer',
              'default_value' => '1',
          ],
          'users_id_recipient' => [
              'type' => 'integer',
          ],
          'requesttypes_id' => [
              'type' => 'integer',
          ],
          'content' => [
              'type' => 'longtext',
          ],
          'urgency' => [
              'type' => 'integer',
              'default_value' => '1',
          ],
          'impact' => [
              'type' => 'integer',
              'default_value' => '1',
          ],
          'priority' => [
              'type' => 'integer',
              'default_value' => '1',
          ],
          'itilcategories_id' => [
              'type' => 'integer',
          ],
          'type' => [
              'type' => 'integer',
              'default_value' => '1',
          ],
          'global_validation' => [
              'type' => 'integer',
              'default_value' => '1',
          ],
          'slas_id_ttr' => [
              'type' => 'integer',
          ],
          'slas_id_tto' => [
              'type' => 'integer',
          ],
          'slalevels_id_ttr' => [
              'type' => 'integer',
          ],
          'time_to_resolve' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'time_to_own' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'begin_waiting_date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'sla_waiting_duration' => [
              'type' => 'integer',
          ],
          'ola_waiting_duration' => [
              'type' => 'integer',
          ],
          'olas_id_tto' => [
              'type' => 'integer',
          ],
          'olas_id_ttr' => [
              'type' => 'integer',
          ],
          'olalevels_id_ttr' => [
              'type' => 'integer',
          ],
          'internal_time_to_resolve' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'internal_time_to_own' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'waiting_duration' => [
              'type' => 'integer',
          ],
          'close_delay_stat' => [
              'type' => 'integer',
          ],
          'solve_delay_stat' => [
              'type' => 'integer',
          ],
          'takeintoaccount_delay_stat' => [
              'type' => 'integer',
          ],
          'actiontime' => [
              'type' => 'integer',
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'locations_id' => [
              'type' => 'integer',
          ],
          'validation_percent' => [
              'type' => 'integer',
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'date' => ['date'],
              'closedate' => ['closedate'],
              'status' => ['status'],
              'priority' => ['priority'],
              'request_type' => ['requesttypes_id'],
              'date_mod' => ['date_mod'],
              'entities_id' => ['entities_id'],
              'users_id_recipient' => ['users_id_recipient'],
              'solvedate' => ['solvedate'],
              'urgency' => ['urgency'],
              'impact' => ['impact'],
              'global_validation' => ['global_validation'],
              'slas_id_tto' => ['slas_id_tto'],
              'slas_id_ttr' => ['slas_id_ttr'],
              'time_to_resolve' => ['time_to_resolve'],
              'time_to_own' => ['time_to_own'],
              'olas_id_tto' => ['olas_id_tto'],
              'olas_id_ttr' => ['olas_id_ttr'],
              'slalevels_id_ttr' => ['slalevels_id_ttr'],
              'internal_time_to_resolve' => ['internal_time_to_resolve'],
              'internal_time_to_own' => ['internal_time_to_own'],
              'users_id_lastupdater' => ['users_id_lastupdater'],
              'type' => ['type'],
              'itilcategories_id' => ['itilcategories_id'],
              'is_deleted' => ['is_deleted'],
              'name' => ['name'],
              'locations_id' => ['locations_id'],
              'date_creation' => ['date_creation'],
              'ola_waiting_duration' => ['ola_waiting_duration'],
              'olalevels_id_ttr' => ['olalevels_id_ttr'],
          ],
      ]
   ];

   $tables['glpi_tickets_tickets'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'tickets_id_1' => [
              'type' => 'integer',
          ],
          'tickets_id_2' => [
              'type' => 'integer',
          ],
          'link' => [
              'type' => 'integer',
              'default_value' => '1',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['tickets_id_1', 'tickets_id_2'],
          ],
      ]
   ];

   $tables['glpi_tickets_users'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'tickets_id' => [
              'type' => 'integer',
          ],
          'users_id' => [
              'type' => 'integer',
          ],
          'type' => [
              'type' => 'integer',
              'default_value' => '1',
          ],
          'use_notification' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'alternative_email' => [
              'type' => 'string',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['tickets_id', 'type', 'users_id', 'alternative_email'],
          ],
          'KEY' => [
              'user' => ['users_id', 'type'],
          ],
      ]
   ];

   $tables['glpi_ticketsatisfactions'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'tickets_id' => [
              'type' => 'integer',
          ],
          'type' => [
              'type' => 'integer',
              'default_value' => '1',
          ],
          'date_begin' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_answered' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'satisfaction' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'comment' => [
              'type' => 'text',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'tickets_id' => ['tickets_id'],
          ],
      ]
   ];

   $tables['glpi_tickettasks'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'tickets_id' => [
              'type' => 'integer',
          ],
          'taskcategories_id' => [
              'type' => 'integer',
          ],
          'date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'users_id' => [
              'type' => 'integer',
          ],
          'users_id_editor' => [
              'type' => 'integer',
          ],
          'content' => [
              'type' => 'longtext',
          ],
          'is_private' => [
              'type' => 'bool',
          ],
          'actiontime' => [
              'type' => 'integer',
          ],
          'begin' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'end' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'state' => [
              'type' => 'integer',
              'default_value' => '1',
          ],
          'users_id_tech' => [
              'type' => 'integer',
          ],
          'groups_id_tech' => [
              'type' => 'integer',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'tasktemplates_id' => [
              'type' => 'integer',
          ],
          'timeline_position' => [
              'type' => 'bool',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'date' => ['date'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
              'users_id' => ['users_id'],
              'users_id_editor' => ['users_id_editor'],
              'tickets_id' => ['tickets_id'],
              'is_private' => ['is_private'],
              'taskcategories_id' => ['taskcategories_id'],
              'state' => ['state'],
              'users_id_tech' => ['users_id_tech'],
              'groups_id_tech' => ['groups_id_tech'],
              'begin' => ['begin'],
              'end' => ['end'],
              'tasktemplates_id' => ['tasktemplates_id'],
          ],
      ]
   ];

   $tables['glpi_tickettemplatehiddenfields'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'tickettemplates_id' => [
              'type' => 'integer',
          ],
          'num' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['tickettemplates_id', 'num'],
          ],
      ]
   ];

   $tables['glpi_tickettemplatemandatoryfields'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'tickettemplates_id' => [
              'type' => 'integer',
          ],
          'num' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['tickettemplates_id', 'num'],
          ],
      ]
   ];

   $tables['glpi_tickettemplatepredefinedfields'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'tickettemplates_id' => [
              'type' => 'integer',
          ],
          'num' => [
              'type' => 'integer',
          ],
          'value' => [
              'type' => 'text',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'tickettemplates_id_id_num' => ['tickettemplates_id', 'num'],
          ],
      ]
   ];

   $tables['glpi_tickettemplates'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'comment' => [
              'type' => 'text',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'entities_id' => ['entities_id'],
              'is_recursive' => ['is_recursive'],
          ],
      ]
   ];

   $tables['glpi_ticketvalidations'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'users_id' => [
              'type' => 'integer',
          ],
          'tickets_id' => [
              'type' => 'integer',
          ],
          'users_id_validate' => [
              'type' => 'integer',
          ],
          'comment_submission' => [
              'type' => 'text',
          ],
          'comment_validation' => [
              'type' => 'text',
          ],
          'status' => [
              'type' => 'integer',
              'default_value' => '2',
          ],
          'submission_date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'validation_date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'timeline_position' => [
              'type' => 'bool',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'entities_id' => ['entities_id'],
              'users_id' => ['users_id'],
              'users_id_validate' => ['users_id_validate'],
              'tickets_id' => ['tickets_id'],
              'submission_date' => ['submission_date'],
              'validation_date' => ['validation_date'],
              'status' => ['status'],
          ],
      ]
   ];

   $tables['glpi_transfers'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'keep_ticket' => [
              'type' => 'integer',
          ],
          'keep_networklink' => [
              'type' => 'integer',
          ],
          'keep_reservation' => [
              'type' => 'integer',
          ],
          'keep_history' => [
              'type' => 'integer',
          ],
          'keep_device' => [
              'type' => 'integer',
          ],
          'keep_infocom' => [
              'type' => 'integer',
          ],
          'keep_dc_monitor' => [
              'type' => 'integer',
          ],
          'clean_dc_monitor' => [
              'type' => 'integer',
          ],
          'keep_dc_phone' => [
              'type' => 'integer',
          ],
          'clean_dc_phone' => [
              'type' => 'integer',
          ],
          'keep_dc_peripheral' => [
              'type' => 'integer',
          ],
          'clean_dc_peripheral' => [
              'type' => 'integer',
          ],
          'keep_dc_printer' => [
              'type' => 'integer',
          ],
          'clean_dc_printer' => [
              'type' => 'integer',
          ],
          'keep_supplier' => [
              'type' => 'integer',
          ],
          'clean_supplier' => [
              'type' => 'integer',
          ],
          'keep_contact' => [
              'type' => 'integer',
          ],
          'clean_contact' => [
              'type' => 'integer',
          ],
          'keep_contract' => [
              'type' => 'integer',
          ],
          'clean_contract' => [
              'type' => 'integer',
          ],
          'keep_software' => [
              'type' => 'integer',
          ],
          'clean_software' => [
              'type' => 'integer',
          ],
          'keep_document' => [
              'type' => 'integer',
          ],
          'clean_document' => [
              'type' => 'integer',
          ],
          'keep_cartridgeitem' => [
              'type' => 'integer',
          ],
          'clean_cartridgeitem' => [
              'type' => 'integer',
          ],
          'keep_cartridge' => [
              'type' => 'integer',
          ],
          'keep_consumable' => [
              'type' => 'integer',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'comment' => [
              'type' => 'text',
          ],
          'keep_disk' => [
              'type' => 'integer',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'date_mod' => ['date_mod'],
          ],
      ]
   ];

   $tables['glpi_usercategories'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_useremails'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'users_id' => [
              'type' => 'integer',
          ],
          'is_default' => [
              'type' => 'bool',
          ],
          'is_dynamic' => [
              'type' => 'bool',
          ],
          'email' => [
              'type' => 'string',
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicity' => ['users_id', 'email'],
          ],
          'KEY' => [
              'email' => ['email'],
              'is_default' => ['is_default'],
              'is_dynamic' => ['is_dynamic'],
          ],
      ]
   ];

   $tables['glpi_users'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'password' => [
              'type' => 'string',
          ],
          'phone' => [
              'type' => 'string',
          ],
          'phone2' => [
              'type' => 'string',
          ],
          'mobile' => [
              'type' => 'string',
          ],
          'realname' => [
              'type' => 'string',
          ],
          'firstname' => [
              'type' => 'string',
          ],
          'locations_id' => [
              'type' => 'integer',
          ],
          'language' => [
              'type' => 'char(10)',
              'default_value' => null,
              'comment' => 'see define.php CFG_GLPI[language] array',
          ],
          'use_mode' => [
              'type' => 'integer',
          ],
          'list_limit' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'is_active' => [
              'type' => 'bool',
              'default_value' => '1',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'auths_id' => [
              'type' => 'integer',
          ],
          'authtype' => [
              'type' => 'integer',
          ],
          'last_login' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_sync' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'is_deleted' => [
              'type' => 'bool',
          ],
          'profiles_id' => [
              'type' => 'integer',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'usertitles_id' => [
              'type' => 'integer',
          ],
          'usercategories_id' => [
              'type' => 'integer',
          ],
          'date_format' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'number_format' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'names_format' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'csv_delimiter' => [
              'type' => 'char',
          ],
          'is_ids_visible' => [
              'type' => 'bool',
              'default_value' => null,
          ],
          'use_flat_dropdowntree' => [
              'type' => 'bool',
              'default_value' => null,
          ],
          'show_jobs_at_login' => [
              'type' => 'bool',
              'default_value' => null,
          ],
          'priority_1' => [
              'type' => 'char(20)',
              'default_value' => null,
          ],
          'priority_2' => [
              'type' => 'char(20)',
              'default_value' => null,
          ],
          'priority_3' => [
              'type' => 'char(20)',
              'default_value' => null,
          ],
          'priority_4' => [
              'type' => 'char(20)',
              'default_value' => null,
          ],
          'priority_5' => [
              'type' => 'char(20)',
              'default_value' => null,
          ],
          'priority_6' => [
              'type' => 'char(20)',
              'default_value' => null,
          ],
          'followup_private' => [
              'type' => 'bool',
              'default_value' => null,
          ],
          'task_private' => [
              'type' => 'bool',
              'default_value' => null,
          ],
          'default_requesttypes_id' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'password_forget_token' => [
              'type' => 'char(40)',
              'default_value' => null,
          ],
          'password_forget_token_date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'user_dn' => [
              'type' => 'text',
          ],
          'registration_number' => [
              'type' => 'string',
          ],
          'show_count_on_tabs' => [
              'type' => 'bool',
              'default_value' => null,
          ],
          'refresh_ticket_list' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'set_default_tech' => [
              'type' => 'bool',
              'default_value' => null,
          ],
          'personal_token' => [
              'type' => 'string',
          ],
          'personal_token_date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'api_token' => [
              'type' => 'string',
          ],
          'api_token_date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'cookie_token' => [
              'type' => 'string',
          ],
          'cookie_token_date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'display_count_on_home' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'notification_to_myself' => [
              'type' => 'bool',
              'default_value' => null,
          ],
          'duedateok_color' => [
              'type' => 'string',
          ],
          'duedatewarning_color' => [
              'type' => 'string',
          ],
          'duedatecritical_color' => [
              'type' => 'string',
          ],
          'duedatewarning_less' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'duedatecritical_less' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'duedatewarning_unit' => [
              'type' => 'string',
          ],
          'duedatecritical_unit' => [
              'type' => 'string',
          ],
          'display_options' => [
              'type' => 'text',
          ],
          'is_deleted_ldap' => [
              'type' => 'bool',
          ],
          'pdffont' => [
              'type' => 'string',
          ],
          'picture' => [
              'type' => 'string',
          ],
          'begin_date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'end_date' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'keep_devices_when_purging_item' => [
              'type' => 'bool',
              'default_value' => null,
          ],
          'privatebookmarkorder' => [
              'type' => 'longtext',
          ],
          'backcreated' => [
              'type' => 'bool',
              'default_value' => null,
          ],
          'task_state' => [
              'type' => 'integer',
              'default_value' => null,
          ],
          'layout' => [
              'type' => 'char(20)',
              'default_value' => null,
          ],
          'palette' => [
              'type' => 'char(20)',
              'default_value' => null,
          ],
          'set_default_requester' => [
              'type' => 'bool',
              'default_value' => null,
          ],
          'lock_autolock_mode' => [
              'type' => 'bool',
              'default_value' => null,
          ],
          'lock_directunlock_notification' => [
              'type' => 'bool',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'highcontrast_css' => [
              'type' => 'bool',
          ],
          'plannings' => [
              'type' => 'text',
          ],
          'sync_field' => [
              'type' => 'string',
          ],
          'groups_id' => [
              'type' => 'integer',
          ],
          'users_id_supervisor' => [
              'type' => 'integer',
          ],
          'timezone' => [
              'type' => 'varchar(50)',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'UNIQUE' => [
              'unicityloginauth' => ['name', 'authtype', 'auths_id'],
          ],
          'KEY' => [
              'firstname' => ['firstname'],
              'realname' => ['realname'],
              'entities_id' => ['entities_id'],
              'profiles_id' => ['profiles_id'],
              'locations_id' => ['locations_id'],
              'usertitles_id' => ['usertitles_id'],
              'usercategories_id' => ['usercategories_id'],
              'is_deleted' => ['is_deleted'],
              'is_active' => ['is_active'],
              'date_mod' => ['date_mod'],
              'authitem' => ['authtype', 'auths_id'],
              'is_deleted_ldap' => ['is_deleted_ldap'],
              'date_creation' => ['date_creation'],
              'begin_date' => ['begin_date'],
              'end_date' => ['end_date'],
              'sync_field' => ['sync_field'],
              'groups_id' => ['groups_id'],
              'users_id_supervisor' => ['users_id_supervisor'],
          ],
      ]
   ];

   $tables['glpi_usertitles'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_virtualmachinestates'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
              'default_value' => '',
          ],
          'comment' => [
              'type' => 'text',
              'no_default' => true,
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_virtualmachinesystems'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
              'default_value' => '',
          ],
          'comment' => [
              'type' => 'text',
              'no_default' => true,
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_virtualmachinetypes'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'name' => [
              'type' => 'string',
              'default_value' => '',
          ],
          'comment' => [
              'type' => 'text',
              'no_default' => true,
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_vlans'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'name' => [
              'type' => 'string',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'tag' => [
              'type' => 'integer',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'name' => ['name'],
              'entities_id' => ['entities_id'],
              'tag' => ['tag'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   $tables['glpi_wifinetworks'] = [
      'FIELDS' => [
          'id' => [
              'type' => 'autoincrement',
          ],
          'entities_id' => [
              'type' => 'integer',
          ],
          'is_recursive' => [
              'type' => 'bool',
          ],
          'name' => [
              'type' => 'string',
          ],
          'essid' => [
              'type' => 'string',
          ],
          'mode' => [
              'type' => 'string',
              'comment' => 'ad-hoc, access_point',
          ],
          'comment' => [
              'type' => 'text',
          ],
          'date_mod' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
          'date_creation' => [
              'type' => 'timestamp',
              'default_value' => null,
          ],
      ],
      'KEYS' => [
          'PRIMARY' => 'id',
          'KEY' => [
              'entities_id' => ['entities_id'],
              'essid' => ['essid'],
              'name' => ['name'],
              'date_mod' => ['date_mod'],
              'date_creation' => ['date_creation'],
          ],
      ]
   ];

   foreach ($tables as $table_name => $tabledata) {
      $DB->createOrDie($table_name, $tabledata['FIELDS'], $tabledata['KEYS']);
   }
}

function insertData() {
   global $DB;

   $tables['glpi_apiclients'][] = [
      'id'             => 1,
      'entities_id'    => 0,
      'is_recursive'   => 1,
      'name'           => 'full access from localhost',
      'is_active'      => 1,
      'ipv4_range_start'  => new \QueryExpression("INET_ATON('127.0.0.1')"), //TODO postgres
      'ipv4_range_end'    => new \QueryExpression("INET_ATON('127.0.0.1')"), //TODO postgres
      'ipv6'              => '::1'
   ];

   $tables['glpi_blacklists'] =[
      [
          'id'      => 1,
          'type'    => 1,
          'name'    => 'empty IP',
          'value'   => ''
      ], [
          'id'      => 2,
          'type'    => 1,
          'name'    => 'localhost',
          'value'   => '127.0.0.1'
      ], [
          'id'      => 3,
          'type'    => 1,
          'name'    => 'zero IP',
          'value'   => '0.0.0.0'
      ], [
          'id'      => 4,
          'type'    => 2,
          'name'    => 'empty MAC',
          'value'   => ''
      ]
   ];

   $tables['glpi_calendars'] = [
      [
          'id'               => 1,
          'name'             => 'Default',
          'entities_id'      => 0,
          'is_recursive'     => 1,
          'comment'          => 'Default calendar',
          'cache_duration'   => '[0,43200,43200,43200,43200,43200,0]'
      ]
   ];

   for ($i = 1; $i < 6; ++$i) {
      $tables['glpi_calendarsegments'][] = [
          'id'            => $i,
          'calendars_id'  => 1,
          'entities_id'   => 0,
          'is_recursive'  => 0,
          'day'           => $i,
          'begin'         => '08:00:00',
          'end'           => '20:00:00'
      ];
   }

   $default_prefs = [
     'version' => 'FILLED AT INSTALL',
     'show_jobs_at_login' => '0',
     'cut' => '250',
     'list_limit' => '15',
     'list_limit_max' => '50',
     'url_maxlength' => '30',
     'event_loglevel' => '5',
     'notifications_mailing' => '0',
     'admin_email' => 'admsys@localhost',
     'admin_email_name' => '',
     'admin_reply' => '',
     'admin_reply_name' => '',
     'mailing_signature' => 'SIGNATURE',
     'use_anonymous_helpdesk' => '0',
     'use_anonymous_followups' => '0',
     'language' => 'en_GB',
     'priority_1' => '#fff2f2',
     'priority_2' => '#ffe0e0',
     'priority_3' => '#ffcece',
     'priority_4' => '#ffbfbf',
     'priority_5' => '#ffadad',
     'priority_6' => '#ff5555',
     'date_tax' => '2005-12-31',
     'cas_host' => '',
     'cas_port' => '443',
     'cas_uri' => '',
     'cas_logout' => '',
     'existing_auth_server_field_clean_domain' => '0',
     'planning_begin' => '08:00:00',
     'planning_end' => '20:00:00',
     'utf8_conv' => '1',
     'use_public_faq' => '0',
     'url_base' => 'http://localhost/glpi/',
     'show_link_in_mail' => '0',
     'text_login' => '',
     'founded_new_version' => '',
     'dropdown_max' => '100',
     'ajax_wildcard' => '*',
     'ajax_limit_count' => '10',
     'use_ajax_autocompletion' => '1',
     'is_users_auto_add' => '1',
     'date_format' => '0',
     'number_format' => '0',
     'csv_delimiter' => ';',
     'is_ids_visible' => '0',
     'smtp_mode' => '0',
     'smtp_host' => '',
     'smtp_port' => '25',
     'smtp_username' => '',
     'proxy_name' => '',
     'proxy_port' => '8080',
     'proxy_user' => '',
     'add_followup_on_update_ticket' => '1',
     'keep_tickets_on_delete' => '0',
     'time_step' => '5',
     'decimal_number' => '2',
     'helpdesk_doc_url' => '',
     'central_doc_url' => '',
     'documentcategories_id_forticket' => '0',
     'monitors_management_restrict' => '2',
     'phones_management_restrict' => '2',
     'peripherals_management_restrict' => '2',
     'printers_management_restrict' => '2',
     'use_log_in_files' => '1',
     'time_offset' => '0',
     'is_contact_autoupdate' => '1',
     'is_user_autoupdate' => '1',
     'is_group_autoupdate' => '1',
     'is_location_autoupdate' => '1',
     'state_autoupdate_mode' => '0',
     'is_contact_autoclean' => '0',
     'is_user_autoclean' => '0',
     'is_group_autoclean' => '0',
     'is_location_autoclean' => '0',
     'state_autoclean_mode' => '0',
     'use_flat_dropdowntree' => '0',
     'use_autoname_by_entity' => '1',
     'softwarecategories_id_ondelete' => '1',
     'x509_email_field' => '',
     'x509_cn_restrict' => '',
     'x509_o_restrict' => '',
     'x509_ou_restrict' => '',
     'default_mailcollector_filesize_max' => '2097152',
     'followup_private' => '0',
     'task_private' => '0',
     'default_software_helpdesk_visible' => '1',
     'names_format' => '0',
     'default_requesttypes_id' => '1',
     'use_noright_users_add' => '1',
     'cron_limit' => '5',
     'priority_matrix' => '{"1":{"1":1,"2":1,"3":2,"4":2,"5":2},"2":{"1":1,"2":2,"3":2,"4":3,"5":3},"3":{"1":2,"2":2,"3":3,"4":4,"5":4},"4":{"1":2,"2":3,"3":4,"4":4,"5":5},"5":{"1":2,"2":3,"3":4,"4":5,"5":5}}',
     'urgency_mask' => '62',
     'impact_mask' => '62',
     'user_deleted_ldap' => '0',
     'auto_create_infocoms' => '0',
     'use_slave_for_search' => '0',
     'proxy_passwd' => '',
     'smtp_passwd' => '',
     'transfers_id_auto' => '0',
     'show_count_on_tabs' => '1',
     'refresh_ticket_list' => '0',
     'set_default_tech' => '1',
     'allow_search_view' => '2',
     'allow_search_all' => '0',
     'allow_search_global' => '1',
     'display_count_on_home' => '5',
     'use_password_security' => '0',
     'password_min_length' => '8',
     'password_need_number' => '1',
     'password_need_letter' => '1',
     'password_need_caps' => '1',
     'password_need_symbol' => '1',
     'use_check_pref' => '0',
     'notification_to_myself' => '1',
     'duedateok_color' => '#06ff00',
     'duedatewarning_color' => '#ffb800',
     'duedatecritical_color' => '#ff0000',
     'duedatewarning_less' => '20',
     'duedatecritical_less' => '5',
     'duedatewarning_unit' => '%',
     'duedatecritical_unit' => '%',
     'realname_ssofield' => '',
     'firstname_ssofield' => '',
     'email1_ssofield' => '',
     'email2_ssofield' => '',
     'email3_ssofield' => '',
     'email4_ssofield' => '',
     'phone_ssofield' => '',
     'phone2_ssofield' => '',
     'mobile_ssofield' => '',
     'comment_ssofield' => '',
     'title_ssofield' => '',
     'category_ssofield' => '',
     'language_ssofield' => '',
     'entity_ssofield' => '',
     'registration_number_ssofield' => '',
     'ssovariables_id' => '0',
     'translate_kb' => '0',
     'translate_dropdowns' => '0',
     'pdffont' => 'helvetica',
     'keep_devices_when_purging_item' => '0',
     'maintenance_mode' => '0',
     'maintenance_text' => '',
     'attach_ticket_documents_to_mail' => '0',
     'backcreated' => '0',
     'task_state' => '1',
     'layout' => 'lefttab',
     'palette' => 'auror',
     'lock_use_lock_item' => '0',
     'lock_autolock_mode' => '1',
     'lock_directunlock_notification' => '0',
     'lock_item_list' => '[]',
     'lock_lockprofile_id' => '8',
     'set_default_requester' => '1',
     'highcontrast_css' => '0',
     'smtp_check_certificate' => '1',
     'enable_api' => '0',
     'enable_api_login_credentials' => '0',
     'enable_api_login_external_token' => '1',
     'url_base_api' => 'http://localhost/glpi/api',
     'login_remember_time' => '604800',
     'login_remember_default' => '1',
     'use_notifications' => '0',
     'notifications_ajax' => '0',
     'notifications_ajax_check_interval' => '5',
     'notifications_ajax_sound' => null,
     'notifications_ajax_icon_url' => '/pics/glpi.png',
     'dbversion' => 'FILLED AT INSTALL',
     'smtp_max_retries' => '5',
     'smtp_sender' => null,
     'from_email' => null,
     'from_email_name' => null,
     'instance_uuid' => null,
     'registration_uuid' => null,
     'smtp_retry_time' => '5',
     'purge_addrelation' => '0',
     'purge_deleterelation' => '0',
     'purge_createitem' => '0',
     'purge_deleteitem' => '0',
     'purge_restoreitem' => '0',
     'purge_updateitem' => '0',
     'purge_computer_software_install' => '0',
     'purge_software_computer_install' => '0',
     'purge_software_version_install' => '0',
     'purge_infocom_creation' => '0',
     'purge_profile_user' => '0',
     'purge_group_user' => '0',
     'purge_adddevice' => '0',
     'purge_updatedevice' => '0',
     'purge_deletedevice' => '0',
     'purge_connectdevice'=> '0',
     'purge_disconnectdevice' => '0',
     'purge_userdeletedfromldap' => '0',
     'purge_comments' => '0',
     'purge_datemod' => '0',
     'purge_all' => '0',
     'purge_user_auth_changes' => '0',
     'purge_plugins' => '0',
     'display_login_source' => '1'
   ];

   foreach ($default_prefs as $name => $value) {
      $tables['glpi_configs'][] = [
          'context'   => 'core',
          'name'      => $name,
          'value'     => $value
      ];
   }

   $tables['glpi_crontasks'] = [
      [
          'id'            => 2,
          'itemtype'      => 'CartridgeItem',
          'name'          => 'cartridge',
          'frequency'     => '86400',
          'param'         => 10,
          'state'         => 0,
          'mode'          => 1,
          'lastrun'       => null,
          'logs_lifetime' => 30
      ], [
          'id'            => 3,
          'itemtype'      => 'ConsumableItem',
          'name'          => 'consumable',
          'frequency'     => '86400',
          'param'         => 10,
          'state'         => 0,
          'mode'          => 1,
          'lastrun'       => null,
          'logs_lifetime' => 30
      ], [
          'id'            => 4,
          'itemtype'      => 'SoftwareLicense',
          'name'          => 'software',
          'frequency'     => '86400',
          'param'         => null,
          'state'         => 0,
          'mode'          => 1,
          'lastrun'       => null,
          'logs_lifetime' => 30
      ], [
          'id'            => 5,
          'itemtype'      => 'Contract',
          'name'          => 'contract',
          'frequency'     => '86400',
          'param'         => null,
          'state'         => 1,
          'mode'          => 1,
          'lastrun'       => '2010-05-06 09:31:02',
          'logs_lifetime' => 30
      ], [
          'id'            => 6,
          'itemtype'      => 'InfoCom',
          'name'          => 'infocom',
          'frequency'     => '86400',
          'param'         => null,
          'state'         => 1,
          'mode'          => 1,
          'lastrun'       => '2011-01-18 11:40:43',
          'logs_lifetime' => 30
      ], [
          'id'            => 7,
          'itemtype'      => 'CronTask',
          'name'          => 'logs',
          'frequency'     => '86400',
          'param'         => '30',
          'state'         => 0,
          'mode'          => 1,
          'lastrun'       => null,
          'logs_lifetime' => 30
      ], [
          'id'            => 9,
          'itemtype'      => 'MailCollector',
          'name'          => 'mailgate',
          'frequency'     => '600',
          'param'         => '10',
          'state'         => 1,
          'mode'          => 1,
          'lastrun'       => '2011-06-28 11:34:37',
          'logs_lifetime' => 30
      ], [
          'id'            => 10,
          'itemtype'      => 'DBconnection',
          'name'          => 'checkdbreplicate',
          'frequency'     => '300',
          'param'         => null,
          'state'         => 0,
          'mode'          => 1,
          'lastrun'       => null,
          'logs_lifetime' => 30
      ], [
          'id'            => 11,
          'itemtype'      => 'CronTask',
          'name'          => 'checkupdate',
          'frequency'     => '604800',
          'param'         => null,
          'state'         => 0,
          'mode'          => 1,
          'lastrun'       => null,
          'logs_lifetime' => 30
      ], [
          'id'            => 12,
          'itemtype'      => 'CronTask',
          'name'          => 'session',
          'frequency'     => '86400',
          'param'         => null,
          'state'         => 1,
          'mode'          => 1,
          'lastrun'       => '2011-08-30 08:22:27',
          'logs_lifetime' => 30
      ], [
          'id'            => 13,
          'itemtype'      => 'CronTask',
          'name'          => 'graph',
          'frequency'     => 3600,
          'param'         => null,
          'state'         => 1,
          'mode'          => 1,
          'lastrun'       => '2011-12-06 09:48:42',
          'logs_lifetime' => 30
      ], [
          'id'            => 14,
          'itemtype'      => 'ReservationItem',
          'name'          => 'reservation',
          'frequency'     => 3600,
          'param'         => null,
          'state'         => 1,
          'mode'          => 1,
          'lastrun'       => '2012-04-05 20:31:57',
          'logs_lifetime' => 30
      ], [
          'id'            => 15,
          'itemtype'      => 'Ticket',
          'name'          => 'closeticket',
          'frequency'     => 43200,
          'param'         => null,
          'state'         => 1,
          'mode'          => 1,
          'lastrun'       => '2012-04-05 20:31:57',
          'logs_lifetime' => 30
      ], [
          'id'            => 16,
          'itemtype'      => 'Ticket',
          'name'          => 'alertnotclosed',
          'frequency'     => 43200,
          'param'         => null,
          'state'         => 1,
          'mode'          => 1,
          'lastrun'       => '2014-04-16 15:32:00',
          'logs_lifetime' => 30
      ], [
          'id'            => 17,
          'itemtype'      => 'SlaLevel_Ticket',
          'name'          => 'slaticket',
          'frequency'     => 300,
          'param'         => null,
          'state'         => 1,
          'mode'          => 1,
          'lastrun'       => '2014-06-18 08:02:00',
          'logs_lifetime' => 30
      ], [
          'id'            => 18,
          'itemtype'      => 'Ticket',
          'name'          => 'createinquest',
          'frequency'     => 86400,
          'param'         => null,
          'state'         => 1,
          'mode'          => 1,
          'lastrun'       => null,
          'logs_lifetime' => 30
      ], [
          'id'            => 19,
          'itemtype'      => 'CronTask',
          'name'          => 'watcher',
          'frequency'     => 86400,
          'param'         => null,
          'state'         => 1,
          'mode'          => 1,
          'lastrun'       => null,
          'logs_lifetime' => 30
      ], [
          'id'            => 20,
          'itemtype'      => 'TicketRecurrent',
          'name'          => 'ticketrecurrent',
          'frequency'     => 3600,
          'param'         => null,
          'state'         => 1,
          'mode'          => 1,
          'lastrun'       => null,
          'logs_lifetime' => 30
      ], [
          'id'            => 21,
          'itemtype'      => 'PlanningRecall',
          'name'          => 'planningrecall',
          'frequency'     => 300,
          'param'         => null,
          'state'         => 1,
          'mode'          => 1,
          'lastrun'       => null,
          'logs_lifetime' => 30
      ], [
          'id'            => 22,
          'itemtype'      => 'QueuedNotification',
          'name'          => 'queuednotification',
          'frequency'     => 60,
          'param'         => 50,
          'state'         => 1,
          'mode'          => 1,
          'lastrun'       => null,
          'logs_lifetime' => 30
      ], [
          'id'            => 23,
          'itemtype'      => 'QueuedNotification',
          'name'          => 'queuednotificationclean',
          'frequency'     => 86400,
          'param'         => 30,
          'state'         => 1,
          'mode'          => 1,
          'lastrun'       => null,
          'logs_lifetime' => 30
      ], [
          'id'            => 24,
          'itemtype'      => 'CronTask',
          'name'          => 'temp',
          'frequency'     => 3600,
          'param'         => null,
          'state'         => 1,
          'mode'          => 1,
          'lastrun'       => null,
          'logs_lifetime' => 30
      ], [
          'id'            => 25,
          'itemtype'      => 'MailCollector',
          'name'          => 'mailgateerror',
          'frequency'     => 86400,
          'param'         => null,
          'state'         => 1,
          'mode'          => 1,
          'lastrun'       => null,
          'logs_lifetime' => 30
      ], [
          'id'            => 26,
          'itemtype'      => 'CronTask',
          'name'          => 'circularlogs',
          'frequency'     => 86400,
          'param'         => 4,
          'state'         => 0,
          'mode'          => 1,
          'lastrun'       => null,
          'logs_lifetime' => 30
      ], [
          'id'            => 27,
          'itemtype'      => 'ObjectLock',
          'name'          => 'unlockobject',
          'frequency'     => 86400,
          'param'         => 4,
          'state'         => 0,
          'mode'          => 1,
          'lastrun'       => null,
          'logs_lifetime' => 30
      ], [
          'id'            => 28,
          'itemtype'      => 'SavedSearch',
          'name'          => 'countAll',
          'frequency'     => 604800,
          'param'         => null,
          'state'         => 0,
          'mode'          => 1,
          'lastrun'       => null,
          'logs_lifetime' => 10
      ], [
          'id'            => 29,
          'itemtype'      => 'SavedSearch_Alert',
          'name'          => 'savedsearchesalerts',
          'frequency'     => 86400,
          'param'         => null,
          'state'         => 0,
          'mode'          => 1,
          'lastrun'       => null,
          'logs_lifetime' => 10
      ], [
          'id'            => 30,
          'itemtype'      => 'Telemetry',
          'name'          => 'telemetry',
          'frequency'     => 2592000,
          'param'         => null,
          'state'         => 0,
          'mode'          => 1,
          'lastrun'       => null,
          'logs_lifetime' => 10
      ], [
          'id'            => 31,
          'itemtype'      => 'Certificate',
          'name'          => 'certificate',
          'frequency'     => 86400,
          'param'         => null,
          'state'         => 0,
          'mode'          => 1,
          'lastrun'       => null,
          'logs_lifetime' => 10
      ], [
          'id'            => 32,
          'itemtype'      => 'OlaLevel_Ticket',
          'name'          => 'olaticket',
          'frequency'     => 300,
          'param'         => null,
          'state'         => 1,
          'mode'          => 1,
          'lastrun'       => '2014-06-18 08:02:00',
          'logs_lifetime' => 30
      ]
   ];

   $tables['glpi_devicememorytypes'] = [
      ['id' => 1, 'name' => 'EDO'],
      ['id' => 2, 'name' => 'DDR'],
      ['id' => 3, 'name' => 'SDRAM'],
      ['id' => 4, 'name' => 'SDRAM-2'],
   ];

   $tables['glpi_devicesimcardtypes'] = [
      ['id' => 1, 'name' => 'Full SIM'],
      ['id' => 2, 'name' => 'Mini SIM'],
      ['id' => 3, 'name' => 'Micro SIM'],
      ['id' => 4, 'name' => 'Nano SIM'],
   ];

   $tables['glpi_displaypreferences'] = [
     [
         'itemtype' => 'Computer',
         'num'      => '4',
         'rank'     => '4',
         'is_main'  => '1'
     ], [
         'itemtype' => 'Computer',
         'num'      => '45',
         'rank'     => '6',
         'is_main'  => '1'
     ], [
         'itemtype' => 'Computer',
         'num'      => '40',
         'rank'     => '5',
         'is_main'  => '1',
     ], [
         'itemtype' => 'Computer',
         'num'      => '5',
         'rank'     => '3',
         'is_main'  => '1'
     ], [
        'itemtype'  => 'Computer',
        'num'       => '23',
        'rank'      => '2',
        'is_main'   => 1
     ], [
        'itemtype'  => 'DocumentType',
        'num'       => '3',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Monitor',
        'num'       => '31',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Monitor',
        'num'       => '23',
        'rank'      => '2',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Monitor',
        'num'       => '3',
        'rank'      => '3',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Monitor',
        'num'       => '4',
        'rank'      => '4',
        'is_main' => 1
     ], [
        'itemtype'  => 'Printer',
        'num'       => '31',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'NetworkEquipment',
        'num'       => '31',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'NetworkEquipment',
        'num'       => '23',
        'rank'      => '2',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Printer',
        'num'       => '23',
        'rank'      => '2',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Printer',
        'num'       => '3',
        'rank'      => '3',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Software',
        'num'       => '4',
        'rank'      => '3',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Software',
        'num'       => '5',
        'rank'      => '2',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Software',
        'num'       => '23',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'CartridgeItem',
        'num'       => '4',
        'rank'      => '2',
        'is_main'   => 1
     ], [
        'itemtype'  => 'CartridgeItem',
        'num'       => '34',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Peripheral',
        'num'       => '3',
        'rank'      => '3',
        'is_main' => 1
     ], [
        'itemtype'  => 'Peripheral',
        'num'       => '23',
        'rank'      => '2',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Peripheral',
        'num'       => '31',
        'rank'      => '1',
        'is_main' => 1
     ], [
        'itemtype'  => 'Computer',
        'num'       => '31',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Computer',
        'num'       => '3',
        'rank'      => '7',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Computer',
        'num'       => '19',
        'rank'      => '8',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Computer',
        'num'       => '17',
        'rank'      => '9',
        'is_main'   => 1
     ], [
        'itemtype'  => 'NetworkEquipment',
        'num'       => '3',
        'rank'      => '3',
        'is_main'   => 1
     ], [
        'itemtype'  => 'NetworkEquipment',
        'num'       => '4',
        'rank'      => '4',
        'is_main' => 1
     ], [
        'itemtype'  => 'NetworkEquipment',
        'num'       => '11',
        'rank'      => '6',
        'is_main'   => 1
     ], [
        'itemtype'  => 'NetworkEquipment',
        'num'       => '19',
        'rank'      => '7',
        'is_main' => 1
     ], [
        'itemtype'  => 'Printer',
        'num'       => '4',
        'rank'      => '4',
        'is_main' => 1
     ], [
        'itemtype'  => 'Printer',
        'num'       => '19',
        'rank'      => '6',
        'is_main' => 1
     ], [
        'itemtype'  => 'Monitor',
        'num'       => '19',
        'rank'      => '6',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Monitor',
        'num'       => '7',
        'rank'      => '7',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Peripheral',
        'num'       => '4',
        'rank'      => '4',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Peripheral',
        'num'       => '19',
        'rank'      => '6',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Peripheral',
        'num'       => '7',
        'rank'      => '7',
        'is_main' => 1
     ], [
        'itemtype'  => 'Contact',
        'num'       => '3',
        'rank'      => '1',
        'is_main' => 1
     ], [
        'itemtype'  => 'Contact',
        'num'       => '4',
        'rank'      => '2',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Contact',
        'num'       => '5',
        'rank'      => '3',
        'is_main' => 1
     ], [
        'itemtype'  => 'Contact',
        'num'       => '6',
        'rank'      => '4',
        'is_main' => 1
     ], [
        'itemtype'  => 'Contact',
        'num'       => '9',
        'rank'      => '5',
        'is_main' => 1
     ], [
        'itemtype'  => 'Supplier',
        'num'       => '9',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Supplier',
        'num'       => '3',
        'rank'      => '2',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Supplier',
        'num'       => '4',
        'rank'      => '3',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Supplier',
        'num'       => '5',
        'rank'      => '4',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Supplier',
        'num'       => '10',
        'rank'      => '5',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Supplier',
        'num'       => '6',
        'rank'      => '6',
        'is_main' => 1
     ], [
        'itemtype'  => 'Contract',
        'num'       => '4',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Contract',
        'num'       => '3',
        'rank'      => '2',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Contract',
        'num'       => '5',
        'rank'      => '3',
        'is_main' => 1
     ], [
        'itemtype'  => 'Contract',
        'num'       => '6',
        'rank'      => '4',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Contract',
        'num'       => '7',
        'rank'      => '5',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Contract',
        'num'       => '11',
        'rank'      => '6',
        'is_main'   => 1
     ], [
        'itemtype'  => 'CartridgeItem',
        'num'       => '23',
        'rank'      => '3',
        'is_main' => 1
     ], [
        'itemtype'  => 'CartridgeItem',
        'num'       => '3',
        'rank'      => '4',
        'is_main' => 1
     ], [
        'itemtype'  => 'DocumentType',
        'num'       => '6',
        'rank'      => '2',
        'is_main' => 1
     ], [
        'itemtype'  => 'DocumentType',
        'num'       => '4',
        'rank'      => '3',
        'is_main' => 1
     ], [
        'itemtype'  => 'DocumentType',
        'num'       => '5',
        'rank'      => '4',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Document',
        'num'       => '3',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Document',
        'num'       => '4',
        'rank'      => '2',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Document',
        'num'       => '7',
        'rank'      => '3',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Document',
        'num'       => '5',
        'rank'      => '4',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Document',
        'num'       => '16',
        'rank'      => '5',
        'is_main'   => 1
     ], [
        'itemtype'  => 'User',
        'num'       => '34',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'User',
        'num'       => '5',
        'rank'      => '3',
        'is_main'   => 1
     ], [
        'itemtype'  => 'User',
        'num'       => '6',
        'rank'      => '4',
        'is_main'   => 1
     ], [
        'itemtype'  => 'User',
        'num'       => '3',
        'rank'      => '5',
        'is_main'   => 1
     ], [
        'itemtype'  => 'ConsumableItem',
        'num'       => '34',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'ConsumableItem',
        'num'       => '4',
        'rank'      => '2',
        'is_main'   => 1
     ], [
        'itemtype'  => 'ConsumableItem',
        'num'       => '23',
        'rank'      => '3',
        'is_main'   => 1
     ], [
        'itemtype'  => 'ConsumableItem',
        'num'       => '3',
        'rank'      => '4',
        'is_main'   => 1
     ], [
        'itemtype'  => 'NetworkEquipment',
        'num'       => '40',
        'rank'      => '5',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Printer',
        'num'       => '40',
        'rank'      => '5',
        'is_main' => 1
     ], [
        'itemtype'  => 'Monitor',
        'num'       => '40',
        'rank'      => '5',
        'is_main' => 1
     ], [
        'itemtype'  => 'Peripheral',
        'num'       => '40',
        'rank'      => '5',
        'is_main'   => 1
     ], [
        'itemtype'  => 'User',
        'num'       => '8',
        'rank'      => '6',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Phone',
        'num'       => '31',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Phone',
        'num'       => '23',
        'rank'      => '2',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Phone',
        'num'       => '3',
        'rank'      => '3',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Phone',
        'num'       => '4',
        'rank'      => '4',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Phone',
        'num'       => '40',
        'rank'      => '5',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Phone',
        'num'       => '19',
        'rank'      => '6',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Phone',
        'num'       => '7',
        'rank'      => '7',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Group',
        'num'       => '16',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'AllAssets',
        'num'       => '31',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'ReservationItem',
        'num'       => '4',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'ReservationItem',
        'num'       => '3',
        'rank'      => '2',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Budget',
        'num'       => '3',
        'rank'      => '2',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Software',
        'num'       => '72',
        'rank'      => '4',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Software',
        'num'       => '163',
        'rank'      => '5',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Budget',
        'num'       => '5',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Budget',
        'num'       => '4',
        'rank'      => '3',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Budget',
        'num'       => '19',
        'rank'      => '4',
        'is_main' => 1
     ], [
        'itemtype'  => 'CronTask',
        'num'       => '8',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'CronTask',
        'num'       => '3',
        'rank'      => '2',
        'is_main'   => 1
     ], [
        'itemtype'  => 'CronTask',
        'num'       => '4',
        'rank'      => '3',
        'is_main'   => 1
     ], [
        'itemtype'  => 'CronTask',
        'num'       => '7',
        'rank'      => '4',
        'is_main'   => 1
     ], [
        'itemtype'  => 'RequestType',
        'num'       => '14',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'RequestType',
        'num'       => '15',
        'rank'      => '2',
        'is_main'   => 1
     ], [
        'itemtype'  => 'NotificationTemplate',
        'num'       => '4',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'NotificationTemplate',
        'num'       => '16',
        'rank'      => '2',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Notification',
        'num'       => '5',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Notification',
        'num'       => '6',
        'rank'      => '2',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Notification',
        'num'       => '2',
        'rank'      => '3',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Notification',
        'num'       => '4',
        'rank'      => '4',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Notification',
        'num'       => '80',
        'rank'      => '5',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Notification',
        'num'       => '86',
        'rank'      => '6',
        'is_main'   => 1
     ], [
        'itemtype'  => 'MailCollector',
        'num'       => '2',
        'rank'      => '1',
        'is_main' => 1
     ], [
        'itemtype'  => 'MailCollector',
        'num'       => '19',
        'rank'      => '2',
        'is_main'   => 1
     ], [
        'itemtype'  => 'AuthLDAP',
        'num'       => '3',
        'rank'      => '1',
        'is_main' => 1
     ], [
        'itemtype'  => 'AuthLDAP',
        'num'       => '19',
        'rank'      => '2',
        'is_main' => 1
     ], [
        'itemtype'  => 'AuthMail',
        'num'       => '3',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'AuthMail',
        'num'       => '19',
        'rank'      => '2',
        'is_main'   => 1
     ], [
        'itemtype'  => 'IPNetwork',
        'num'       => '18',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'WifiNetwork',
        'num'       => '10',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Profile',
        'num'       => '2',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Profile',
        'num'       => '3',
        'rank'      => '2',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Profile',
        'num'       => '19',
        'rank'      => '3',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Transfer',
        'num'       => '19',
        'rank'      => '1',
        'is_main' => 1
     ], [
        'itemtype'  => 'TicketValidation',
        'num'       => '3',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'TicketValidation',
        'num'       => '2',
        'rank'      => '2',
        'is_main'   => 1
     ], [
        'itemtype'  => 'TicketValidation',
        'num'       => '8',
        'rank'      => '3',
        'is_main'   => 1
     ], [
        'itemtype'  => 'TicketValidation',
        'num'       => '4',
        'rank'      => '4',
        'is_main' => 1
     ], [
        'itemtype'  => 'TicketValidation',
        'num'       => '9',
        'rank'      => '5',
        'is_main'   => 1
     ], [
        'itemtype'  => 'TicketValidation',
        'num'       => '7',
        'rank'      => '6',
        'is_main'   => 1
     ], [
        'itemtype'  => 'NotImportedEmail',
        'num'       => '2',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'NotImportedEmail',
        'num'       => '5',
        'rank'      => '2',
        'is_main'   => 1
     ], [
        'itemtype'  => 'NotImportedEmail',
        'num'       => '4',
        'rank'      => '3',
        'is_main'   => 1
     ], [
        'itemtype'  => 'NotImportedEmail',
        'num'       => '6',
        'rank'      => '4',
        'is_main'   => 1
     ], [
        'itemtype'  => 'NotImportedEmail',
        'num'       => '16',
        'rank'      => '5',
        'is_main'   => 1
     ], [
        'itemtype'  => 'NotImportedEmail',
        'num'       => '19',
        'rank'      => '6',
        'is_main'   => 1
     ], [
        'itemtype'  => 'RuleRightParameter',
        'num'       => '11',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Ticket',
        'num'       => '12',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Ticket',
        'num'       => '19',
        'rank'      => '2',
        'is_main' => 1
     ], [
        'itemtype'  => 'Ticket',
        'num'       => '15',
        'rank'      => '3',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Ticket',
        'num'       => '3',
        'rank'      => '4',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Ticket',
        'num'       => '4',
        'rank'      => '5',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Ticket',
        'num'       => '5',
        'rank'      => '6',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Ticket',
        'num'       => '7',
        'rank'      => '7',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Calendar',
        'num'       => '19',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Holiday',
        'num'       => '11',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Holiday',
        'num'       => '12',
        'rank'      => '2',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Holiday',
        'num'       => '13',
        'rank'      => '3',
        'is_main'   => 1
     ], [
        'itemtype'  => 'SLA',
        'num'       => '4',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Ticket',
        'num'       => '18',
        'rank'      => '8',
        'is_main'   => 1
     ], [
        'itemtype'  => 'AuthLdap',
        'num'       => '30',
        'rank'      => '3',
        'is_main'   => 1
     ], [
        'itemtype'  => 'AuthMail',
        'num'       => '6',
        'rank'      => '3',
        'is_main'   => 1
     ], [
        'itemtype'  => 'FQDN',
        'num'       => '11',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'FieldUnicity',
        'num'       => '1',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'FieldUnicity',
        'num'       => '80',
        'rank'      => '2',
        'is_main'   => 1
     ], [
        'itemtype'  => 'FieldUnicity',
        'num'       => '4',
        'rank'      => '3',
        'is_main'   => 1
     ], [
        'itemtype'  => 'FieldUnicity',
        'num'       => '3',
        'rank'      => '4',
        'is_main'   => 1
     ], [
        'itemtype'  => 'FieldUnicity',
        'num'       => '86',
        'rank'      => '5',
        'is_main'   => 1
     ], [
        'itemtype'  => 'FieldUnicity',
        'num'       => '30',
        'rank'      => '6',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Problem',
        'num'       => '21',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Problem',
        'num'       => '12',
        'rank'      => '2',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Problem',
        'num'       => '19',
        'rank'      => '3',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Problem',
        'num'       => '15',
        'rank'      => '4',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Problem',
        'num'       => '3',
        'rank'      => '5',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Problem',
        'num'       => '7',
        'rank'      => '6',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Problem',
        'num'       => '18',
        'rank'      => '7',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Vlan',
        'num'       => '11',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'TicketRecurrent',
        'num'       => '11',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'TicketRecurrent',
        'num'       => '12',
        'rank'      => '2',
        'is_main'   => 1
     ], [
        'itemtype'  => 'TicketRecurrent',
        'num'       => '13',
        'rank'      => '3',
        'is_main'   => 1
     ], [
        'itemtype'  => 'TicketRecurrent',
        'num'       => '15',
        'rank'      => '4',
        'is_main'   => 1
     ], [
        'itemtype'  => 'TicketRecurrent',
        'num'       => '14',
        'rank'      => '5',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Reminder',
        'num'       => '2',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Reminder',
        'num'       => '3',
        'rank'      => '2',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Reminder',
        'num'       => '4',
        'rank'      => '3',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Reminder',
        'num'       => '5',
        'rank'      => '4',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Reminder',
        'num'       => '6',
        'rank'      => '5',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Reminder',
        'num'       => '7',
        'rank'      => '6',
        'is_main'   => 1
     ], [
        'itemtype'  => 'IPNetwork',
        'num'       => '10',
        'rank'      => '2',
        'is_main'   => 1
     ], [
        'itemtype'  => 'IPNetwork',
        'num'       => '11',
        'rank'      => '3',
        'is_main'   => 1
     ], [
        'itemtype'  => 'IPNetwork',
        'num'       => '12',
        'rank'      => '4',
        'is_main'   => 1
     ], [
        'itemtype'  => 'IPNetwork',
        'num'       => '17',
        'rank'      => '5',
        'is_main'   => 1
     ], [
        'itemtype'  => 'NetworkName',
        'num'       => '12',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'NetworkName',
        'num'       => '13',
        'rank'      => '2',
        'is_main'   => 1
     ], [
        'itemtype'  => 'RSSFeed',
        'num'       => '2',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'RSSFeed',
        'num'       => '4',
        'rank'      => '2',
        'is_main'   => 1
     ], [
        'itemtype'  => 'RSSFeed',
        'num'       => '5',
        'rank'      => '3',
        'is_main'   => 1
     ], [
        'itemtype'  => 'RSSFeed',
        'num'       => '19',
        'rank'      => '4',
        'is_main'   => 1
     ], [
        'itemtype'  => 'RSSFeed',
        'num'       => '6',
        'rank'      => '5',
        'is_main'   => 1
     ], [
        'itemtype'  => 'RSSFeed',
        'num'       => '7',
        'rank'      => '6',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Blacklist',
        'num'       => '12',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Blacklist',
        'num'       => '11',
        'rank'      => '2',
        'is_main'   => 1
     ], [
        'itemtype'  => 'ReservationItem',
        'num'       => '5',
        'rank'      => '3',
        'is_main'   => 1
     ], [
        'itemtype'  => 'QueueMail',
        'num'       => '16',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'QueueMail',
        'num'       => '7',
        'rank'      => '2',
        'is_main'   => 1
     ], [
        'itemtype'  => 'QueueMail',
        'num'       => '20',
        'rank'      => '3',
        'is_main'   => 1
     ], [
        'itemtype'  => 'QueueMail',
        'num'       => '21',
        'rank'      => '4',
        'is_main'   => 1
     ], [
        'itemtype'  => 'QueueMail',
        'num'       => '22',
        'rank'      => '5',
        'is_main'   => 1
     ], [
        'itemtype'  => 'QueueMail',
        'num'       => '15',
        'rank'      => '6',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Change',
        'num'       => '12',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Change',
        'num'       => '19',
        'rank'      => '2',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Change',
        'num'       => '15',
        'rank'      => '3',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Change',
        'num'       => '7',
        'rank'      => '4',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Change',
        'num'       => '18',
        'rank'      => '5',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Project',
        'num'       => '3',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Project',
        'num'       => '4',
        'rank'      => '2',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Project',
        'num'       => '12',
        'rank'      => '3',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Project',
        'num'       => '5',
        'rank'      => '4',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Project',
        'num'       => '15',
        'rank'      => '5',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Project',
        'num'       => '21',
        'rank'      => '6',
        'is_main'   => 1
     ], [
        'itemtype'  => 'ProjectState',
        'num'       => '12',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'ProjectState',
        'num'       => '11',
        'rank'      => '2',
        'is_main'   => 1
     ], [
        'itemtype'  => 'ProjectTask',
        'num'       => '2',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'ProjectTask',
        'num'       => '12',
        'rank'      => '2',
        'is_main'   => 1
     ], [
        'itemtype'  => 'ProjectTask',
        'num'       => '14',
        'rank'      => '3',
        'is_main'   => 1
     ], [
        'itemtype'  => 'ProjectTask',
        'num'       => '5',
        'rank'      => '4',
        'is_main'   => 1
     ], [
        'itemtype'  => 'ProjectTask',
        'num'       => '7',
        'rank'      => '5',
        'is_main'   => 1
     ], [
        'itemtype'  => 'ProjectTask',
        'num'       => '8',
        'rank'      => '6',
        'is_main'   => 1
     ], [
        'itemtype'  => 'ProjectTask',
        'num'       => '13',
        'rank'      => '7',
        'is_main'   => 1
     ], [
        'itemtype'  => 'CartridgeItem',
        'num'       => '9',
        'rank'      => '5',
        'is_main' => 1
     ], [
        'itemtype'  => 'ConsumableItem',
        'num'       => '9',
        'rank'      => '5',
        'is_main'   => 1
     ], [
        'itemtype'  => 'ReservationItem',
        'num'       => '9',
        'rank'      => '4',
        'is_main'   => 1
     ], [
        'itemtype'  => 'SoftwareLicense',
        'num'       => '1',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'SoftwareLicense',
        'num'       => '3',
        'rank'      => '2',
        'is_main'   => 1
     ], [
        'itemtype'  => 'SoftwareLicense',
        'num'       => '10',
        'rank'      => '3',
        'is_main'   => 1
     ], [
        'itemtype'  => 'SoftwareLicense',
        'num'       => '162',
        'rank'      => '4',
        'is_main'   => 1
     ], [
        'itemtype'  => 'SoftwareLicense',
        'num'       => '5',
        'rank'      => '5',
        'is_main'   => 1
     ], [
        'itemtype'  => 'SavedSearch',
        'num'       => '8',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'SavedSearch',
        'num'       => '9',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'SavedSearch',
        'num'       => '3',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'SavedSearch',
        'num'       => '10',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'SavedSearch',
        'num'       => '11',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Plugin',
        'num'       => '2',
        'rank'      => '1',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Plugin',
        'num'       => '3',
        'rank'      => '2',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Plugin',
        'num'       => '4',
        'rank'      => '3',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Plugin',
        'num'       => '5',
        'rank'      => '4',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Plugin',
        'num'       => '6',
        'rank'      => '5',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Plugin',
        'num'       => '7',
        'rank'      => '6',
        'is_main'   => 1
     ], [
        'itemtype'  => 'Plugin',
        'num'       => '8',
        'rank'      => '7',
        'is_main'   => 1
     ], [

        'itemtype'  => 'Contract',
        'num'       => '3',
        'rank'      => '1',
        'is_main'   => 0
     ], [
        'itemtype'  => 'Contract',
        'num'       => '4',
        'rank'      => '2',
        'is_main'   => 0
     ], [
        'itemtype'  => 'Contract',
        'num'       => '29',
        'rank'      => '3',
        'is_main'   => 0
     ], [
        'itemtype'  => 'Contract',
        'num'       => '5',
        'rank'      => '4',
        'is_main'   => 0
     ], [
        'itemtype'  => 'Item_Disk',
        'num'       => '2',
        'rank'      => '1',
        'is_main'   => 0
     ], [
        'itemtype'  => 'Item_Disk',
        'num'       => '3',
        'rank'      => '2',
        'is_main'   => 0
     ], [
        'itemtype'  => 'Item_Disk',
        'num'       => '4',
        'rank'      => '3',
        'is_main'   => 0
     ], [
        'itemtype'  => 'Item_Disk',
        'num'       => '5',
        'rank'      => '4',
        'is_main'   => 0
     ], [
        'itemtype'  => 'Item_Disk',
        'num'       => '6',
        'rank'      => '5',
        'is_main'   => 0
     ], [
        'itemtype'  => 'Item_Disk',
        'num'       => '7',
        'rank'      => '6',
        'is_main'   => 0
     ], [
        'itemtype'  => 'Certificate',
        'num'       => '7',
        'rank'      => '1',
        'is_main'   => 0
     ], [
        'itemtype'  => 'Certificate',
        'num'       => '4',
        'rank'      => '2',
        'is_main'   => 0
     ], [
        'itemtype'  => 'Certificate',
        'num'       => '8',
        'rank'      => '3',
        'is_main'   => 0
     ], [
        'itemtype'  => 'Certificate',
        'num'       => '121',
        'rank'      => '4',
        'is_main'   => 0
     ], [
        'itemtype'  => 'Certificate',
        'num'       => '10',
        'rank'      => '5',
        'is_main'   => 0
     ], [
        'itemtype'  => 'Certificate',
        'num'       => '31',
        'rank'      => '6',
        'is_main'   => 0
     ], [

        'itemtype'  => 'Notepad',
        'num'       => '200',
        'rank'      => '1',
        'is_main'   => 0
     ], [
        'itemtype'  => 'Notepad',
        'num'       => '201',
        'rank'      => '2',
        'is_main'   => 0
     ], [
        'itemtype'  => 'Notepad',
        'num'       => '202',
        'rank'      => '3',
        'is_main'   => 0
     ], [
        'itemtype'  => 'Notepad',
        'num'       => '203',
        'rank'      => '4',
        'is_main'   => 0
     ], [
        'itemtype'  => 'Notepad',
        'num'       => '204',
        'rank'      => '5',
        'is_main'   => 0
     ], [
        'itemtype'  => 'SoftwareVersion',
        'num'       => '3',
        'rank'      => '1',
        'is_main'   => 0
     ], [
        'itemtype'  => 'SoftwareVersion',
        'num'       => '31',
        'rank'      => '1',
        'is_main'   => 0
     ], [
        'itemtype'  => 'SoftwareVersion',
        'num'       => '2',
        'rank'      => '1',
        'is_main'   => 0
     ], [
        'itemtype'  => 'SoftwareVersion',
        'num'        => '122',
        'rank'      => '1',
        'is_main'   => 0
     ], [
        'itemtype'  => 'SoftwareVersion',
        'num'       => '123',
        'rank'      => '1',
        'is_main'   => 0
     ], [
        'itemtype'  => 'SoftwareVersion',
        'num'       => '124',
        'rank'      => '1',
        'is_main'   => 0
     ]
   ];

   $tables['glpi_documenttypes'] = [
     [
        'id'  => 1,
        'name'   => 'JPEG',
        'ext'    => 'jpg',
        'icon'   => 'jpg-dist.png'
     ], [
        'id'     => 2,
        'name'   => 'PNG',
        'ext'    => 'png',
        'icon'   => 'png-dist.png'
     ], [
        'id'     => 3,
        'name'   => 'GIF',
        'ext'    => 'gif',
        'icon'   => 'gif-dist.png'
     ], [
        'id'     => '4',
        'name'   => 'BMP',
        'ext'    => 'bmp',
        'icon'   => 'bmp-dist.png'
     ], [
        'id'     => '5',
        'name'   => 'Photoshop',
        'ext'    => 'psd',
        'icon'   => 'psd-dist.png'
     ], [
        'id'     => '6',
        'name'   => 'TIFF',
        'ext'    => 'tif',
        'icon'   => 'tif-dist.png'
     ], [
        'id'     => '7',
        'name'   => 'AIFF',
        'ext'    => 'aiff',
        'icon'   => 'aiff-dist.png'
     ], [
        'id'     => '8',
        'name'   => 'Windows Media',
        'ext'    => 'asf',
        'icon'   => 'asf-dist.png'
     ], [
        'id'     => '9',
        'name'   => 'Windows Media',
        'ext'    => 'avi',
        'icon'   => 'avi-dist.png'
     ], [
        'id'     => '44',
        'name'   => 'C source',
        'ext'    => 'c',
        'icon'   => 'c-dist.png'
     ], [
        'id'     => '27',
        'name'   => 'RealAudio',
        'ext'    => 'rm',
        'icon'   => 'rm-dist.png'
     ], [
        'id'     => '16',
        'name'   => 'Midi',
        'ext'    => 'mid',
        'icon'   => 'mid-dist.png'
     ], [
        'id'     => '17',
        'name'   => 'QuickTime',
        'ext'    => 'mov',
        'icon'   => 'mov-dist.png'
     ], [
        'id'     => '18',
        'name'   => 'MP3',
        'ext'    => 'mp3',
        'icon'   => 'mp3-dist.png'
     ], [
        'id'     => '19',
        'name'   => 'MPEG',
        'ext'    => 'mpg',
        'icon'   => 'mpg-dist.png'
     ], [
        'id'     => '20',
        'name'   => 'Ogg Vorbis',
        'ext'    => 'ogg',
        'icon'   => 'ogg-dist.png'
     ], [
        'id'     => '24',
        'name'   => 'QuickTime',
        'ext'    => 'qt',
        'icon'   => 'qt-dist.png'
     ], [
        'id'     => '10',
        'name'   => 'BZip',
        'ext'    => 'bz2',
        'icon'   => 'bz2-dist.png'
     ], [
        'id'     => '25',
        'name'   => 'RealAudio',
        'ext'    => 'ra',
        'icon'   => 'ra-dist.png'
     ], [
        'id'     => '26',
        'name'   => 'RealAudio',
        'ext'    => 'ram',
        'icon'   => 'ram-dist.png'
     ], [
        'id'     => '11',
        'name'   => 'Word',
        'ext'    => 'doc',
        'icon'   => 'doc-dist.png'
     ], [
        'id'     => '12',
        'name'   => 'DjVu',
        'ext'    => 'djvu',
        'icon'   => ''
     ], [
        'id'     => '42',
        'name'   => 'MNG',
        'ext'    => 'mng',
        'icon'   => ''
     ], [
        'id'     => '13',
        'name'   => 'PostScript',
        'ext'    => 'eps',
        'icon'   => 'ps-dist.png'
     ], [
        'id'     => '14',
        'name'   => 'GZ',
        'ext'    => 'gz',
        'icon'   => 'gz-dist.png'
     ], [
        'id'     => '37',
        'name'   => 'WAV',
        'ext'    => 'wav',
        'icon'   => 'wav-dist.png'
     ], [
        'id'     => '15',
        'name'   => 'HTML',
        'ext'    => 'html',
        'icon'   => 'html-dist.png'
     ], [
        'id'     => '34',
        'name'   => 'Flash',
        'ext'    => 'swf',
        'icon'   => 'swf-dist.png'
     ], [
        'id'     => '21',
        'name'   => 'PDF',
        'ext'    => 'pdf',
        'icon'   => 'pdf-dist.png'
     ], [
        'id'     => '22',
        'name'   => 'PowerPoint',
        'ext'    => 'ppt',
        'icon'   => 'ppt-dist.png'
     ], [
        'id'     => '23',
        'name'   => 'PostScript',
        'ext'    => 'ps',
        'icon'   => 'ps-dist.png'
     ], [
        'id'     => '40',
        'name'   => 'Windows Media',
        'ext'    => 'wmv',
        'icon'   => 'wmv-dist.png'
     ], [
        'id'     => '28',
        'name'   => 'RTF',
        'ext'    => 'rtf',
        'icon'   => 'rtf-dist.png'
     ], [
        'id'     => '29',
        'name'   => 'StarOffice',
        'ext'    => 'sdd',
        'icon'   => 'sdd-dist.png'
     ], [
        'id'     => '30',
        'name'   => 'StarOffice',
        'ext'    => 'sdw',
        'icon'   => 'sdw-dist.png'
     ], [
        'id'     => '31',
        'name'   => 'Stuffit',
        'ext'    => 'sit',
        'icon'   => 'sit-dist.png'
     ], [
        'id'     => '43',
        'name'   => 'Adobe Illustrator',
        'ext'    => 'ai',
        'icon'   => 'ai-dist.png'
     ], [
        'id'     => '32',
        'name'   => 'OpenOffice Impress',
        'ext'    => 'sxi',
        'icon'   => 'sxi-dist.png'
     ], [
        'id'     => '33',
        'name'   => 'OpenOffice',
        'ext'    => 'sxw',
        'icon'   => 'sxw-dist.png'
     ], [
        'id'     => '46',
        'name'   => 'DVI',
        'ext'    => 'dvi',
        'icon'   => 'dvi-dist.png'
     ], [
        'id'     => '35',
        'name'   => 'TGZ',
        'ext'    => 'tgz',
        'icon'   => 'tgz-dist.png'
     ], [
        'id'     => '36',
        'name'   => 'texte',
        'ext'    => 'txt',
        'icon'   => 'txt-dist.png'
     ], [
        'id'     => '49',
        'name'   => 'RedHat/Mandrake/SuSE',
        'ext'    => 'rpm',
        'icon'   => 'rpm-dist.png'
     ], [
        'id'     => '38',
        'name'   => 'Excel',
        'ext'    => 'xls',
        'icon'   => 'xls-dist.png'
     ], [
        'id'     => '39',
        'name'   => 'XML',
        'ext'    => 'xml',
        'icon'   => 'xml-dist.png'
     ], [
        'id'     => '41',
        'name'   => 'Zip',
        'ext'    => 'zip',
        'icon'   => 'zip-dist.png'
     ], [
        'id'     => '45',
        'name'   => 'Debian',
        'ext'    => 'deb',
        'icon'   => 'deb-dist.png'
     ], [
        'id'     => '47',
        'name'   => 'C header',
        'ext'    => 'h',
        'icon'   => 'h-dist.png'
     ], [
        'id'     => '48',
        'name'   => 'Pascal',
        'ext'    => 'pas',
        'icon'   => 'pas-dist.png'
     ], [
        'id'     => '50',
        'name'   => 'OpenOffice Calc',
        'ext'    => 'sxc',
        'icon'   => 'sxc-dist.png'
     ], [
        'id'     => '51',
        'name'   => 'LaTeX',
        'ext'    => 'tex',
        'icon'   => 'tex-dist.png'
     ], [
        'id'     => '52',
        'name'   => 'GIMP multi-layer',
        'ext'    => 'xcf',
        'icon'   => 'xcf-dist.png'
     ], [
        'id'     => '53',
        'name'   => 'JPEG',
        'ext'    => 'jpeg',
        'icon'   => 'jpg-dist.png'
     ], [
        'id'     => '54',
        'name'   => 'Oasis Open Office Writer',
        'ext'    => 'odt',
        'icon'   => 'odt-dist.png'
     ], [
        'id'     => '55',
        'name'   => 'Oasis Open Office Calc',
        'ext'    => 'ods',
        'icon'   => 'ods-dist.png'
     ], [
        'id'     => '56',
        'name'   => 'Oasis Open Office Impress',
        'ext'    => 'odp',
        'icon'   => 'odp-dist.png'
     ], [
        'id'     => '57',
        'name'   => 'Oasis Open Office Impress Template',
        'ext'    => 'otp',
        'icon'   => 'odp-dist.png'
     ], [
        'id'     => '58',
        'name'   => 'Oasis Open Office Writer Template',
        'ext'    => 'ott',
        'icon'   => 'odt-dist.png'
     ], [
        'id'     => '59',
        'name'   => 'Oasis Open Office Calc Template',
        'ext'    => 'ots',
        'icon'   => 'ods-dist.png'
     ], [
        'id'     => '60',
        'name'   => 'Oasis Open Office Math',
        'ext'    => 'odf',
        'icon'   => 'odf-dist.png'
     ], [
        'id'     => '61',
        'name'   => 'Oasis Open Office Draw',
        'ext'    => 'odg',
        'icon'   => 'odg-dist.png'
     ], [
        'id'     => '62',
        'name'   => 'Oasis Open Office Draw Template',
        'ext'    => 'otg',
        'icon'   => 'odg-dist.png'
     ], [
        'id'     => '63',
        'name'   => 'Oasis Open Office Base',
        'ext'    => 'odb',
        'icon'   => 'odb-dist.png'
     ], [
        'id'     => '64',
        'name'   => 'Oasis Open Office HTML',
        'ext'    => 'oth',
        'icon'   => 'oth-dist.png'
     ], [
        'id'     => '65',
        'name'   => 'Oasis Open Office Writer Master',
        'ext'    => 'odm',
        'icon'   => 'odm-dist.png'
     ], [
        'id'     => '66',
        'name'   => 'Oasis Open Office Chart',
        'ext'    => 'odc',
        'icon'   => ''
     ], [
        'id'     => '67',
        'name'   => 'Oasis Open Office Image',
        'ext'    => 'odi',
        'icon'   => ''
     ], [
        'id'     => '68',
        'name'   => 'Word XML',
        'ext'    => 'docx',
        'icon'   => 'doc-dist.png'
     ], [
        'id'     => '69',
        'name'   => 'Excel XML',
        'ext'    => 'xlsx',
        'icon'   => 'xls-dist.png'
     ], [
        'id'     => '70',
        'name'   => 'PowerPoint XML',
        'ext'    => 'pptx',
        'icon'   => 'ppt-dist.png'
     ], [
        'id'     => '71',
        'name'   => 'Comma-Separated Values',
        'ext'    => 'csv',
        'icon'   => 'csv-dist.png'
     ], [
        'id'     => '72',
        'name'   => 'Scalable Vector Graphics',
        'ext'    => 'svg',
        'icon'   => 'svg-dist.png'
     ]
   ];

   $tables['glpi_entities'] = [
     [
        'id'                                   => 0,
        'name'                                 => __('Root entity'),
        'entities_id'                          => -1,
        'completename'                         => __('Root entity'),
        'comment'                              => null,
        'level'                                => 1,
        'cartridges_alert_repeat'              => 0,
        'consumables_alert_repeat'             => 0,
        'use_licenses_alert'                   => 0,
        'send_licenses_alert_before_delay'     => 0,
        'use_certificates_alert'               => 0,
        'send_certificates_alert_before_delay' => 0,
        'use_contracts_alert'                  => 0,
        'send_contracts_alert_before_delay'    => 0,
        'use_infocoms_alert'                   => 0,
        'send_infocoms_alert_before_delay'     => 0,
        'use_reservations_alert'               => 0,
        'autoclose_delay'                      => -10,
        'notclosed_delay'                      => 0,
        'calendars_id'                         => 0,
        'auto_assign_mode'                     => -10,
        'tickettype'                           => 1,
        'inquest_config'                       => 1,
        'inquest_rate'                         => 0,
        'inquest_delay'                        => 0,
        'autofill_warranty_date'               => 0,
        'autofill_use_date'                    => 0,
        'autofill_buy_date'                    => 0,
        'autofill_delivery_date'               => 0,
        'autofill_order_date'                  => 0,
        'tickettemplates_id'                   => 1,
        'entities_id_software'                 => -10,
        'default_contract_alert'               => 0,
        'default_infocom_alert'                => 0,
        'default_cartridges_alarm_threshold'   => 10,
        'default_consumables_alarm_threshold'  => 10,
        'delay_send_emails'                    => 0,
        'is_notif_enable_default'              => 1,
        'autofill_decommission_date'           => 0,
        'suppliers_as_private'                 => 0,
        'enable_custom_css'                    => 0
     ]
   ];

   $tables['glpi_filesystems'] = [
      ['id' => 1, 'name'  => 'ext'],
      ['id' => 2, 'name'  => 'ext2'],
      ['id' => 3, 'name'  => 'ext3'],
      ['id' => 4, 'name'  => 'ext4'],
      ['id' => 5, 'name'  => 'FAT'],
      ['id' => 6, 'name'  => 'FAT32'],
      ['id' => 7, 'name'  => 'VFAT'],
      ['id' => 8, 'name'  => 'HFS'],
      ['id' => 9, 'name'  => 'HPFS'],
      ['id' => 10, 'name'  => 'HTFS'],
      ['id' => 11, 'name'  => 'JFS'],
      ['id' => 12, 'name'  => 'JFS2'],
      ['id' => 13, 'name'  => 'NFS'],
      ['id' => 14, 'name'  => 'NTFS'],
      ['id' => 15, 'name'  => 'ReiserFS'],
      ['id' => 16, 'name'  => 'SMBFS'],
      ['id' => 17, 'name'  => 'UDF'],
      ['id' => 18, 'name'  => 'UFS'],
      ['id' => 19, 'name'  => 'XFS'],
      ['id' => 20, 'name'  => 'ZFS']
   ];

   $tables['glpi_interfacetypes'] = [
     ['id' => 1, 'name' => 'IDE'],
     ['id' => 2, 'name' => 'SATA'],
     ['id' => 3, 'name' => 'SCSI'],
     ['id' => 4, 'name' => 'USB'],
     ['id' => 5, 'name' => 'AGP'],
     ['id' => 6, 'name' => 'PCI'],
     ['id' => 7, 'name' => 'PCIe'],
     ['id' => 8, 'name' => 'PCI-X']
   ];

   $tables['glpi_notifications'] = [
      [
        'id'           => 1,
        'name'         => 'Alert Tickets not closed',
        'itemtype'     => 'Ticket',
        'event'        => 'alertnotclosed',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 2,
        'name'         => 'New Ticket',
        'itemtype'     => 'Ticket',
        'event'        => 'new',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 3,
        'name'         => 'Update Ticket',
        'itemtype'     => 'Ticket',
        'event'        => 'update',
        'is_recursive' => 1,
        'is_active'    => 0
      ], [
        'id'           => 4,
        'name'         => 'Close Ticket',
        'itemtype'     => 'Ticket',
        'event'        => 'closed',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 5,
        'name'         => 'Add Followup',
        'itemtype'     => 'Ticket',
        'event'        => 'add_followup',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 6,
        'name'         => 'Add Task',
        'itemtype'     => 'Ticket',
        'event'        => 'add_task',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 7,
        'name'         => 'Update Followup',
        'itemtype'     => 'Ticket',
        'event'        => 'update_followup',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 8,
        'name'         => 'Update Task',
        'itemtype'     => 'Ticket',
        'event'        => 'update_task',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 9,
        'name'         => 'Delete Followup',
        'itemtype'     => 'Ticket',
        'event'        => 'delete_followup',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 10,
        'name'         => 'Delete Task',
        'itemtype'     => 'Ticket',
        'event'        => 'delete_task',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 11,
        'name'         => 'Resolve ticket',
        'itemtype'     => 'Ticket',
        'event'        => 'solved',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 12,
        'name'         => 'Ticket Validation',
        'itemtype'     => 'Ticket',
        'event'        => 'validation',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 13,
        'name'         => 'New Reservation',
        'itemtype'     => 'Reservation',
        'event'        => 'new',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 14,
        'name'         => 'Update Reservation',
        'itemtype'     => 'Reservation',
        'event'        => 'update',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 15,
        'name'         => 'Delete Reservation',
        'itemtype'     => 'Reservation',
        'event'        => 'delete',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 16,
        'name'         => 'Alert Reservation',
        'itemtype'     => 'Reservation',
        'event'        => 'alert',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 17,
        'name'         => 'Contract Notice',
        'itemtype'     => 'Contract',
        'event'        => 'notice',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 18,
        'name'         => 'Contract End',
        'itemtype'     => 'Contract',
        'event'        => 'end',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 19,
        'name'         => 'MySQL Synchronization',
        'itemtype'     => 'DBConnection',
        'event'        => 'desynchronization',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 20,
        'name'         => 'Cartridges',
        'itemtype'     => 'CartridgeItem',
        'event'        => 'alert',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 21,
        'name'         => 'Consumables',
        'itemtype'     => 'ConsumableItem',
        'event'        => 'alert',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 22,
        'name'         => 'Infocoms',
        'itemtype'     => 'Infocom',
        'event'        => 'alert',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 23,
        'name'         => 'Software Licenses',
        'itemtype'     => 'SoftwareLicense',
        'event'        => 'alert',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 24,
        'name'         => 'Ticket Recall',
        'itemtype'     => 'Ticket',
        'event'        => 'recall',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 25,
        'name'         => 'Password Forget',
        'itemtype'     => 'User',
        'event'        => 'passwordforget',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 26,
        'name'         => 'Ticket Satisfaction',
        'itemtype'     => 'Ticket',
        'event'        => 'satisfaction',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 27,
        'name'         => 'Item not unique',
        'itemtype'     => 'FieldUnicity',
        'event'        => 'refuse',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 28,
        'name'         => 'Crontask Watcher',
        'itemtype'     => 'CronTask',
        'event'        => 'alert',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 29,
        'name'         => 'New Problem',
        'itemtype'     => 'Problem',
        'event'        => 'new',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 30,
        'name'         => 'Update Problem',
        'itemtype'     => 'Problem',
        'event'        => 'update',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 31,
        'name'         => 'Resolve Problem',
        'itemtype'     => 'Problem',
        'event'        => 'solved',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 32,
        'name'         => 'Add Task',
        'itemtype'     => 'Problem',
        'event'        => 'add_task',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 33,
        'name'         => 'Update Task',
        'itemtype'     => 'Problem',
        'event'        => 'update_task',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 34,
        'name'         => 'Delete Task',
        'itemtype'     => 'Problem',
        'event'        => 'delete_task',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 35,
        'name'         => 'Close Problem',
        'itemtype'     => 'Problem',
        'event'        => 'closed',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 36,
        'name'         => 'Delete Problem',
        'itemtype'     => 'Problem',
        'event'        => 'delete',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 37,
        'name'         => 'Ticket Validation Answer',
        'itemtype'     => 'Ticket',
        'event'        => 'validation_answer',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 38,
        'name'         => 'Contract End Periodicity',
        'itemtype'     => 'Contract',
        'event'        => 'periodicity',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 39,
        'name'         => 'Contract Notice Periodicity',
        'itemtype'     => 'Contract',
        'event'        => 'periodicitynotice',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 40,
        'name'         => 'Planning recall',
        'itemtype'     => 'PlanningRecall',
        'event'        => 'planningrecall',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 41,
        'name'         => 'Delete Ticket',
        'itemtype'     => 'Ticket',
        'event'        => 'delete',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 42,
        'name'         => 'New Change',
        'itemtype'     => 'Change',
        'event'        => 'new',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 43,
        'name'         => 'Update Change',
        'itemtype'     => 'Change',
        'event'        => 'update',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 44,
        'name'         => 'Resolve Change',
        'itemtype'     => 'Change',
        'event'        => 'solved',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 45,
        'name'         => 'Add Task',
        'itemtype'     => 'Change',
        'event'        => 'add_task',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 46,
        'name'         => 'Update Task',
        'itemtype'     => 'Change',
        'event'        => 'update_task',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 47,
        'name'         => 'Delete Task',
        'itemtype'     => 'Change',
        'event'        => 'delete_task',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 48,
        'name'         => 'Close Change',
        'itemtype'     => 'Change',
        'event'        => 'closed',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 49,
        'name'         => 'Delete Change',
        'itemtype'     => 'Change',
        'event'        => 'delete',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 50,
        'name'         => 'Ticket Satisfaction Answer',
        'itemtype'     => 'Ticket',
        'event'        => 'replysatisfaction',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 51,
        'name'         => 'Receiver errors',
        'itemtype'     => 'MailCollector',
        'event'        => 'error',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 52,
        'name'         => 'New Project',
        'itemtype'     => 'Project',
        'event'        => 'new',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 53,
        'name'         => 'Update Project',
        'itemtype'     => 'Project',
        'event'        => 'update',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 54,
        'name'         => 'Delete Project',
        'itemtype'     => 'Project',
        'event'        => 'delete',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 55,
        'name'         => 'New Project Task',
        'itemtype'     => 'ProjectTask',
        'event'        => 'new',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 56,
        'name'         => 'Update Project Task',
        'itemtype'     => 'ProjectTask',
        'event'        => 'update',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 57,
        'name'         => 'Delete Project Task',
        'itemtype'     => 'ProjectTask',
        'event'        => 'delete',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 58,
        'name'         => 'Request Unlock Items',
        'itemtype'     => 'ObjectLock',
        'event'        => 'unlock',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 59,
        'name'         => 'New user in requesters',
        'itemtype'     => 'Ticket',
        'event'        => 'requester_user',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 60,
        'name'         => 'New group in requesters',
        'itemtype'     => 'Ticket',
        'event'        => 'requester_group',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 61,
        'name'         => 'New user in observers',
        'itemtype'     => 'Ticket',
        'event'        => 'observer_user',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 62,
        'name'         => 'New group in observers',
        'itemtype'     => 'Ticket',
        'event'        => 'observer_group',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 63,
        'name'         => 'New user in assignees',
        'itemtype'     => 'Ticket',
        'event'        => 'assign_user',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 64,
        'name'         => 'New group in assignees',
        'itemtype'     => 'Ticket',
        'event'        => 'assign_group',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 65,
        'name'         => 'New supplier in assignees',
        'itemtype'     => 'Ticket',
        'event'        => 'assign_supplier',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 66,
        'name'         => 'Saved searches',
        'itemtype'     => 'SavedSearch_Alert',
        'event'        => 'alert',
        'is_recursive' => 1,
        'is_active'    => 1
      ], [
        'id'           => 67,
        'name'         => 'Certificates',
        'itemtype'     => 'Certificate',
        'event'        => 'alert',
        'is_recursive' => 1,
        'is_active'    => 1
      ]
   ];

   $tables['glpi_notifications_notificationtemplates'] = [
     [
        'id'                       => 1,
        'notifications_id'         => '1',
        'mode'                     => 'mailing',
        'notificationtemplates_id' => 6
     ], [
        'id'                       => 2,
        'notifications_id'         =>  '2',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  4
     ], [
        'id'                       => 3,
        'notifications_id'         =>  '3',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  4
     ], [
        'id'                       => 4,
        'notifications_id'         =>  '4',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  4
     ], [
        'id'                       => 5,
        'notifications_id'         =>  '5',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  4
     ], [
        'id'                       => 6,
        'notifications_id'         =>  '6',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  4
     ], [
        'id'                       => 7,
        'notifications_id'         =>  '7',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  4
     ], [
        'id'                       => 8,
        'notifications_id'         =>  '8',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  4
     ], [
        'id'                       => 9,
        'notifications_id'         =>  '9',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  4
     ], [
        'id'                       => 10,
        'notifications_id'         =>  '10',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  4
     ], [
        'id'                       => 11,
        'notifications_id'         =>  '11',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  4
     ], [
        'id'                       => 12,
        'notifications_id'         =>  '12',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  7
     ], [
        'id'                       => 13,
        'notifications_id'         =>  '13',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  2
     ], [
        'id'                       => 14,
        'notifications_id'         =>  '14',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  2
     ], [
        'id'                       => 15,
        'notifications_id'         =>  '15',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  2
     ], [
        'id'                       => 16,
        'notifications_id'         =>  '16',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  3
     ], [
        'id'                       => 17,
        'notifications_id'         =>  '17',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  12
     ], [
        'id'                       => 18,
        'notifications_id'         =>  '18',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  12
     ], [
        'id'                       => 19,
        'notifications_id'         =>  '19',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  1
     ], [
        'id'                       => 20,
        'notifications_id'         =>  '20',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  8
     ], [
        'id'                       => 21,
        'notifications_id'         =>  '21',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  9
     ], [
        'id'                       => 22,
        'notifications_id'         =>  '22',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  10
     ], [
        'id'                       => 23,
        'notifications_id'         =>  '23',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  11
     ], [
        'id'                       => 24,
        'notifications_id'         =>  '24',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  4
     ], [
        'id'                       => 25,
        'notifications_id'         =>  '25',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  13
     ], [
        'id'                       => 26,
        'notifications_id'         =>  '26',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  14
     ], [
        'id'                       => 27,
        'notifications_id'         =>  '27',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  15
     ], [
        'id'                       => 28,
        'notifications_id'         =>  '28',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  16
     ], [
        'id'                       => 29,
        'notifications_id'         =>  '29',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  17
     ], [
        'id'                       => 30,
        'notifications_id'         =>  '30',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  17
     ], [
        'id'                       => 31,
        'notifications_id'         =>  '31',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  17
     ], [
        'id'                       => 32,
        'notifications_id'         =>  '32',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  17
     ], [
        'id'                       => 33,
        'notifications_id'         =>  '33',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  17
     ], [
        'id'                       => 34,
        'notifications_id'         =>  '34',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  17
     ], [
        'id'                       => 35,
        'notifications_id'         =>  '35',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  17
     ], [
        'id'                       => 36,
        'notifications_id'         =>  '36',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  17
     ], [
        'id'                       => 37,
        'notifications_id'         =>  '37',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  7
     ], [
        'id'                       => 38,
        'notifications_id'         =>  '38',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  12
     ], [
        'id'                       => 39,
        'notifications_id'         =>  '39',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  12
     ], [
        'id'                       => 40,
        'notifications_id'         =>  '40',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  18
     ], [
        'id'                       => 41,
        'notifications_id'         =>  '41',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  4
     ], [
        'id'                       => 42,
        'notifications_id'         =>  '42',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  19
     ], [
        'id'                       => 43,
        'notifications_id'         =>  '43',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  19
     ], [
        'id'                       => 44,
        'notifications_id'         =>  '44',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  19
     ], [
        'id'                       => 45,
        'notifications_id'         =>  '45',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  19
     ], [
        'id'                       => 46,
        'notifications_id'         =>  '46',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  19
     ], [
        'id'                       => 47,
        'notifications_id'         =>  '47',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  19
     ], [
        'id'                       => 48,
        'notifications_id'         =>  '48',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  19
     ], [
        'id'                       => 49,
        'notifications_id'         =>  '49',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  19
     ], [
        'id'                       => 50,
        'notifications_id'         =>  '50',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  14
     ], [
        'id'                       => 51,
        'notifications_id'         =>  '51',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  20
     ], [
        'id'                       => 52,
        'notifications_id'         =>  '52',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  21
     ], [
        'id'                       => 53,
        'notifications_id'         =>  '53',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  21
     ], [
        'id'                       => 54,
        'notifications_id'         =>  '54',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  21
     ], [
        'id'                       => 55,
        'notifications_id'         =>  '55',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  22
     ], [
        'id'                       => 56,
        'notifications_id'         =>  '56',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  22
     ], [
        'id'                       => 57,
        'notifications_id'         =>  '57',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  22
     ], [
        'id'                       => 58,
        'notifications_id'         =>  '58',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  23
     ], [
        'id'                       => 59,
        'notifications_id'         =>  '59',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  4
     ], [
        'id'                       => 60,
        'notifications_id'         =>  '60',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  4
     ], [
        'id'                       => 61,
        'notifications_id'         =>  '61',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  4
     ], [
        'id'                       => 62,
        'notifications_id'         =>  '62',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  4
     ], [
        'id'                       => 63,
        'notifications_id'         =>  '63',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  4
     ], [
        'id'                       => 64,
        'notifications_id'         =>  '64',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  4
     ], [
        'id'                       => 65,
        'notifications_id'         =>  '65',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  4
     ], [
        'id'                       => 66,
        'notifications_id'         =>  '66',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  24
     ], [
        'id'                       => 67,
        'notifications_id'         =>  '67',
        'mode'                     =>  'mailing',
        'notificationtemplates_id' =>  25
     ]
   ];

   $tables['glpi_notificationtargets'] = [
     [
        'id'                 => '1',
        'items_id'           => '3',
        'type'               => '1',
        'notifications_id'   => '13'
     ], [
        'id'                 => '2',
        'items_id'           => '1',
        'type'               => '1',
        'notifications_id'   => '13'
     ], [
        'id'                 => '3',
        'items_id'           => '3',
        'type'               => '2',
        'notifications_id'   => '2'
     ], [
        'id'                 => '4',
        'items_id'           => '1',
        'type'               => '1',
        'notifications_id'   => '2'
     ], [
        'id'                 => '5',
        'items_id'           => '1',
        'type'               => '1',
        'notifications_id'   => '3'
     ], [
        'id'                 => '6',
        'items_id'           => '1',
        'type'               => '1',
        'notifications_id'   => '5'
     ], [
        'id'                 => '7',
        'items_id'           => '1',
        'type'               => '1',
        'notifications_id'   => '4'
     ], [
        'id'                 => '8',
        'items_id'           => '2',
        'type'               => '1',
        'notifications_id'   => '3'
     ], [
        'id'                 => '9',
        'items_id'           => '4',
        'type'               => '1',
        'notifications_id'   => '3'
     ], [
        'id'                 => '10',
        'items_id'           => '3',
        'type'               => '1',
        'notifications_id'   => '2'
     ], [
        'id'                 => '11',
        'items_id'           => '3',
        'type'               => '1',
        'notifications_id'   => '3'
     ], [
        'id'                 => '12',
        'items_id'           => '3',
        'type'               => '1',
        'notifications_id'   => '5'
     ], [
        'id'                 => '13',
        'items_id'           => '3',
        'type'               => '1',
        'notifications_id'   => '4'
     ], [
        'id'                 => '14',
        'items_id'           => '1',
        'type'               => '1',
        'notifications_id'   => '19'
     ], [
        'id'                 => '15',
        'items_id'           => '14',
        'type'               => '1',
        'notifications_id'   => '12'
     ], [
        'id'                 => '16',
        'items_id'           => '3',
        'type'               => '1',
        'notifications_id'   => '14'
     ], [
        'id'                 => '17',
        'items_id'           => '1',
        'type'               => '1',
        'notifications_id'   => '14'
     ], [
        'id'                 => '18',
        'items_id'           => '3',
        'type'               => '1',
        'notifications_id'   => '15'
     ], [
        'id'                 => '19',
        'items_id'           => '1',
        'type'               => '1',
        'notifications_id'   => '15'
     ], [
        'id'                 => '20',
        'items_id'           => '1',
        'type'               => '1',
        'notifications_id'   => '6'
     ], [
        'id'                 => '21',
        'items_id'           => '3',
        'type'               => '1',
        'notifications_id'   => '6'
     ], [
        'id'                 => '22',
        'items_id'           => '1',
        'type'               => '1',
        'notifications_id'   => '7'
     ], [
        'id'                 => '23',
        'items_id'           => '3',
        'type'               => '1',
        'notifications_id'   => '7'
     ], [
        'id'                 => '24',
        'items_id'           => '1',
        'type'               => '1',
        'notifications_id'   => '8'
     ], [
        'id'                 => '25',
        'items_id'           => '3',
        'type'               => '1',
        'notifications_id'   => '8'
     ], [
        'id'                 => '26',
        'items_id'           => '1',
        'type'               => '1',
        'notifications_id'   => '9'
     ], [
        'id'                 => '27',
        'items_id'           => '3',
        'type'               => '1',
        'notifications_id'   => '9'
     ], [
        'id'                 => '28',
        'items_id'           => '1',
        'type'               => '1',
        'notifications_id'   => '10'
     ], [
        'id'                 => '29',
        'items_id'           => '3',
        'type'               => '1',
        'notifications_id'   => '10'
     ], [
        'id'                 => '30',
        'items_id'           => '1',
        'type'               => '1',
        'notifications_id'   => '11'
     ], [
        'id'                 => '31',
        'items_id'           => '3',
        'type'               => '1',
        'notifications_id'   => '11'
     ], [
        'id'                 => '32',
        'items_id'           => '19',
        'type'               => '1',
        'notifications_id'   => '25'
     ], [
        'id'                 => '33',
        'items_id'           => '3',
        'type'               => '1',
        'notifications_id'   => '26'
     ], [
        'id'                 => '34',
        'items_id'           => '21',
        'type'               => '1',
        'notifications_id'   => '2'
     ], [
        'id'                 => '35',
        'items_id'           => '21',
        'type'               => '1',
        'notifications_id'   => '3'
     ], [
        'id'                 => '36',
        'items_id'           => '21',
        'type'               => '1',
        'notifications_id'   => '5'
     ], [
        'id'                 => '37',
        'items_id'           => '21',
        'type'               => '1',
        'notifications_id'   => '4'
     ], [
        'id'                 => '38',
        'items_id'           => '21',
        'type'               => '1',
        'notifications_id'   => '6'
     ], [
        'id'                 => '39',
        'items_id'           => '21',
        'type'               => '1',
        'notifications_id'   => '7'
     ], [
        'id'                 => '40',
        'items_id'           => '21',
        'type'               => '1',
        'notifications_id'   => '8'
     ], [
        'id'                 => '41',
        'items_id'           => '21',
        'type'               => '1',
        'notifications_id'   => '9'
     ], [
        'id'                 => '42',
        'items_id'           => '21',
        'type'               => '1',
        'notifications_id'   => '10'
     ], [
        'id'                 => '43',
        'items_id'           => '21',
        'type'               => '1',
        'notifications_id'   => '11'
     ], [
        'id'                 => '75',
        'items_id'           => '1',
        'type'               => '1',
        'notifications_id'   => '41'
     ], [
        'id'                 => '46',
        'items_id'           => '1',
        'type'               => '1',
        'notifications_id'   => '28'
     ], [
        'id'                 => '47',
        'items_id'           => '3',
        'type'               => '1',
        'notifications_id'   => '29'
     ], [
        'id'                 => '48',
        'items_id'           => '1',
        'type'               => '1',
        'notifications_id'   => '29'
     ], [
        'id'                 => '49',
        'items_id'           => '21',
        'type'               => '1',
        'notifications_id'   => '29'
     ], [
        'id'                 => '50',
        'items_id'           => '2',
        'type'               => '1',
        'notifications_id'   => '30'
     ], [
        'id'                 => '51',
        'items_id'           => '4',
        'type'               => '1',
        'notifications_id'   => '30'
     ], [
        'id'                 => '52',
        'items_id'           => '3',
        'type'               => '1',
        'notifications_id'   => '30'
     ], [
        'id'                 => '53',
        'items_id'           => '1',
        'type'               => '1',
        'notifications_id'   => '30'
     ], [
        'id'                 => '54',
        'items_id'           => '21',
        'type'               => '1',
        'notifications_id'   => '30'
     ], [
        'id'                 => '55',
        'items_id'           => '3',
        'type'               => '1',
        'notifications_id'   => '31'
     ], [
        'id'                 => '56',
        'items_id'           => '1',
        'type'               => '1',
        'notifications_id'   => '31'
     ], [
        'id'                 => '57',
        'items_id'           => '21',
        'type'               => '1',
        'notifications_id'   => '31'
     ], [
        'id'                 => '58',
        'items_id'           => '3',
        'type'               => '1',
        'notifications_id'   => '32'
     ], [
        'id'                 => '59',
        'items_id'           => '1',
        'type'               => '1',
        'notifications_id'   => '32'
     ], [
        'id'                 => '60',
        'items_id'           => '21',
        'type'               => '1',
        'notifications_id'   => '32'
     ], [
        'id'                 => '61',
        'items_id'           => '3',
        'type'               => '1',
        'notifications_id'   => '33'
     ], [
        'id'                 => '62',
        'items_id'           => '1',
        'type'               => '1',
        'notifications_id'   => '33'
     ], [
        'id'                 => '63',
        'items_id'           => '21',
        'type'               => '1',
        'notifications_id'   => '33'
     ], [
        'id'                 => '64',
        'items_id'           => '3',
        'type'               => '1',
        'notifications_id'   => '34'
     ], [
        'id'                 => '65',
        'items_id'           => '1',
        'type'               => '1',
        'notifications_id'   => '34'
     ], [
        'id'                 => '66',
        'items_id'           => '21',
        'type'               => '1',
        'notifications_id'   => '34'
     ], [
        'id'                 => '67',
        'items_id'           => '3',
        'type'               => '1',
        'notifications_id'   => '35'
     ], [
        'id'                 => '68',
        'items_id'           => '1',
        'type'               => '1',
        'notifications_id'   => '35'
     ], [
        'id'                 => '69',
        'items_id'           => '21',
        'type'               => '1',
        'notifications_id'   => '35'
     ], [
        'id'                 => '70',
        'items_id'           => '3',
        'type'               => '1',
        'notifications_id'   => '36'
     ], [
        'id'                 => '71',
        'items_id'           => '1',
        'type'               => '1',
        'notifications_id'   => '36'
     ], [
        'id'                 => '72',
        'items_id'           => '21',
        'type'               => '1',
        'notifications_id'   => '36'
     ], [
        'id'                 => '73',
        'items_id'           => '14',
        'type'               => '1',
        'notifications_id'   => '37'
     ], [
        'id'                 => '74',
        'items_id'           => '3',
        'type'               => '1',
        'notifications_id'   => '40'
     ], [
        'id'                 => '76',
        'items_id'           => '3',
        'type'               => '1',
        'notifications_id'   => '42'
     ], [
        'id'                 => '77',
        'items_id'           => '1',
        'type'               => '1',
        'notifications_id'   => '42'
     ], [
        'id'                 => '78',
        'items_id'           => '21',
        'type'               => '1',
        'notifications_id'   => '42'
     ], [
        'id'                 => '79',
        'items_id'           => '2',
        'type'               => '1',
        'notifications_id'   => '43'
     ], [
        'id'                 => '80',
        'items_id'           => '4',
        'type'               => '1',
        'notifications_id'   => '43'
     ], [
        'id'                 => '81',
        'items_id'           => '3',
        'type'               => '1',
        'notifications_id'   => '43'
     ], [
        'id'                 => '82',
        'items_id'           => '1',
        'type'               => '1',
        'notifications_id'   => '43'
     ], [
        'id'                 => '83',
        'items_id'           => '21',
        'type'               => '1',
        'notifications_id'   => '43'
     ], [
        'id'                 => '84',
        'items_id'           => '3',
        'type'               => '1',
        'notifications_id'   => '44'
     ], [
        'id'                 => '85',
        'items_id'           => '1',
        'type'               => '1',
        'notifications_id'   => '44'
     ], [
        'id'                 => '86',
        'items_id'           => '21',
        'type'               => '1',
        'notifications_id'   => '44'
     ], [
        'id'                 => '87',
        'items_id'           => '3',
        'type'               => '1',
        'notifications_id'   => '45'
     ], [
        'id'                 => '88',
        'items_id'           => '1',
        'type'               => '1',
        'notifications_id'   => '45'
     ], [
        'id'                 => '89',
        'items_id'           => '21',
        'type'               => '1',
        'notifications_id'   => '45'
     ], [
        'id'                 => '90',
        'items_id'           => '3',
        'type'               => '1',
        'notifications_id'   => '46'
     ], [
        'id'                 => '91',
        'items_id'           => '1',
        'type'               => '1',
        'notifications_id'   => '46'
     ], [
        'id'                 => '92',
        'items_id'           => '21',
        'type'               => '1',
        'notifications_id'   => '46'
     ], [
        'id'                 => '93',
        'items_id'           => '3',
        'type'               => '1',
        'notifications_id'   => '47'
     ], [
        'id'                 => '94',
        'items_id'           => '1',
        'type'               => '1',
        'notifications_id'   => '47'
     ], [
        'id'                 => '95',
        'items_id'           => '21',
        'type'               => '1',
        'notifications_id'   => '47'
     ], [
        'id'                 => '96',
        'items_id'           => '3',
        'type'               => '1',
        'notifications_id'   => '48'
     ], [
        'id'                 => '97',
        'items_id'           => '1',
        'type'               => '1',
        'notifications_id'   => '48'
     ], [
        'id'                 => '98',
        'items_id'           => '21',
        'type'               => '1',
        'notifications_id'   => '48'
     ], [
        'id'                 => '99',
        'items_id'           => '3',
        'type'               => '1',
        'notifications_id'   => '49'
     ], [
        'id'                 => '100',
        'items_id'           => '1',
        'type'               => '1',
        'notifications_id'   => '49'
     ], [
        'id'                 => '101',
        'items_id'           => '21',
        'type'               => '1',
        'notifications_id'   => '49'
     ], [
        'id'                 => '102',
        'items_id'           => '3',
        'type'               => '1',
        'notifications_id'   => '50'
     ], [
        'id'                 => '103',
        'items_id'           => '2',
        'type'               => '1',
        'notifications_id'   => '50'
     ], [
        'id'                 => '104',
        'items_id'           => '1',
        'type'               => '1',
        'notifications_id'   => '51'
     ], [
        'id'                 => '105',
        'items_id'           => '27',
        'type'               => '1',
        'notifications_id'   => '52'
     ], [
        'id'                 => '106',
        'items_id'           => '1',
        'type'               => '1',
        'notifications_id'   => '52'
     ], [
        'id'                 => '107',
        'items_id'           => '28',
        'type'               => '1',
        'notifications_id'   => '52'
     ], [
        'id'                 => '108',
        'items_id'           => '27',
        'type'               => '1',
        'notifications_id'   => '53'
     ], [
        'id'                 => '109',
        'items_id'           => '1',
        'type'               => '1',
        'notifications_id'   => '53'
     ], [
        'id'                 => '110',
        'items_id'           => '28',
        'type'               => '1',
        'notifications_id'   => '53'
     ], [
        'id'                 => '111',
        'items_id'           => '27',
        'type'               => '1',
        'notifications_id'   => '54'
     ], [
        'id'                 => '112',
        'items_id'           => '1',
        'type'               => '1',
        'notifications_id'   => '54'
     ], [
        'id'                 => '113',
        'items_id'           => '28',
        'type'               => '1',
        'notifications_id'   => '54'
     ], [
        'id'                 => '114',
        'items_id'           => '31',
        'type'               => '1',
        'notifications_id'   => '55'
     ], [
        'id'                 => '115',
        'items_id'           => '1',
        'type'               => '1',
        'notifications_id'   => '55'
     ], [
        'id'                 => '116',
        'items_id'           => '32',
        'type'               => '1',
        'notifications_id'   => '55'
     ], [
        'id'                 => '117',
        'items_id'           => '31',
        'type'               => '1',
        'notifications_id'   => '56'
     ], [
        'id'                 => '118',
        'items_id'           => '1',
        'type'               => '1',
        'notifications_id'   => '56'
     ], [
        'id'                 => '119',
        'items_id'           => '32',
        'type'               => '1',
        'notifications_id'   => '56'
     ], [
        'id'                 => '120',
        'items_id'           => '31',
        'type'               => '1',
        'notifications_id'   => '57'
     ], [
        'id'                 => '121',
        'items_id'           => '1',
        'type'               => '1',
        'notifications_id'   => '57'
     ], [
        'id'                 => '122',
        'items_id'           => '32',
        'type'               => '1',
        'notifications_id'   => '57'
     ], [
        'id'                 => '123',
        'items_id'           => '19',
        'type'               => '1',
        'notifications_id'   => '58'
     ], [
        'id'                 => '124',
        'items_id'           => '3',
        'type'               => '1',
        'notifications_id'   => '59'
     ], [
        'id'                 => '125',
        'items_id'           => '13',
        'type'               => '1',
        'notifications_id'   => '60'
     ], [
        'id'                 => '126',
        'items_id'           => '21',
        'type'               => '1',
        'notifications_id'   => '61'
     ], [
        'id'                 => '127',
        'items_id'           => '20',
        'type'               => '1',
        'notifications_id'   => '62'
     ], [
        'id'                 => '128',
        'items_id'           => '2',
        'type'               => '1',
        'notifications_id'   => '63'
     ], [
        'id'                 => '129',
        'items_id'           => '23',
        'type'               => '1',
        'notifications_id'   => '64'
     ], [
        'id'                 => '130',
        'items_id'           => '8',
        'type'               => '1',
        'notifications_id'   => '65'
     ], [
        'id'                 => '131',
        'items_id'           => '19',
        'type'               => '1',
        'notifications_id'   => '66'
     ]
   ];

   $tables['glpi_notificationtemplates'] = [
     [
        'id'        => '1',
        'name'      => 'MySQL Synchronization',
        'itemtype'  => 'DBConnection'
     ], [
        'id'        => '2',
        'name'      => 'Reservations',
        'itemtype'  => 'Reservation'
     ], [
        'id'        => '3',
        'name'      => 'Alert Reservation',
        'itemtype'  => 'Reservation'
     ], [
        'id'        => '4',
        'name'      => 'Tickets',
        'itemtype'  => 'Ticket'
     ], [
        'id'        => '5',
        'name'      => 'Tickets (Simple)',
        'itemtype'  => 'Ticket'
     ], [
        'id'        => '6',
        'name'      => 'Alert Tickets not closed',
        'itemtype'  => 'Ticket'
     ], [
        'id'        => '7',
        'name'      => 'Tickets Validation',
        'itemtype'  => 'Ticket'
     ], [
        'id'        => '8',
        'name'      => 'Cartridges',
        'itemtype'  => 'CartridgeItem'
     ], [
        'id'        => '9',
        'name'      => 'Consumables',
        'itemtype'  => 'ConsumableItem'
     ], [
        'id'        => '10',
        'name'      => 'Infocoms',
        'itemtype'  => 'Infocom'
     ], [
        'id'        => '11',
        'name'      => 'Licenses',
        'itemtype'  => 'SoftwareLicense'
     ], [
        'id'        => '12',
        'name'      => 'Contracts',
        'itemtype'  => 'Contract'
     ], [
        'id'        => '13',
        'name'      => 'Password Forget',
        'itemtype'  => 'User'
     ], [
        'id'        => '14',
        'name'      => 'Ticket Satisfaction',
        'itemtype'  => 'Ticket'
     ], [
        'id'        => '15',
        'name'      => 'Item not unique',
        'itemtype'  => 'FieldUnicity'
     ], [
        'id'        => '16',
        'name'      => 'CronTask',
        'itemtype'  => 'CronTask'
     ], [
        'id'        => '17',
        'name'      => 'Problems',
        'itemtype'  => 'Problem'
     ], [
        'id'        => '18',
        'name'      => 'Planning recall',
        'itemtype'  => 'PlanningRecall'
     ], [
        'id'        => '19',
        'name'      => 'Changes',
        'itemtype'  => 'Change'
     ], [
        'id'        => '20',
        'name'      => 'Receiver errors',
        'itemtype'  => 'MailCollector'
     ], [
        'id'        => '21',
        'name'      => 'Projects',
        'itemtype'  => 'Project'
     ], [
        'id'        => '22',
        'name'      => 'Project Tasks',
        'itemtype'  => 'ProjectTask'
     ], [
        'id'        => '23',
        'name'      => 'Unlock Item request',
        'itemtype'  => 'ObjectLock'
     ], [
        'id'        => '24',
        'name'      => 'Saved searches alerts',
        'itemtype'  => 'SavedSearch_Alert'
     ], [
        'id'        => '25',
        'name'      => 'Certificates',
        'itemtype'  => 'Certificate'
     ]
   ];

   $tables['glpi_notificationtemplatetranslations'] = [
   [
      'id'                       => '1',
      'notificationtemplates_id' => '1',
      'language'                 => '',
      'subject'                  => '##lang.dbconnection.title##',
      'content_text'             => '##lang.dbconnection.delay## : ##dbconnection.delay##',
      'content_html'             => '&lt;p&gt;##lang.dbconnection.delay## : ##dbconnection.delay##&lt;/p&gt;'
   ], [
      'id'                       => '2',
      'notificationtemplates_id' => '2',
      'language'                 => '',
      'subject'                  => '##reservation.action##',
      'content_text'             => '======================================================================
   ##lang.reservation.user##: ##reservation.user##
   ##lang.reservation.item.name##: ##reservation.itemtype## - ##reservation.item.name##
   ##IFreservation.tech## ##lang.reservation.tech## ##reservation.tech## ##ENDIFreservation.tech##
   ##lang.reservation.begin##: ##reservation.begin##
   ##lang.reservation.end##: ##reservation.end##
   ##lang.reservation.comment##: ##reservation.comment##
   ======================================================================',
         'content_html'             => '&lt;!-- description{ color: inherit; background: #ebebeb;border-style: solid;border-color: #8d8d8d; border-width: 0px 1px 1px 0px; } --&gt;
   &lt;p&gt;&lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt;##lang.reservation.user##:&lt;/span&gt;##reservation.user##&lt;br /&gt; &lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt;##lang.reservation.item.name##:&lt;/span&gt;##reservation.itemtype## - ##reservation.item.name##&lt;br /&gt;##IFreservation.tech## ##lang.reservation.tech## ##reservation.tech####ENDIFreservation.tech##&lt;br /&gt; &lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt;##lang.reservation.begin##:&lt;/span&gt; ##reservation.begin##&lt;br /&gt; &lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt;##lang.reservation.end##:&lt;/span&gt;##reservation.end##&lt;br /&gt; &lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt;##lang.reservation.comment##:&lt;/span&gt; ##reservation.comment##&lt;/p&gt;'
      ], [
         'id'                       => '3',
         'notificationtemplates_id' => '3',
         'language'                 => '',
         'subject'                  => '##reservation.action##  ##reservation.entity##',
         'content_text'             => '##lang.reservation.entity## : ##reservation.entity##
   ##FOREACHreservations##
   ##lang.reservation.itemtype## : ##reservation.itemtype##
    ##lang.reservation.item## : ##reservation.item##
    ##reservation.url##
    ##ENDFOREACHreservations##',
         'content_html'             => '&lt;p&gt;##lang.reservation.entity## : ##reservation.entity## &lt;br /&gt; &lt;br /&gt;
   ##FOREACHreservations## &lt;br /&gt;##lang.reservation.itemtype## :  ##reservation.itemtype##&lt;br /&gt;
    ##lang.reservation.item## :  ##reservation.item##&lt;br /&gt; &lt;br /&gt;
    &lt;a href="##reservation.url##"&gt; ##reservation.url##&lt;/a&gt;&lt;br /&gt;
    ##ENDFOREACHreservations##&lt;/p&gt;'
      ], [
         'id'                       => '4',
         'notificationtemplates_id' => '4',
         'language'                 => '',
         'subject'                  => '##ticket.action## ##ticket.title##',
         'content_text'             => ' ##IFticket.storestatus=5##
    ##lang.ticket.url## : ##ticket.urlapprove##
    ##lang.ticket.autoclosewarning##
    ##lang.ticket.solvedate## : ##ticket.solvedate##
    ##lang.ticket.solution.type## : ##ticket.solution.type##
    ##lang.ticket.solution.description## : ##ticket.solution.description## ##ENDIFticket.storestatus##
    ##ELSEticket.storestatus## ##lang.ticket.url## : ##ticket.url## ##ENDELSEticket.storestatus##
    ##lang.ticket.description##
    ##lang.ticket.title## : ##ticket.title##
    ##lang.ticket.authors## : ##IFticket.authors## ##ticket.authors## ##ENDIFticket.authors## ##ELSEticket.authors##--##ENDELSEticket.authors##
    ##lang.ticket.creationdate## : ##ticket.creationdate##
    ##lang.ticket.closedate## : ##ticket.closedate##
    ##lang.ticket.requesttype## : ##ticket.requesttype##
   ##lang.ticket.item.name## :
   ##FOREACHitems##
    ##IFticket.itemtype##
     ##ticket.itemtype## - ##ticket.item.name##
     ##IFticket.item.model## ##lang.ticket.item.model## : ##ticket.item.model## ##ENDIFticket.item.model##
     ##IFticket.item.serial## ##lang.ticket.item.serial## : ##ticket.item.serial## ##ENDIFticket.item.serial##
     ##IFticket.item.otherserial## ##lang.ticket.item.otherserial## : ##ticket.item.otherserial## ##ENDIFticket.item.otherserial##
    ##ENDIFticket.itemtype##
   ##ENDFOREACHitems##
   ##IFticket.assigntousers## ##lang.ticket.assigntousers## : ##ticket.assigntousers## ##ENDIFticket.assigntousers##
    ##lang.ticket.status## : ##ticket.status##
   ##IFticket.assigntogroups## ##lang.ticket.assigntogroups## : ##ticket.assigntogroups## ##ENDIFticket.assigntogroups##
    ##lang.ticket.urgency## : ##ticket.urgency##
    ##lang.ticket.impact## : ##ticket.impact##
    ##lang.ticket.priority## : ##ticket.priority##
   ##IFticket.user.email## ##lang.ticket.user.email## : ##ticket.user.email ##ENDIFticket.user.email##
   ##IFticket.category## ##lang.ticket.category## : ##ticket.category## ##ENDIFticket.category## ##ELSEticket.category## ##lang.ticket.nocategoryassigned## ##ENDELSEticket.category##
    ##lang.ticket.content## : ##ticket.content##
    ##IFticket.storestatus=6##
    ##lang.ticket.solvedate## : ##ticket.solvedate##
    ##lang.ticket.solution.type## : ##ticket.solution.type##
    ##lang.ticket.solution.description## : ##ticket.solution.description##
    ##ENDIFticket.storestatus##
    ##lang.ticket.numberoffollowups## : ##ticket.numberoffollowups##
   ##FOREACHfollowups##
    [##followup.date##] ##lang.followup.isprivate## : ##followup.isprivate##
    ##lang.followup.author## ##followup.author##
    ##lang.followup.description## ##followup.description##
    ##lang.followup.date## ##followup.date##
    ##lang.followup.requesttype## ##followup.requesttype##
   ##ENDFOREACHfollowups##
    ##lang.ticket.numberoftasks## : ##ticket.numberoftasks##
   ##FOREACHtasks##
    [##task.date##] ##lang.task.isprivate## : ##task.isprivate##
    ##lang.task.author## ##task.author##
    ##lang.task.description## ##task.description##
    ##lang.task.time## ##task.time##
    ##lang.task.category## ##task.category##
   ##ENDFOREACHtasks##',
         'content_html'                => '<!-- description{ color: inherit; background: #ebebeb; border-style: solid;border-color: #8d8d8d; border-width: 0px 1px 1px 0px; }    -->
   <div>##IFticket.storestatus=5##</div>
   <div>##lang.ticket.url## : <a href="##ticket.urlapprove##">##ticket.urlapprove##</a> <strong>&#160;</strong></div>
   <div><strong>##lang.ticket.autoclosewarning##</strong></div>
   <div><span style="color: #888888;"><strong><span style="text-decoration: underline;">##lang.ticket.solvedate##</span></strong></span> : ##ticket.solvedate##<br /><span style="text-decoration: underline; color: #888888;"><strong>##lang.ticket.solution.type##</strong></span> : ##ticket.solution.type##<br /><span style="text-decoration: underline; color: #888888;"><strong>##lang.ticket.solution.description##</strong></span> : ##ticket.solution.description## ##ENDIFticket.storestatus##</div>
   <div>##ELSEticket.storestatus## ##lang.ticket.url## : <a href="##ticket.url##">##ticket.url##</a> ##ENDELSEticket.storestatus##</div>
   <p class="description b"><strong>##lang.ticket.description##</strong></p>
   <p><span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"> ##lang.ticket.title##</span>&#160;:##ticket.title## <br /> <span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"> ##lang.ticket.authors##</span>&#160;:##IFticket.authors## ##ticket.authors## ##ENDIFticket.authors##    ##ELSEticket.authors##--##ENDELSEticket.authors## <br /> <span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"> ##lang.ticket.creationdate##</span>&#160;:##ticket.creationdate## <br /> <span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"> ##lang.ticket.closedate##</span>&#160;:##ticket.closedate## <br /> <span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"> ##lang.ticket.requesttype##</span>&#160;:##ticket.requesttype##<br />
   <br /><span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"> ##lang.ticket.item.name##</span>&#160;:
   <p>##FOREACHitems##</p>
   <div class="description b">##IFticket.itemtype## ##ticket.itemtype##&#160;- ##ticket.item.name## ##IFticket.item.model## ##lang.ticket.item.model## : ##ticket.item.model## ##ENDIFticket.item.model## ##IFticket.item.serial## ##lang.ticket.item.serial## : ##ticket.item.serial## ##ENDIFticket.item.serial## ##IFticket.item.otherserial## ##lang.ticket.item.otherserial## : ##ticket.item.otherserial## ##ENDIFticket.item.otherserial## ##ENDIFticket.itemtype## </div><br />
   <p>##ENDFOREACHitems##</p>
   ##IFticket.assigntousers## <span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"> ##lang.ticket.assigntousers##</span>&#160;: ##ticket.assigntousers## ##ENDIFticket.assigntousers##<br /> <span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;">##lang.ticket.status## </span>&#160;: ##ticket.status##<br /> ##IFticket.assigntogroups## <span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"> ##lang.ticket.assigntogroups##</span>&#160;: ##ticket.assigntogroups## ##ENDIFticket.assigntogroups##<br /> <span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"> ##lang.ticket.urgency##</span>&#160;: ##ticket.urgency##<br /> <span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"> ##lang.ticket.impact##</span>&#160;: ##ticket.impact##<br /> <span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"> ##lang.ticket.priority##</span>&#160;: ##ticket.priority## <br /> ##IFticket.user.email##<span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"> ##lang.ticket.user.email##</span>&#160;: ##ticket.user.email ##ENDIFticket.user.email##    <br /> ##IFticket.category##<span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;">##lang.ticket.category## </span>&#160;:##ticket.category## ##ENDIFticket.category## ##ELSEticket.category## ##lang.ticket.nocategoryassigned## ##ENDELSEticket.category##    <br /> <span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"> ##lang.ticket.content##</span>&#160;: ##ticket.content##</p>
   <br />##IFticket.storestatus=6##<br /><span style="text-decoration: underline;"><strong><span style="color: #888888;">##lang.ticket.solvedate##</span></strong></span> : ##ticket.solvedate##<br /><span style="color: #888888;"><strong><span style="text-decoration: underline;">##lang.ticket.solution.type##</span></strong></span> : ##ticket.solution.type##<br /><span style="text-decoration: underline; color: #888888;"><strong>##lang.ticket.solution.description##</strong></span> : ##ticket.solution.description##<br />##ENDIFticket.storestatus##</p>
   <div class="description b">##lang.ticket.numberoffollowups##&#160;: ##ticket.numberoffollowups##</div>
   <p>##FOREACHfollowups##</p>
   <div class="description b"><br /> <strong> [##followup.date##] <em>##lang.followup.isprivate## : ##followup.isprivate## </em></strong><br /> <span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"> ##lang.followup.author## </span> ##followup.author##<br /> <span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"> ##lang.followup.description## </span> ##followup.description##<br /> <span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"> ##lang.followup.date## </span> ##followup.date##<br /> <span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"> ##lang.followup.requesttype## </span> ##followup.requesttype##</div>
   <p>##ENDFOREACHfollowups##</p>
   <div class="description b">##lang.ticket.numberoftasks##&#160;: ##ticket.numberoftasks##</div>
   <p>##FOREACHtasks##</p>
   <div class="description b"><br /> <strong> [##task.date##] <em>##lang.task.isprivate## : ##task.isprivate## </em></strong><br /> <span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"> ##lang.task.author##</span> ##task.author##<br /> <span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"> ##lang.task.description##</span> ##task.description##<br /> <span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"> ##lang.task.time##</span> ##task.time##<br /> <span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"> ##lang.task.category##</span> ##task.category##</div>
   <p>##ENDFOREACHtasks##</p>'
      ], [
         'id'                       => '5',
         'notificationtemplates_id' => '12',
         'language'                 => '',
         'subject'                  => '##contract.action##  ##contract.entity##',
         'content_text'             => '##lang.contract.entity## : ##contract.entity##
   ##FOREACHcontracts##
   ##lang.contract.name## : ##contract.name##
   ##lang.contract.number## : ##contract.number##
   ##lang.contract.time## : ##contract.time##
   ##IFcontract.type####lang.contract.type## : ##contract.type####ENDIFcontract.type##
   ##contract.url##
   ##ENDFOREACHcontracts##',
         'content_html'             => '&lt;p&gt;##lang.contract.entity## : ##contract.entity##&lt;br /&gt;
   &lt;br /&gt;##FOREACHcontracts##&lt;br /&gt;##lang.contract.name## :
   ##contract.name##&lt;br /&gt;
   ##lang.contract.number## : ##contract.number##&lt;br /&gt;
   ##lang.contract.time## : ##contract.time##&lt;br /&gt;
   ##IFcontract.type####lang.contract.type## : ##contract.type##
   ##ENDIFcontract.type##&lt;br /&gt;
   &lt;a href="##contract.url##"&gt;
   ##contract.url##&lt;/a&gt;&lt;br /&gt;
   ##ENDFOREACHcontracts##&lt;/p&gt;'
      ], [
         'id'                       => '6',
         'notificationtemplates_id' => '5',
         'language'                 => '',
         'subject'                  => '##ticket.action## ##ticket.title##',
         'content_text'             => '##lang.ticket.url## : ##ticket.url##
   ##lang.ticket.description##
   ##lang.ticket.title##  :##ticket.title##
   ##lang.ticket.authors##  :##IFticket.authors##
   ##ticket.authors## ##ENDIFticket.authors##
   ##ELSEticket.authors##--##ENDELSEticket.authors##
   ##IFticket.category## ##lang.ticket.category##  :##ticket.category##
   ##ENDIFticket.category## ##ELSEticket.category##
   ##lang.ticket.nocategoryassigned## ##ENDELSEticket.category##
   ##lang.ticket.content##  : ##ticket.content##
   ##IFticket.itemtype##
   ##lang.ticket.item.name##  : ##ticket.itemtype## - ##ticket.item.name##
   ##ENDIFticket.itemtype##',
          'content_html'               => '&lt;div&gt;##lang.ticket.url## : &lt;a href="##ticket.url##"&gt;
   ##ticket.url##&lt;/a&gt;&lt;/div&gt;
   &lt;div class="description b"&gt;
   ##lang.ticket.description##&lt;/div&gt;
   &lt;p&gt;&lt;span
   style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt;
   ##lang.ticket.title##&lt;/span&gt;&#160;:##ticket.title##
   &lt;br /&gt; &lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt;
   ##lang.ticket.authors##&lt;/span&gt;
   ##IFticket.authors## ##ticket.authors##
   ##ENDIFticket.authors##
   ##ELSEticket.authors##--##ENDELSEticket.authors##
   &lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt;&#160
   ;&lt;/span&gt;&lt;br /&gt; &lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt; &lt;/span&gt;
   ##IFticket.category##&lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt;
   ##lang.ticket.category## &lt;/span&gt;&#160;:##ticket.category##
   ##ENDIFticket.category## ##ELSEticket.category##
   ##lang.ticket.nocategoryassigned## ##ENDELSEticket.category##
   &lt;br /&gt; &lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt;
   ##lang.ticket.content##&lt;/span&gt;&#160;:
   ##ticket.content##&lt;br /&gt;##IFticket.itemtype##
   &lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt;
   ##lang.ticket.item.name##&lt;/span&gt;&#160;:
   ##ticket.itemtype## - ##ticket.item.name##
   ##ENDIFticket.itemtype##&lt;/p&gt;'
      ], [
         'id'                       => '15',
         'notificationtemplates_id' => '15',
         'language'                 => '',
         'subject'                  => '##lang.unicity.action##',
         'content_text'             => '##lang.unicity.entity## : ##unicity.entity##
   ##lang.unicity.itemtype## : ##unicity.itemtype##
   ##lang.unicity.message## : ##unicity.message##
   ##lang.unicity.action_user## : ##unicity.action_user##
   ##lang.unicity.action_type## : ##unicity.action_type##
   ##lang.unicity.date## : ##unicity.date##',
         'content_html'             => '&lt;p&gt;##lang.unicity.entity## : ##unicity.entity##&lt;/p&gt;
   &lt;p&gt;##lang.unicity.itemtype## : ##unicity.itemtype##&lt;/p&gt;
   &lt;p&gt;##lang.unicity.message## : ##unicity.message##&lt;/p&gt;
   &lt;p&gt;##lang.unicity.action_user## : ##unicity.action_user##&lt;/p&gt;
   &lt;p&gt;##lang.unicity.action_type## : ##unicity.action_type##&lt;/p&gt;
   &lt;p&gt;##lang.unicity.date## : ##unicity.date##&lt;/p&gt;'
      ], [
         'id'                       => '7',
         'notificationtemplates_id' => '7',
         'language'                 => '',
         'subject'                  => '##ticket.action## ##ticket.title##',
         'content_text'             => '##FOREACHvalidations##
   ##IFvalidation.storestatus=2##
   ##validation.submission.title##
   ##lang.validation.commentsubmission## : ##validation.commentsubmission##
   ##ENDIFvalidation.storestatus##
   ##ELSEvalidation.storestatus## ##validation.answer.title## ##ENDELSEvalidation.storestatus##
   ##lang.ticket.url## : ##ticket.urlvalidation##
   ##IFvalidation.status## ##lang.validation.status## : ##validation.status## ##ENDIFvalidation.status##
   ##IFvalidation.commentvalidation##
   ##lang.validation.commentvalidation## : ##validation.commentvalidation##
   ##ENDIFvalidation.commentvalidation##
   ##ENDFOREACHvalidations##',
         'content_html'             => '&lt;div&gt;##FOREACHvalidations##&lt;/div&gt;
   &lt;p&gt;##IFvalidation.storestatus=2##&lt;/p&gt;
   &lt;div&gt;##validation.submission.title##&lt;/div&gt;
   &lt;div&gt;##lang.validation.commentsubmission## : ##validation.commentsubmission##&lt;/div&gt;
   &lt;div&gt;##ENDIFvalidation.storestatus##&lt;/div&gt;
   &lt;div&gt;##ELSEvalidation.storestatus## ##validation.answer.title## ##ENDELSEvalidation.storestatus##&lt;/div&gt;
   &lt;div&gt;&lt;/div&gt;
   &lt;div&gt;
   &lt;div&gt;##lang.ticket.url## : &lt;a href="##ticket.urlvalidation##"&gt; ##ticket.urlvalidation## &lt;/a&gt;&lt;/div&gt;
   &lt;/div&gt;
   &lt;p&gt;##IFvalidation.status## ##lang.validation.status## : ##validation.status## ##ENDIFvalidation.status##
   &lt;br /&gt; ##IFvalidation.commentvalidation##&lt;br /&gt; ##lang.validation.commentvalidation## :
   &#160; ##validation.commentvalidation##&lt;br /&gt; ##ENDIFvalidation.commentvalidation##
   &lt;br /&gt;##ENDFOREACHvalidations##&lt;/p&gt;'
      ], [
         'id'                       => '8',
         'notificationtemplates_id' => '6',
         'language'                 => '',
         'subject'                  => '##ticket.action## ##ticket.entity##',
         'content_text'             => '##lang.ticket.entity## : ##ticket.entity##
   ##FOREACHtickets##
   ##lang.ticket.title## : ##ticket.title##
    ##lang.ticket.status## : ##ticket.status##
    ##ticket.url##
    ##ENDFOREACHtickets##',
         'content_html'             => '&lt;table class="tab_cadre" border="1" cellspacing="2" cellpadding="3"&gt;
   &lt;tbody&gt;
   &lt;tr&gt;
   &lt;td style="text-align: left;" width="auto" bgcolor="#cccccc"&gt;&lt;span style="font-size: 11px; text-align: left;"&gt;##lang.ticket.authors##&lt;/span&gt;&lt;/td&gt;
   &lt;td style="text-align: left;" width="auto" bgcolor="#cccccc"&gt;&lt;span style="font-size: 11px; text-align: left;"&gt;##lang.ticket.title##&lt;/span&gt;&lt;/td&gt;
   &lt;td style="text-align: left;" width="auto" bgcolor="#cccccc"&gt;&lt;span style="font-size: 11px; text-align: left;"&gt;##lang.ticket.priority##&lt;/span&gt;&lt;/td&gt;
   &lt;td style="text-align: left;" width="auto" bgcolor="#cccccc"&gt;&lt;span style="font-size: 11px; text-align: left;"&gt;##lang.ticket.status##&lt;/span&gt;&lt;/td&gt;
   &lt;td style="text-align: left;" width="auto" bgcolor="#cccccc"&gt;&lt;span style="font-size: 11px; text-align: left;"&gt;##lang.ticket.attribution##&lt;/span&gt;&lt;/td&gt;
   &lt;td style="text-align: left;" width="auto" bgcolor="#cccccc"&gt;&lt;span style="font-size: 11px; text-align: left;"&gt;##lang.ticket.creationdate##&lt;/span&gt;&lt;/td&gt;
   &lt;td style="text-align: left;" width="auto" bgcolor="#cccccc"&gt;&lt;span style="font-size: 11px; text-align: left;"&gt;##lang.ticket.content##&lt;/span&gt;&lt;/td&gt;
   &lt;/tr&gt;
   ##FOREACHtickets##
   &lt;tr&gt;
   &lt;td width="auto"&gt;&lt;span style="font-size: 11px; text-align: left;"&gt;##ticket.authors##&lt;/span&gt;&lt;/td&gt;
   &lt;td width="auto"&gt;&lt;span style="font-size: 11px; text-align: left;"&gt;&lt;a href="##ticket.url##"&gt;##ticket.title##&lt;/a&gt;&lt;/span&gt;&lt;/td&gt;
   &lt;td width="auto"&gt;&lt;span style="font-size: 11px; text-align: left;"&gt;##ticket.priority##&lt;/span&gt;&lt;/td&gt;
   &lt;td width="auto"&gt;&lt;span style="font-size: 11px; text-align: left;"&gt;##ticket.status##&lt;/span&gt;&lt;/td&gt;
   &lt;td width="auto"&gt;&lt;span style="font-size: 11px; text-align: left;"&gt;##IFticket.assigntousers####ticket.assigntousers##&lt;br /&gt;##ENDIFticket.assigntousers####IFticket.assigntogroups##&lt;br /&gt;##ticket.assigntogroups## ##ENDIFticket.assigntogroups####IFticket.assigntosupplier##&lt;br /&gt;##ticket.assigntosupplier## ##ENDIFticket.assigntosupplier##&lt;/span&gt;&lt;/td&gt;
   &lt;td width="auto"&gt;&lt;span style="font-size: 11px; text-align: left;"&gt;##ticket.creationdate##&lt;/span&gt;&lt;/td&gt;
   &lt;td width="auto"&gt;&lt;span style="font-size: 11px; text-align: left;"&gt;##ticket.content##&lt;/span&gt;&lt;/td&gt;
   &lt;/tr&gt;
   ##ENDFOREACHtickets##
   &lt;/tbody&gt;
   &lt;/table&gt;'
      ], [
         'id'                       => '9',
         'notificationtemplates_id' => '9',
         'language'                 => '',
         'subject'                  => '##consumable.action##  ##consumable.entity##',
         'content_text'             => '##lang.consumable.entity## : ##consumable.entity##
   ##FOREACHconsumables##
   ##lang.consumable.item## : ##consumable.item##
   ##lang.consumable.reference## : ##consumable.reference##
   ##lang.consumable.remaining## : ##consumable.remaining##
   ##consumable.url##
   ##ENDFOREACHconsumables##',
         'content_html'                => '&lt;p&gt;
   ##lang.consumable.entity## : ##consumable.entity##
   &lt;br /&gt; &lt;br /&gt;##FOREACHconsumables##
   &lt;br /&gt;##lang.consumable.item## : ##consumable.item##&lt;br /&gt;
   &lt;br /&gt;##lang.consumable.reference## : ##consumable.reference##&lt;br /&gt;
   ##lang.consumable.remaining## : ##consumable.remaining##&lt;br /&gt;
   &lt;a href="##consumable.url##"&gt; ##consumable.url##&lt;/a&gt;&lt;br /&gt;
      ##ENDFOREACHconsumables##&lt;/p&gt;'
      ], [
         'id'                       => '10',
         'notificationtemplates_id' => '8',
         'language'                 => '',
         'subject'                  => '##cartridge.action##  ##cartridge.entity##',
         'content_text'             => '##lang.cartridge.entity## : ##cartridge.entity##
   ##FOREACHcartridges##
   ##lang.cartridge.item## : ##cartridge.item##
   ##lang.cartridge.reference## : ##cartridge.reference##
   ##lang.cartridge.remaining## : ##cartridge.remaining##
   ##cartridge.url##
    ##ENDFOREACHcartridges##',
         'content_html'             => '&lt;p&gt;##lang.cartridge.entity## : ##cartridge.entity##
   &lt;br /&gt; &lt;br /&gt;##FOREACHcartridges##
   &lt;br /&gt;##lang.cartridge.item## :
   ##cartridge.item##&lt;br /&gt; &lt;br /&gt;
   ##lang.cartridge.reference## :
   ##cartridge.reference##&lt;br /&gt;
   ##lang.cartridge.remaining## :
   ##cartridge.remaining##&lt;br /&gt;
   &lt;a href="##cartridge.url##"&gt;
   ##cartridge.url##&lt;/a&gt;&lt;br /&gt;
   ##ENDFOREACHcartridges##&lt;/p&gt;'
      ], [
         'id'                       => '11',
         'notificationtemplates_id' => '10',
         'language'                 => '',
         'subject'                  => '##infocom.action##  ##infocom.entity##',
         'content_text'             => '##lang.infocom.entity## : ##infocom.entity##
   ##FOREACHinfocoms##
   ##lang.infocom.itemtype## : ##infocom.itemtype##
   ##lang.infocom.item## : ##infocom.item##
   ##lang.infocom.expirationdate## : ##infocom.expirationdate##
   ##infocom.url##
    ##ENDFOREACHinfocoms##',
         'content_html'             => '&lt;p&gt;##lang.infocom.entity## : ##infocom.entity##
   &lt;br /&gt; &lt;br /&gt;##FOREACHinfocoms##
   &lt;br /&gt;##lang.infocom.itemtype## : ##infocom.itemtype##&lt;br /&gt;
   ##lang.infocom.item## : ##infocom.item##&lt;br /&gt; &lt;br /&gt;
   ##lang.infocom.expirationdate## : ##infocom.expirationdate##
   &lt;br /&gt; &lt;a href="##infocom.url##"&gt;
   ##infocom.url##&lt;/a&gt;&lt;br /&gt;
   ##ENDFOREACHinfocoms##&lt;/p&gt;'
      ], [
         'id'                       => '12',
         'notificationtemplates_id' => '11',
         'language'                 => '',
         'subject'                  => '##license.action##  ##license.entity##',
         'content_text'             => '##lang.license.entity## : ##license.entity##
   ##FOREACHlicenses##
   ##lang.license.item## : ##license.item##
   ##lang.license.serial## : ##license.serial##
   ##lang.license.expirationdate## : ##license.expirationdate##
   ##license.url##
    ##ENDFOREACHlicenses##',
         'content_html'             => '&lt;p&gt;
   ##lang.license.entity## : ##license.entity##&lt;br /&gt;
   ##FOREACHlicenses##
   &lt;br /&gt;##lang.license.item## : ##license.item##&lt;br /&gt;
   ##lang.license.serial## : ##license.serial##&lt;br /&gt;
   ##lang.license.expirationdate## : ##license.expirationdate##
   &lt;br /&gt; &lt;a href="##license.url##"&gt; ##license.url##
   &lt;/a&gt;&lt;br /&gt; ##ENDFOREACHlicenses##&lt;/p&gt;'
      ], [
         'id'                       => '13',
         'notificationtemplates_id' => '13',
         'language'                 => '',
         'subject'                  => '##user.action##',
         'content_text'             => '##user.realname## ##user.firstname##
   ##lang.passwordforget.information##
   ##lang.passwordforget.link## ##user.passwordforgeturl##',
         'content_html'             => '&lt;p&gt;&lt;strong&gt;##user.realname## ##user.firstname##&lt;/strong&gt;&lt;/p&gt;
   &lt;p&gt;##lang.passwordforget.information##&lt;/p&gt;
   &lt;p&gt;##lang.passwordforget.link## &lt;a title="##user.passwordforgeturl##" href="##user.passwordforgeturl##"&gt;##user.passwordforgeturl##&lt;/a&gt;&lt;/p&gt;'
      ], [
         'id'                       => '14',
         'notificationtemplates_id' => '14',
         'language'                 => '',
         'subject'                  => '##ticket.action## ##ticket.title##',
         'content_text'             => '##lang.ticket.title## : ##ticket.title##
   ##lang.ticket.closedate## : ##ticket.closedate##
   ##lang.satisfaction.text## ##ticket.urlsatisfaction##',
         'content_html'             =>'&lt;p&gt;##lang.ticket.title## : ##ticket.title##&lt;/p&gt;
   &lt;p&gt;##lang.ticket.closedate## : ##ticket.closedate##&lt;/p&gt;
   &lt;p&gt;##lang.satisfaction.text## &lt;a href="##ticket.urlsatisfaction##"&gt;##ticket.urlsatisfaction##&lt;/a&gt;&lt;/p&gt;'
      ], [
         'id'                       => '16',
         'notificationtemplates_id' => '16',
         'language'                 => '',
         'subject'                  => '##crontask.action##',
         'content_text'             => '##lang.crontask.warning##
   ##FOREACHcrontasks##
    ##crontask.name## : ##crontask.description##
   ##ENDFOREACHcrontasks##',
         'content_html'             => '&lt;p&gt;##lang.crontask.warning##&lt;/p&gt;
   &lt;p&gt;##FOREACHcrontasks## &lt;br /&gt;&lt;a href="##crontask.url##"&gt;##crontask.name##&lt;/a&gt; : ##crontask.description##&lt;br /&gt; &lt;br /&gt;##ENDFOREACHcrontasks##&lt;/p&gt;'
      ], [
         'id'                       => '17',
         'notificationtemplates_id' => '17',
         'language'                 => '',
         'subject'                  => '##problem.action## ##problem.title##',
         'content_text'             => '##IFproblem.storestatus=5##
    ##lang.problem.url## : ##problem.urlapprove##
    ##lang.problem.solvedate## : ##problem.solvedate##
    ##lang.problem.solution.type## : ##problem.solution.type##
    ##lang.problem.solution.description## : ##problem.solution.description## ##ENDIFproblem.storestatus##
    ##ELSEproblem.storestatus## ##lang.problem.url## : ##problem.url## ##ENDELSEproblem.storestatus##
    ##lang.problem.description##
    ##lang.problem.title##  :##problem.title##
    ##lang.problem.authors##  :##IFproblem.authors## ##problem.authors## ##ENDIFproblem.authors## ##ELSEproblem.authors##--##ENDELSEproblem.authors##
    ##lang.problem.creationdate##  :##problem.creationdate##
    ##IFproblem.assigntousers## ##lang.problem.assigntousers##  : ##problem.assigntousers## ##ENDIFproblem.assigntousers##
    ##lang.problem.status##  : ##problem.status##
    ##IFproblem.assigntogroups## ##lang.problem.assigntogroups##  : ##problem.assigntogroups## ##ENDIFproblem.assigntogroups##
    ##lang.problem.urgency##  : ##problem.urgency##
    ##lang.problem.impact##  : ##problem.impact##
    ##lang.problem.priority## : ##problem.priority##
   ##IFproblem.category## ##lang.problem.category##  :##problem.category## ##ENDIFproblem.category## ##ELSEproblem.category## ##lang.problem.nocategoryassigned## ##ENDELSEproblem.category##
    ##lang.problem.content##  : ##problem.content##
   ##IFproblem.storestatus=6##
    ##lang.problem.solvedate## : ##problem.solvedate##
    ##lang.problem.solution.type## : ##problem.solution.type##
    ##lang.problem.solution.description## : ##problem.solution.description##
   ##ENDIFproblem.storestatus##
    ##lang.problem.numberoffollowups## : ##problem.numberoffollowups##
   ##FOREACHfollowups##
    [##followup.date##] ##lang.followup.isprivate## : ##followup.isprivate##
    ##lang.followup.author## ##followup.author##
    ##lang.followup.description## ##followup.description##
    ##lang.followup.date## ##followup.date##
    ##lang.followup.requesttype## ##followup.requesttype##
   ##ENDFOREACHfollowups##
    ##lang.problem.numberoftickets## : ##problem.numberoftickets##
   ##FOREACHtickets##
    [##ticket.date##] ##lang.problem.title## : ##ticket.title##
    ##lang.problem.content## ##ticket.content##
   ##ENDFOREACHtickets##
    ##lang.problem.numberoftasks## : ##problem.numberoftasks##
   ##FOREACHtasks##
    [##task.date##]
    ##lang.task.author## ##task.author##
    ##lang.task.description## ##task.description##
    ##lang.task.time## ##task.time##
    ##lang.task.category## ##task.category##
   ##ENDFOREACHtasks##
   ',
         'content_html'             => '&lt;p&gt;##IFproblem.storestatus=5##&lt;/p&gt;
   &lt;div&gt;##lang.problem.url## : &lt;a href="##problem.urlapprove##"&gt;##problem.urlapprove##&lt;/a&gt;&lt;/div&gt;
   &lt;div&gt;&lt;span style="color: #888888;"&gt;&lt;strong&gt;&lt;span style="text-decoration: underline;"&gt;##lang.problem.solvedate##&lt;/span&gt;&lt;/strong&gt;&lt;/span&gt; : ##problem.solvedate##&lt;br /&gt;&lt;span style="text-decoration: underline; color: #888888;"&gt;&lt;strong&gt;##lang.problem.solution.type##&lt;/strong&gt;&lt;/span&gt; : ##problem.solution.type##&lt;br /&gt;&lt;span style="text-decoration: underline; color: #888888;"&gt;&lt;strong&gt;##lang.problem.solution.description##&lt;/strong&gt;&lt;/span&gt; : ##problem.solution.description## ##ENDIFproblem.storestatus##&lt;/div&gt;
   &lt;div&gt;##ELSEproblem.storestatus## ##lang.problem.url## : &lt;a href="##problem.url##"&gt;##problem.url##&lt;/a&gt; ##ENDELSEproblem.storestatus##&lt;/div&gt;
   &lt;p class="description b"&gt;&lt;strong&gt;##lang.problem.description##&lt;/strong&gt;&lt;/p&gt;
   &lt;p&gt;&lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt; ##lang.problem.title##&lt;/span&gt;&#160;:##problem.title## &lt;br /&gt; &lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt; ##lang.problem.authors##&lt;/span&gt;&#160;:##IFproblem.authors## ##problem.authors## ##ENDIFproblem.authors##    ##ELSEproblem.authors##--##ENDELSEproblem.authors## &lt;br /&gt; &lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt; ##lang.problem.creationdate##&lt;/span&gt;&#160;:##problem.creationdate## &lt;br /&gt; ##IFproblem.assigntousers## &lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt; ##lang.problem.assigntousers##&lt;/span&gt;&#160;: ##problem.assigntousers## ##ENDIFproblem.assigntousers##&lt;br /&gt; &lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt;##lang.problem.status## &lt;/span&gt;&#160;: ##problem.status##&lt;br /&gt; ##IFproblem.assigntogroups## &lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt; ##lang.problem.assigntogroups##&lt;/span&gt;&#160;: ##problem.assigntogroups## ##ENDIFproblem.assigntogroups##&lt;br /&gt; &lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt; ##lang.problem.urgency##&lt;/span&gt;&#160;: ##problem.urgency##&lt;br /&gt; &lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt; ##lang.problem.impact##&lt;/span&gt;&#160;: ##problem.impact##&lt;br /&gt; &lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt; ##lang.problem.priority##&lt;/span&gt; : ##problem.priority## &lt;br /&gt;##IFproblem.category##&lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt;##lang.problem.category## &lt;/span&gt;&#160;:##problem.category##  ##ENDIFproblem.category## ##ELSEproblem.category##  ##lang.problem.nocategoryassigned## ##ENDELSEproblem.category##    &lt;br /&gt; &lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt; ##lang.problem.content##&lt;/span&gt;&#160;: ##problem.content##&lt;/p&gt;
   &lt;p&gt;##IFproblem.storestatus=6##&lt;br /&gt;&lt;span style="text-decoration: underline;"&gt;&lt;strong&gt;&lt;span style="color: #888888;"&gt;##lang.problem.solvedate##&lt;/span&gt;&lt;/strong&gt;&lt;/span&gt; : ##problem.solvedate##&lt;br /&gt;&lt;span style="color: #888888;"&gt;&lt;strong&gt;&lt;span style="text-decoration: underline;"&gt;##lang.problem.solution.type##&lt;/span&gt;&lt;/strong&gt;&lt;/span&gt; : ##problem.solution.type##&lt;br /&gt;&lt;span style="text-decoration: underline; color: #888888;"&gt;&lt;strong&gt;##lang.problem.solution.description##&lt;/strong&gt;&lt;/span&gt; : ##problem.solution.description##&lt;br /&gt;##ENDIFproblem.storestatus##&lt;/p&gt;
   <div class="description b">##lang.problem.numberoffollowups##&#160;: ##problem.numberoffollowups##</div>
   <p>##FOREACHfollowups##</p>
   <div class="description b"><br /> <strong> [##followup.date##] <em>##lang.followup.isprivate## : ##followup.isprivate## </em></strong><br /> <span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"> ##lang.followup.author## </span> ##followup.author##<br /> <span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"> ##lang.followup.description## </span> ##followup.description##<br /> <span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"> ##lang.followup.date## </span> ##followup.date##<br /> <span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"> ##lang.followup.requesttype## </span> ##followup.requesttype##</div>
   <p>##ENDFOREACHfollowups##</p>
   &lt;div class="description b"&gt;##lang.problem.numberoftickets##&#160;: ##problem.numberoftickets##&lt;/div&gt;
   &lt;p&gt;##FOREACHtickets##&lt;/p&gt;
   &lt;div&gt;&lt;strong&gt; [##ticket.date##] &lt;em&gt;##lang.problem.title## : &lt;a href="##ticket.url##"&gt;##ticket.title## &lt;/a&gt;&lt;/em&gt;&lt;/strong&gt;&lt;br /&gt; &lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt; &lt;/span&gt;&lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt;##lang.problem.content## &lt;/span&gt; ##ticket.content##
   &lt;p&gt;##ENDFOREACHtickets##&lt;/p&gt;
   &lt;div class="description b"&gt;##lang.problem.numberoftasks##&#160;: ##problem.numberoftasks##&lt;/div&gt;
   &lt;p&gt;##FOREACHtasks##&lt;/p&gt;
   &lt;div class="description b"&gt;&lt;strong&gt;[##task.date##] &lt;/strong&gt;&lt;br /&gt; &lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt; ##lang.task.author##&lt;/span&gt; ##task.author##&lt;br /&gt; &lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt; ##lang.task.description##&lt;/span&gt; ##task.description##&lt;br /&gt; &lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt; ##lang.task.time##&lt;/span&gt; ##task.time##&lt;br /&gt; &lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt; ##lang.task.category##&lt;/span&gt; ##task.category##&lt;/div&gt;
   &lt;p&gt;##ENDFOREACHtasks##&lt;/p&gt;
   &lt;/div&gt;'
      ], [
         'id'                       => '18',
         'notificationtemplates_id' => '18',
         'language'                 => '',
         'subject'                  => '##recall.action##: ##recall.item.name##',
         'content_text'             => '##recall.action##: ##recall.item.name##
   ##recall.item.content##
   ##lang.recall.planning.begin##: ##recall.planning.begin##
   ##lang.recall.planning.end##: ##recall.planning.end##
   ##lang.recall.planning.state##: ##recall.planning.state##
   ##lang.recall.item.private##: ##recall.item.private##',
         'content_html'             => '&lt;p&gt;##recall.action##: &lt;a href="##recall.item.url##"&gt;##recall.item.name##&lt;/a&gt;&lt;/p&gt;
   &lt;p&gt;##recall.item.content##&lt;/p&gt;
   &lt;p&gt;##lang.recall.planning.begin##: ##recall.planning.begin##&lt;br /&gt;##lang.recall.planning.end##: ##recall.planning.end##&lt;br /&gt;##lang.recall.planning.state##: ##recall.planning.state##&lt;br /&gt;##lang.recall.item.private##: ##recall.item.private##&lt;br /&gt;&lt;br /&gt;&lt;/p&gt;
   &lt;p&gt;&lt;br /&gt;&lt;br /&gt;&lt;/p&gt;'
      ], [
         'id'                       => '19',
         'notificationtemplates_id' => '19',
         'language'                 => '',
         'subject'                  => '##change.action## ##change.title##',
         'content_text'             => '##IFchange.storestatus=5##
    ##lang.change.url## : ##change.urlapprove##
    ##lang.change.solvedate## : ##change.solvedate##
    ##lang.change.solution.type## : ##change.solution.type##
    ##lang.change.solution.description## : ##change.solution.description## ##ENDIFchange.storestatus##
    ##ELSEchange.storestatus## ##lang.change.url## : ##change.url## ##ENDELSEchange.storestatus##
    ##lang.change.description##
    ##lang.change.title##  :##change.title##
    ##lang.change.authors##  :##IFchange.authors## ##change.authors## ##ENDIFchange.authors## ##ELSEchange.authors##--##ENDELSEchange.authors##
    ##lang.change.creationdate##  :##change.creationdate##
    ##IFchange.assigntousers## ##lang.change.assigntousers##  : ##change.assigntousers## ##ENDIFchange.assigntousers##
    ##lang.change.status##  : ##change.status##
    ##IFchange.assigntogroups## ##lang.change.assigntogroups##  : ##change.assigntogroups## ##ENDIFchange.assigntogroups##
    ##lang.change.urgency##  : ##change.urgency##
    ##lang.change.impact##  : ##change.impact##
    ##lang.change.priority## : ##change.priority##
   ##IFchange.category## ##lang.change.category##  :##change.category## ##ENDIFchange.category## ##ELSEchange.category## ##lang.change.nocategoryassigned## ##ENDELSEchange.category##
    ##lang.change.content##  : ##change.content##
   ##IFchange.storestatus=6##
    ##lang.change.solvedate## : ##change.solvedate##
    ##lang.change.solution.type## : ##change.solution.type##
    ##lang.change.solution.description## : ##change.solution.description##
   ##ENDIFchange.storestatus##
    ##lang.change.numberoffollowups## : ##change.numberoffollowups##
   ##FOREACHfollowups##
    [##followup.date##] ##lang.followup.isprivate## : ##followup.isprivate##
    ##lang.followup.author## ##followup.author##
    ##lang.followup.description## ##followup.description##
    ##lang.followup.date## ##followup.date##
    ##lang.followup.requesttype## ##followup.requesttype##
   ##ENDFOREACHfollowups##
    ##lang.change.numberofproblems## : ##change.numberofproblems##
   ##FOREACHproblems##
    [##problem.date##] ##lang.change.title## : ##problem.title##
    ##lang.change.content## ##problem.content##
   ##ENDFOREACHproblems##
    ##lang.change.numberoftasks## : ##change.numberoftasks##
   ##FOREACHtasks##
    [##task.date##]
    ##lang.task.author## ##task.author##
    ##lang.task.description## ##task.description##
    ##lang.task.time## ##task.time##
    ##lang.task.category## ##task.category##
   ##ENDFOREACHtasks##
   ',
         'content_html'             => '&lt;p&gt;##IFchange.storestatus=5##&lt;/p&gt;
   &lt;div&gt;##lang.change.url## : &lt;a href="##change.urlapprove##"&gt;##change.urlapprove##&lt;/a&gt;&lt;/div&gt;
   &lt;div&gt;&lt;span style="color: #888888;"&gt;&lt;strong&gt;&lt;span style="text-decoration: underline;"&gt;##lang.change.solvedate##&lt;/span&gt;&lt;/strong&gt;&lt;/span&gt; : ##change.solvedate##&lt;br /&gt;&lt;span style="text-decoration: underline; color: #888888;"&gt;&lt;strong&gt;##lang.change.solution.type##&lt;/strong&gt;&lt;/span&gt; : ##change.solution.type##&lt;br /&gt;&lt;span style="text-decoration: underline; color: #888888;"&gt;&lt;strong&gt;##lang.change.solution.description##&lt;/strong&gt;&lt;/span&gt; : ##change.solution.description## ##ENDIFchange.storestatus##&lt;/div&gt;
   &lt;div&gt;##ELSEchange.storestatus## ##lang.change.url## : &lt;a href="##change.url##"&gt;##change.url##&lt;/a&gt; ##ENDELSEchange.storestatus##&lt;/div&gt;
   &lt;p class="description b"&gt;&lt;strong&gt;##lang.change.description##&lt;/strong&gt;&lt;/p&gt;
   &lt;p&gt;&lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt; ##lang.change.title##&lt;/span&gt;&#160;:##change.title## &lt;br /&gt; &lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt; ##lang.change.authors##&lt;/span&gt;&#160;:##IFchange.authors## ##change.authors## ##ENDIFchange.authors##    ##ELSEchange.authors##--##ENDELSEchange.authors## &lt;br /&gt; &lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt; ##lang.change.creationdate##&lt;/span&gt;&#160;:##change.creationdate## &lt;br /&gt; ##IFchange.assigntousers## &lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt; ##lang.change.assigntousers##&lt;/span&gt;&#160;: ##change.assigntousers## ##ENDIFchange.assigntousers##&lt;br /&gt; &lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt;##lang.change.status## &lt;/span&gt;&#160;: ##change.status##&lt;br /&gt; ##IFchange.assigntogroups## &lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt; ##lang.change.assigntogroups##&lt;/span&gt;&#160;: ##change.assigntogroups## ##ENDIFchange.assigntogroups##&lt;br /&gt; &lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt; ##lang.change.urgency##&lt;/span&gt;&#160;: ##change.urgency##&lt;br /&gt; &lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt; ##lang.change.impact##&lt;/span&gt;&#160;: ##change.impact##&lt;br /&gt; &lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt; ##lang.change.priority##&lt;/span&gt; : ##change.priority## &lt;br /&gt;##IFchange.category##&lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt;##lang.change.category## &lt;/span&gt;&#160;:##change.category##  ##ENDIFchange.category## ##ELSEchange.category##  ##lang.change.nocategoryassigned## ##ENDELSEchange.category##    &lt;br /&gt; &lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt; ##lang.change.content##&lt;/span&gt;&#160;: ##change.content##&lt;/p&gt;
   &lt;p&gt;##IFchange.storestatus=6##&lt;br /&gt;&lt;span style="text-decoration: underline;"&gt;&lt;strong&gt;&lt;span style="color: #888888;"&gt;##lang.change.solvedate##&lt;/span&gt;&lt;/strong&gt;&lt;/span&gt; : ##change.solvedate##&lt;br /&gt;&lt;span style="color: #888888;"&gt;&lt;strong&gt;&lt;span style="text-decoration: underline;"&gt;##lang.change.solution.type##&lt;/span&gt;&lt;/strong&gt;&lt;/span&gt; : ##change.solution.type##&lt;br /&gt;&lt;span style="text-decoration: underline; color: #888888;"&gt;&lt;strong&gt;##lang.change.solution.description##&lt;/strong&gt;&lt;/span&gt; : ##change.solution.description##&lt;br /&gt;##ENDIFchange.storestatus##&lt;/p&gt;
   <div class="description b">##lang.change.numberoffollowups##&#160;: ##change.numberoffollowups##</div>
   <p>##FOREACHfollowups##</p>
   <div class="description b"><br /> <strong> [##followup.date##] <em>##lang.followup.isprivate## : ##followup.isprivate## </em></strong><br /> <span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"> ##lang.followup.author## </span> ##followup.author##<br /> <span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"> ##lang.followup.description## </span> ##followup.description##<br /> <span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"> ##lang.followup.date## </span> ##followup.date##<br /> <span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"> ##lang.followup.requesttype## </span> ##followup.requesttype##</div>
   <p>##ENDFOREACHfollowups##</p>
   &lt;div class="description b"&gt;##lang.change.numberofproblems##&#160;: ##change.numberofproblems##&lt;/div&gt;
   &lt;p&gt;##FOREACHproblems##&lt;/p&gt;
   &lt;div&gt;&lt;strong&gt; [##problem.date##] &lt;em&gt;##lang.change.title## : &lt;a href="##problem.url##"&gt;##problem.title## &lt;/a&gt;&lt;/em&gt;&lt;/strong&gt;&lt;br /&gt; &lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt; &lt;/span&gt;&lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt;##lang.change.content## &lt;/span&gt; ##problem.content##
   &lt;p&gt;##ENDFOREACHproblems##&lt;/p&gt;
   &lt;div class="description b"&gt;##lang.change.numberoftasks##&#160;: ##change.numberoftasks##&lt;/div&gt;
   &lt;p&gt;##FOREACHtasks##&lt;/p&gt;
   &lt;div class="description b"&gt;&lt;strong&gt;[##task.date##] &lt;/strong&gt;&lt;br /&gt; &lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt; ##lang.task.author##&lt;/span&gt; ##task.author##&lt;br /&gt; &lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt; ##lang.task.description##&lt;/span&gt; ##task.description##&lt;br /&gt; &lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt; ##lang.task.time##&lt;/span&gt; ##task.time##&lt;br /&gt; &lt;span style="color: #8b8c8f; font-weight: bold; text-decoration: underline;"&gt; ##lang.task.category##&lt;/span&gt; ##task.category##&lt;/div&gt;
   &lt;p&gt;##ENDFOREACHtasks##&lt;/p&gt;
   &lt;/div&gt;'
      ], [
         'id'                       => '20',
         'notificationtemplates_id' => '20',
         'language'                 => '',
         'subject'                  => '##mailcollector.action##',
         'content_text'             => '##FOREACHmailcollectors##
   ##lang.mailcollector.name## : ##mailcollector.name##
   ##lang.mailcollector.errors## : ##mailcollector.errors##
   ##mailcollector.url##
   ##ENDFOREACHmailcollectors##',
         'content_html'             => '&lt;p&gt;##FOREACHmailcollectors##&lt;br /&gt;##lang.mailcollector.name## : ##mailcollector.name##&lt;br /&gt; ##lang.mailcollector.errors## : ##mailcollector.errors##&lt;br /&gt;&lt;a href="##mailcollector.url##"&gt;##mailcollector.url##&lt;/a&gt;&lt;br /&gt; ##ENDFOREACHmailcollectors##&lt;/p&gt;
   &lt;p&gt;&lt;/p&gt;'
      ], [
         'id'                       => '21',
         'notificationtemplates_id' => '21',
         'language'                 => '',
         'subject'                  => '##project.action## ##project.name## ##project.code##',
         'content_text'             => '##lang.project.url## : ##project.url##
   ##lang.project.description##
   ##lang.project.name## : ##project.name##
   ##lang.project.code## : ##project.code##
   ##lang.project.manager## : ##project.manager##
   ##lang.project.managergroup## : ##project.managergroup##
   ##lang.project.creationdate## : ##project.creationdate##
   ##lang.project.priority## : ##project.priority##
   ##lang.project.state## : ##project.state##
   ##lang.project.type## : ##project.type##
   ##lang.project.description## : ##project.description##
   ##lang.project.numberoftasks## : ##project.numberoftasks##
   ##FOREACHtasks##
   [##task.creationdate##]
   ##lang.task.name## : ##task.name##
   ##lang.task.state## : ##task.state##
   ##lang.task.type## : ##task.type##
   ##lang.task.percent## : ##task.percent##
   ##lang.task.description## : ##task.description##
   ##ENDFOREACHtasks##',
         'content_html'             => '&lt;p&gt;##lang.project.url## : &lt;a href="##project.url##"&gt;##project.url##&lt;/a&gt;&lt;/p&gt;
   &lt;p&gt;&lt;strong&gt;##lang.project.description##&lt;/strong&gt;&lt;/p&gt;
   &lt;p&gt;##lang.project.name## : ##project.name##&lt;br /&gt;##lang.project.code## : ##project.code##&lt;br /&gt; ##lang.project.manager## : ##project.manager##&lt;br /&gt;##lang.project.managergroup## : ##project.managergroup##&lt;br /&gt; ##lang.project.creationdate## : ##project.creationdate##&lt;br /&gt;##lang.project.priority## : ##project.priority## &lt;br /&gt;##lang.project.state## : ##project.state##&lt;br /&gt;##lang.project.type## : ##project.type##&lt;br /&gt;##lang.project.description## : ##project.description##&lt;/p&gt;
   &lt;p&gt;##lang.project.numberoftasks## : ##project.numberoftasks##&lt;/p&gt;
   &lt;div&gt;
   &lt;p&gt;##FOREACHtasks##&lt;/p&gt;
   &lt;div&gt;&lt;strong&gt;[##task.creationdate##] &lt;/strong&gt;&lt;br /&gt; ##lang.task.name## : ##task.name##&lt;br /&gt;##lang.task.state## : ##task.state##&lt;br /&gt;##lang.task.type## : ##task.type##&lt;br /&gt;##lang.task.percent## : ##task.percent##&lt;br /&gt;##lang.task.description## : ##task.description##&lt;/div&gt;
   &lt;p&gt;##ENDFOREACHtasks##&lt;/p&gt;
   &lt;/div&gt;'
      ], [
         'id'                       => '22',
         'notificationtemplates_id' => '22',
         'language'                 => '',
         'subject'                  => '##projecttask.action## ##projecttask.name##',
         'content_text'             => '##lang.projecttask.url## : ##projecttask.url##
   ##lang.projecttask.description##
   ##lang.projecttask.name## : ##projecttask.name##
   ##lang.projecttask.project## : ##projecttask.project##
   ##lang.projecttask.creationdate## : ##projecttask.creationdate##
   ##lang.projecttask.state## : ##projecttask.state##
   ##lang.projecttask.type## : ##projecttask.type##
   ##lang.projecttask.description## : ##projecttask.description##
   ##lang.projecttask.numberoftasks## : ##projecttask.numberoftasks##
   ##FOREACHtasks##
   [##task.creationdate##]
   ##lang.task.name## : ##task.name##
   ##lang.task.state## : ##task.state##
   ##lang.task.type## : ##task.type##
   ##lang.task.percent## : ##task.percent##
   ##lang.task.description## : ##task.description##
   ##ENDFOREACHtasks##',
         'content_html'                => '&lt;p&gt;##lang.projecttask.url## : &lt;a href="##projecttask.url##"&gt;##projecttask.url##&lt;/a&gt;&lt;/p&gt;
   &lt;p&gt;&lt;strong&gt;##lang.projecttask.description##&lt;/strong&gt;&lt;/p&gt;
   &lt;p&gt;##lang.projecttask.name## : ##projecttask.name##&lt;br /&gt;##lang.projecttask.project## : &lt;a href="##projecttask.projecturl##"&gt;##projecttask.project##&lt;/a&gt;&lt;br /&gt;##lang.projecttask.creationdate## : ##projecttask.creationdate##&lt;br /&gt;##lang.projecttask.state## : ##projecttask.state##&lt;br /&gt;##lang.projecttask.type## : ##projecttask.type##&lt;br /&gt;##lang.projecttask.description## : ##projecttask.description##&lt;/p&gt;
   &lt;p&gt;##lang.projecttask.numberoftasks## : ##projecttask.numberoftasks##&lt;/p&gt;
   &lt;div&gt;
   &lt;p&gt;##FOREACHtasks##&lt;/p&gt;
   &lt;div&gt;&lt;strong&gt;[##task.creationdate##] &lt;/strong&gt;&lt;br /&gt;##lang.task.name## : ##task.name##&lt;br /&gt;##lang.task.state## : ##task.state##&lt;br /&gt;##lang.task.type## : ##task.type##&lt;br /&gt;##lang.task.percent## : ##task.percent##&lt;br /&gt;##lang.task.description## : ##task.description##&lt;/div&gt;
   &lt;p&gt;##ENDFOREACHtasks##&lt;/p&gt;
   &lt;/div&gt;'
      ], [
         'id'                       => '23',
         'notificationtemplates_id' => '23',
         'language'                 => '',
         'subject'                  => '##objectlock.action##',
         'content_text'             => '##objectlock.type## ###objectlock.id## - ##objectlock.name##
         ##lang.objectlock.url##
         ##objectlock.url##
         ##lang.objectlock.date_mod##
         ##objectlock.date_mod##
         Hello ##objectlock.lockedby.firstname##,
         Could go to this item and unlock it for me?
         Thank you,
         Regards,
         ##objectlock.requester.firstname##',
         'content_html'             => '&lt;table&gt;
         &lt;tbody&gt;
         &lt;tr&gt;&lt;th colspan="2"&gt;&lt;a href="##objectlock.url##"&gt;##objectlock.type## ###objectlock.id## - ##objectlock.name##&lt;/a&gt;&lt;/th&gt;&lt;/tr&gt;
         &lt;tr&gt;
         &lt;td&gt;##lang.objectlock.url##&lt;/td&gt;
         &lt;td&gt;##objectlock.url##&lt;/td&gt;
         &lt;/tr&gt;
         &lt;tr&gt;
         &lt;td&gt;##lang.objectlock.date_mod##&lt;/td&gt;
         &lt;td&gt;##objectlock.date_mod##&lt;/td&gt;
         &lt;/tr&gt;
         &lt;/tbody&gt;
         &lt;/table&gt;
         &lt;p&gt;&lt;span style="font-size: small;"&gt;Hello ##objectlock.lockedby.firstname##,&lt;br /&gt;Could go to this item and unlock it for me?&lt;br /&gt;Thank you,&lt;br /&gt;Regards,&lt;br /&gt;##objectlock.requester.firstname## ##objectlock.requester.lastname##&lt;/span&gt;&lt;/p&gt;'
      ], [
         'id'                       => '24',
         'notificationtemplates_id' => '24',
         'language'                 => '',
         'subject'                  => '##savedsearch.action## ##savedsearch.name##',
         'content_text'             => '##savedsearch.type## ###savedsearch.id## - ##savedsearch.name##
         ##savedsearch.message##
         ##lang.savedsearch.url##
         ##savedsearch.url##
         Regards,',
         'content_html'             => '&lt;table&gt;
         &lt;tbody&gt;
         &lt;tr&gt;&lt;th colspan="2"&gt;&lt;a href="##savedsearch.url##"&gt;##savedsearch.type## ###savedsearch.id## - ##savedsearch.name##&lt;/a&gt;&lt;/th&gt;&lt;/tr&gt;
         &lt;tr&gt;&lt;td colspan="2"&gt;&lt;a href="##savedsearch.url##"&gt;##savedsearch.message##&lt;/a&gt;&lt;/td&gt;&lt;/tr&gt;
         &lt;tr&gt;
         &lt;td&gt;##lang.savedsearch.url##&lt;/td&gt;
         &lt;td&gt;##savedsearch.url##&lt;/td&gt;
         &lt;/tr&gt;
         &lt;/tbody&gt;
         &lt;/table&gt;
         &lt;p&gt;&lt;span style="font-size: small;"&gt;Hello &lt;br /&gt;Regards,&lt;/span&gt;&lt;/p&gt;'
      ], [
         'id'                       => '25',
         'notificationtemplates_id' => '25',
         'language'                 => '',
         'subject'                  => '##certificate.action##  ##certificate.entity##',
         'content_text'             => '##lang.certificate.entity## : ##certificate.entity##
   ##FOREACHcertificates##
   ##lang.certificate.serial## : ##certificate.serial##
   ##lang.certificate.expirationdate## : ##certificate.expirationdate##
   ##certificate.url##
    ##ENDFOREACHcertificates##',
         'content_html'             => '&lt;p&gt;
   ##lang.certificate.entity## : ##certificate.entity##&lt;br /&gt;
   ##FOREACHcertificates##
   &lt;br /&gt;##lang.certificate.name## : ##certificate.name##&lt;br /&gt;
   ##lang.certificate.serial## : ##certificate.serial##&lt;br /&gt;
   ##lang.certificate.expirationdate## : ##certificate.expirationdate##
   &lt;br /&gt; &lt;a href="##certificate.url##"&gt; ##certificate.url##
   &lt;/a&gt;&lt;br /&gt; ##ENDFOREACHcertificates##&lt;/p&gt;'
      ]
   ];

   $tables['glpi_profilerights'] = [
     [
        'profiles_id'  => '1',
        'name'         => 'computer',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'monitor',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'software',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'networking',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'internet',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'printer',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'peripheral',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'cartridge',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'consumable',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'phone',
        'rights'       => '0'
     ], [
        'profiles_id'  => '6',
        'name'         => 'queuednotification',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'contact_enterprise',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'document',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'contract',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'infocom',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'knowbase',
        'rights'       => '2048'
     ], [
        'profiles_id'  => '1',
        'name'         => 'reservation',
        'rights'       => '1024'
     ], [
        'profiles_id'  => '1',
        'name'         => 'reports',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'dropdown',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'device',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'typedoc',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'link',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'config',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'rule_ticket',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'rule_import',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'rule_ldap',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'rule_softwarecategories',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'search_config',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'location',
        'rights'       => '0'
     ], [
        'profiles_id'  => '7',
        'name'         => 'domain',
        'rights'       => '23'
     ], [
        'profiles_id'  => '1',
        'name'         => 'profile',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'user',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'group',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'entity',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'transfer',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'logs',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'reminder_public',
        'rights'       => '1'
     ], [
        'profiles_id'  => '1',
        'name'         => 'rssfeed_public',
        'rights'       => '1'
     ], [
        'profiles_id'  => '1',
        'name'         => 'bookmark_public',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'backup',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'ticket',
        'rights'       => '5'
     ], [
        'profiles_id'  => '1',
        'name'         => 'followup',
        'rights'       => '5'
     ], [
        'profiles_id'  => '1',
        'name'         => 'task',
        'rights'       => '1'
     ], [
        'profiles_id'  => '1',
        'name'         => 'planning',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'state',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'taskcategory',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'statistic',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'password_update',
        'rights'       => '1'
     ], [
        'profiles_id'  => '1',
        'name'         => 'show_group_hardware',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'rule_dictionnary_software',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'rule_dictionnary_dropdown',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'budget',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'notification',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'rule_mailcollector',
        'rights'       => '0'
     ], [
        'profiles_id'  => '7',
        'name'         => 'solutiontemplate',
        'rights'       => '23'
     ], [
        'profiles_id'  => '1',
        'name'         => 'calendar',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'slm',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'rule_dictionnary_printer',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'problem',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'netpoint',
        'rights'       => '0'
     ], [
        'profiles_id'  => '4',
        'name'         => 'knowbasecategory',
        'rights'       => '23'
     ], [
        'profiles_id'  => '5',
        'name'         => 'itilcategory',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'tickettemplate',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'ticketrecurrent',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'ticketcost',
        'rights'       => '0'
     ], [
        'profiles_id'  => '6',
        'name'         => 'changevalidation',
        'rights'       => '20'
     ], [
        'profiles_id'  => '1',
        'name'         => 'ticketvalidation',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'computer',
        'rights'       => '33'
     ], [
        'profiles_id'  => '2',
        'name'         => 'monitor',
        'rights'       => '33'
     ], [
        'profiles_id'  => '2',
        'name'         => 'software',
        'rights'       => '33'
     ], [
        'profiles_id'  => '2',
        'name'         => 'networking',
        'rights'       => '33'
     ], [
        'profiles_id'  => '2',
        'name'         => 'internet',
        'rights'       => '1'
     ], [
        'profiles_id'  => '2',
        'name'         => 'printer',
        'rights'       => '33'
     ], [
        'profiles_id'  => '2',
        'name'         => 'peripheral',
        'rights'       => '33'
     ], [
        'profiles_id'  => '2',
        'name'         => 'cartridge',
        'rights'       => '33'
     ], [
        'profiles_id'  => '2',
        'name'         => 'consumable',
        'rights'       => '33'
     ], [
        'profiles_id'  => '2',
        'name'         => 'phone',
        'rights'       => '33'
     ], [
        'profiles_id'  => '5',
        'name'         => 'queuednotification',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'contact_enterprise',
        'rights'       => '33'
     ], [
        'profiles_id'  => '2',
        'name'         => 'document',
        'rights'       => '33'
     ], [
        'profiles_id'  => '2',
        'name'         => 'contract',
        'rights'       => '33'
     ], [
        'profiles_id'  => '2',
        'name'         => 'infocom',
        'rights'       => '1'
     ], [
        'profiles_id'  => '2',
        'name'         => 'knowbase',
        'rights'       => '10241'
     ], [
        'profiles_id'  => '2',
        'name'         => 'reservation',
        'rights'       => '1025'
     ], [
        'profiles_id'  => '2',
        'name'         => 'reports',
        'rights'       => '1'
     ], [
        'profiles_id'  => '2',
        'name'         => 'dropdown',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'device',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'typedoc',
        'rights'       => '1'
     ], [
        'profiles_id'  => '2',
        'name'         => 'link',
        'rights'       => '1'
     ], [
        'profiles_id'  => '2',
        'name'         => 'config',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'rule_ticket',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'rule_import',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'rule_ldap',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'rule_softwarecategories',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'search_config',
        'rights'       => '1024'
     ], [
        'profiles_id'  => '4',
        'name'         => 'location',
        'rights'       => '23'
     ], [
        'profiles_id'  => '6',
        'name'         => 'domain',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'profile',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'user',
        'rights'       => '2049'
     ], [
        'profiles_id'  => '2',
        'name'         => 'group',
        'rights'       => '33'
     ], [
        'profiles_id'  => '2',
        'name'         => 'entity',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'transfer',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'logs',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'reminder_public',
        'rights'       => '1'
     ], [
        'profiles_id'  => '2',
        'name'         => 'rssfeed_public',
        'rights'       => '1'
     ], [
        'profiles_id'  => '2',
        'name'         => 'bookmark_public',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'backup',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'ticket',
        'rights'       => '168989'
     ], [
        'profiles_id'  => '2',
        'name'         => 'followup',
        'rights'       => '5'
     ], [
        'profiles_id'  => '2',
        'name'         => 'task',
        'rights'       => '1'
     ], [
        'profiles_id'  => '6',
        'name'         => 'projecttask',
        'rights'       => '1025'
     ], [
        'profiles_id'  => '7',
        'name'         => 'projecttask',
        'rights'       => '1025'
     ], [
        'profiles_id'  => '2',
        'name'         => 'planning',
        'rights'       => '1'
     ], [
        'profiles_id'  => '1',
        'name'         => 'state',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'taskcategory',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'statistic',
        'rights'       => '1'
     ], [
        'profiles_id'  => '2',
        'name'         => 'password_update',
        'rights'       => '1'
     ], [
        'profiles_id'  => '2',
        'name'         => 'show_group_hardware',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'rule_dictionnary_software',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'rule_dictionnary_dropdown',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'budget',
        'rights'       => '33'
     ], [
        'profiles_id'  => '2',
        'name'         => 'notification',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'rule_mailcollector',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'solutiontemplate',
        'rights'       => '0'
     ], [
        'profiles_id'  => '6',
        'name'         => 'solutiontemplate',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'calendar',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'slm',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'rule_dictionnary_printer',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'problem',
        'rights'       => '1057'
     ], [
        'profiles_id'  => '1',
        'name'         => 'netpoint',
        'rights'       => '0'
     ], [
        'profiles_id'  => '3',
        'name'         => 'knowbasecategory',
        'rights'       => '23'
     ], [
        'profiles_id'  => '4',
        'name'         => 'itilcategory',
        'rights'       => '23'
     ], [
        'profiles_id'  => '2',
        'name'         => 'tickettemplate',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'ticketrecurrent',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'ticketcost',
        'rights'       => '1'
     ], [
        'profiles_id'  => '4',
        'name'         => 'changevalidation',
        'rights'       => '1044'
     ], [
        'profiles_id'  => '5',
        'name'         => 'changevalidation',
        'rights'       => '20'
     ], [
        'profiles_id'  => '2',
        'name'         => 'ticketvalidation',
        'rights'       => '15376'
     ], [
        'profiles_id'  => '3',
        'name'         => 'computer',
        'rights'       => '127'
     ], [
        'profiles_id'  => '3',
        'name'         => 'monitor',
        'rights'       => '127'
     ], [
        'profiles_id'  => '3',
        'name'         => 'software',
        'rights'       => '127'
     ], [
        'profiles_id'  => '3',
        'name'         => 'networking',
        'rights'       => '127'
     ], [
        'profiles_id'  => '3',
        'name'         => 'internet',
        'rights'       => '31'
     ], [
        'profiles_id'  => '3',
        'name'         => 'printer',
        'rights'       => '127'
     ], [
        'profiles_id'  => '3',
        'name'         => 'peripheral',
        'rights'       => '127'
     ], [
        'profiles_id'  => '3',
        'name'         => 'cartridge',
        'rights'       => '127'
     ], [
        'profiles_id'  => '3',
        'name'         => 'consumable',
        'rights'       => '127'
     ], [
        'profiles_id'  => '3',
        'name'         => 'phone',
        'rights'       => '127'
     ], [
        'profiles_id'  => '4',
        'name'         => 'queuednotification',
        'rights'       => '31'
     ], [
        'profiles_id'  => '3',
        'name'         => 'contact_enterprise',
        'rights'       => '127'
     ], [
        'profiles_id'  => '3',
        'name'         => 'document',
        'rights'       => '127'
     ], [
        'profiles_id'  => '3',
        'name'         => 'contract',
        'rights'       => '127'
     ], [
        'profiles_id'  => '3',
        'name'         => 'infocom',
        'rights'       => '23'
     ], [
        'profiles_id'  => '3',
        'name'         => 'knowbase',
        'rights'       => '14359'
     ], [
        'profiles_id'  => '3',
        'name'         => 'reservation',
        'rights'       => '1055'
     ], [
        'profiles_id'  => '3',
        'name'         => 'reports',
        'rights'       => '1'
     ], [
        'profiles_id'  => '3',
        'name'         => 'dropdown',
        'rights'       => '23'
     ], [
        'profiles_id'  => '3',
        'name'         => 'device',
        'rights'       => '23'
     ], [
        'profiles_id'  => '3',
        'name'         => 'typedoc',
        'rights'       => '23'
     ], [
        'profiles_id'  => '3',
        'name'         => 'link',
        'rights'       => '23'
     ], [
        'profiles_id'  => '3',
        'name'         => 'config',
        'rights'       => '0'
     ], [
        'profiles_id'  => '3',
        'name'         => 'rule_ticket',
        'rights'       => '1047'
     ], [
        'profiles_id'  => '3',
        'name'         => 'rule_import',
        'rights'       => '0'
     ], [
        'profiles_id'  => '3',
        'name'         => 'rule_ldap',
        'rights'       => '0'
     ], [
        'profiles_id'  => '3',
        'name'         => 'rule_softwarecategories',
        'rights'       => '0'
     ], [
        'profiles_id'  => '3',
        'name'         => 'search_config',
        'rights'       => '3072'
     ], [
        'profiles_id'  => '3',
        'name'         => 'location',
        'rights'       => '23'
     ], [
        'profiles_id'  => '5',
        'name'         => 'domain',
        'rights'       => '0'
     ], [
        'profiles_id'  => '3',
        'name'         => 'profile',
        'rights'       => '1'
     ], [
        'profiles_id'  => '3',
        'name'         => 'user',
        'rights'       => '7199'
     ], [
        'profiles_id'  => '3',
        'name'         => 'group',
        'rights'       => '119'
     ], [
        'profiles_id'  => '3',
        'name'         => 'entity',
        'rights'       => '33'
     ], [
        'profiles_id'  => '3',
        'name'         => 'transfer',
        'rights'       => '1'
     ], [
        'profiles_id'  => '3',
        'name'         => 'logs',
        'rights'       => '1'
     ], [
        'profiles_id'  => '3',
        'name'         => 'reminder_public',
        'rights'       => '23'
     ], [
        'profiles_id'  => '3',
        'name'         => 'rssfeed_public',
        'rights'       => '23'
     ], [
        'profiles_id'  => '3',
        'name'         => 'bookmark_public',
        'rights'       => '23'
     ], [
        'profiles_id'  => '3',
        'name'         => 'backup',
        'rights'       => '1024'
     ], [
        'profiles_id'  => '3',
        'name'         => 'ticket',
        'rights'       => '261151'
     ], [
        'profiles_id'  => '3',
        'name'         => 'followup',
        'rights'       => '15383'
     ], [
        'profiles_id'  => '3',
        'name'         => 'task',
        'rights'       => '13329'
     ], [
        'profiles_id'  => '3',
        'name'         => 'projecttask',
        'rights'       => '1121'
     ], [
        'profiles_id'  => '4',
        'name'         => 'projecttask',
        'rights'       => '1121'
     ], [
        'profiles_id'  => '5',
        'name'         => 'projecttask',
        'rights'       => '0'
     ], [
        'profiles_id'  => '3',
        'name'         => 'planning',
        'rights'       => '3073'
     ], [
        'profiles_id'  => '7',
        'name'         => 'taskcategory',
        'rights'       => '23'
     ], [
        'profiles_id'  => '7',
        'name'         => 'netpoint',
        'rights'       => '23'
     ], [
        'profiles_id'  => '3',
        'name'         => 'statistic',
        'rights'       => '1'
     ], [
        'profiles_id'  => '3',
        'name'         => 'password_update',
        'rights'       => '1'
     ], [
        'profiles_id'  => '3',
        'name'         => 'show_group_hardware',
        'rights'       => '0'
     ], [
        'profiles_id'  => '3',
        'name'         => 'rule_dictionnary_software',
        'rights'       => '0'
     ], [
        'profiles_id'  => '3',
        'name'         => 'rule_dictionnary_dropdown',
        'rights'       => '0'
     ], [
        'profiles_id'  => '3',
        'name'         => 'budget',
        'rights'       => '127'
     ], [
        'profiles_id'  => '3',
        'name'         => 'notification',
        'rights'       => '0'
     ], [
        'profiles_id'  => '3',
        'name'         => 'rule_mailcollector',
        'rights'       => '23'
     ], [
        'profiles_id'  => '3',
        'name'         => 'solutiontemplate',
        'rights'       => '23'
     ], [
        'profiles_id'  => '4',
        'name'         => 'solutiontemplate',
        'rights'       => '23'
     ], [
        'profiles_id'  => '3',
        'name'         => 'calendar',
        'rights'       => '23'
     ], [
        'profiles_id'  => '3',
        'name'         => 'slm',
        'rights'       => '23'
     ], [
        'profiles_id'  => '3',
        'name'         => 'rule_dictionnary_printer',
        'rights'       => '0'
     ], [
        'profiles_id'  => '3',
        'name'         => 'problem',
        'rights'       => '1151'
     ], [
        'profiles_id'  => '2',
        'name'         => 'knowbasecategory',
        'rights'       => '0'
     ], [
        'profiles_id'  => '3',
        'name'         => 'itilcategory',
        'rights'       => '23'
     ], [
        'profiles_id'  => '3',
        'name'         => 'tickettemplate',
        'rights'       => '23'
     ], [
        'profiles_id'  => '3',
        'name'         => 'ticketrecurrent',
        'rights'       => '1'
     ], [
        'profiles_id'  => '3',
        'name'         => 'ticketcost',
        'rights'       => '23'
     ], [
        'profiles_id'  => '2',
        'name'         => 'changevalidation',
        'rights'       => '1044'
     ], [
        'profiles_id'  => '3',
        'name'         => 'changevalidation',
        'rights'       => '1044'
     ], [
        'profiles_id'  => '3',
        'name'         => 'ticketvalidation',
        'rights'       => '15376'
     ], [
        'profiles_id'  => '4',
        'name'         => 'computer',
        'rights'       => '255'
     ], [
        'profiles_id'  => '4',
        'name'         => 'monitor',
        'rights'       => '255'
     ], [
        'profiles_id'  => '4',
        'name'         => 'software',
        'rights'       => '255'
     ], [
        'profiles_id'  => '4',
        'name'         => 'networking',
        'rights'       => '255'
     ], [
        'profiles_id'  => '4',
        'name'         => 'internet',
        'rights'       => '159'
     ], [
        'profiles_id'  => '4',
        'name'         => 'printer',
        'rights'       => '255'
     ], [
        'profiles_id'  => '4',
        'name'         => 'peripheral',
        'rights'       => '255'
     ], [
        'profiles_id'  => '4',
        'name'         => 'cartridge',
        'rights'       => '255'
     ], [
        'profiles_id'  => '4',
        'name'         => 'consumable',
        'rights'       => '255'
     ], [
        'profiles_id'  => '4',
        'name'         => 'phone',
        'rights'       => '255'
     ], [
        'profiles_id'  => '4',
        'name'         => 'contact_enterprise',
        'rights'       => '255'
     ], [
        'profiles_id'  => '4',
        'name'         => 'document',
        'rights'       => '255'
     ], [
        'profiles_id'  => '4',
        'name'         => 'contract',
        'rights'       => '255'
     ], [
        'profiles_id'  => '4',
        'name'         => 'infocom',
        'rights'       => '23'
     ], [
        'profiles_id'  => '4',
        'name'         => 'knowbase',
        'rights'       => '15383'
     ], [
        'profiles_id'  => '4',
        'name'         => 'reservation',
        'rights'       => '1055'
     ], [
        'profiles_id'  => '4',
        'name'         => 'reports',
        'rights'       => '1'
     ], [
        'profiles_id'  => '4',
        'name'         => 'dropdown',
        'rights'       => '23'
     ], [
        'profiles_id'  => '4',
        'name'         => 'device',
        'rights'       => '23'
     ], [
        'profiles_id'  => '4',
        'name'         => 'typedoc',
        'rights'       => '23'
     ], [
        'profiles_id'  => '4',
        'name'         => 'link',
        'rights'       => '159'
     ], [
        'profiles_id'  => '4',
        'name'         => 'config',
        'rights'       => '3'
     ], [
        'profiles_id'  => '4',
        'name'         => 'rule_ticket',
        'rights'       => '1047'
     ], [
        'profiles_id'  => '4',
        'name'         => 'rule_import',
        'rights'       => '23'
     ], [
        'profiles_id'  => '4',
        'name'         => 'rule_ldap',
        'rights'       => '23'
     ], [
        'profiles_id'  => '4',
        'name'         => 'rule_softwarecategories',
        'rights'       => '23'
     ], [
        'profiles_id'  => '4',
        'name'         => 'search_config',
        'rights'       => '3072'
     ], [
        'profiles_id'  => '2',
        'name'         => 'location',
        'rights'       => '0'
     ], [
        'profiles_id'  => '4',
        'name'         => 'domain',
        'rights'       => '23'
     ], [
        'profiles_id'  => '4',
        'name'         => 'profile',
        'rights'       => '23'
     ], [
        'profiles_id'  => '4',
        'name'         => 'user',
        'rights'       => '7327'
     ], [
        'profiles_id'  => '4',
        'name'         => 'group',
        'rights'       => '119'
     ], [
        'profiles_id'  => '4',
        'name'         => 'entity',
        'rights'       => '3327'
     ], [
        'profiles_id'  => '4',
        'name'         => 'transfer',
        'rights'       => '23'
     ], [
        'profiles_id'  => '4',
        'name'         => 'logs',
        'rights'       => '1'
     ], [
        'profiles_id'  => '4',
        'name'         => 'reminder_public',
        'rights'       => '159'
     ], [
        'profiles_id'  => '4',
        'name'         => 'rssfeed_public',
        'rights'       => '159'
     ], [
        'profiles_id'  => '4',
        'name'         => 'bookmark_public',
        'rights'       => '23'
     ], [
        'profiles_id'  => '4',
        'name'         => 'backup',
        'rights'       => '1045'
     ], [
        'profiles_id'  => '4',
        'name'         => 'ticket',
        'rights'       => '261151'
     ], [
        'profiles_id'  => '4',
        'name'         => 'followup',
        'rights'       => '15383'
     ], [
        'profiles_id'  => '4',
        'name'         => 'task',
        'rights'       => '13329'
     ], [
        'profiles_id'  => '7',
        'name'         => 'project',
        'rights'       => '1151'
     ], [
        'profiles_id'  => '1',
        'name'         => 'projecttask',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'projecttask',
        'rights'       => '1025'
     ], [
        'profiles_id'  => '4',
        'name'         => 'planning',
        'rights'       => '3073'
     ], [
        'profiles_id'  => '6',
        'name'         => 'taskcategory',
        'rights'       => '0'
     ], [
        'profiles_id'  => '6',
        'name'         => 'netpoint',
        'rights'       => '0'
     ], [
        'profiles_id'  => '4',
        'name'         => 'statistic',
        'rights'       => '1'
     ], [
        'profiles_id'  => '4',
        'name'         => 'password_update',
        'rights'       => '1'
     ], [
        'profiles_id'  => '4',
        'name'         => 'show_group_hardware',
        'rights'       => '1'
     ], [
        'profiles_id'  => '4',
        'name'         => 'rule_dictionnary_software',
        'rights'       => '23'
     ], [
        'profiles_id'  => '4',
        'name'         => 'rule_dictionnary_dropdown',
        'rights'       => '23'
     ], [
        'profiles_id'  => '4',
        'name'         => 'budget',
        'rights'       => '127'
     ], [
        'profiles_id'  => '4',
        'name'         => 'notification',
        'rights'       => '23'
     ], [
        'profiles_id'  => '4',
        'name'         => 'rule_mailcollector',
        'rights'       => '23'
     ], [
        'profiles_id'  => '1',
        'name'         => 'solutiontemplate',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'solutiontemplate',
        'rights'       => '0'
     ], [
        'profiles_id'  => '4',
        'name'         => 'calendar',
        'rights'       => '23'
     ], [
        'profiles_id'  => '4',
        'name'         => 'slm',
        'rights'       => '23'
     ], [
        'profiles_id'  => '4',
        'name'         => 'rule_dictionnary_printer',
        'rights'       => '23'
     ], [
        'profiles_id'  => '4',
        'name'         => 'problem',
        'rights'       => '1151'
     ], [
        'profiles_id'  => '1',
        'name'         => 'knowbasecategory',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'itilcategory',
        'rights'       => '0'
     ], [
        'profiles_id'  => '4',
        'name'         => 'tickettemplate',
        'rights'       => '23'
     ], [
        'profiles_id'  => '4',
        'name'         => 'ticketrecurrent',
        'rights'       => '23'
     ], [
        'profiles_id'  => '4',
        'name'         => 'ticketcost',
        'rights'       => '23'
     ], [
        'profiles_id'  => '7',
        'name'         => 'change',
        'rights'       => '1151'
     ], [
        'profiles_id'  => '1',
        'name'         => 'changevalidation',
        'rights'       => '0'
     ], [
        'profiles_id'  => '4',
        'name'         => 'ticketvalidation',
        'rights'       => '15376'
     ], [
        'profiles_id'  => '5',
        'name'         => 'computer',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'monitor',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'software',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'networking',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'internet',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'printer',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'peripheral',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'cartridge',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'consumable',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'phone',
        'rights'       => '0'
     ], [
        'profiles_id'  => '3',
        'name'         => 'queuednotification',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'contact_enterprise',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'document',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'contract',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'infocom',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'knowbase',
        'rights'       => '10240'
     ], [
        'profiles_id'  => '5',
        'name'         => 'reservation',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'reports',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'dropdown',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'device',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'typedoc',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'link',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'config',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'rule_ticket',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'rule_import',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'rule_ldap',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'rule_softwarecategories',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'search_config',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'location',
        'rights'       => '0'
     ], [
        'profiles_id'  => '3',
        'name'         => 'domain',
        'rights'       => '23'
     ], [
        'profiles_id'  => '5',
        'name'         => 'profile',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'user',
        'rights'       => '1025'
     ], [
        'profiles_id'  => '5',
        'name'         => 'group',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'entity',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'transfer',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'logs',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'reminder_public',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'rssfeed_public',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'bookmark_public',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'backup',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'ticket',
        'rights'       => '140295'
     ], [
        'profiles_id'  => '5',
        'name'         => 'followup',
        'rights'       => '12295'
     ], [
        'profiles_id'  => '5',
        'name'         => 'task',
        'rights'       => '8193'
     ], [
        'profiles_id'  => '4',
        'name'         => 'project',
        'rights'       => '1151'
     ], [
        'profiles_id'  => '5',
        'name'         => 'project',
        'rights'       => '1151'
     ], [
        'profiles_id'  => '6',
        'name'         => 'project',
        'rights'       => '1151'
     ], [
        'profiles_id'  => '5',
        'name'         => 'planning',
        'rights'       => '1'
     ], [
        'profiles_id'  => '5',
        'name'         => 'taskcategory',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'netpoint',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'statistic',
        'rights'       => '1'
     ], [
        'profiles_id'  => '5',
        'name'         => 'password_update',
        'rights'       => '1'
     ], [
        'profiles_id'  => '5',
        'name'         => 'show_group_hardware',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'rule_dictionnary_software',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'rule_dictionnary_dropdown',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'budget',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'notification',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'rule_mailcollector',
        'rights'       => '0'
     ], [
        'profiles_id'  => '6',
        'name'         => 'state',
        'rights'       => '0'
     ], [
        'profiles_id'  => '7',
        'name'         => 'state',
        'rights'       => '23'
     ], [
        'profiles_id'  => '5',
        'name'         => 'calendar',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'slm',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'rule_dictionnary_printer',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'problem',
        'rights'       => '1024'
     ], [
        'profiles_id'  => '7',
        'name'         => 'knowbasecategory',
        'rights'       => '23'
     ], [
        'profiles_id'  => '1',
        'name'         => 'itilcategory',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'tickettemplate',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'ticketrecurrent',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'ticketcost',
        'rights'       => '23'
     ], [
        'profiles_id'  => '5',
        'name'         => 'change',
        'rights'       => '1054'
     ], [
        'profiles_id'  => '6',
        'name'         => 'change',
        'rights'       => '1151'
     ], [
        'profiles_id'  => '5',
        'name'         => 'ticketvalidation',
        'rights'       => '3088'
     ], [
        'profiles_id'  => '6',
        'name'         => 'computer',
        'rights'       => '127'
     ], [
        'profiles_id'  => '6',
        'name'         => 'monitor',
        'rights'       => '127'
     ], [
        'profiles_id'  => '6',
        'name'         => 'software',
        'rights'       => '127'
     ], [
        'profiles_id'  => '6',
        'name'         => 'networking',
        'rights'       => '127'
     ], [
        'profiles_id'  => '6',
        'name'         => 'internet',
        'rights'       => '31'
     ], [
        'profiles_id'  => '6',
        'name'         => 'printer',
        'rights'       => '127'
     ], [
        'profiles_id'  => '6',
        'name'         => 'peripheral',
        'rights'       => '127'
     ], [
        'profiles_id'  => '6',
        'name'         => 'cartridge',
        'rights'       => '127'
     ], [
        'profiles_id'  => '6',
        'name'         => 'consumable',
        'rights'       => '127'
     ], [
        'profiles_id'  => '6',
        'name'         => 'phone',
        'rights'       => '127'
     ], [
        'profiles_id'  => '2',
        'name'         => 'queuednotification',
        'rights'       => '0'
     ], [
        'profiles_id'  => '6',
        'name'         => 'contact_enterprise',
        'rights'       => '96'
     ], [
        'profiles_id'  => '6',
        'name'         => 'document',
        'rights'       => '127'
     ], [
        'profiles_id'  => '6',
        'name'         => 'contract',
        'rights'       => '96'
     ], [
        'profiles_id'  => '6',
        'name'         => 'infocom',
        'rights'       => '0'
     ], [
        'profiles_id'  => '6',
        'name'         => 'knowbase',
        'rights'       => '14359'
     ], [
        'profiles_id'  => '6',
        'name'         => 'reservation',
        'rights'       => '1055'
     ], [
        'profiles_id'  => '6',
        'name'         => 'reports',
        'rights'       => '1'
     ], [
        'profiles_id'  => '6',
        'name'         => 'dropdown',
        'rights'       => '0'
     ], [
        'profiles_id'  => '6',
        'name'         => 'device',
        'rights'       => '0'
     ], [
        'profiles_id'  => '6',
        'name'         => 'typedoc',
        'rights'       => '0'
     ], [
        'profiles_id'  => '6',
        'name'         => 'link',
        'rights'       => '0'
     ], [
        'profiles_id'  => '6',
        'name'         => 'config',
        'rights'       => '0'
     ], [
        'profiles_id'  => '6',
        'name'         => 'rule_ticket',
        'rights'       => '0'
     ], [
        'profiles_id'  => '6',
        'name'         => 'rule_import',
        'rights'       => '0'
     ], [
        'profiles_id'  => '6',
        'name'         => 'rule_ldap',
        'rights'       => '0'
     ], [
        'profiles_id'  => '6',
        'name'         => 'rule_softwarecategories',
        'rights'       => '0'
     ], [
        'profiles_id'  => '6',
        'name'         => 'search_config',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'domain',
        'rights'       => '0'
     ], [
        'profiles_id'  => '6',
        'name'         => 'profile',
        'rights'       => '0'
     ], [
        'profiles_id'  => '6',
        'name'         => 'user',
        'rights'       => '1055'
     ], [
        'profiles_id'  => '6',
        'name'         => 'group',
        'rights'       => '1'
     ], [
        'profiles_id'  => '6',
        'name'         => 'entity',
        'rights'       => '33'
     ], [
        'profiles_id'  => '6',
        'name'         => 'transfer',
        'rights'       => '1'
     ], [
        'profiles_id'  => '6',
        'name'         => 'logs',
        'rights'       => '0'
     ], [
        'profiles_id'  => '6',
        'name'         => 'reminder_public',
        'rights'       => '23'
     ], [
        'profiles_id'  => '6',
        'name'         => 'rssfeed_public',
        'rights'       => '23'
     ], [
        'profiles_id'  => '6',
        'name'         => 'bookmark_public',
        'rights'       => '0'
     ], [
        'profiles_id'  => '6',
        'name'         => 'backup',
        'rights'       => '0'
     ], [
        'profiles_id'  => '6',
        'name'         => 'ticket',
        'rights'       => '166919'
     ], [
        'profiles_id'  => '6',
        'name'         => 'followup',
        'rights'       => '13319'
     ], [
        'profiles_id'  => '6',
        'name'         => 'task',
        'rights'       => '13329'
     ], [
        'profiles_id'  => '1',
        'name'         => 'project',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'project',
        'rights'       => '1025'
     ], [
        'profiles_id'  => '3',
        'name'         => 'project',
        'rights'       => '1151'
     ], [
        'profiles_id'  => '6',
        'name'         => 'planning',
        'rights'       => '1'
     ], [
        'profiles_id'  => '4',
        'name'         => 'taskcategory',
        'rights'       => '23'
     ], [
        'profiles_id'  => '4',
        'name'         => 'netpoint',
        'rights'       => '23'
     ], [
        'profiles_id'  => '6',
        'name'         => 'statistic',
        'rights'       => '1'
     ], [
        'profiles_id'  => '6',
        'name'         => 'password_update',
        'rights'       => '1'
     ], [
        'profiles_id'  => '6',
        'name'         => 'show_group_hardware',
        'rights'       => '0'
     ], [
        'profiles_id'  => '6',
        'name'         => 'rule_dictionnary_software',
        'rights'       => '0'
     ], [
        'profiles_id'  => '6',
        'name'         => 'rule_dictionnary_dropdown',
        'rights'       => '0'
     ], [
        'profiles_id'  => '6',
        'name'         => 'budget',
        'rights'       => '96'
     ], [
        'profiles_id'  => '6',
        'name'         => 'notification',
        'rights'       => '0'
     ], [
        'profiles_id'  => '6',
        'name'         => 'rule_mailcollector',
        'rights'       => '0'
     ], [
        'profiles_id'  => '4',
        'name'         => 'state',
        'rights'       => '23'
     ], [
        'profiles_id'  => '5',
        'name'         => 'state',
        'rights'       => '0'
     ], [
        'profiles_id'  => '6',
        'name'         => 'calendar',
        'rights'       => '0'
     ], [
        'profiles_id'  => '6',
        'name'         => 'slm',
        'rights'       => '1'
     ], [
        'profiles_id'  => '6',
        'name'         => 'rule_dictionnary_printer',
        'rights'       => '0'
     ], [
        'profiles_id'  => '6',
        'name'         => 'problem',
        'rights'       => '1121'
     ], [
        'profiles_id'  => '6',
        'name'         => 'knowbasecategory',
        'rights'       => '0'
     ], [
        'profiles_id'  => '7',
        'name'         => 'itilcategory',
        'rights'       => '23'
     ], [
        'profiles_id'  => '7',
        'name'         => 'location',
        'rights'       => '23'
     ], [
        'profiles_id'  => '6',
        'name'         => 'tickettemplate',
        'rights'       => '1'
     ], [
        'profiles_id'  => '6',
        'name'         => 'ticketrecurrent',
        'rights'       => '1'
     ], [
        'profiles_id'  => '6',
        'name'         => 'ticketcost',
        'rights'       => '23'
     ], [
        'profiles_id'  => '3',
        'name'         => 'change',
        'rights'       => '1151'
     ], [
        'profiles_id'  => '4',
        'name'         => 'change',
        'rights'       => '1151'
     ], [
        'profiles_id'  => '6',
        'name'         => 'ticketvalidation',
        'rights'       => '3088'
     ], [
        'profiles_id'  => '7',
        'name'         => 'computer',
        'rights'       => '127'
     ], [
        'profiles_id'  => '7',
        'name'         => 'monitor',
        'rights'       => '127'
     ], [
        'profiles_id'  => '7',
        'name'         => 'software',
        'rights'       => '127'
     ], [
        'profiles_id'  => '7',
        'name'         => 'networking',
        'rights'       => '127'
     ], [
        'profiles_id'  => '7',
        'name'         => 'internet',
        'rights'       => '31'
     ], [
        'profiles_id'  => '7',
        'name'         => 'printer',
        'rights'       => '127'
     ], [
        'profiles_id'  => '7',
        'name'         => 'peripheral',
        'rights'       => '127'
     ], [
        'profiles_id'  => '7',
        'name'         => 'cartridge',
        'rights'       => '127'
     ], [
        'profiles_id'  => '7',
        'name'         => 'consumable',
        'rights'       => '127'
     ], [
        'profiles_id'  => '7',
        'name'         => 'phone',
        'rights'       => '127'
     ], [
        'profiles_id'  => '1',
        'name'         => 'queuednotification',
        'rights'       => '0'
     ], [
        'profiles_id'  => '7',
        'name'         => 'contact_enterprise',
        'rights'       => '96'
     ], [
        'profiles_id'  => '7',
        'name'         => 'document',
        'rights'       => '127'
     ], [
        'profiles_id'  => '7',
        'name'         => 'contract',
        'rights'       => '96'
     ], [
        'profiles_id'  => '7',
        'name'         => 'infocom',
        'rights'       => '0'
     ], [
        'profiles_id'  => '7',
        'name'         => 'knowbase',
        'rights'       => '14359'
     ], [
        'profiles_id'  => '7',
        'name'         => 'reservation',
        'rights'       => '1055'
     ], [
        'profiles_id'  => '7',
        'name'         => 'reports',
        'rights'       => '1'
     ], [
        'profiles_id'  => '7',
        'name'         => 'dropdown',
        'rights'       => '0'
     ], [
        'profiles_id'  => '7',
        'name'         => 'device',
        'rights'       => '0'
     ], [
        'profiles_id'  => '7',
        'name'         => 'typedoc',
        'rights'       => '0'
     ], [
        'profiles_id'  => '7',
        'name'         => 'link',
        'rights'       => '0'
     ], [
        'profiles_id'  => '7',
        'name'         => 'config',
        'rights'       => '0'
     ], [
        'profiles_id'  => '7',
        'name'         => 'rule_ticket',
        'rights'       => '1047'
     ], [
        'profiles_id'  => '7',
        'name'         => 'rule_import',
        'rights'       => '0'
     ], [
        'profiles_id'  => '7',
        'name'         => 'rule_ldap',
        'rights'       => '0'
     ], [
        'profiles_id'  => '7',
        'name'         => 'rule_softwarecategories',
        'rights'       => '0'
     ], [
        'profiles_id'  => '7',
        'name'         => 'search_config',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'domain',
        'rights'       => '0'
     ], [
        'profiles_id'  => '7',
        'name'         => 'profile',
        'rights'       => '0'
     ], [
        'profiles_id'  => '7',
        'name'         => 'user',
        'rights'       => '1055'
     ], [
        'profiles_id'  => '7',
        'name'         => 'group',
        'rights'       => '1'
     ], [
        'profiles_id'  => '7',
        'name'         => 'entity',
        'rights'       => '33'
     ], [
        'profiles_id'  => '7',
        'name'         => 'transfer',
        'rights'       => '1'
     ], [
        'profiles_id'  => '7',
        'name'         => 'logs',
        'rights'       => '1'
     ], [
        'profiles_id'  => '7',
        'name'         => 'reminder_public',
        'rights'       => '23'
     ], [
        'profiles_id'  => '7',
        'name'         => 'rssfeed_public',
        'rights'       => '23'
     ], [
        'profiles_id'  => '7',
        'name'         => 'bookmark_public',
        'rights'       => '0'
     ], [
        'profiles_id'  => '7',
        'name'         => 'backup',
        'rights'       => '0'
     ], [
        'profiles_id'  => '7',
        'name'         => 'ticket',
        'rights'       => '261151'
     ], [
        'profiles_id'  => '7',
        'name'         => 'followup',
        'rights'       => '15383'
     ], [
        'profiles_id'  => '7',
        'name'         => 'task',
        'rights'       => '13329'
     ], [
        'profiles_id'  => '7',
        'name'         => 'queuednotification',
        'rights'       => '0'
     ], [
        'profiles_id'  => '7',
        'name'         => 'planning',
        'rights'       => '3073'
     ], [
        'profiles_id'  => '3',
        'name'         => 'taskcategory',
        'rights'       => '23'
     ], [
        'profiles_id'  => '3',
        'name'         => 'netpoint',
        'rights'       => '23'
     ], [
        'profiles_id'  => '7',
        'name'         => 'statistic',
        'rights'       => '1'
     ], [
        'profiles_id'  => '7',
        'name'         => 'password_update',
        'rights'       => '1'
     ], [
        'profiles_id'  => '7',
        'name'         => 'show_group_hardware',
        'rights'       => '0'
     ], [
        'profiles_id'  => '7',
        'name'         => 'rule_dictionnary_software',
        'rights'       => '0'
     ], [
        'profiles_id'  => '7',
        'name'         => 'rule_dictionnary_dropdown',
        'rights'       => '0'
     ], [
        'profiles_id'  => '7',
        'name'         => 'budget',
        'rights'       => '96'
     ], [
        'profiles_id'  => '7',
        'name'         => 'notification',
        'rights'       => '0'
     ], [
        'profiles_id'  => '7',
        'name'         => 'rule_mailcollector',
        'rights'       => '23'
     ], [
        'profiles_id'  => '7',
        'name'         => 'changevalidation',
        'rights'       => '1044'
     ], [
        'profiles_id'  => '3',
        'name'         => 'state',
        'rights'       => '23'
     ], [
        'profiles_id'  => '7',
        'name'         => 'calendar',
        'rights'       => '23'
     ], [
        'profiles_id'  => '7',
        'name'         => 'slm',
        'rights'       => '23'
     ], [
        'profiles_id'  => '7',
        'name'         => 'rule_dictionnary_printer',
        'rights'       => '0'
     ], [
        'profiles_id'  => '7',
        'name'         => 'problem',
        'rights'       => '1151'
     ], [
        'profiles_id'  => '5',
        'name'         => 'knowbasecategory',
        'rights'       => '0'
     ], [
        'profiles_id'  => '6',
        'name'         => 'itilcategory',
        'rights'       => '0'
     ], [
        'profiles_id'  => '6',
        'name'         => 'location',
        'rights'       => '0'
     ], [
        'profiles_id'  => '7',
        'name'         => 'tickettemplate',
        'rights'       => '23'
     ], [
        'profiles_id'  => '7',
        'name'         => 'ticketrecurrent',
        'rights'       => '1'
     ], [
        'profiles_id'  => '7',
        'name'         => 'ticketcost',
        'rights'       => '23'
     ], [
        'profiles_id'  => '1',
        'name'         => 'change',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'change',
        'rights'       => '1057'
     ], [
        'profiles_id'  => '7',
        'name'         => 'ticketvalidation',
        'rights'       => '15376'
     ], [
        'profiles_id'  => '8',
        'name'         => 'backup',
        'rights'       => '1'
     ], [
        'profiles_id'  => '8',
        'name'         => 'bookmark_public',
        'rights'       => '1'
     ], [
        'profiles_id'  => '8',
        'name'         => 'budget',
        'rights'       => '33'
     ], [
        'profiles_id'  => '8',
        'name'         => 'calendar',
        'rights'       => '1'
     ], [
        'profiles_id'  => '8',
        'name'         => 'cartridge',
        'rights'       => '33'
     ], [
        'profiles_id'  => '8',
        'name'         => 'change',
        'rights'       => '1057'
     ], [
        'profiles_id'  => '8',
        'name'         => 'changevalidation',
        'rights'       => '0'
     ], [
        'profiles_id'  => '8',
        'name'         => 'computer',
        'rights'       => '33'
     ], [
        'profiles_id'  => '8',
        'name'         => 'config',
        'rights'       => '1'
     ], [
        'profiles_id'  => '8',
        'name'         => 'consumable',
        'rights'       => '33'
     ], [
        'profiles_id'  => '8',
        'name'         => 'contact_enterprise',
        'rights'       => '33'
     ], [
        'profiles_id'  => '8',
        'name'         => 'contract',
        'rights'       => '33'
     ], [
        'profiles_id'  => '8',
        'name'         => 'device',
        'rights'       => '1'
     ], [
        'profiles_id'  => '8',
        'name'         => 'document',
        'rights'       => '33'
     ], [
        'profiles_id'  => '8',
        'name'         => 'domain',
        'rights'       => '1'
     ], [
        'profiles_id'  => '8',
        'name'         => 'dropdown',
        'rights'       => '1'
     ], [
        'profiles_id'  => '8',
        'name'         => 'entity',
        'rights'       => '33'
     ], [
        'profiles_id'  => '8',
        'name'         => 'followup',
        'rights'       => '8193'
     ], [
        'profiles_id'  => '8',
        'name'         => 'global_validation',
        'rights'       => '0'
     ], [
        'profiles_id'  => '8',
        'name'         => 'group',
        'rights'       => '33'
     ], [
        'profiles_id'  => '8',
        'name'         => 'infocom',
        'rights'       => '1'
     ], [
        'profiles_id'  => '8',
        'name'         => 'internet',
        'rights'       => '1'
     ], [
        'profiles_id'  => '8',
        'name'         => 'itilcategory',
        'rights'       => '1'
     ], [
        'profiles_id'  => '8',
        'name'         => 'knowbase',
        'rights'       => '10241'
     ], [
        'profiles_id'  => '8',
        'name'         => 'knowbasecategory',
        'rights'       => '1'
     ], [
        'profiles_id'  => '8',
        'name'         => 'link',
        'rights'       => '1'
     ], [
        'profiles_id'  => '8',
        'name'         => 'location',
        'rights'       => '1'
     ], [
        'profiles_id'  => '8',
        'name'         => 'logs',
        'rights'       => '1'
     ], [
        'profiles_id'  => '8',
        'name'         => 'monitor',
        'rights'       => '33'
     ], [
        'profiles_id'  => '8',
        'name'         => 'netpoint',
        'rights'       => '1'
     ], [
        'profiles_id'  => '8',
        'name'         => 'networking',
        'rights'       => '33'
     ], [
        'profiles_id'  => '8',
        'name'         => 'notification',
        'rights'       => '1'
     ], [
        'profiles_id'  => '8',
        'name'         => 'password_update',
        'rights'       => '0'
     ], [
        'profiles_id'  => '8',
        'name'         => 'peripheral',
        'rights'       => '33'
     ], [
        'profiles_id'  => '8',
        'name'         => 'phone',
        'rights'       => '33'
     ], [
        'profiles_id'  => '8',
        'name'         => 'planning',
        'rights'       => '3073'
     ], [
        'profiles_id'  => '8',
        'name'         => 'printer',
        'rights'       => '33'
     ], [
        'profiles_id'  => '8',
        'name'         => 'problem',
        'rights'       => '1057'
     ], [
        'profiles_id'  => '8',
        'name'         => 'profile',
        'rights'       => '1'
     ], [
        'profiles_id'  => '8',
        'name'         => 'project',
        'rights'       => '1057'
     ], [
        'profiles_id'  => '8',
        'name'         => 'projecttask',
        'rights'       => '33'
     ], [
        'profiles_id'  => '8',
        'name'         => 'queuednotification',
        'rights'       => '1'
     ], [
        'profiles_id'  => '8',
        'name'         => 'reminder_public',
        'rights'       => '1'
     ], [
        'profiles_id'  => '8',
        'name'         => 'reports',
        'rights'       => '1'
     ], [
        'profiles_id'  => '8',
        'name'         => 'reservation',
        'rights'       => '1'
     ], [
        'profiles_id'  => '8',
        'name'         => 'rssfeed_public',
        'rights'       => '1'
     ], [
        'profiles_id'  => '8',
        'name'         => 'rule_dictionnary_dropdown',
        'rights'       => '1'
     ], [
        'profiles_id'  => '8',
        'name'         => 'rule_dictionnary_printer',
        'rights'       => '1'
     ], [
        'profiles_id'  => '8',
        'name'         => 'rule_dictionnary_software',
        'rights'       => '1'
     ], [
        'profiles_id'  => '8',
        'name'         => 'rule_import',
        'rights'       => '1'
     ], [
        'profiles_id'  => '8',
        'name'         => 'rule_ldap',
        'rights'       => '1'
     ], [
        'profiles_id'  => '8',
        'name'         => 'rule_mailcollector',
        'rights'       => '1'
     ], [
        'profiles_id'  => '8',
        'name'         => 'rule_softwarecategories',
        'rights'       => '1'
     ], [
        'profiles_id'  => '8',
        'name'         => 'rule_ticket',
        'rights'       => '1'
     ], [
        'profiles_id'  => '8',
        'name'         => 'search_config',
        'rights'       => '0'
     ], [
        'profiles_id'  => '8',
        'name'         => 'show_group_hardware',
        'rights'       => '1'
     ], [
        'profiles_id'  => '8',
        'name'         => 'slm',
        'rights'       => '1'
     ], [
        'profiles_id'  => '8',
        'name'         => 'software',
        'rights'       => '33'
     ], [
        'profiles_id'  => '8',
        'name'         => 'solutiontemplate',
        'rights'       => '1'
     ], [
        'profiles_id'  => '8',
        'name'         => 'state',
        'rights'       => '1'
     ], [
        'profiles_id'  => '8',
        'name'         => 'statistic',
        'rights'       => '1'
     ], [
        'profiles_id'  => '8',
        'name'         => 'task',
        'rights'       => '8193'
     ], [
        'profiles_id'  => '8',
        'name'         => 'taskcategory',
        'rights'       => '1'
     ], [
        'profiles_id'  => '8',
        'name'         => 'ticket',
        'rights'       => '138241'
     ], [
        'profiles_id'  => '8',
        'name'         => 'ticketcost',
        'rights'       => '1'
     ], [
        'profiles_id'  => '8',
        'name'         => 'ticketrecurrent',
        'rights'       => '1'
     ], [
        'profiles_id'  => '8',
        'name'         => 'tickettemplate',
        'rights'       => '1'
     ], [
        'profiles_id'  => '8',
        'name'         => 'ticketvalidation',
        'rights'       => '0'
     ], [
        'profiles_id'  => '8',
        'name'         => 'transfer',
        'rights'       => '1'
     ], [
        'profiles_id'  => '8',
        'name'         => 'typedoc',
        'rights'       => '1'
     ], [
        'profiles_id'  => '8',
        'name'         => 'user',
        'rights'       => '1'
     ], [
        'profiles_id'  => '1',
        'name'         => 'license',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'license',
        'rights'       => '33'
     ], [
        'profiles_id'  => '3',
        'name'         => 'license',
        'rights'       => '127'
     ], [
        'profiles_id'  => '4',
        'name'         => 'license',
        'rights'       => '255'
     ], [
        'profiles_id'  => '5',
        'name'         => 'license',
        'rights'       => '0'
     ], [
        'profiles_id'  => '6',
        'name'         => 'license',
        'rights'       => '127'
     ], [
        'profiles_id'  => '7',
        'name'         => 'license',
        'rights'       => '127'
     ], [
        'profiles_id'  => '8',
        'name'         => 'license',
        'rights'       => '33'
     ], [
        'profiles_id'  => '1',
        'name'         => 'line',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'line',
        'rights'       => '33'
     ], [
        'profiles_id'  => '3',
        'name'         => 'line',
        'rights'       => '127'
     ], [
        'profiles_id'  => '4',
        'name'         => 'line',
        'rights'       => '255'
     ], [
        'profiles_id'  => '5',
        'name'         => 'line',
        'rights'       => '0'
     ], [
        'profiles_id'  => '6',
        'name'         => 'line',
        'rights'       => '127'
     ], [
        'profiles_id'  => '7',
        'name'         => 'line',
        'rights'       => '127'
     ], [
        'profiles_id'  => '8',
        'name'         => 'line',
        'rights'       => '33'
     ], [
        'profiles_id'  => '1',
        'name'         => 'lineoperator',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'lineoperator',
        'rights'       => '33'
     ], [
        'profiles_id'  => '3',
        'name'         => 'lineoperator',
        'rights'       => '23'
     ], [
        'profiles_id'  => '4',
        'name'         => 'lineoperator',
        'rights'       => '23'
     ], [
        'profiles_id'  => '5',
        'name'         => 'lineoperator',
        'rights'       => '0'
     ], [
        'profiles_id'  => '6',
        'name'         => 'lineoperator',
        'rights'       => '0'
     ], [
        'profiles_id'  => '7',
        'name'         => 'lineoperator',
        'rights'       => '23'
     ], [
        'profiles_id'  => '8',
        'name'         => 'lineoperator',
        'rights'       => '1'
     ], [
        'profiles_id'  => '1',
        'name'         => 'devicesimcard_pinpuk',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'devicesimcard_pinpuk',
        'rights'       => '1'
     ], [
        'profiles_id'  => '3',
        'name'         => 'devicesimcard_pinpuk',
        'rights'       => '3'
     ], [
        'profiles_id'  => '4',
        'name'         => 'devicesimcard_pinpuk',
        'rights'       => '3'
     ], [
        'profiles_id'  => '5',
        'name'         => 'devicesimcard_pinpuk',
        'rights'       => '0'
     ], [
        'profiles_id'  => '6',
        'name'         => 'devicesimcard_pinpuk',
        'rights'       => '3'
     ], [
        'profiles_id'  => '7',
        'name'         => 'devicesimcard_pinpuk',
        'rights'       => '3'
     ], [
        'profiles_id'  => '8',
        'name'         => 'devicesimcard_pinpuk',
        'rights'       => '1'
     ], [
        'profiles_id'  => '1',
        'name'         => 'certificate',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'certificate',
        'rights'       => '33'
     ], [
        'profiles_id'  => '3',
        'name'         => 'certificate',
        'rights'       => '127'
     ], [
        'profiles_id'  => '4',
        'name'         => 'certificate',
        'rights'       => '255'
     ], [
        'profiles_id'  => '5',
        'name'         => 'certificate',
        'rights'       => '0'
     ], [
        'profiles_id'  => '6',
        'name'         => 'certificate',
        'rights'       => '127'
     ], [
        'profiles_id'  => '7',
        'name'         => 'certificate',
        'rights'       => '127'
     ], [
        'profiles_id'  => '8',
        'name'         => 'certificate',
        'rights'       => '33'
     ], [
        'profiles_id'  => '1',
        'name'         => 'datacenter',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'datacenter',
        'rights'       => '1'
     ], [
        'profiles_id'  => '3',
        'name'         => 'datacenter',
        'rights'       => '31'
     ], [
        'profiles_id'  => '4',
        'name'         => 'datacenter',
        'rights'       => '31'
     ], [
        'profiles_id'  => '5',
        'name'         => 'datacenter',
        'rights'       => '0'
     ], [
        'profiles_id'  => '6',
        'name'         => 'datacenter',
        'rights'       => '31'
     ], [
        'profiles_id'  => '7',
        'name'         => 'datacenter',
        'rights'       => '31'
     ], [
        'profiles_id'  => '8',
        'name'         => 'datacenter',
        'rights'       => '1'
     ], [
        'profiles_id'  => '4',
        'name'         => 'rule_asset',
        'rights'       => '1047'
     ], [
        'profiles_id'  => '1',
        'name'         => 'personalization',
        'rights'       => '3'
     ], [
        'profiles_id'  => '2',
        'name'         => 'personalization',
        'rights'       => '3'
     ], [
        'profiles_id'  => '3',
        'name'         => 'personalization',
        'rights'       => '3'
     ], [
        'profiles_id'  => '4',
        'name'         => 'personalization',
        'rights'       => '3'
     ], [
        'profiles_id'  => '5',
        'name'         => 'personalization',
        'rights'       => '3'
     ], [
        'profiles_id'  => '6',
        'name'         => 'personalization',
        'rights'       => '3'
     ], [
        'profiles_id'  => '7',
        'name'         => 'personalization',
        'rights'       => '3'
     ], [
        'profiles_id'  => '8',
        'name'         => 'personalization',
        'rights'       => '3'
     ], [
        'profiles_id'  => '1',
        'name'         => 'rule_asset',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'rule_asset',
        'rights'       => '0'
     ], [
        'profiles_id'  => '3',
        'name'         => 'rule_asset',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'rule_asset',
        'rights'       => '0'
     ], [
        'profiles_id'  => '6',
        'name'         => 'rule_asset',
        'rights'       => '0'
     ], [
        'profiles_id'  => '7',
        'name'         => 'rule_asset',
        'rights'       => '0'
     ], [
        'profiles_id'  => '8',
        'name'         => 'rule_asset',
        'rights'       => '0'
     ], [
        'profiles_id'  => '1',
        'name'         => 'global_validation',
        'rights'       => '0'
     ], [
        'profiles_id'  => '2',
        'name'         => 'global_validation',
        'rights'       => '0'
     ], [
        'profiles_id'  => '3',
        'name'         => 'global_validation',
        'rights'       => '0'
     ], [
        'profiles_id'  => '4',
        'name'         => 'global_validation',
        'rights'       => '0'
     ], [
        'profiles_id'  => '5',
        'name'         => 'global_validation',
        'rights'       => '0'
     ], [
        'profiles_id'  => '6',
        'name'         => 'global_validation',
        'rights'       => '0'
     ], [
        'profiles_id'  => '7',
        'name'         => 'global_validation',
        'rights'       => '0'
     ]
   ];

   $tables['glpi_profiles'] = [
     [
        'id'                       => '1',
        'name'                     => 'Self-Service',
        'interface'                => 'helpdesk',
        'is_default'               => '1',
        'helpdesk_hardware'        => '1',
        'helpdesk_item_type'       => '["Computer","Monitor","NetworkEquipment","Peripheral","Phone","Printer","Software", "DCRoom", "Rack", "Enclosure"]',
        'ticket_status'            => '{"1":{"2":0,"3":0,"4":0,"5":0,"6":0},"2":{"1":0,"3":0,"4":0,"5":0,"6":0},"3":{"1":0,"2":0,"4":0,"5":0,"6":0},"4":{"1":0,"2":0,"3":0,"5":0,"6":0},"5":{"1":0,"2":0,"3":0,"4":0},"6":{"1":0,"2":0,"3":0,"4":0,"5":0}}',
        'comment'                  => '',
        'problem_status'           => '[]',
        'create_ticket_on_login'   => '0',
        'tickettemplates_id'       => '0',
        'change_status'            => null
     ], [
        'id'                       => '2',
        'name'                     => 'Observer',
        'interface'                => 'central',
        'is_default'               => '0',
        'helpdesk_hardware'        => '1',
        'helpdesk_item_type'       => '["Computer","Monitor","NetworkEquipment","Peripheral","Phone","Printer","Software", "DCRoom", "Rack", "Enclosure"]',
        'ticket_status'            => '[]',
        'comment'                  => '',
        'problem_status'           => '[]',
        'create_ticket_on_login'   => '0',
        'tickettemplates_id'       => '0',
        'change_status'            => null
     ], [
        'id'                       => '3',
        'name'                     => 'Admin',
        'interface'                => 'central',
        'is_default'               => '0',
        'helpdesk_hardware'        => '3',
        'helpdesk_item_type'       => '["Computer","Monitor","NetworkEquipment","Peripheral","Phone","Printer","Software", "DCRoom", "Rack", "Enclosure"]',
        'ticket_status'            => '[]',
        'comment'                  => '',
        'problem_status'           => '[]',
        'create_ticket_on_login'   => '0',
        'tickettemplates_id'       => '0',
        'change_status'            => null
     ], [
        'id'                       => '4',
        'name'                     => 'Super-Admin',
        'interface'                => 'central',
        'is_default'               => '0',
        'helpdesk_hardware'        => '3',
        'helpdesk_item_type'       => '["Computer","Monitor","NetworkEquipment","Peripheral","Phone","Printer","Software", "DCRoom", "Rack", "Enclosure"]',
        'ticket_status'            => '[]',
        'comment'                  => '',
        'problem_status'           => '[]',
        'create_ticket_on_login'   => '0',
        'tickettemplates_id'       => '0',
        'change_status'            => null
     ], [
        'id'                       => '5',
        'name'                     => 'Hotliner',
        'interface'                => 'central',
        'is_default'               => '0',
        'helpdesk_hardware'        => '3',
        'helpdesk_item_type'       => '["Computer","Monitor","NetworkEquipment","Peripheral","Phone","Printer","Software", "DCRoom", "Rack", "Enclosure"]',
        'ticket_status'            => '[]',
        'comment'                  => '',
        'problem_status'           => '[]',
        'create_ticket_on_login'   => '1',
        'tickettemplates_id'       => '0',
        'change_status'            => null
     ], [
        'id'                       => '6',
        'name'                     => 'Technician',
        'interface'                => 'central',
        'is_default'               => '0',
        'helpdesk_hardware'        => '3',
        'helpdesk_item_type'       => '["Computer","Monitor","NetworkEquipment","Peripheral","Phone","Printer","Software", "DCRoom", "Rack", "Enclosure"]',
        'ticket_status'            => '[]',
        'comment'                  => '',
        'problem_status'           => '[]',
        'create_ticket_on_login'   => '0',
        'tickettemplates_id'       => '0',
        'change_status'            => null
     ], [
        'id'                       => '7',
        'name'                     => 'Supervisor',
        'interface'                => 'central',
        'is_default'               => '0',
        'helpdesk_hardware'        => '3',
        'helpdesk_item_type'       => '["Computer","Monitor","NetworkEquipment","Peripheral","Phone","Printer","Software", "DCRoom", "Rack", "Enclosure"]',
        'ticket_status'            => '[]',
        'comment'                  => '',
        'problem_status'           => '[]',
        'create_ticket_on_login'   => '0',
        'tickettemplates_id'       => '0',
        'change_status'            => null
     ], [
        'id'                       => '8',
        'name'                     => 'Read-Only',
        'interface'                => 'central',
        'is_default'               => '0',
        'helpdesk_hardware'        => '0',
        'helpdesk_item_type'       => '[]',
        'ticket_status'            => '{"1":{"2":0,"3":0,"4":0,"5":0,"6":0},
                         "2":{"1":0,"3":0,"4":0,"5":0,"6":0},
                         "3":{"1":0,"2":0,"4":0,"5":0,"6":0},
                         "4":{"1":0,"2":0,"3":0,"5":0,"6":0},
                         "5":{"1":0,"2":0,"3":0,"4":0,"6":0},
                         "6":{"1":0,"2":0,"3":0,"4":0,"5":0}}',
        'comment'                  => 'This profile defines read-only access. It is used when objects are locked. It can also be used to give to users rights to unlock objects.',
        'problem_status'           => '{"1":{"7":0,"2":0,"3":0,"4":0,"5":0,"8":0,"6":0},
                        "7":{"1":0,"2":0,"3":0,"4":0,"5":0,"8":0,"6":0},
                        "2":{"1":0,"7":0,"3":0,"4":0,"5":0,"8":0,"6":0},
                        "3":{"1":0,"7":0,"2":0,"4":0,"5":0,"8":0,"6":0},
                        "4":{"1":0,"7":0,"2":0,"3":0,"5":0,"8":0,"6":0},
                        "5":{"1":0,"7":0,"2":0,"3":0,"4":0,"8":0,"6":0},
                        "8":{"1":0,"7":0,"2":0,"3":0,"4":0,"5":0,"6":0},
                        "6":{"1":0,"7":0,"2":0,"3":0,"4":0,"5":0,"8":0}}',
        'create_ticket_on_login'   => '0',
        'tickettemplates_id'       => '0',
        'change_status'            => '{"1":{"9":0,"10":0,"7":0,"4":0,"11":0,"12":0,"5":0,"8":0,"6":0},
                         "9":{"1":0,"10":0,"7":0,"4":0,"11":0,"12":0,"5":0,"8":0,"6":0},
                         "10":{"1":0,"9":0,"7":0,"4":0,"11":0,"12":0,"5":0,"8":0,"6":0},
                         "7":{"1":0,"9":0,"10":0,"4":0,"11":0,"12":0,"5":0,"8":0,"6":0},
                         "4":{"1":0,"9":0,"10":0,"7":0,"11":0,"12":0,"5":0,"8":0,"6":0},
                         "11":{"1":0,"9":0,"10":0,"7":0,"4":0,"12":0,"5":0,"8":0,"6":0},
                         "12":{"1":0,"9":0,"10":0,"7":0,"4":0,"11":0,"5":0,"8":0,"6":0},
                         "5":{"1":0,"9":0,"10":0,"7":0,"4":0,"11":0,"12":0,"8":0,"6":0},
                         "8":{"1":0,"9":0,"10":0,"7":0,"4":0,"11":0,"12":0,"5":0,"6":0},
                         "6":{"1":0,"9":0,"10":0,"7":0,"4":0,"11":0,"12":0,"5":0,"8":0}}'
     ]
   ];

   $tables['glpi_profiles_users'] = [
     [
        'id'           => '2',
        'users_id'     => '2',
        'profiles_id'  => '4',
        'entities_id'  => '0',
        'is_recursive' => '1',
        'is_dynamic'   => '0'
     ], [
        'id'           => '3',
        'users_id'     => '3',
        'profiles_id'  => '1',
        'entities_id'  => '0',
        'is_recursive' => '1',
        'is_dynamic'   => '0'
     ], [
        'id'           => '4',
        'users_id'     => '4',
        'profiles_id'  => '6',
        'entities_id'  => '0',
        'is_recursive' => '1',
        'is_dynamic'   => '0'
     ], [
        'id'           => '5',
        'users_id'     => '5',
        'profiles_id'  => '2',
        'entities_id'  => '0',
        'is_recursive' => '1',
        'is_dynamic'   => '0'
     ]
   ];

   $tables['glpi_projectstates'] = [
     [
        'id'           => '1',
        'name'         => 'New',
        'color'        => '#06ff00',
        'is_finished'  => '0'
     ], [
        'id'           => '2',
        'name'         => 'Processing',
        'color'        => '#ffb800',
        'is_finished'  => '0'
     ], [
        'id'           => '3',
        'name'         => 'Closed',
        'color'        => '#ff0000',
        'is_finished'  => '1'
     ]
   ];

   $tables['glpi_requesttypes'] = [
     [
        'id'                       => '1',
        'name'                     => 'Helpdesk',
        'is_helpdesk_default'      => '1',
        'is_followup_default'      => '1',
        'is_mail_default'          => '0',
        'is_mailfollowup_default'  => '0'
     ], [
        'id'                       => '2',
        'name'                     => 'E-Mail',
        'is_helpdesk_default'      => '0',
        'is_followup_default'      => '0',
        'is_mail_default'          => '1',
        'is_mailfollowup_default'  => '1'
     ], [
        'id'                       => '3',
        'name'                     => 'Phone',
        'is_helpdesk_default'      => '0',
        'is_followup_default'      => '0',
        'is_mail_default'          => '0',
        'is_mailfollowup_default'  => '0'
     ], [
        'id'                       => '4',
        'name'                     => 'Direct',
        'is_helpdesk_default'      => '0',
        'is_followup_default'      => '0',
        'is_mail_default'          => '0',
        'is_mailfollowup_default'  => '0'
     ], [
        'id'                       => '5',
        'name'                     => 'Written',
        'is_helpdesk_default'      => '0',
        'is_followup_default'      => '0',
        'is_mail_default'          => '0',
        'is_mailfollowup_default'  => '0'
     ], [
        'id'                       => '6',
        'name'                     => 'Other',
        'is_helpdesk_default'      => '0',
        'is_followup_default'      => '0',
        'is_mail_default'          => '0',
        'is_mailfollowup_default'  => '0'
     ]
   ];

   $tables['glpi_ruleactions'] = [
     [
        'id'           => '6',
        'rules_id'     => '6',
        'action_type'  => 'fromitem',
        'field'        => 'locations_id',
        'value'        => '1'
     ], [
        'id'           => '2',
        'rules_id'     => '2',
        'action_type'  => 'assign',
        'field'        => 'entities_id',
        'value'        => '0'
     ], [
        'id'           => '3',
        'rules_id'     => '3',
        'action_type'  => 'assign',
        'field'        => 'entities_id',
        'value'        => '0'
     ], [
        'id'           => '4',
        'rules_id'     => '4',
        'action_type'  => 'assign',
        'field'        => '_refuse_email_no_response',
        'value'        => '1'
     ], [
        'id'           => '5',
        'rules_id'     => '5',
        'action_type'  => 'assign',
        'field'        => '_refuse_email_no_response',
        'value'        => '1'
     ], [
        'id'           => '7',
        'rules_id'     => '7',
        'action_type'  => 'fromuser',
        'field'        => 'locations_id',
        'value'        => '1'
     ], [
        'id'           => '8',
        'rules_id'     => '8',
        'action_type'  => 'assign',
        'field'        => '_import_category',
        'value'        => '1'
     ], [
        'id'           => '9',
        'rules_id'     => '9',
        'action_type'  => 'regex_result',
        'field'        => '_affect_user_by_regex',
        'value'        => '#0'
     ], [
        'id'           => '10',
        'rules_id'     => '10',
        'action_type'  => 'regex_result',
        'field'        => '_affect_user_by_regex',
        'value'        => '#0'
     ], [
        'id'           => '11',
        'rules_id'     => '11',
        'action_type'  => 'regex_result',
        'field'        => '_affect_user_by_regex',
        'value'        => '#0'
     ]
   ];

   $tables['glpi_rulecriterias'] = [
      [
          'id'         => 9,
          'rules_id'   => 6,
          'criteria'   => 'locations_id',
          'condition'  => 9,
          'pattern'    => 1
      ], [
          'id'         => 2,
          'rules_id'   => 2,
          'criteria'   => 'uid',
          'condition'  => 0,
          'pattern'    => '*'
      ], [
          'id'         => 3,
          'rules_id'   => 2,
          'criteria'   => 'samaccountname',
          'condition'  => 0,
          'pattern'    => '*'
      ], [
          'id'         => 4,
          'rules_id'   => 2,
          'criteria'   => 'MAIL_EMAIL',
          'condition'  => 0,
          'pattern'    => '*'
      ], [
          'id'         => 5,
          'rules_id'   => 3,
          'criteria'   => 'subject',
          'condition'  => 6,
          'pattern'    => '/.*/'
      ], [
          'id'         => 6,
          'rules_id'   => 4,
          'criteria'   => 'x-auto-response-suppress',
          'condition'  => 6,
          'pattern'    => '/\\S+/'
      ], [
          'id'         => 7,
          'rules_id'   => 5,
          'criteria'   => 'auto-submitted',
          'condition'  => '6',
          'pattern'    => '/^(?!.*no).+$/i'
      ], [
          'id'         => 10,
          'rules_id'   => 6,
          'criteria'   => 'items_locations',
          'condition'  => 8,
          'pattern'    => 1
      ], [
          'id'         => 11,
          'rules_id'   => 7,
          'criteria'   => 'locations_id',
          'condition'  => 9,
          'pattern'    => 1
      ], [
          'id'         => 12,
          'rules_id'   => 7,
          'criteria'   => 'users_locations',
          'condition'  => 8,
          'pattern'    => 1
      ], [
          'id'         => 13,
          'rules_id'   => 8,
          'criteria'   => 'name',
          'condition'  => 0,
          'pattern'    => '*'
      ], [
          'id'         => 14,
          'rules_id'   => 9,
          'criteria'   => '_itemtype',
          'condition'  => 0,
          'pattern'    => 'Computer'
      ], [
          'id'         => 15,
          'rules_id'   => 9,
          'criteria'   => '_auto',
          'condition'  => 0,
          'pattern'    => 1
      ], [
          'id'         => 16,
          'rules_id'   => 9,
          'criteria'   => 'contact',
          'condition'  => 6,
          'pattern'    => '/(.*)@/'
      ], [
          'id'         => 17,
          'rules_id'   => 10,
          'criteria'   => '_itemtype',
          'condition'  => 0,
          'pattern'    => 'Computer'
      ], [
          'id'         => 18,
          'rules_id'   => 10,
          'criteria'   => '_auto',
          'condition'  => 0,
          'pattern'    => 1
      ], [
          'id'         => 19,
          'rules_id'   => 10,
          'criteria'   => 'contact',
          'condition'  => 6,
          'pattern'    => '/(.*),/'
      ], [
          'id'         => 20,
          'rules_id'   => 11,
          'criteria'   => '_itemtype',
          'condition'  => 0,
          'pattern'    => 'Computer'
      ], [
          'id'         => 21,
          'rules_id'   => 11,
          'criteria'   => '_auto',
          'condition'  => 0,
          'pattern'    => 1
      ], [
          'id'         => 22,
          'rules_id'   => 11,
          'criteria'   => 'contact',
          'condition'  => 6,
          'pattern'    => '/(.*)/'
      ]
   ];

   $tables['glpi_rulerightparameters'] = [
     [
        'id'     => 1,
        'name'   => '(LDAP)Organization',
        'value'  => 'o'
     ], [
        'id'     => '2',
        'name'   => '(LDAP)Common Name',
        'value'  => 'cn'
     ], [
        'id'     => '3',
        'name'   => '(LDAP)Department Number',
        'value'  => 'departmentnumber'
     ], [
        'id'     => '4',
        'name'   => '(LDAP)Email',
        'value'  => 'mail'
     ], [
        'id'     => '5',
        'name'   => 'Object Class',
        'value'  => 'objectclass'
     ], [
        'id'     => '6',
        'name'   => '(LDAP)User ID',
        'value'  => 'uid'
     ], [
        'id'     => '7',
        'name'   => '(LDAP)Telephone Number',
        'value'  => 'phone'
     ], [
        'id'     => '8',
        'name'   => '(LDAP)Employee Number',
        'value'  => 'employeenumber'
     ], [
        'id'     => '9',
        'name'   => '(LDAP)Manager',
        'value'  => 'manager'
     ], [
        'id'     => '10',
        'name'   => '(LDAP)DistinguishedName',
        'value'  => 'dn'
     ], [
        'id'     => '12',
        'name'   => '(AD)User ID',
        'value'  => 'samaccountname'
     ], [
        'id'     => '13',
        'name'   => '(LDAP) Title',
        'value'  => 'title'
     ], [
        'id'     => '14',
        'name'   => '(LDAP) MemberOf',
        'value'  => 'memberof'
     ]
   ];

   $tables['glpi_rules'] = [
     [
        'id'           => '2',
        'sub_type'     => 'RuleRight',
        'ranking'      => '1',
        'name'         => 'Root',
        'description'  => '',
        'match'        => 'OR',
        'is_active'    => '1',
        'is_recursive' => 0,
        'uuid'         => '500717c8-2bd6e957-53a12b5fd35745.02608131',
        'condition'    => 0
     ], [
        'id'           => '3',
        'sub_type'     => 'RuleMailCollector',
        'ranking'      => '3',
        'name'         => 'Root',
        'description'  => '',
        'match'        => 'OR',
        'is_active'    => '1',
        'is_recursive' => '0',
        'uuid'         => '500717c8-2bd6e957-53a12b5fd36404.54713349',
        'condition'    => '0'
     ], [
        'id'           => '4',
        'sub_type'     => 'RuleMailCollector',
        'ranking'      => '1',
        'name'         => 'X-Auto-Response-Suppress',
        'description'  => 'Exclude Auto-Reply emails using X-Auto-Response-Suppress header',
        'match'        => 'AND',
        'is_active'    => '0',
        'is_recursive' => '1',
        'uuid'         => '500717c8-2bd6e957-53a12b5fd36d97.94503423',
        'condition'    => '0'
     ], [
        'id'           => '5',
        'sub_type'     => 'RuleMailCollector',
        'ranking'      => '2',
        'name'         => 'Auto-Reply Auto-Submitted',
        'description'  => 'Exclude Auto-Reply emails using Auto-Submitted header',
        'match'        => 'OR',
        'is_active'    => '1',
        'is_recursive' => '1',
        'uuid'         => '500717c8-2bd6e957-53a12b5fd376c2.87642651',
        'condition'    => '0'
     ], [
        'id'           => '6',
        'sub_type'     => 'RuleTicket',
        'ranking'      => '1',
        'name'         => 'Ticket location from item',
        'description'  => '',
        'match'        => 'AND',
        'is_active'    => '0',
        'is_recursive' => '1',
        'uuid'         => '500717c8-2bd6e957-53a12b5fd37f94.10365341',
        'condition'    => '1'
     ], [
        'id'           => '7',
        'sub_type'     => 'RuleTicket',
        'ranking'      => '2',
        'name'         => 'Ticket location from user',
        'description'  => '',
        'match'        => 'AND',
        'is_active'    => '0',
        'is_recursive' => '1',
        'uuid'         => '500717c8-2bd6e957-53a12b5fd38869.86002585',
        'condition'    => '1'
     ], [
        'id'           => '8',
        'sub_type'     => 'RuleSoftwareCategory',
        'ranking'      => '1',
        'name'         => 'Import category from inventory tool',
        'description'  => '',
        'match'        => 'AND',
        'is_active'    => '0',
        'is_recursive' => '1',
        'uuid'         => '500717c8-2bd6e957-53a12b5fd38869.86003425',
        'condition'    => '1'
     ], [
        'id'           => '9',
        'sub_type'     => 'RuleAsset',
        'ranking'      => '1',
        'name'         => 'Domain user assignation',
        'description'  => '',
        'match'        => 'AND',
        'is_active'    => '1',
        'is_recursive' => '1',
        'uuid'         => 'fbeb1115-7a37b143-5a3a6fc1afdc17.92779763',
        'condition'    => '3'
     ], [
        'id'           => '10',
        'sub_type'     => 'RuleAsset',
        'ranking'      => '2',
        'name'         => 'Multiple users: assign to the first',
        'description'  => '',
        'match'        => 'AND',
        'is_active'    => '1',
        'is_recursive' => '1',
        'uuid'         => 'fbeb1115-7a37b143-5a3a6fc1b03762.88595154',
        'condition'    => '3'
     ], [
        'id'           => '11',
        'sub_type'     => 'RuleAsset',
        'ranking'      => '3',
        'name'         => 'One user assignation',
        'description'  => '',
        'match'        => 'AND',
        'is_active'    => '1',
        'is_recursive' => '1',
        'uuid'         => 'fbeb1115-7a37b143-5a3a6fc1b073e1.16257440',
        'condition'    => '3'
     ]
   ];

   $tables['glpi_softwarecategories'] = [
     [
         'id'             => '1',
         'name'           => 'FUSION',
         'completename'   => 'FUSION',
         'level'          => '1'
     ]
   ];

   $tables['glpi_softwarelicensetypes'] = [
     [
        'id'           => 1,
        'name'         => 'OEM',
        'is_recursive' => 1,
        'completename' => 'OEM'
     ]
   ];

   $tables['glpi_ssovariables'] = [
     [
        'id'     => 1,
        'name'   => 'HTTP_AUTH_USER'
     ], [
        'id'     => 2,
        'name'   => 'REMOTE_USER'
     ], [
        'id'     => 3,
        'name'   => 'PHP_AUTH_USER'
     ], [
        'id'     => 4,
        'name'   => 'USERNAME'
     ], [
        'id'     => 5,
        'name'   => 'REDIRECT_REMOTE_USER'
     ], [
        'id'     => 6,
        'name'   => 'HTTP_REMOTE_USER'
     ]
   ];

   $tables['glpi_tickettemplates'] = [
     [
        'id'           => 1,
        'name'         => 'Default',
        'entities_id'  => 0,
        'is_recursive' => 1
     ]
   ];

   $tables['glpi_tickettemplatemandatoryfields'] = [
     [
        'id'                 => 1,
        'tickettemplates_id' => 1,
        'num'                => 21
     ]
   ];

   $tables['glpi_transfers'] = [
     [
        'id'                 => '1',
        'name'               => 'complete',
        'keep_ticket'        => '2',
        'keep_networklink'   => '2',
        'keep_reservation'   => 1,
        'keep_history'       => 1,
        'keep_device'        => 1,
        'keep_infocom'       => 1,
        'keep_dc_monitor'    => 1,
        'clean_dc_monitor'   => 1,
        'keep_dc_phone'      => 1,
        'clean_dc_phone'     => 1,
        'keep_dc_peripheral' => 1,
        'clean_dc_peripheral' => 1,
        'keep_dc_printer'    => 1,
        'clean_dc_printer'   => 1,
        'keep_supplier'      => 1,
        'clean_supplier'     => 1,
        'keep_contact'       => 1,
        'clean_contact'      => 1,
        'keep_contract'      => 1,
        'clean_contract'     => 1,
        'keep_software'      => 1,
        'clean_software'     => 1,
        'keep_document'      => 1,
        'clean_document'     => 1,
        'keep_cartridgeitem' => 1,
        'clean_cartridgeitem' => 1,
        'keep_cartridge'     => 1,
        'keep_consumable'    => 1,
        'keep_disk'          => 1,
     ]
   ];

   $tables['glpi_users'] = [
     [
        'id'           => '2',
        'name'         => 'glpi',
        'password'     => '$2y$10$rXXzbc2ShaiCldwkw4AZL.n.9QSH7c0c9XJAyyjrbL9BwmWditAYm',
        'language'     => null,
        'list_limit'   => '20',
        'authtype'     => '1'
     ], [
        'id'           => '3',
        'name'         => 'post-only',
        'password'     => '$2y$10$dTMar1F3ef5X/H1IjX9gYOjQWBR1K4bERGf4/oTPxFtJE/c3vXILm',
        'language'     => 'en_GB',
        'list_limit'   => '20',
        'authtype'     => '1'
     ], [
        'id'           => '4',
        'name'         => 'tech',
        'password'     => '$2y$10$.xEgErizkp6Az0z.DHyoeOoenuh0RcsX4JapBk2JMD6VI17KtB1lO',
        'language'     => 'en_GB',
        'list_limit'   => '20',
        'authtype'     => '1'
     ], [
        'id'           => '5',
        'name'         => 'normal',
        'password'     => '$2y$10$Z6doq4zVHkSPZFbPeXTCluN1Q/r0ryZ3ZsSJncJqkN3.8cRiN0NV.',
        'language'     => 'en_GB',
        'list_limit'   => '20',
        'authtype'     => '1'
     ]
   ];

   $tables['glpi_devicefirmwaretypes'] = [
     ['id' => '1', 'name' => 'BIOS'],
     ['id' => '2', 'name' => 'UEFI'],
     ['id' => '3', 'name' => 'Firmware']
   ];

   foreach ($tables as $table => $data) {
      $stmt = $DB->prepare($DB->buildInsert($table, $data[0]));
      foreach ($data as $row) {
         try {
            $stmt->execute($row);
         } catch (\Exception $e) {
            $msg = "In table $table";
            $msg .= print_r($row, true);
            $msg .= "\n".$e->getMessage();
            throw new \RuntimeException($msg);
         }
      }
   }
}
