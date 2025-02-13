<?php

/**
 * ---------------------------------------------------------------------
 *
 * GLPI - Gestionnaire Libre de Parc Informatique
 *
 * http://glpi-project.org
 *
 * @copyright 2015-2023 Teclib' and contributors.
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

/**
 * @var DB $DB
 * @var Migration $migration
 */

/** Password initialization notification */
$notification_exists = countElementsInTable('glpi_notifications', ['itemtype' => 'User', 'event' => 'passwordinit']) > 0;
if (!$notification_exists) {
    $DB->insertOrDie(
        'glpi_notifications',
        [
            'id'              => null,
            'name'            => 'Password Initialization',
            'entities_id'     => 0,
            'itemtype'        => 'User',
            'event'           => 'passwordinit',
            'comment'         => '',
            'is_recursive'    => 1,
            'is_active'       => 1,
            'date_creation'   => new \QueryExpression('NOW()'),
            'date_mod'        => new \QueryExpression('NOW()')
        ],
        '10.1 Add password initialization notification'
    );
    $notification_id = $DB->insertId();

    $DB->insertOrDie(
        'glpi_notificationtemplates',
        [
            'name' => 'Password Initialization',
            'itemtype' => 'User'
        ],
        '10.1 Add password initialization template'
    );

    $notificationtemplate_id = $DB->insertId();

    $DB->insertOrDie(
        'glpi_notificationtemplatetranslations',
        [
            'notificationtemplates_id' => $notificationtemplate_id,
            'language' => '',
            'subject' => '##user.action##',
            'content_text' => <<<PLAINTEXT
    ##user.realname## ##user.firstname##
    
    ##lang.passwordinit.information##
    
    ##lang.passwordinit.link## ##user.passwordiniturl##
    PLAINTEXT
            ,
            'content_html' => <<<HTML
    &lt;p&gt;&lt;strong&gt;##user.realname## ##user.firstname##&lt;/strong&gt;&lt;/p&gt;
    &lt;p&gt;##lang.passwordinit.information##&lt;/p&gt;
    &lt;p&gt;##lang.passwordinit.link## &lt;a title="##user.passwordiniturl##" href="##user.passwordiniturl##"&gt;##user.passwordiniturl##&lt;/a&gt;&lt;/p&gt;
    HTML
            ,
        ],
        '10.1 Add password initialization notification template translations'
    );

    $DB->insertOrDie(
        'glpi_notifications_notificationtemplates',
        [
            'notifications_id'         => $notification_id,
            'mode'                     => Notification_NotificationTemplate::MODE_MAIL,
            'notificationtemplates_id' => $notificationtemplate_id,
        ],
        '10.1 Add password initialization notification template'
    );

    $DB->insertOrDie(
        'glpi_notificationtargets',
        [
            'items_id'         => '19',
            'type'             => '1',
            'notifications_id' => $notification_id,
        ],
        '10.1 Add password initialization target'
    );
}
/** /Password initialization notification */


/** Change Satisfaction notification */
if (countElementsInTable('glpi_notifications', ['itemtype' => 'Change', 'event' => 'satisfaction']) === 0) {
    $DB->insertOrDie(
        'glpi_notificationtemplates',
        [
            'name'            => 'Change Satisfaction',
            'itemtype'        => 'Change',
            'date_mod'        => new \QueryExpression('NOW()'),
        ],
        'Add change satisfaction survey notification template'
    );
    $notificationtemplate_id = $DB->insertId();

    $DB->insertOrDie(
        'glpi_notificationtemplatetranslations',
        [
            'notificationtemplates_id' => $notificationtemplate_id,
            'language'                 => '',
            'subject'                  => '##change.action## ##change.title##',
            'content_text'             => <<<PLAINTEXT
##lang.change.title## : ##change.title##

##lang.change.closedate## : ##change.closedate##

##lang.satisfaction.text## ##change.urlsatisfaction##
PLAINTEXT
            ,
            'content_html'             => <<<HTML
&lt;p&gt;##lang.change.title## : ##change.title##&lt;/p&gt;
&lt;p&gt;##lang.change.closedate## : ##change.closedate##&lt;/p&gt;
&lt;p&gt;##lang.satisfaction.text## &lt;a href="##change.urlsatisfaction##"&gt;##change.urlsatisfaction##&lt;/a&gt;&lt;/p&gt;
HTML
            ,
        ],
        'Add change satisfaction survey notification template translations'
    );

    $notifications_data = [
        [
            'event' => 'satisfaction',
            'name'  => 'Change Satisfaction',
        ],
        [
            'event' => 'replysatisfaction',
            'name'  => 'Change Satisfaction Answer',
        ]
    ];
    foreach ($notifications_data as $notification_data) {
        $DB->insertOrDie(
            'glpi_notifications',
            [
                'name'            => $notification_data['name'],
                'entities_id'     => 0,
                'itemtype'        => 'Change',
                'event'           => $notification_data['event'],
                'comment'         => null,
                'is_recursive'    => 1,
                'is_active'       => 1,
                'date_creation'   => new \QueryExpression('NOW()'),
                'date_mod'        => new \QueryExpression('NOW()'),
            ],
            'Add change satisfaction survey notification'
        );
        $notification_id = $DB->insertId();

        $DB->insertOrDie(
            'glpi_notifications_notificationtemplates',
            [
                'notifications_id'         => $notification_id,
                'mode'                     => Notification_NotificationTemplate::MODE_MAIL,
                'notificationtemplates_id' => $notificationtemplate_id,
            ],
            'Add change satisfaction survey notification template instance'
        );

        $DB->insertOrDie(
            'glpi_notificationtargets',
            [
                'items_id'         => 3,
                'type'             => 1,
                'notifications_id' => $notification_id,
            ],
            'Add change satisfaction survey notification targets'
        );

        if ($notification_data['event'] === 'replysatisfaction') {
            $DB->insertOrDie(
                'glpi_notificationtargets',
                [
                    'items_id'         => 2,
                    'type'             => 1,
                    'notifications_id' => $notification_id,
                ],
                'Add change satisfaction survey notification targets'
            );
        }
    }
}
/** /Change Satisfaction notification */
