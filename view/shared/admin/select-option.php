<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");

if(isset($root) and $root) {
	$current = isset($this->_data->option) ? $this->_data->option : OPTION_NONE;
	$query = "SELECT `id`,`title` FROM `menuoption` WHERE `status`=".STATUS_PUBLISHED." ORDER BY `title`";
} else {
	$current = isset($this->_data->option) ? $this->_data->option : OPTION_UNDEFINED;
	$query = "SELECT `id`,`title` FROM `menuoption` WHERE `status`=".STATUS_PUBLISHED." AND `access` ORDER BY `title`";
}
$items = Cubo\Application::$_database->loadItems($query);
foreach($items as $item) {
	echo '<option value="'.$item['id'].'"'.($item['id'] == $current ? ' selected="true"' : '').'>'.$item['title'].'</option>';
}
?>