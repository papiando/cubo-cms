<?php
if(isset($_POST['set']) && isset($_POST['property']) && isset($_POST['value'])) {
	$set = $_POST['set'];
	$property = $_POST['property'];
	$value = $_POST['value'];
	session_start();
	if(!isset($_SESSION[$set])) $_SESSION[$set] = [];
	$_SESSION[$set][$property] = (int)$value;
}
?>