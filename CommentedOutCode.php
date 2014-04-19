
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