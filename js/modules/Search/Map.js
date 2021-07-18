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

/* global CFG_GLPI */

import GenericView from './GenericView.js';

// Explicitly bind to window so Jest tests work properly
window.GLPI = window.GLPI || {};
window.GLPI.Search = window.GLPI.Search || {};

window.GLPI.Search.Map = class Map extends GenericView {

   constructor(result_view_element_id) {
      const element_id = $('#'+result_view_element_id).find('.map-container').attr('id');
      super(element_id);
      this.map = initMap($('#'+element_id), 'map', 'full');
   }

   getElement() {
      return $('#'+this.element_id);
   }

   loadMap() {
      const map_elt = this.element_id;
      const loadMap = this.loadMap;

      L.AwesomeMarkers.Icon.prototype.options.prefix = 'far';
      const _micon = 'circle';

      const stdMarker = L.AwesomeMarkers.icon({
         icon: _micon,
         markerColor: 'blue'
      });

      const aMarker = L.AwesomeMarkers.icon({
         icon: _micon,
         markerColor: 'cadetblue'
      });

      const bMarker = L.AwesomeMarkers.icon({
         icon: _micon,
         markerColor: 'purple'
      });

      const cMarker = L.AwesomeMarkers.icon({
         icon: _micon,
         markerColor: 'darkpurple'
      });

      const dMarker = L.AwesomeMarkers.icon({
         icon: _micon,
         markerColor: 'red'
      });

      const eMarker = L.AwesomeMarkers.icon({
         icon: _micon,
         markerColor: 'darkred'
      });


      //retrieve geojson data
      map_elt.spin(true);
      $.ajax({
         dataType: 'json',
         method: 'POST',
         url: CFG_GLPI.root_doc+'/ajax/map.php',
         data: {
            itemtype: itemtype,
            params: ""//TODO ".json_encode($params)."
         }
      }).done(function(data) {
         const _points = data.points;
         const _markers = L.markerClusterGroup({
            iconCreateFunction: function(cluster) {
               const childCount = cluster.getChildCount();

               const markers = cluster.getAllChildMarkers();
               let n = 0;
               for (let i = 0; i < markers.length; i++) {
                  n += markers[i].count;
               }

               let c = ' marker-cluster-';
               if (n < 10) {
                  c += 'small';
               } else if (n < 100) {
                  c += 'medium';
               } else {
                  c += 'large';
               }

               return new L.DivIcon({ html: '<div><span>' + n + '</span></div>', className: 'marker-cluster' + c, iconSize: new L.Point(40, 40) });
            }
         });

         const typename = ''; //TODO
         const fulltarget = ''; //TODO

         $.each(_points, (index, point) => {
            let _title = `
                <strong>${point.title}</strong><br/>
                <a href="${fulltarget.replace(/CURLOCATION/, point.loc_id)}">${sprintf(__('%1$s %2$s'), 'COUNT', typename).replace(/COUNT/, point.count)}</a>
            `;
            if (point.types) {
               $.each(point.types, function(tindex, type) {
                  _title += '<br/>'+sprintf(__('%1$s %2$s'), 'COUNT', 'TYPE').replace(/COUNT/, type.count).replace(/TYPE/, type.name);
               });
            }
            let _icon = stdMarker;
            if (point.count < 10) {
               _icon = stdMarker;
            } else if (point.count < 100) {
               _icon = aMarker;
            } else if (point.count < 1000) {
               _icon = bMarker;
            } else if (point.count < 5000) {
               _icon = cMarker;
            } else if (point.count < 10000) {
               _icon = dMarker;
            } else {
               _icon = eMarker;
            }
            const _marker = L.marker([point.lat, point.lng], { icon: _icon, title: point.title });
            _marker.count = point.count;
            _marker.bindPopup(_title);
            _markers.addLayer(_marker);
         });

         map_elt.addLayer(_markers);
         map_elt.fitBounds(
            _markers.getBounds(), {
               padding: [50, 50],
               maxZoom: 12
            }
         );
      }).fail(function (response) {
         const _data = response.responseJSON;
         let _message = __('An error occured loading data :(');
         if (_data.message) {
            _message = _data.message;
         }
         const fail_info = L.control();
         fail_info.onAdd = function (map) {
            this._div = L.DomUtil.create('div', 'fail_info');
            this._div.innerHTML = _message + `
                <br/><span id="reload_data"><i class="fa fa-sync"></i>${__('Reload')}</span>`;
            return this._div;
         };
         fail_info.addTo(map_elt);
         $('#reload_data').on('click', function() {
            $('.fail_info').remove();
            loadMap();
         });
      }).always(function() {
         //hide spinner
         map_elt.spin(false);
      });
   }

   refreshResults(search_overrides = {}) {
      this.showLoadingSpinner();
      this.loadMap();
      this.hideLoadingSpinner();
   }

   registerListeners() {

   }

   getItemtype() {
      return this.getElement().closest('form').attr('data-search-itemtype');
   }
};
