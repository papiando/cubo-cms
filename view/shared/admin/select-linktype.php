<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");
$current = (isset($this->_attributes->linktype) ? $this->_attributes->linktype : LINKTYPE_ARTICLE);
$items = array(
	array('id'=>LINKTYPE_ARTICLE,'title'=>'Single article'),
	array('id'=>LINKTYPE_CATEGORY,'title'=>'List of articles'),
	array('id'=>LINKTYPE_CONTACT,'title'=>'Single contact'),
	array('id'=>LINKTYPE_GROUP,'title'=>'List of contacts'),
	array('id'=>LINKTYPE_IMAGE,'title'=>'Single image'),
	array('id'=>LINKTYPE_COLLECTION,'title'=>'List of images'),
	array('id'=>LINKTYPE_USER,'title'=>'User options'),
	array('id'=>LINKTYPE_URL,'title'=>'Supplied URL'),
	array('id'=>LINKTYPE_SEPARATOR,'title'=>'Separator')
	);
foreach($items as $item) {
	echo '<option value="'.$item['id'].'"'.($item['id'] == $current ? ' selected="true"' : '').'>'.$item['title'].'</option>';
}
?>