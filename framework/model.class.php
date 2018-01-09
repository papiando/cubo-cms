<?php
/**
 * @application    Cubo CMS
 * @type           Framework
 * @class          Model
 * @version        1.0.0
 * @date           2018-01-09
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2018 Papiando Riba Internet. All rights reserved.
 * @license        GNU General Public License version 3 or later; see LICENSE.md
 */
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class Model {
	protected static $_class;
	
	public static function get($id,$columns = "*",$filter = "1") {
		self::$_class = basename(str_replace('\\','/',get_called_class()));
		Application::getDB()->select($columns)->from(strtolower(self::$_class));
		if(is_numeric($id)) {
			Application::getDB()->where("`id`=:id AND {$filter}");
		} else {
			Application::getDB()->where("`name`=:id AND {$filter}");
		}
		$result = Application::getDB()->loadObject(array(':id'=>$id));
		return (is_object($result) ? $result : null);
	}
	
	public static function getList($columns = "*",$filter = "1",$order = "`title`") {
		self::$_class = basename(str_replace('\\','/',get_called_class()));
		Application::getDB()->select($columns)->from(strtolower(self::$_class))->where($filter)->order($order);
		$result = Application::getDB()->load();
		return (is_array($result) ? $result : null);
	}
	
	public static function exists($id,$filter = "1") {
		self::$_class = basename(str_replace('\\','/',get_called_class()));
		Application::getDB()->select($columns)->from(strtolower(self::$_class));
		if(is_numeric($id)) {
			Application::getDB()->where("`id`=:id AND {$filter}");
		} else {
			Application::getDB()->where("`name`=:id AND {$filter}");
		}
		$result = Application::getDB()->loadItem(array(':id'=>$id));
		return is_array($result);
	}
	
	public function save($data,$id = null) {
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
			$query = "UPDATE `".strtolower(self::$_class)."` SET ".$set.(empty($binary) ? "" : (empty($set) ? "" : ",").$binary).",`modified`=NOW(),`editor`=".Session::getUserId().($published ? ",`published`=NOW(),`publisher`=".Session::getUser() : "")." WHERE `id`={$id}";
		} else {
			$query = "INSERT INTO `".strtolower(self::$_class)."` SET ".$set.(empty($binary) ? "" : (empty($set) ? "" : ",").$binary).",`created`=NOW(),`author`=".Session::getUserId().($published ? ",`published`=NOW(),`publisher`=".Session::getUser() : "");
		}
		return Application::getDB()->execute($query,$list);
	}
	
	public function trash($id) {
		$query = "UPDATE `".strtolower(self::$_class)."` SET `status`='".STATUS_TRASHED."',`modified`=NOW(),`editor`=".Session::getUser()." WHERE `id`={$id}";
		return Application::getDB()->execute($query);
	}
	
	public function __construct($id = null) {
		self::$_class = basename(str_replace('\\','/',get_called_class()));
	}
}
?>