<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");

$query = "SELECT `id`,`name`,`mimetype` FROM `image` WHERE `id`='{$value}' LIMIT 1";
$image = Cubo\Application::getDB()->loadItem($query);
if($image) {
	$ext = explode('/',$image['mimetype']);
	$ext = end($ext);
	$filename = $image['name'].'.'.$ext;
	$url = '/image?id='.$value.'&cache=no';
} else {
	$filename = 'No image';
	$url = '/vendor/cube/no-image.png';
}
?><label for="<?php echo $id; ?>"><?php echo $label; ?></label>
<div class="input-group">
	<input name="<?php echo $prefix.$id; ?>" id="<?php echo $id; ?>" type="hidden" value="<?php echo $value; ?>" />
	<input name="-<?php echo $id; ?>-placeholder" type="text" class="form-control" value="<?php echo $filename; ?>" readonly tabindex="-1" />
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#select-image"><i class="fa fa-search"></i></button>
</div>
<div class="modal fade" id="select-image">
	<div class="modal-dialog modal-lg" role="dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title">Select Image</h2>
				<button type="button" class="close text-danger" data-dismiss="modal" aria-label="close"><i class="fa fa-times"></i></button>
			</div>
			<div class="modal-body">
				<form class="form">
					<div class="form-row d-flex justify-content-between flex-nowrap">
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
								$filter = array('id'=>'filter-collection','label'=>'Collection','prefix'=>'','value'=>COLLECTION_ANY);
								include($this->_sharedPath.'filter-collection.php'); ?>
						</div>
						<div class="col-3">
							<?php
								$filter = array('id'=>'filter-language','label'=>'Language','prefix'=>'','value'=>LANGUAGE_ANY);
								include($this->_sharedPath.'filter-language.php'); ?>
						</div>
					</div>
				</form>
				<p id="filter-info"></p>
				<div class="d-flex justify-space-evenly flex-wrap">
<?php
$query = "SELECT `id`,`name`,`collection`,`description`,`language`,`status`,`tags`,`title` FROM `image` WHERE 1 ORDER BY `title`";
$images = Cubo\Application::getDB()->loadItems($query);
foreach($images as $image) {
	$image = (object)$image;
?>					<figure class="img-thumbnail img-selectable d-none" data-image="<?php echo htmlentities(json_encode($image)); ?>" data-target="#image" data-preview="#image-preview" data-dismiss="modal" data-filter="none">
						<img class="img-thumbnail" src="/image?thumbnail&id=<?php echo $image->id; ?>&cache=no" />
						<figcaption><?php echo $image->title; ?></figcaption>
					</figure>
<?php
}
?>				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="close">Cancel</button>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
	$('.img-selectable').click(function() {
		$($(this).data('target')).val($(this).data('image').id).attr('name',$($(this).data('target')).attr('name').replace(/^-/,''));
		$($(this).data('preview')).attr('src','/image?id='+$(this).data('image').id+'&cache=no');
		$($(this).data('dismiss')).hide();
	});
	$('#filter-text').on('change paste keyup',function() {
		var pattern = new RegExp($(this).val().normalize('NFD'),'i');
		var count = 0;
		var total = 0;
		$('.img-selectable').each(function() {
			var filter = parseInt($(this).attr('data-filter'));
			if(pattern.test($(this).data('image').title.normalize('NFD'))) {
				filter = filter & ~1;
			} else if(pattern.test($(this).data('image').description.normalize('NFD'))) {
				filter = filter & ~1;
			} else if(pattern.test($(this).data('image').tags.normalize('NFD'))) {
				filter = filter & ~1;
			} else if(pattern.test($(this).data('image').name.normalize('NFD'))) {
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
		$('.img-selectable').each(function() {
			var filter = parseInt($(this).attr('data-filter'));
			if(status == 0 || status == $(this).data('image').status) {
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
	$('#filter-collection').on('change',function() {
		var collection = parseInt($(this).val());
		var count = 0;
		var total = 0;
		$('.img-selectable').each(function() {
			var filter = parseInt($(this).attr('data-filter'));
			if(collection == 0 || collection == $(this).data('image').collection) {
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
		$('.img-selectable').each(function() {
			var filter = parseInt($(this).attr('data-filter'));
			if(language == 0 || language == $(this).data('image').language) {
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
	$('.img-selectable').each(function() {
		//$('#filter-text').trigger('change');
		$('#filter-status').trigger('change');
		//$('#filter-collection').trigger('change');
		//$('#filter-language').trigger('change');
	});
});
</script>