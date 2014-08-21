<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'login-form',
    'type'=>'horizontal',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<?/*<p class="text-align-center">Please fill out the following form with your login credentials:</p>*/?>
	<br/>
	<div class="control-group">
		<div class="controls">
			<p class="help-block">
			Fields with <span class="required">*</span> are required.
			</p>
		</div>
	</div>
	
	<?php echo $form->textFieldRow($model,'username'); ?>

	<?php echo $form->passwordFieldRow($model,'password'); ?>

	<?php echo $form->checkBoxRow($model,'rememberMe'); ?>
	
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'success',
            'label'=>'Login',
        )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
