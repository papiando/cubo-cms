<?php
/**
 * @application    Cubo CMS
 * @type           Controller
 * @class          ArticleController
 * @description    The controller that holds the methods for the article object
 * @version        1.2.0
 * @date           2019-02-05
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2019 Papiando Riba Internet
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class ArticleController extends Controller {
	protected $columns = "`id`,`name`,`access`,`author`,`category`,`description`,`language`,`status`,`tags`,`title`";
}
?>