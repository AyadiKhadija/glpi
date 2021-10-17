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

   updateAgentDropdown(sensor_dropdown, agent_dropdown) {
      const selected_sensor = $(sensor_dropdown).val();
      $.ajax({
         method: 'GET',
         url: this.ajax_root + 'agent.php',
         data: {
            sensor: selected_sensor
         }
      }).done((agents) => {
         const options = [];
         $.each(agents, (class_name, agent_name) => {
            options.push({
               id: class_name,
               text: agent_name
            });
         });
         if (options.length > 0) {
            $(agent_dropdown).removeAttr('disabled');
         } else {
            $(agent_dropdown).attr('disabled', 'disabled');
         }
         $(agent_dropdown).empty().select2({
            data: options
         });
      });
   }

   checkHostNow(hosts_id) {
      $.ajax({
         type: 'POST',
         url: this.ajax_root + 'siemhost.php',
         data: {
            _check_now: true,
            hosts_id: hosts_id
         },
         success: function() {
            window.location.reload();
         }
      });
   }

   // checkServiceNow(services_id) {
   //    //TODO Implement
   // }

   addHostService(hosts_id) {
      $.ajax({
         type: "GET",
         url: this.ajax_root + 'servicetemplate.php',
         data: {},
         success: (servicetemplates) => {
            const template_dropdown_jobj = $("#add-host-service-modal #add-host-form .service-template-dropdown");
            const options = [];
            $.each(servicetemplates, (id, name) => {
               options.push({
                  id: id,
                  text: name
               });
            });
            if (options.length > 0) {
               template_dropdown_jobj.removeAttr('disabled');
            } else {
               template_dropdown_jobj.attr('disabled', 'disabled');
            }

            template_dropdown_jobj.empty().select2({
               data: options
            });
            template_dropdown_jobj.trigger('change');
            $('#add-host-service-modal').modal('show');

            const cancel_button = $('#add-host-service-modal button[name="cancel"]');
            cancel_button.off();
            cancel_button.on('click', () => {
               $('#add-host-service-modal').modal('hide');
            });

            const add_button = $('#add-host-service-modal button[name="add"]');
            add_button.off();
            add_button.on('click', () => {
               $.ajax({
                  method: 'POST',
                  url: this.ajax_root + `host.php/${hosts_id}/services`,
                  data: {
                     templates_id: template_dropdown_jobj.val()
                  }
               }).then(() => {
                  window.location.reload();
               });
            });
         }
      });
   }
};
