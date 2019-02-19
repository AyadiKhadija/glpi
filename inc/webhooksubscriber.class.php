<?php
/**
 * ---------------------------------------------------------------------
 * GLPI - Gestionnaire Libre de Parc Informatique
 * Copyright (C) 2015-2018 Teclib' and contributors.
 *
 * http://glpi-project.org
 *
 * based on GLPI - Gestionnaire Libre de Parc Informatique
 * Copyright (C) 2003-2014 by the INDEPNET Development Team.
 *
 * ---------------------------------------------------------------------
 *
 * LICENSE
 *
 * This file is part of GLPI.
 *
 * GLPI is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * GLPI is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with GLPI. If not, see <http://www.gnu.org/licenses/>.
 * ---------------------------------------------------------------------
 */

if (!defined('GLPI_ROOT')) {
   die("Sorry. You can't access this file directly");
}

use \Symfony\Component\EventDispatcher\EventSubscriberInterface as EventSubscriberInterface;

/**
 * WebhookSubscriber Class.
 * Used to subscribe to GLPI item events and plugin events
 * @since 10.0.0
**/
class WebhookSubscriber implements EventSubscriberInterface
{
   public static function getSubscribedEvents()
   {
      return [
         ItemEvent::ITEM_POST_ADD         => 'doItemAddWebhook',
         ItemEvent::ITEM_POST_DELETE      => 'doItemDeleteWebhook',
         ItemEvent::ITEM_POST_PURGE       => 'doItemPurgeWebhook',
         ItemEvent::ITEM_POST_RESTORE     => 'doItemRestoreWebhook',
         ItemEvent::ITEM_POST_UPDATE      => 'doItemUpdateWebhook'
     ] + Plugin::getWebhookTriggers();
   }

   public function doItemAddWebhook(ItemEvent $event)
   {
      Webhook::postWebhookAction($event->getItem(), 'add');
   }

   public function doItemUpdateWebhook(ItemEvent $event)
   {
      Webhook::postWebhookAction($event->getItem(), 'update');
   }

   public function doItemDeleteWebhook(ItemEvent $event)
   {
      Webhook::postWebhookAction($event->getItem(), 'delete');
   }

   public function doItemPurgeWebhook(ItemEvent $event)
   {
      Webhook::postWebhookAction($event->getItem(), 'purge');
   }

   public function doItemRestoreWebhook(ItemEvent $event)
   {
      Webhook::postWebhookAction($event->getItem(), 'restore');
   }
}