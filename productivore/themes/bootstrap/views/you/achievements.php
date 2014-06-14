<?if($mode == 'index'):?>
	<link rel="stylesheet" type="text/css" href="<? echo BASE_URL ?>/assets/dragdealer-master/src/dragdealer.css" />
	<script type="text/javascript" src="<? echo BASE_URL ?>/assets/dragdealer-master/src/dragdealer.js"></script>
<?endif;?>
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

<input type="hidden" id="achievement-mode" value="<?echo $mode?>"/>

<ul class="nav nav-tabs">
  <li <?echo $unlockableClass?>><a href="<?echo $unlockableLink?>">Unlockable</a></li>
  <li <?echo $completedClass?>><a href="<?echo $completedLink?>">Completed</a></li>
</ul>

<?if($mode == 'complete'):?>
	<div class="major-title">Completed Achievements</div>
	<div class="cushion-20"></div>
	<?foreach($achievements as $achievement):?>
		<div class="unlockable-achievement">
			<div class="ua-actions">
				
			</div>
			<div class="ua-body">
				<div class="achievement-name"><?echo $achievement['achievement_name']?></div>
				<div class="achievement-condition"><?echo $achievement['achievement_condition']?></div>
			</div>
			<div class="ua-rewards">
				<div class="points-container">
					<div class="points"><?echo $achievement['achievement_rewards']?> pts</div>
				</div>
			</div>
		</div>
		<div class="cushion-5"></div>
	<?endforeach;?>
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
			<?php echo $form->textFieldRow($model,'achievement_name', array('class'=>'input-achievement-name', 'placeholder'=>'Achievement Title (e.g.: "Marathon Master")', 'autocomplete'=>'off', 'maxlength'=>64)); ?>
			<input type="text" value="550" name="AchievementsForm[achievement_rewards]" id="achievement-form-reward-points" placeholder="Reward" autocomplete="off"/>
			<div id="label-points">
			points
			</div>
		</div>
		<div class="add-achievement-condition-container">
			<?php echo $form->textArea($model,'achievement_condition', array('class'=>'input-achievement-condition', 'placeholder'=>'Achievement Condition (e.g.: "Successfully complete a full 26-mile marathon.")', 'maxlength'=>256)); ?>
		</div>
		<div id="just-a-slider" class="dragdealer dragger">
			<div class="hp-bar-container">
				<div class="hp-bar"></div>
			</div>
			Points rewarded upon completion?
			<div class="handle red-bar slider-bg">
				<div class="slider value"></div>
			</div>
		</div>
		
		<?/*<div class="add-achievement-reward-container">
			<input type="submit" value="Submit"/>
			The amount of points that you will receive upon unlocking this achievement: 
		</div>*/?>
		<div class="cushion-15"></div>
		<button class="btn btn-inverse" type="submit" id="btn-add-to-bucket-list">Add to Achievement List</button>
		
		<?php $this->endWidget(); ?>
	</div>
	<?/*<pre>
		<?print_r($achievements);?>
	</pre>*/?>
	
	<div class="major-title">Achievement List</div>
	<div class="cushion-20"></div>
		<?if(count($achievements) > 0):?>
			<?foreach($achievements as $achievement):?>
				<input type="hidden" id="achievementId-<?echo $achievement['achievement_id']?>" value="<?echo $achievement['achievement_id']?>"/>
				<div class="unlockable-achievement">
					<div class="ua-actions">
						<input type="checkbox" onclick="completeAchievement(<?echo $achievement['achievement_id']?>, this)"/>
						<span class="fa fa-times" onclick="deleteAchievement(<?echo $achievement['achievement_id']?>, this)"></span>
					</div>
					<div class="ua-body">
						<div class="achievement-name">
							<span class="editable-text-parent">
							<?if($achievement['achievement_name'] != ''):?>
								<span class="editable-text">
								<?echo $achievement['achievement_name']?>
								</span>
							<?endif;?>
							</span>
						</div>
						<div class="achievement-condition">
							<span class="editable-text-parent">
								<span class="editable-text">
								<?echo $achievement['achievement_condition']?>
								</span>
							</span>
						</div>
					</div>
					<div class="ua-rewards">
						<div class="points-container">
							<div class="points"><?echo $achievement['achievement_rewards']?> pts</div>
						</div>
					</div>
				</div>
				<div class="cushion-5"></div>
			<?endforeach;?>
		<?else:?>
			<div class="center">
				There are no items in the list.
			</div>
			<br/>
		<?endif;?>
<?endif;?>
