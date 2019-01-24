<?php
/**************************************************************************************************************
 Class Contact
			The Contact class contains all contacts and allows to save messages.
 **************************************************************************************************************/
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class Contact extends Model {
	public function saveMessage($data,$id = null) {
		// Check if visitor has filled in all required fields
		if(empty($data['name']) || empty($data['email']) || empty($data['subject']) || empty($data['message']))
			return null;
		// Update or insert message record
		if(!$id) {
			$query = "INSERT INTO `message` SET `name`=:name,`email`=:email,`fromname`=:fromname,`message`=:message,`title`=:title,`created`=NOW(),`author`=1,`contact`=1";
		} else {
			$query = "UPDATE `message` SET `name`=:name,`email`=:email,`fromname`=:fromname,`message`=:message,`title`=:title,`created`=NOW(),`author`=1,`contact`=1";
		}
		$list = array(':name'=>Database::seo($data['subject']),':email'=>strtolower($data['email']),':fromname'=>trim($data['name']),':message'=>trim($data['message']),':title'=>trim($data['subject']));
		$this->_database->execute($query,$list);
	}
}
?>