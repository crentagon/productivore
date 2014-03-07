$(document).ready(function() {
	// alert("Entered the basescript!");
	// Handler for .ready() called.
});

function showSidebar(){
	$('.pVoreDimmer').fadeIn(256);
	$('.pVoreSidebarContainer').animate({'width': '30%'}, 512);
}

function hideSidebar(){
	$('.pVoreDimmer').fadeOut(512);
	$('.pVoreSidebarContainer').animate({'width': '0%'}, 256);
}

// function 