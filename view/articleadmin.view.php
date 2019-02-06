<?php
/**
 * @application    Cubo CMS
 * @type           View
 * @class          ArticleAdminView
 * @description    The view that generates and prepares the output for administration of the article object
 * @version        1.2.0
 * @date           2019-02-05
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2019 Papiando Riba Internet
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class ArticleAdminView extends View {
	protected $controller;
	
	// Constructor
	public function __construct() {
		$this->controller = Application::getRouter()->getController();
		parent::__construct();
	}
	
	// Method default
	public function adminDefault() {
		return $this->adminList();
	}
	// Method list
	public function adminList() {
		$html = '<h1>Articles</h1>';
		$html .= '<form id="filter-form" class="form"><div class="grid-columns">';
		$html .= Form::textFilter(array('id'=>'filter-text','label'=>'Search','prefix'=>'','value'=>''));
		$any = array(array('id'=>STATUS_ANY,'title'=>'Any status'));
		$html .= Form::select(array(
			'name'=>'filter-status',
			'title'=>'Status',
			'value'=>STATUS_PUBLISHED,
			'list'=>$any,
			'query'=>Form::query('publishingstatus',Session::isAccessible())));
		$any = array(array('id'=>CATEGORY_ANY,'title'=>'Any category'));
		$html .= Form::select(array(
			'name'=>'filter-category',
			'title'=>'Category',
			'value'=>CATEGORY_ANY,
			'list'=>$any,
			'query'=>Form::query('articlecategory',Session::isAccessible())));
		$any = array(array('id'=>LANGUAGE_ANY,'title'=>'Any language'));
		$html .= Form::select(array(
			'name'=>'filter-language',
			'title'=>'Language',
			'value'=>LANGUAGE_ANY,
			'list'=>$any,
			'query'=>Form::query('language',Session::isAccessible())));
		$any = array(
			array('id'=>ACCESS_ANY,'title'=>'Any access level'));
		$html .= Form::select(array(
			'name'=>'filter-access',
			'title'=>'Access level',
			'value'=>ACCESS_ANY,
			'list'=>$any,
			'query'=>Form::query('accesslevel',Session::isAccessible())));
		$html .= '</div></form>';
		$html .= '<p id="filter-info"></p>';
		$html .= '<div class="grid-rows"><div class="grid-columns row-header">';
		$html .= '<div class="align-middle"><strong>Title</strong></div>';
		$html .= '<div class="align-middle"><strong>Status</strong></div>';
		$html .= '<div class="align-middle"><strong>Category</strong></div>';
		$html .= '<div class="align-middle"><strong>Language</strong></div>';
		$html .= '<div class="align-middle"><strong>Access Level</strong></div>';
		$html .= '<div class="text-right align-middle"><a href="/admin/'.$this->controller.'?method=create" class="btn btn-sm btn-success'.(ArticleController::canCreate() ? '' : ' disabled').'" tabindex="-1"><i class="fa fa-plus fa-fw"></i></a></div>';
		$html .= '</div>';
		foreach($this->_data as $item) {
			$html .= '<div class="table-item d-none grid-columns row-body" data-item="'.htmlentities(json_encode($item)).'" data-filter="none">';
			$html .= '<div class="align-middle">'.$item->title.'</div>';
			$html .= '<div class="align-middle">'.$this->showStatus($item).'</div>';
			$html .= '<div class="align-middle">'.$this->showCategory($item).'</div>';
			$html .= '<div class="align-middle">'.$this->showLanguage($item).'</div>';
			$html .= '<div class="align-middle">'.$this->showAccess($item).'</div>';
			$html .= '<div class="text-right align-middle">';
			$html .= '<a href="/admin/'.$this->controller.'?method=edit&id='.$item->id.'" class="btn btn-sm btn-warning'.(ArticleController::canEdit($item->author) ? '' : ' disabled').'" tabindex="-1"><i class="fa fa-pencil fa-fw"></i></a>';
			$html .= '<a href="/admin/'.$this->controller.'?method=trash&id='.$item->id.'" class="btn btn-sm btn-danger'.(ArticleController::canPublish() ? '' : ' disabled').'" tabindex="-1"><i class="fa fa-trash fa-fw"></i></a>';
			$html .= '</div></div>';
		}
		$html .= '</div><script src="/view/shared/js/filtering.js"></script>';
		return $html;
	}
	
	// Format HTML for Admin route
	public function adminHtml() {
		// Predetermine route and method
		$method = (empty($this->_router->getRoute()) ? strtolower($this->_router->getMethod()) : strtolower($this->_router->getRoute()).ucfirst($this->_router->getMethod()));
		try {
			if(method_exists($this,$method)) {
				// Run method
				return $this->$method();
			} else {
				// Could not find method
				throw new Error(array('source'=>__CLASS__,'severity'=>3,'response'=>405,'message'=>"View '{$this->class}' does not have the '{$method}' method defined"));
			}
		} catch(Error $_error) {
			$_error->showMessage();
		}
	}
}
?>