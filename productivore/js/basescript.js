//CONSTANTS
	var C_ASC = 1;
	var C_DESC = 0;
	var C_ALPHA = 0;
	var C_FREQ = 1;
	var sidebarSpeed = 256;

$(document).ready(function() {
	showSidebar();
	
	// $("#sidebar-gridview").hide(); $("#sidebar-listview").show(); $("#pvore-sidebar-viewtype").text("LIST VIEW"); //Show listview
	// $("#sidebar-gridview").show(); $("#sidebar-listview").hide(); //Show gridview
	
	// sidebarViewBy('grid');
	// sidebarViewBy('list');
	// showDropdownOptions();
	// showDropdownOptions();
	// alert($('.pvore-sidebar-app-container').attr('id'));
	showDropdownOptions();
	// alert($('.pvore-sidebar-app-container').attr('id'));
	// alert($('.pvore-sidebar-app-container').attr('id'));
	showDropdownOptions();
	showDropdownOptions();
	// showDropdownOptions();
	showDropdownOptions();
	
	// alert($('.pvore-sidebar-app-container').attr('id'));
	
	sidebarOrderBy(C_ALPHA, C_DESC);
	sidebarOrderBy(C_ALPHA, C_DESC);
	sidebarOrderBy(C_FREQ, C_ASC);
	sidebarOrderBy(C_FREQ, C_DESC);
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
	});
	
	//Colors
	// $.each($('.appling-icon'),
		// function(){
			// $(this).css('color', $(this).attr('color'));
		// }
	// );
});


function sidebarOrderBy(parameter, order){
	var appElement = '.pvore-sidebar-app';
	var appContainer = '#sidebar-listview';
	var hrElement = '<hr class="appling-hr" style="display:block"/>';
	var appTitle = '.appling-name-list';
	
	if($("#pvore-sidebar-viewtype").text() == 'GRID VIEW'){
		appElement = '.pvore-sidebar-app-grid';
		appContainer = '#sidebar-gridview';
		hrElement = '<hr class="appling-hr" style="display:none"/>';
		appTitle = '.appling-name-grid';
	}

	appCount = $(appElement).length;
	// alert(appCount);
	
	var sortedApplings = new Array();
	
	// if($("#pvore-sidebar-viewtype").text() == 'LIST VIEW'){
	$.each($('.appling-hr'),
		function (index){
			$(this).remove();
		}
	);
	// }
	if(parameter == C_FREQ){	
		//do the following while there are still elements in the thing
		for(i=0; i<appCount; i++){
			if(order == C_ASC){
				lowest = 65536;
				chosenId = '';
				//pick the div with the lowest access count
				$.each($(appElement),
					function (){
						if(lowest >= $(this).attr('accessCount')){
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
				$.each($(appElement),
					function (){
						if(highest <= $(this).attr('accessCount')){
							chosenId = $(this).attr('id');
							highest = $(this).attr('accessCount');
						}
					}
				);
			}
			sortedApplings[i] = $('#'+chosenId).remove();
		}
	}
	
	else if(parameter == C_ALPHA){
		// alert(appCount);
		for(i=0; i<appCount; i++){
			lowest = "zzzzzzzzzzzzzzzzzzzzzz";
			chosenId = '';
			
			$.each($(appTitle),
				function (){
					if(lowest >= $(this).text().toLowerCase()){
						chosenId = $(this).parent().attr('id');
						lowest = $(this).text().toLowerCase();
					}
				}
			);
			// alert('#'+chosenId);
			sortedApplings[i] = $('#'+chosenId).remove();
		}
	}
	
	//add the div in the thing
	for(i=0; i<appCount; i++){
		if(i<appCount-1){
			$(appContainer).append(sortedApplings[i]).append(hrElement);
		} else {
			$(appContainer).append(sortedApplings[i]);
		}
	}
	
}

function showDropdownOptions(){
	if($("#pvore-sidebar-viewtype").text() == 'GRID VIEW'){
		
		$.each($('.pvore-sidebar-app-grid'),
			function (){
				var baseId = $(this).attr('baseId');
				$(this).attr('id', baseId+'-list');
			}
		);		
		$('.pvore-sidebar-app-container').attr('id', 'sidebar-listview');
		
		$("#pvore-sidebar-viewtype").text("LIST VIEW");
		$('.pvore-sidebar-app-grid').attr('class', 'pvore-sidebar-app');
		$('.appling-icon-notification-grid').attr('class', 'appling-icon-notification');
		$('.appling-name-grid').attr('class', 'pvore-sidebar-app-title appling-name-list');
		$('.pvore-nostyle').attr('class', 'pvore-sidebar-app-image');
		$('#appling-x-grid').attr('id', 'appling-x-list');
		$('.pvore-sidebar-app-description').show();
		$('.appling-hr').show();
	}
	else{
		
		$.each($('.pvore-sidebar-app'),
			function (){
				var baseId = $(this).attr('baseId');
				$(this).attr('id', baseId+'-grid');
			}
		);	
		$('.pvore-sidebar-app-container').attr('id', 'sidebar-gridview');
	
		$("#pvore-sidebar-viewtype").text("GRID VIEW");
		$('.pvore-sidebar-app').attr('class', 'pvore-sidebar-app-grid');
		$('.appling-icon-notification').attr('class', 'appling-icon-notification-grid');
		$('.appling-name-list').attr('class', 'pvore-sidebar-app-title appling-name-grid');
		$('.pvore-sidebar-app-image').attr('class', 'pvore-nostyle');
		$('.pvore-sidebar-app-description').hide();
		$('.appling-hr').hide();
		
	}
	
	
	if($("#pvore-sidebar-viewtype-arrow").text() == '▲')
		$("#pvore-sidebar-viewtype-arrow").text("▼");
	else
		$("#pvore-sidebar-viewtype-arrow").text("▲");
	
	// if(parameter == 'viewtype'){
		// $("#sidebar-gridview").toggle();
		// $("#sidebar-listview").toggle();
		// if($("#pvore-sidebar-viewtype").text() == 'GRID VIEW')
			// $("#pvore-sidebar-viewtype").text("LIST VIEW");
		// else
			// $("#pvore-sidebar-viewtype").text("GRID VIEW");
		// if($("#pvore-sidebar-viewtype-arrow").text() == '▲')
			// $("#pvore-sidebar-viewtype-arrow").text("▼");
		// else
			// $("#pvore-sidebar-viewtype-arrow").text("▲");
	// }
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