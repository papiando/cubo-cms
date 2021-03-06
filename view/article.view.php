<?php
/**
 * @application    Cubo CMS
 * @type           View
 * @class          ArticleView
 * @description    The view that generates and prepares the output in different formats for the article object
 * @version        1.2.0
 * @date           2019-02-09
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2019 Papiando Riba Internet
 * @license        MIT License; see LICENSE.md
 */
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class ArticleView extends View {
	// Method view
	public function view() {
		$html = '<article itemScope itemType="https://schema.org/Article">';
		if($this->getAttribute('position_info') == SETTING_ABOVECONTENT) $html .= $this->showInfo();
		if($this->getAttribute('position_image') == SETTING_ABOVETITLE) $html .= $this->showImage();
		if($this->getAttribute('position_info') == SETTING_ABOVETITLE) $html .= $this->showInfo();
		if($this->getAttribute('show_title') == SETTING_SHOW) $html .= $this->showTitle();
		if($this->getAttribute('position_image') == SETTING_BELOWTITLE) $html .= $this->showImage();
		if($this->getAttribute('position_info') == SETTING_BELOWTITLE) $html .= $this->showInfo();
		$html .= '<div itemProp="articleBody">'.$this->showBody().'</div>';
		if($this->getAttribute('position_info') == SETTING_BELOWCONTENT) $html .= $this->showInfo();
		$html .= '</article>';
		return $html;
	}
}
?>