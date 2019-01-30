<?php
/**
 * @application    Cubo CMS
 * @type           Controller
 * @class          UserController
 * @description    The controller that hold the methods for the user object
 * @version        1.1.0
 * @date           2019-01-30
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2019 Papiando Riba Internet
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class UserController extends Controller {
	private $list_columns = "`id`,`name`,`access`,`author`,`description`,`role`,`status`,`title`";
	
	// Admin view: list
	public function admin_list($columns = "*",$filter = "`access`<>'".ACCESS_NONE."'",$order = "`title`") {
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
	
	public function noaccess() {
		echo "<h1>Unauthorised access to this page</h1>";
		echo "<p>You are trying to access a page that requires different authorisation. You are currently logged in as <strong>".Session::get('user')->name."</strong>. This user does not have the permissions to view this page.</p>";
		echo "<p>Please log out and provide the proper credentials, or navigate to another page.</p>";
		echo "<ul><li><a href=\"/user?action=logout\">Log out</a></li></ul>";
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