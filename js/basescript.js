//CONSTANTS
	var C_ASC = 1;
	var C_DESC = 0;
	var C_ALPHA = 0;
	var C_FREQ = 1;
	var C_FAVE = 2;
	var C_SIDEBARSPEED = 386;
	// var C_WINDOWLOCATION = window.location;
	// var C_BASEURL = C_WINDOWLOCATION.protocol + "//" + C_WINDOWLOCATION.host + "/" + C_WINDOWLOCATION.pathname.split('/')[1]+"/";
	var C_BASEURL = '';
	
$(document).ready(function() {
	var editableTextTrigger = false;
	var readyToClick = 1;

	C_BASEURL = $('#BASE_URL').val();

	//Set the orderby and the viewby
	setOrderBy();
	setViewBy();
	
	//Tests:
	// updateSidebarSettings(1, 3);
	// showSidebar();
	
	// toggleOrderBy();
	// changeView(); //It's list view by default. Uncomment to switch to grid view.
	// orderBy('sidebar-order-2'); //It has a weird arrangement by default. Uncomment for alphabetical.
	// orderBy('sidebar-order-1'); //It has a weird arrangement by default. Uncomment for "most used".
	
	//Flash messages exit button
	$(document).on('click', '.flash-msg-exit', function(){
		$(this).parent("div").fadeOut(C_SIDEBARSPEED);
	});
	
	$(document).on('click', '.flash-icon-container', function(){
		$(this).parent("div").fadeOut(C_SIDEBARSPEED);
	});
	
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
				if($(this).attr('class') == 'pvore-sidebar-app-title appling-name-list')
					$(this).parent("div").next().hide();
				
			}
			else{
				$(this).parent("div").show();
				if($(this).attr('class') == 'pvore-sidebar-app-title appling-name-list')
					$(this).parent("div").next().show();
			}
		});
	});
	
	$(document.body)
		.on('click', '.editable-text', function(){
			var current = $(this).html();
			
			if(current.trim() == '- - -'){
				current = '';
			}
			
			current = '<input type="text" class="editing-text" value="'+current.trim()+'"/>';
			
			var doneButton = '&nbsp;<div class="completed-check editable-done"><span class="fa fa-check"></span></div>';
			$(this).parent().html(current+doneButton);
			
			editableTextTrigger = true;
			
			$('.editing-text').on('click', function(e){
				e.stopPropagation();
			});
			
		})
		.on('click', '.editable-textarea', function(){
			var current = $(this).html();
			
			if(current.trim() == '- - -'){
				current = '';
			}
			
			var regex1 = new RegExp('<br>', 'g');
			var regex2 = new RegExp('<br/>', 'g');
			var maxlength = $(this).attr('maxlength');
			current = '<textarea class="editing-textarea" maxlength="'+maxlength+'">'+current.trim().replace(regex1, '\n').replace(regex2, '\n')+'</textarea>';
			
			var doneButton = '&nbsp;<div class="completed-check editable-textarea-done"><span class="fa fa-check"></span></div>';
			$(this).parent().html(current+doneButton);
			
			editableTextTrigger = true;
			
			$('.editing-textarea').on('click', function(e){
				e.stopPropagation();
			});
			
		})
		.on('click', '.editable-done', function(){
			var ajaxUrl = $(this).parent().attr('ajaxUrl');
			var ajaxId = $(this).parent().attr('ajaxId');
			var ajaxField = $(this).parent().attr('ajaxField');
			var ajaxValue = $(this).parent().children('input').val().replace('/', '&sol;').trim();
			
			$('.editing-text').off('click');
				
			editableTextTrigger = false;
			readyToClick = 1;
			
			var newValue = '<span class="editable-text">- - -</span>';
			
			if($(this).parent().children('input').val().trim() != ''){
				newValue = '<span class="editable-text">'+$(this).parent().children('input').val().trim()+'</span>';
			}
			
			ajaxUrl = ajaxUrl.replace(":id", ajaxId).replace(":field", ajaxField).replace(":value", ajaxValue);
			
			$(this).parent().html(newValue);			
			
			var xmlhttp;
	
			if (window.XMLHttpRequest)
				xmlhttp=new XMLHttpRequest();
			else
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				
			xmlhttp.onreadystatechange=function(){
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					var json = JSON.parse(xmlhttp.responseText);
					
					for(key in json){
						var messageText = ''+
							'<div class="flash-msg flash-'+key+' flash-fixed-box-shadow">'+
								'<div class="flash-icon-container">'+
									'<span class="flash-icon fa fa-check-circle fa-2x"></span>'+
								'</div>'+
									json[key]+
								'<span class="flash-msg-exit fa fa-times"></span>'+
							'</div>'+
						'';
						appendToFlashMessagesFixed(messageText);
						
						if(key == 'error'){
							window.setTimeout(function(){window.location.reload()}, 2048);
						}
					}
					
				}
			}
			
			xmlhttp.open("GET", ajaxUrl, true);
			xmlhttp.send();
		})
		.on('click', '.editable-textarea-done', function(){
			var regex = new RegExp('\n', 'g');
			
			var ajaxValue = $(this).parent().children('textarea').val().replace('/', '&sol;').replace(regex, '<br>');
			var ajaxId = $(this).parent().attr('ajaxId');
			var ajaxField = $(this).parent().attr('ajaxField');
			var ajaxUrl = $(this).parent().attr('ajaxUrl');
			
			$('.editing-textarea').off('click');
				
			editableTextTrigger = false;
			readyToClick = 1;
			
			var newValue = '<span class="editable-textarea">- - -</span>';
			
			if(ajaxValue != ''){
				newValue = '<span class="editable-textarea">'+ajaxValue+'</span>';
			}
			ajaxUrl = ajaxUrl.replace(":id", ajaxId).replace(":field", ajaxField).replace(":value", ajaxValue);
			
			$(this).parent().html(newValue);			
			
			var xmlhttp;
	
			if (window.XMLHttpRequest)
				xmlhttp=new XMLHttpRequest();
			else
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				
			xmlhttp.onreadystatechange=function(){
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					var json = JSON.parse(xmlhttp.responseText);
					
					for(key in json){
						var messageText = ''+
							'<div class="flash-msg flash-'+key+' flash-fixed-box-shadow">'+
								'<div class="flash-icon-container">'+
									'<span class="flash-icon fa fa-check-circle fa-2x"></span>'+
								'</div>'+
									json[key]+
								'<span class="flash-msg-exit fa fa-times"></span>'+
							'</div>'+
						'';
						appendToFlashMessagesFixed(messageText);
						
						if(key == 'error'){
							window.setTimeout(function(){window.location.reload()}, 2048);
						}
					}
				}
			}
			
			xmlhttp.open("GET", ajaxUrl, true);
			xmlhttp.send();
			
		})
		.on('keyup', '.editing-text', function(e){
			if(e.which == 13)
				$('.editable-done').trigger('click');
				
			// alert(e.which);
		});
		
	$(document).on('click', function(e){
		if(editableTextTrigger){
			readyToClick -= 1;
		}
		if(readyToClick < 0){
			$('.editable-done').trigger('click');
			$('.editable-textarea-done').trigger('click');
		}
	});
	

	
	
	//Colors
	// $.each($('.appling-icon'),
		// function(){
			// $(this).css('color', $(this).attr('color'));
		// }
	// );
});


