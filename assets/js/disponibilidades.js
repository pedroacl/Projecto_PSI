$(document).ready(function() {

  $number_of_disp  = $('#disponibilidade_table').children().children().length - 1;
  $counter_of_disp = $number_of_disp;

  if ($number_of_disp <= 0) {
    $('#disponibilidade_table').hide('fast');
  }

  $('.datepicker').datepicker({
    format: 'yyyy/mm/dd',
    startDate: '-3d'
  });

  $('#form').on('click', 'a.adicionar_disponibilidade', function() {

    console.log("Here");

    // Get values
    $data_inicio   = $('#data_inicio_disponibilidade');
    $data_fim      = $('#data_fim_disponibilidade');

    // Remove error classes, if they exist
    $data_inicio.parent().removeClass('has-error');
    $data_fim.parent().removeClass('has-error');

    if ($data_inicio.val() !== '' && $data_fim.val() !== '') {

      // Construct table HTML
      var disp_row = "<tr id='disponibilidade_" + $counter_of_disp + "'>";

      disp_row += "<td>" + $data_inicio.val() + "</td><input type='hidden' name='disponibilidades[" + $counter_of_disp + "][data_inicio]' value='" + $data_inicio.val() + "'>";

      disp_row += "<td>" + $data_fim.val() + "</td><input type='hidden' name='disponibilidades[" + $counter_of_disp + "][data_fim]' value='" + $data_fim.val() + "'>";

      disp_row += "<td><a class='btn btn-danger btn-sm eliminar'>Eliminar</a></td>";
      disp_row += "</tr>";

      $('#disponibilidade_table').append(disp_row);

      // Clear form
      $data_inicio.val('');
      $data_fim.val('');

      $data_inicio.parent().removeClass('has-error');
      $data_fim.parent().removeClass('has-error');

      $number_of_disp++;
      $counter_of_disp++;

      if ($number_of_disp > 0) {
        $('#disponibilidade_table').show('fast');
      }
    } else {
      // If not valid
      if ($data_inicio.val() === '') {
        $data_inicio.parent().addClass('has-error');
      }
      if ($data_fim.val() === '') {
        $data_fim.parent().addClass('has-error');
      }
    }
  });

  // Add event listener to eliminar of disponibilidades
  $('body').on('click', 'a.eliminar', function() {
    $(this).parent().parent().remove();
    $number_of_disp--;
    if ($number_of_disp <= 0) {
      $('#disponibilidade_table').hide('fast');
    }
  });

});
