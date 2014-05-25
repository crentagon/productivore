$(document).ready(function(){
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
	
	
	$('.input-achievement-condition').attr('class', 'input-achievement-condition');
});