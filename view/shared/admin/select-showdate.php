<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");

$current = (isset($this->_data->_attributes->show_date) ? $this->_data->_attributes->show_date : GLOBAL_SETTING);
$items = array(
	array('id'=>GLOBAL_SETTING,'title'=>'Global setting'),
	array('id'=>SHOW_PUBLISHEDDATE,'title'=>'Show published date'),
	array('id'=>SHOW_CREATEDDATE,'title'=>'Show created date'),
	array('id'=>SHOW_MODIFIEDDATE,'title'=>'Show modified date'),
	array('id'=>OPTION_HIDE,'title'=>'Hide')
	);
foreach($items as $item) {
	echo '<option value="'.$item['id'].'"'.($item['id'] == $current ? ' selected="true"' : '').'>'.$item['title'].'</option>';
}
?>