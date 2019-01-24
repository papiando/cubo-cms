<?php
namespace Cubo;

function show(&$var) {
	echo "<pre>";
	print_r($var);
	echo "</pre>";
}

//Configuration::setDefault('method','view');
Configuration::setDefault('controller','dashboard');
Configuration::setDefault('language','en');
Configuration::setDefault('template','home');
Configuration::setDefault('theme','papiando');

Configuration::setDefault('article','home');
Configuration::setDefault('contact','contact');
Configuration::setDefault('dashboard','home');

Configuration::setDefault('admin-action','default');
Configuration::setDefault('admin-list-action','index');
Configuration::setDefault('admin-controller','article');
Configuration::setDefault('admin-language','en');
Configuration::setDefault('admin-route','index');
Configuration::setDefault('admin-template','admin-cubo');

Configuration::set('site_name','This site');
Configuration::set('admin_route','admin');

Configuration::set('database',array('connection'=>"mysql:host=localhost;dbname=cube",'user'=>"papiando",'password'=>"$3c,Pap;!"));
?>