<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class Application {
	protected static $_router;
	protected static $_defaults;
	protected static $_data;
	protected static $_params;
	public static $_database;
	
	public static function getDB() {
		// Connect to database
		self::$_database || self::$_database = new Database(Configuration::get('database'));
		return self::$_database;
	}
	
	public static function getRouter() {
		return self::$_router;
	}
	
	public static function get($property,$default = null) {
		return isset(self::$_data->$property) ? self::$_data->$property : $default;
	}
	
	public static function getData() {
		return self::$_data;
	}
	
	public static function getDefault($property,$default = null) {
		return isset(self::$_defaults->$property) ? self::$_defaults->$property : $default;
	}
	
	public static function getDefaults() {
		return self::$_defaults;
	}
	
	public static function getParam($property,$default = null) {
		return isset(self::$_params->$property) ? self::$_params->$property : $default;
	}
	
	public static function getParams() {
		return self::$_params;
	}
	
	public static function run($uri) {
		// Connect to database
		self::$_database || self::$_database = new Database(Configuration::get('database'));
		// Get application defaults
		self::$_defaults = Configuration::getDefaults();
		// Declare the router
		self::$_router = new Router($uri);
		// Set params
		if(!isset(self::$_params))
			self::$_params = new \stdClass();
		self::$_params->base_url = __BASE__;
		self::$_params->generator = "Cubo CMS by Papiando";
		self::$_params->language = self::$_router->getLanguage();
		self::$_params->provider_name = "Papiando Riba Internet";
		self::$_params->provider_url = "https://papiando.com";
		self::$_params->site_name = Configuration::get('site_name');
		self::$_params->template = self::$_router->getTemplate();
		self::$_params->title = Configuration::get('site_name');
		self::$_params->uri = self::$_params->base_url.$_SERVER['REQUEST_URI'];
		self::$_params->url = self::$_params->base_url.current(explode('?',$_SERVER['REQUEST_URI']));
		// Retrieve layout
		$route = self::$_router->getRoute();
		if($route == Configuration::get('admin_route') && !Session::exists('user')) {
			Session::setMessage("This page requires login access");
			Session::set('login_redirect',$uri);
			Router::redirect('/user/login');
		}
		// Preset controller's class and method
		$class = __CUBO__.'\\'.ucfirst(self::$_router->getController()).'Controller';
		$method = str_replace(DS,'_',strtolower(self::$_router->getMethod().self::$_router->getAction()));
		// Call the controller's method
		$controller = new $class();
		if(method_exists($class,$method)) {
			$controller->$method();
			self::$_data = $controller->getData();
			$view = new View();
			if($controller == 'Image' && $method == 'view') {
				$view->renderImage($controller->getData());
				return;
			} else {
				$html = $view->render($controller->getData());
			}
		} else {
			throw new \Exception("Class '{$class}' does not have the method '{$method}' defined");
		}
		// Render template
		$template = new Template();
		$html = $template->render($html);
		// Run plugins
		$plugins = self::$_database->loadItems("SELECT * FROM `plugin` WHERE `enabled`");
		foreach($plugins as $plugin) {
			$class = __CUBO__.'\\'.ucfirst($plugin['name']).'Plugin';
			$html = $class::run($html);
		}
		// Display output
		echo $html;
	}
}
?>