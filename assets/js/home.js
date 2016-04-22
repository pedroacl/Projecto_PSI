$(document).ready(function() {
	$('.volunteer_fields').hide();
	$('.institution_fields').hide();

	$('#default_user_select').click(function() {
		$('.volunteer_fields').hide("slow");
		$('.institution_fields').hide("slow");
	});

	$('#institution_select').click(function() {
		$('.volunteer_fields').hide();
		$('.institution_fields').show("slow");
	});

	$('#volunteer_select').click(function() {
		$('.volunteer_fields').show("slow");
	});

	// $('.datepicker').datepicker({
	// 	format: 'mm/dd/yyyy',
	// 	startDate: '-3d'
	// });

	// alert($('.datepicker').html());
});
