<?php
/**
 * @application    Cubo CMS
 * @type           Framework
 * @class          Session
 * @version        1.0.0
 * @date           2018-01-09
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2018 Papiando Riba Internet. All rights reserved.
 * @license        GNU General Public License version 3 or later; see LICENSE.md
 */
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class Session {
	public static function set($property,$value) {
		$_SESSION[$property] = $value;
	}
	
	public static function get($property) {
		return $_SESSION[$property] ?? null;
	}
	
	public static function exists($property) {
		return isset($_SESSION[$property]);
	}
	
	public static function delete($property) {
		if(isset($_SESSION[$property]))
			unset($_SESSION[$property]);
	}
	
	public static function getMessages() {
		$messages = $_SESSION['messages'] ?? [];
		unset($_SESSION['messages']);
		return $messages;
	}
	
	public static function setMessage($message) {
		if(!isset($_SESSION['messages'])) $_SESSION['messages'] = [];
		$_SESSION['messages'][] = $message;
	}
	
	public static function hasMessage() {
		return isset($_SESSION['messages']) && count($_SESSION['messages']);
	}
	
	// Returns the user id of the currently logged in user, or NOBODY if not logged in
	public static function getUser() {
		return (isset($_SESSION['user']) ? $_SESSION['user']->id : USER_NOBODY);
	}
	
	// Returns the role id of the currently logged in user, or GUEST if not logged in
	public static function getRole() {
		return (isset($_SESSION['user']) ? $_SESSION['user']->role : ROLE_GUEST);
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
	
	public static function isAccessible($includeNone = false,$excludeSelf = false) {
		return "`status`=".STATUS_PUBLISHED.($excludeSelf ? " AND `id`<>".$excludeSelf : "").($includeNone ? " OR `access`=".ACCESS_NONE : " AND `access`<>".ACCESS_NONE);
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