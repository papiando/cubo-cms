<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");

$current = (isset($this->_data->_attributes->position_image) ? $this->_data->_attributes->position_image : GLOBAL_SETTING);
$items = array(
	array('id'=>GLOBAL_SETTING,'title'=>'Global setting'),
	array('id'=>POSITION_ABOVETITLE,'title'=>'Above title'),
	array('id'=>POSITION_BELOWTITLE,'title'=>'Below title'),
	array('id'=>POSITION_FLOATLEFT,'title'=>'Float left'),
	array('id'=>POSITION_FLOATRIGHT,'title'=>'Float right')
	);
foreach($items as $item) {
	echo '<option value="'.$item['id'].'"'.($item['id'] == $current ? ' selected="true"' : '').'>'.$item['title'].'</option>';
}
?>