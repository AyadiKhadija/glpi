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

import GenericView from './GenericView.js';

// Explicitly bind to window so Jest tests work properly
window.GLPI = window.GLPI || {};
window.GLPI.Search = window.GLPI.Search || {};

window.GLPI.Search.Table = class Table extends GenericView {

    constructor(result_view_element_id) {
        const element_id = $('#'+result_view_element_id).find('table.search-results').attr('id');
        super(element_id);
    }

    getElement() {
        return $('#'+this.element_id);
    }

    onColumnSortClick(target) {
        const target_column = $(target);
        const sort_order = target_column.data('sort-order');

        const new_order = sort_order === 'ASC' ? 'DESC' : (sort_order === 'DESC' ? 'nosort' : 'ASC');
        target_column.data('sort-order', new_order);

        this.refreshResults();
    }

    onLimitChange(target) {
        const new_limit = target.value;
        $(target).closest('form').find('select.search-limit-dropdown').each(function() {
            $(this).val(new_limit);
        });

        this.refreshResults();
    }

    onSearch() {
        this.refreshResults();
    }

    refreshResults() {
        const sort_state = this.getSortState();
        const el = this.getElement();
        const form_el = el.closest('form');
        const ajax_container = el.closest('.ajax-container');
        const limit = $(form_el).find('select.search-limit-dropdown').first().val();
        const search_form_values = $(ajax_container).closest('.search-container').find('.search-form-container').serializeArray();
        let search_criteria = {};
        search_form_values.forEach((v) => {
            search_criteria[v['name']] = v['value'];
        });

        this.showLoadingSpinner();
        $(ajax_container).load(CFG_GLPI.root_doc + '/ajax/search.php', Object.assign({
            action: 'display_results',
            searchform_id: this.element_id,
            itemtype: this.getItemtype(),
            sort: sort_state['sort'],
            order: sort_state['order'],
            glpilist_limit: limit
        }, search_criteria), () => {
            this.hideLoadingSpinner();
        });
    }

    registerListeners() {
        const ajax_container = this.getResultsView().getAJAXContainer();
        const search_container = ajax_container.closest('.search-container');

        $(ajax_container).on('click', 'table.search-results th[data-searchopt-id]', (e) => {
            e.stopPropagation();
            this.onColumnSortClick(e.target);
        });

        $(ajax_container).on('change', 'select.search-limit-dropdown', (e) => {
            this.onLimitChange(e.target);
        });

        $(search_container).on('click', '.search-form-container button[name="search"]', (e) => {
            e.preventDefault();
            this.onSearch();
        });
    }

    getItemtype() {
        return this.getResultsView().getElement().data('search-itemtype');
    }

    getSortState() {
        const columns = this.getElement().find('thead th[data-searchopt-id]:not([data-searchopt-id=""])[data-sort-order]:not([data-sort-order=""])');
        const sort_state = {
            sort: [],
            order: []
        };
        columns.each((i, c) => {
            const col = $(c);

            const order = col.data('sort-order');
            if (order !== 'nosort') {
                sort_state['sort'].push(col.data('searchopt-id'));
                sort_state['order'].push(order);
            }
        });
        return sort_state;
    }
};