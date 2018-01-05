<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class Session {
	public static function set($property,$value) {
		$_SESSION[$property] = $value;
	}
	
	public static function get($property) {
		return isset($_SESSION[$property]) ? $_SESSION[$property] : null;
	}
	
	public static function exists($property) {
		return isset($_SESSION[$property]);
	}
	
	public static function delete($property) {
		if(isset($_SESSION[$property]))
			unset($_SESSION[$property]);
	}
	
	public static function getMessage() {
		$message = $_SESSION['message'];
		unset($_SESSION['message']);
		return $message;
	}
	
	public static function setMessage($message) {
		$_SESSION['message'] = $message;
	}
	
	public static function hasMessage() {
		return isset($_SESSION['message']);
	}
	
	public static function getUserId() {
		return (isset($_SESSION['user']) ? $_SESSION['user']->id : 1);
	}
	
	public static function isRegistered() {
		return self::exists('user');
	}
	
	public static function isGuest() {
		return !self::exists('user');
	}
	
	public static function hasAccess($accessLevel) {
		switch($accessLevel) {
			case ACCESS_PUBLIC:
				return true;
			case ACCESS_REGISTERED:
				return self::isRegistered();
			case ACCESS_GUEST:
				return self::isGuest();
			default:
				return false;
		}
	}
	
	public static function requiresAccess() {
		if(self::isRegistered()) {
			return "`access` IN (".ACCESS_PUBLIC.",".ACCESS_REGISTERED.",".ACCESS_PRIVATE.")";
		} else {
			return "`access` IN (".ACCESS_PUBLIC.",".ACCESS_GUEST.",".ACCESS_PRIVATE.")";
		}
	}
	
	public static function requiresViewAccess() {
		if(self::isRegistered()) {
			return "`access` IN (".ACCESS_PUBLIC.",".ACCESS_REGISTERED.",".ACCESS_PRIVATE.") AND `status`=".STATUS_PUBLISHED;
		} else {
			return "`access` IN (".ACCESS_PUBLIC.",".ACCESS_GUEST.",".ACCESS_PRIVATE.") AND `status`=".STATUS_PUBLISHED;
		}
	}
	
	public static function requiresListAccess() {
		if(self::isRegistered()) {
			return "`access` IN (".ACCESS_PUBLIC.",".ACCESS_REGISTERED.") AND `status`=".STATUS_PUBLISHED;
		} else {
			return "`access` IN (".ACCESS_PUBLIC.",".ACCESS_GUEST.") AND `status`=".STATUS_PUBLISHED;
		}
	}
}
?>