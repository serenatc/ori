<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));


/**
* Origin - Enable REST API
*/
	Router::mapResources('creator');
	Router::parseExtensions();

/**
* Origin
*/

//USER MANAGEMENT - TEMP
Router::connect('/administrator/accessDenied', array('plugin' => 'usermgmt', 'controller' => 'users', 'action' => 'accessDenied'));
Router::connect('/administrator/activatePassword/*', array('plugin' => 'usermgmt', 'controller' => 'users', 'action' => 'activatePassword'));
Router::connect('/administrator/addGroup', array('plugin' => 'usermgmt', 'controller' => 'user_groups', 'action' => 'addGroup'));
Router::connect('/administrator/addUser', array('plugin' => 'usermgmt', 'controller' => 'users', 'action' => 'addUser'));
Router::connect('/administrator/allGroups', array('plugin' => 'usermgmt', 'controller' => 'user_groups', 'action' => 'index'));
//Router::connect('/administrator/allUsers', array('plugin' => 'usermgmt', 'controller' => 'users', 'action' => 'index'));
//Router::connect('/administrator/changePassword', array('plugin' => 'usermgmt', 'controller' => 'users', 'action' => 'changePassword'));
Router::connect('/administrator/changeUserPassword/*', array('plugin' => 'usermgmt', 'controller' => 'users', 'action' => 'changeUserPassword'));
//Router::connect('/administrator/dashboard', array('plugin' => 'usermgmt', 'controller' => 'users', 'action' => 'dashboard'));
Router::connect('/administrator/deleteGroup/*', array('plugin' => 'usermgmt', 'controller' => 'user_groups', 'action' => 'deleteGroup'));
Router::connect('/administrator/deleteUser/*', array('plugin' => 'usermgmt', 'controller' => 'users', 'action' => 'deleteUser'));
Router::connect('/administrator/editGroup/*', array('plugin' => 'usermgmt', 'controller' => 'user_groups', 'action' => 'editGroup'));
//Router::connect('/administrator/editUser/*', array('plugin' => 'usermgmt', 'controller' => 'users', 'action' => 'editUser'));
Router::connect('/administrator/emailVerification', array('plugin' => 'usermgmt', 'controller' => 'users', 'action' => 'emailVerification'));
Router::connect('/administrator/forgotPassword', array('plugin' => 'usermgmt', 'controller' => 'users', 'action' => 'forgotPassword'));
Router::connect('/administrator/login', array('plugin' => 'usermgmt', 'controller' => 'users', 'action' => 'login'));
Router::connect('/administrator/logout', array('plugin' => 'usermgmt', 'controller' => 'users', 'action' => 'logout'));
Router::connect('/administrator/myprofile', array('plugin' => 'usermgmt', 'controller' => 'users', 'action' => 'myprofile'));
//Router::connect('/administrator/permissions', array('plugin' => 'usermgmt', 'controller' => 'user_group_permissions', 'action' => 'index'));
Router::connect('/administrator/register', array('plugin' => 'usermgmt', 'controller' => 'users', 'action' => 'register'));
Router::connect('/administrator/update_permission', array('plugin' => 'usermgmt', 'controller' => 'user_group_permissions', 'action' => 'update'));
Router::connect('/administrator/userVerification/*', array('plugin' => 'usermgmt', 'controller' => 'users', 'action' => 'userVerification'));
Router::connect('/administrator/viewUser/*', array('plugin' => 'usermgmt', 'controller' => 'users', 'action' => 'viewUser'));


//SYSTEMS
Router::connect('/administrator/settings', array('controller' => 'origin', 'action' => 'adminSettings'));
Router::connect('/administrator/settings/access', array('plugin' => 'usermgmt', 'controller' => 'user_group_permissions', 'action' => 'index'));
Router::connect('/administrator/settings/components', array('controller'=>'origin', 'action'=>'adminComponentList'));
Router::connect('/administrator/settings/password', array('plugin' => 'usermgmt', 'controller' => 'users', 'action' => 'changePassword'));
Router::connect('/administrator/settings/profile/*', array('plugin' => 'usermgmt', 'controller' => 'users', 'action' => 'editUser'));
Router::connect('/administrator/settings/templates', array('controller'=>'origin', 'action'=>'adminTemplateList'));
Router::connect('/administrator/settings/users', array('plugin' => 'usermgmt', 'controller' => 'users', 'action' => 'index'));


//Router::connect('/administrator/Origin/templates', array('controller'=>'origin', 'action'=>'jsonTemplate'));
//Router::connect('/administrator/Origin/template/:template_id', array('controller'=>'origin', 'action'=>'jsonAdTemplate'));


//REST APIs
//Router::connect('/administrator/users/status', array('controller' => 'origin', 'action' => 'dashboardUserStatus'));
Router::connect('/administrator/Origin/Post', array('controller'=>'origin', 'action'=>'platformPost'));
Router::connect('/administrator/Origin/upload', array('controller'=>'origin', 'action'=>'platformUpload'));
Router::connect('/administrator/get/element/:elementFolder/:element', array('controller'=>'origin', 'action'=>'platformLoadElement'));

