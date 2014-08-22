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

function toggleFavorite(params, applingId){
	var isfavorite = 0;
	if($(params).attr('class') == 'btn btn-mini btn-warning pvore-appling-settings-btn'){
		// Remove favorite
		$(params).attr('class', 'btn btn-mini btn-grey pvore-appling-settings-btn');
		$(params).html('<span class="fa fa-plus"></span> Favorite');
	} else {
		// Add favorite
		$(params).attr('class', 'btn btn-mini btn-warning pvore-appling-settings-btn');
		$(params).html('<span class="fa fa-star"></span> Favorite');
		isfavorite = 1;
	}
	
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
	// /productivore/productivore/site/update_favorites?applingId=2&isfavorite=0
	// alert(C_BASEURL+"/site/update_favorites?applingId="+applingId+"&isfavorite="+isfavorite);
	xmlhttp.open("GET", C_BASEURL+"/site/update_favorites?applingId="+applingId+"&isfavorite="+isfavorite,true);
	xmlhttp.send();
}