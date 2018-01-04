<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

define('ACCESS_SYSTEM',0);
define('ACCESS_PUBLIC',1);
define('ACCESS_REGISTERED',2);
define('ACCESS_GUEST',3);
define('ACCESS_PRIVATE',2);
define('CATEGORY_ANY',-1);
define('CATEGORY_NONE',0);
define('CATEGORY_UNDEFINED',1);
define('COLLECTION_ANY',-1);
define('COLLECTION_NONE',0);
define('COLLECTION_UNDEFINED',1);
define('GLOBAL_SETTING',1);
define('GROUP_ANY',-1);
define('GROUP_NONE',0);
define('GROUP_UNDEFINED',1);
define('LANGUAGE_ANY',-1);
define('LANGUAGE_UNDEFINED',1);
define('OPTION_ALL',2);
define('OPTION_HIDE',2);
define('OPTION_ON',0);
define('OPTION_OFF',1);
define('OPTION_NO',0);
define('OPTION_NONE',0);
define('OPTION_SHOW',3);
define('OPTION_YES',1);
define('POSITION_ABOVETITLE',2);
define('POSITION_BELOWTITLE',3);
define('POSITION_ABOVECONTENT',4);
define('POSITION_BELOWCONTENT',5);
define('POSITION_FLOATLEFT',6);
define('POSITION_FLOATRIGHT',7);
define('READMORE_1PARAGRAPH',3);
define('READMORE_5LINES',3);
define('ROLE_ANY',-1);
define('ROLE_UNDEFINED',1);
define('SHOW_AUTHOR',4);
define('SHOW_CREATOR',5);
define('SHOW_EDITOR',6);
define('SHOW_PUBLISHER',7);
define('SHOW_CREATEDDATE',5);
define('SHOW_MODIFIEDDATE',6);
define('SHOW_PUBLISHEDDATE',7);
define('STATUS_ANY',-1);
define('STATUS_PUBLISHED',1);
define('STATUS_SYSTEM',0);
define('STATUS_TRASHED',3);
define('STATUS_UNPUBLISHED',2);
define('USER_ANY',-1);
define('USER_NOBODY',1);
define('USER_SYSTEM',2);

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