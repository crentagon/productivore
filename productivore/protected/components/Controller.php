<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	public function __construct(){
		
		$mainHelper = new MainHelper;
		$this->applingInfo = $mainHelper->get_applingInfo_byApplingId($this->applingId);
		$this->applingName = $this->applingInfo[0]['appling_name'];
		$this->applingUrl = $this->applingInfo[0]['appling_url'];
		parent::__construct($this->applingUrl);
		
		if(Yii::app()->user->isGuest && $this->applingId != 0){
			throw new CHttpException(404,'The page could not be found.');
		}
		else{
			$this->populateApplings();
			$this->populateNavbar();
		}
	}
	
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
	
	//Sidebar things
	public $applings=array();	
	public $sidebarInfo=array();
	
	//Other constants
	public $navbar=array();
	public $applingInfo=array();
	public $applingUrl = '';
	public $applingName = '';
	public $applingId = 0;
	public $isLoggingOut = false;
	
	//Styles and scripts
	public $styles = array();
	public $scripts = array();
	
	//Populates the sidebar's applings
	public function populateApplings(){	
		$c_orderByFieldId = 1;
		$c_viewTypeFieldId = 2;
		$userId = Yii::app()->user->getId();
		// $userId = 1;
		$applingId = 0;
		
		$userApplings = new SidebarHelper;
		
		$this->applings = $userApplings->get_applings_byUserId($userId);	
		
		$this->sidebarInfo['orderby'] = $userApplings->get_settingValues_byFieldId($c_orderByFieldId);
		$this->sidebarInfo['viewtypes'] = $userApplings->get_settingValues_byFieldId($c_viewTypeFieldId);
		$this->sidebarInfo['settings'] = $userApplings->get_sidebarSettings_byUserId($userId);
	}
	
	//Populates the navbar with the current appling's menu options
	public function populateNavbar(){
		$returnArray = array();
		
		$mainHelper = new MainHelper;
		$tempArray = $mainHelper->get_menuByApplingId($this->applingId);
		
		foreach($tempArray as $menu){
			if(!$menu['parent_menu_id']){
				$returnArray[$menu['menu_name']] = $this->applingUrl.'/'.$menu['menu_url'];
			}
			else{
				$parentName = '';
				foreach($tempArray as $submenu){
					if($submenu['menu_id'] == $menu['parent_menu_id']){
						$parentName = $submenu['menu_name'];
						break;
					}				
				}
				if(!is_array($returnArray[$parentName])){
					$returnArray[$parentName] = 
						array($menu['menu_name'] => $this->applingUrl.'/'.$menu['menu_url']);
				}
				else{
					$returnArray[$parentName][$menu['menu_name']] = $this->applingUrl.'/'.$menu['menu_url'];
				}
			}
		}
		
		$returnArray['Control Panel'] = array(
			$this->applingName.' Settings' => $this->applingUrl.'/settings',
			'Log out ('.Yii::app()->user->getName().')' => 'site/logout'
		);
		
		$this->navbar = $returnArray;
	}
	
	public function debugPrint($params = array()){
		echo '<pre>';
		print_r($params);
		die();
	}
	
	//Load the appling's scripts
	public function loadScripts($params = 'baseScript.js'){
		$this->scripts[] = $params;
	}
	
	//Load the appling's styles
	public function loadStyles($params = 'baseStyles.css'){
		$this->styles[] = $params;
	}
	
	//Set the page up
	public function setupPage($pageTitle, $breadcrumbs = array()){
		$this->pageTitle = $pageTitle;
		$this->breadcrumbs = $breadcrumbs;
	}
	
}