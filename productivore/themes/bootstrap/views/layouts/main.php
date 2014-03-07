<? /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!--Stylesheets-->
    <link rel="stylesheet" type="text/css" href="<? echo BASE_URL ?>/css/baseStyles.css" />
	
	<!--Javascripts-->
	<script type="text/javascript" src="<? echo BASE_URL ?>/js/jquery-2.1.0.min.js"></script>
	<script type="text/javascript" src="<? echo BASE_URL ?>/js/basescript.js"></script>
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<? Yii::app()->bootstrap->register(); ?>
	
</head>

<body>
	<br/>
	<?//The sidebar?>
	<div class="pVoreDimmer"></div>
	<div class="pVoreSidebarButton" onclick="showSidebar();"></div>
	<div class="pVoreSidebarMenu"></div>
	<?//The main content?>
	<div class="supercontainer"> <?//For quick modification of Bootstrap's properties?>
	<div class="container">
		<div class="navbar"><!--navbar-->
		  <div class="navbar-inner">
			<a class="btn btn-navbar collapsed" data-toggle="collapse" data-target="#yii_bootstrap_collapse_0">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a class="brand" href="#">Title</a>
			<div class="nav-collapse collapse" id="yii_bootstrap_collapse_0" style="height:0px">
				<ul id="yw0" class="nav">
					<li><a href="#">Home</a></li>
					<li><a href="#">Link</a></li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Dropdown <span class="caret"></span></a>
						<ul id="yw1" class="dropdown-menu">
							<li><a tabindex="-1" href="#">Action 1</a></li>
							<li><a tabindex="-1" href="#">Action 2</a></li>
							<li class="divider"></li>
							<li class="nav-header">Header</li>
							<li><a tabindex="-1" href="#">Action 3</a></li>
							<li><a tabindex="-1" href="#">Action 4</a></li>
						</ul>
					</li>
				</ul>
				<form class="navbar-search pull-left" action=""><input type="text" class="search-query span2" placeholder="Search"></form>
				<ul class="pull-right nav" id="yw2">
					<li><a href="#">Link</a></li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							Dropdown
							<span class="caret"></span>
						</a>
						<ul id="yw3" class="dropdown-menu">
							<li><a tabindex="-1" href="#">Action</a></li>
							<li><a tabindex="-1" href="#">Another action</a></li>
							<li><a tabindex="-1" href="#">Something else here</a></li>
							<li class="divider"></li>
							<li><a tabindex="-1" href="#">Separated link</a></li>
						</ul>
					</li>
				</ul>
			</div>
		  </div>
		</div><!--navbar-->
		<? echo $content; ?>
	</div><!--container-->
	</div><!--supercontainer-->
</body>
</html>

<?/*
		<div class="page-header">
			RAWR!
		</div>
		<div class="row"><div class="span1" style="border: 1px solid blue">Ex1</div></div>
		<div class="row"><div class="span2" style="border: 1px solid blue">Ex2</div></div>
		<div class="row"><div class="span3" style="border: 1px solid blue">Ex3</div></div>
		<div class="row"><div class="span4" style="border: 1px solid blue">Ex4</div></div>
		<div class="row"><div class="span5" style="border: 1px solid blue">Ex5</div></div>
		<div class="row"><div class="span6" style="border: 1px solid blue">Ex6</div></div>
		<div class="row"><div class="span7" style="border: 1px solid blue">Ex7</div></div>
		<div class="row"><div class="span8" style="border: 1px solid blue">Ex8</div></div>
		<div class="row"><div class="span9" style="border: 1px solid blue">Ex9</div></div>
		<div class="row"><div class="span10" style="border: 1px solid blue">Ex10</div></div>
		<div class="row"><div class="span11" style="border: 1px solid blue">Ex11</div></div>
		<div class="row"><div class="span12" style="border: 1px solid blue">Ex12</div></div>
		<div class="row"><div class="span3 offset2" style="border: 1px solid blue">Ex2</div></div>
		
*/?>
<?/*
<?php $this->widget('bootstrap.widgets.TbNavbar',array(
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                array('label'=>'Home', 'url'=>array('/site/index')),
                array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
                array('label'=>'Contact', 'url'=>array('/site/contact')),
                array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
            ),
        ),
    ),
)); ?>

<div class="container" id="page">

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<? echo 'LAYOUTS/BOOTSTRAP'; ?>
	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->
*/?>
