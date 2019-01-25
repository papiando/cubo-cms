<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");
$root = true;
?><h1>Edit User</h1>
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
			<a class="nav-link" id="image-tab" data-toggle="tab" href="#image-pane" role="tab" aria-controls="image-pane" aria-selected="false">Login Details</a>
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
				<div class="col-8">
					<div class="form-group">
						<label for="description">Summary</label>
						<textarea name="-description" id="description" class="form-control" placeholder="Summary" rows="7" required><?php echo $this->_data->description; ?></textarea>
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
						<label for="role">Role</label>
						<select name="-role" id="role" class="form-control form-control-sm">
							<?php include($this->_sharedPath.'select-role.php'); ?>
						</select>
					</div>
					<div class="form-group">
						<label for="language">Preferred Language</label>
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
		<div class="tab-pane fade" id="image-pane" role="tabpanel" aria-labelledby="image-tab">
			<div class="form-row">
				<div class="col-6">
					<div class="form-group">
						<label for="name">Password</label>
						<input type="password" name="-password" id="password" class="form-control form-control-sm" placeholder="Password" />
					</div>
					<div class="form-group">
						<label for="email">Email Address</label>
						<input type="text" name="-email" id="email" class="form-control form-control-sm" placeholder="Email Address" />
					</div>
					<div class="form-group">
						<label for="phone">Phone Number</label>
						<input type="text" name="-phone" id="phone" class="form-control form-control-sm" placeholder="Phone Number" />
					</div>
				</div>
				<div class="col-6">
					<div class="form-group">
						<label for="published">Last Login</label>
						<input type="datetime-local" name="-lastloggedin" id="lastloggedin" value="<?php echo str_replace(' ','T',$this->_data->lastloggedin); ?>" class="form-control form-control-sm" readonly />
					</div>
					<div class="form-group">
						<label for="logins">Number of Logins</label>
						<input type="number" name="-logins" id="logins" value="<?php echo $this->_data->logins; ?>" class="form-control form-control-sm" readonly />
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane" id="publishing-pane" role="tabpanel" aria-labelledby="publishing-tab">
			<div class="form-row">
				<div class="col-6">
					<div class="form-group">
						<label for="publisher">Publisher</label>
						<select name="-publisher" id="publisher" class="form-control form-control-sm" readonly>
							<?php $user = 'publisher'; ?>
							<?php include($this->_sharedPath.'select-user.php'); ?>
						</select>
					</div>
					<div class="form-group">
						<label for="author">Author</label>
						<select name="-author" id="author" class="form-control form-control-sm" readonly>
							<?php $user = 'author'; ?>
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
						<label for="published">Published Date</label>
						<input type="datetime-local" name="-published" id="published" value="<?php echo str_replace(' ','T',$this->_data->published); ?>" class="form-control form-control-sm" readonly />
					</div>
					<div class="form-group">
						<label for="created">Created Date</label>
						<input type="datetime-local" name="-created" id="created" value="<?php echo str_replace(' ','T',$this->_data->created); ?>" class="form-control form-control-sm" readonly />
					</div>
					<div class="form-group">
						<label for="modified">Modified Date</label>
						<input type="datetime-local" name="-modified" id="modified" value="<?php echo str_replace(' ','T',$this->_data->modified); ?>" class="form-control form-control-sm" readonly />
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