<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'journal-form',
	'type'=>'horizontal',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<?php echo $form->textFieldRow($model,'journal_title', array('placeholder'=>'Title', 'autocomplete'=>'off', 'maxlength'=>128)); ?>
	<?php echo $form->textFieldRow($model,'journal_body', array('placeholder'=>'Body', 'autocomplete'=>'off')); ?>
	<button class="btn btn-inverse" type="submit" id="btn-add-to-bucket-list">Post</button>
<?php $this->endWidget(); ?>