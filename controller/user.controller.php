<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class UserController extends Controller {
	
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