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
	
	public function populateApplings(){
		$this->applings[0]['name'] = 'Task List';
		$this->applings[0]['message'] = '3/5 tasks completed today.';
		$this->applings[0]['description'] = 'Manage your to-do.';
		$this->applings[0]['url'] = 'task';
		$this->applings[0]['image'] = 'tasks';
		$this->applings[0]['notifCount'] = 0;
		
		$this->applings[1]['name'] = 'Event Planner';
		$this->applings[1]['message'] = '2/4 events for this week.';
		$this->applings[1]['description'] = 'Organize your life.';
		$this->applings[1]['url'] = 'event';
		$this->applings[1]['image'] = 'calendar';
		$this->applings[1]['notifCount'] = 5;
		
		$this->applings[2]['name'] = 'Budget Tracker';
		$this->applings[2]['message'] = 'You\'ve spent $100 so far today.';
		$this->applings[2]['description'] = 'Know how your money flows.';
		$this->applings[2]['url'] = 'budget';
		$this->applings[2]['image'] = 'money';
		$this->applings[2]['notifCount'] = 23;
		
		$this->applings[3]['name'] = 'Game Records';
		$this->applings[3]['description'] = 'Your virtual achievements.';
		$this->applings[3]['url'] = 'game';
		$this->applings[3]['image'] = 'gamepad';
		$this->applings[3]['notifCount'] = 111;
		
		$this->applings[4]['name'] = 'Life Achievements';
		$this->applings[4]['description'] = 'Your life achievments.';
		$this->applings[4]['url'] = 'budget';
		$this->applings[4]['notifCount'] = 1337;
		$this->applings[4]['image'] = 'trophy';
		
		$this->applings[5]['name'] = 'Personal Journal';
		$this->applings[5]['message'] = 'You haven\'t written anything today!';
		$this->applings[5]['description'] = 'Your secrets are safe with me.';
		$this->applings[5]['url'] = 'brain';
		$this->applings[5]['image'] = 'book';
		$this->applings[5]['notifCount'] = 2;
		
		$this->applings[6]['name'] = 'Sleep Manager';
		$this->applings[6]['description'] = 'Yawn.';
		$this->applings[6]['url'] = 'budget';
		$this->applings[6]['notifCount'] = 3;
		$this->applings[6]['image'] = 'cloud';
		
	}
}