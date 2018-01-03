<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class Configuration {
	protected static $_settings = null;
	protected static $_defaults = null;
	
	public static function get($property) {
		return isset(self::$_settings->$property) ? self::$_settings->$property : null;
	}
	
	public static function set($property,$value) {
		if(!isset(self::$_settings))
			self::$_settings = new \stdClass();
		self::$_settings->$property = $value;
	}
	
	public static function getDefaults() {
		return self::$_defaults;
	}
	
	public static function getDefault($property) {
		return isset(self::$_defaults->$property) ? self::$_defaults->$property : null;
	}
	
	public static function setDefault($property,$value) {
		if(!isset(self::$_defaults))
			self::$_defaults = new \stdClass();
		self::$_defaults->$property = $value;
	}
	
	public function __construct() {
		
	}
}
?>