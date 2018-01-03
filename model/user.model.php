<?php
/**************************************************************************************************************
 Class User
			The User class contains all users with login access to the framework.
 **************************************************************************************************************/
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class User extends Model {
	public static function getLogin($login) {
		self::$_class = basename(get_called_class());
		Application::getDB()->select("*")->from(strtolower(self::$_class));
		if(strpos($login,'@')) {
			Application::getDB()->where("`email`=:login");
		} else {
			Application::getDB()->where("`name`=:login");
		}
		$result = Application::getDB()->loadObject(Application::getDB()->query(),array(':login'=>$login));
		return is_object($result) ? $result : false;
	}
}
?>