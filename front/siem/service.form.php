<?php

use Glpi\Event;
use Glpi\Siem\Service;

include('../../inc/includes.php');
Html::header(Service::getTypeName(), $_SERVER['PHP_SELF'], 'management', Service::class);

$service = new Service();
if (!isset($_GET['id'])) {
   $_GET['id'] = -1;
}

if (isset($_POST['add'])) {
   $service->check(-1, CREATE, $_POST);
   if ($newID = $service->add($_POST)) {
      Event::log($newID, 'services', 4, 'management',
         sprintf(__('%1$s adds the item %2$s'), $_SESSION['glpiname'], $_POST['name']));

      if ($_SESSION['glpibackcreated']) {
         Html::redirect($service->getLinkURL());
      }
   }
   Html::back();

   // delete a computer
} else if (isset($_POST['delete'])) {
   $service->check($_POST['id'], DELETE);
   $ok = $service->delete($_POST);
   if ($ok) {
      Event::log($_POST['id'], 'services', 4, 'management',
         //TRANS: %s is the user login
         sprintf(__('%s deletes an item'), $_SESSION['glpiname']));
   }
   $service->redirectToList();

} else if (isset($_POST['restore'])) {
   $service->check($_POST['id'], DELETE);
   if ($service->restore($_POST)) {
      Event::log($_POST['id'], 'services', 4, 'management',
         //TRANS: %s is the user login
         sprintf(__('%s restores an item'), $_SESSION['glpiname']));
   }
   $service->redirectToList();

} else if (isset($_POST['purge'])) {
   $service->check($_POST['id'], PURGE);
   if ($service->delete($_POST, 1)) {
      Event::log($_POST['id'], 'services', 4, 'management',
         //TRANS: %s is the user login
         sprintf(__('%s purges an item'), $_SESSION['glpiname']));
   }
   $service->redirectToList();

} else if (isset($_POST['update'])) {
   $service->check($_POST['id'], UPDATE);
   $service->update($_POST);
   Event::log($_POST['id'], 'services', 4, 'inventory',
      //TRANS: %s is the user login
      sprintf(__('%s updates an item'), $_SESSION['glpiname']));
   Html::back();
} else {
   $service->display(['id' => $_GET['id']]);
   Html::footer();
}
