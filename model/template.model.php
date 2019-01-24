<?php
/**
 * @application    Cubo CMS
 * @type           Model
 * @class          Template
 * @description    The model of the template object
 * @version        1.1.0
 * @date           2019-01-22
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2019 Papiando Riba Internet. All rights reserved.
 * @license        GNU General Public License version 3 or later; see LICENSE.md
 */
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class Template extends Model {
	protected $path;
	
	public function getPath() {
		$router = Application::getRouter();
		if(!$router) {
			return false;
		}
		$template = $router->getTemplate();
		return $this->path = __ROOT__.DS.'template'.DS.$template.DS.'index.php';
	}
	
	public function render($html) {
		if(Template::exists(Application::getRouter()->getTemplate())) {
			$_template = Template::get(Application::getRouter()->getTemplate());
			// Replace content tag with loaded HTML
			return preg_replace("/<cubo:content\s*\/>/i",$html,$_template->html);
		} elseif(file_exists($this->getPath())) {
			// Start buffering output
			ob_start();
			// Write output to buffer
			include($this->path);
			// Replace content tag with HTML in buffered output
			return preg_replace("/<cubo:content\s*\/>/i",$html,ob_get_clean());
		} else {
			throw new \Exception("Template file '{$this->path}' does not exist");
		}
	}
}
?>