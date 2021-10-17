<?php

namespace Glpi\Siem\Provider\Sensor;

use Glpi\Siem\Service;

final class Core implements SensorProviderInterface {

   public static function getSensors(): array {
      return [
         'ping'   => [
            'name'      => _x('sensor', 'Ping'),
            'mode'      => Service::CHECK_MODE_ACTIVE,
            'params'    => [
               'required_props' => [
                  'percent_loss' => [
                     'name'   => _x('sensor_property', 'Percent loss')
                  ],
                  'min' => [
                     'name'   => _x('sensor_property', 'Minimum (ms)')
                  ],
                  'avg' => [
                     'name'   => _x('sensor_property', 'Average (ms)')
                  ],
                  'max' => [
                     'name'   => _x('sensor_property', 'Maximum (ms)')
                  ],
                  'mdev' => [
                     'name'   => _x('sensor_property', 'Standard deviation (ms)')
                  ],
               ]
            ],
            'events'    => [
               'ok'  => [
                  'name'   => _x('sensor_event', 'Ping OK')
               ],
               'error'  => [
                  'name'   => _x('sensor_event', 'Ping not OK')
               ]
            ],
         ],
         'heartbeat' => [
            'name'      => _x('sensor', 'Heartbeat'),
            'mode'      => Service::CHECK_MODE_PASSIVE,
            'events'    => [
               'heartbeat' => [
                  'name'   => _x('sensor_event', 'Heartbeat')
               ]
            ]
         ],
         'http_status'   => [
            'name'      => _x('sensor', 'HTTP Status'),
            'mode'      => Service::CHECK_MODE_ACTIVE,
            'params'    => [
               'expected_status_code' => [
                  'name'   => _x('sensor_param', 'Expected status code'),
                  'type'   => 'number',
                  'params' => [
                     'min'    => 100,
                     'max'    => 600,
                     'step'   => 1
                  ]
               ],
            ],
            'sensor_params'   => [
               'required_props'  => [
                  'http_code' => [
                     _x('sensor_property', 'HTTP code')
                  ]
               ]
            ],
            'events' => [
               'ok'  => [
                  'name'   => _x('sensor_event', 'HTTP OK')
               ],
               'error'  => [
                  'name'   => _x('sensor_event', 'HTTP not OK')
               ],
            ]
         ],
      ];
   }

   public static function getLocalizedEventName(string $internal_name): string {
      switch ($internal_name) {
         case 'sensor_ping_ok':
            return _x('sensor_event', 'Ping OK');
         case 'sensor_ping_notok':
            return _x('sensor_event', 'Ping not OK');
         case 'sensor_http_ok_ok':
            return _x('sensor_event', 'HTTP OK');
         case 'sensor_http_ok_error':
            return _x('sensor_event', 'HTTP not OK');
         default:
            return $internal_name;
      }
   }

   public static function getLocalizedEventProperties(array $props): array {
      foreach ($props as $name => &$params) {
         switch ($name) {
            case 'percent_loss':
               $params['name'] = _x('sensor_property', 'Percent loss');
               break;
            case 'min':
               $params['name'] = _x('sensor_property', 'Minimum (ms)');
               break;
            case 'avg':
               $params['name'] = _x('sensor_property', 'Average (ms)');
               break;
            case 'max':
               $params['name'] = _x('sensor_property', 'Maximum (ms)');
               break;
            case 'mdev':
               $params['name'] = _x('sensor_property', 'Standard deviation (ms)');
               break;
            case 'http_code':
               $params['name'] = _x('sensor_property', 'HTTP code');
               break;
            case 'response_time':
               $params['name'] = _x('sensor_property', 'Response time (ms)');
               break;
            case 'response_size':
               $params['name'] = _x('sensor_property', 'Response size (bytes)');
               break;
         }
      }
      return $props;
   }
}
