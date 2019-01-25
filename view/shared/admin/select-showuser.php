<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");

$current = (isset($this->_data->_attributes->show_author) ? $this->_data->_attributes->show_author : GLOBAL_SETTING);
$items = array(
	array('id'=>GLOBAL_SETTING,'title'=>'Global setting'),
	array('id'=>SHOW_AUTHOR,'title'=>'Show author'),
	array('id'=>SHOW_PUBLISHER,'title'=>'Show publisher'),
	array('id'=>SHOW_EDITOR,'title'=>'Show editor'),
	array('id'=>OPTION_HIDE,'title'=>'Hide')
	);
foreach($items as $item) {
	echo '<option value="'.$item['id'].'"'.($item['id'] == $current ? ' selected="true"' : '').'>'.$item['title'].'</option>';
}
?>