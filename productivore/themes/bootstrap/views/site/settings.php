<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'signup-x-form',
    'type'=>'horizontal',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<br/>
	
	<?php echo $form->passwordFieldRow($model,'currentPassword'); ?>
	
	<hr/>
	<?php echo $form->textFieldRow($model,'username', array('disabled'=>true)); ?>
	<?php echo $form->textFieldRow($model,'currentEmail', array('disabled'=>true)); ?>
	<div class="control-group">
		<div class="controls">
			<div class="btn btn-grey" onclick="settingsHide('.settings-new-email'); $(this).hide();">Change my E-Mail</div>
		</div>
	</div>
	
	<div class="settings-new-email"><?php echo $form->textFieldRow($model,'newEmail'); ?></div>
	
	<div class="control-group">
		<div class="controls">
			<div class="btn btn-grey" onclick="settingsHide('.settings-new-password'); $(this).hide();">Change my Password</div>
		</div>
	</div>
	<div class="settings-new-password">
		<?php echo $form->passwordFieldRow($model,'newPassword'); ?>
		<?php echo $form->passwordFieldRow($model,'newPasswordRepeat'); ?>
	</div>
	
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'success',
            'label'=>'Update my credentials',
        )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
