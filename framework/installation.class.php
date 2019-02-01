<?php
/**
 * @application    Cubo CMS
 * @type           Framework
 * @class          Installation
 * @description    The installation framework runs when the site is still not configured;
 *                 It will request the information through a wizard to configure the site
 * @version        1.1.0
 * @date           2019-02-01
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2019 Papiando Riba Internet
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class Installation {
	protected static $path;
	protected static $template = 'cubo-cms';
	protected static $_params = array('site_name'=>'Cubo CMS Installer','base_url'=>__BASE__,'generator'=>"Cubo CMS by Papiando",'template'=>'cubo-cms');
	
	protected static function getParam($param) {
		return self::$_params[$param] ?? '';
	}
	
	protected static function getPath() {
		return self::$path = __ROOT__.DS.'template'.DS.self::$template.DS.'index.php';
	}
	
	protected static function render($html) {
		if(file_exists(self::getPath())) {
			// Start buffering output
			ob_start();
			// Write output to buffer
			include(self::getPath());
			// Replace content tag with HTML in buffered output
			return preg_replace("/<cubo:content\s*\/>/i",$html,ob_get_clean());
		} else {
			throw new \Exception("Installer template file does not exist");
		}
	}
	
	public static function run($uri) {
		$html = "<h1>Welcome to Cubo CMS</h1>";
		$html .= "<p>It looks as if you just installed <em>Cubo CMS</em> on your server. On behalf of the staff of <em>Cubo CMS</em>, we like to thank you for your support in using this Content Management System.</p>";
		$html .= "<p>This installer will help you configure your web site to suit your needs. First, we need to acquire some general information about your site. Please fill in the form below and turn to the next page.</p>";
		$html .= "<form name=\"form-step1\" action=\"/?install&step=2\" method=\"post\">";
		$html .= "<div class=\"form-group\"><label for=\"site-name\">Site Name</label><input name=\"site_name\" id=\"site-name\" class=\"form-control\" type=\"text\" placeholder=\"Site Name\" autofocus required /></div>";
		$html .= "<div class=\"form-group\"><label for=\"domain-name\">Domain Name</label><input name=\"domain_name\" id=\"domain-name\" class=\"form-control\" type=\"text\" placeholder=\"Domain Name\" required /></div>";
		$html .= "<div class=\"form-group\"><label for=\"site-email\">Email Site Administrator</label><input name=\"site_email\" id=\"site-email\" class=\"form-control\" type=\"email\" placeholder=\"Email Site Administrator\" required /></div>";
		$html .= "<div class=\"form-group\"><button class=\"btn btn-primary\" type=\"submit\">Next</button></div>";
		$html .= "</form>";
		$html = self::render($html);
		$html = preg_replace_callback("/<cubo:param\s+name\s*=\s*[\'\"]([^\'\"]+)[\'\"]\s*\/>/i",function($matches) { return self::getParam($matches[1]); },$html);
		// Do nothing
		echo $html;
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