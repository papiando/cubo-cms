<?php
/**************************************************************************************************************
 Class Language
			The Language class contains all available languages.
 **************************************************************************************************************/
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class Language extends Model {
	
	public static function get($id,$columns = "*") {
		self::$_class = basename(str_replace('\\','/',get_called_class()));
		Application::getDB()->select($columns)->from(strtolower(self::$_class));
		if(is_numeric($id)) {
			Application::getDB()->where("`id`='{$id}'");
		} elseif(strlen($id) == 2) {
			Application::getDB()->where("`iso639-1`=:id");
		} else {
			Application::getDB()->where("`iso639-2`='{$id}'");
		}
		$result = Application::getDB()->loadObject();
		return (is_object($result) ? $result : null);
	}
	
	public static function exists($id) {
		self::$_class = basename(str_replace('\\','/',get_called_class()));
		$query = "SELECT `id` FROM `".strtolower(self::$_class)."`";
		if(is_numeric($id)) {
			$query .= " WHERE `id`=:id";
		} elseif(strlen($id) == 2) {
			$query .= " WHERE `iso639-1`=:id";
		} else {
			$query .= " WHERE `iso639-2`=:id";
		}
		$query .= " AND `active` LIMIT 1";
		$result = Application::getDB()->loadItem($query,array(':id'=>$id));
		return is_array($result);
	}
}
?>