require('../../../js/Search/GenericView.js');

describe('Search GenericView', () => {
   beforeEach(() => {
      jest.clearAllMocks();
   });
   $(document.body).append(`
    <div class="ajax-container search-display-data">
        <div id="generic-search-view" class="search-container"></div>
    </div>
`);

   const generic_view = new GLPI.Search.GenericView('generic-search-view');
   test('Class exists', () => {
      expect(GLPI).toBeDefined();
      expect(GLPI.Search).toBeDefined();
      expect(GLPI.Search.GenericView).toBeDefined();
   });
   test('getElement', () => {
      expect(generic_view.getElement().length).toBe(1);
   });
   test('getResultsView', () => {
      generic_view.getElement().closest('.ajax-container').data('js_class', {test: 'Test'});
      expect(generic_view.getResultsView()).toBeObject();
      expect(generic_view.getResultsView()).toHaveProperty('test');
   });
});
