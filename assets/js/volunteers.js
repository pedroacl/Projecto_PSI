$(document).ready(function() {
	console.log( "ready!" );

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

	var geographic_areas = new Array();
	geographic_areas['1'] = 'Lisboa';
	geographic_areas['2'] = 'Leiria';
	geographic_areas['3'] = 'Santarem';

	var academic_qualifications = new Array();
	academic_qualifications['1'] = 'Licenciatura';
	academic_qualifications['2'] = 'Mestrado';

	// alert($('#geographic_areas').html());

});
