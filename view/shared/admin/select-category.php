<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");

$current = (isset($this->_data->category) ? $this->_data->category : CATEGORY_UNDEFINED);
$query = "SELECT `id`,`title` FROM `articlecategory` ORDER BY `title`";
$items = Cubo\Application::$_database->loadItems($query);
foreach($items as $item) {
	echo '<option value="'.$item['id'].'"'.($item['id'] == $current ? ' selected="true"' : '').'>'.$item['title'].'</option>';
}
?>