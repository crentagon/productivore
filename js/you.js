var C_BASEURL = '';

$(document).ready(function(){
	C_BASEURL = $('#BASE_URL').val();
	// alert($('#achievement-mode').val());
	
	var totalPoints = 0;
	$.each($('.points'),
		function (){
			var points = parseInt($(this).text().replace(' pts', ''));
			var opacity = ((points-100)/900);
			totalPoints += points;
			$(this).css('background-color', 'rgba(102, 51, 153,'+opacity+')');
		}
	);
	
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
			$('#just-a-slider > .hp-bar-container').css('width', width+'%');
			$('#just-a-slider > .hp-bar-container > .hp-bar').css('background-color', 'rgba(102, 51, 153,'+opacityBg+')'); //INSIDE
			$('#just-a-slider > .hp-bar-container').css('background-color', 'rgba(0,95,185,'+(opacityBgInv)+')'); //OUTSIDE
			$('#just-a-slider > .handle > .slider').css('background-color', 'rgba(102, 51, 153,'+opacity+')'); //INSIDE
			
			if(x >= 0.5){
				$('#just-a-slider > .slider-text').css('text-align', 'left');
			
			} else {
				$('#just-a-slider > .slider-text').css('text-align', 'right');
			}
			// $('#just-a-slider .value').text(((x*900)+100).toFixed(2));
		  }
		});
			
		rewardDealer.setValue(0, 0, true);
	
		$(document).on('keyup', '#achievement-form-reward-points', function(){
			var sliderVal = $(this).val();
			if(sliderVal <= 1000 && sliderVal >= 100){
				sliderText = (sliderVal-100)/900;
				rewardDealer.setValue(sliderText, 0, true);
			}
		});
	}
	else {
		$('.ua-complete-total').text(totalPoints);
	}
	
	
	
	$('.unlockable-achievement').on('mouseover', function(){
		// $(this).attr('class', 'unlockable-achievement completed')
		$(this).children('.ua-actions').children('input').show();
		$(this).children('.ua-actions').children('.fa').show();
	}).on('mouseout', function(){
		$(this).children('.ua-actions').children('input').hide();
		$(this).children('.ua-actions').children('.fa').hide();
	});
	
	$('.input-achievement-condition').attr('class', 'input-achievement-condition');
	
	if($('#achievement-mode').val() == 'index'){
		$(document).on('click', '.points-container', function(){	
			var temp_points = $(this).children('.points').html().split(" ");
			var temp_id = $(this).children('.points').attr('id').split("-");
			var id = temp_id[1];
			var points = temp_points[0];
			$('#slider-'+id).parent().parent().fadeIn();
			
			pointDealer = new Dragdealer('slider-'+id, {
				animationCallback: function(x, y) {
					// var sliderText = x;
					// var sliderText = Math.round(x*1000);
					var sliderText = Math.round((x*900)+100);
					$('#slider-'+id+' > .handle > .value').text(sliderText+" pts");
					$('#points-'+id).text(sliderText+" pts");
					
					var width = x*100;
					var opacity = x;
					var opacityBg = x*0.2;
					var opacityBgInv = 0.2-opacityBg;
					
					$('#slider-'+id+' > .hp-bar-container').css('width', width+'%');
					$('#slider-'+id+' > .hp-bar-container > .hp-bar').css('background-color', 'rgba(102, 51, 153,'+opacityBg+')'); //INSIDE
					$('#slider-'+id+' > .hp-bar-container').css('background-color', 'rgba(0,95,185,'+(opacityBgInv)+')'); //OUTSIDE
					$('#slider-'+id+' > .handle > .slider').css('background-color', 'rgba(102, 51, 153,'+opacity+')'); //INSIDE
					
					$('#points-'+id).css('background-color', 'rgba(102, 51, 153,'+opacityBg+')'); //INSIDE
					$('#points-'+id).css('background-color', 'rgba(0,95,185,'+(opacityBgInv)+')'); //OUTSIDE
					$('#points-'+id).css('background-color', 'rgba(102, 51, 153,'+opacity+')'); //INSIDE
				
					if(x >= 0.5){
						$('#slider-'+id+' > .slider-text').css('text-align', 'left');
					
					} else {
						$('#slider-'+id+' > .slider-text').css('text-align', 'right');
					}
				}
			});
			
			pointDealer.setValue((points-100)/900, 0, true);
			// pointDealer.setValue((points-100)/900, 0, true);
			
		});
	}
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
	var achievementPoints =
		$(element).parent().parent().children('.ua-rewards').children('.points-container').children('div').html().trim();
	var achievementBody =
		$(element).parent().parent().children('.ua-body').children('.achievement-condition').children('.editable-textarea-parent').children('.editable-textarea').html().trim();
	var achievementTitle = 
		$(element).parent().parent().children('.ua-body').children('.achievement-name').children('.editable-text-parent').children('.editable-text').html().trim();
	$(element).parent().parent().attr('class', 'unlockable-achievement completed');
	$(element).parent().html('<div class="completed-check"><span class="fa fa-check"></span></div>');
	
	var messageText = ''+
		'<div class="flash-msg flash-success flash-fixed-box-shadow">'+
			'<div class="flash-icon-container">'+
				'<span class="flash-icon fa fa-check-circle fa-2x"></span>'+
			'</div>'+
			'<b>Achievement Unlocked: '+achievementTitle+ ' ('+achievementPoints+')</b><br/>'+achievementBody+
			'<span class="flash-msg-exit fa fa-times"></span>'+
		'</div>'+
	'';
	
	appendToFlashMessagesFixed(messageText);
	
	var xmlhttp;
	
	if (window.XMLHttpRequest)
		xmlhttp=new XMLHttpRequest();
	else
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	
	xmlhttp.open("GET", C_BASEURL+"/you/markascompleteajax/achievementId/"+achievementId,true);
	xmlhttp.send();
}