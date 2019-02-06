<?php
/**
 * @application    Cubo CMS
 * @type           Controller
 * @class          ArticleAdminController
 * @description    The controller that holds the admin methods for the article object
 * @version        1.2.0
 * @date           2019-02-05
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2019 Papiando Riba Internet
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class ArticleAdminController extends Controller {
	protected $columns = "`id`,`name`,`access`,`author`,`category`,`description`,`language`,`status`,`tags`,`title`";
	
	// Admin view: list
	public function adminList($columns = "*",$filter = "`access`<>'".ACCESS_NONE."'",$order = "`title`") {
		parent::adminList($this->list_columns,$filter,$order);
	}
}
?>