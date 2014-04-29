<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
?>
<div class="error-header">
Error <?php echo $code; ?>
</div>
<div class="error">
<?php echo CHtml::encode($message); ?>
</div>