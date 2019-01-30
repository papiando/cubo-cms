<?php
/**
 * @application    Cubo CMS
 * @type           Default document
 * @class          n/a
 * @description    The index.php script is the default document. Its only purpose is to autoload the application.
 * @version        1.1.0
 * @date           2019-01-30
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2019 Papiando Riba Internet
 * @license        MIT License; see LICENSE.md
 */

// Added to allow debugging
if(isset($_GET['debug'])) {
	error(E_ALL);
	ini_set('display_errors',1);
}

// Auto-start Cubo framework
require_once(".autoload.php");
?>