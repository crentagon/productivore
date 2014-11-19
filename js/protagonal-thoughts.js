var C_BASEURL = '';
var alreadyLoading = false;

$(document).ready(function(){
	$('#list-last-accessed').text($('#thoughts-form-list-id option:selected').text());
	$('#thoughts-form-list-id').change(function(){
		var listId = $('#thoughts-form-list-id option:selected').val();
		changeThoughtBubbleContent(listId);
	});	
	
	$('.list-item, .list-item-selected').click(function(){
		var listId = $(this).attr('thoughtListid');
		$('#thoughts-form-list-id').val(listId);
		changeThoughtBubbleContent(listId);
	});
	
	$(window).scroll(function(){
		if($(window).scrollTop() + $(window).height() == $(document).height() && !alreadyLoading) {
			alreadyLoading = true;
			$(".thoughts-loading").show();
			// delay = 5000;
			// setTimeout(function(){
				endlessScrollThoughts();
			//your code to be executed after 1 seconds
			// },delay); 
		}
	});
	
	C_BASEURL = $('#BASE_URL').val();
});

function changeThoughtBubbleContent(listId){
	var ajaxUrl = C_BASEURL+"/protagonal/getNextThoughtBubblesByListIdAjax/listId/"+listId+"/";
	
	$('.list-item-selected').attr('class', 'list-item');
	$('#thought-list-id-'+listId).attr('class', 'list-item-selected');
	$('#list-last-accessed').text($('#thoughts-form-list-id option:selected').text());

	addThoughts(ajaxUrl, false);
}

function endlessScrollThoughts(){
	var thoughtBubbleId = $('.thought-item').last().attr('thoughtBubbleId');
	var listId = $('#thoughts-form-list-id option:selected').val();
	var ajaxUrl = C_BASEURL+"/protagonal/getNextThoughtBubblesAjax/startingThoughtBubbleId/"+thoughtBubbleId+"/listId/"+listId+"/";

	addThoughts(ajaxUrl, true);
	
	// alert("Hiding the loading GIF.");
	// $(".thoughts-loading").hide();
	alreadyLoading = false;
}

function addThoughts(ajaxUrl, isScroll){
	$.ajax({
		url: ajaxUrl,
		success: function(thoughtBubbleList){
			// $(".thoughts-loading").hide();
			var thoughtList = JSON.parse(thoughtBubbleList);
			var len = thoughtList.length;
			
			if(!isScroll){
				$('.all-thoughts').html('');
			}
			
			if(len){
				for(var i=0; i<len; i++){
					var id = thoughtList[i].thought_bubble_id;
					var title = thoughtList[i].title;
					var body = thoughtList[i].body;
					var inserted_on = thoughtList[i].inserted_on;
					
					$("#thought-item-framework > .thought-item > .thought-title").text(title);
					$("#thought-item-framework > .thought-item > .thought-body").text(body);
					$("#thought-item-framework > .thought-item > .thought-footer").text(inserted_on);			
					$("#thought-item-framework > .thought-item").attr('thoughtBubbleId', id);			

					var newNode = $('#thought-item-framework').html();
					$('.all-thoughts').append(newNode);	
				}
			}
			else{
				if(!isScroll)
					$('.all-thoughts').append("None");	
			}
			$(".thoughts-loading").hide();
		},
		error: function(){
			alert("Whoops, something went wrong. Could you refresh? Thanks.");
			$(".thoughts-loading").hide();
		}
	});
}