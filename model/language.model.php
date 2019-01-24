<?php
/**************************************************************************************************************
 Class Language
			The Language class contains all available languages.
 **************************************************************************************************************/
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class Language extends Model {
	public static function get($id,$columns = "*",$filter = "1") {
		Application::getDB()->select($columns)->from(strtolower(self::getClass()));
		if(is_numeric($id)) {
			Application::getDB()->where("`id`=:id AND {$filter}");
		} elseif(strlen($id) == 2) {
			Application::getDB()->where("`iso639-1`=:id AND {$filter}");
		} else {
			Application::getDB()->where("`iso639-2`=:id AND {$filter}");
		}
		$result = Application::getDB()->loadObject(array(':id'=>$id));
		return (is_object($result) ? $result : null);
	}
	
	public static function exists($id,$filter = "1") {
		Application::getDB()->select("`id`")->from(strtolower(self::getClass()));
		if(is_numeric($id)) {
			Application::getDB()->where("`id`=:id AND {$filter}");
		} elseif(strlen($id) == 2) {
			Application::getDB()->where("`iso639-1`=:id AND {$filter}");
		} else {
			Application::getDB()->where("`iso639-2`=:id AND {$filter}");
		}
		$result = Application::getDB()->loadItem(array(':id'=>$id));
		return is_array($result);
	}
}
?>