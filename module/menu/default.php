<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");
$params = json_decode($this->_data['params']);
Cubo\Application::getDB()->select("*")->from("menu")->where("`id`={$params->menu}");
$menu = Cubo\Application::getDB()->loadObject();
Cubo\Application::getDB()->select("*")->from("menuoption")->where("`menu`={$params->menu}");
$menuoption = Cubo\Application::getDB()->load();
var_dump($menuoption);
?><ul class="navbar-nav">
	<li class="nav-item"><a class="nav-link text-shadow" href="/">Home</a></li>
</ul>