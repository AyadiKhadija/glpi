/**
 * ---------------------------------------------------------------------
 * GLPI - Gestionnaire Libre de Parc Informatique
 * Copyright (C) 2015-2022 Teclib' and contributors.
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

export default class Marketplace {

   constructor() {
      this.ajax_url = CFG_GLPI.root_doc+"/ajax/marketplace.php";
      this.current_page = 1;
      this.ajax_done = false;
      this.plugins = {};
      this.PAGE_SIZE = 12;

      const icon = $('.marketplace:visible .refresh-plugin-list');
      icon
         .removeClass('fa-sync-alt')
         .addClass('fa-spinner fa-spin');
      this.getPlugins().done((plugins) => {
         $('.marketplace ul.plugins').empty();
         icon
            .removeClass('fa-spinner fa-spin')
            .addClass('fa-sync-alt');
         this.refreshView(plugins);
         this.addTooltips();
         this.plugins = plugins;
         //this.initSearch();
         this.registerListeners();
      })
   }

   }

   registerListeners() {
      // plugin actions (install, enable, etc)
      $(document).on('click', '.marketplace .modify_plugin', (e) => {
         const button     = $(e.currentTarget);
         const buttons    = button.closest('.buttons');
         const li         = button.closest('li.plugin');
         const icon       = button.children('i');
         const installed  = button.closest('.marketplace').hasClass('installed');
         const action     = button.data('action');
         const plugin_key = li.data('key');

         icon
            .removeClass()
            .addClass('fas fa-spinner fa-spin');

         if (action === 'download_plugin'
            || action === 'update_plugin') {
            this.followDownloadProgress(button);
         }

         this.ajax_done = false;
         $.post(this.ajax_url, {
            'action': action,
            'key': plugin_key
         }).done((html) => {
            this.ajax_done = true;

            if (html.indexOf("cleaned") !== -1 && installed) {
               li.remove();
            } else {
               html = html.replace('cleaned', '');
               buttons.html(html);
               displayAjaxMessageAfterRedirect();
               this.addTooltips();
            }
         });
      });

      // sort control
      $(document).on('select2:select', '.marketplace .sort-control', () => {
         this.filterPluginList();
      });

      // pagination
      $(document).on('click', '.marketplace .pagination li', (e) => {
         const li   = $(e.currentTarget);
         const page = li.data('page');

         if (li.hasClass('nav-disabled')
            || li.hasClass('current')
            || isNaN(page)) {
            return;
         }

         this.gotoPage(page);
      });

      // filter by tag
      $(document).on('click', '.marketplace .plugins-tags .tag', (e) => {
         $(".marketplace:visible .plugins-tags .tag").removeClass('active');
         $(e.currentTarget).addClass('active');
         this.filterPluginList();
      });

      // filter plugin list when something typed in search input
      let chrono;
      $(document).on('input', '.marketplace .filter-list', () => {
         clearTimeout(chrono);
         chrono = setTimeout(() => {
            this.filter();
         }, 500);
      });

      // force refresh of plugin list
      $(document).on('click', '.marketplace .refresh-plugin-list', () => {
         this.refreshPlugins(this.current_page, true);
      });
   }

   getPlugins(force, installed) {
      return $.get(this.ajax_url, {
         'action': 'get_plugins',
         'installed': installed ? 1 : 0,
         'force':  force ? 1 : 0,
      });
   }

   filterPluginList(page, force) {
      page  = page || 1;
      force = force || false;

      const marketplace  = $('.marketplace:visible');
      const pagination   = marketplace.find('ul.pagination');
      const plugins_list = marketplace.find('ul.plugins');
      const dom_tag      = marketplace.find('.plugins-tags .tag.active');
      const tag_key      = dom_tag.length ? dom_tag.data('tag') : "";
      const filter_str   = marketplace.find('.filter-list').val();
      let sort         = 'sort-alpha-desc';

      if (marketplace.find(".sort-control").length > 0) {
         sort = marketplace.find(".sort-control").select2('data')[0].element.value;
      }

      plugins_list
         .append("<div class='loading-plugins'><i class='fas fa-spinner fa-pulse'></i></div>");
      pagination.find('li.current').removeClass('current');

      const jqxhr = $.get(this.ajax_url, {
         'action': 'refresh_plugin_list',
         'tab':    marketplace.data('tab'),
         'tag':    tag_key,
         'filter': filter_str,
         'force':  force ? 1 : 0,
         'page':   page,
         'sort':   sort,
      }).done((html) => {
         plugins_list.html(html);

         const nb_plugins = jqxhr.getResponseHeader('X-GLPI-Marketplace-Total');
         $.get(this.ajax_url, {
            'action': 'getPagination',
            'page':  page,
            'total': nb_plugins,
         }).done(function(html) {
            pagination.html(html);
         });
      });

      return jqxhr;
   }

   refreshPlugins(page, force) {
      force = force || false;
      const icon = $('.marketplace:visible .refresh-plugin-list');

      icon
         .removeClass('fa-sync-alt')
         .addClass('fa-spinner fa-spin');

      $.when(this.filterPluginList(page, force)).then(() => {
         icon
            .removeClass('fa-spinner fa-spin')
            .addClass('fa-sync-alt');
         this.current_page = page;

         this.addTooltips();
      });
   }

   addTooltips() {
      $(".qtip").remove();
      $(".marketplace:visible").find("[data-action][title], .add_tooltip").qtip({
         position: {
            viewport: $(window),
            my: "center left",
            at: "center right",
            adjust: {
               x: 2,
               method: "flip"
            }
         },
         style: {
            classes: 'qtip-dark'
         },
         show: {
            solo: true, // hide all other tooltips
         },
         hide: {
            event: 'click mouseleave'
         }
      });
   }

   followDownloadProgress(button) {
      const buttons    = button.closest('.buttons');
      const li         = button.closest('li.plugin');
      const plugin_key = li.data('key');

      const progress = $('<progress max="100" value="0"></progress>');
      buttons.html(progress);

      // we call a non-blocking loop function to send ajax request with a small delay
      function loop () {
         setTimeout(() => {
            $.get(this.ajax_url, {
               'action': 'get_dl_progress',
               'key': plugin_key
            }).done((progress_value) => {
               progress.attr('value', progress_value);
               if (progress_value < 100) {
                  loop();
               } else if (!this.ajax_done) {
                  // set an animated icon when decompressing
                  buttons.html('<i class="fas fa-cog fa-spin"></i>');

                  // display messages from backend
                  displayAjaxMessageAfterRedirect();
               }
            });
         }, 300);
      }

      loop();
   }

   /**
    * Refresh view and show the requested plugins
    *
    * The displayed plugins will be sorted on the server, but paginated client-side
    * @param plugins
    */
   refreshView(plugins) {
      const marketplace  = $('.marketplace:visible');
      let sort         = 'sort-alpha-desc';

      if (marketplace.find(".sort-control").length > 0) {
         sort = marketplace.find(".sort-control").select2('data')[0].element.value;
      }

      const icon = $('.marketplace:visible .refresh-plugin-list');

      icon
         .removeClass('fa-sync-alt')
         .addClass('fa-spinner fa-spin');
      $.post({
         url: this.ajax_url,
         data: {
            'action': 'show_list',
            'plugins': Object.keys(plugins),
            'sort': sort,
            'tab': marketplace.data('tab')
         }
      }).done((html) => {
         $('.marketplace ul.plugins').html(html);

         this.addTooltips();
         this.filter();
         icon
            .removeClass('fa-spinner fa-spin')
            .addClass('fa-sync-alt');
      });
   }

   filter() {
      const search_input = $('.marketplace:visible .filter-list');
      const plugins_list = $('.marketplace:visible ul.plugins')
      const search_text = search_input.text();

      if (search_text.length > 0) {
         plugins_list.find('li').hide();
         plugins_list.find('li:contains(' + search_text + ')').show();
      } else {
         plugins_list.find('li').show();
      }
      this.paginate();
   }

   paginate() {
      const start = (this.current_page - 1) * this.PAGE_SIZE;
      const end   = start + this.PAGE_SIZE;

      // get all plugin li that are not filtered out
      const plugins = $('.marketplace:visible ul.plugins li:not(.filtered-out)');
      // hide plugins that are not in the current page
      plugins.slice(0, start).hide();
      plugins.slice(start, end).show();
      plugins.slice(end).hide();

      // Update pagination controls
      const pagination = $('.marketplace .pagination');
      const buttons = pagination.find('li[data-page]');
      const is_last_page = end >= plugins.length;
      const nb_pages = Math.ceil(plugins.length / this.PAGE_SIZE);
      const prev = Math.max(this.current_page - 1, 1);
      const next = Math.min(this.current_page + 1, nb_pages);

      pagination.empty();
      if (this.current_page === 1 && is_last_page) {
         pagination.hide();
      } else {
         pagination.show();
      }

      // Add previous button
      pagination.append(`<li data-page="${prev}" ${this.current_page <= 1 ? 'class="nav-disabled"' : ''}><i class="fas fa-angle-left"></i></li>`);

      // Calculate pagination buttons
      const page_links = (() => {
         const delta = 1;
         const left = this.current_page - delta;
         const right = this.current_page + delta + 1;
         let range = [];
         let rangeWithDots = [];
         let l;

         for (let i = 1; i <= nb_pages; i++) {
            if (i === 1 || i === nb_pages || i >= left && i < right) {
               range.push(i);
            }
         }

         for (let i of range) {
            if (l) {
               if (i - l === 2) {
                  rangeWithDots.push(l + 1);
               } else if (i - l !== 1) {
                  rangeWithDots.push('...');
               }
            }
            rangeWithDots.push(i);
            l = i;
         }

         return rangeWithDots;
      })();

      // Add pagination buttons
      for (let i of page_links) {
         if (isNaN(i)) {
            pagination.append(`<li class="nav-disabled dots">${i}</li>`);
         } else {
            pagination.append(`<li data-page="${i}" ${i === this.current_page ? 'class="active"' : ''}><span>${i}</span></li>`);
         }
      }

      // Add next button
      pagination.append(`<li data-page="${next}" ${this.current_page >= nb_pages ? 'class="nav-disabled"' : ''}><i class="fas fa-angle-right"></i></li>`);

      pagination.append(`<li class="nb_plugin">${_n('%s plugin', '%s plugins', plugins.length).replace('%s', plugins.length)}</li>`);
   }

   gotoPage(page) {
      this.current_page = page;
      this.paginate();
   }
}

window.Marketplace = Marketplace;