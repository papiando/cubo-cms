<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");

$controller = Cubo\Application::getRouter()->getController();
?><h1>Articles</h1>
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
				$filter = array('id'=>'filter-category','label'=>'Category','prefix'=>'','value'=>CATEGORY_ANY);
				include($this->_sharedPath.'filter-category.php'); ?>
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
			<td class="align-middle"><strong>Category</strong></td>
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
			<td class="align-middle"><?php include($this->_sharedPath.'show-category.php'); ?></td>
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
<script>
$(document).ready(function() {
	$('#filter-text').on('change paste keyup',function() {
		var pattern = new RegExp($(this).val().normalize('NFD'),'i');
		var count = 0;
		var total = 0;
		$('.table-item').each(function() {
			var filter = parseInt($(this).attr('data-filter'));
			if(pattern.test($(this).data('item').title.normalize('NFD'))) {
				filter = filter & ~1;
			} else if(pattern.test($(this).data('item').description.normalize('NFD'))) {
				filter = filter & ~1;
			} else if(pattern.test($(this).data('item').tags.normalize('NFD'))) {
				filter = filter & ~1;
			} else if(pattern.test($(this).data('item').name.normalize('NFD'))) {
				filter = filter & ~1;
			} else {
				filter = filter | 1;
			}
			$(this).attr('data-filter',filter);
			if(filter) {
				$(this).addClass('d-none');
			} else {
				$(this).removeClass('d-none');
				count++;
			}
			total++;
		});
		$('#filter-info').html('Shown '+count+' out of '+total);
	});
	$('#filter-status').on('change',function() {
		var status = parseInt($(this).val());
		var count = 0;
		var total = 0;
		$('.table-item').each(function() {
			var filter = parseInt($(this).attr('data-filter'));
			if(status == 0 || status == $(this).data('item').status) {
				filter = filter & ~2;
			} else {
				filter = filter | 2;
			}
			$(this).attr('data-filter',filter);
			if(filter) {
				$(this).addClass('d-none');
			} else {
				$(this).removeClass('d-none');
				count++;
			}
			total++;
		});
		$('#filter-info').html('Shown '+count+' out of '+total);
	});
	$('#filter-category').on('change',function() {
		var category = parseInt($(this).val());
		var count = 0;
		var total = 0;
		$('.table-item').each(function() {
			var filter = parseInt($(this).attr('data-filter'));
			if(category == 0 || category == $(this).data('item').category) {
				filter = filter & ~4;
			} else {
				filter = filter | 4;
			}
			$(this).attr('data-filter',filter);
			if(filter) {
				$(this).addClass('d-none');
			} else {
				$(this).removeClass('d-none');
				count++;
			}
			total++;
		});
		$('#filter-info').html('Shown '+count+' out of '+total);
	});
	$('#filter-language').on('change',function() {
		var language = parseInt($(this).val());
		var count = 0;
		var total = 0;
		$('.table-item').each(function() {
			var filter = parseInt($(this).attr('data-filter'));
			if(language == 0 || language == $(this).data('item').language) {
				filter = filter & ~8;
			} else {
				filter = filter | 8;
			}
			$(this).attr('data-filter',filter);
			if(filter) {
				$(this).addClass('d-none');
			} else {
				$(this).removeClass('d-none');
				count++;
			}
			total++;
		});
		$('#filter-info').html('Shown '+count+' out of '+total);
	});
	$('.table-item').each(function() {
		//$('#filter-text').trigger('change');
		$('#filter-status').trigger('change');
		//$('#filter-category').trigger('change');
		//$('#filter-language').trigger('change');
	});
});
</script>