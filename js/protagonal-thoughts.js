$(document).ready(function(){
	// alert($('#thoughts-form-list-id option:selected').text());
	$('#list-last-accessed').text($('#thoughts-form-list-id option:selected').text());
	$('#thoughts-form-list-id').change(function(){
		$('#list-last-accessed').text($('#thoughts-form-list-id option:selected').text());
	});
	// alert('Hey!');
});
