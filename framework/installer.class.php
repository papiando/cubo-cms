<?php
/**
 * @application    Cubo CMS
 * @type           Framework
 * @class          Installer
 * @description    The installer framework runs when the site is still not configured;
 *                 it will request the information through a wizard to configure the site
 * @version        1.1.0
 * @date           2019-02-01
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2019 Papiando Riba Internet
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class Installer {
	public static function run($uri) {
		phpinfo();
		// Do nothing
	}
	
	public function __construct() {
		// Apply provided session name
		session_name(__CUBO__);
		// Start the session
		session_start();
		// Run the installer and pass URI
		self::run($_SERVER['REQUEST_URI']);
	}
}