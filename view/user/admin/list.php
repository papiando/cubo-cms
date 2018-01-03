<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");

$controller = Cubo\Application::getRouter()->getController();
?><h1>Contact Groups</h1>
<form id="filter-form" class="form">
	<div class="form-row d-flex justify-content-between">
		<div class="col-12">
			<?php
				$filter = array('id'=>'filter-text','label'=>'Search','prefix'=>'','value'=>'');
				include($this->_sharedPath.'filter-text.php'); ?>
		</div>
	</div>
</form>
<p id="filter-info"></p>
<table class="table table-striped full-width table-hover">
	<thead>
		<tr>
			<td class="align-middle"><strong>Title</strong></td>
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
	$('#filter-role').on('change',function() {
		var role = parseInt($(this).val());
		var count = 0;
		var total = 0;
		$('.table-item').each(function() {
			var filter = parseInt($(this).attr('data-filter'));
			if(role == 0 || role == $(this).data('item').role) {
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
		$('#filter-text').trigger('change');
		//$('#filter-status').trigger('change');
		//$('#filter-role').trigger('change');
		//$('#filter-language').trigger('change');
	});
});
</script>