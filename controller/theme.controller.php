<?php
/**
 * @application    Cubo CMS
 * @type           Controller
 * @class          ThemeController
 * @description    The controller that hold the methods for the theme object
 * @version        1.1.0
 * @date           2018-01-22
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2019 Papiando Riba Internet. All rights reserved.
 * @license        GNU General Public License version 3 or later; see LICENSE.md
 */
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class ThemeController extends Controller {
	private $list_columns = "`id`,`name`,`access`,`author`,`category`,`description`,`status`,`title`,`html`,`css`,`script`";
	protected $path;
	
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
	
	// Load stylesheet from theme
	public function stylesheet() {
		if(Theme::exists(Application::getRouter()->getParam('name'))) {
			// Retrieve theme
			$_theme = Theme::get(Application::getRouter()->getParam('name'));
			// Preset headers
			header("Cache-Control: public");
			header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 86400) . ' GMT');
			header("Content-type: text/css");
			// Generate contents; parameter 'minify' minimises output
			if(is_null(Application::getRouter()->getParam('minify')))
				echo $_theme->css;
			else
				echo self::minifyCSS($_theme->css);
			exit();
		} else {
			throw new \Exception("Stylesheet '".Application::getRouter()->getParam('uri')."' cannot be located");
		}
	}
	
	// Load script from theme
	public function script() {
		if(Theme::exists(Application::getRouter()->getParam('name'))) {
			// Retrieve script
			$_theme = Theme::get(Application::getRouter()->getParam('name'));
			// Preset headers
			header("Cache-Control: public");
			header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 86400) . ' GMT');
			header("Content-type: text/javascript");
			// Generate contents; parameter 'minify' minimises output
			if(is_null(Application::getRouter()->getParam('minify')))
				echo $_theme->script;
			else
				echo self::minifyJS($_theme->script);
			exit();
		} else {
			throw new \Exception("Script '".Application::getRouter()->getParam('uri')."' cannot be located");
		}
	}
}
?>