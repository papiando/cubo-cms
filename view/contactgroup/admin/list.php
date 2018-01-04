<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");
$controller = Cubo\Application::getRouter()->getController();
?><h1>Contact Groups</h1>
<form id="filter-form" class="form">
	<div class="form-row d-flex justify-content-between">
		<div class="col-3">
			<?php
				$filter = array('id'=>'filter-text','label'=>'Search','prefix'=>'','value'=>'');
				include($this->_sharedPath.'filter-text.php'); ?>
		</div>
		<div class="col-3">
			<?php
				$filter = array('id'=>'filter-status','label'=>'Status','prefix'=>'','value'=>STATUS_PUBLISHED);
				include($this->_sharedPath.'filter-status.php'); ?>
		</div>
		<div class="col-3">
			<?php
				$filter = array('id'=>'filter-group','label'=>'Parent Group','prefix'=>'','value'=>GROUP_ANY);
				include($this->_sharedPath.'filter-group.php'); ?>
		</div>
		<div class="col-3">
			<?php
				$filter = array('id'=>'filter-language','label'=>'Language','prefix'=>'','value'=>LANGUAGE_ANY);
				include($this->_sharedPath.'filter-language.php'); ?>
		</div>
	</div>
</form>
<p id="filter-info"></p>
<table class="table table-striped full-width table-hover">
	<thead>
		<tr>
			<td class="align-middle"><strong>Title</strong></td>
			<td class="align-middle"><strong>Status</strong></td>
			<td class="align-middle"><strong>Parent Group</strong></td>
			<td class="align-middle"><strong>Language</strong></td>
			<td class="text-right align-middle">
				<a href="/admin/<?php echo $controller; ?>?action=add"><button class="btn btn-sm btn-success"><i class="fa fa-plus fa-fw"></i></button></a>
			</td>
		</tr>
	</thead>
	<tbody>
<?php
foreach($this->_data as $item) {
?>		<tr class="table-item d-none" data-item="<?php echo htmlentities(json_encode($item)); ?>" data-filter="none">
			<td class="align-middle"><?php echo $item->title; ?></td>
			<td class="align-middle"><?php include($this->_sharedPath.'show-status.php'); ?></td>
			<td class="align-middle"><?php include($this->_sharedPath.'show-group.php'); ?></td>
			<td class="align-middle"><?php include($this->_sharedPath.'show-language.php'); ?></td>
			<td class="text-right align-middle">
				<a href="/admin/<?php echo $controller; ?>?action=edit&id=<?php echo $item->id; ?>"><button class="btn btn-sm btn-primary"><i class="fa fa-pencil fa-fw"></i></button></a>
				<a href="/admin/<?php echo $controller; ?>?action=delete&id=<?php echo $item->id; ?>"><button class="btn btn-sm btn-danger"><i class="fa fa-trash fa-fw"></i></button></a>
			</td>
		</tr>
<?php
}
?>	</tbody>
</table>
<script src="/view/shared/js/filtering.js"></script>