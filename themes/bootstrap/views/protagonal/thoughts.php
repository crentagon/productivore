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

	<div class="add-achievement-condition-container">
		<?php echo $form->textArea($model,'thought_body', array('class'=>'input-achievement-condition', 'placeholder'=>'What are you thinking of today?', 'autocomplete'=>'off')); ?>
	</div>

	<div class="cushion-20"></div>
	<div class="cushion-20"></div>
	<button class="btn btn-inverse" type="submit" id="btn-add-to-thought-list">Add to <span id="list-last-accessed"></span></button>
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
	<? foreach($thoughtList as $listItem):?>
		<div class="list-item"><?=$listItem['name']?></div>
	<? endforeach;?>
</div>

<div class="thoughts">
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec maximus iaculis dolor id dapibus. Pellentesque accumsan euismod nunc, eget semper nulla bibendum ut. Proin iaculis fermentum placerat. In et urna quam. Curabitur pulvinar iaculis mollis. Integer metus odio, scelerisque sit amet pulvinar eu, ultrices in erat. Donec sed odio tortor. Aenean neque lacus, vulputate id dui vitae, dignissim vehicula odio.

Donec odio neque, sodales ac facilisis quis, cursus in ex. Vivamus tincidunt massa augue, vitae mollis mauris vehicula eu. Suspendisse a metus in nulla aliquet vulputate. Nunc vitae arcu at sem rhoncus ultrices in vel odio. Vivamus eget leo quis felis sagittis eleifend. Suspendisse feugiat suscipit ipsum eget aliquam. Phasellus rutrum magna sed tortor hendrerit bibendum.

Quisque placerat tellus id ex pharetra congue. Nulla pretium pellentesque finibus. Suspendisse potenti. In risus nisl, accumsan non nunc vestibulum, bibendum feugiat libero. Praesent leo erat, rutrum a ante tempor, egestas sagittis ex. Donec ipsum ex, efficitur sed vehicula vel, dictum et ipsum. Vestibulum metus augue, pharetra non ipsum vel, porta tincidunt lacus. Quisque molestie varius mattis. Fusce at eleifend massa, sodales vehicula arcu.

Etiam a iaculis elit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin facilisis arcu accumsan ipsum sollicitudin, eu ornare nulla aliquam. Quisque nec urna ut lorem bibendum interdum sed quis metus. Phasellus sit amet quam magna. Etiam nec lacinia nisl. Praesent faucibus nunc non enim elementum tristique. Donec maximus ligula et metus elementum, id pellentesque magna elementum. Aenean volutpat mauris metus, vitae malesuada sapien gravida vel. Nunc iaculis ante lacus, a suscipit ex egestas nec. Nam quis ex quis mauris vehicula pulvinar. Proin id mauris sem. Donec ac commodo tortor, ac ultrices enim. Sed quis vehicula mauris. Donec et ligula aliquam, mollis dui a, ornare dolor. Quisque eget sollicitudin nisi.

Donec interdum lorem eros, id fermentum nulla sodales ac. Aenean tempus erat tortor, id consectetur risus aliquet id. Pellentesque lacinia velit at urna feugiat ultrices. Sed a erat magna. Proin lorem diam, interdum sit amet efficitur ac, pretium vel nibh. Vestibulum pretium gravida nisi ut placerat. Donec rhoncus metus in quam viverra, eget semper ipsum varius. Etiam tristique sem non sagittis ultrices. Quisque eu lectus risus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras vel porta neque. Morbi vehicula eleifend libero non venenatis. In at dictum tellus. Proin metus justo, tincidunt ac mattis et, ornare quis dolor. Curabitur dignissim a sapien et porta. Aliquam commodo nec nunc et euismod. 
</div>

<div class="clear-both"></div>