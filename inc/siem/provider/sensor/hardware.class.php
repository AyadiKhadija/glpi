<?php

namespace Glpi\Siem\Provider\Sensor;

use Glpi\Siem\Service;

final class Hardware implements SensorProviderInterface {

   public static function getSensors(): array {
      return [
         'cpu_percent'  => [
            'name'      => _x('sensor', 'CPU Usage (%)'),
            'mode'      => Service::CHECK_MODE_ACTIVE,
         ],
         'disk_usage_percent'  => [
            'name'      => _x('sensor', 'Disk Usage (%)'),
            'mode'      => Service::CHECK_MODE_ACTIVE,
         ],
         'disk_usage_bytes'  => [
            'name'      => _x('sensor', 'Disk Usage (bytes)'),
            'mode'      => Service::CHECK_MODE_ACTIVE,
         ],
         'disk_opts'  => [
            'name'      => _x('sensor', 'Disk Options'),
            'mode'      => Service::CHECK_MODE_ACTIVE,
         ],
         'disk_free_percent'  => [
            'name'      => _x('sensor', 'Disk Free (%)'),
            'mode'      => Service::CHECK_MODE_ACTIVE,
         ],
         'disk_free_bytes'  => [
            'name'      => _x('sensor', 'Disk Free (bytes)'),
            'mode'      => Service::CHECK_MODE_ACTIVE,
         ],
         'netint_packets_sent'  => [
            'name'      => _x('sensor', 'Network Interface Bytes Sent'),
            'mode'      => Service::CHECK_MODE_ACTIVE,
         ],
         'netint_packets_received'  => [
            'name'      => _x('sensor', 'Network Interface Packets Received'),
            'mode'      => Service::CHECK_MODE_ACTIVE,
         ],
         'netint_bytes_sent'  => [
            'name'      => _x('sensor', 'Network Interface Bytes Sent'),
            'mode'      => Service::CHECK_MODE_ACTIVE,
         ],
         'netint_bytes_received'  => [
            'name'      => _x('sensor', 'Network Interface Bytes Received'),
            'mode'      => Service::CHECK_MODE_ACTIVE,
         ],
         'memory_available_bytes'  => [
            'name'      => _x('sensor', 'Memory Available (bytes)'),
            'mode'      => Service::CHECK_MODE_ACTIVE,
         ],
         'memory_available_percent'  => [
            'name'      => _x('sensor', 'Memory Available (%)'),
            'mode'      => Service::CHECK_MODE_ACTIVE,
         ],
         'memory_used_bytes'  => [
            'name'      => _x('sensor', 'Memory Usage (bytes)'),
            'mode'      => Service::CHECK_MODE_ACTIVE,
         ],
         'memory_used_percent'  => [
            'name'      => _x('sensor', 'Memory Usage (%)'),
            'mode'      => Service::CHECK_MODE_ACTIVE,
         ],
         'process_count'  => [
            'name'      => _x('sensor', 'Process Count'),
            'mode'      => Service::CHECK_MODE_ACTIVE,
         ],
         'service_status'  => [
            'name'      => _x('sensor', 'Service Status'),
            'mode'      => Service::CHECK_MODE_ACTIVE,
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
