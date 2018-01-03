<?php
namespace Cubo;

function show(&$var) {
	echo "<pre>";
	print_r($var);
	echo "</pre>";
}

Configuration::setDefault('action','view');
Configuration::setDefault('list-action','list');
Configuration::setDefault('controller','article');
Configuration::setDefault('language','en');
Configuration::setDefault('route','index');
Configuration::setDefault('template','papiando');

Configuration::setDefault('article','home');
Configuration::setDefault('contact','contact');

Configuration::setDefault('admin-action','index');
Configuration::setDefault('admin-list-action','index');
Configuration::setDefault('admin-controller','article');
Configuration::setDefault('admin-language','en');
Configuration::setDefault('admin-route','index');
Configuration::setDefault('admin-template','admin-cube');

Configuration::set('site_name','This site');
Configuration::set('admin_route','admin');

Configuration::set('database',array('connection'=>"mysql:host=localhost;dbname=cube",'user'=>"papiando",'password'=>"$3c,Pap;!"));
?>