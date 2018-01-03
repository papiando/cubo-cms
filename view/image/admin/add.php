<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");
?><h1>Add Image</h1>
<form class="form-add" action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<button class="btn btn-primary" id="submit" type="submit" disabled>Save</button>
		<a href="/admin/<?php echo strtolower($this->_class); ?>" class="btn btn-warning" id="cancel">Cancel</a>
	</div>
	<div class="form-row">
		<div class="col-8">
			<div class="form-group">
				<label for="title">Title</label>
				<input type="text" name="title" id="title" class="form-control" placeholder="Title" required autofocus />
			</div>
		</div>
		<div class="col-4">
			<div class="form-group">
				<label for="name">Alias</label>
				<input type="text" name="name" id="name" class="form-control" placeholder="Auto-generated from title" required />
			</div>
		</div>
	</div>
	<ul class="nav nav-tabs" id="tabs" role="tablist">
		<li class="nav-item">
			<a class="nav-link active" id="content-tab" data-toggle="tab" href="#content-pane" role="tab" aria-controls="content-pane" aria-selected="true">Content</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="publishing-tab" data-toggle="tab" href="#publishing-pane" role="tab" aria-controls="publishing-pane" aria-selected="false">Publishing</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="options-tab" data-toggle="tab" href="#options-pane" role="tab" aria-controls="options-pane" aria-selected="false">Options</a>
		</li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane fade show active" id="content-pane" role="tabpanel" aria-labelledby="content-tab">
			<div class="form-row">
				<div class="col-4">
					<div class="form-group">
						<label for="file">Upload image</label>
						<label class="custom-file">
							<input type="file" name="lob" id="file" class="custom-file-input" accept="image/*" required />
							<span class="custom-file-control"></span>
						</label>
					</div>
				</div>
				<div class="col-4">
					<div class="form-group">
						<label for="thumbnail">Image</label>
						<div class="img-placeholder"></div>
					</div>
				</div>
				<div class="col-4">
					<div class="form-group">
						<label for="status">Status</label>
						<select name="status" id="status" class="form-control form-control-sm">
							<?php include($this->_sharedPath.'select-status.php'); ?>
						</select>
					</div>
					<div class="form-group">
						<label for="collection">Collection</label>
						<select name="collection" id="collection" class="form-control form-control-sm">
							<?php include($this->_sharedPath.'select-collection.php'); ?>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane" id="publishing-pane" role="tabpanel" aria-labelledby="publishing-tab">
			<div class="form-row">
				<div class="col-6">
					<div class="form-group">
						<label for="description">Summary</label>
						<textarea name="description" id="descripton" class="form-control" placeholder="Summary" rows="3"></textarea>
					</div>
					<div class="form-group">
						<label for="author">Author</label>
						<select name="author" id="author" class="form-control form-control-sm">
							<?php $user = 'author'; ?>
							<?php include($this->_sharedPath.'select-user.php'); ?>
						</select>
					</div>
					<div class="form-group">
						<label for="publisher">Publisher</label>
						<select name="-publisher" id="publisher" class="form-control form-control-sm" readonly>
							<?php $user = 'publisher'; ?>
							<?php include($this->_sharedPath.'select-user.php'); ?>
						</select>
					</div>
					<div class="form-group">
						<label for="creator">Creator</label>
						<select name="-creator" id="creator" class="form-control form-control-sm" readonly>
							<?php $user = 'creator'; ?>
							<?php include($this->_sharedPath.'select-user.php'); ?>
						</select>
					</div>
					<div class="form-group">
						<label for="editor">Editor</label>
						<select name="-editor" id="editor" class="form-control form-control-sm" readonly>
							<?php $user = 'editor'; ?>
							<?php include($this->_sharedPath.'select-user.php'); ?>
						</select>
					</div>
				</div>
				<div class="col-6">
					<div class="form-group">
						<label for="tags">Tags</label>
						<textarea name="tags" id="tags" class="form-control" placeholder="Tags" rows="3"></textarea>
					</div>
					<div class="form-group">
						<label for="access">Access</label>
						<select name="access" id="access" class="form-control form-control-sm">
							<?php include($this->_sharedPath.'select-access.php'); ?>
						</select>
					</div>
					<div class="form-group">
						<label for="published">Published Date</label>
						<input type="datetime-local" name="-published" id="published" class="form-control form-control-sm" readonly />
					</div>
					<div class="form-group">
						<label for="created">Created Date</label>
						<input type="datetime-local" name="-created" id="created" class="form-control form-control-sm" readonly />
					</div>
					<div class="form-group">
						<label for="modified">Modified Date</label>
						<input type="datetime-local" name="-modified" id="modified" class="form-control form-control-sm" readonly />
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane" id="options-pane" role="tabpanel" aria-labelledby="options-tab">
			<div class="form-row">
				<div class="col-6">
					<div class="form-group">
						<label for="show_title">Show title</label>
						<select name=":show_title" id="show_title" class="form-control form-control-sm">
							<?php $setting = 'show_title'; ?>
							<?php include($this->_sharedPath.'select-showhide.php'); ?>
						</select>
					</div>
					<div class="form-group">
						<label for="show_author">Show author</label>
						<select name=":show_author" id="show_author" class="form-control form-control-sm">
							<?php include($this->_sharedPath.'select-showuser.php'); ?>
						</select>
					</div>
					<div class="form-group">
						<label for="show_category">Show category</label>
						<select name=":show_category" id="show_category" class="form-control form-control-sm">
							<?php $setting = 'show_category'; ?>
							<?php include($this->_sharedPath.'select-showhide.php'); ?>
						</select>
					</div>
					<div class="form-group">
						<label for="show_tags">Show tags</label>
						<select name=":show_tags" id="show_tags" class="form-control form-control-sm">
							<?php $setting = 'show_tags'; ?>
							<?php include($this->_sharedPath.'select-showhide.php'); ?>
						</select>
					</div>
					<div class="form-group">
						<label for="show_date">Show date</label>
						<select name=":show_date" id="show_date" class="form-control form-control-sm">
							<?php include($this->_sharedPath.'select-showdate.php'); ?>
						</select>
					</div>
				</div>
				<div class="col-6">
					<div class="form-group">
						<label for="show_image">Show image</label>
						<select name=":show_image" id="show_image" class="form-control form-control-sm">
							<?php $setting = 'show_image'; ?>
							<?php include($this->_sharedPath.'select-showhide.php'); ?>
						</select>
					</div>
					<div class="form-group">
						<label for="position_image">Image position</label>
						<select name=":position_image" id="position_image" class="form-control form-control-sm">
							<?php include($this->_sharedPath.'select-positionimage.php'); ?>
						</select>
					</div>
					<div class="form-group">
						<label for="show_info">Show article info</label>
						<select name=":show_info" id="show_info" class="form-control form-control-sm">
							<?php $setting = 'show_info'; ?>
							<?php include($this->_sharedPath.'select-showhide.php'); ?>
						</select>
					</div>
					<div class="form-group">
						<label for="position_info">Info position</label>
						<select name=":position_info" id="position_info" class="form-control form-control-sm">
							<?php include($this->_sharedPath.'select-positioninfo.php'); ?>
						</select>
					</div>
					<div class="form-group">
						<label for="show_readmore">Show read more</label>
						<select name=":show_readmore" id="show_readmore" class="form-control form-control-sm">
							<?php include($this->_sharedPath.'select-showreadmore.php'); ?>
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<script>
function toSeoUrl(url) {
	return url.normalize('NFD')
		.replace(/[\u0300-\u036f]/g,'')
		.replace(/\s+/g,'-')
		.toLowerCase()
		.replace(/&/g,'-and-')
		.replace(/[^a-z0-9\-]/g,'')
		.replace(/-+/g,'-')
		.replace(/^-*/,'')
		.replace(/-*$/,'');
}
$(document).ready(function() {
	$('select[readonly] option:not(:selected)').attr('disabled',true);
	$('#title').on('change',function() {
		if($('#name').val()=='') {
			$('#name').val(toSeoUrl($(this).val()));
		}
	});
	$('#name').on('change',function() {
		$(this).val(toSeoUrl($(this).val()));
	});
	$(':input:not(.changed)').on('change paste keyup',function() {
		$('#submit').removeAttr('disabled');
		$(this).addClass('changed');
		var name = $(this).attr('name');
		if(name.substr(0,1)=='-') {
			$(this).attr('name',name.substr(1,name.length));
		}
	});
});
</script>