<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");

$current = (isset($this->_data->$user) ? $this->_data->$user : USER_NOBODY);
$query = "SELECT `id`,`title` FROM `user` ORDER BY `title`";
$items = Cubo\Application::$_database->loadItems($query);
foreach($items as $item) {
	echo '<option value="'.$item['id'].'"'.($item['id'] == $current ? ' selected="true"' : '').'>'.$item['title'].'</option>';
}
?>