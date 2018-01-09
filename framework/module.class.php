<?php
/**
 * @application    Cubo CMS
 * @type           Framework
 * @class          Module
 * @version        1.0.0
 * @date           2018-01-09
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2018 Papiando Riba Internet. All rights reserved.
 * @license        GNU General Public License version 3 or later; see LICENSE.md
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