<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class Router {
	protected $_params;
	protected $_language;
	protected $_uri;
	
	public function getDefault($param) {
		$method = str_replace(DS,'-',$this->_params->method);
		return Configuration::getDefault($method.$param);
	}
	
	public function getParams() {
		return $this->_params;
	}
	
	public function getParam($param) {
		if(isset($this->_params->$param)) {
			return $this->_params->$param;
		} else {
			return $this->getDefault($param);
		}
	}
	
	public function setParam($param,$value) {
		$this->_params->$param = $value;
	}
	
	public function getUri() {
		return $this->getParam('uri');
	}
	
	public function getAction() {
		return $this->getParam('action');
	}
	
	public function getController() {
		return $this->getParam('controller');
	}
	
	public function getLanguage() {
		return $this->getParam('language');
	}
	
	public function getMethod() {
		return $this->getParam('method');
	}
	
	public function getRoute() {
		return $this->getParam('route');
	}
	
	public function getTemplate() {
		return $this->getParam('template');
	}
	
	public static function redirect($location) {
		header("Location: {$location}");
	}
	
	public function __construct($uri) {
		$this->_params = new \stdClass();
		$uri = urldecode(trim($uri,'/'));
		$this->_admin_route = Configuration::get('admin_route','admin');
		// Split URI
		$uri_parts = explode('?',$uri);
		$uri_parts[] = '';
		$path_parts = explode('/',$uri_parts[0]);
		// Preset language
		$this->_language = Language::get(LANGUAGE_UNDEFINED);
		// Get parameters from query string
		parse_str($uri_parts[1],$params);
		$this->_params = (object)$params;
		$this->_params->method = '';
		$routes = array('site'=>'',$this->_admin_route=>'admin'.DS);
		if(count($path_parts)) {
			$part = strtolower(current($path_parts));
			// Get route or language if given
			if(in_array($part,array_keys($routes))) {
				$this->_params->route = $part;
				$this->_params->method = $routes[$part];
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
			if(!isset($this->_params->action)) {
				if(isset($this->_params->route) && $this->_params->route == $this->_admin_route)
					$this->_params->action = 'list';
				else
					$this->_params->action = 'view';
			}
		}
		// Store representable URI
		$this->setParam('uri',$uri);
	}
}
?>