<?php
/**
 * @application    Cubo CMS
 * @type           View
 * @controller     Article
 * @method         List
 * @version        1.0.0
 * @date           2018-01-09
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2018 Papiando Riba Internet. All rights reserved.
 * @license        GNU General Public License version 3 or later; see LICENSE.md
 */
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting this code without an include");

$controller = Application::getRouter()->getController();
?><h1>Articles</h1>
<form id="filter-form" class="form">
	<div class="grid-columns">
		<?php
			$filter = array('id'=>'filter-text','label'=>'Search','prefix'=>'','value'=>'');
			include($this->_sharedPath.'filter-text.php'); ?>
		<?php $any = array(
			array('id'=>STATUS_ANY,'title'=>'Any status')); ?>
		<?php echo Form::select(array(
			'name'=>'filter-status',
			'title'=>'Status',
			'value'=>STATUS_PUBLISHED,
			'list'=>$any,
			'query'=>Form::query('publishingstatus',Session::isAccessible()))); ?>
		<?php $any = array(
			array('id'=>CATEGORY_ANY,'title'=>'Any category')); ?>
		<?php echo Form::select(array(
			'name'=>'filter-category',
			'title'=>'Category',
			'value'=>CATEGORY_ANY,
			'list'=>$any,
			'query'=>Form::query('articlecategory',Session::isAccessible()))); ?>
		<?php $any = array(
			array('id'=>LANGUAGE_ANY,'title'=>'Any language')); ?>
		<?php echo Form::select(array(
			'name'=>'filter-language',
			'title'=>'Language',
			'value'=>LANGUAGE_ANY,
			'list'=>$any,
			'query'=>Form::query('language',Session::isAccessible()))); ?>
		<?php $any = array(
			array('id'=>ACCESS_ANY,'title'=>'Any access level')); ?>
		<?php echo Form::select(array(
			'name'=>'filter-access',
			'title'=>'Access level',
			'value'=>ACCESS_ANY,
			'list'=>$any,
			'query'=>Form::query('accesslevel',Session::isAccessible()))); ?>
	</div>
</form>
<p id="filter-info"></p>
<div class="grid-rows">
	<div class="grid-columns row-header">
		<div class="align-middle"><strong>Title</strong></div>
		<div class="align-middle"><strong>Status</strong></div>
		<div class="align-middle"><strong>Category</strong></div>
		<div class="align-middle"><strong>Language</strong></div>
		<div class="align-middle"><strong>Access Level</strong></div>
		<div class="text-right align-middle">
			<a href="/admin/<?php echo $controller; ?>?action=create" class="btn btn-sm btn-success<?php echo (ArticleController::canCreate() ? '' : ' disabled'); ?>" tabindex="-1"><i class="fa fa-plus fa-fw"></i></a>
		</div>
	</div>
<?php
foreach($this->_data as $item) {
?>	<div class="table-item d-none grid-columns row-body" data-item="<?php echo htmlentities(json_encode($item)); ?>" data-filter="none">
		<div class="align-middle"><?php echo $item->title; ?></div>
		<div class="align-middle"><?php include($this->_sharedPath.'show-status.php'); ?></div>
		<div class="align-middle"><?php include($this->_sharedPath.'show-category.php'); ?></div>
		<div class="align-middle"><?php include($this->_sharedPath.'show-language.php'); ?></div>
		<div class="align-middle"><?php include($this->_sharedPath.'show-access.php'); ?></div>
		<div class="text-right align-middle">
			<a href="/admin/<?php echo $controller; ?>?action=edit&id=<?php echo $item->id; ?>" class="btn btn-sm btn-warning<?php echo (ArticleController::canEdit($item->author) ? '' : ' disabled'); ?>" tabindex="-1"><i class="fa fa-pencil fa-fw"></i></a>
			<a href="/admin/<?php echo $controller; ?>?action=trash&id=<?php echo $item->id; ?>" class="btn btn-sm btn-danger<?php echo (ArticleController::canPublish() ? '' : ' disabled'); ?>" tabindex="-1"><i class="fa fa-trash fa-fw"></i></a>
		</div>
	</div>
<?php
}
?></div>
<script src="/view/shared/js/filtering.js"></script>