<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class ContactController extends Controller {
	
	public function view() {
		parent::view();
		if($_POST) {
			if($this->_model->saveMessage($_POST)) {
				Session::setMessage(array('alert'=>'success','icon'=>'check','text'=>"Your message was received successfully"));
			}
		}
	}
}
?>