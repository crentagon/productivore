<? /* @var $this Controller */ ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!--Stylesheets-->
    <link rel="stylesheet" type="text/css" href="<? echo BASE_URL ?>/css/baseStyles.css" />
    <link rel="stylesheet" type="text/css" href="<? echo BASE_URL ?>/assets/font-awesome-4.0.3/css/font-awesome.min.css" />
	<?/*<link rel="stylesheet" type="text/css" media="screen and (max-device-width: 480px)" href="<? echo BASE_URL ?>/css/baseStyles.css" />*/?>
	
	<!--Javascripts-->
	<script type="text/javascript" src="<? echo BASE_URL ?>/js/jquery-2.1.0.min.js"></script>
	<script type="text/javascript" src="<? echo BASE_URL ?>/js/basescript.js"></script>
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<? Yii::app()->bootstrap->register(); ?>
	
</head>

<body>
	<input type="hidden" id="BASE_URL" value="<?echo BASE_URL?>"/>

	<br/>
	<?//The sidebar?>
	<div class="pvore-dimmer" onclick="hideSidebar();"></div>
	<div class="pvore-sidebar-button" onclick="showSidebar();"><span class="fa fa-chevron-right fa-lg"></span></div>
	<div class="pvore-sidebar-container">
		<div class="pvore-minima" onclick="hideSidebar();"><span class="fa fa-chevron-left fa-lg"></span></div>
		<div class="pvore-sidebar-content">
			<div class="pvore-sidebar-search-container">
				<form action=""><input type="text" class="search-query pvore-sidebar-search-input" id="pvore-sidebar-search" placeholder="Appling Search"></form>
			</div>
			<div class="pvore-sidebar-app-hr-container">
				<hr class="thick pvore-sidebar-app-hr"/>
			</div>
			
			<div class="pvore-sidebar-app-container" id="sidebar-listview">
				<?$applingCount = count($this->applings); $i=0;?>
				<?foreach($this->applings as $applingid=>$appling):?>
					<div class="pvore-sidebar-app" 
						id="appling-<?echo $applingid?>-list"
						onclick="window.location='<?echo BASE_URL.'/'.$appling['url']?>'"
						isFavorite="<?echo $appling['isFavorite']?>"
						accessCount="<?echo $appling['accessCount']?>"
						baseId="appling-<?echo $applingid?>">
						<?if($appling['notifCount'] != 0):?>
							<div class="appling-icon-notification"><?echo $appling['notifCount']?></div>
						<?endif;?>
						<div class="pvore-sidebar-app-image">
							<?if($appling['isFavorite'] == 1):?>
								<span class="favorite-appling-icon fa fa-star fa-1"></span>
							<?endif;?>
							<span class="appling-icon fa fa-<?echo $appling['image']?> fa-2x"></span>
						</div>
						<div class="pvore-sidebar-app-title appling-name-list">
							<?echo $appling['name']?><br/>
							<em class="pvore-sidebar-app-description">
							<?
								if(isset($appling['message']))
									echo $appling['message'];
								else
									echo $appling['description'];
							?>
							</em>
						</div>
					</div>
					<?if($i<$applingCount-1):?>
						<hr class="appling-hr"/>
					<?endif;?>
					<?$i++;?>
				<?endforeach;?>
			</div>
			<div class="pvore-sidebar-options">
				<span class="pvore-sidebar-dropdown" id="pvore-sidebar-frequency">
					<?//Note that the following hidden inputs are displaying the field_value_map_id, to determine what the user's setting are.?>
					<input type="hidden" value="<?echo $this->sidebarInfo['settings'][1]?>" id="orderBySettings"/>
					<input type="hidden" value="<?echo $this->sidebarInfo['settings'][2]?>" id="viewBySettings"/>				
					<span id="current-order" onclick="toggleOrderBy();">LEAST USED</span>
					<span class="order-by-options">
						<div class="order-by-option" id="sidebar-order-1" onclick="orderBy('sidebar-order-1', true);">MOST USED</div>
						<div class="order-by-option" id="sidebar-order-2" onclick="orderBy('sidebar-order-2', true);">ALPHABETICAL</div>
						<div class="order-by-option order-by-final-item" id="sidebar-order-3" onclick="orderBy('sidebar-order-3', true);">FAVORITES</div>
					</span>
				</span>
				<span class="pvore-sidebar-dropdown-arrow" id="pvore-sidebar-frequency-arrow" onclick="toggleOrderBy();">▼</span>
				<span class="pvore-sidebar-dropdown" id="pvore-sidebar-viewtype" onclick="changeView(true)">LIST VIEW</span><span class="pvore-sidebar-dropdown-arrow" id="pvore-sidebar-viewtype-arrow" onclick="changeView(true)">▼</span>
				<div class="pvore-sidebar-dropdown-menu">
				</div>
			</div>
		</div>
	</div><!--.pVoreSidebarContainer-->
	
	<?//The main content?>
	<div class="super-container"> <?//For quick modification of Bootstrap's properties?>
		<div class="container">
			<div class="breadcrumbs-container">
			<?
			if(!empty($this->breadcrumbs)){
				$this->widget('zii.widgets.CBreadcrumbs', array(
					'links'=>$this->breadcrumbs,
				));
			}
			else{
				echo '<a href="'.BASE_URL.'">Productivore</a>';
			}
			?>
			</div>
			<div class="navbar navbar-inverse"><!--navbar-->
			  <div class="navbar-inner navbar-inverse">
				<!--The maximize icon on collapse-->
				<a class="btn btn-navbar collapsed" data-toggle="collapse" data-target="#yii_bootstrap_collapse_0">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				
				<?/*a class="brand" href="#">Title</a*/?>
				<div class="nav-collapse collapse navbar-inverse" id="yii_bootstrap_collapse_0" style="height:0px">
					<ul class="nav">
						<?foreach($this->navbar as $titleParent=>$urlParent):?>
							<?if(is_array($urlParent)):?>
								<li class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" href="#"><?echo $titleParent?> <span class="caret"></span></a>
									<ul class="dropdown-menu">
										<?foreach($urlParent as $titleChild=>$urlChild):?>
											<li><a href="<?echo BASE_URL.$urlChild?>"><?echo $titleChild?></a></li>
										<?endforeach;?>
									</ul>
								</li>
							<?else:?>
								<li><a href="<?echo BASE_URL.$urlParent?>"><?echo $titleParent?></a></li>
							<?endif;?>
						<?endforeach;?>
					</ul>
					
					<div class="pull-right nav" id="yw2">
						<form class="navbar-search navbar-inverse pull-left" action="">
							<input type="text" class="search-query span2" placeholder="Search">
						</form>
					</div>
				</div>
			  
			  </div>
			</div><!--navbar-->
			<? echo $content; ?>
		</div><!--container-->
	</div><!--supercontainer-->
</body>
</html>