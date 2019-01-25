<?php
/**
 * @application    Cubo CMS
 * @type           ArticleController
 * @class          DashboardController
 * @version        1.1.0
 * @date           2019-19-01
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2019 Papiando Riba Internet. All rights reserved.
 * @license        GNU General Public License version 3 or later; see LICENSE.md
 */
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class DashboardController extends ArticleController {
	private $list_columns = "`id`,`name`,`access`,`author`,`category`,`description`,`language`,`status`,`tags`,`title`";
	
	// Admin view: list
	public function admin_list($columns = "*",$filter = "`access`<>'".ACCESS_NONE."'",$order = "`title`") {
		parent::admin_list($this->list_columns,$filter,$order);
	}
}
?>