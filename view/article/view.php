<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");

$attribs = json_decode($this->_data->attributes);

if($attribs->position_info == POSITION_ABOVECONTENT) {
	include($this->_sharedPath.'show-info.php');
}

if($attribs->show_title == OPTION_SHOW) {
	include($this->_sharedPath.'show-title.php');
}

echo $this->_data->html;
?>