<?php
/**
 * @application    Cubo CMS
 * @type           Framework
 * @class          Model
 * @description    All models are based on this framework
 *                 Each model has a database table associated to it
 * @version        1.1.0
 * @date           2019-01-17
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2019 Papiando Riba Internet. All rights reserved.
 * @license        GNU General Public License version 3 or later; see LICENSE.md
 */
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class Model {
	protected static $class;		// Class name
	
	// Retrieves the class name and stores it
	protected static function getClass() {
		return self::$class = basename(str_replace('\\','/',get_called_class()));
	}
	
	// Retrieve a single record from the model
	public static function get($id,$columns = "*",$filter = "1") {
		Application::getDB()->select($columns)->from(strtolower(self::getClass()));
		if(is_null($id)) {
			return null;										// Safety net if no valid $id is provided
		} elseif(is_numeric($id)) {
			Application::getDB()->where("`id`=:id AND {$filter}");
		} else {
			Application::getDB()->where("`name`=:id AND {$filter}");
		}
		if($filter == "666") {	// Added for debugging purposes
			print_r(Application::getDB()->getQuery());
		}
		$result = Application::getDB()->loadObject(array(':id'=>$id));
		return (is_object($result) ? $result : null);			// Only return the object, otherwise return nothing
	}
	
	// Retrieve set of records from the model
	public static function getList($columns = "*",$filter = "1",$order = "`title`") {
		Application::getDB()->select($columns)->from(strtolower(self::getClass()))->where($filter)->order($order);
		$result = Application::getDB()->load();
		return (is_array($result) ? $result : null);			// Return an array of objects, otherwise return nothing
	}
	
	// Determine if a record exists
	public static function exists($id,$filter = "1") {
		return self::get($id,"`id`",$filter);					// Only return an object with the id, otherwise return nothing
	}
	
	// Save the object with provided data
	// If $id is provided, update, otherwise insert
	public static function save($data,$id = null) {
		$set = "";
		$binary = "";
		$list = array();
		$attributes = new \stdClass();
		foreach($data as $property=>$value) {
			if(substr($property,0,1) == '-' || substr($property,0,2) == '$-') {
				// This field has not been changed, thus can be ignored
			} elseif(substr($property,0,1) == '@') {
				// This is an attribute, hence should be treated differently
				$property = substr($property,1);
				$attributes->$property = $value;
			} elseif(substr($property,0,1) == '$') {
				// This is a file, so handle differently
				$property = substr($property,1);
				$binary .= (empty($binary) ? "" : ",")."`{$property}`=0x".bin2hex(file_get_contents($value['tmp_name']));
				$set .= (empty($set) ? "" : ",")."`mimetype`=:mimetype";
				$list[":mimetype"] = $value['type'];
			} elseif($property == 'password') {
				// This is a password field, encrypt
				$set .= (empty($set) ? "" : ",")."`{$property}`=:{$property}";
				$list[":{$property}"] = crypt($value,'$2a$11$'.uniqid('',true).'$');
			} elseif($property != 'id') {
				// This is a changed field, but ignore the id
				$set .= (empty($set) ? "" : ",")."`{$property}`=:{$property}";
				$list[":{$property}"] = $value;
			}
		}
		if(!empty($attributes)) {
			$attributes = json_encode($attributes);
			$set .= (empty($set) ? "" : ",")."`@attributes`=:attributes";
			$list[":attributes"] = $attributes;
		}
		$published = isset($list[':status']) && $list[':status'] == STATUS_PUBLISHED;
		if(!is_null($id)) {
			$query = "UPDATE `".strtolower(self::getClass())."` SET ".$set.(empty($binary) ? "" : (empty($set) ? "" : ",").$binary).",`modified`=NOW(),`editor`=".Session::getUser().($published ? ",`published`=NOW(),`publisher`=".Session::getUser() : "")." WHERE `id`={$id}";
		} else {
			$query = "INSERT INTO `".strtolower(self::getClass())."` SET ".$set.(empty($binary) ? "" : (empty($set) ? "" : ",").$binary).",`created`=NOW(),`author`=".Session::getUser().($published ? ",`published`=NOW(),`publisher`=".Session::getUser() : "");
		}
		return Application::getDB()->execute($query,$list);
	}
	
	// Rather than deleting, an item can be trashed
	public static function trash($id) {
		$query = "UPDATE `".strtolower(self::$getClass())."` SET `status`='".STATUS_TRASHED."',`modified`=NOW(),`editor`=".Session::getUser()." WHERE `id`={$id}";
		return Application::getDB()->execute($query);
	}
	
	// Retrieve the class name when creating a model object
	// If $id is provided, retrieve the item, otherwise return nothing
	public function __construct() {
		self::getClass();
	}
}
?>