<script type="text/javascript" src="<? echo BASE_URL ?>/plugins/jquery-te-1.4.0/jquery-te-1.4.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="<? echo BASE_URL ?>/plugins/jquery-te-1.4.0/jquery-te-1.4.0.css" />
<div class="scroll-to-top">
	<span class="appling-icon fa fa-chevron-up fa-2x"></span>
</div>
<div class="add-thoughts-container">
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'thoughts-form',
		'type'=>'horizontal',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
	)); ?>
	<div class="add-thought-title-container">
		<?php echo $form->textFieldRow($model,'thought_title', array('class'=>'input-thought-title', 'placeholder'=>'My Thought Bubble', 'autocomplete'=>'off', 'maxlength'=>128)); ?>
		<select name="ThoughtsForm[list_id]" id="thoughts-form-list-id">
			<? foreach($thoughtList as $listItem):?>
				<option value="<?=$listItem['thought_list_id']?>"><?=$listItem['name']?></option>
			<? endforeach;?>
		</select>
	</div>
	<div class="add-thought-body-container">
		<?php echo $form->textAreaRow($model,'thought_body', array('class'=>'input-thought-body', 'placeholder'=>'What are you thinking of today?', 'autocomplete'=>'off')); ?>
	</div>
	<div class="clear-both"></div>
	<div class="cushion-20"></div>
	<button class="btn btn-info" type="submit" id="btn-add-to-thought-list">Add to <span id="list-last-accessed"></span></button>
	<?php $this->endWidget(); ?>
</div>
<? /*
<div class="cushion-15"></div>
<div class="col-lg-3">
            <div class="sidebar" data-spy="affix" data-offset-top="50">
                <ul class="nav sidenav">
                    <li><a href="#announcements"><i class="icon-bullhorn"></i>&nbsp; &nbsp; Announcements</a></li>
                    <li><a href="#recentactivity"><i class="icon-calendar"></i>&nbsp; &nbsp; Recent activity</a></li>
                    <li><a href="#recommendedexams"><i class="icon-star"></i>&nbsp; &nbsp; Recommended</a></li>
                    <li><a href="#newresources"><i class="icon-compass"></i>&nbsp; &nbsp; New resources</a></li>
                </ul>
            </div>
        </div>

<div class="cushion-15"></div>

	<div class="sidebar thought-list" data-spy="affix" data-offset-top="50">
		<ul class="nav sidenav">
			<li><a href="#announcements"><i class="icon-bullhorn"></i>&nbsp; &nbsp; Announcements</a></li>
			<li><a href="#recentactivity"><i class="icon-calendar"></i>&nbsp; &nbsp; Recent activity</a></li>
			<li><a href="#recommendedexams"><i class="icon-star"></i>&nbsp; &nbsp; Recommended</a></li>
			<li><a href="#newresources"><i class="icon-compass"></i>&nbsp; &nbsp; New resources</a></li>
		</ul>
	</div>
*/?>

<div class="cushion-15"></div>

<div class="thought-list">
	<? foreach($thoughtList as $key=>$listItem):?>
		<?if($key == 0):?>
			<div class="list-item-selected" id="thought-list-id-<?=$listItem['thought_list_id']?>" thoughtListid="<?=$listItem['thought_list_id']?>"><?=$listItem['name']?></div>
		<?else:?>
			<div class="list-item" id="thought-list-id-<?=$listItem['thought_list_id']?>" thoughtListid="<?=$listItem['thought_list_id']?>"><?=$listItem['name']?></div>
		<?endif;?>
	<? endforeach;?>
</div>

<div class="thoughts">
	<div class="display-none" id="thought-item-framework">
		<div class="thought-item">
			<div class="thought-title"></div>
			<div class="thought-body"></div>
			<div class="thought-footer"></div>
		</div>
		<div class="cushion-20"></div>
		<div class="cushion-15"></div>
	</div>
	<div class="all-thoughts">
		<?if(count($thoughtBubbleList)):?>
			<?foreach($thoughtBubbleList as $thoughtBubble):?>
				<div class="thought-item" thoughtBubbleId="<?=$thoughtBubble['thought_bubble_id']?>">
					<div class="thought-title"><?=$thoughtBubble['title']?></div>
					<div class="thought-body"><?=$thoughtBubble['body']?></div>
					<div class="thought-footer"><?=$thoughtBubble['inserted_on']?></div>
				</div>
				<div class="cushion-20"></div>
				<div class="cushion-15"></div>
			<?endforeach;?>
		<?else:?>
			This lake is calm, peaceful, and conducive to pebble skipping.
		<?endif;?>
	</div>
	<div class="thoughts-loading">
		<img src="<?=BASE_URL?>/images/nowLoading.gif" alt="Loading animation"/>
	</div>
</div>
<div class="clear-both"></div>