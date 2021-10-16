<?php

use Glpi\Siem\Host;

include('../../inc/includes.php');
Session::checkRight(Host::$rightname, READ);
Html::header(Host::getTypeName(Session::getPluralNumber()), $_SERVER['PHP_SELF'], 'management', Host::class);
Search::show(Host::class);
Html::footer();
