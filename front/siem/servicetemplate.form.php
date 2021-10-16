<?php

use Glpi\Event;
use Glpi\Siem\ServiceTemplate;

include('../../inc/includes.php');
Html::header(ServiceTemplate::getTypeName(), $_SERVER['PHP_SELF'], 'management', ServiceTemplate::class);

$servicetemplate = new ServiceTemplate();
if (!isset($_GET['id'])) {
   $_GET['id'] = -1;
}

if (isset($_POST['add'])) {
   $servicetemplate->check(-1, CREATE, $_POST);
   if ($newID = $servicetemplate->add($_POST)) {
      Event::log($newID, 'service templates', 4, 'management',
         sprintf(__('%1$s adds the item %2$s'), $_SESSION['glpiname'], $_POST['name']));

      if ($_SESSION['glpibackcreated']) {
         Html::redirect($servicetemplate->getLinkURL());
      }
   }
   Html::back();

   // delete a computer
} else if (isset($_POST['delete'])) {
   $servicetemplate->check($_POST['id'], DELETE);
   $ok = $servicetemplate->delete($_POST);
   if ($ok) {
      Event::log($_POST['id'], 'service templates', 4, 'management',
         //TRANS: %s is the user login
         sprintf(__('%s deletes an item'), $_SESSION['glpiname']));
   }
   $servicetemplate->redirectToList();

} else if (isset($_POST['restore'])) {
   $servicetemplate->check($_POST['id'], DELETE);
   if ($servicetemplate->restore($_POST)) {
      Event::log($_POST['id'], 'service templates', 4, 'management',
         //TRANS: %s is the user login
         sprintf(__('%s restores an item'), $_SESSION['glpiname']));
   }
   $servicetemplate->redirectToList();

} else if (isset($_POST['purge'])) {
   $servicetemplate->check($_POST['id'], PURGE);
   if ($servicetemplate->delete($_POST, 1)) {
      Event::log($_POST['id'], 'service templates', 4, 'management',
         //TRANS: %s is the user login
         sprintf(__('%s purges an item'), $_SESSION['glpiname']));
   }
   $servicetemplate->redirectToList();

   //update a computer
} else if (isset($_POST['update'])) {
   $servicetemplate->check($_POST['id'], UPDATE);
   $servicetemplate->update($_POST);
   Event::log($_POST['id'], 'computers', 4, 'inventory',
      //TRANS: %s is the user login
      sprintf(__('%s updates an item'), $_SESSION['glpiname']));
   Html::back();
} else {
   $servicetemplate->display(['id' => $_GET['id']]);
   Html::footer();
}
