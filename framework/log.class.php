<?php
/**
 * @application    Cubo CMS
 * @type           Framework
 * @class          Log
 * @description    Framework to log events
 * @version        1.1.0
 * @date           2018-01-30
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2019 Papiando Riba Internet
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class Log {
	public function __construct($log) {
		if(is_array($log)) {
			$log = (object)$log;
			$log->name = $log->name ?? 'Unspecified';
			$log->title = $log->title ?? 'Unspecified';
			$log->description = $log->description ?? 'Unspecified';
			$log->user = Session::getUser();
			$log->session = session_id();
			$query = "INSERT INTO `log` SET `name`=:name,`title`=:title,`description`=:description,`session`=:session,`author`=:user,`created`=NOW(),`access`=".ACCESS_PRIVATE;
			$result = Application::getDB()->execute($query,array(':name'=>$log->name,':title'=>$log->title,':description'=>$log->description,':session'=>$log->session,':user'=>$log->user));
		} else {
		}
	}
}