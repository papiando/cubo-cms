<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");
if(!empty(Cubo\Configuration::get('brand_logo'))) { ?><img class="brand-logo" src="<?php echo Cubo\Configuration::get('brand_logo'); ?>" /><?php } if(!empty(Cubo\Configuration::get('brand_name'))) { ?><span class="brand-name"><?php echo Cubo\Configuration::get('brand_name'); ?></span><?php } ?>