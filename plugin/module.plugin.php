<?php
/**
 * @application    Cubo CMS
 * @type           Plugin
 * @class          ModulePlugin
 * @version        1.0.0
 * @date           2018-01-09
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2018 Papiando Riba Internet. All rights reserved.
 * @license        GNU General Public License version 3 or later; see LICENSE.md
 */
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class ModulePlugin extends Addon {
	public static function getPosition($position) {
		$position = Application::getDB()->loadItem("SELECT `name`,`title`,`module`,`params` FROM `position` WHERE `position`=:position AND `enabled` LIMIT 1",array(':position'=>$position));
		if($position) {
			$item = Application::getDB()->loadItem("SELECT * FROM `module` WHERE `id`={$position['module']} AND `enabled` LIMIT 1");
			if($item) {
				if($position['params']) {
					$item['params'] = $position['params'];
				}
			} else
				return false;
		} else
			return false;
		$module = new Module();
		return $module->render($item);
	}
	
	public static function getModule($module) {
		$item = Application::getDB()->loadItem("SELECT * FROM `module` WHERE `name`=:module AND `enabled` LIMIT 1",array(':module'=>$module));
		if(!$item)
			return false;
		$module = new Module();
		return $module->render($item);
	}
	
	public static function run($html) {
		if($html) {
			return preg_replace_callback("/<cubo:module\s+position\s*=\s*[\'\"]([^\'\"]+)[\'\"]\s*\/>/i",function($matches) { return self::getPosition($matches[1]); },$html);
		} else {
			return $html;
		}
	}
}