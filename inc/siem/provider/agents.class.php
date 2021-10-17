<?php

namespace Glpi\Siem\Provider;

use Glpi\Siem\Agent\AgentInterface;
use Glpi\Siem\Agent\GlpiAgent;

final class Agents {

   public static function getAgents(): ?array {
      static $agents = null;

      if ($agents === null) {
         $agents = [
            'core'   => [GlpiAgent::class]
         ];
         if (isset($PLUGIN_HOOKS['siem_agents'])) {
            $agents = array_merge($agents, $PLUGIN_HOOKS['siem_agents']);
         }
      }

      return $agents;
   }

   public static function getDropdownItems(?string $sensor = null) {
      $agents = self::getAgents();
      $elements = [];

      foreach ($agents as $provider => $agent_classes) {
         /** @var AgentInterface $agent_class */
         foreach ($agent_classes as $agent_class) {
            if ($sensor === null || in_array($sensor, $agent_class::getSupportedSensors(), true)) {
               $elements[(string)$agent_class] = $agent_class::getAgentName();
            }
         }
      }
      return $elements;
   }
}
