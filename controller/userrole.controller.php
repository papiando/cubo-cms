<?php
/**
 * @application    Cubo CMS
 * @type           Controller
 * @class          UserRoleController
 * @version        1.0.0
 * @date           2018-01-11
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2018 Papiando Riba Internet. All rights reserved.
 * @license        GNU General Public License version 3 or later; see LICENSE.md
 */
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class UserRoleController extends Controller {
	private $list_columns = "`id`,`name`,`access`,`author`,`description`,`status`,`title`";
	
	// Admin view: list
	public function admin_list($columns = "*",$filter = "1",$order = "`title`") {
		parent::admin_list($this->list_columns,$filter,$order);
	}
}
?>