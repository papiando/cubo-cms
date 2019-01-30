<?php
/**
 * @application    Cubo CMS
 * @type           Controller
 * @class          TemplateController
 * @description    The controller that hold the methods for the template object
 * @version        1.1.0
 * @date           2019-01-30
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2019 Papiando Riba Internet
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class TemplateController extends Controller {
	private $list_columns = "`id`,`name`,`access`,`author`,`category`,`description`,`status`,`title`,`html`,`css`,`script`";
	
	// Admin view: list
	public function admin_list($columns = "*",$filter = "`access`<>'".ACCESS_NONE."'",$order = "`title`") {
		parent::admin_list($this->list_columns,$filter,$order);
	}
	
	// Minify CSS to speed up loading
	private static function minifyCSS($css){
		$css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
		$css = str_replace(': ', ':', $css);
		$css = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $css);
		$css = str_replace(';}', '}', $css);
		return $css;
	}
	
	// Minify JavaScript to speed up loading
	private static function minifyJS($script){
		$script = preg_replace(array("/\s+\n/", "/\n\s+/", "/ +/"), array("\n", "\n ", " "), $script);
		return $script;
	}
	
	// Load stylesheet from template
	public function stylesheet() {
		if(Template::exists(Application::getRouter()->getParam('name'))) {
			// Retrieve template
			$_template = Template::get(Application::getRouter()->getParam('name'));
			// Preset headers
			header("Cache-Control: public");
			header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 86400) . ' GMT');
			header("Content-type: text/css");
			// Generate contents; parameter 'minify' minimises output
			if(is_null(Application::getRouter()->getParam('minify')))
				echo $_template->css;
			else
				echo self::minifyCSS($_template->css);
			exit();
		} else {
			throw new \Exception("Stylesheet '".Application::getRouter()->getParam('uri')."' cannot be located");
		}
	}
	
	// Load script from template
	public function script() {
		if(Template::exists(Application::getRouter()->getParam('name'))) {
			// Retrieve script
			$_template = Template::get(Application::getRouter()->getParam('name'));
			// Preset headers
			header("Cache-Control: public");
			header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 86400) . ' GMT');
			header("Content-type: text/javascript");
			// Generate contents; parameter 'minify' minimises output
			if(is_null(Application::getRouter()->getParam('minify')))
				echo $_template->script;
			else
				echo self::minifyJS($_template->script);
			exit();
		} else {
			throw new \Exception("Script '".Application::getRouter()->getParam('uri')."' cannot be located");
		}
	}
}
?>