<?php
/**
 * @application    Cubo CMS
 * @type           View
 * @class          ArticleAdminView
 * @description    The view that generates and prepares the output for administration of the article object
 * @version        1.2.0
 * @date           2019-02-06
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2019 Papiando Riba Internet
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class ArticleAdminView extends View {
	// Method create
	public function adminCreate() {
		$url = '';
		$html = '<h1>Create '.$this->class.'</h1><form class="form-create" action="" method="post">';
		$html .= '<div class="form-group"><button class="btn btn-success" id="submit" type="submit" disabled><i class="fa fa-check"></i> Save</button><a href="/admin/'.strtolower($this->class).'" class="btn btn-danger" id="cancel"><i class="fa fa-times"></i> Cancel</a></div>';
		$html .= '<div class="grid-columns">';
		$html .= '<div class="form-group grid-column-2"><label for="title">Title</label><input type="text" name="title" id="title" class="form-control" placeholder="Title" required autofocus /></div>';
		$html .= '<div class="form-group"><label for="name">Alias</label><input type="text" name="name" id="name" class="form-control" placeholder="Alias" required /></div>';
		$html .= '</div><ul class="nav nav-tabs" id="tabs" role="tablist">';
		$html .= '<li class="nav-item"><a class="nav-link active" id="content-tab" data-toggle="tab" href="#content-pane" role="tab" aria-controls="content-pane" aria-selected="true">Content</a></li>';
		$html .= '<li class="nav-item"><a class="nav-link" id="image-tab" data-toggle="tab" href="#image-pane" role="tab" aria-controls="image-pane" aria-selected="false">Image and Metadata</a></li>';
		$html .= '<li class="nav-item"><a class="nav-link" id="publishing-tab" data-toggle="tab" href="#publishing-pane" role="tab" aria-controls="publishing-pane" aria-selected="false">Publishing</a></li>';
		$html .= '<li class="nav-item"><a class="nav-link" id="options-tab" data-toggle="tab" href="#options-pane" role="tab" aria-controls="options-pane" aria-selected="false">View Options</a></li>';
		$html .= '</ul><div class="tab-content"><div class="tab-pane fade show active" id="content-pane" role="tabpanel" aria-labelledby="content-tab"><div class="grid-columns">';
		$html .= '<div class="form-group grid-column-2"><label for="html">'.$this->class.' Content</label><textarea name="html" id="html" class="form-control text-html" placeholder="Contents" rows="12" required></textarea></div><div>';
		$html .= Form::select(array(
			'name'=>'status',
			'title'=>'Status',
			'default'=>(ArticleController::canPublish() ? STATUS_PUBLISHED : STATUS_UNPUBLISHED),
			'class'=>' form-control-sm',
			'query'=>Form::query('publishingstatus',Session::isAccessible()),
			'readonly'=>ArticleController::cannotPublish()));
		$html .= Form::select(array(
			'name'=>'category',
			'title'=>'Category',
			'default'=>CATEGORY_UNDEFINED,
			'class'=>' form-control-sm',
			'query'=>Form::query('articlecategory',Session::isAccessible())));
		$html .= Form::select(array(
			'name'=>'language',
			'title'=>'Language',
			'default'=>LANGUAGE_UNDEFINED,
			'class'=>' form-control-sm',
			'query'=>Form::query('language',Session::isAccessible())));
		$html .= Form::select(array(
			'name'=>'access',
			'title'=>'Access',
			'default'=>ACCESS_PUBLIC,
			'class'=>' form-control-sm',
			'query'=>Form::query('accesslevel',Session::isAccessible())));
		$html .= '</div></div></div><div class="tab-pane fade" id="image-pane" role="tabpanel" aria-labelledby="image-tab"><div class="grid-columns"><div>';
		$html .= '<div class="form-group"><label for="description">Summary</label><textarea name="description" id="description" class="form-control" placeholder="Summary" rows="3"></textarea></div>';
		$html .= '<div class="form-group">'.$this->selectImage(array('id'=>'image','label'=>'Image','prefix'=>'-','value'=>null),$url).'</div></div><div>';
		$html .= '<div class="form-group"><label for="tags">Tags</label><textarea name="tags" id="tags" class="form-control" placeholder="Tags" rows="3"></textarea></div>';
		$html .= '<div class="form-group"><label>Image Preview</label><figure><img id="image-preview" class="img-fluid img-thumbnail full-width" src="'.$url.'" /></figure></div></div>';
		$html .= '</div></div></div><div class="tab-pane" id="publishing-pane" role="tabpanel" aria-labelledby="publishing-tab"><div class="grid-columns"><div>';
		$html .= Form::select(array(
			'name'=>'author',
			'title'=>'Author',
			'prefix'=>'-',
			'default'=>Session::getUser(),
			'class'=>' form-control-sm',
			'query'=>Form::query('user',Session::isAccessible()),
			'readonly'=>true));
		$html .= Form::select(array(
			'name'=>'editor',
			'title'=>'Editor',
			'prefix'=>'-',
			'value'=>USER_NOBODY,
			'class'=>' form-control-sm',
			'query'=>Form::query('user',Session::isAccessible(true)),
			'readonly'=>true));
		$html .= Form::select(array(
			'name'=>'publisher',
			'title'=>'Publisher',
			'prefix'=>'-',
			'value'=>USER_NOBODY,
			'class'=>' form-control-sm',
			'query'=>Form::query('user',Session::isAccessible(true)),
			'readonly'=>true));
		$html .= '</div><div>';
		$html .= '<div class="form-group"><label for="created">Created Date</label><input type="datetime-local" name="-created" id="created" class="form-control form-control-sm" readonly /></div>';
		$html .= '<div class="form-group"><label for="modified">Modified Date</label><input type="datetime-local" name="-modified" id="modified" class="form-control form-control-sm" readonly /></div>';
		$html .= '<div class="form-group"><label for="published">Published Date</label><input type="datetime-local" name="-published" id="published" class="form-control form-control-sm" readonly /></div>';
		$html .= '</div></div></div><div class="tab-pane" id="options-pane" role="tabpanel" aria-labelledby="options-tab"><div class="grid-columns"><div>';
		$options = array(
			array('id'=>SETTING_GLOBAL,'title'=>'Global setting'),
			array('id'=>SETTING_SHOW,'title'=>'Show'),
			array('id'=>SETTING_HIDE,'title'=>'Hide'));
		$html .= Form::select(array(
			'name'=>'show_title',
			'title'=>'Show title',
			'prefix'=>'@',
			'value'=>SETTING_GLOBAL,
			'class'=>' form-control-sm',
			'list'=>$options));
		$options_author = array(
			array('id'=>SETTING_GLOBAL,'title'=>'Global setting'),
			array('id'=>SETTING_AUTHOR,'title'=>'Show author'),
			array('id'=>SETTING_EDITOR,'title'=>'Show editor'),
			array('id'=>SETTING_PUBLISHER,'title'=>'Show publisher'),
			array('id'=>SETTING_HIDE,'title'=>'Hide'));
		$html .= Form::select(array(
			'name'=>'show_author',
			'title'=>'Show author',
			'prefix'=>'@',
			'value'=>SETTING_GLOBAL,
			'class'=>' form-control-sm',
			'list'=>$options_author));
		$html .= Form::select(array(
			'name'=>'show_category',
			'title'=>'Show category',
			'prefix'=>'@',
			'value'=>SETTING_GLOBAL,
			'class'=>' form-control-sm',
			'list'=>$options));
		$html .= Form::select(array(
			'name'=>'show_tags',
			'title'=>'Show tags',
			'prefix'=>'@',
			'value'=>SETTING_GLOBAL,
			'class'=>' form-control-sm',
			'list'=>$options));
		$options_date = array(
			array('id'=>SETTING_GLOBAL,'title'=>'Global setting'),
			array('id'=>SETTING_CREATEDDATE,'title'=>'Show created date'),
			array('id'=>SETTING_MODIFIEDDATE,'title'=>'Show modified date'),
			array('id'=>SETTING_PUBLISHEDDATE,'title'=>'Show published date'),
			array('id'=>SETTING_HIDE,'title'=>'Hide'));
		$html .= Form::select(array(
			'name'=>'show_date',
			'title'=>'Show date',
			'prefix'=>'@',
			'value'=>SETTING_GLOBAL,
			'class'=>' form-control-sm',
			'list'=>$options_date));
		$html .= '</div><div>';
		$html .= Form::select(array(
			'name'=>'show_image',
			'title'=>'Show image',
			'prefix'=>'@',
			'value'=>SETTING_GLOBAL,
			'class'=>' form-control-sm',
			'list'=>$options));
		$options_position = array(
			array('id'=>SETTING_GLOBAL,'title'=>'Global setting'),
			array('id'=>SETTING_ABOVETITLE,'title'=>'Above title'),
			array('id'=>SETTING_BELOWTITLE,'title'=>'Below title'),
			array('id'=>SETTING_FLOATLEFT,'title'=>'Float left'),
			array('id'=>SETTING_FLOATRIGHT,'title'=>'Float right'));
		$html .= Form::select(array(
			'name'=>'position_image',
			'title'=>'Image position',
			'prefix'=>'@',
			'value'=>SETTING_GLOBAL,
			'class'=>' form-control-sm',
			'list'=>$options_position));
		$html .= Form::select(array(
			'name'=>'show_info',
			'title'=>'Show info',
			'prefix'=>'@',
			'value'=>SETTING_GLOBAL,
			'class'=>' form-control-sm',
			'list'=>$options));
		$options_position = array(
			array('id'=>SETTING_GLOBAL,'title'=>'Global setting'),
			array('id'=>SETTING_ABOVECONTENT,'title'=>'Above content'),
			array('id'=>SETTING_ABOVETITLE,'title'=>'Above title'),
			array('id'=>SETTING_BELOWTITLE,'title'=>'Below title'),
			array('id'=>SETTING_BELOWCONTENT,'title'=>'Below content'));
		$html .= Form::select(array(
			'name'=>'position_info',
			'title'=>'Info position',
			'prefix'=>'@',
			'value'=>SETTING_GLOBAL,
			'class'=>' form-control-sm',
			'list'=>$options_position));
		$options_readmore = array(
			array('id'=>SETTING_GLOBAL,'title'=>'Global setting'),
			array('id'=>SETTING_PARAGRAPH,'title'=>'After first paragraph'),
			array('id'=>SETTING_TENLINES,'title'=>'After ten lines'),
			array('id'=>SETTING_HIDE,'title'=>'Hide'));
		$html .= Form::select(array(
			'name'=>'show_readmore',
			'title'=>'Show read more',
			'prefix'=>'@',
			'value'=>SETTING_GLOBAL,
			'class'=>' form-control-sm',
			'list'=>$options_readmore));
		$html .= '</div></div></div></div></form><script src="/view/shared/js/editing.js"></script>';
		return $html;
	}
	// Method edit
	public function adminEdit() {
		$url = '';
		$html = '<h1>Edit '.$this->class.'</h1><form class="form-edit" action="" method="post">';
		$html .= '<div class="form-group"><button class="btn btn-success" id="submit" type="submit" disabled><i class="fa fa-check"></i> Save</button><a href="/admin/'.strtolower($this->class).'" class="btn btn-danger" id="cancel"><i class="fa fa-times"></i> Cancel</a></div>';
		$html .= '<div class="grid-columns"><input type="hidden" name="id" value="'.$this->_data->id.'" />';
		$html .= '<div class="form-group grid-column-2"><label for="title">Title</label><input type="text" name="-title" id="title" value="'.$this->_data->title.'" class="form-control" placeholder="Title" required autofocus /></div>';
		$html .= '<div class="form-group"><label for="name">Alias</label><input type="text" name="-name" id="name" value="'.$this->_data->name.'" class="form-control" placeholder="Alias" required /></div>';
		$html .= '</div><ul class="nav nav-tabs" id="tabs" role="tablist">';
		$html .= '<li class="nav-item"><a class="nav-link active" id="content-tab" data-toggle="tab" href="#content-pane" role="tab" aria-controls="content-pane" aria-selected="true">Content</a></li>';
		$html .= '<li class="nav-item"><a class="nav-link" id="image-tab" data-toggle="tab" href="#image-pane" role="tab" aria-controls="image-pane" aria-selected="false">Image and Metadata</a></li>';
		$html .= '<li class="nav-item"><a class="nav-link" id="publishing-tab" data-toggle="tab" href="#publishing-pane" role="tab" aria-controls="publishing-pane" aria-selected="false">Publishing</a></li>';
		$html .= '<li class="nav-item"><a class="nav-link" id="options-tab" data-toggle="tab" href="#options-pane" role="tab" aria-controls="options-pane" aria-selected="false">View Options</a></li>';
		$html .= '</ul><div class="tab-content"><div class="tab-pane fade show active" id="content-pane" role="tabpanel" aria-labelledby="content-tab"><div class="grid-columns">';
		$html .= '<div class="form-group grid-column-2"><label for="html">'.$this->class.' Content</label><textarea name="-html" id="html" class="form-control text-html" placeholder="Contents" rows="12" required>'.$this->_data->html.'</textarea></div><div>';
		$html .= Form::select(array(
			'name'=>'status',
			'title'=>'Status',
			'prefix'=>'-',
			'value'=>$this->_data->status,
			'class'=>' form-control-sm',
			'query'=>Form::query('publishingstatus',Session::isAccessible()),
			'readonly'=>ArticleController::cannotPublish()));
		$html .= Form::select(array(
			'name'=>'category',
			'title'=>'Category',
			'prefix'=>'-',
			'value'=>$this->_data->category,
			'class'=>' form-control-sm',
			'query'=>Form::query('articlecategory',Session::isAccessible()),
			'readonly'=>ArticleController::cannotEdit($this->_data->author)));
		$html .= Form::select(array(
			'name'=>'language',
			'title'=>'Language',
			'prefix'=>'-',
			'value'=>$this->_data->language,
			'class'=>' form-control-sm',
			'query'=>Form::query('language',Session::isAccessible()),
			'readonly'=>ArticleController::cannotEdit($this->_data->author)));
		$html .= Form::select(array(
			'name'=>'access',
			'title'=>'Access',
			'prefix'=>'-',
			'value'=>$this->_data->access,
			'class'=>' form-control-sm',
			'query'=>Form::query('accesslevel',Session::isAccessible()),
			'readonly'=>ArticleController::cannotEdit($this->_data->author)));
		$html .= '</div></div></div><div class="tab-pane fade" id="image-pane" role="tabpanel" aria-labelledby="image-tab"><div class="grid-columns"><div>';
		$html .= '<div class="form-group"><label for="description">Summary</label><textarea name="-description" id="description" class="form-control" placeholder="Summary" rows="3">'.$this->_data->description.'</textarea></div>';
		$html .= '<div class="form-group">'.$this->selectImage(array('id'=>'image','label'=>'Image','prefix'=>'-','value'=>$this->_data->image),$url).'</div></div><div>';
		$html .= '<div class="form-group"><label for="tags">Tags</label><textarea name="-tags" id="tags" class="form-control" placeholder="Tags" rows="3">'.$this->_data->tags.'</textarea></div>';
		$html .= '<div class="form-group"><label>Image Preview</label><figure><img id="image-preview" class="img-fluid img-thumbnail full-width" src="'.$url.'" /></figure></div></div>';
		$html .= '</div></div></div><div class="tab-pane" id="publishing-pane" role="tabpanel" aria-labelledby="publishing-tab"><div class="grid-columns"><div>';
		$html .= Form::select(array(
			'name'=>'author',
			'title'=>'Author',
			'prefix'=>'-',
			'value'=>$this->_data->author,
			'class'=>' form-control-sm',
			'query'=>Form::query('user',Session::isAccessible()),
			'readonly'=>ArticleController::cannotEdit($this->_data->author)));
		$html .= Form::select(array(
			'name'=>'editor',
			'title'=>'Editor',
			'prefix'=>'-',
			'value'=>Session::getUser(),
			'class'=>' form-control-sm',
			'query'=>Form::query('user',Session::isAccessible(true)),
			'readonly'=>true));
		$html .= Form::select(array(
			'name'=>'publisher',
			'title'=>'Publisher',
			'prefix'=>'-',
			'value'=>$this->_data->publisher ?? USER_NOBODY,
			'class'=>' form-control-sm',
			'query'=>Form::query('user',Session::isAccessible(true)),
			'readonly'=>true));
		$html .= '</div><div>';
		$html .= '<div class="form-group"><label for="created">Created Date</label><input type="datetime-local" name="-created" id="created" value="'.str_replace(' ','T',$this->_data->created).'" class="form-control form-control-sm" readonly /></div>';
		$html .= '<div class="form-group"><label for="modified">Modified Date</label><input type="datetime-local" name="-modified" id="modified" value="'.str_replace(' ','T',$this->_data->modified).'" class="form-control form-control-sm" readonly /></div>';
		$html .= '<div class="form-group"><label for="published">Published Date</label><input type="datetime-local" name="-published" id="published" value="'.str_replace(' ','T',$this->_data->published).'" class="form-control form-control-sm" readonly /></div>';
		$html .= '</div></div></div><div class="tab-pane" id="options-pane" role="tabpanel" aria-labelledby="options-tab"><div class="grid-columns"><div>';
		$options = array(
			array('id'=>SETTING_GLOBAL,'title'=>'Global setting'),
			array('id'=>SETTING_SHOW,'title'=>'Show'),
			array('id'=>SETTING_HIDE,'title'=>'Hide'));
		$html .= Form::select(array(
			'name'=>'show_title',
			'title'=>'Show title',
			'prefix'=>'@',
			'value'=>$this->_attributes->show_title ?? SETTING_GLOBAL,
			'class'=>' form-control-sm',
			'list'=>$options));
		$options_author = array(
			array('id'=>SETTING_GLOBAL,'title'=>'Global setting'),
			array('id'=>SETTING_AUTHOR,'title'=>'Show author'),
			array('id'=>SETTING_EDITOR,'title'=>'Show editor'),
			array('id'=>SETTING_PUBLISHER,'title'=>'Show publisher'),
			array('id'=>SETTING_HIDE,'title'=>'Hide'));
		$html .= Form::select(array(
			'name'=>'show_author',
			'title'=>'Show author',
			'prefix'=>'@',
			'value'=>$this->_attributes->show_author ?? SETTING_GLOBAL,
			'class'=>' form-control-sm',
			'list'=>$options_author));
		$html .= Form::select(array(
			'name'=>'show_category',
			'title'=>'Show category',
			'prefix'=>'@',
			'value'=>$this->_attributes->show_category ?? SETTING_GLOBAL,
			'class'=>' form-control-sm',
			'list'=>$options));
		$html .= Form::select(array(
			'name'=>'show_tags',
			'title'=>'Show tags',
			'prefix'=>'@',
			'value'=>$this->_attributes->show_tags ?? SETTING_GLOBAL,
			'class'=>' form-control-sm',
			'list'=>$options));
		$options_date = array(
			array('id'=>SETTING_GLOBAL,'title'=>'Global setting'),
			array('id'=>SETTING_CREATEDDATE,'title'=>'Show created date'),
			array('id'=>SETTING_MODIFIEDDATE,'title'=>'Show modified date'),
			array('id'=>SETTING_PUBLISHEDDATE,'title'=>'Show published date'),
			array('id'=>SETTING_HIDE,'title'=>'Hide'));
		$html .= Form::select(array(
			'name'=>'show_date',
			'title'=>'Show date',
			'prefix'=>'@',
			'value'=>$this->_attributes->show_date ?? SETTING_GLOBAL,
			'class'=>' form-control-sm',
			'list'=>$options_date));
		$html .= '</div><div>';
		$html .= Form::select(array(
			'name'=>'show_image',
			'title'=>'Show image',
			'prefix'=>'@',
			'value'=>$this->_attributes->show_image ?? SETTING_GLOBAL,
			'class'=>' form-control-sm',
			'list'=>$options));
		$options_position = array(
			array('id'=>SETTING_GLOBAL,'title'=>'Global setting'),
			array('id'=>SETTING_ABOVETITLE,'title'=>'Above title'),
			array('id'=>SETTING_BELOWTITLE,'title'=>'Below title'),
			array('id'=>SETTING_FLOATLEFT,'title'=>'Float left'),
			array('id'=>SETTING_FLOATRIGHT,'title'=>'Float right'));
		$html .= Form::select(array(
			'name'=>'position_image',
			'title'=>'Image position',
			'prefix'=>'@',
			'value'=>$this->_attributes->position_image ?? SETTING_GLOBAL,
			'class'=>' form-control-sm',
			'list'=>$options_position));
		$html .= Form::select(array(
			'name'=>'show_info',
			'title'=>'Show info',
			'prefix'=>'@',
			'value'=>$this->_attributes->show_info ?? SETTING_GLOBAL,
			'class'=>' form-control-sm',
			'list'=>$options));
		$options_position = array(
			array('id'=>SETTING_GLOBAL,'title'=>'Global setting'),
			array('id'=>SETTING_ABOVECONTENT,'title'=>'Above content'),
			array('id'=>SETTING_ABOVETITLE,'title'=>'Above title'),
			array('id'=>SETTING_BELOWTITLE,'title'=>'Below title'),
			array('id'=>SETTING_BELOWCONTENT,'title'=>'Below content'));
		$html .= Form::select(array(
			'name'=>'position_info',
			'title'=>'Info position',
			'prefix'=>'@',
			'value'=>$this->_attributes->position_info ?? SETTING_GLOBAL,
			'class'=>' form-control-sm',
			'list'=>$options_position));
		$options_readmore = array(
			array('id'=>SETTING_GLOBAL,'title'=>'Global setting'),
			array('id'=>SETTING_PARAGRAPH,'title'=>'After first paragraph'),
			array('id'=>SETTING_TENLINES,'title'=>'After ten lines'),
			array('id'=>SETTING_HIDE,'title'=>'Hide'));
		$html .= Form::select(array(
			'name'=>'show_readmore',
			'title'=>'Show read more',
			'prefix'=>'@',
			'value'=>$this->_attributes->show_readmore ?? SETTING_GLOBAL,
			'class'=>' form-control-sm',
			'list'=>$options_readmore));
		$html .= '</div></div></div></div></form><script src="/view/shared/js/editing.js"></script>';
		return $html;
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
		$html .= '<div class="text-right align-middle"><a href="/admin/'.$this->class.'?method=create" class="btn btn-sm btn-success'.(ArticleController::canCreate() ? '' : ' disabled').'" tabindex="-1"><i class="fa fa-plus fa-fw"></i></a></div>';
		$html .= '</div>';
		foreach($this->_data as $item) {
			$html .= '<div class="table-item d-none grid-columns row-body" data-item="'.htmlentities(json_encode($item)).'" data-filter="none">';
			$html .= '<div class="align-middle">'.$item->title.'</div>';
			$html .= '<div class="align-middle">'.$this->showStatus($item).'</div>';
			$html .= '<div class="align-middle">'.$this->showCategory($item).'</div>';
			$html .= '<div class="align-middle">'.$this->showLanguage($item).'</div>';
			$html .= '<div class="align-middle">'.$this->showAccess($item).'</div>';
			$html .= '<div class="text-right align-middle">';
			$html .= '<a href="/admin/'.$this->class.'?method=edit&id='.$item->id.'" class="btn btn-sm btn-warning'.(ArticleController::canEdit($item->author) ? '' : ' disabled').'" tabindex="-1"><i class="fa fa-pencil fa-fw"></i></a>';
			$html .= '<a href="/admin/'.$this->class.'?method=trash&id='.$item->id.'" class="btn btn-sm btn-danger'.(ArticleController::canPublish() ? '' : ' disabled').'" tabindex="-1"><i class="fa fa-trash fa-fw"></i></a>';
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