function setOrderBy(){
	if($('#orderBySettings').val() == 1){
		orderBy('sidebar-order-2', false);
	}
	else if($('#orderBySettings').val() == 2){
		orderBy('sidebar-order-1', false);
	}
	else if($('#orderBySettings').val() == 6){
		orderBy('sidebar-order-3', false);
	}
	else if($('#orderBySettings').val() == 3){
		toggleOrderBy();
	}
	toggleOrderBy();
}

function updateSidebarSettings(fieldid, valueid){
	var xmlhttp;
	
	if (window.XMLHttpRequest)
		xmlhttp=new XMLHttpRequest();
	else
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	
	// xmlhttp.onreadystatechange=function(){
		// if (xmlhttp.readyState==4 && xmlhttp.status==200){
			// $('#calendar_invisible').html(xmlhttp.responseText);
			// get_firstday_bymonthyear(document.getElementById("table_year").innerHTML, document.getElementById("hidden_tablemonth").innerHTML, 0, 1);
			// alert("Updated!");
		// }
		// else{
			// alert("Updating...: "+fieldid+">>>"+valueid);
		// }
	// }
	
	xmlhttp.open("GET", C_BASEURL+"/site/update_sidebarfields?fieldid="+fieldid+"&valueid="+valueid,true);
	xmlhttp.send();
}

