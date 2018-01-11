<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");

$records = array(
	ACCESS_NONE=>'Protected',
	ACCESS_PUBLIC=>'Public',
	ACCESS_REGISTERED=>'Registered',
	ACCESS_GUEST=>'Guest',
	ACCESS_PRIVATE=>'Private'
	);
echo $records[$item->access];
?>