//JSON Feeds (Admin)
Router::connect('/administrator/get/activity', array('controller'=>'origin', 'action'=>'jsonActivity'));
Router::connect('/administrator/get/ads', array('controller'=>'origin', 'action'=>'jsonList'));
Router::connect('/administrator/get/ad/:originAd_id', array('controller'=>'origin', 'action'=>'jsonAdUnit'));
Router::connect('/administrator/get/adExpand/:originAd_id', array('controller'=>'origin', 'action'=>'jsonAdUnitExpand'));
Router::connect('/administrator/get/components', array('controller'=>'origin', 'action'=>'jsonComponent'));
Router::connect('/administrator/get/components/:component', array('controller'=>'origin', 'action'=>'platformLoadComponent'));
Router::connect('/administrator/get/componentsraw', array('controller'=>'origin', 'action'=>'jsonComponentRaw'));
//Router::connect('/administrator/get/demos', array('controller'=>'origin', 'action'=>'jsonDemoList')); 7.25
Router::connect('/administrator/get/demo/:originAd_id', array('controller'=>'origin', 'action'=>'jsonDemo'));
Router::connect('/administrator/get/library/:originAd_id', array('controller'=>'origin', 'action'=>'jsonLibrary'));
Router::connect('/administrator/get/templates', array('controller'=>'origin', 'action'=>'jsonTemplate'));
//Router::connect('/administrator/get/template/:template_id', array('controller'=>'origin', 'action'=>'jsonAdTemplate')); 7.25
Router::connect('/administrator/get/users', array('plugin' => 'usermgmt', 'controller' => 'users', 'action' => 'index'));
//Router::connect('/administrator/get/monitor/list', array('controller' => 'monitor', 'action' => 'jsonList'));
//Router::connect('/administrator/get/monitor/list/:start_date/:end_date/:category', array('controller' => 'monitor', 'action' => 'jsonList'));
//Router::connect('/administrator/get/monitor/event/:category', array('controller' => 'monitor', 'action' => 'jsonEvent'));
//Router::connect('/administrator/get/monitor/visits', array('controller' => 'monitor', 'action' => 'jsonVisits'));
//Router::connect('/administrator/get/monitor/visits/:start_date/:end_date/:category', array('controller' => 'monitor', 'action' => 'jsonVisits'));
Router::connect('/administrator/get/showcase/:type', array('controller'=>'origin', 'action'=>'jsonListShowcase'));
Router::connect('/administrator/get/sites', array('controller'=>'origin', 'action'=>'jsonSite'));
//Router::connect('/administrator/get/monitor/export/:data', array('controller'=>'monitor', 'action'=>'monitorExport'));

//JSON Feeds (Public)
Router::connect('/get/homepage', array('controller'=>'origin', 'action'=>'jsonHomepage'));
Router::connect('/get/ads', array('controller'=>'origin', 'action'=>'jsonList'));
Router::connect('/get/ad/:originAd_id', array('controller'=>'origin', 'action'=>'jsonAdUnit'));

//RSS Feed
Router::connect('/administrator/get/rss/:url', array('controller'=>'origin', 'action'=>'platformRssFeed'), array('url'=>'(.*)', 'pass'=>array('url')));

//DEMO
Router::connect('/get/templates/:template', array('controller'=>'origin', 'action'=>'demoLoadTemplate'));
Router::connect('/administrator/get/templates/:template', array('controller'=>'origin', 'action'=>'demoLoadTemplate'));
//Router::connect('/administrator/demos', array('controller'=>'origin', 'action'=>'demoList')); 7.24
Router::connect('/administrator/demo/create/:originAd_id', array('controller'=>'origin', 'action'=>'demoCreate'));
Router::connect('/administrator/demo/edit/:alias', array('controller'=>'origin', 'action'=>'demoEdit'));
Router::connect('/administrator/settings/sites', array('controller'=>'origin', 'action'=>'adminSiteList'));
Router::connect('/demo/Origin/:originAd_id', array('controller'=>'origin', 'action'=>'demoOrigin'));
Router::connect('/demo/:alias', array('controller'=>'origin', 'action'=>'demo'));

//AD CREATOR
//Router::connect('/administrator', array('controller'=>'origin', 'action'=>'index'));
//TEMP RE-ROUTE
Router::connect('/administrator', array('controller'=>'origin', 'action'=>'creatorAdList'));
Router::connect('/administrator/list', array('controller'=>'origin', 'action'=>'creatorAdList'));
Router::connect('/administrator/Origin/ad/edit/:originAd_id', array('controller'=>'origin', 'action'=>'creatorAdEdit'));


Router::connect('/administrator/Origin/ad/embed/:originAd_id', array('controller'=>'origin', 'action'=>'platformAdEmbed'));

//AD
//Router::connect('/ad/:originAd_id/config', array('controller'=>'origin', 'action'=>'adInit')); //Testing... NOPE!
Router::connect('/ad/:originAd_id/:originAd_platform/*', array('controller'=>'origin', 'action'=>'ad'));
Router::connect('/adIframe/:originAd_model/:originAd_contentId', array('controller'=>'origin', 'action'=>'adIframe'));

//Analytics
Router::connect('/administrator/analytics', array('controller'=>'monitor', 'action'=>'monitor')); 
Router::connect('/administrator/Monitor/Post', array('controller'=>'monitor', 'action'=>'post'));
//Router::connect('/administrator/Monitor/export/:data', array('controller'=>'monitor', 'action'=>'monitorExport'));

/**
* PUBLIC VIEWS
*/
//Spec Sheets/Guidelines
//Router::connect('/guidelines/:specsheet_alias', array('controller'=>'pages', 'action'=>'display'));


/**
 * Load all plugin routes.  See the CakePlugin documentation on 
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
