$(document).ready(function() {
	showSidebar();
	$.each($('.appling-icon-notification'),
		function (){
			$(this).css('width', ($(this).html().length)*11);
		}
	);
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

var sidebarSpeed = 256;

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