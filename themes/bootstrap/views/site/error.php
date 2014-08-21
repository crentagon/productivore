
<div class="flash-msg flash-error">
	<div class="flash-icon-container" onclick="window.location = '<?echo BASE_URL?>'">
		<span class="flash-icon fa fa-times-circle fa-2x"></span>
	</div>
	<b>Error <?php echo $code; ?></b><br/>
	<?php echo CHtml::encode($message); ?>
	<span class="flash-msg-exit fa fa-times" onclick="window.location = '<?echo BASE_URL?>'"></span>
</div>