<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");

$current = (isset($this->_data->status) ? $this->_data->status : STATUS_PUBLISHED);
$items = array(
	array('id'=>STATUS_PUBLISHED,'title'=>'Published'),
	array('id'=>STATUS_UNPUBLISHED,'title'=>'Unpublished'),
	array('id'=>STATUS_TRASHED,'title'=>'Trashed')
	);
foreach($items as $item) {
	echo '<option value="'.$item['id'].'"'.($item['id'] == $current ? ' selected="true"' : '').'>'.$item['title'].'</option>';
}
?>