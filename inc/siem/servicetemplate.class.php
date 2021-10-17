<?php

namespace Glpi\Siem;

use CommonDBTM;
use Dropdown;
use Glpi\Application\View\TemplateRenderer;
use Glpi\Siem\Provider\Agents;
use Glpi\Siem\Provider\Sensors;
use Html;
use Plugin;

class ServiceTemplate extends CommonDBTM {
   public static $rightname = 'siem_servicetemplate';

   public static function getTypeName($nb = 0): string {
      return _n('Service template', 'Service templates', $nb);
   }

   public static function getIcon(): string {
      return 'fas fa-layer-group';
   }

   public static function getMenuContent() {
      $menu = parent::getMenuContent();
      $menu['links']['search'] = self::getSearchURL(false);
      if (self::canCreate()) {
         $menu['links']['add'] = self::getFormURL(false);
      }
      return $menu;
   }

   public static function getAdditionalMenuLinks() {
      $links = [];
      $links['add'] = self::getFormURL(false);
      if (count($links)) {
         return $links;
      }
      return false;
   }

   public function showForm($ID, $options = []): bool {
      $this->initForm($ID, $options);
      TemplateRenderer::getInstance()->display('components/siem/forms/servicetemplate.html.twig', [
         'item'      => $this,
         'params'    => $options,
         'sensors'   => Sensors::getDropdownItems(),
         'agents'    => Agents::getDropdownItems()
      ]);
      return true;
   }

   /**
    * Show a list of all hosts with services using this template
    */
   public function showHosts() {

   }

   /**
    * Show a list of all services using this template
    */
   public function showServices() {
      $siemservice = new Service();
      $siemhost = new Host();
      $services = $siemservice->find(['servicetemplates_id' => $this->getID()]);

      echo '<table><tr>';
      echo '<th>' . __('Host') . '</th>';
      echo '<th>' . __('Last check') . '</th>';
      echo '<th>' . __('Status') . '</th>';
      echo '<th>' . __('Is hard') . '</th>';
      echo '<th>' . __('Is flapping') . '</th>';
      echo '<th>' . __('Is acknowledged') . '</th>';
      echo '<th>' . __('Is active') . '</th>';
      echo '</tr>';
      if (!count($services)) {
         echo "<tr><td colspan='7'>" . __('No services') . '</td></tr>';
      } else {
         foreach ($services as $service) {
            $host = $siemhost->find(['id' => 'plugin_siem_hosts_id']);
            $host = reset($host);
            $assetinfo = $host->getItemInfo();
            echo '<tr>';
            echo '<td>' . Html::link($assetinfo['name'], $host['itemtype']::getFormURLWithID($host['items_id'])) . '</td>';
            echo '<td>' . Html::timestampToRelativeStr($service['last_check']) . '</td>';
            echo '<td>' . Service::getStatusName($service['status']) . '</td>';
            echo '<td>' . ($service['is_hard'] ? __('True') : __('False')) . '</td>';
            echo '<td>' . ($service['is_flapping'] ? __('True') : __('False')) . '</td>';
            echo '<td>' . ($service['is_acknowledged'] ? __('True') : __('False')) . '</td>';
            echo '<td>' . ($service['is_active'] ? __('True') : __('False')) . '</td>';
            echo '</tr>';
         }
      }
   }
}
