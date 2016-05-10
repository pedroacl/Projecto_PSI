$(document).ready(function() {

  var areas_geograficas = {
    "Lisboa": {
      "Amadora": ["Águas Livres", "Alfragide", "Encosta do Sol"],
      "Cascais": ["Alcabideche", "Carcavelos e Parede", "Cascais e Estoril"]
    },
    "Portalegre": {
      "Avis": ["Aldeia Velha", "Avis", "Figueira e Barros"],
      "Cascais": ["Nossa Senhora da Expectação", "Nossa Senhora da Graça dos Degolados", "São João Baptista"]
    },
    "Porto": {
      "Amarante": ["Amarante", "Gondar", "Mancelos"],
      "Porto": ["Aldoar", "Bonfim", "Paranhos"]
    }
  };

  for (var key in areas_geograficas) {
    if ($('#distrito').val() !== key)
      $('#distrito').append("<option value='" + key + "'>" + key + "</option>");
  }

  for (var key2 in areas_geograficas[$('#distrito').val()]) {
    if ($('#concelho').val() !== key2)
      $('#concelho').append("<option value='" + key2 + "'>" + key2 + "</option>");
  }
  
  if (areas_geograficas[$('#distrito').val()] !== undefined) {
    $freguesias = areas_geograficas[$('#distrito').val()][$('#concelho').val()];
    for (var i = 0; i < $freguesias.length; i++) {
      if ($('#freguesia').val() !== $freguesias[i])
        $('#freguesia').append("<option value='" + $freguesias[i] + "'>" + $freguesias[i] + "</option>");
    }
  }

  $('body').on('change', '#distrito',function() {
    var concelhos = areas_geograficas[$('#distrito').val()];
    var freguesias = areas_geograficas[$('#distrito').val()][$('#concelho').val()];
    $('#concelho').children().remove();
    $('#freguesia').children().remove();
    $('#concelho').append("<option value='default'>-</option>");
    for (var key in areas_geograficas[$(this).val()]) {
      $('#concelho').append("<option value='" + key + "'>" + key + "</option>");
    }
    $('#freguesia').append("<option value='default'>-</option>");
  });

  $('body').on('change', '#concelho',function() {
    var freguesias = areas_geograficas[$('#distrito').val()][$('#concelho').val()];
    $('#freguesia').children().remove();
    $('#freguesia').append("<option value='default'>-</option>");
    for (var i = 0; i < freguesias.length; i++) {
      $('#freguesia').append("<option value='" + freguesias[i] + "'>" + freguesias[i] + "</option>");
    }
  });

});