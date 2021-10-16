<?php

namespace Glpi\Siem\Provider\Sensor;

/**
 * Interface for all sensor providers
 * @since 10.0.0
 */
interface SensorProviderInterface {

   /**
    * @return array
    */
   public static function getSensors(): array;

   /**
    * @param string $internal_name
    * @return string
    */
   public static function getLocalizedEventName(string $internal_name): string;

   /**
    * @param array $props
    * @return array
    */
   public static function getLocalizedEventProperties(array $props): array;
}
