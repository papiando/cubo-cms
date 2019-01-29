<?php
// Added to allow debugging
if(isset($_GET['debug'])) {
	error(E_ALL);
	ini_set('display_errors',1);
}

// Auto-start Cubo framework
require_once(".autoload.php");

// Run the application
Cubo\Application::run($_SERVER['REQUEST_URI']);
?>