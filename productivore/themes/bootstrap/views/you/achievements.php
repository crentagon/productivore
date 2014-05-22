<?/*
<div class="input-group">
  <span class="input-group-addon">@</span>
  <input type="text" class="form-control" placeholder="Username">
</div>
*/?>
<?/* echo BASE_URL ?>/assets/dragdealer-master/src/dragdealer.css


*/?>

<link rel="stylesheet" type="text/css" href="<? echo BASE_URL ?>/assets/dragdealer-master/src/dragdealer.css" />
<script type="text/javascript" src="<? echo BASE_URL ?>/assets/dragdealer-master/src/dragdealer.js"></script>

<script>
	$(document).ready(function(){
		new Dragdealer('just-a-slider', {
		  animationCallback: function(x, y) {
			$('#just-a-slider .value').text(Math.round((x*900)+100));
			// $('#just-a-slider .value').text(((x*900)+100).toFixed(2));
		  }
		});
	});
</script>
<?
	$unlockableClass = 'class = "active"';
	$completedClass = '';
	$completedLink = BASE_URL.'/you/achievements/mode/complete';
	$unlockableLink = '#';
	
	if($mode == 'complete'){
		$unlockableClass = '';
		$completedClass = 'class = "active"';
		$completedLink = '#';
		$unlockableLink = BASE_URL.'/you/achievements/';
	}
		

?>

<style>
	.add-achievement-name-container{
		border: 0px;
		height: 29px;
		width: 100%;
		padding: 0px;
	}
	.add-achievement-condition-container{
		border: 0px;
		height: 60px;
		width: 100%;
		padding: 0px;
	}
	.add-achievement-reward-container{
		background-color: #CACACA;
		width: 100%;
		display: inline-block;
		margin: auto;
		height: auto;
		min-height: 60px;
		line-height: 45px;
		padding-left: 10px;
		padding-right: 10px;	 
		border-radius: 0px 0px 5px 5px;
		color: #FFF;
	}
	.add-achievement-reward-container *{
		float: left;
	}
	.control-label{
		display: none;
	}
	.control-group > .controls{
		margin-left: 0px;
	}
	textarea{
		border-left: 1px solid #CACACA;
		border-right: 1px solid #CACACA;
		border-top: 1px solid #CACACA;
		border-bottom: 1px solid #CACACA;
		resize: none;
		border-radius: 0px;
		width: 100%;
		height: 100%;
		position: relative;
		box-sizing: border-box;
	}
	.add-achievement-name-container input{
		border: 1px solid #CACACA;
		border-bottom: 0px solid #CACACA;
		resize: none;
		border-radius: 5px 5px 0px 0px;
		width: 100%;
		height: 100%;
		position: relative;
		box-sizing: border-box;
		font-weight: 600;
	}
	.add-achievement-reward-container input{
		position: relative;
		float: left;
		width: 35px;
		text-align: right;
		padding: 2px;
		margin: 9px;
		margin-bottom: 0px;
	}
	.add-achievement-reward-container p, .add-achievement-reward-container > .control-group{
		margin: 0px;
	}
	.unlockable-achievement{
		width: 100%;
		min-height: 75px;
		height: auto;
		display: inline-block;
		border-radius: 5px;
	}
	.ua-actions{
		border: 1px solid #CACACA;
		background-color: #CACACA;
		width: 5%;
		min-height: 75px;
		height: 100%;
		border-radius: 5px 0px 0px 5px;
		float: left;
	}
	.ua-body{
		border-top: 1px solid #CACACA;
		border-bottom: 1px solid #CACACA;
		background-color: rgba(255,255,255,0.8);
		width: 80%;
		min-height: 75px;
		height: 100%;
		float: left;
	}
	.ua-rewards{
		border: 1px solid #CACACA;
		border-left: 0px;
		border-radius: 0px 5px 5px 0px;
		background-color: rgba(255,255,255,0.8);
		width: 15%;
		min-height: 75px;
		height: 100%;
		float: left;
	}
	.add-achievement-reward-container > .dragger{
		width: 100%;
	}
	.dragger > .slider{
		background-color: #555;
		width: 70px;
	}
</style>

<ul class="nav nav-tabs">
  <li <?echo $unlockableClass?>><a href="<?echo $unlockableLink?>">Unlockable</a></li>
  <li <?echo $completedClass?>><a href="<?echo $completedLink?>">Completed</a></li>
</ul>

<?if($mode == 'complete'):?>
	Completed.<br/>
<?else:?>
	<div class="add-unlockable-container">
		<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
			'id'=>'achievements-form',
			'type'=>'horizontal',
			'enableClientValidation'=>true,
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			),
		)); ?>
		<div class="add-achievement-name-container">
			<?php echo $form->textFieldRow($model,'achievement_name', array('class'=>'input-achievement-name', 'placeholder'=>'Achievement Title (e.g.: "Decifapper")')); ?>
		</div>
		<div class="add-achievement-condition-container">
			<?php echo $form->textArea($model,'achievement_condition', array('class'=>'input-achievement-condition', 'placeholder'=>'Achievement Condition (e.g.: "Fapped ten times in the span of twenty-four hours.")')); ?>
		</div>
		<div class="add-achievement-reward-container">
			<div id="just-a-slider" class="dragdealer dragger">
			  <div class="handle red-bar value slider">drag me</div>
			</div>
		</div>
		
		<?php $this->endWidget(); ?>
		
		<div class="unlockable-achievement">
			<div class="ua-actions">
				
			</div>
			<div class="ua-body">
			
			</div>
			<div class="ua-rewards">
				500
			</div>
		</div>
		<div class="cushion-5"></div>
		<div class="unlockable-achievement">
			<div class="ua-actions">
				
			</div>
			<div class="ua-body">
			
			</div>
			<div class="ua-rewards">
			
			</div>
		</div>
	</div>
<?endif;?>
