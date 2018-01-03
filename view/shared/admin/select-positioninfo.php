<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");

$current = (isset($this->_data->_attributes->position_info) ? $this->_data->_attributes->position_info : GLOBAL_SETTING);
$items = array(
	array('id'=>GLOBAL_SETTING,'title'=>'Global setting'),
	array('id'=>POSITION_ABOVECONTENT,'title'=>'Above content'),
	array('id'=>POSITION_ABOVETITLE,'title'=>'Above title'),
	array('id'=>POSITION_BELOWTITLE,'title'=>'Below title'),
	array('id'=>POSITION_BELOWCONTENT,'title'=>'Below content')
	);
foreach($items as $item) {
	echo '<option value="'.$item['id'].'"'.($item['id'] == $current ? ' selected="true"' : '').'>'.$item['title'].'</option>';
}
?>