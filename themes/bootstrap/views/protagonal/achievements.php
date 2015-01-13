<?if($mode == 'index'):?>
	<link rel="stylesheet" type="text/css" href="<? echo BASE_URL ?>/assets/dragdealer-master/src/dragdealer.css" />
	<script type="text/javascript" src="<? echo BASE_URL ?>/assets/dragdealer-master/src/dragdealer.js"></script>
<?endif;?>
<?
	$unlockableClass = 'class = "active"';
	$completedClass = '';
	$completedLink = BASE_URL.'/protagonal/achievements/mode/complete';
	$unlockableLink = '#';
	
	if($mode == 'complete'){
		$unlockableClass = '';
		$completedClass = 'class = "active"';
		$completedLink = '#';
		$unlockableLink = BASE_URL.'/protagonal/achievements/';
	}
?>

<input type="hidden" id="achievement-mode" value="<?echo $mode?>"/>

<ul class="nav nav-tabs">
  <li <?echo $unlockableClass?>><a href="<?echo $unlockableLink?>">Unlockable</a></li>
  <li <?echo $completedClass?>><a href="<?echo $completedLink?>">Completed</a></li>
</ul>

<?if($mode == 'complete'):?>
	<div class="major-title">Completed Achievements (Total: <span class="ua-complete-total">0</span> pts)</div>
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
			<?php echo $form->textFieldRow($model,'achievement_rewards', array('value'=>'100', 'autocomplete'=>'off', 'placeholder'=>'Reward')); ?>
			<!-- <input type="text" value="100" name="AchievementsForm[achievement_rewards]" id="AchievementsForm_achievement_rewards" placeholder="Reward" autocomplete="off"/> -->
			<div id="label-points">
			points
			</div>
		</div>
		<div class="add-achievement-condition-container">
			<?php echo $form->textAreaRow($model,'achievement_condition', array('class'=>'input-achievement-condition', 'placeholder'=>'Achievement Condition (e.g.: "Successfully complete a full 26-mile marathon.")', 'maxlength'=>256)); ?>
		</div>
		<div id="just-a-slider" class="dragdealer dragger">
			<div class="hp-bar-container">
				<div class="hp-bar"></div>
			</div>
			<div class="slider-text">
				Points rewarded upon completion? &nbsp;&nbsp;
			</div>
			<div class="handle drag-bar slider-bg">
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
							<span class="editable-text-parent"
								ajaxUrl="<?echo BASE_URL?>/protagonal/editachievementfieldajax/"
								ajaxId="<?echo $achievement['achievement_id']?>"
								ajaxField="achievement_name"
							>
								<?if($achievement['achievement_name'] != '' && $achievement['achievement_name'] != null):?>
									<span class="editable-text">
										<?echo $achievement['achievement_name']?>
									</span>
								<?else:?>
									<span class="editable-text">
										- - -
									</span>
								<?endif;?>
							</span>
						</div>
						<div class="achievement-condition">
							<span class="editable-textarea-parent"
								ajaxUrl="<?echo BASE_URL?>/protagonal/editachievementfieldajax/"
								ajaxId="<?echo $achievement['achievement_id']?>"
								ajaxField="achievement_condition"
							>
								<?if($achievement['achievement_condition'] != '' && $achievement['achievement_condition'] != null):?>
									<span class="editable-textarea">
										<?echo $achievement['achievement_condition']?>
									</span>
								<?else:?>
									<span class="editable-textarea">
										- - -
									</span>
								<?endif;?>
							</span>
						</div>
						<div class="completion-notes">
							Completion Notes: 
								<span class="editable-text-parent"
									ajaxUrl="<?echo BASE_URL?>/protagonal/editachievementfieldajax/"
									ajaxId="<?echo $achievement['achievement_id']?>"
									ajaxField="completion_notes"
								>
									<? if($achievement['completion_notes'] != '' && $achievement['completion_notes'] != ''): ?>
										<span class="editable-text">
											<?echo $achievement['completion_notes']?> 
										</span>
									<? else: ?>
										<span class="editable-text">
											- - -
										</span>
									<? endif; ?>
								</span>
						</div>
						<div class="cushion-5"></div>
						<div class="ua-point-slider-container"
							ajaxUrl="<?echo BASE_URL?>/protagonal/editachievementfieldajax/"
							ajaxId="<?echo $achievement['achievement_id']?>"
							ajaxField="achievement_rewards"
						>
							<div class="ua-point-slider">
								<div id="slider-<?echo $achievement['achievement_id']?>" class="dragdealer dragger">
									<div class="hp-bar-container">
										<div class="hp-bar"></div>
									</div>
									<div class="slider-text">
										Points rewarded upon completion? &nbsp;&nbsp;
									</div>
									<div class="handle drag-bar slider-bg">
										<div class="slider value"></div>
									</div>
								</div>
							</div>
							<div class="ua-point-ok-button">OK</div>
						</div>
					</div>
					<div class="ua-rewards">
						<div class="points-container">
							<div class="points" id="points-<?echo $achievement['achievement_id']?>">
								<?echo $achievement['achievement_rewards']?> pts
							</div>
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
