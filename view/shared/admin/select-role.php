<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");

$current = isset($this->_data->role) ? $this->_data->role : ROLE_USER;
$query = "SELECT `id`,`title` FROM `userrole` WHERE `status`=".STATUS_PUBLISHED." AND `access` ORDER BY `title`";
$items = Cubo\Application::$_database->loadItems($query);
foreach($items as $item) {
	echo '<option value="'.$item['id'].'"'.($item['id'] == $current ? ' selected="true"' : '').'>'.$item['title'].'</option>';
}
?>