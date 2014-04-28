<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	public function __construct(){
		$mainHelper = new MainHelper;
		$this->applingUrl = $mainHelper->get_applingUrl_byApplingId($this->applingId);
		parent::__construct($this->applingUrl[0]['appling_url']);
		$this->populateApplings();
		$this->populateNavbar();
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
	
	public $applings=array();	
	
	public $sidebarInfo=array();
	
	public $navbar=array();
	
	public $applingUrl='';
	
	public $applingId = 0;
	
	public function populateApplings(){	
		$c_orderByFieldId = 1;
		$c_viewTypeFieldId = 2;
		$userId = 1;
		$applingId = 0;
		
		$userApplings = new SidebarHelper;
		
		$this->applings = $userApplings->get_applings_byUserId($userId);	
		
		$this->sidebarInfo['orderby'] = $userApplings->get_settingValues_byFieldId($c_orderByFieldId);
		$this->sidebarInfo['viewtypes'] = $userApplings->get_settingValues_byFieldId($c_viewTypeFieldId);
		$this->sidebarInfo['settings'] = $userApplings->get_sidebarSettings_byUserId($userId);
		
		// $this->debugPrint($this->applings);
	}
	
	public function populateNavbar(){
		$returnArray = array();
		
		$mainHelper = new MainHelper;
		$tempArray = $mainHelper->get_menuByApplingId($this->applingId);
		
		
		foreach($tempArray as $menu){
			if(!$menu['parent_menu_id']){
				// echo 'got here!';
				// $this->debugPrint($menu);
				$returnArray[$menu['menu_name']] = $this->applingUrl[0]['appling_url'].'/'.$menu['menu_url'];
			}
			else{
				//Get menu_name given the parent_menu_id
				$parentName = '';
				foreach($tempArray as $submenu){
					if($submenu['menu_id'] == $menu['parent_menu_id']){
						$parentName = $submenu['menu_name'];
						break;
					}				
				}
				// $this->debugPrint($returnArray);
				if(!is_array($returnArray[$parentName])){
					$returnArray[$parentName] = 
						array($menu['menu_name'] => $this->applingUrl[0]['appling_url'].'/'.$menu['menu_url']);
				}
				else{
					$returnArray[$parentName][$menu['menu_name']] = $this->applingUrl[0]['appling_url'].'/'.$menu['menu_url'];
				}
			}
		}
		
		$returnArray['Control Panel'] = array(
			'Settings' => $this->applingUrl[0]['appling_url'].'/settings',
			'Log out' => 'site/logout'
		);
		
		// $this->debugPrint($returnArray);
		
		/*
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
		*/
		
		$this->navbar = $returnArray;
	}
	
	public function debugPrint($params = array()){
		echo '<pre>';
		print_r($params);
		die();
	}
}