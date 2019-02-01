<?php
/**
 * @application    Cubo CMS
 * @type           Default document
 * @class          n/a
 * @description    The index.php script is the default document. Its only purpose is to autoload the application.
 * @version        1.1.0
 * @date           2019-01-30
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2019 Papiando Riba Internet
 * @license        MIT License; see LICENSE.md
 */

// Define global constants
define('DS',DIRECTORY_SEPARATOR);
define('__ROOT__',dirname(__FILE__));

// Added to allow debugging
if(isset($_GET['debug'])) {
	error(E_ALL);
	ini_set('display_errors',1);

	// Shows variable
	function show(&$var,$terminate = true) {
		echo "<pre>";
		print_r($var);
		echo "</pre>";
		$terminate || die("Application terminated");
	}
}

// Detect install; if .config.php does not exist, then assume that it's a fresh install
if(preg_match("/^\/install/",$_SERVER['REQUEST_URI']) || !file_exists(__ROOT__.DS.'.config.php')) {
	require_once('install/index.php');
}

// Auto-start Cubo framework
require_once('.autoload.php');
?>