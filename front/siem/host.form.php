<?php

use Glpi\Event;
use Glpi\Siem\Host;

include('../../inc/includes.php');
$host = new Host();
if (isset($_POST['add'])) {
   $host->check(-1, CREATE, $_POST);
   $newID = $host->add($_POST, false);
   Event::log($newID, Host::class, 3, 'management', 'add');
   Html::back();
} else if (isset($_POST['purge'])) {
   $host->check($_POST['id'], PURGE);
   $host->delete($_POST, 1);
   Event::log($_POST['id'], Host::class, 3, 'management', 'purge');
   Html::back();
} else if (isset($_POST['update'])) {
   $host->check($_POST['id'], UPDATE);
   $host->update($_POST);
   Event::log($_POST['id'], Host::class, 3, 'management', 'update');
   Html::back();
} else if (isset($_POST['set_host_service']) && isset($_POST['siems_services_id'])) {
   $host->check($_POST['id'], UPDATE);
   $host->update([
      'id' => $_POST['id'],
      'siems_services_id_availability' => $_POST['siems_services_id']
   ]);
   Event::log($_POST['id'], Host::class, 3, 'management', 'update');
   Html::back();
}
Html::back();
