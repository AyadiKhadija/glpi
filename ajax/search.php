<?php
/**
 * ---------------------------------------------------------------------
 * GLPI - Gestionnaire Libre de Parc Informatique
 * Copyright (C) 2015-2021 Teclib' and contributors.
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

// Direct access to file
use Glpi\Application\View\TemplateRenderer;

include ('../inc/includes.php');
header("Content-Type: text/html; charset=UTF-8");
Html::header_nocache();

Session::checkLoginUser();

if (!isset($_REQUEST['action'])) {
   die;
}

// actions without IDOR
switch ($_REQUEST['action']) {
   case "fold_search":
      $user = new User();
      $success = $user->update([
         'id'          => (int) Session::getLoginUserID(),
         'fold_search' => (int) !$_REQUEST['show_search'],
      ]);

      echo json_encode(['success' => $success]);
      break;

   case 'display_results':
      if (!isset($_REQUEST['itemtype'])) {
         http_response_code(400);
         die;
      }

      /** @var CommonDBTM $itemtype */
      $itemtype = $_REQUEST['itemtype'];
      if (!$itemtype::canView()) {
         http_response_code(403);
         die;
      }

      $sort = [];
      if (isset($_REQUEST['sort'], $_REQUEST['order'])) {
         for ($i = 0, $iMax = count($_REQUEST['sort']); $i < $iMax; $i++) {
            if (!empty($_REQUEST['sort'][$i])) {
               $sort[] = [
                  'itemtype'     => $itemtype,
                  'searchopt_id' => $_REQUEST['sort'][$i],
                  'order'        => $_REQUEST['order'][$i],
               ];
            }
         }
      }

      $search_params = [
         'sort'   => $sort
      ];
      unset($_REQUEST['sort'], $_REQUEST['order']);
      $search_params = array_merge($search_params, $_REQUEST);

      $results = Search::getDatas($itemtype, $search_params);

      TemplateRenderer::getInstance()->display('components/search/display_data.html.twig', [
         'searchform_id'   => $_REQUEST['searchform_id'] ?? null,
         'itemtype'  => $results['itemtype'],
         'data'      => $results,
         'showmassiveactions'  => ($search['showmassiveactions'] ?? true)
            && $results['display_type'] != Search::GLOBAL_SEARCH
            && ($results['itemtype'] === 'AllAssets'
               || count(MassiveAction::getAllMassiveActions($results['item'], $results['search']['is_deleted']))
            ),
         'massiveactionparams' => $results['search']['massiveactionparams'] + [
            'is_deleted' => $results['search']['is_deleted'],
            'container'  => "massform{$results['itemtype']}",
         ],
         'start'               => $results['search']['start'] ?? 0,
         'limit'               => $_SESSION['glpilist_limit'],
         'count'               => $results['data']['totalcount'] ?? 0,
         'can_config'          => Session::haveRightsOr('search_config', [
            DisplayPreference::PERSONAL,
            DisplayPreference::GENERAL
         ]),
      ]);
      break;
}

if (!Session::validateIDOR($_REQUEST)) {
   die;
}

// actions with IDOR
switch ($_REQUEST['action']) {
   case "display_criteria":
      Search::displayCriteria($_REQUEST);
      break;

   case "display_meta_criteria":
      Search::displayMetaCriteria($_REQUEST);
      break;

   case "display_criteria_group":
      Search::displayCriteriaGroup($_REQUEST);
      break;

   case "display_searchoption":
      Search::displaySearchoption($_REQUEST);
      break;

   case "display_searchoption_value":
      Search::displaySearchoptionValue($_REQUEST);
      break;
}
