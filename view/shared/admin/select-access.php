<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");
$current = (isset($this->_data->access) ? $this->_data->access : ACCESS_PUBLIC);
$items = array(
	array('id'=>ACCESS_PUBLIC,'title'=>'Public'),
	array('id'=>ACCESS_REGISTERED,'title'=>'Registered'),
	array('id'=>ACCESS_GUEST,'title'=>'Guest')
	);
foreach($items as $item) {
	echo '<option value="'.$item['id'].'"'.($item['id'] == $current ? ' selected="true"' : '').'>'.$item['title'].'</option>';
}
?>