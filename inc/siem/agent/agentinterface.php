<?php

namespace Glpi\Siem\Agent;

use Glpi\Siem\Exception\UnsupportedSensorException;
use Glpi\Siem\Host;

interface AgentInterface {

   /**
    * Internal SIEM agents execute sensors from GLPI
    */
   public const SIEM_AGENT_TYPE_INTERNAL = 0;

   /**
    * External SIEM agents have sensors delegated to an external program.
    * All external agent sensors report their results asynchronously.
    */
   public const SIEM_AGENT_TYPE_EXTERNAL = 1;

   /**
    * @return int One of {@link SIEM_AGENT_TYPE_INTERNAL} or {@link SIEM_AGENT_TYPE_EXTERNAL}
    */
   public function getSiemAgentType(): int;

   /**
    * @return array
    */
   public function getSupportedSensors(): array;

   /**
    * @param string $sensor
    * @param Host $host
    * @param array $service_params
    * @return array
    * @throws UnsupportedSensorException
    */
   public function executeSensor(string $sensor, Host $host, array $service_params): array;
}
