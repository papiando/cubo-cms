<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");

$source = imagecreatefromstring($this->_data->lob);
imagealphablending($source,false);
imagesavealpha($source,true);
$width = imagesx($source);
$height = imagesy($source);
$ratio = $width / $height;
$mimetype = explode('/',$this->_data->mimetype);
$imagetostring = 'image'.end($mimetype);
$cacheTime = 14400;		// 4 hours
$timestamp = gmdate("D, d M Y H:i:s", time() + $cacheTime) . " GMT";
if(isset($_GET['resize']) || isset($_GET['square']) || isset($_GET['thumbnail'])) {
	// consider width (default: auto), height (default: auto), quality (default: 75%)
	if(isset($_GET['square'])) {
		$newWidth = $newHeight = (int)$_GET['square'];
		$crop = true;
	} elseif(isset($_GET['thumbnail'])) {
		$newWidth = $newHeight = 75;
		$crop = true;
	} else {
		$newWidth = (isset($_GET['width']) ? (int)$_GET['width'] : 0);
		$newHeight = (isset($_GET['height']) ? (int)$_GET['height'] : 0);
		$crop = false;
	}
	if($newWidth == 0 && $newHeight == 0) {
		// Invalid input, so do not resize
		$newWidth = $width;
		$newHeight = $height;
		$ratio = 1;
	} elseif(!$newWidth) {
		// Auto width according to height
		$newWidth = $newHeight * $ratio;
	} elseif(!$newHeight) {
		// Auto height according to width
		$newHeight = $newWidth / $ratio;
	} else {
		$crop = true;
	}
	// Calculate offset when image needs to be cropped
	$newRatio = $newWidth / $newHeight;
	$target = imagecreatetruecolor($newWidth,$newHeight);
	imagealphablending($target,false);
	imagesavealpha($target,true);
	if(!$crop) {
		imagecopyresampled($target,$source,0,0,0,0,$newWidth,$newHeight,$width,$height);
	} elseif($ratio > $newRatio) {
		// Image is cropped left and right
		$offsetWidth = $width - ($newWidth * ($height/$newHeight));
		imagecopyresampled($target,$source,0,0,$offsetWidth/2,0,$newWidth,$newHeight,$width-$offsetWidth,$height);
	} else {
		// Image is cropped top and bottom
		$offsetHeight = $height - ($newHeight * ($width/$newWidth));
		imagecopyresampled($target,$source,0,0,0,$offsetHeight/2,$newWidth,$newHeight,$width,$height-$offsetHeight);
	}
	// Source image no longer needed
	imagedestroy($source);
	// Render image
	header("Content-type: {$this->_data->mimetype}");
	if(!isset($_GET['cache']) || strtolower($_GET['cache']) == 'no' || strtolower($_GET['cache']) == 'false') {
		header("Expires: {$timestamp}");
		header("Pragma: cache");
		header("Cache-Control: max-age={$cacheTime}");
	}
	$imagetostring($target);
	imagedestroy($target);
	exit();
} else {
	// Render image
	header("Content-type: {$this->_data->mimetype}");
	if(!isset($_GET['cache']) || strtolower($_GET['cache']) == 'no' || strtolower($_GET['cache']) == 'false') {
		header("Expires: {$timestamp}");
		header("Pragma: cache");
		header("Cache-Control: max-age={$cacheTime}");
	}
	$imagetostring($source);
	imagedestroy($source);
	exit();
}
?>