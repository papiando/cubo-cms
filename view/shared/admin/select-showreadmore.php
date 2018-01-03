<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");

$current = (isset($this->_data->_attributes->show_readmore) ? $this->_data->_attributes->show_readmore : GLOBAL_SETTING);
$items = array(
	array('id'=>GLOBAL_SETTING,'title'=>'Global setting'),
	array('id'=>READMORE_1PARAGRAPH,'title'=>'After first paragraph'),
	array('id'=>READMORE_5LINES,'title'=>'After 5 lines'),
	array('id'=>OPTION_HIDE,'title'=>'Hide')
	);
foreach($items as $item) {
	echo '<option value="'.$item['id'].'"'.($item['id'] == $current ? ' selected="true"' : '').'>'.$item['title'].'</option>';
}
?>