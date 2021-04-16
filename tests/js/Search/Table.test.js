require('../../../js/Search/Table.js');

describe('Search Table', () => {
    beforeEach(() => {
        jest.clearAllMocks();
    });
    $(document.body).append(`
    <div class="search-container">
        <form class="search-form-container">
            <input name="criteria[0][link]" value="AND"/>
            <input name="criteria[0][field]" value="view"/>
            <input name="criteria[0][searchtype]" value="contains"/>
            <input name="criteria[0][value]" value="criteria_test"/>
            <input name="is_deleted" value="0"/>
            <input name="as_map" value="0"/>
            <button name="search" type="button"/>
        </form>
        <form>
            <select class="search-limit-dropdown">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15" selected="selected">15</option>
                <option value="20">20</option>
            </select>
            <div class="ajax-container">
                <div class="table-responsive-md">
                    <table id="search_9439839" class="search-results" data-search-itemtype="Computer">
                        <thead>
                            <th data-searchopt-id="1" data-sort-order="ASC"></th>
                            <th data-searchopt-id="2" data-sort-order="nosort"></th>
                            <th data-searchopt-id="3" data-sort-order="nosort"></th>
                            <th data-searchopt-id="4" data-sort-order="nosort"></th>
                        </thead>
                    </table>
                </div>
            </div>
            <select class="search-limit-dropdown">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15" selected="selected">15</option>
                <option value="20">20</option>
            </select>
        </form>
    </div>
`);
    const real_table = new GLPI.Search.Table('search_9439839');
    $.fn.load = jest.fn().mockImplementation((url, data, callback) => {
        callback();
    });
    const jquery_load = jest.spyOn($.fn, 'load');
    const table_showSpinner = jest.spyOn(real_table, 'showLoadingSpinner');
    const table_hideSpinner = jest.spyOn(real_table, 'hideLoadingSpinner');
    const table_onLimitChange = jest.spyOn(real_table, 'onLimitChange');
    const table_onSearch = jest.spyOn(real_table, 'onSearch');

    test('Class exists', () => {
        expect(GLPI).toBeDefined();
        expect(GLPI.Search).toBeDefined();
        expect(GLPI.Search.Table).toBeDefined();
    });
    test('Constructor', () => {
        const table1 = new GLPI.Search.Table('not_a_table');
        expect(table1.getElement().length).toBe(0);

        expect(real_table.getElement().length).toBe(1);
    });
    test('getItemtype', () => {
        expect(real_table.getItemtype()).toBe('Computer');
    });
    test('getSortState', () => {
        const verify_initial_state = function() {
            let state = real_table.getSortState();
            expect(state['sort'].length).toBe(1);
            expect(state['order'].length).toBe(1);
            expect(state['sort'][0]).toBe(1);
            expect(state['order'][0]).toBe('ASC');
        }
        verify_initial_state();

        // Manually modify data for existing sorted column and test again
        real_table.getElement().find('th').eq(0).data('sort-order', 'DESC');
        let state = real_table.getSortState();
        expect(state['sort'].length).toBe(1);
        expect(state['order'].length).toBe(1);
        expect(state['sort'][0]).toBe(1);
        expect(state['order'][0]).toBe('DESC');

        // Manually add new sort
        real_table.getElement().find('th').eq(2).data('sort-order', 'ASC');
        state = real_table.getSortState();
        expect(state['sort'].length).toBe(2);
        expect(state['order'].length).toBe(2);
        expect(state['sort'][1]).toBe(3);
        expect(state['order'][1]).toBe('ASC');

        // Click to add new sort
        real_table.getElement().find('th').eq(3).click();
        state = real_table.getSortState();
        expect(state['sort'].length).toBe(3);
        expect(state['order'].length).toBe(3);
        expect(state['sort'][2]).toBe(4);
        expect(state['order'][2]).toBe('ASC');

        // Click previous column again to switch it to DESC
        real_table.getElement().find('th').eq(3).click();
        state = real_table.getSortState();
        expect(state['sort'].length).toBe(3);
        expect(state['order'].length).toBe(3);
        expect(state['sort'][2]).toBe(4);
        expect(state['order'][2]).toBe('DESC');

        // Click previous column again. We should be back at a nosort state for it (excluded from sort state).
        real_table.getElement().find('th').eq(3).click();
        state = real_table.getSortState();
        expect(state['sort'].length).toBe(2);
        expect(state['order'].length).toBe(2);
        expect(state['sort'][0]).toBe(1);
        expect(state['order'][0]).toBe('DESC');
        expect(state['sort'][1]).toBe(3);
        expect(state['order'][1]).toBe('ASC');

        // Restore sort
        const table_el = real_table.getElement();
        table_el.find('th').data('sort-order', 'nosort');
        table_el.find('th').eq(0).data('sort-order', 'ASC');
        verify_initial_state();
    });
    test('AJAX refresh on sort', () => {
        real_table.getElement().find('th').eq(0).click();
        expect(table_showSpinner).toHaveBeenCalledTimes(1);
        expect(jquery_load).toHaveBeenCalledTimes(1);
        expect(table_hideSpinner).toHaveBeenCalledTimes(1);
    });
    test('AJAX refresh on limit change', () => {
        real_table.getElement().closest('form').find('select.search-limit-dropdown').first().val(10).trigger('change');
        expect(table_showSpinner).toHaveBeenCalledTimes(1);
        expect(jquery_load).toHaveBeenCalledTimes(1);
        expect(table_hideSpinner).toHaveBeenCalledTimes(1);
        expect(table_onLimitChange).toHaveBeenCalledTimes(1);
        const dropdowns = real_table.getElement().closest('form').find('.search-limit-dropdown');
        expect(dropdowns.length).toBe(2);
        dropdowns.each(function() {
            expect($(this).val()).toBe("10");
        });
    });
    test('AJAX refresh on search', () => {
        real_table.getElement().closest('.search-container').find('form.search-form-container button[name="search"]').trigger('click');
        expect(table_showSpinner).toHaveBeenCalledTimes(1);
        expect(jquery_load).toHaveBeenCalledTimes(1);
        expect(table_hideSpinner).toHaveBeenCalledTimes(1);
        expect(table_onSearch).toHaveBeenCalledTimes(1);

        const load_data = jquery_load.mock.calls[0][1];
        expect(load_data).toHaveProperty('criteria[0][link]');
        expect(load_data['criteria[0][link]']).toBe('AND');
        expect(load_data).toHaveProperty('criteria[0][field]');
        expect(load_data['criteria[0][field]']).toBe('view');
        expect(load_data).toHaveProperty('criteria[0][searchtype]');
        expect(load_data['criteria[0][searchtype]']).toBe('contains');
        expect(load_data).toHaveProperty('criteria[0][value]');
        expect(load_data['criteria[0][value]']).toBe('criteria_test');
        expect(load_data).toHaveProperty('is_deleted');
        expect(load_data['is_deleted']).toBe('0');
        expect(load_data).toHaveProperty('as_map');
        expect(load_data['as_map']).toBe('0');
    });
    test('Show and Hide loading spinner', () => {
        const el = real_table.getElement();
        real_table.showLoadingSpinner();
        const overlay = el.find('.spinner-overlay');
        expect(overlay.length).toBe(1);
        expect(overlay.css('visibility')).toBe('visible');
        real_table.hideLoadingSpinner();
        expect(overlay.length).toBe(1);
        expect(overlay.css('visibility')).toBe('hidden');
    });
});