<?php
/**
 * @application    Cubo CMS
 * @type           Framework
 * @class          Installation
 * @description    The installation framework runs when the site is still not configured;
 *                 It will request the information through a wizard to configure the site
 * @version        1.2.0
 * @date           2019-02-08
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2019 Papiando Riba Internet
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class Installation {
	protected static $path;
	protected static $template = 'cubo-cms';
	protected static $_params = array('site_name'=>'Cubo CMS Installer','base_url'=>__BASE__,'generator'=>"Cubo CMS by Papiando",'template'=>'cubo-cms','brand_logo'=>'/vendor/cubo-cms/cubo-w192.png','brand_name'=>'<strong>Cubo</strong> <em>CMS</em> Installation');
	protected static $_database;
	
	public function __construct() {
		// Apply provided session name
		session_name(__CUBO__);
		// Start the session
		session_start();
		// Run the installer and pass URI
		self::run($_SERVER['REQUEST_URI']);
	}
	
	public static function getDB() {
		// Connect to database
		self::$_database || self::$_database = new Database(Configuration::get('database'));
		return (self::$_database->error() ? null : self::$_database);
	}
	
	protected static function getParam($param) {
		return self::$_params[$param] ?? '';
	}
	
	protected static function getPath() {
		return self::$path = __ROOT__.DS.'vendor'.DS.self::$template.DS.'index.php';
	}
	
	protected static function render($html) {
		try {
			if(file_exists(self::getPath())) {
				// Start buffering output
				ob_start();
				// Write output to buffer
				include(self::getPath());
				// Replace content tag with HTML in buffered output
				return preg_replace("/<cubo:content\s*\/>/i",$html,ob_get_clean());
			} else {
				throw new Error(array('source'=>__CLASS__,'severity'=>4,'response'=>405,'message'=>"Installer template file does not exist"));
			}
		} catch(Error $_error) {
			$_error->showMessage();
		}
	}
	
	public static function run($uri) {
		if(!isset($_SESSION['setup'])) $_SESSION['setup'] = (object)array();
		switch($_REQUEST['next_step'] ?? '1') {
			case '3':
				$_SESSION['setup']->host_name = $_POST['host_name'] ?? $_SESSION['setup']->host_name ?? 'localhost';
				$_SESSION['setup']->dbo_driver = $_POST['dbo_driver'] ?? $_SESSION['setup']->dbo_driver ?? 'mysql';
				$_SESSION['setup']->database_name = $_POST['database_name'] ?? $_SESSION['setup']->database_name ?? 'cubo-cms';
				$_SESSION['setup']->database_user = $_POST['database_user'] ?? $_SESSION['setup']->database_user ?? '';
				$_SESSION['setup']->database_password = $_POST['database_password'] ?? $_SESSION['setup']->database_password ?? '';
				Configuration::set('database',array('dsn'=>"{$_SESSION['setup']->dbo_driver}:host={$_SESSION['setup']->host_name};dbname={$_SESSION['setup']->database_name}",'user'=>$_SESSION['setup']->database_user,'password'=>$_SESSION['setup']->database_password,'ignore_errors'=>true));
				self::$_database || self::$_database = new Database(Configuration::get('database'));
				// Retrieve list of all countries and select detected country as default
				$listOptions = Locale::getOptions(Locale::getCountryList(),'CW');
				//$detectedCountry = Locale::getDetectedCountry();
				if(self::$_database->connected()) {
					$html = '<h1>Installation</h1><h4 class="text-info">Configure your Regional Settings</h4>';
					$html .= "<p>Preset the defaults for your region. You can add languages later if you want your site to be multilingual.</p>";
					$html .= "<form name=\"form-step3\" action=\"\" method=\"post\">";
					$html .= "<input name=\"next_step\" type=\"hidden\" value=\"4\" />";
					$html .= "<div class=\"form-group\"><label for=\"country-name\">Country Name</label><select name=\"country_name\" id=\"country-name\" class=\"form-control\" value=\"".($_SESSION['setup']->country_name ?? 'US')."\" autofocus />".$listOptions."</select></div>";
					$html .= "<div class=\"form-group\"><a class=\"btn btn-info\" href=\"/?debug&next_step=2\">Back</a><button class=\"btn btn-primary\" type=\"submit\">Next</button></div>";
					$html .= "</form>";
					break;
				} else {
					Session::setMessage(array('alert'=>'danger','icon'=>'exclamation','text'=>"Could not connect to the database. Please review the connection details."));
				}
			case '2':
				$_SESSION['setup']->site_name = $_POST['site_name'] ?? $_SESSION['setup']->site_name ?? '';
				$_SESSION['setup']->domain_name = $_POST['domain_name'] ?? $_SESSION['setup']->domain_name ?? '';
				$_SESSION['setup']->site_email = $_POST['site_email'] ?? $_SESSION['setup']->site_email ?? '';
				$html = '<h1>Installation</h1><h4 class="text-info">Configure your Database Connection</h4>';
				$html .= "<p><em>Cubo CMS</em> uses DBO to connect to the database. We expect you to create the database and a user with minimal permissions of SELECT, UPDATE, and INSERT. Please provide this information in the form below and turn to the next page.</p>";
				$html .= "<form name=\"form-step2\" action=\"\" method=\"post\">";
				$html .= "<input name=\"next_step\" type=\"hidden\" value=\"3\" />";
				$html .= "<div class=\"form-group\"><label for=\"site-name\">Host Name</label><input name=\"host_name\" id=\"host-name\" class=\"form-control\" type=\"text\" placeholder=\"Host Name\" value=\"".($_SESSION['setup']->host_name ?? 'localhost')."\" autofocus required /></div>";
				$html .= "<div class=\"form-group\"><label for=\"dbo-driver\">Database Driver</label><input name=\"dbo_driver\" id=\"dbo-driver\" class=\"form-control\" type=\"text\" placeholder=\"Database Driver\" value=\"".($_SESSION['setup']->dbo_driver ?? 'mysql')."\" required /></div>";
				$html .= "<div class=\"form-group\"><label for=\"database-name\">Database Name</label><input name=\"database_name\" id=\"database-name\" class=\"form-control\" type=\"text\" placeholder=\"Database Name\" value=\"".($_SESSION['setup']->database_name ?? 'cubo-cms')."\" required /></div>";
				$html .= "<div class=\"form-group\"><label for=\"database-user\">Database User</label><input name=\"database_user\" id=\"database-user\" class=\"form-control\" type=\"text\" placeholder=\"Database User\" value=\"".($_SESSION['setup']->database_user ?? '')."\" required /></div>";
				$html .= "<div class=\"form-group\"><label for=\"database-password\">Password (visible)</label><input name=\"database_password\" id=\"database-password\" class=\"form-control\" type=\"text\" placeholder=\"Password\" value=\"".htmlspecialchars($_SESSION['setup']->database_password ?? '')."\" required /></div>";
				$html .= "<div class=\"form-group\"><a class=\"btn btn-info\" href=\"/?debug&next_step=1\">Back</a><button class=\"btn btn-primary\" type=\"submit\">Next</button></div>";
				$html .= "</form>";
				break;
			case '1':
				$html = '<h1>Installation</h1><h4 class="text-info">Configure your Site</h4>';
				$html .= "<p>It looks like you just installed <em>Cubo CMS</em> on your server. On behalf of the staff of <em>Cubo CMS</em>, we like to thank you for your support in using this Content Management System.</p>";
				$html .= "<p>This installer will help you configure your web site to suit your needs. First, we need to acquire some general information about your site. Please fill in the form below and turn to the next page.</p>";
				$html .= "<form name=\"form-step1\" action=\"\" method=\"post\">";
				$html .= "<input name=\"next_step\" type=\"hidden\" value=\"2\" />";
				$html .= "<div class=\"form-group\"><label for=\"site-name\">Site Name</label><input name=\"site_name\" id=\"site-name\" class=\"form-control\" type=\"text\" placeholder=\"Site Name\" value=\"".($_SESSION['setup']->site_name ?? '')."\" autofocus required /></div>";
				$html .= "<div class=\"form-group\"><label for=\"domain-name\">Domain Name</label><input name=\"domain_name\" id=\"domain-name\" class=\"form-control\" type=\"text\" placeholder=\"Domain Name\" value=\"".($_SESSION['setup']->domain_name ?? '')."\" required /></div>";
				$html .= "<div class=\"form-group\"><label for=\"site-email\">Email Site Administrator</label><input name=\"site_email\" id=\"site-email\" class=\"form-control\" type=\"email\" placeholder=\"Email Site Administrator\" value=\"".($_SESSION['setup']->site_email ?? '')."\" required /></div>";
				$html .= "<div class=\"form-group\"><button class=\"btn btn-primary\" type=\"submit\">Next</button></div>";
				$html .= "</form>";
		}
		$html = self::render($html);
		$html = preg_replace_callback("/<cubo:param\s+name\s*=\s*[\'\"]([^\'\"]+)[\'\"]\s*\/>/i",function($matches) { return self::getParam($matches[1]); },$html);
		$html = MessagePlugin::run($html);
		// Do nothing
		echo $html;
	}
}