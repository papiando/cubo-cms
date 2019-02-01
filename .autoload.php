<?php
/**
 * @application    Cubo CMS
 * @type           Protected code
 * @class          n/a
 * @description    The .autoload.php script presets constants, automates registration of classes, loads the configuration,
 *                 and finally starts the application; this script is called from index.php
 * @version        1.1.0
 * @date           2019-01-30
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2019 Papiando Riba Internet
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo;

// Define global constants
define('__CUBO__',__NAMESPACE__);
define('__BASE__',sprintf("%s://%s",isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',$_SERVER['HTTP_HOST']));

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
if(!defined('CONFIG_LOADED'))
	include_once('.config.php');

// Start the application
new Application();
?>