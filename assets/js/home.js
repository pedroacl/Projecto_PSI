$(document).ready(function() {

	$number_of_disp  = $('#disponibilidade_table').children().children().length - 1;
	$counter_of_disp = $number_of_disp;

	$areas = areas_geograficas;


	for (var key in areas_geograficas) {
		$('#distrito').append("<option value='" + key + "'>" + key + "</option>");
	}

	if ($number_of_disp <= 0) {
		$('#disponibilidade_table').hide('fast');
	}

	$voluntario_div  = $('.voluntario_fields');
	$instituicao_div = $('.instituicao_fields');

	$voluntario_fields  = $voluntario_div.remove();
	$instituicao_fileds = $instituicao_div.remove();

	$header_title = $('h2');

	choose_tipo_utilizador($('#tipo_utilizador_select').val());

	$('#tipo_utilizador_select').change(function() {
		choose_tipo_utilizador($(this).val());
	});

	$('.datepicker').datepicker({
		format: 'dd/mm/yyyy',
		startDate: '-3d'
	});


	$('#form').on('click', 'div.voluntario_fields div.well div.relative a.adicionar_disponibilidade', function() {

		console.log("Here");

		// Get values
		$data_inicio   = $('#data_inicio_disponibilidade');
		$periodicidade = $('#periodicidade');
		$data_fim      = $('#data_fim_disponibilidade');
		$repetir_ate   = $('#repetir_ate_disponibilidade');

		// Remove error classes, if they exist
		$data_inicio.parent().removeClass('has-error');
		$periodicidade.parent().removeClass('has-error');
		$data_fim.parent().removeClass('has-error');
		$repetir_ate.parent().removeClass('has-error');

		if ($data_inicio.val() !== '' && $periodicidade.val() !== ''
			&& $data_fim.val() !== '' && $repetir_ate.val() !== '') {

			// Construct table HTML
			var disp_row = "<tr id='disponibilidade_" + $counter_of_disp + "'><td>"
				+ $data_inicio.val() + "</td><input type='hidden' name='disponibilidades["
				+ $counter_of_disp + "][data_inicio]' value='" + $data_inicio.val() + "'><td>"
				+ $data_fim.val() + "</td><input type='hidden' name='disponibilidades["
				+ $counter_of_disp + "][data_fim]' value='" + $data_fim.val() + "'><td>"
				+ $periodicidade.val() + "</td><input type='hidden' name='disponibilidades["
				+ $counter_of_disp + "][periodicidade]' value='" + $periodicidade.val()
				+ "'><td>" + $repetir_ate.val() + "</td><input type='hidden' name='disponibilidades["
				+ $counter_of_disp + "][repetir_ate]' value='" + $repetir_ate.val()
				+ "'><td><a class='btn btn-danger btn-sm eliminar'>Eliminar</a></td>"
				+ "</tr>";

			$('#disponibilidade_table').append(disp_row);

			// Clear form
			$data_inicio.val('');
			$periodicidade.val('Semanalmente');
			$data_fim.val('');
			$repetir_ate.val('');

			$data_inicio.parent().removeClass('has-error');
			$periodicidade.parent().removeClass('has-error');
			$data_fim.parent().removeClass('has-error');
			$repetir_ate.parent().removeClass('has-error');

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
			if ($periodicidade.val() === '') {
				$periodicidade.parent().addClass('has-error');
			}
			if ($data_fim.val() === '') {
				$data_fim.parent().addClass('has-error');
			}
			if ($repetir_ate.val() === '') {
				$repetir_ate.parent().addClass('has-error');
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
		for (var i = 0; i < freguesias.length; i++) {
			$('#freguesia').append("<option value='" + freguesias[i] + "'>" + freguesias[i] + "</option>");
		}
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

function remove_voluntario_fields() {
	$('.voluntario_fields').hide("slow", function() {
		$voluntario_div.remove();
	});
}

function remove_instituicao_fields() {
	$('.instituicao_fields').hide("slow", function() {
		$instituicao_div.remove();
	});
}

function choose_tipo_utilizador(value) {
	if (value === "none") {
		remove_voluntario_fields();
		remove_instituicao_fields();
		$header_title.html("Registar Utilizador");

	} else if(value === "voluntario") {
		remove_instituicao_fields();
		$('#utilizador_form_end').append($voluntario_fields);
		$voluntario_fields.show("slow");
		$header_title.html("Registar Voluntário");

	} else if(value === "instituicao") {
		remove_voluntario_fields();
		$('#utilizador_form_end').append($instituicao_fileds);
		$instituicao_fileds.show("slow");
		$header_title.html("Registar Instituição");
	}
}