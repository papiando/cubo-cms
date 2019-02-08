<?php
/**
 * @application    Cubo CMS
 * @type           Framework
 * @class          View
 * @description    The View framework generates the output based on a given format and prepares it
 *                 for rendering
 * @version        1.2.0
 * @date           2019-02-07
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2019 Papiando Riba Internet
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

if(!function_exists('xml_encode')) {
	function toXml($object,$xml = null,$class = null) {
		$returnType = $xml;
		if(!is_object($xml)) {
			$type = (is_object($object) ? basename(str_replace('\\','/',get_class($object))) : $xml.'-list');
			$xml = new \SimpleXMLElement("<{$type}/>");
		}
		foreach((array)$object as $key=>$value) {
			if(is_array($value) || is_object($value)) {
				$type = (is_object($value) ? basename(str_replace('\\','/',get_class($value))) : $key);
				toXml($value,$xml->addChild($type),$key);
			} else {
				$xml->addChild($key,$value);
			}
		}
		return $xml;
	}
	function xml_encode($object,$class) {
		$simpleXml = toXml($object,$class);
		$dom = new \DOMDocument('1.0','utf-8');
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadXML($simpleXml->asXML());
		return $dom->saveXML();
	}
}

class View {
	protected $_attributes;
	protected $_data;
	protected $_router;
	protected $path;
	public $sharedPath;		// ************** Can be removed later
	protected $class;
	
	// Constructor declaring router and passing application data
	public function __construct() {
		$this->_router = Application::getRouter();
		$this->class = $this->_router->getController();
		$this->_data = Application::getData();
	}
	
	// Get attribute
	public function getAttribute($attribute) {
		return (isset($this->_attributes->$attribute) ? $this->_attributes->$attribute : null);
	}
	
	// Retrieve custom path
	public function getCustomPath() {
		return $this->path = __ROOT__.DS.trim(Application::get('custom_path','custom'),DS).DS.'view'.DS.$this->class.DS.(empty($this->_router->getRoute()) ? '' : $this->_router->getRoute().DS).$this->_router->getMethod().'.php';
	}
	
	// Retrieve default path *********** This function can be removed later
	public function getDefaultPath() {
		if(!$this->_router) {
			return false;
		}
		return $this->path = __ROOT__.DS.'view'.DS.$this->class.DS.(empty($this->_router->getRoute()) ? '' : $this->_router->getRoute().DS).$this->_router->getMethod().'.php';
	}
	
	// Retrieve shared path *********** This function can be removed later
	public function getSharedPath() {
		if(!$this->_router) {
			return false;
		}
		return $this->sharedPath = __ROOT__.DS.'view'.DS.'shared'.DS.(empty($this->_router->getRoute()) ? '' : $this->_router->getRoute().DS);
	}
	
	//
	// Standard section
	//   Generic aliases and standard functions
	//
	
	// Method all: redirect to list
	public function all() {
		return $this->list();
	}
	// Method default: redirect to view
	public function default() {
		return $this->view();
	}
	// Standard method list (can be overridden)
	public function list() {
		$html = '<h1 itemProp="name headline">'.htmlspecialchars(Text::plural($this->class),ENT_QUOTES|ENT_HTML5).'</h1><ul>';
		if($this->_data) {
			foreach($this->_data as $object) {
				$html .= '<li><a href="/'.$this->class.'/'.urlencode($object->name).'">'.htmlspecialchars($object->title,ENT_QUOTES|ENT_HTML5).'</a></li>';
			}
		}
		$html .= '</ul>';
		return $html;
	}
	// Standard method view (can be overridden)
	public function view() {
		$html = '<article itemProp="hasPart" itemScope itemType="https://schema.org/Article">';
		if($this->getAttribute('show_title') == SETTING_SHOW) $html .= $this->showTitle();
		$html .= '<div itemProp="articleBody">'.$this->showBody().'</div>';
		$html .= '</article>';
		return $html;
	}
	
	//
	// Generic functions section
	//   Generic functions that render parts of the output
	//
	
	// Shared function to show body in uniform way
	public function showBody() {
		return $this->_data->html;
	}
	// Shared function to show image in uniform way
	public function showImage() {
		$html = '';
		$image = Application::getDB()->loadItem("SELECT `name`,`title` FROM `image` WHERE `id`='{$this->_data->image}' LIMIT 1");
		if($image && $this->getAttribute('show_image')) {
			$html = '<figure class="img-container" itemProp="image" itemscope itemtype="https://schema.org/ImageObject"><img class="img-fluid" src="'.__BASE__.'/image/'.urlencode($image['name']).'" alt="'.htmlspecialchars($image['title'],ENT_QUOTES|ENT_HTML5).'" /><meta itemProp="url" content="'.__BASE__.'/image/'.urlencode($image['name']).'" /></figure>';
		}
		return $html;
	}
	// Shared function to show object info in uniform way
	public function showInfo() {
		$html = '<div class="info text-muted">';
		$html .= $this->showUser('author');
		$html .= $this->showUser('editor');
		$html .= $this->showUser('publisher');
		$html .= '</div>';
		return $html;
	}
	// Shared function to show title in uniform way
	public function showTitle() {
		return '<h1 itemProp="name headline">'.htmlspecialchars($this->_data->title,ENT_QUOTES|ENT_HTML5).'</h1>';
	}
	// Shared function to show user in uniform way
	public function showUser($person) {
		$user = Application::getDB()->loadItem("SELECT `name`,`contact`,`title` FROM `user` WHERE `id`='{$this->_data->$person}' LIMIT 1");
		if($user && $this->getAttribute('show_'.$person)) {
			$html = '<span class="text-nowrap" itemProp="'.$person.'" itemScope itemType="https://schema.org/Person"><i class="fa fa-user"></i> ';
			if(!empty($user['contact'])) {
				$contact = Application::getDB()->loadItem("SELECT `name` FROM `contact` WHERE `id`='{$user['contact']}' LIMIT 1");
				$html .= '<a class="info-link" itemProp="name" href="/contact/'.urlencode($contact['name']).'">'.htmlspecialchars($user['title'],ENT_QUOTES|ENT_HTML5).'</a>';
			} else {
				$html .= '<span itemProp="name">'.htmlspecialchars($user['title'],ENT_QUOTES|ENT_HTML5).'</span>';
			}
			$html .= '</span>';
		} elseif($user) {
			$html = '<meta itemProp="'.$person.'" content="'.htmlspecialchars($user['title'],ENT_QUOTES|ENT_HTML5).'" />';
		}
		return $html;
	}
	
	//
	// Format section
	//   All functions that generate the output in different formats
	//
	
	// Format HTML
	public function html() {
		// Convert attributes JSON to object
		if(isset($this->_data->{'@attributes'})) $this->_attributes = json_decode($this->_data->{'@attributes'});
		// Predetermine route and method
		$method = (empty($this->_router->getRoute()) ? strtolower($this->_router->getMethod()) : strtolower($this->_router->getRoute()).ucfirst($this->_router->getMethod()));
		try {
			// Look for custom code ************ getDefaultPath can disappear in the future
			if(file_exists($this->getCustomPath()) || file_exists($this->getDefaultPath())) {
				// Start buffering output
				ob_start();
				// Write output to buffer
				include($this->path);
				// Return buffered output
				return ob_get_clean();
			} elseif(method_exists($this,$method)) {
				// No custom code; run method
				return $this->$method();
			} else {
				// Could not find method
				throw new Error(array('source'=>__CLASS__,'severity'=>3,'response'=>405,'message'=>"View '{$this->class}' does not have the '{$method}' method defined"));
			}
		} catch(Error $_error) {
			$_error->showMessage();
		}
	}
	
	//
	// Admin functions section
	//   Administration functions that render parts of the output
	//
	
	// Select image
	public function selectImage($params,&$url) {
		!is_array($params) || $params = (object)$params;
		$query = "SELECT `id`,`name`,`mimetype` FROM `image` WHERE `id`='{$params->value}' LIMIT 1";
		$image = Application::getDB()->loadItem($query);
		if($image) {
			$ext = explode('/',$image['mimetype']);
			$ext = end($ext);
			$filename = $image['name'].'.'.$ext;
			$url = '/image?id='.$params->value.'&cache=no';
		} else {
			$filename = 'No image';
			$url = '/vendor/cubo-cms/no-image.png';
		}
		$html = '<label for="'.$params->id.'"><?php echo $label; ?></label><div class="input-group"><input name="'.$params->prefix.$params->id.'" id="'.$params->id.'" type="hidden" value="'.$params->value.'" /><input name="-'.$params->id.'-placeholder" type="text" class="form-control" value="'.$filename.'" readonly tabindex="-1" /><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#select-image"><i class="fa fa-search"></i></button></div>';
		$html .= '<div class="modal fade" id="select-image"><div class="modal-dialog modal-lg" role="dialog"><div class="modal-content"><div class="modal-header"><h2 class="modal-title">Select Image</h2><button type="button" class="close text-danger" data-dismiss="modal" aria-label="close"><i class="fa fa-times"></i></button></div><div class="modal-body"><form class="form"><div class="grid-columns">';
		$html .= Form::textFilter(array('id'=>'filter-text','label'=>'Search','prefix'=>'','value'=>''));
		$html .= Form::select(array(
			'name'=>'filter-status',
			'title'=>'Status',
			'value'=>STATUS_PUBLISHED,
			'class'=>' form-control-sm',
			'query'=>Form::query('publishingstatus',Session::isAccessible())));
		$html .= Form::select(array(
			'name'=>'filter-collection',
			'title'=>'Collection',
			'value'=>COLLECTION_ANY,
			'class'=>' form-control-sm',
			'query'=>Form::query('imagecollection',Session::isAccessible())));
		$html .= Form::select(array(
			'name'=>'filter-language',
			'title'=>'Language',
			'default'=>LANGUAGE_ANY,
			'class'=>' form-control-sm',
			'query'=>Form::query('language',Session::isAccessible())));
		$html .= '</div></form><p id="filter-info"></p><div class="grid-wrap-8">';
		$query = "SELECT `id`,`name`,`collection`,`description`,`language`,`status`,`tags`,`title` FROM `image` WHERE 1 ORDER BY `title`";
		$images = Application::getDB()->loadItems($query);
		foreach($images as $image) {
			$image = (object)$image;
			$html .= '<figure class="img-thumbnail img-selectable table-item d-none" data-item="'.htmlentities(json_encode($image)).'" data-target="#image" data-preview="#image-preview" data-dismiss="modal" data-filter="none"><img class="img-thumbnail" src="/image?thumbnail&id='.$image->id.'&cache=no" /><figcaption>'.$image->title.'</figcaption></figure>';
		}
		$html .= '</div></div><div class="modal-footer"><button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="close">Cancel</button></div></div></div></div><script src="/view/shared/js/filtering.js"></script>';
		return $html;
	}
	// Show access level
	public function showAccess($item) {
		$records = array(
			ACCESS_NONE=>'Protected',
			ACCESS_PUBLIC=>'Public',
			ACCESS_REGISTERED=>'Registered',
			ACCESS_GUEST=>'Guest',
			ACCESS_PRIVATE=>'Private'
		);
		return $records[$item->access];
	}
	// Show category
	public function showCategory($item) {
		$query = "SELECT `id`,`title` FROM `articlecategory` WHERE `id`='{$item->category}' LIMIT 1";
		$record = Application::getDB()->loadItem($query);
		return $record['title'];
	}
	// Show language
	public function showLanguage($item) {
		$query = "SELECT `id`,`title` FROM `language` WHERE `id`='{$item->language}' LIMIT 1";
		$record = Application::getDB()->loadItem($query);
		return $record['title'];
	}
	// Show status
	public function showStatus($item) {
		$records = array(
			STATUS_PUBLISHED=>'Published',
			STATUS_UNPUBLISHED=>'Unpublished',
			STATUS_TRASHED=>'Trashed'
		);
		return $records[$item->status];
	}
	
	// Format HTML for API route
	public function apiHtml() {
		return "<pre>".json_encode($this->_data,JSON_PRETTY_PRINT)."</pre>";
	}
	
	// Format JSON for API route
	public function apiJson() {
		header("Content-Type: application/json");
		return json_encode($this->_data);
	}
	
	// Format XML for API route
	public function apiXml() {
		header("Content-Type: application/xml");
		return xml_encode($this->_data,$this->class);
	}
}
?>