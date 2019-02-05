<?php
/**
 * @application    Cubo CMS
 * @type           Framework
 * @class          Error
 * @description    Custom exception error handler to display fancy looking error page
 * @version        1.2.0
 * @date           2019-02-04
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2019 Papiando Riba Internet
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class Error extends \Exception {
	protected $_error;
	
	public function __construct($error) {
		if(is_array($error)) {
			$this->_error = (object)$error;
		} else {
			$this->_error = (object)array('source'=>'Unknown','severity'=>3,'message'=>$error,'description'=>"<p>Please contact your site administrator.</p>");
		}
		parent::__construct($this->_error->message ?? 'Unknown error',$this->_error->code ?? 0);
	}
	
	// custom string representation of object
	public function __toString() {
		return $this->_error->message;
	}
	
	public function showMessage() {
		empty($this->_error->response) || http_response_code($this->_error->response);
		include('error.php');
		die();
	}
}