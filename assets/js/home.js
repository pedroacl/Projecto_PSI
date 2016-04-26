$(document).ready(function() {

	$number_of_disp = 0;
	$counter_of_disp = 0;

	$voluntario_div = $('.voluntario_fields');
	$instituicao_div = $('.instituicao_fields');

	$voluntario_fields = $voluntario_div.remove();
	$instituicao_fileds = $instituicao_div.remove();

	$header_title = $('h2');

	choose_tipo_utilizador($('#tipo_utilizador_select').val());

	$('#tipo_utilizador_select').change(function() {
		choose_tipo_utilizador($(this).val());
	});

	$('.datepicker').datepicker({
		format: 'mm/dd/yyyy',
		startDate: '-3d'
	});


	$('#form').on('click', 'div.voluntario_fields div.well div.relative a.adicionar_disponibilidade', function() {

		console.log("Here");

		// Get values
		$data_inicio = $('#data_inicio_disponibilidade');
		$periodicidade = $('#periodicidade');
		$data_fim = $('#data_fim_disponibilidade');
		$repetir_ate = $('#repetir_ate_disponibilidade');

		// Remove error classes, if they exist
		$data_inicio.parent().removeClass('has-error');
		$periodicidade.parent().removeClass('has-error');
		$data_fim.parent().removeClass('has-error');
		$repetir_ate.parent().removeClass('has-error');

		if ($data_inicio.val() !== '' && $periodicidade.val() !== '' && $data_fim.val() !== '' && $repetir_ate.val() !== '') {

			// Construct table HTML
			var disp_row = "<tr><td>" + $data_inicio.val() + "</td><td>"
				+ $data_fim.val() + "</td><td>" + $periodicidade.val() + "</td><td>"
				+ $repetir_ate.val() + "</td><td><a class='btn btn-danger btn-sm eliminar' data='"
				+ $counter_of_disp + "'>Eliminar</a>";

			// Construct hidden form data and append everything
			var hidden_form_data = "<input type='hidden' name='disponibilidades["
				+ $counter_of_disp + "][data_inicio]' value='" + $data_inicio.val()
				+ "'><input type='hidden' name='disponibilidades[" + $counter_of_disp
				+ "][data_fim]' value='" + $data_fim.val() + "'><input type='hidden' name='disponibilidades["
				+ $counter_of_disp + "][periodicidade]' value='" + $periodicidade.val()
				+ "'><input type='hidden' name='disponibilidades[" + $counter_of_disp
				+ "][repetir_ate]' value='" + $repetir_ate.val() + "'></td></tr>";

			$('#disponibilidade_table').append(disp_row);
			$('#disponibilidade_table').append(hidden_form_data);

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
	$('#disponibilidade_table').on('click', 'tr td a.eliminar', function() {
		$(this).parent().parent().remove();
		$("input[name='disponibilidades[" + $(this).attr('data') + "][periodicidade]']").remove();
		$("input[name='disponibilidades[" + $(this).attr('data') + "][repetir_ate]']").remove();
		$("input[name='disponibilidades[" + $(this).attr('data') + "][data_fim]']").remove();
		$("input[name='disponibilidades[" + $(this).attr('data') + "][data_inicio]']").remove();
		$number_of_disp--;
		if ($number_of_disp <= 0) {
			$('#disponibilidade_table').hide('fast');
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