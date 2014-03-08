$(document).ready(function() {
	// alert("Entered the basescript!");
	// Handler for .ready() called.
});

function showSidebar(){
	$('.pVoreDimmer').fadeIn(256);
	$('.pVoreMinima').show();
	$('.pVoreMinima').animate({'left': '30%'}, 512);
	$('.pVoreSidebarContainer').animate({'width': '30%'}, 512);
	$('.pVoreSidebarButton').hide();
}

function hideSidebar(){
	$('.pVoreDimmer').fadeOut(512);
	$('.pVoreSidebarContainer').animate({'width': '0%'}, 256);
	$('.pVoreMinima').animate({'left': '0%'}, 256);
	$('.pVoreMinima').fadeOut(256);
	$('.pVoreSidebarButton').fadeIn(256);
}

// function 