<?php
/**
 * @application    Cubo CMS
 * @type           Framework
 * @class          Locale
 * @description    The Locale framework handles and simplifies access to the country and region specific data
 * @version        1.1.0
 * @date           2019-02-02
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2019 Papiando Riba Internet
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class Locale {
	protected static $countryAPI = "https://restcountries.eu/rest/v2/all?fields=name;alpha2Code;alpha3Code;region;timezones;currencies;languages;flag";
	protected static $ipAPI = "https://ipapi.co/{IP}/json/";
	
	protected static function retrieveCountryList($api = null) {
		$json = file_get_contents($api ?? self::$countryAPI);
		// Save as session data, because of rate limits imposed
		return $_SESSION['countryAPI'] = json_decode($json);
	}
	
	protected static function retrieveIP($api = null) {
		$api = $api ?? self::$ipAPI;
		$api = preg_replace("/\{IP}/",$_SERVER['REMOTE_ADDR'],$api);
		$json = file_get_contents($api);
		// Save as session data, because of rate limits imposed
		$_SESSION['ipAPI'] = json_decode($json);
	}
	
	public static function getCountryList($fields = "alpha2Code,name",$sort = null) {
		empty($_SESSION['countryAPI']) && self::retrieveCountryList();
		$countries = array();
		$fields = explode(',',$fields);
		foreach($_SESSION['countryAPI'] as $country) {
			$obj = (object)array();
			foreach($fields as $field) {
				$obj->$field = $country->$field;
			}
			$countries[] = $obj;
		}
		return $countries;
	}
	
	public static function getOptions($list,$default = '') {
		$html = '';
		foreach($list as $item) {
			$arr = (array)$item;
			$key = array_keys($arr);
			$html .= "<option value=\"{$arr[$key[0]]}\"".($arr[$key[0]] == $default ? " selected" : "").">{$arr[$key[1]]}</option>";
		}
		return $html;
	}
	
	public static function getDetectedCountry() {
		empty($_SESSION['ipAPI']) && self::retrieveIP();
		return $_SESSION['ipAPI'];
	}
}