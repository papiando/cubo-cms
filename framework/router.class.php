<?php
/**
 * @application    Cubo CMS
 * @type           Framework
 * @class          Router
 * @description    The router analyses the URL and routes the visitor to the correct controller and action;
 *                 the router also includes language intelligence
 * @version        1.1.0
 * @date           2019-01-30
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2019 Papiando Riba Internet
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class Router {
	protected $_params;
	protected $_language;
	
	public function getDefault($param) {
		return Application::getDefault(str_replace(DS,'-',$this->_params->admin ?? '').$param);
	}
	
	public function getParams() {
		return $this->_params;
	}
	
	public function getParam($param,$value = null) {
		return $this->_params->$param ?? $this->getDefault($param) ?? $value;
	}
	
	public function setParam($param,$value) {
		$this->_params->$param = $value;
	}
	
	public function getUri() {
		return $this->getParam('uri');
	}
	
	public function getAdmin() {
		return $this->getParam('admin','');
	}
	
	public function getController() {
		return $this->getParam('controller','article');
	}
	
	public function getLanguage() {
		return $this->getParam('language');
	}
	
	public function getMethod() {
		return $this->getParam('method','default');
	}
	
	public function getRoute() {
		return $this->getParam('route','');
	}
	
	public function getTemplate() {
		return $this->getParam('template','default');
	}
	
	public function getTheme() {
		return $this->getParam('theme','default');
	}
	
	public static function redirect($location) {
		exit(header("Location: {$location}"));
	}
	
	public function __construct($uri) {
		$this->_params = new \stdClass();
		$uri = urldecode(trim($uri,'/'));
		// Split URI
		$uri_parts = explode('?',$uri);
		$uri_parts[] = '';
		$path_parts = explode('/',$uri_parts[0]);
		// Preset language
		$this->_language = Language::get(LANGUAGE_UNDEFINED);
		// Get parameters from query string
		parse_str($uri_parts[1],$params);
		$this->_params = (object)$params;
		// See if there is a parameter without value; assume it's a shorthand method
		foreach($this->_params as $key=>$value) {
			if(empty($value) && empty($this->_params->method))
				$this->_params->method = $key;
		}
		// Parse que rest of the query
		$routes = array('site'=>'',Application::getParam('admin_route','admin')=>'admin'.DS);
		if(count($path_parts)) {
			$part = strtolower(current($path_parts));
			// Get route or language if given
			if(in_array($part,array_keys($routes))) {
				$this->_params->route = $part;
				$this->_params->admin = $routes[$part];
				array_shift($path_parts);
				$part = strtolower(current($path_parts));
			} elseif(Language::exists($part)) {
				$this->_language = Language::get($part);
				$this->_params->language = $this->_language->{'iso639-1'};
				array_shift($path_parts);
				$part = strtolower(current($path_parts));
			}
			// Get controller if given
			if($part) {
				$this->_params->controller = Text::retro($part,$this->_language);
				array_shift($path_parts);
				$part = strtolower(current($path_parts));
			}
			// Remainder is optional name
			if($part)
				$this->_params->name = $part;
		}
		// Store representable URI
		$this->setParam('uri',$uri);
	}
}
?>