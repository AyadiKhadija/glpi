<?php

namespace Glpi\Siem;

/**
 * Trait for shared functions between Event Management hosts and services.
 * @since 10.0.0
 **/
trait Monitored {

   private function getMonitoredField($field) {
      if (static::getType() === Host::class) {
         $service = $this->getAvailabilityService();
         if ($service) {
            return $service->fields[$field];
         }

         return null;
      }

      return $this->fields[$field];
   }

   public function isAlertState(): bool {
      $status = $this->getStatus();
      return $status !== Service::STATUS_OK && $status !== Service::STATUS_UNKNOWN;
   }

   /**
    * Returns true if the host or service is currently flapping.
    * @since 10.0.0
    */
   public function isFlapping(): bool {
      return (bool) $this->getMonitoredField('is_flapping');
   }

   public function getStatus(): int {
      $status = $this->getMonitoredField('status');
      return $status ?? Service::STATUS_UNKNOWN;
   }

   public function isHardStatus(): bool {
      return (bool) $this->getMonitoredField('is_hard_status');
   }

   public function getLastStatusCheck() {
      return $this->getMonitoredField('last_check');
   }

   public function getLastStatusChange() {
      return $this->getMonitoredField('status_since');
   }

   /**
    * Returns the translated name of the host or service's current status.
    * @since 1.0.0
    */
   public function getCurrentStatusName(): string {
      if (static::getType() === Host::class) {
         if ($this->fields['is_reachable']) {
            return Service::getStatusName($this->getStatus());
         }

         return __('Unreachable');
      }

      return Service::getStatusName($this->getStatus());
   }

   public function getHost() {
      static $host = null;
      if ($host === null) {
         if (static::getType() === Host::class) {
            return $this;
         } else {
            $host = new Host();
            $host->getFromDB($this->fields[Host::getForeignKeyField()]);
         }
      }
      return $host;
   }

   /**
    * Returns the name of this host (or service's host).
    * @since 1.0.0
    */
   public function getHostName() {
      global $DB;

      if (static::class === Host::class) {
         $hosttype = $this->fields['itemtype'];
         $iterator = $DB->request([
            'SELECT' => ['name'],
            'FROM' => $hosttype::getTable(),
            'WHERE' => [
               'id' => $this->fields['items_id']
            ]
         ]);
         return $iterator->current()['name'];
      }

      if ($this->isHostless()) {
         return '';
      }
      $host = $this->getHost();
      return $host ? $host->getHostName() : null;
   }

   public function getEvents($where = [], $start = 0, $limit = -1): array {
      global $DB;
      $event_table = Event::getTable();
      $service_table = Service::getTable();
      $service_fk = Service::getForeignKeyField();
      $host_fk = Host::getForeignKeyField();

      $criteria = [
         'FROM' => Event::getTable(),
         'LEFT JOIN' => [
            $service_table => [
               'FKEY' => [
                  $event_table => $service_fk,
                  $service_table => 'id'
               ]
            ]
         ]
      ];
      if (static::getType() === Host::class) {
         $hosttable = Host::getTable();
         $criteria['LEFT JOIN'][$hosttable] = [
            'FKEY' => [
               $service_table => $host_fk,
               $hosttable => 'id'
            ]
         ];
         $criteria['WHERE'] = [
            $host_fk => $this->getID()
         ];
      } else {
         $criteria['WHERE'] = [
            $service_fk => $this->getID()
         ];
      }
      $iterator = $DB->request($criteria);
      $events = [];
      foreach ($iterator as $data) {
         $events[] = $data;
      }
      return $events;
   }
}