function setViewBy(){
	// alert($('#viewBySettings').val());
	if($('#viewBySettings').val() == 5){
		changeView(false);
	}
	$("#pvore-sidebar-viewtype-arrow").text("▼");
}

function toggleOrderBy(){
	
	if($("#pvore-sidebar-frequency-arrow").text() == '▲'){
		$("#pvore-sidebar-frequency-arrow").text("▼");
		$('.order-by-options').toggle();
		// $('.order-by-options').animate({'display': 'none'}, C_SIDEBARSPEED);
	} else{
		$("#pvore-sidebar-frequency-arrow").text("▲");
		$('.order-by-options').toggle();
		// $('.order-by-options').show().animate({'height': '100%'}, C_SIDEBARSPEED);
		// $('.order-by-options').show("slide", { direction: "down" }, 1000);
		
	}
}

function orderBy(idTag, willUpdate){
	// alert($('#'+idTag).text()+"<<");
	var fieldid = 0;
	var valueid = 0;
	if($('#'+idTag).text() == 'ALPHABETICAL'){
		fieldid = 1; valueid = 1; //In the setting_field_value_maps table, orderby = 1 and alphabetical = 1
		sidebarOrderBy(C_ALPHA, C_DESC);
		$('#current-order').text('ALPHABETICAL');
		$('#sidebar-order-1').text('LEAST USED');
		$('#sidebar-order-2').text('MOST USED');
		$('#sidebar-order-3').text('FAVORITES');
		toggleOrderBy();
	} else if($('#'+idTag).text() == 'LEAST USED'){
		fieldid = 1; valueid = 3; //In the setting_field_value_maps table, orderby = 1 and least used = 3
		sidebarOrderBy(C_FREQ, C_ASC);
		$('#current-order').text('LEAST USED');
		$('#sidebar-order-1').text('ALPHABETICAL');
		$('#sidebar-order-2').text('MOST USED');
		$('#sidebar-order-3').text('FAVORITES');
		toggleOrderBy();
	} else if($('#'+idTag).text() == 'MOST USED'){
		fieldid = 1; valueid = 2; //In the setting_field_value_maps table, orderby = 1 and most used = 2
		sidebarOrderBy(C_FREQ, C_DESC);
		$('#current-order').text('MOST USED');
		$('#sidebar-order-1').text('ALPHABETICAL');
		$('#sidebar-order-2').text('LEAST USED');
		$('#sidebar-order-3').text('FAVORITES');
		toggleOrderBy();
	} else if($('#'+idTag).text() == 'FAVORITES'){
		fieldid = 1; valueid = 6; //In the setting_field_value_maps table, orderby = 1 and favorites = 6
		sidebarOrderBy(C_FAVE, C_DESC);
		$('#current-order').text('FAVORITES');
		$('#sidebar-order-1').text('ALPHABETICAL');
		$('#sidebar-order-2').text('LEAST USED');
		$('#sidebar-order-3').text('MOST USED');
		toggleOrderBy();
	}
	
	if(willUpdate && fieldid != 0 && valueid != 0)
		updateSidebarSettings(fieldid, valueid);
}

