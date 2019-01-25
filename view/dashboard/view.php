<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");

echo '<article itemProp="hasPart" itemScope itemType="https://schema.org/Article">';

if($this->getAttribute('position_info') == SETTING_ABOVECONTENT) {
	include($this->sharedPath.'show-info.php');
}

if($this->getAttribute('position_image') == SETTING_ABOVETITLE) {
	include($this->sharedPath.'show-image.php');
}

if($this->getAttribute('position_info') == SETTING_ABOVETITLE) {
	include($this->sharedPath.'show-info.php');
}

if($this->getAttribute('show_title') == SETTING_SHOW) {
	include($this->sharedPath.'show-title.php');
}

if($this->getAttribute('position_image') == SETTING_BELOWTITLE) {
	include($this->sharedPath.'show-image.php');
}

if($this->getAttribute('position_info') == SETTING_BELOWTITLE) {
	include($this->sharedPath.'show-info.php');
}

echo '<div itemProp="articleBody">';
include($this->sharedPath.'show-body.php');
echo '</div>';

if($this->getAttribute('position_info') == SETTING_BELOWCONTENT) {
	include($this->sharedPath.'show-info.php');
}

echo '</article>';
?>