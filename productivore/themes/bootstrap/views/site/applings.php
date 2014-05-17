<div class="cushion-15"></div>
<div class="pvore-notifications-search-container">
	<form action=""><input type="text" class="search-query pvore-notifications-search-input" id="pvore-notifications-search" placeholder="Appling Search"></form>
</div>

<div class="pvore-notifications-app-hr-container">
	<hr class="pvore-notifications-app-hr"/>
</div>
<?$applingCount = count($allApplings); $i=0;?>


<?foreach($allApplings as $applingid=>$appling):?>
	
	<div class="pvore-appling-settings-app" 
		id="appling-<?echo $appling['appling_id']?>-list"
		isFavorite="<?echo $appling['isFavorite']?>"
		accessCount="<?echo $appling['accessCount']?>"
		baseId="appling-<?echo $appling['appling_id']?>">
		<div class="pvore-notifications-app-image">
			<span class="appling-icon fa fa-<?echo $appling['image']?> fa-2x"></span>
		</div>
		<div class="pvore-notifications-app-title appling-name-appling-settings">
			<?echo $appling['name']?><br/>
			<p class="pvore-notifications-app-description">
			<?echo $appling['description'];?><br/>
			You have accessed this appling <?echo $appling['accessCount']?> times.
			</p>
		</div>
		<?
			$buttonType = 'btn-grey';
			$symbol = 'fa-plus';
			if($appling['isFavorite']){
				$symbol = 'fa-star';
				$buttonType = 'btn-warning';
			} 		
		?>
		<div class="pvore-appling-settings-actions">
			<div class="btn btn-mini <?echo $buttonType?> pvore-appling-settings-btn" onclick="toggleFavorite(this, <?echo $appling['appling_id']?>);">
				<span class="fa <?echo $symbol?>"></span> 
				Favorite
			</div>
		</div>
	</div>
	<?/*
	<?if($i<$applingCount-1):?>
		<hr class="notification-hr"/>
	<?endif;?>
	<?$i++;?>
	*/?>
<?endforeach;?>