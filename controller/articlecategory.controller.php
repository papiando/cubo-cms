<?php
/**
 * @application    Cubo CMS
 * @type           Controller
 * @class          ArticleCategoryController
 * @description    The controller that hold the methods for the article category object
 * @version        1.1.0
 * @date           2019-01-30
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2019 Papiando Riba Internet
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class ArticleCategoryController extends Controller {
	private $list_columns = "`id`,`name`,`access`,`author`,`category`,`description`,`language`,`status`,`tags`,`title`";
	
	// Admin view: list
	public function admin_list($columns = "*",$filter = "`access`<>'".ACCESS_NONE."'",$order = "`title`") {
		parent::admin_list($this->list_columns,$filter,$order);
	}
}
?>