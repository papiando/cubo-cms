<?php
/**
 * @application    Cubo CMS
 * @type           Controller
 * @class          ContactController
 * @description    The controller that hold the methods for the contact object
 * @version        1.1.0
 * @date           2019-01-30
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2019 Papiando Riba Internet
 * @license        MIT License; see LICENSE.md
 */
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