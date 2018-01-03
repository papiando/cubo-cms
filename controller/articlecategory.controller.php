<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class ArticleCategoryController extends Controller {
	public function index() {
		$this->_data = $this->_model->getList();
	}
	
	public function view() {
		// Generate output
		if(self::getParam('name')) {
			$this->_data = $this->_model->get(self::getParam('name'));
		else
			$this->_data = $this->_model->get(Configuration::getDefault(self::getParam('controller')));
	}
	
	public function admin_index() {
		$this->_data = $this->_model->getList();
	}
	
	public function admin_add() {
		// Save posted data
		if($_POST) {
			if($this->_model->save($_POST)) {
				Session::setMessage("Category was saved");
			} else {
				Session::setMessage("Failed to save category");
			}
			Router::redirect('/admin/articlecategory/index');
		}
	}
	
	public function admin_edit() {
		// Save posted data
		if($_POST) {
			if($this->_model->save($_POST,$_POST['id'])) {
				Session::setMessage("Category was saved");
			} else {
				Session::setMessage("Failed to save category");
			}
			Router::redirect('/admin/articlecategory/index');
		}
		if(isset($_GET['id'])) {
			$this->_data = $this->_model->get($_GET['id']);
		} else {
			Session::setMessage("This category does not exist");
			Router::redirect('/admin/articlecategory/index');
		}
	}
	
	public function admin_delete() {
		// Remove object
		if(isset($_GET['id'])) {
			if($this->_model->delete($_GET['id'])) {
				Session::setMessage("Category was deleted");
			} else {
				Session::setMessage("Failed to delete category");
			}
		} else {
			Session::setMessage("This category does not exist");
		}
		Router::redirect('/admin/articlecategory/index');
	}
	
	public function admin_view() {
	}
}
?>