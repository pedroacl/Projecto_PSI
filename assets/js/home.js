$(document).ready(function() {
	$volunteer_div = $('.volunteer_fields');
	$institution_div = $('.institution_fields');

	$volunteer_fields = $volunteer_div.remove();
	$institution_fileds = $institution_div.remove();

	$('#default_user_select').click(function() {
		$('.volunteer_fields').hide("slow");
		$('.institution_fields').hide("slow");
	});

	$('#institution_select').click(function() {
		$volunteer_div.remove();
		$('#user_form_end').append($institution_fileds);
	});

	$('#volunteer_select').click(function() {
		$institution_div.remove();
		$('#user_form_end').append($volunteer_fields);
	});

	$('.datepicker').datepicker({
    	format: 'mm/dd/yyyy',
   	startDate: '-3d'
	});
});
