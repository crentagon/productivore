var C_BASEURL = '';
var alreadyLoading = false;

$(document).ready(function(){
	// alert($('#thoughts-form-list-id option:selected').text());
	$('#list-last-accessed').text($('#thoughts-form-list-id option:selected').text());
	$('#thoughts-form-list-id').change(function(){
		$('#list-last-accessed').text($('#thoughts-form-list-id option:selected').text());
	});
	
	$(window).scroll(function(){
		if($(window).scrollTop() + $(window).height() == $(document).height() && !alreadyLoading) {
			alreadyLoading = true;
			$(".thoughts-loading").show();
			addThoughts();
		}
	});
	
	// alert($('.thought-item').last().attr('id'));
	// addThoughts();
	C_BASEURL = $('#BASE_URL').val();
	// alert(C_BASEURL);
});

function addThoughts(){
	var thoughtBubbleId = $('.thought-item').last().attr('thoughtBubbleId');
	var listId = $('#thoughts-form-list-id option:selected').val();
	var ajaxUrl =
		C_BASEURL+"/protagonal/getNextThoughtBubblesAjax/startingThoughtBubbleId/"+thoughtBubbleId+"/listId/"+listId+"/";

	$.ajax({
		url: ajaxUrl,
		success: function(thoughtBubbleList){
			var thoughtList = JSON.parse(thoughtBubbleList);
			
			for(var i=0; i<thoughtList.length; i++){
				var id = thoughtList[i].thought_bubble_id;
				var title = thoughtList[i].title;
				var body = thoughtList[i].body;
				var inserted_on = thoughtList[i].inserted_on;
				
				// alert(title);
				$("#thought-item-framework > .thought-item > .thought-title").text(title);
				$("#thought-item-framework > .thought-item > .thought-body").text(body);
				$("#thought-item-framework > .thought-item > .thought-footer").text(inserted_on);			
				$("#thought-item-framework > .thought-item").attr('thoughtBubbleId', id);			

				var newNode = $('#thought-item-framework').html();
				$('.additional-thoughts').append(newNode);	

			}
		},
		error: function(){
			alert("Whoops, something went wrong. Could you refresh? Thanks.");
		}		
	});
	
	$(".thoughts-loading").hide();
	alreadyLoading = false;

	// var title = "Title";
	// var body = "Body";
	// var date = "Date";
	
	// $("#thought-item-framework > .thought-item > .thought-title").text(title);
	// $("#thought-item-framework > .thought-item > .thought-body").text(body);
	// $("#thought-item-framework > .thought-item > .thought-footer").text(date);
	
	// var newNode = $('#thought-item-framework').html();
	// $('.additional-thoughts').append(newNode);
	// $('.additional-thoughts').append(newNode);
	// $('.additional-thoughts').append(newNode);
	// $('.additional-thoughts').append(newNode);
	// $('.additional-thoughts').append(newNode);
	// $('.additional-thoughts').append(newNode);
	// $('.additional-thoughts').append(newNode);
	// $('.additional-thoughts').append(newNode);
	// $('.additional-thoughts').append(newNode);
	// $('.additional-thoughts').append(newNode);
	
	// alert("Got here!");
}