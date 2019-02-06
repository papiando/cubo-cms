<?php
/**
 * @application    Cubo CMS
 * @type           View
 * @class          UserView
 * @description    The view that generates and prepares the output in different formats for the user object
 * @version        1.2.0
 * @date           2019-02-05
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2019 Papiando Riba Internet
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class UserView extends View {
	// Method login
	public function login() {
		$html = '<h1>User Login</h1><form class="form-login" action="" method="post">';
		$html .= '<div class="form-group"><label for="login">Login name</label><input type="text" name="login" id="login" value="" class="form-control" placeholder="Login name" required autofocus /></div>';
		$html .= '<div class="form-group"><label for="password">Password</label><input type="password" name="password" id="password" value="" class="form-control" placeholder="Password" required /></div>';
		$html .= '<div class="form-group"><button class="btn btn-primary" type="submit">Login</button></div>';
		$html .= '</form>';
		return $html;
	}
}
?>