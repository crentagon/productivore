var C_BASEURL = '';

$(document).ready(function(){
	C_BASEURL = $('#BASE_URL').val();
	// alert($('#achievement-mode').val());

	if($('#achievement-mode').val() == 'index'){
		rewardDealer = new Dragdealer('just-a-slider', {
		  animationCallback: function(x, y) {
			var sliderText = Math.round((x*900)+100);
			$('#just-a-slider > .handle > .value').text(sliderText+" pts");
			$('#achievement-form-reward-points').val(sliderText);
			
			var width = x*100;
			var opacity = x;
			var opacityBg = x*0.2;
			var opacityBgInv = 0.2-opacityBg;
			$('.hp-bar-container').css('width', width+'%');
			$('.hp-bar').css('background-color', 'rgba(0,95,185,'+opacityBg+')'); //INSIDE
			$('.hp-bar-container').css('background-color', 'rgba(14,184,86,'+(opacityBgInv)+')'); //OUTSIDE
			$('#just-a-slider > .handle > .slider').css('background-color', 'rgba(0,95,185,'+opacity+')'); //INSIDE
			// $('#just-a-slider .value').text(((x*900)+100).toFixed(2));
		  }
		});
			
		rewardDealer.setValue(0.5, 0, true);
	
		$(document).on('keyup', '#achievement-form-reward-points', function(){
			var sliderVal = $(this).val();
			if(sliderVal <= 1000 && sliderVal >= 100){
				sliderText = (sliderVal-100)/900;
				rewardDealer.setValue(sliderText, 0, true);
			}
		});
	}
	
	$.each($('.points'),
		function (){
			var points = parseInt($(this).text().replace(' pts', ''));
			var opacity = ((points-100)/900);
			$(this).css('background-color', 'rgba(0,95,185,'+opacity+')');
		}
	);
	
	$('.unlockable-achievement').on('mouseover', function(){
		// $(this).attr('class', 'unlockable-achievement completed')
		$(this).children('.ua-actions').children('input').show();
		$(this).children('.ua-actions').children('.fa').show();
	}).on('mouseout', function(){
		$(this).children('.ua-actions').children('input').hide();
		$(this).children('.ua-actions').children('.fa').hide();
	});
	
	$('.input-achievement-condition').attr('class', 'input-achievement-condition');
});

function deleteAchievement(achievementId, element){
	$(element).parent().parent().fadeOut(512);
	
	var xmlhttp;
	
	if (window.XMLHttpRequest)
		xmlhttp=new XMLHttpRequest();
	else
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	
	xmlhttp.open("GET", C_BASEURL+"/you/deleteachievementajax/achievementId/"+achievementId,true);
	xmlhttp.send();
}

function completeAchievement(achievementId, element){
	var achievementTitle = 
		$(element).parent().parent().children('.ua-body').children('.achievement-name').children('.editable-text').html().trim();
	var achievementBody =
		$(element).parent().parent().children('.ua-body').children('.achievement-condition').children('.editable-text').html().trim();
	var achievementPoints =
		$(element).parent().parent().children('.ua-rewards').children('.points-container').children('div').html().trim();
	$(element).parent().parent().attr('class', 'unlockable-achievement completed');
	$(element).parent().html('<div class="completed-check"><span class="fa fa-check"></span></div>');
	
	$('.flash-messages-fixed').html(''+
		'<div class="flash-msg flash-success">'+
			'<div class="flash-icon-container">'+
				'<span class="flash-icon fa fa-check-circle fa-2x"></span>'+
			'</div>'+
			'<b>Achievement Unlocked: '+achievementTitle+ ' ('+achievementPoints+')</b><br/>'+achievementBody+
			'<span class="flash-msg-exit fa fa-times"></span>'+
		'</div>'+
	'').fadeIn(256).delay(2048).fadeOut(512);
	var xmlhttp;
	
	if (window.XMLHttpRequest)
		xmlhttp=new XMLHttpRequest();
	else
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	
	xmlhttp.open("GET", C_BASEURL+"/you/markascompleteajax/achievementId/"+achievementId,true);
	xmlhttp.send();
}