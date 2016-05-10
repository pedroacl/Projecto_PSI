$(document).ready(function() {

  $edit_areas_interesse = false;
  $edit_grupos_atuacao = false;
  $edit_habilitacoes = false;
  $edit_disponibilidades = false;

  $('#edit_areas_interesse').on('click', 'h4 a', function() {
    toggleVisibility('#edit_areas_interesse');
  });

  $('#edit_grupos_atuacao').on('click', 'h4 a', function() {
    toggleVisibility('#edit_grupos_atuacao');
  });

  $('#edit_habilitacoes').on('click', 'h4 a', function() {
    toggleVisibilityWithTables('#edit_habilitacoes');
  });

  $('#edit_disponibilidades').on('click', 'h4 a', function() {
    toggleVisibilityWithTables('#edit_disponibilidades');
  });

  function toggleVisibility(area) {
    $(area + " ul").find('a').toggle();
    $(area).find('.form-inline').toggle();
  }

  function toggleVisibilityWithTables(area) {
    console.log($(area).find('table .actions'));
    $(area).find('#form_add').toggle();
    $(area).find('table .actions').toggle();
  }

});