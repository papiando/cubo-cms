<?php
/**
 * @application    Cubo CMS
 * @type           Framework
 * @class          Form
 * @version        1.0.0
 * @date           2018-01-09
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2018 Papiando Riba Internet. All rights reserved.
 * @license        GNU General Public License version 3 or later; see LICENSE.md
 */
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class Form {
	public static function query($class,$filter = "1",$order = "`title`") {
		return "SELECT `id`,`title` FROM `{$class}` WHERE {$filter} ORDER BY {$order}";
	}
	
	public static function select($params) {
		if(is_array($params)) $params = (object)$params;
		$html = '<div class="form-group">';
		$html .= '<label for="'.$params->name.'">'.$params->title.'</label>';
		$html .= '<select id="'.$params->name.'" name="'.($params->prefix ?? '').$params->name.'" class="form-control'.($params->class ?? '').'"'.(isset($params->readonly) && $params->readonly ? ' readonly tabindex="-1"' : '').'>';
		$items = [];
		if(isset($params->query))
			$items = Application::getDB()->loadItems($params->query);
		if(isset($params->list))
			$items = array_merge($params->list,$items);
		foreach($items as $item) {
			$item = (object)$item;
			$html .= '<option value="'.$item->id.'"'.($item->id == ($params->value ?? $params->default) ? ' selected' : '').'>'.$item->title.'</option>';
		}
		$html .= '</select>';
		$html .= '</div>';
		return $html;
	}
}
?>