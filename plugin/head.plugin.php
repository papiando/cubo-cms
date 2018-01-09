<?php
/**
 * @application    Cubo CMS
 * @type           Plugin
 * @class          HeadPlugin
 * @version        1.0.0
 * @date           2018-01-09
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2018 Papiando Riba Internet. All rights reserved.
 * @license        GNU General Public License version 3 or later; see LICENSE.md
 */
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class HeadPlugin extends Addon {
	public static function getMetadata() {
		$html = '<title itemprop="name headline">'.Application::get('title',Application::getParam('site_name')).'</title>'.PHP_EOL."\t";
		$html .= '<base itemprop="url" href="'.Application::getParam('base_url').'" />'.PHP_EOL."\t";
		$html .= '<meta charset="utf-8" />'.PHP_EOL."\t";
		$html .= '<meta name="application_name" content="'.Application::getParam('site_name').'" />'.PHP_EOL."\t";
		$html .= '<meta name="author" itemprop="author" content="'.Application::get('author','').'" />'.PHP_EOL."\t";
		$html .= '<meta name="creator" itemprop="creator" itemscope itemtype="https://schema.org/Organization" content="'.Application::getParam('provider_name').'" />'.PHP_EOL."\t";
		$html .= '<meta name="description" itemprop="description" content="'.Application::get('description','').'" />'.PHP_EOL."\t";
		$html .= '<meta name="generator" content="'.Application::getParam('generator').'" />'.PHP_EOL."\t";
		$html .= '<meta name="keywords" itemprop="keywords" content="'.Application::get('tags','').'" />'.PHP_EOL."\t";
		$html .= '<meta name="robots" content="index,follow" />'.PHP_EOL."\t";
		$html .= '<meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no" />'.PHP_EOL."\t";
//		$html .= '<link rel="publisher" href="https://plus.google.com/+Papiando" />.PHP_EOL."\t";
		return $html;
	}

	public static function getTemplates() {
		return "";
	}

	public static function getScripts() {
		return "";
	}
	
	public static function run($html) {
		if($html) {
			return preg_replace_callback("/<cubo:head\s*\/>/i",function($matches) { return self::getMetadata().self::getTemplates().self::getScripts(); },$html);
		} else {
			return $html;
		}
	}
}