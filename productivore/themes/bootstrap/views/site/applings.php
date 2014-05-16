<div class="cushion-15"></div>
<div class="pvore-notifications-search-container">
	<form action=""><input type="text" class="search-query pvore-notifications-search-input" id="pvore-notifications-search" placeholder="Appling Search"></form>
</div>

<div class="pvore-notifications-app-hr-container">
	<hr class="pvore-notifications-app-hr"/>
</div>
<?$applingCount = count($allApplings); $i=0;?>

<?foreach($allApplings as $applingid=>$appling):?>

	<div class="pvore-applings-app" 
		id="appling-<?echo $applingid?>-list"
		onclick="window.location='<?echo BASE_URL.'/'.$appling['url']?>'"
		isFavorite="<?echo $appling['isFavorite']?>"
		accessCount="<?echo $appling['accessCount']?>"
		baseId="appling-<?echo $applingid?>">
		<div class="pvore-notifications-app-image">
			<span class="appling-icon fa fa-<?echo $appling['image']?> fa-2x"></span>
		</div>
		<div class="pvore-notifications-app-title appling-name-notification">
			<?echo $appling['name']?><br/>
			<p class="pvore-notifications-app-description">
			<?echo $appling['description'];?><br/>
			You have accessed this appling <?echo $appling['accessCount']?> times.
			</p>
		</div>
	</div>
	<?/*
	<?if($i<$applingCount-1):?>
		<hr class="notification-hr"/>
	<?endif;?>
	<?$i++;?>
	*/?>
<?endforeach;?>