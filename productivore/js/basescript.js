$(document).ready(function() {
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