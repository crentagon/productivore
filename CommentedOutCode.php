
<?//From main.php, dynamic sidebar options:?>
					<?/*
					<?
						$c_orderBy = 1;
						$c_viewTypes = 2;
						$selected = array();
						$unselected = array();
					?>				
					<?foreach($this->sidebarInfo['orderby'] as $key=>$criterion):?>
						<?if($this->sidebarInfo['settings'][$c_orderBy] == $criterion['setting_value_id']):?>
							<? $selected = $criterion; ?>
						<?else:?>
							<? array_push($unselected, $criterion); ?>
						<?endif;?>
					<?endforeach;?>
					
					<span id="current-order" onclick="toggleOrderBy();"><?echo $selected['setting_value_name']?></span>
					<div class="order-by-options">
					<?foreach($unselected as $criterion):?>
						<div class="order-by-option" id="sidebar-order-<?echo $criterion['setting_value_id']?>" onclick="orderBy('sidebar-order-<?echo $criterion['setting_value_id']?>');"><?echo $criterion['setting_value_name']?></div>
					<?endforeach;?>
					</div>
					<span id="current-order" onclick="toggleOrderBy();">LEAST USED</span>
					*/?>
					
					<?php /*$this->beginWidget('bootstrap.widgets.TbHeroUnit',array(
    'heading'=>'Welcome to '.CHtml::encode(Yii::app()->name),
)); ?>

<p>Congratulations! You have successfully created your Yii application.</p>
<? echo $test;?>
<?php $this->endWidget(); ?>

<p>You may change the content of this page by modifying the following two files:</p>

<ul>
    <li>View file: <code><?php echo __FILE__; ?></code></li>
    <li>Layout file: <code><?php echo $this->getLayoutFile('main'); ?></code></li>
</ul>

<p>For more details on how to further develop this application, please read
    the <a href="http://www.yiiframework.com/doc/">documentation</a>.
    Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
    should you have any questions.</p>
*/?>