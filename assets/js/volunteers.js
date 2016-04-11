$(document).ready(function() {
	console.log( "ready!" );

	$('.volunteer_fields').hide();
	$('.institution_fields').hide();

	$('#institution_select').click(function() {
		$('.institution_fields').show();
	})

	$('#volunteer_select').click(function() {
		$('.volunteer_fields').show();
	})
});
