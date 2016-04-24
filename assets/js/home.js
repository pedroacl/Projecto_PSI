$(document).ready(function() {
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