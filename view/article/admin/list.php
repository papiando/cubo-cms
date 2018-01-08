<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting this code without an include");

$controller = Application::getRouter()->getController();
?><h1>Articles</h1>
<form id="filter-form" class="form">
	<div class="grid-columns">
		<?php
			$filter = array('id'=>'filter-text','label'=>'Search','prefix'=>'','value'=>'');
			include($this->_sharedPath.'filter-text.php'); ?>
		<?php
			$filter = array('id'=>'filter-status','label'=>'Status','prefix'=>'','value'=>STATUS_PUBLISHED);
			include($this->_sharedPath.'filter-status.php'); ?>
		<?php
			$filter = array('id'=>'filter-category','label'=>'Category','prefix'=>'','value'=>CATEGORY_ANY);
			include($this->_sharedPath.'filter-category.php'); ?>
		<?php
			$filter = array('id'=>'filter-language','label'=>'Language','prefix'=>'','value'=>LANGUAGE_ANY);
			include($this->_sharedPath.'filter-language.php'); ?>
	</div>
</form>
<p id="filter-info"></p>
<div class="grid-rows">
	<div class="grid-columns row-header">
		<div class="align-middle"><strong>Title</strong></div>
		<div class="align-middle"><strong>Status</strong></div>
		<div class="align-middle"><strong>Category</strong></div>
		<div class="align-middle"><strong>Language</strong></div>
		<div class="text-right align-middle">
			<a href="/admin/<?php echo $controller; ?>?action=create" class="btn btn-sm btn-success<?php echo (ArticleController::canCreate($this->_data->author) ? '' : ' disabled'); ?>" tabindex="-1"><i class="fa fa-plus fa-fw"></i></a>
		</div>
	</div>
<?php
foreach($this->_data as $item) {
?>	<div class="table-item d-none grid-columns row-body" data-item="<?php echo htmlentities(json_encode($item)); ?>" data-filter="none">
		<div class="align-middle"><?php echo $item->title; ?></div>
		<div class="align-middle"><?php include($this->_sharedPath.'show-status.php'); ?></div>
		<div class="align-middle"><?php include($this->_sharedPath.'show-category.php'); ?></div>
		<div class="align-middle"><?php include($this->_sharedPath.'show-language.php'); ?></div>
		<div class="text-right align-middle">
			<a href="/admin/<?php echo $controller; ?>?action=edit&id=<?php echo $item->id; ?>" class="btn btn-sm btn-primary<?php echo (ArticleController::canEdit($this->_data->author) ? '' : ' disabled'); ?>" tabindex="-1"><i class="fa fa-pencil fa-fw"></i></a>
			<a href="/admin/<?php echo $controller; ?>?action=trash&id=<?php echo $item->id; ?>" class="btn btn-sm btn-danger<?php echo (ArticleController::canPublish($this->_data->author) ? '' : ' disabled'); ?>" tabindex="-1"><i class="fa fa-trash fa-fw"></i></a>
		</div>
	</div>
<?php
}
?></div>
<script src="/view/shared/js/filtering.js"></script>