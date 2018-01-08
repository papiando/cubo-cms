<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class Form {
	public static function select($params) {
		$params = (object)$params;
		$html = '<div class="form-group">';
		$html .= '<label for="'.$params->name.'">'.$params->title.'</label>';
		$html .= '<select id="'.$params->name.'" name="'.($params->prefix ?? '').$params->name.'" class="form-control'.($params->class ?? '').'">';
		$items = Application::getDB()->loadItems($params->query);
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