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

   public function getSiemAgentType(): int {
      return self::SIEM_AGENT_TYPE_EXTERNAL;
   }

   public function getSupportedSensors(): array {
      // TODO: Implement getSupportedSensors() method.
      return [];
   }

   public function executeSensor(string $sensor, Host $host, array $service_params): array {
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
