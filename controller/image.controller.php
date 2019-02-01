<?php
/**
 * @application    Cubo CMS
 * @type           Controller
 * @class          ImageController
 * @description    The controller that holds the methods for the image object
 * @version        1.1.0
 * @date           2019-01-30
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2019 Papiando Riba Internet
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class ImageController extends Controller {
	private $list_columns = "`id`,`name`,`access`,`author`,`collection`,`description`,`language`,`status`,`tags`,`title`";
	
	// Admin view: list
	public function admin_list($columns = "*",$filter = "`access`<>'".ACCESS_NONE."'",$order = "`title`") {
		parent::admin_list($this->list_columns,$filter,$order);
	}
	
	// Standard view: view
	public function view() {
		// Generate output
		if(self::getParam('id'))
			$id = self::getParam('id');
		elseif(self::getParam('name'))
			$id = self::getParam('name');
		else
			$id = Application::getDefault(self::getParam('controller'));
		$this->_data = $this->_model->get($id,"*","1");
		if(empty($this->_data)) {
			throw new \Exception("Article cannot be viewed at current access levels");
		}
		if(isset($this->_data->{'@attributes'})) $this->_attributes = json_decode($this->_data->{'@attributes'});
	}
}
?>