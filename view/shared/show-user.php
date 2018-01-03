<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");
$user = Cubo\Application::getDB()->loadItem("SELECT `name`,`contact`,`title` FROM `user` WHERE `id`='{$this->_data->$person}' LIMIT 1");
if($user && $this->getAttribute('show_'.$person)) {
	echo '<span class="text-nowrap" itemProp="'.$person.'" itemScope itemType="https://schema.org/Person"><i class="fa fa-user"></i> ';
	if(!empty($user['contact'])) {
		$contact = Cubo\Application::getDB()->loadItem("SELECT `name` FROM `contact` WHERE `id`='{$user['contact']}' LIMIT 1");
		echo '<a class="info-link" itemProp="name" href="/contact/'.$contact['name'].'">'.$user['title'].'</a>';
	} else {
		echo '<span itemProp="name">'.$user['title'].'</span>';
	}
	echo '</span>';
} elseif($user) {
	echo '<meta itemProp="'.$person.'" content="'.$user['title'].'" />';
}
?>