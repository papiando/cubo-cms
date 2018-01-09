<?php
/**
 * @application    Cubo CMS
 * @type           Framework
 * @class          Controller
 * @version        1.0.0
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2018 Papiando Riba Internet. All rights reserved.
 * @license        GNU General Public License version 3 or later; see LICENSE.md
 */
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class Controller {
	protected $_attributes;
	protected $_class;
	protected $_data;
	protected $_language;
	protected $_model;
	protected $_params;
	
	// Default access levels
	protected static $_authors = array(ROLE_AUTHOR,ROLE_EDITOR,ROLE_PUBLISHER,ROLE_MANAGER,ROLE_ADMINISTRATOR);
	protected static $_editors = array(ROLE_EDITOR,ROLE_PUBLISHER,ROLE_MANAGER,ROLE_ADMINISTRATOR);
	protected static $_publishers = array(ROLE_PUBLISHER,ROLE_MANAGER,ROLE_ADMINISTRATOR);
	protected static $_managers = array(ROLE_MANAGER,ROLE_ADMINISTRATOR);
	
	// Standard view: list
	public function list() {
		$this->_data = $this->_model->getList("*",Session::requiresListAccess());
	}
	
	// Standard view: view
	public function view() {
		// Generate output
		if(self::getParam('id'))
			$id = self::getParam('id');
		elseif(self::getParam('name'))
			$id = self::getParam('name');
		else
			$id = Configuration::getDefault(self::getParam('controller'));
		$this->_data = $this->_model->get($id,"*",Session::requiresViewAccess());
		if(empty($this->_data)) {
			throw new \Exception("Article cannot be viewed at current access levels");
		}
		if(isset($this->_data->{'@attributes'})) $this->_attributes = json_decode($this->_data->{'@attributes'});
	}
	
	// Admin view: list
	public function admin_list($columns = "*",$filter = "1",$order = "`title`") {
		$this->_data = $this->_model->getList($columns,$filter,$order);
	}
	
	// Admin view: create
	public function admin_create() {
		// Save posted data
		if($_POST) {
			if(isset($_FILES)) {
				foreach($_FILES as $file=>$data) {
					$_POST['$'.$file] = $data;
				}
			}
			if($this->_model->save($_POST)) {
				Session::setMessage("Item was created");
			} else {
				Session::setMessage("Failed to create item");
			}
			Router::redirect('/admin/'.strtolower($this->_class));
		}
	}
	
	// Admin view: add
	public function admin_add() {
		admin_create();
	}
	
	// Admin view: edit
	public function admin_edit() {
		// Save posted data
		if($_POST) {
			if(isset($_FILES)) {
				foreach($_FILES as $file=>$data) {
					$_POST['$'.$file] = $data;
				}
			}
			if($this->_model->save($_POST,$_POST['id'])) {
				Session::setMessage("Item was edited");
			} else {
				Session::setMessage("Failed to edit item");
			}
			Router::redirect('/admin/'.strtolower($this->_class));
		}
		if(isset($_GET['id'])) {
			$this->_data = $this->_model->get($_GET['id']);
			if(isset($this->_data->{'@attributes'})) $this->_attributes = json_decode($this->_data->{'@attributes'});
		} else {
			Session::setMessage("This item does not exist");
			Router::redirect('/admin/'.strtolower($this->_class));
		}
	}
	
	// Admin view: trash
	public function admin_trash() {
		// Remove object
		if(isset($_GET['id'])) {
			if($this->_model->delete($_GET['id'])) {
				Session::setMessage("Item was trashed");
			} else {
				Session::setMessage("Failed to trash item");
			}
		} else {
			Session::setMessage("This item does not exist");
		}
		Router::redirect('/admin/'.strtolower($this->_class));
	}
	
	// Admin view: delete
	public function admin_delete() {
		admin_trash();
	}
	
	public function getData() {
		return $this->_data;
	}
	
	public function getLanguage() {
		return $this->_language;
	}
	
	public function getModel() {
		return $this->_model;
	}
	
	public function getDefault($param) {
		return Configuration::getDefault($this->_params->method.$param);
	}
	
	public function getParams() {
		return $this->_params;
	}
	
	public function getParam($param) {
		if(isset($this->_params->$param)) {
			return $this->_params->$param;
		} else {
			return $this->getDefault($param);
		}
	}
	
	// Returns true if current user has permitted role to create an item
	public static function canCreate() {
		return in_array(Session::getRole(),self::$_authors);
	}
	
	// Returns true if current user does not have permitted role to create an item
	public static function cannotCreate() {
		return !self::canCreate($author);
	}
	
	// Returns true if current user is the author or has permitted role to edit an item
	public static function canEdit($author = 0) {
		return in_array(Session::getRole(),self::$_editors) || Session::getUser() == $author;
	}
	
	// Returns true if current user is not the author and does not have permitted role to edit an item
	public static function cannotEdit($author = 0) {
		return !self::canEdit($author);
	}
	
	// Returns true if current user is the author or has permitted role to publish an item
	public static function canPublish() {
		return in_array(Session::getRole(),self::$_publishers);
	}
	
	// Returns true if current user is not the author and does not have permitted role to publish an item
	public static function cannotPublish() {
		return !self::canPublish();
	}
	
	// Returns true if current user is the author or has permitted role to publish an item
	public static function canManage() {
		return in_array(Session::getRole(),self::$_publishers);
	}
	
	// Returns true if current user is not the author and does not have permitted role to publish an item
	public static function cannotManage() {
		return !self::canManage();
	}
	
	public function __construct($data = array()) {
		$this->_class = basename(str_replace('\\','/',get_called_class()),'Controller');
		$class = __CUBO__.'\\'.$this->_class;
		$this->_model = new $class();
		$this->_data = $data;
		$this->_params = Application::getRouter()->getParams();
	}
}
?>