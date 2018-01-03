<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class Controller {
	protected $_data;
	protected $_language;
	protected $_model;
	protected $_params;
	protected $_attributes;
	protected $_class;
	
	// Standard view: list
	public function list() {
		$this->_data = $this->_model->getList();
	}
	
	// Standard view: view
	public function view() {
		// Generate output
		if(self::getParam('id'))
			$this->_data = $this->_model->get(self::getParam('id'));
		elseif(self::getParam('name'))
			$this->_data = $this->_model->get(self::getParam('name'));
		else
			$this->_data = $this->_model->get(Configuration::getDefault(self::getParam('controller')));
	}
	
	// Admin view: list
	public function admin_list($columns = "*",$filter = "1",$order = "`title`") {
		$this->_data = $this->_model->getList($columns,$filter,$order);
	}
	
	// Admin view: add
	public function admin_add() {
		// Save posted data
		if($_POST) {
			if(isset($_FILES)) {
				foreach($_FILES as $file=>$data) {
					$_POST['$'.$file] = $data;
				}
			}
			if($this->_model->save($_POST)) {
				Session::setMessage("Item was saved");
			} else {
				Session::setMessage("Failed to save item");
			}
			Router::redirect('/admin/'.strtolower($this->_class));
		}
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
				Session::setMessage("Item was saved");
			} else {
				Session::setMessage("Failed to save item");
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
	
	// Admin view: delete
	public function admin_delete() {
		// Remove object
		if(isset($_GET['id'])) {
			if($this->_model->delete($_GET['id'])) {
				Session::setMessage("Item was deleted");
			} else {
				Session::setMessage("Failed to delete item");
			}
		} else {
			Session::setMessage("This item does not exist");
		}
		Router::redirect('/admin/'.strtolower($this->_class));
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
	
	public function __construct($data = array()) {
		$this->_class = basename(str_replace('\\','/',get_called_class()),'Controller');
		$class = __CUBO__.'\\'.$this->_class;
		$this->_model = new $class();
		$this->_data = $data;
		$this->_params = Application::getRouter()->getParams();
	}
}
?>