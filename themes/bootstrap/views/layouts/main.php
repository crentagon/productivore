﻿<? /* @var $this Controller */ ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!--Stylesheets-->
	<link rel="stylesheet" type="text/css" href="<? echo BASE_URL ?>/assets/font-awesome-4.0.3/css/font-awesome.css" />
	<?if(!Yii::app()->user->isGuest):?>
		<link rel="stylesheet" type="text/css" href="<? echo BASE_URL ?>/css/baseStyles.css" />
    <?else:?>
		<link rel="stylesheet" type="text/css" href="<? echo BASE_URL ?>/css/guest.css" />
	<?endif;?>
	<?if(is_array($this->styles)):?>
		<?foreach($this->styles as $style):?>
			<link rel="stylesheet" type="text/css" href="<? echo BASE_URL ?>/css/<?echo $style?>" />
		<?endforeach;?>
	<?else:?>
		<link rel="stylesheet" type="text/css" href="<? echo BASE_URL ?>/css/<?echo $this->styles?>" />
	<?endif;?>
	
	<?/*<link rel="stylesheet" type="text/css" media="screen and (max-device-width: 480px)" href="<? echo BASE_URL ?>/css/baseStyles.css" />*/?>
	
	<!--Javascripts-->
	<script type="text/javascript" src="<? echo BASE_URL ?>/js/jquery-2.1.0.min.js"></script>
	<?if(!Yii::app()->user->isGuest):?>
		<script type="text/javascript" src="<? echo BASE_URL ?>/js/basescript.js"></script>
	<?else:?>
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
	<?endif;?>
	<?if(is_array($this->scripts)):?>
		<?foreach($this->scripts as $script):?>
			<script type="text/javascript" src="<? echo BASE_URL ?>/js/<?echo $script?>"></script>
		<?endforeach;?>
	<?else:?>
		<script type="text/javascript" src="<? echo BASE_URL ?>/js/<?echo $this->scripts?>"></script>
	<?endif;?>
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<? Yii::app()->bootstrap->register(); ?>
	
</head>

<body>
	<?
		//Is the user logged in?
		$isLoggedIn = false;
		if(!Yii::app()->user->isGuest){
			$isLoggedIn = true;
		}
	?>
	
	<input type="hidden" id="BASE_URL" value="<?echo BASE_URL?>"/>
	
	<br/>
	<?if($isLoggedIn):?>
	<?//The sidebar?>	
	<div class="pvore-dimmer" onclick="hideSidebar();"></div>
	<div class="pvore-dimmer-points" onclick="hideSidebarPoints();"></div>
	<div class="pvore-dimmer-points-container">
		<?/*
		<div id="just-a-slider" class="dragdealer dragger">
			<div class="hp-bar-container">
				<div class="hp-bar"></div>
			</div>
			Points rewarded upon completion?
			<div class="handle red-bar slider-bg">
				<div class="slider value"></div>
			</div>
		</div>
		*/?>
	</div>	
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
			<? //$applingCount = count($this->applings); $i=0;?>
				<div class="pvore-sidebar-app" 
					id="appling-0-list"
					onclick="window.location='<?echo BASE_URL?>'"
					isfavorite="0"
					accesscount="0"
					baseId="appling-0">
					<?
					/*if($appling['notifcount'] != 0):?>
						<div class="appling-icon-notification"><?echo $appling['notifcount']?></div>
					<?endif;
					*/?>
					<div class="pvore-sidebar-app-image">
						<span class="appling-icon fa fa-home fa-2x"></span>
					</div>
					<div class="pvore-sidebar-app-title appling-name-list">
						<span class="appling-name">Home</span><br/>
						<div class="pvore-sidebar-app-description">
						<?
							/* if(isset($appling['message']))
								echo $appling['message'];
							else */
						?>
						<? /* echo $appling['description'];?><br/> */?>
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
						<?
						/*if($appling['notifcount'] != 0):?>
							<div class="appling-icon-notification"><?echo $appling['notifcount']?></div>
						<?endif;
						*/?>
						<div class="pvore-sidebar-app-image">
							<?if($appling['isfavorite'] == 1):?>
								<span class="favorite-appling-icon fa fa-star fa-1"></span>
							<?endif;?>
							<span class="appling-icon fa fa-<?echo $appling['image']?> fa-2x"></span>
						</div>
						<div class="pvore-sidebar-app-title appling-name-list">
							<span class="appling-name"><?echo $appling['name']?></span><br/>
							<div class="pvore-sidebar-app-description">
							<?
								/* if(isset($appling['message']))
									echo $appling['message'];
								else */
							?>
							<? /* echo $appling['description'];?><br/> */?>
							<?foreach($appling['menu_items'] as $menuItem):?>
								- <a href="<?echo BASE_URL.'/'.$appling['url']?>/<?echo $menuItem['menu_url']?>"><?echo $menuItem['menu_name']?></a><br/>
							<?endforeach;?>
							</div>
						</div>
					</div>
					<? /*if($i<$applingCount-1):?>
						<hr class="appling-hr"/>
					<?endif;?>
					<?$i++; */?>
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
						<?if(!$isLoggedIn):?>
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
					
					<?if($isLoggedIn):?>
					<div class="pull-right nav" id="yw2">
						<form class="navbar-search navbar-inverse pull-left" action="">
							<input type="text" class="search-query span2" placeholder="Search">
						</form>
					</div>
					<?endif;?>
				</div>
			  
			  </div>
			</div><!--navbar-->
			<?if($isLoggedIn):?>
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