<?php
/**
 * @application    Cubo CMS
 * @type           Framework
 * @class          Form
 * @description    The form framework facilitates the correct display of forms
 * @version        1.2.0
 * @date           2018-02-05
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2019 Papiando Riba Internet. All rights reserved.
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class Form {
	public static function query($class,$filter = "1",$order = "`title`") {
		return "SELECT `id`,`title` FROM `{$class}` WHERE {$filter} ORDER BY {$order}";
	}
	public static function select($params) {
		!is_array($params) || $params = (object)$params;
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
	// Filter for text search
	public static function textFilter($params) {
		!is_array($params) || $params = (object)$params;
		return '<div class="form-group"><label for="'.$params->id.'">'.$params->label.'</label><input id="'.$params->prefix.$params->id.'" name="-'.$params->id.'" class="form-control" type="text" placeholder="'.$params->label.'" value="'.$params->value.'" /></div>';
	}
}
?>