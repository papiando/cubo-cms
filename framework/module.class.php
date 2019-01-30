<?php
/**
 * @application    Cubo CMS
 * @type           Framework
 * @class          Module
 * @version        1.1.0
 * @date           2019-01-30
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2019 Papiando Riba Internet
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class Module {
	protected $_data;
	protected $_path;
	
	public function getPath() {
		$router = Application::getRouter();
		if(!$router) {
			return false;
		}
		return $this->_path = __ROOT__.DS.'module'.DS.$this->_data['name'].DS.'default.php';
	}
	
	public function render($data = array()) {
		$this->_data = $data;
		if(file_exists($this->getPath())) {
			// Start buffering output
			ob_start();
			// Write output to buffer
			include($this->_path);
			// Return buffered output
			return ob_get_clean();
		} else {
			throw new \Exception("Module file '{$this->_path}' does not exist");
		}
	}
	
	public function __construct() {
	}
}
?>