function sidebarOrderBy(parameter, order){
	var appElement = '.pvore-sidebar-app';
	var appContainer = '#sidebar-listview';
	//var hrElement = '<hr class="appling-hr" style="display:block"/>';
	var appTitle = '.appling-name';
	// var appTitle = '.appling-name-list';
	
	if($("#pvore-sidebar-viewtype").text() == 'GRID VIEW'){
		appElement = '.pvore-sidebar-app-grid';
		appContainer = '#sidebar-gridview';
		//hrElement = '<hr class="appling-hr" style="display:none"/>';
		// appTitle = '.appling-name-grid';
	}

	appCount = $(appElement).length;
	// alert(appCount);
	
	var sortedApplings = new Array();
	
	// if($("#pvore-sidebar-viewtype").text() == 'LIST VIEW'){
	// $.each($('.appling-hr'),
		// function (index){
			// $(this).remove();
		// }
	// );
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
						if(lowest >= $(this).attr('accesscount')){
							chosenId = $(this).attr('id');
							lowest = $(this).attr('accesscount');
						}
					}
				);
			}
			else{
				highest = 0;
				chosenId = '';
				//pick the div with the highest access count
				$.each($(appElement),
					function (){
						if(highest <= $(this).attr('accesscount')){
							chosenId = $(this).attr('id');
							highest = $(this).attr('accesscount');
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
						chosenId = $(this).parent().parent().attr('id');
						lowest = $(this).text().toLowerCase();
					}
				}
			);
			sortedApplings[i] = $('#'+chosenId).remove();
		}
	}
	
	else if(parameter == C_FAVE){
		for(i=0; i<appCount; i++){
			highest = 0;
			chosenId = '';
			//pick the div with the highest access count
			$.each($(appElement),
				function (){
					if(highest <= $(this).attr('isfavorite')){
						chosenId = $(this).attr('id');
						highest = $(this).attr('isfavorite');
					}
				}
			);
			/*chosenId = '';
			$.each($(appElement),
				function (){
					if($(this).attr('isfavorite') == 0){
						chosenId = $(this).attr('id');
					}
				}
			);			
			alert('#'+chosenId+">>>"+i);
			sortedApplings[i] = $('#'+chosenId).remove();
		}
		for(i; i<appCount; i++){
			$.each($(appElement),
				function (){
					chosenId = $(this).attr('id');
				}
			);
			alert('#'+chosenId+">>>"+i);*/
			sortedApplings[i] = $('#'+chosenId).remove();
		}
	}
	
	//add the div in the thing
	for(i=0; i<appCount; i++){
		// if(i<appCount-1){
			//$(appContainer).append(sortedApplings[i]).append(hrElement);
		// } else {
			$(appContainer).append(sortedApplings[i]);
		// }
	}
	
}

function changeView(willUpdate){
	if($("#pvore-sidebar-viewtype").text() == 'GRID VIEW'){
		if(willUpdate)
			updateSidebarSettings(2,4); //In the setting_field_value_maps table, viewtype = 2 and listview = 4
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
		//$('.appling-hr').show();
	}
	else{
		if(willUpdate)
			updateSidebarSettings(2,5); //In the setting_field_value_maps table, viewtype = 2 and grid = 5
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
		//$('.appling-hr').hide();
		
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
	// alert();
	if($(document).width() > 480)
		$('.pvore-sidebar-button').fadeOut(C_SIDEBARSPEED/4);
	$('.pvore-minima').fadeIn(C_SIDEBARSPEED);
	$('.pvore-dimmer').fadeIn(C_SIDEBARSPEED/4);
	// $('.pvore-sidebar-container').fadeIn(C_SIDEBARSPEED);
	// $('.pvore-minima').show().animate({'left': '30%', 'opacity': '1'}, C_SIDEBARSPEED);
	// $('.pvore-minima').show().animate({'opacity': '1'}, C_SIDEBARSPEED);
	$('.pvore-sidebar-container').show().animate({'left': '0%', 'display': 'block'}, C_SIDEBARSPEED);
	/*
	*/
}

function hideSidebar(){
	if($(document).width() > 480)
		$('.pvore-sidebar-button').fadeIn(C_SIDEBARSPEED/2);
	$('.pvore-dimmer').fadeOut(C_SIDEBARSPEED/2);
	$('.pvore-minima').fadeOut(C_SIDEBARSPEED);
	$('.pvore-sidebar-container').animate({'left': '-100%'}, C_SIDEBARSPEED).fadeOut(C_SIDEBARSPEED);
	// $('.pvore-sidebar-container').fadeOut(C_SIDEBARSPEED);
	/*
	// $('.pvore-sidebar-container').animate({'left': '-30%'}, C_SIDEBARSPEED).fadeOut(C_SIDEBARSPEED/2);
	$('.pvore-minima').animate({'left': '0%', 'opacity': '0'}, C_SIDEBARSPEED).fadeOut(C_SIDEBARSPEED/2);
	*/
}

function hideSidebarPoints(){
	$('.pvore-dimmer-points').fadeOut(C_SIDEBARSPEED);
	$('.pvore-dimmer-points-container').fadeOut(C_SIDEBARSPEED/2);
}

function appendToFlashMessagesFixed(messageTest){
	$('.flash-messages-fixed').append(messageTest).show();
	
	$('.flash-messages-fixed > .flash-msg').last().fadeIn(256).delay(2048).fadeOut(512);
}