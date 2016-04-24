$(document).ready(function() {

	$number_of_disp = 0;

	$volunteer_div = $('.volunteer_fields');
	$institution_div = $('.institution_fields');

	$volunteer_fields = $volunteer_div.remove();
	$institution_fileds = $institution_div.remove();

	$header_title = $('h2');

	choose_user_type($('#user_type_select').val());

	$('#user_type_select').change(function() {
		choose_user_type($(this).val());
	});

	$('.datepicker').datepicker({
		format: 'mm/dd/yyyy',
		startDate: '-3d'
	});


	$('#add_new_disp').click(function() {

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
			
			// Construct HTML and append
			var disp_row = "<tr><td>" +$data_inicio.val() + "</td><td>" + $data_fim.val() + "</td><td>" + $periodicidade.val() + "</td><td>" + $repetir_ate.val() + "</td><td><a class='btn btn-danger btn-sm eliminar'>Eliminar</a></td></tr>";
			$('#disponibilidade_table').append(disp_row);

			// Clear form
			$data_inicio.val('');
			$periodicidade.val('');
			$data_fim.val('');
			$repetir_ate.val('');

			$data_inicio.parent().removeClass('has-error');
			$periodicidade.parent().removeClass('has-error');
			$data_fim.parent().removeClass('has-error');
			$repetir_ate.parent().removeClass('has-error');

			$number_of_disp++;
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
		$number_of_disp--;
		if ($number_of_disp <= 0) {
			$('#disponibilidade_table').hide('fast');
		}
	});

});

function remove_volunteer_fields() {
	$('.volunteer_fields').hide("slow", function() {
		$volunteer_div.remove();
	});
}

function remove_institution_fields() {
	$('.institution_fields').hide("slow", function() {
		$institution_div.remove();
	});
}

function choose_user_type(value) {
	if (value === "none") {
		remove_volunteer_fields();
		remove_institution_fields();
		$header_title.html("Registar Utilizador");

	} else if(value === "volunteer") {
		remove_institution_fields();
		$('#user_form_end').append($volunteer_fields);
		$volunteer_fields.show("slow");
		$header_title.html("Registar Voluntário");

	} else if(value === "institution") {
		remove_volunteer_fields();
		$('#user_form_end').append($institution_fileds);
		$institution_fileds.show("slow");
		$header_title.html("Registar Instituição");
	}
}