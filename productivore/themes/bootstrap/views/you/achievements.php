<?/*
<div class="input-group">
  <span class="input-group-addon">@</span>
  <input type="text" class="form-control" placeholder="Username">
</div>
*/?>

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
		background-color: #444;
		height: 39px;
		margin: auto;
		line-height: 43px;
		padding-left: 7px;
		border-radius: 5px 5px 0px 0px;
	}
	.add-achievement-condition-container{
		border: 0px;
		height: 60px;
		width: 100%;
		padding: 0px;
	}
	.add-achievement-reward-container{
		background-color: #444;
		width: 100%;
		display: inline-block;
		margin: auto;
		line-height: 45px;
		padding-left: 10px;
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
		border-left: 5px solid #444;
		border-right: 5px solid #444;
		border-top: 2px solid #444;
		border-bottom: 2px solid #444;
		resize: none;
		border-radius: 0px;
		width: 100%;
		height: 100%;
		position: relative;
		box-sizing: border-box;
	}
	.add-achievement-name-container input{
		position: relative;
		left: -2px; top: -2px;
		width: 70%;
		vertical-align: center;
		border-radius: 5px 5px 0px 0px;
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
			<p>You will gain </p> <?php echo $form->textFieldRow($model,'reward_points', array('value'=>500)); ?> <p>points from unlocking this achievment.</p>
		</div>
		
		<?php $this->endWidget(); ?>
	</div>
<?endif;?>
