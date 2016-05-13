// remover elemento


function delete_entry(url, remove_element) {
	$.ajax({
   	url: url,
   	//context: document.body
	}).done(function() {
		$(remove_element).remove( "done" );
	   // fazer remove da linha
	});
}

// adicionar elmento
function add_entry(url, add_class, content) {
	$.ajaxSubmit({
		type: "POST",
   	url: url,
   	context: content
	}).done(function() {
		$(add_class).add( "done" );
	   // fazer remove da linha
	});
}
