<?php
namespace Cubo;

define('CONFIG_LOADED',1);

// Temporary for debug purposes
function show(&$var) {
	echo "<pre>";
	print_r($var);
	echo "</pre>";
}

// Application defaults
Configuration::setDefault('controller','article');
//Configuration::setDefault('method','view');
Configuration::setDefault('language','en');
Configuration::setDefault('route','index');
Configuration::setDefault('template','papiando');
Configuration::setDefault('theme','papiando');

Configuration::setDefault('article','home');
Configuration::setDefault('contact','contact');

Configuration::setDefault('admin-action','index');
Configuration::setDefault('admin-list-action','index');
Configuration::setDefault('admin-controller','article');
Configuration::setDefault('admin-language','en');
Configuration::setDefault('admin-route','index');
Configuration::setDefault('admin-template','cubo-cms');
Configuration::setDefault('admin-theme','cubo-cms');

// Application parameters (these are accessible using <cubo:param> tags)
Configuration::setParam('site_name','This site');
Configuration::setParam('admin_route','admin');

// Application settings
Configuration::set('database',array('connection'=>"mysql:host=localhost;dbname=cube",'user'=>"papiando",'password'=>"$3c,Pap;!"));
?>