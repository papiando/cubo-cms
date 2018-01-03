<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");

$records = array(
	STATUS_PUBLISHED=>'Published',
	STATUS_UNPUBLISHED=>'Unpublished',
	STATUS_TRASHED=>'Trashed'
	);
echo $records[$item->status];
?>