<?php
// Auto-start Cubo framework
require_once(".autoload.php");

// Run the application
Cubo\Application::run($_SERVER['REQUEST_URI']);
?>