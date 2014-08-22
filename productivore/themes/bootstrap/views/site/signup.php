<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'signup-form',
    'type'=>'horizontal',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<br/>
	<div class="control-group">
		<div class="controls">
			<p class="help-block">
			Fields with <span class="required">*</span> are required.
			</p>
		</div>
	</div>
	
	<?php echo $form->textFieldRow($model,'user_email'); ?>
	<?php echo $form->textFieldRow($model,'user_name'); ?>
	<?php echo $form->passwordFieldRow($model,'password'); ?>
	<?php echo $form->passwordFieldRow($model,'password_repeat'); ?>
	
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'success',
            'label'=>'Onward to Productivity!',
        )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
