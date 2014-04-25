<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/main';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	public $applings=array();	
	
	public $sidebarInfo=array();
	
	public $navbar=array();
	
	public function populateApplings(){	
		$c_orderByFieldId = 1;
		$c_viewTypeFieldId = 2;
		$userId = 1;
		$applingId = 0;
		
		$userApplings = new SidebarHelper;
		
		$this->applings = $userApplings->getApplings_byUserId($userId);	
		
		$this->sidebarInfo['orderby'] = $userApplings->get_settingValues_byFieldId($c_orderByFieldId);
		$this->sidebarInfo['viewtypes'] = $userApplings->get_settingValues_byFieldId($c_viewTypeFieldId);
		$this->sidebarInfo['settings'] = $userApplings->getSidebarSettings_byUserId($userId);
		
		// echo '<pre>'; print_r($this->applings); die();
	}
	
	public function populateNavbar(){
		$returnArray = array();
		
		$returnArray['Item A'] = '/site/itema';
		$returnArray['Item B'] = '/site/itemb';
		$returnArray['Item C'] = '/site/itemc';
		$returnArray['Item D'] = array(
			'Item W' => '/site/itemw',
			'Item X' => '/site/itemx',
			'Item Y' => '/site/itemy',
			'Item Z' => '/site/itemz'
		);
		$returnArray['Item E'] = '/site/iteme';
		
		$this->navbar = $returnArray;
	}
}