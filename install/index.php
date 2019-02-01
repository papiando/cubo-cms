<?php
/**
 * @application    Cubo CMS
 * @type           Default installer document
 * @class          n/a
 * @description    The index.php script is the default document. Its only purpose is to autoload the installer.
 * @version        1.1.0
 * @date           2019-02-01
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2019 Papiando Riba Internet
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo;

define('CONFIG_LOADED',1);

// Application defaults
Configuration::setDefault('controller','installer');

Configuration::setDefault('language','en');
Configuration::setDefault('template','cubo-cms');
Configuration::setDefault('theme','cubo-cms');

// Application parameters (these are accessible using <cubo:param> tags)
Configuration::setParam('site_name','My site');

show(Configuration::getDefaults());
?>