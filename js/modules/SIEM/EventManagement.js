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

// Explicitly bind to window so Jest tests work properly
window.GLPI = window.GLPI || {};
window.GLPI.SIEM = window.GLPI.SIEM || {};

window.GLPI.SIEM.EventManagement = new class EventManagement {

   constructor() {
      this.ajax_root = CFG_GLPI.root_doc + '/ajax/siem/';
   }

   toggleEventDetails(row) {
      const id = $(row).attr('id');
      const content_row = $(`#${id}_content`);

      if (typeof content_row !== typeof undefined) {
         const hidden_attr = content_row.attr('hidden');
         if (typeof hidden_attr !== typeof undefined) {
            content_row.removeAttr('hidden');
         } else {
            content_row.attr('hidden', 'hidden');
         }
      }
   }

   updateSensorDropdown(plugin_dropdown, sensor_dropdown, linked_btn) {
      const selected_plugin = $(plugin_dropdown).val();
      $.ajax({
         type: 'GET',
         url: self.ajax_root + 'getSensors.php',
         data: {
            plugins_id: selected_plugin
         },
         success: (sensors) => {
            const sensor_dropdown_jobj = $(sensor_dropdown);
            sensor_dropdown_jobj.empty().select2({
               width: 'max-content'
            });
            if (Object.keys(sensors).length > 0) {
               sensor_dropdown_jobj.removeAttr('disabled');
               $(linked_btn).removeAttr('disabled');
            } else {
               sensor_dropdown_jobj.attr('disabled', 'disabled');
               $(linked_btn).attr('disabled', 'disabled');
            }
            $.each(sensors, function(id, name) {
               sensor_dropdown_jobj.append(new Option(name, id, false, false));
            });
            sensor_dropdown_jobj.trigger('change');
         }
      });
   }

   checkHostNow(hosts_id) {
      $.ajax({
         type: 'POST',
         url: self.ajax_root + 'siemhost.php',
         data: {
            _check_now: true,
            hosts_id: hosts_id
         },
         success: function() {
            window.location.reload();
         }
      });
   }

   checkServiceNow(services_id) {
      //TODO Implement
   }

   scheduleHostDowntime(hosts_id) {
      //TODO Implement
   }

   scheduleServiceDowntime(services_id) {
      //TODO Implement
   }

   addHostService(hosts_id) {
      $.ajax({
         type: "GET",
         url: self.ajax_root + 'getSiemServiceTemplates.php',
         data: {},
         success: (servicetemplates) => {
            $(`<div id='add-host-form'><select class='service-template-dropdown'></select></div>`).dialog({
               modal: true,
               title: "Add service from template",
               open: function() {
                  const template_dropdown_jobj = $("#add-host-form .service-template-dropdown");
                  template_dropdown_jobj.empty().select2({
                     width: 'max-content'
                  });
                  if (Object.keys(servicetemplates).length > 0) {
                     template_dropdown_jobj.removeAttr('disabled');
                     //$(linked_btn).removeAttr('disabled');
                  } else {
                     template_dropdown_jobj.attr('disabled', 'disabled');
                     //$(linked_btn).attr('disabled', 'disabled');
                  }
                  $.each(servicetemplates, function(id, name) {
                     template_dropdown_jobj.append(new Option(name, id, false, false));
                  });
                  template_dropdown_jobj.trigger('change');
               },
               buttons: {
                  Add: function() {
                     var parentDialog = $(this);
                     var templates_id = $("#add-host-form").find("select").select2('val');
                     $.ajax({
                        type: "POST",
                        url: self.ajax_root + 'siemhost.php',
                        data: {
                           _add_service: true,
                           hosts_id: hosts_id,
                           servicetemplates_id: templates_id
                        },
                        success: function() {
                           window.location.reload();
                        },
                        complete: function() {
                           parentDialog.dialog('close');
                        }
                     });
                  }
               }
            });
         }
      });
   }
};
