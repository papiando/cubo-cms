<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class MenuOptionController extends Controller {
	private $list_columns = "`id`,`name`,`language`,`menu`,`option`,`status`,`title`";
	
	// Admin view: list
	public function admin_list($columns = "*",$filter = "1",$order = "`title`") {
		parent::admin_list($this->list_columns,$filter,$order);
	}
}
?>