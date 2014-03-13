var asc = 1;
var desc = 0;

$(document).ready(function() {
	showSidebar();
	
	$("#sidebar-gridview").hide(); $("#sidebar-listview").show(); $("#pvore-sidebar-viewtype").text("LIST VIEW"); //Show listview
	// $("#sidebar-gridview").show(); $("#sidebar-listview").hide(); //Show gridview
	
	// sidebarOrderBy('alphabetical', asc);
	// sidebarViewBy('grid');
	// sidebarViewBy('list');
	
	//Notification div width
	$.each($('.appling-icon-notification'),
		function (){
			$(this).css('width', ($(this).html().length)*11);
		}
	);
	
	$.each($('.appling-icon-notification-grid'),
		function (){
			$(this).css('width', ($(this).html().length)*13);
		}
	);
	
	
	
	//Live appling search function
	$('#pvore-sidebar-search').keyup(function(){
		var filter = $(this).val();
		var searchParam = new RegExp(filter, "gi");
		
		$('.pvore-sidebar-app-title').each(function(){
			if($(this).text().search(searchParam) < 0){
				$(this).parent("div").hide();
				$(this).parent("div").next().hide();
				
			}
			else{
				$(this).parent("div").show();
				$(this).parent("div").next().show();
			}
		});
		
		$('.appling-name-grid').each(function(){
			if($(this).text().search(searchParam) < 0){
				$(this).parent("div").hide();
				$(this).parent("div").next().hide();
				
			}
			else{
				$(this).parent("div").show();
				$(this).parent("div").next().show();
			}
		});
	});
	
	//Colors
	// $.each($('.appling-icon'),
		// function(){
			// $(this).css('color', $(this).attr('color'));
		// }
	// );
});

var sidebarSpeed = 256;

function sidebarViewBy(viewType){
	if(viewType=='grid'){
		
	}
}

function sidebarOrderBy(parameter, order){
	appCount = $('.pvore-sidebar-app').length;
	var sortedApplings = new Array();
	
	$.each($('.appling-hr'),
		function (index){
			$(this).remove();
		}
	);

	if(parameter == 'frequency'){			
		//do the following while there are still elements in the thing
		for(i=0; i<appCount; i++){
			if(order == asc){
				lowest = 65536;
				chosenId = '';
				//pick the div with the lowest access count
				$.each($('.pvore-sidebar-app'),
					function (){
						if(lowest >= $(this).attr('accessCount')){
							// alert("THEID"+$(this).attr('id'));
							chosenId = $(this).attr('id');
							lowest = $(this).attr('accessCount');
						}
					}
				);
			}
			else{
				highest = 0;
				chosenId = '';
				//pick the div with the lowest access count
				$.each($('.pvore-sidebar-app'),
					function (){
						if(highest <= $(this).attr('accessCount')){
							chosenId = $(this).attr('id');
							highest = $(this).attr('accessCount');
						}
					}
				);
			}
			// hr = $('#'+chosenId).next().remove();	
			sortedApplings[i] = $('#'+chosenId).remove();
		}
	}
	
	else if(parameter == 'alphabetical'){
		for(i=0; i<appCount; i++){
			lowest = "zzzzzzzzzzzzzzzz";
			chosenId = '';
			
			$.each($('.pvore-sidebar-app-title'),
				function (){
					if(lowest >= $(this).text().toLowerCase()){
						chosenId = $(this).parent().attr('id');
						lowest = $(this).text().toLowerCase();
					}
				}
			);
			sortedApplings[i] = $('#'+chosenId).remove();
		}
	}
	
	//add the div in the thing
	for(i=0; i<appCount; i++){
		if(i<appCount-1)
			$('.pvore-sidebar-app-container').append(sortedApplings[i]).append('<hr class="appling-hr"/>');
		else
			$('.pvore-sidebar-app-container').append(sortedApplings[i]);
	}
}

function showDropdownOptions(parameter){
	if(parameter == 'viewtype'){
		$("#sidebar-gridview").toggle();
		$("#sidebar-listview").toggle();
		if($("#pvore-sidebar-viewtype").text() == 'GRID VIEW')
			$("#pvore-sidebar-viewtype").text("LIST VIEW");
		else
			$("#pvore-sidebar-viewtype").text("GRID VIEW");
		if($("#pvore-sidebar-viewtype-arrow").text() == '▲')
			$("#pvore-sidebar-viewtype-arrow").text("▼");
		else
			$("#pvore-sidebar-viewtype-arrow").text("▲");
	}
	// alert('showing dropdown options: '+parameter);
}

function showSidebar(){
	$('.pvore-dimmer').fadeIn(sidebarSpeed);
	$('.pvore-minima').show().animate({'left': '30%', 'opacity': '1'}, sidebarSpeed);
	$('.pvore-sidebar-container').show().animate({'left': '0%', 'display': 'block'}, sidebarSpeed);
	$('.pvore-sidebar-button').fadeOut(sidebarSpeed/4);
}

function hideSidebar(){
	$('.pvore-dimmer').fadeOut(sidebarSpeed/2);
	$('.pvore-sidebar-container').animate({'left': '-30%'}, sidebarSpeed).fadeOut(sidebarSpeed/2);
	$('.pvore-minima').animate({'left': '0%', 'opacity': '0'}, sidebarSpeed).fadeOut(sidebarSpeed/2);
	$('.pvore-sidebar-button').fadeIn(sidebarSpeed/2);
}

// function 