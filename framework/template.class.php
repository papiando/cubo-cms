<?php
/**
 * @application    Cubo CMS
 * @type           Framework
 * @class          Template
 * @version        1.0.0
 * @date           2018-01-09
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2018 Papiando Riba Internet. All rights reserved.
 * @license        GNU General Public License version 3 or later; see LICENSE.md
 */
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class Template {
	protected $_data;
	protected $_path;
	
	public function getPath() {
		$router = Application::getRouter();
		if(!$router) {
			return false;
		}
		$template = $router->getTemplate();
		return $this->_path = __ROOT__.DS.'template'.DS.$template.DS.'index.php';
	}
	
	public function render($html) {
		if(file_exists($this->getPath())) {
			// Start buffering output
			ob_start();
			// Write output to buffer
			include($this->_path);
			// Replace content tag with HTML in buffered output
			return preg_replace("/<cubo:content\s*\/>/i",$html,ob_get_clean());
		} else {
			throw new \Exception("Template file '{$this->_path}' does not exist");
		}
	}
}
?>