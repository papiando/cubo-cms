<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");
?><h1>Edit Menu Option</h1>
<form class="form-edit" action="" method="post">
	<div class="form-group">
		<button class="btn btn-primary" id="submit" type="submit" disabled>Save</button>
		<a href="/admin/<?php echo strtolower($this->_class); ?>" class="btn btn-warning" id="cancel">Cancel</a>
	</div>
	<div class="form-row">
		<input type="hidden" name="id" value="<?php echo $this->_data->id; ?>" />
		<div class="col-8">
			<div class="form-group">
				<label for="title">Title</label>
				<input type="text" name="-title" id="title" value="<?php echo $this->_data->title; ?>" class="form-control" placeholder="Title" required autofocus />
			</div>
		</div>
		<div class="col-4">
			<div class="form-group">
				<label for="name">Alias</label>
				<input type="text" name="-name" id="name" value="<?php echo $this->_data->name; ?>" class="form-control" placeholder="Alias" required />
			</div>
		</div>
	</div>
	<ul class="nav nav-tabs" id="tabs" role="tablist">
		<li class="nav-item">
			<a class="nav-link active" id="content-tab" data-toggle="tab" href="#content-pane" role="tab" aria-controls="content-pane" aria-selected="true">Content</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="link-tab" data-toggle="tab" href="#link-pane" role="tab" aria-controls="link-pane" aria-selected="false">Link</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="options-tab" data-toggle="tab" href="#options-pane" role="tab" aria-controls="options-pane" aria-selected="false">Options</a>
		</li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane fade show active" id="content-pane" role="tabpanel" aria-labelledby="content-tab">
			<div class="form-row">
				<div class="col-8">
					<div class="form-group">
						<label for="description">Summary</label>
						<textarea name="-description" id="description" class="form-control" placeholder="Summary" rows="7"><?php echo $this->_data->description; ?></textarea>
					</div>
				</div>
				<div class="col-4">
					<div class="form-group">
						<label for="status">Status</label>
						<select name="-status" id="status" class="form-control form-control-sm">
							<?php include($this->_sharedPath.'select-status.php'); ?>
						</select>
					</div>
					<div class="form-group">
						<label for="menu">Menu</label>
						<select name="-menu" id="menu" class="form-control form-control-sm">
							<?php include($this->_sharedPath.'select-menu.php'); ?>
						</select>
					</div>
					<div class="form-group">
						<label for="option">Parent Option</label>
						<select name="-option" id="option" class="form-control form-control-sm">
							<?php include($this->_sharedPath.'select-option.php'); ?>
						</select>
					</div>
					<div class="form-group">
						<label for="language">Language</label>
						<select name="-language" id="language" class="form-control form-control-sm">
							<?php include($this->_sharedPath.'select-language.php'); ?>
						</select>
					</div>
					<div class="form-group">
						<label for="access">Access</label>
						<select name="-access" id="access" class="form-control form-control-sm">
							<?php include($this->_sharedPath.'select-access.php'); ?>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane fade" id="link-pane" role="tabpanel" aria-labelledby="link-tab">
			<div class="form-row">
				<div class="col-6">
					<div class="form-group">
						<label for="linktype">Link Type</label>
						<select name="@linktype" id="linktype" class="form-control form-control-sm">
							<?php include($this->_sharedPath.'select-linktype.php'); ?>
						</select>
					</div>
					<div id="linktype-1" class="form-group d-none">
						<label for="article">Article</label>
						<select name="@article" id="article" class="form-control form-control-sm">
						<?php
							$id = 'article';
							$label = 'Article';
							$prefix = '-';
							$value = $this->_data->image;
							include($this->_sharedPath.'select-article.php'); ?>
						</select>
					</div>
				</div>
				<div class="col-6">
					<div class="form-group">
						<label>Image Preview</label>
						<figure>
							<img id="image-preview" class="img-fluid img-thumbnail full-width" src="<?php echo $url; ?>" />
						</figure>
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane" id="options-pane" role="tabpanel" aria-labelledby="options-tab">
			<div class="form-row">
				<div class="col-6">
					<div class="form-group">
						<label for="show_title">Show title</label>
						<select name="@show_title" id="show_title" class="form-control form-control-sm">
							<?php $setting = 'show_title'; ?>
							<?php include($this->_sharedPath.'select-showhide.php'); ?>
						</select>
					</div>
					<div class="form-group">
						<label for="show_author">Show author</label>
						<select name="@show_author" id="show_author" class="form-control form-control-sm">
							<?php include($this->_sharedPath.'select-showuser.php'); ?>
						</select>
					</div>
					<div class="form-group">
						<label for="show_category">Show category</label>
						<select name="@show_category" id="show_category" class="form-control form-control-sm">
							<?php $setting = 'show_category'; ?>
							<?php include($this->_sharedPath.'select-showhide.php'); ?>
						</select>
					</div>
					<div class="form-group">
						<label for="show_tags">Show tags</label>
						<select name="@show_tags" id="show_tags" class="form-control form-control-sm">
							<?php $setting = 'show_tags'; ?>
							<?php include($this->_sharedPath.'select-showhide.php'); ?>
						</select>
					</div>
					<div class="form-group">
						<label for="show_date">Show date</label>
						<select name="@show_date" id="show_date" class="form-control form-control-sm">
							<?php include($this->_sharedPath.'select-showdate.php'); ?>
						</select>
					</div>
				</div>
				<div class="col-6">
					<div class="form-group">
						<label for="show_image">Show image</label>
						<select name="@show_image" id="show_image" class="form-control form-control-sm">
							<?php $setting = 'show_image'; ?>
							<?php include($this->_sharedPath.'select-showhide.php'); ?>
						</select>
					</div>
					<div class="form-group">
						<label for="position_image">Image position</label>
						<select name="@position_image" id="position_image" class="form-control form-control-sm">
							<?php include($this->_sharedPath.'select-positionimage.php'); ?>
						</select>
					</div>
					<div class="form-group">
						<label for="show_info">Show article info</label>
						<select name="@show_info" id="show_info" class="form-control form-control-sm">
							<?php $setting = 'show_info'; ?>
							<?php include($this->_sharedPath.'select-showhide.php'); ?>
						</select>
					</div>
					<div class="form-group">
						<label for="position_info">Info position</label>
						<select name="@position_info" id="position_info" class="form-control form-control-sm">
							<?php include($this->_sharedPath.'select-positioninfo.php'); ?>
						</select>
					</div>
					<div class="form-group">
						<label for="show_readmore">Show read more</label>
						<select name="@show_readmore" id="show_readmore" class="form-control form-control-sm">
							<?php include($this->_sharedPath.'select-showreadmore.php'); ?>
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<script src="/view/shared/js/editing.js"></script>