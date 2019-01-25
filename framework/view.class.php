<?php
/**
 * @application    Cubo CMS
 * @type           Framework
 * @class          View
 * @version        1.1.0
 * @date           2019-01-22
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2019 Papiando Riba Internet. All rights reserved.
 * @license        GNU General Public License version 3 or later; see LICENSE.md
 */
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class View {
	protected $_data;
	protected $_attributes;
	protected $path;
	public $sharedPath;
	protected $_router;
	protected $_class;
	
	public function getAttribute($attribute) {
		return (isset($this->_attributes->$attribute) ? $this->_attributes->$attribute : null);
	}
	
	public function getPath() {
		if(!$this->_router) {
			return false;
		}
		$layout = $this->_router->getAdmin().$this->_router->getMethod().'.php';
		return $this->path = __ROOT__.DS.'view'.DS.$this->_class.DS.$layout;
	}
	
	public function getDefaultPath() {
		if(!$this->_router) {
			return false;
		}
		$layout = $this->_router->getAdmin().$this->_router->getMethod().'.php';	// TODO: Need to check default
		return $this->path = __ROOT__.DS.'view'.DS.$this->_class.DS.$layout;
	}
	
	public function getSharedPath() {
		if(!$this->_router) {
			return false;
		}
		$layout = $this->_router->getAdmin();	// TODO: Need to check default
		return $this->sharedPath = __ROOT__.DS.'view'.DS.'shared'.DS.$layout;
	}
	
	public function render($data = array()) {
		$this->_data = $data;
		if(isset($data->{'@attributes'})) $this->_attributes = json_decode($data->{'@attributes'});
		$sharedPath = $this->getSharedPath();
		if(file_exists($this->getPath()) || file_exists($this->getDefaultPath())) {
			// Start buffering output
			ob_start();
			// Write output to buffer
			include($this->path);
			// Return buffered output
			return ob_get_clean();
		} else {
			throw new \Exception("Template file '{$this->path}' does not exist");
		}
	}
	
	public function renderImage($data = array()) {
		$this->_data = $data;
		if(file_exists($this->getPath()) || file_exists($this->getDefaultPath())) {
			// Write output to buffer
			include($this->path);
			return;
		} else {
			throw new \Exception("Template file '{$this->path}' does not exist");
		}
	}
	
	public function __construct() {
		$this->_router = Application::getRouter();
		$this->_class = $this->_router->getController();
	}
}
?>