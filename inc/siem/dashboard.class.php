<?php

namespace Glpi\Siem;

use Session;
use Toolbox;

final class Dashboard {

   public static function cardMonitoredCountProvider(): array {
      global $DB;

      $iterator = $DB->request([
         'SELECT'   => [
            'COUNT' => 'id as cpt'
         ],
         'FROM'  => Host::getTable(),
      ]);
      $host_count = $iterator->current()['cpt'];
      $iterator = $DB->request([
         'SELECT'   => [
            'COUNT' => 'id as cpt'
         ],
         'FROM'  => Service::getTable(),
      ]);
      $service_count = $iterator->current()['cpt'];

      return [
         'data'   => [
            [
               'label'  => Host::getTypeName(Session::getPluralNumber()),
               'number' => $host_count
            ],
            [
               'label'  => Service::getTypeName(Session::getPluralNumber()),
               'number' => $service_count
            ]
         ]
      ];
   }

   public static function cardHostCountProvider(): array {
      global $DB;

      $table = Host::getTable();
      $iterator = $DB->request([
         'SELECT'   => [
            'COUNT' => 'id as cpt'
         ],
         'FROM'  => $table,
      ]);

      return [
         'label' => __('Monitored Host Count'),
         'number' => $iterator->current()['cpt']
      ];
   }

   public static function cardServiceCountProvider(): array {
      global $DB;

      $table = Service::getTable();
      $iterator = $DB->request([
         'SELECT'   => [
            'COUNT' => 'id as cpt'
         ],
         'FROM'  => $table,
      ]);

      return [
         'label' => __('Monitored Service Count'),
         'number' => $iterator->current()['cpt']
      ];
   }

   public static function cardServiceStatusProvider(): array {
      global $DB;

      $iterator = $DB->request([
         'SELECT'   => [
            'COUNT'  => 'id as cpt',
            'status'
         ],
         'FROM'  => Service::getTable()
      ]);

      $status_counts = [];

      foreach ($iterator as $data) {
         $status_counts[$data['status']] = $data['cpt'];
      }

      $statuses = [Service::STATUS_OK, Service::STATUS_WARNING, Service::STATUS_CRITICAL, Service::STATUS_UNKNOWN];
      $card = [
         'label'  => __('Service Status'),
         'data'   => []
      ];

      foreach ($statuses as $status) {
         $card['data'][] = [
            'label'  => Service::getStatusName($status),
            'number' => $status_counts[$status] ?? 0,
            'url'    => Service::getSearchURL() . '?' . Toolbox::append_params([
                  'criteria'  => [
                     [
                        'field'        => 5,
                        'searchtype'   => 'equals',
                        'value'        => $status
                     ]
                  ],
                  'reset'     => 'reset'
               ])
         ];
      }
      return $card;
   }
}
