<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");

$current = (isset($this->_data->_attributes->$setting) ? $this->_data->_attributes->$setting : GLOBAL_SETTING);
$items = array(
	array('id'=>GLOBAL_SETTING,'title'=>'Global setting'),
	array('id'=>OPTION_SHOW,'title'=>'Show'),
	array('id'=>OPTION_HIDE,'title'=>'Hide')
	);
foreach($items as $item) {
	echo '<option value="'.$item['id'].'"'.($item['id'] == $current ? ' selected="true"' : '').'>'.$item['title'].'</option>';
}
?>