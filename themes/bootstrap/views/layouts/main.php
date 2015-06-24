<? /* @var $this Controller */ ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<? $isGuest = Yii::app()->user->isGuest; ?>

	<!--Common Stylesheets and Scripts-->
	<link rel="stylesheet" type="text/css" href="<? echo BASE_URL ?>/plugins/font-awesome-4.0.3/css/font-awesome.css" />
	<script type="text/javascript" src="<? echo BASE_URL ?>/js/jquery-2.1.0.min.js"></script>
	<!--End of common stylesheets ans scripts-->

    <!--Guests-->
	<?if($isGuest):?>    
	<link rel="stylesheet" type="text/css" href="<? echo BASE_URL ?>/css/guest.css" />
	<script type="text/javascript">
	$(document).ready(function() {
	var C_SIDEBARSPEED = 386;
	$('.flash-msg-exit').click(function(){
	$(this).parent("div").fadeOut(C_SIDEBARSPEED);
	});
	$('.flash-icon-container').click(function(){
	$(this).parent("div").fadeOut(C_SIDEBARSPEED);
	});
	});
	</script>

	<!--Not guests-->
    <?else:?>
	<link rel="stylesheet" type="text/css" href="<? echo BASE_URL ?>/css/basestyles.css" />
	<script type="text/javascript" src="<? echo BASE_URL ?>/js/basescript.js"></script>
	<?endif;?>

	<!--Module-based scripts and styles-->
	<?foreach($this->styles as $style):?>
	<link rel="stylesheet" type="text/css" href="<? echo BASE_URL ?>/css/<?echo $style?>" />
	<?endforeach;?>
	<?foreach($this->scripts as $script):?>
	<script type="text/javascript" src="<? echo BASE_URL ?>/js/<?echo $script?>"></script>
	<?endforeach;?>

	<!--Bootstrap stuff-->
	<link rel="stylesheet" type="text/css" href="<? echo BASE_URL ?>/plugins/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<? echo BASE_URL ?>/plugins/bootstrap/css/bootstrap-responsive.css">
	<link rel="stylesheet" type="text/css" href="<? echo BASE_URL ?>/plugins/bootstrap/css/yii.css">
	<script type="text/javascript" src="<? echo BASE_URL ?>/plugins/bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="<? echo BASE_URL ?>/js/jquery.js"></script>
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>	
	<input type="hidden" id="BASE_URL" value="<?echo BASE_URL?>"/>
	
	<br/>

	<!--Sidebar-->
	<?if(!$isGuest):?>	
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
				<div class="pvore-sidebar-app" 
					id="appling-0-list"
					onclick="window.location='<?echo BASE_URL?>'"
					isfavorite="0"
					accesscount="0"
					baseId="appling-0">
					<div class="pvore-sidebar-app-image">
						<span class="appling-icon fa fa-home fa-2x"></span>
					</div>
					<div class="pvore-sidebar-app-title appling-name-list">
						<span class="appling-name">Home</span><br/>
						<div class="pvore-sidebar-app-description">
						- <a href="<?echo BASE_URL?>/site/applings">Appling Settings</a><br/>
						- <a href="<?echo BASE_URL?>/site/settings">Control Panel</a><br/>
						</div>
					</div>
				</div>
				<?foreach($this->applings as $applingid=>$appling):?>
					<div class="pvore-sidebar-app" 
						id="appling-<?echo $appling['appling_id']?>-list"
						onclick="window.location='<?echo BASE_URL.'/'.$appling['url']?>'"
						isfavorite="<?echo $appling['isfavorite']?>"
						accesscount="<?echo $appling['accesscount']?>"
						baseId="appling-<?echo $appling['appling_id']?>">
						<div class="pvore-sidebar-app-image">
							<?if($appling['isfavorite'] == 1):?>
								<span class="favorite-appling-icon fa fa-star fa-1"></span>
							<?endif;?>
							<span class="appling-icon fa fa-<?echo $appling['image']?> fa-2x"></span>
						</div>
						<div class="pvore-sidebar-app-title appling-name-list">
							<span class="appling-name"><?echo $appling['name']?></span><br/>
							<div class="pvore-sidebar-app-description">
							<?foreach($appling['menu_items'] as $menuItem):?>
								- <a href="<?echo BASE_URL.'/'.$appling['url']?>/<?echo $menuItem['menu_url']?>"><?echo $menuItem['menu_name']?></a><br/>
							<?endforeach;?>
							</div>
						</div>
					</div>
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
	<?endif;?>
	
	<!--Main Content-->
	<div class="super-container">
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
				
				<div class="nav-collapse collapse navbar-inverse" id="yii_bootstrap_collapse_0" style="height:0px">
					<ul class="nav">
						<?if($isGuest):?>
							<li><a href="<?echo BASE_URL?>/site/login">Login</a></li>
							<li><a href="<?echo BASE_URL?>/site/signup">Sign Up</a></li>
						<?else:?>
							<?foreach($this->navbar as $titleParent=>$urlParent):?>
								<?if(is_array($urlParent)):?>
									<li class="dropdown">
										<a class="dropdown-toggle" data-toggle="dropdown" href="#"><?echo $titleParent?> <span class="caret"></span></a>
										<ul class="dropdown-menu dropdown-inverse">
											<?foreach($urlParent as $titleChild=>$urlChild):?>
												<li><a href="<?echo BASE_URL.'/'.$urlChild?>"><?echo $titleChild?></a></li>
											<?endforeach;?>
										</ul>
									</li>
								<?else:?>
									<li><a href="<?echo BASE_URL.'/'.$urlParent?>"><?echo $titleParent?></a></li>
								<?endif;?>
							<?endforeach;?>
						<?endif;?>
					</ul>
					
					<?if(!$isGuest):?>
					<div class="pull-right nav" id="yw2">
						<form class="navbar-search navbar-inverse pull-left" action="">
							<input type="text" class="search-query span2" placeholder="Search">
						</form>
					</div>
					<?endif;?>
				</div>
			  
			  </div>
			</div><!--navbar-->
			<?if(!$isGuest):?>
			<div class="display-if-480 cushion-20"></div>
			<div class="pvore-sidebar-button-main btn-inverse" onclick="showSidebar();">
				Display Sidebar
			</div>
			<?endif;?>
			<div class="flash-messages-fixed">
			
			</div>
			<div class="flash-messages">
			<?
				//Flash messages
				$faIcon = '';
				foreach(Yii::app()->user->getFlashes() as $key => $message) {
					if($key == 'success')
						$faIcon = 'check-circle';
					else if($key == 'warning')
						$faIcon = 'exclamation-triangle';
					else if($key == 'error')
						$faIcon = 'times-circle';
					else 
						$faIcon = 'info-circle';
					
					echo 
						'<div class="flash-msg flash-' . $key . '">'.
							'<div class="flash-icon-container">'.
								'<span class="flash-icon fa fa-'.$faIcon.' fa-2x"></span>'.
							'</div>'.
							$message.
							'<span class="flash-msg-exit fa fa-times"></span>'.
						'</div>';
				}
			?>
			</div>
			
			<?if($this->isLoggingOut):?>
				<div class="flash-msg flash-success">
					<div class="flash-icon-container">
						<span class="flash-icon fa fa-check-circle fa-2x"></span>
					</div>
					You have successfully logged out.
					<span class="flash-msg-exit fa fa-times"></span>
				</div>
			<?endif;?>
			<div class="cushion-20"></div>
			<div class="pvore-content-container">
				<? echo $content; ?>
			</div>
		</div><!--container-->
	</div><!--supercontainer-->
</body>
</html>