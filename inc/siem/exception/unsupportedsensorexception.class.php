<?php

namespace Glpi\Siem\Exception;

use Exception;

class UnsupportedSensorException extends Exception {

   private string $sensor;

   private string $agent_class;

   public function __construct(string $sensor, string $agent_class) {
      parent::__construct('Unsupported sensor: '.$sensor.' for agent: '.$agent_class);
      $this->sensor = $sensor;
      $this->agent_class = $agent_class;
   }

   public function getSensor(): string {
      return $this->sensor;
   }

   public function getAgentClass(): string {
      return $this->agent_class;
   }
}
