<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");

echo '<article itemProp="hasPart" itemScope itemType="https://schema.org/Article">';

if($this->getAttribute('position_info') == POSITION_ABOVECONTENT) {
	include($this->_sharedPath.'show-info.php');
}

if($this->getAttribute('position_image') == POSITION_ABOVETITLE) {
	include($this->_sharedPath.'show-image.php');
}

if($this->getAttribute('position_info') == POSITION_ABOVETITLE) {
	include($this->_sharedPath.'show-info.php');
}

if($this->getAttribute('show_title') == OPTION_SHOW) {
	include($this->_sharedPath.'show-title.php');
}

if($this->getAttribute('position_image') == POSITION_BELOWTITLE) {
	include($this->_sharedPath.'show-image.php');
}

if($this->getAttribute('position_info') == POSITION_BELOWTITLE) {
	include($this->_sharedPath.'show-info.php');
}

echo '<div itemProp="articleBody">';
include($this->_sharedPath.'show-body.php');
echo '</div>';

if($this->getAttribute('position_info') == POSITION_BELOWCONTENT) {
	include($this->_sharedPath.'show-info.php');
}

echo '</article>';
?>