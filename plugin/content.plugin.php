<?php
/**
 * @application    Cubo CMS
 * @type           Plugin
 * @class          ContentPlugin
 * @version        1.0.0
 * @date           2018-01-09
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2018 Papiando Riba Internet. All rights reserved.
 * @license        GNU General Public License version 3 or later; see LICENSE.md
 */
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class ContentPlugin extends Addon {
	public static function run($html) {
		if($html) {
			return preg_replace_callback("/<cubo:param\s+name\s*=\s*[\'\"]([^\'\"]+)[\'\"]\s*\/>/i",function($matches) { return Application::getParam($matches[1]); },$html);
		} else {
			return $html;
		}
	}
}