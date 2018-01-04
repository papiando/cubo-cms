<?php
namespace Cubo;

// Define global constants
define('DS',DIRECTORY_SEPARATOR);
define('__ROOT__',dirname(__FILE__));
define('__CUBO__',__NAMESPACE__);
define('__BASE__',sprintf("%s://%s",isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',$_SERVER['HTTP_HOST']));

define('ACCESS_SYSTEM',0);
define('ACCESS_PUBLIC',1);
define('ACCESS_REGISTERED',2);
define('ACCESS_GUEST',3);
define('CATEGORY_ANY',-1);
define('CATEGORY_NONE',0);
define('CATEGORY_UNDEFINED',1);
define('COLLECTION_ANY',-1);
define('COLLECTION_NONE',0);
define('COLLECTION_UNDEFINED',1);
define('GLOBAL_SETTING',1);
define('GROUP_ANY',-1);
define('GROUP_NONE',0);
define('GROUP_UNDEFINED',1);
define('LANGUAGE_ANY',-1);
define('LANGUAGE_UNDEFINED',1);
define('OPTION_ALL',2);
define('OPTION_HIDE',2);
define('OPTION_ON',0);
define('OPTION_OFF',1);
define('OPTION_NO',0);
define('OPTION_NONE',0);
define('OPTION_SHOW',3);
define('OPTION_YES',1);
define('POSITION_ABOVETITLE',2);
define('POSITION_BELOWTITLE',3);
define('POSITION_ABOVECONTENT',4);
define('POSITION_BELOWCONTENT',5);
define('POSITION_FLOATLEFT',6);
define('POSITION_FLOATRIGHT',7);
define('READMORE_1PARAGRAPH',3);
define('READMORE_5LINES',3);
define('ROLE_ANY',-1);
define('ROLE_UNDEFINED',1);
define('SHOW_AUTHOR',4);
define('SHOW_CREATOR',5);
define('SHOW_EDITOR',6);
define('SHOW_PUBLISHER',7);
define('SHOW_CREATEDDATE',5);
define('SHOW_MODIFIEDDATE',6);
define('SHOW_PUBLISHEDDATE',7);
define('STATUS_ANY',-1);
define('STATUS_PUBLISHED',1);
define('STATUS_SYSTEM',0);
define('STATUS_TRASHED',3);
define('STATUS_UNPUBLISHED',2);
define('USER_ANY',-1);
define('USER_NOBODY',1);
define('USER_SYSTEM',2);

// Auto-register classes
spl_autoload_register(function($class) {
	// Get the last part of the class (since all classes will be named Cubo\*)
	$class = basename(str_replace('\\','/',$class));
	// Set path names
	$frameworkPath = __ROOT__.DS.'framework'.DS.strtolower($class).'.class.php';
	$controllerPath = __ROOT__.DS.'controller'.DS.str_replace('controller','',strtolower($class)).'.controller.php';
	$pluginPath = __ROOT__.DS.'plugin'.DS.str_replace('plugin','',strtolower($class)).'.plugin.php';
	$modulePath = __ROOT__.DS.'module'.DS.str_replace('module','',strtolower($class)).'.module.php';
	$modelPath = __ROOT__.DS.'model'.DS.strtolower($class).'.model.php';
	// Include if file exists
	if(file_exists($frameworkPath))
		require_once($frameworkPath);
	elseif(file_exists($controllerPath) && strpos($class,'Controller') > 0)
		require_once($controllerPath);
	elseif(file_exists($pluginPath) && strpos($class,'Plugin') > 0)
		require_once($pluginPath);
	elseif(file_exists($modulePath) && strpos($class,'Module') > 0)
		require_once($modulePath);
	elseif(file_exists($modelPath))
		require_once($modelPath);
	else
		throw new \Exception("Failed to include class '{$class}'");
});

// Retrieve configuration parameters
include_once('.config.php');

// Start session
session_start();
?>