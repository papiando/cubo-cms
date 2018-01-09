<?php
/**
 * @application    Cubo CMS
 * @type           Plugin
 * @class          MessagePlugin
 * @version        1.0.0
 * @date           2018-01-09
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2018 Papiando Riba Internet. All rights reserved.
 * @license        GNU General Public License version 3 or later; see LICENSE.md
 */
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class MessagePlugin extends Addon {
	public static function getMessages() {
		$html = "";
		$messages = Session::getMessages();
		foreach($messages as $message) {
			if(is_array($message)) $message = (object)$message;
				$html .= '<div class="alert alert-'.$message->alert.' alert-dismissible fade show" role="alert">';
				$html .= '<strong><i class="fa fa-'.$message->icon.'"></i></strong> '.$message->text;
				$html .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>';
				$html .= '</div>';
		}
		return $html;
	}
	
	public static function run($html) {
		if($html) {
			return preg_replace_callback("/<cubo:message\s*\/>/i",function($matches) { return self::getMessages(); },$html);
		} else {
			return $html;
		}
	}
}