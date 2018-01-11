<?php
/**
 * @application    Cubo CMS
 * @type           Controller
 * @class          UserController
 * @version        1.0.0
 * @date           2018-01-11
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2018 Papiando Riba Internet. All rights reserved.
 * @license        GNU General Public License version 3 or later; see LICENSE.md
 */
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class UserController extends Controller {
	private $list_columns = "`id`,`name`,`access`,`author`,`description`,`role`,`status`,`title`";
	
	// Admin view: list
	public function admin_list($columns = "*",$filter = "1",$order = "`title`") {
		parent::admin_list($this->list_columns,$filter,$order);
	}
	
	public function login() {
		if($_POST && isset($_POST['login']) && isset($_POST['password'])) {
			$user = $this->_model->getLogin(strtolower($_POST['login']));
			if($user && $user->enabled) {
				if(hash_equals($user->password,crypt($_POST['password'],$user->password))) {
					if($user->blocked) {
						Session::setMessage(array('alert'=>'warning','icon'=>'exclamation','text'=>"User is blocked"));
					} elseif($user->verified) {
						Session::set('user',$user);
						Session::setMessage(array('alert'=>'success','icon'=>'check','text'=>"User has logged in successfully"));
						$redirect = Session::get('login_redirect');
						Router::redirect(Session::get('login_redirect'));
					} else {
						Session::setMessage(array('alert'=>'warning','icon'=>'exclamation','text'=>"User is not yet confirmed"));
					}
				} else {
					Session::setMessage(array('alert'=>'danger','icon'=>'ban','text'=>"Invalid login name or password"));
				}
			} else {
				Session::setMessage(array('alert'=>'danger','icon'=>'ban','text'=>"Invalid login name or password"));
			}	
		}
	}
	
	public function logout() {
		Session::setMessage(array('alert'=>'info','icon'=>'exclamation','text'=>"User has logged out"));
		Session::delete('user');
		Router::redirect('/');
	}
	
	public function __construct($data = array()) {
		parent::__construct($data);
		$this->_model = new User();
	}
}
?>