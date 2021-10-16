<?php

use Glpi\Siem\Service;

include('../../inc/includes.php');
Session::checkRight(Service::$rightname, READ);
Html::header(Service::getTypeName(Session::getPluralNumber()), $_SERVER['PHP_SELF'], 'management', Service::class);
Search::show(Service::class);
Html::footer();
