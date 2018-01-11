<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class ImageCollectionController extends Controller {
	private $list_columns = "`id`,`name`,`access`,`author`,`collection`,`description`,`language`,`status`,`tags`,`title`";
	
	// Admin view: list
	public function admin_list($columns = "*",$filter = "`access`<>'".ACCESS_NONE."'",$order = "`title`") {
		parent::admin_list($this->list_columns,$filter,$order);
	}
}
?>