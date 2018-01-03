<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");

$query = "SELECT `id`,`title` FROM `language` WHERE `id`='{$item->language}' LIMIT 1";
$record = Cubo\Application::$_database->loadItem($query);
echo $record['title'];
?>