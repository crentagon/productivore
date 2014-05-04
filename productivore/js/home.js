$(document).ready(function() {
	$('#pvore-notifications-search').keyup(function(){
		var filter = $(this).val();
		var searchParam = new RegExp(filter, "gi");
		
		$('.pvore-notifications-app-title').each(function(){
			if($(this).text().search(searchParam) < 0){
				$(this).parent("div").hide();
				if($(this).attr('class') == 'pvore-notifications-app-title appling-name-notifications')
					$(this).parent("div").next().hide();
				
			}
			else{
				$(this).parent("div").show();
				if($(this).attr('class') == 'pvore-notifications-app-title appling-name-notifications')
					$(this).parent("div").next().show();
			}
		});
	});
});

function settingsHide(param1){
	$(param1).fadeIn(256);
}