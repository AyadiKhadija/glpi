<?php

namespace Glpi\Siem\Agent;

use Agent;
use Glpi\Features\Inventoriable;
use Glpi\Siem\Host;
use Toolbox;

/**
 * Interface for the official GLPI Agent
 */
final class GlpiAgent implements AgentInterface {

   public static function getAgentName(): string {
      return _x('agent', "GLPI Agent");
   }

   public static function getSiemAgentType(): int {
      return self::SIEM_AGENT_TYPE_EXTERNAL;
   }

   public static function getSupportedSensors(): array {
      return [
         'ping', 'heartbeat', 'cpu_percent', 'disk_usage_percent', 'disk_usage_bytes', 'disk_opts', 'disk_free_percent',
         'disk_free_bytes', 'netint_packets_sent', 'netint_packets_received', 'netint_bytes_sent', 'netint_bytes_received',
         'memory_available_bytes', 'memory_available_percent', 'memory_used_bytes', 'memory_used_percent', 'process_count',
         'service_status'
      ];
   }

   public static function executeSensor(string $sensor, Host $host, array $service_params): array {
      $agent = self::getGlpiAgentForHost($host);

      return $agent->requestSensorExecution($sensor, $service_params);
   }

   public static function getGlpiAgentForHost(Host $host): ?Agent {
      $item = $host->getItem();
      if ($item === null || !Toolbox::hasTrait($item, Inventoriable::class)) {
         // This host does not support GLPI Agent
         return null;
      }

      /** @var Inventoriable $item */
      return $item->getInventoryAgent();
   }
}
