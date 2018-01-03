<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class ContactGroupController extends Controller {
	private $list_columns = "`id`,`name`,`category`,`description`,`language`,`status`,`tags`,`title`";
	
	// Admin view: list
	public function admin_list($columns = "*",$filter = "`id`>0",$order = "`title`") {
		parent::admin_list($this->list_columns,$filter,$order);
	}
}
?>