$(document).ready(function() {

  $('#edit_disponibilidades').on('click', 'h4 a', function() {
    toggleVisibilityWithTables('#edit_disponibilidades');
  });

  function toggleVisibilityWithTables(area) {
    console.log($(area).find('table .actions'));
    $(area).find('#form_add').toggle();
    // $(area).find('table').toggle();
    $(area).find('table .actions').toggle();
  }

});