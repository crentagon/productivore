var C_BASEURL = ''; 
var alreadyLoading = false;

$(document).ready(function(){
	$(".input-thought-body").jqte();
	$('#list-last-accessed').text($('#thoughts-form-list-id option:selected').text());
	$('#thoughts-form-list-id').change(function(){
		var listId = $('#thoughts-form-list-id option:selected').val();
		addThoughts(isScroll=false, listId);
	});	
	
	$('.list-item, .list-item-selected').click(function(){
		if(!alreadyLoading){
			alreadyLoading = true;
			var listId = $(this).attr('thoughtListid');
			
			$('#thoughts-form-list-id').val(listId);
			addThoughts(isScroll=false, listId);
		}
	});
	
	$(window).scroll(function(){
		if($(window).scrollTop() + $(window).height() > $(document).height()-50 && !alreadyLoading) {
			alreadyLoading = true;
			var listId = $('#thoughts-form-list-id option:selected').val();
			addThoughts(isScroll=true, listId);
		}
		
		if($(window).scrollTop() >= 250){
			$(".scroll-to-top").show();
		}
		else{
			$(".scroll-to-top").hide();
		}
	});
	
	$(".scroll-to-top").click(function() {
		$("html, body").animate({ scrollTop: 0 }, "slow");
	});
	
	C_BASEURL = $('#BASE_URL').val();
});

function addThoughts(isScroll, listId){
	var ajaxUrl = C_BASEURL+"/protagonal/GetNextThoughtBubblesAjax";
	var startingThoughtBubbleId = isScroll ? $('.thought-item').last().attr('thoughtBubbleId') : null;

	if(!isScroll) {
		$('.all-thoughts').html('');
		$('.list-item-selected').attr('class', 'list-item');
		$('#thought-list-id-'+listId).attr('class', 'list-item-selected');
		$('#list-last-accessed').text($('#thoughts-form-list-id option:selected').text());
	}

	$(".thoughts-loading").show();
	$('#thoughts-form-list-id').attr("disabled", "disabled");
	
	// delay = 5000;
	// setTimeout(function(){	
	$.ajax({
		type: 'POST',
		url: ajaxUrl,
		data: {
			'startingThoughtBubbleId': startingThoughtBubbleId,
			'listid': listId,
			'isScroll': isScroll
		},
		success: function(thoughtBubbleList){
			// $(".thoughts-loading").hide();
			var thoughtList = JSON.parse(thoughtBubbleList);
			var len = thoughtList.length;
			
			if(len){
				for(var i=0; i<len; i++){
					var id = thoughtList[i].thought_bubble_id;
					var title = thoughtList[i].title;
					var body = thoughtList[i].body;
					var inserted_on = thoughtList[i].inserted_on;
					
					$("#thought-item-framework > .thought-item > .thought-title").text(title);
					$("#thought-item-framework > .thought-item > .thought-body").html(body);
					$("#thought-item-framework > .thought-item > .thought-footer").text(inserted_on);			
					$("#thought-item-framework > .thought-item").attr('thoughtBubbleId', id);			

					var newNode = $('#thought-item-framework').html();
					$('.all-thoughts').append(newNode);	
				}
			}
			else{
				if(!isScroll)
					$('.all-thoughts').append("This lake is calm, peaceful, and conducive to pebble skipping.");
			}
			$(".thoughts-loading").hide();
			
			// if(!isScroll)
			$('#thoughts-form-list-id').attr("disabled", false);
			alreadyLoading = false;
		},
		error: function(){
			alert("Whoops, something went wrong. Could you refresh? Thanks.");
			$(".thoughts-loading").hide();
			alreadyLoading = false;
		}
	});
	// }, delay);	
	
	
}