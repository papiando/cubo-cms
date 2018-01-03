<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");
$user = Cubo\Application::getDB()->loadItem("SELECT `name`,`title` FROM `user` WHERE `id`='{$this->_data->$person}' LIMIT 1");
if($user && $this->getAttribute('show_'.$person)) {
	echo '<span class="text-nowrap"><i class="fa fa-user"></i> ';
	if(isset($user->contact)) {
		echo '<a itemProp="'.$person.'" href=""/contact/'.$user['name'].'">'.$user['title'].'</a>';
	} else {
		echo '<span itemProp="'.$person.'">'.$user['title'].'</span>';
	}
	echo '</span>';
} elseif($user) {
	echo '<meta itemProp="'.$person.'" content="'.$user['title'].'" />';
}
?>