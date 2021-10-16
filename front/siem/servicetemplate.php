<?php

use Glpi\Siem\ServiceTemplate;

include('../../inc/includes.php');
Session::checkRight(ServiceTemplate::$rightname, READ);
Html::header(ServiceTemplate::getTypeName(Session::getPluralNumber()), $_SERVER['PHP_SELF'], 'management', ServiceTemplate::class);
Search::show(ServiceTemplate::class);
Html::footer();
