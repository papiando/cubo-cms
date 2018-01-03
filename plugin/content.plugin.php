<?php
/**************************************************************************************************************
 Class ContentPlugin
			The ContentPlugin class replaces all special tags before displaying the output.
 **************************************************************************************************************/
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class ContentPlugin extends Plugin {
	public static function run($html) {
		if($html) {
			return preg_replace_callback("/<cube:param\s+name\s*=\s*[\'\"]([^\'\"]+)[\'\"]\s*\/>/i",function($matches) { return Application::getParam($matches[1]); },$html);
		} else {
			return $html;
		}
	}
}