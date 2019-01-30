<?php
/**
 * @application    Cubo CMS
 * @type           Controller
 * @class          ContactGroupController
 * @description    The controller that hold the methods for the contact group object
 * @version        1.1.0
 * @date           2019-01-30
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2019 Papiando Riba Internet
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class ContactGroupController extends Controller {
	private $list_columns = "`id`,`name`,`access`,`author`,`description`,`group`,`language`,`status`,`tags`,`title`";
	
	// Admin view: list
	public function admin_list($columns = "*",$filter = "`access`<>'".ACCESS_NONE."'",$order = "`title`") {
		parent::admin_list($this->list_columns,$filter,$order);
	}
}
?>