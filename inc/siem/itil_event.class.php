<?php

namespace Glpi\Siem;

use Change;
use CommonDBRelation;
use CommonDBTM;
use CommonGLPI;
use Problem;
use Session;
use Ticket;

class Itil_Event extends CommonDBRelation {

   // From CommonDBRelation
   static public $itemtype_1 = Event::class;
   static public $items_id_1 = 'siem_events_id';
   static public $itemtype_2 = 'itemtype';
   static public $items_id_2 = 'items_id';
   static public $checkItem_2_Rights = self::HAVE_VIEW_RIGHT_ON_ITEM;

   public function getForbiddenStandardMassiveAction(): array {
      $forbidden = parent::getForbiddenStandardMassiveAction();
      $forbidden[] = 'update';
      return $forbidden;
   }

   public function canCreateItem(): bool {
      $event = new Event();
      if ($event->canUpdateItem()) {
         return true;
      }
      return parent::canCreateItem();
   }

   public function prepareInputForAdd($input) {
      // Avoid duplicate entry
      if (countElementsInTable(self::getTable(), ['siem_events_id' => $input['siem_events_id'],
            'itemtype' => $input['itemtype'],
            'items_id' => $input['items_id']]) > 0) {
         return false;
      }
      return parent::prepareInputForAdd($input);
   }

   public function getTabNameForItem(CommonGLPI $item, $withtemplate = 0) {
      if (!$withtemplate) {
         $nb = 0;
         switch ($item->getType()) {
            case Change::class :
            case Problem::class :
            case Ticket::class :
            /** @var \CommonITILObject $item */
               if ($_SESSION['glpishow_count_on_tabs']) {
                  $nb = countElementsInTable(
                     self::getTable(),
                     [
                        'itemtype' => $item->getType(),
                        'items_id' => $item->getID(),
                     ]
                  );
               }
               return self::createTabEntry(Event::getTypeName(Session::getPluralNumber()), $nb);
            case Event::class :
               /** @var Event $item */
               if ($_SESSION['glpishow_count_on_tabs']) {
                  $nb = countElementsInTable(self::getTable(), ['siem_events_id' => $item->getID()]);
               }
               return self::createTabEntry(_n('Itil item', 'Itil items', Session::getPluralNumber()), $nb);
         }
      }
      return '';
   }

   public static function displayTabContentForItem(CommonGLPI $item, $tabnum = 1, $withtemplate = 0) {
      switch ($item->getType()) {
         case Event::class :
            //self::showForSIEMEvent($item);
            break;
         default:
            //self::showForItil($item);
            break;
      }
      return true;
   }
}
