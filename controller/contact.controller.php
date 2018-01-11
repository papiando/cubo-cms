<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class ContactController extends Controller {
	private $list_columns = "`id`,`name`,`access`,`author`,`description`,`group`,`language`,`status`,`tags`,`title`";
	
	// Admin view: list
	public function admin_list($columns = "*",$filter = "`access`<>'".ACCESS_NONE."'",$order = "`title`") {
		parent::admin_list($this->list_columns,$filter,$order);
	}
	
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