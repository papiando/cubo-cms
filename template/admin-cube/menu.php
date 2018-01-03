<div class="list-group">
	<div class="" role="tab" id="content-management-heading">
		<a data-toggle="collapse" class="list-group-item p-2 m-0 text-dark" role="listitem" href="#content-management" aria-expanded="<?php echo (isset($_SESSION['preferences']['content_management']) && $_SESSION['preferences']['content_management'] ? "true" : "false"); ?>" aria-controls="content-management">
			<span class="text-uppercase">Content Management</span>
		</a>
	</div>
	<div id="content-management" class="collapse<?php echo (isset($_SESSION['preferences']['content_management']) && $_SESSION['preferences']['content_management'] ? " show" : ""); ?>" role="listitem" aria-labelledby="content-management-heading">
		<small>
			<a class="list-group-item px-4 py-1 mb-0" role="listitem" href="/admin/article"><i class="fa fa-file-text fa-fw"></i> Articles</a>
			<a class="list-group-item px-4 py-1 mb-0" role="listitem" href="/admin/articlecategory"><i class="fa fa-folder-open fa-fw"></i> Article Categories</a>
			<a class="list-group-item px-4 py-1 mb-0" role="listitem" href="/admin/contact"><i class="fa fa-user fa-fw"></i> Contacts</a>
			<a class="list-group-item px-4 py-1 mb-0" role="listitem" href="/admin/contactgroup"><i class="fa fa-group fa-fw"></i> Contact Groups</a>
		</small>
	</div>
</div>
<div class="list-group">
	<div class="" role="list" id="media-management-heading">
		<a data-toggle="collapse" class="list-group-item p-2 m-0 text-dark" href="#media-management" aria-expanded="<?php echo (isset($_SESSION['preferences']['media_management']) && $_SESSION['preferences']['media_management'] ? "true" : "false"); ?>" aria-controls="media-management" data-reference="side-menu">
			<span class="text-uppercase">Media Management</span>
		</a>
	</div>
	<div id="media-management" class="collapse<?php echo (isset($_SESSION['preferences']['media_management']) && $_SESSION['preferences']['media_management'] ? " show" : ""); ?>" aria-labelledby="media-management-heading">
		<small>
			<a class="list-group-item px-4 py-1 mb-0" role="listitem" href="/admin/image"><i class="fa fa-picture-o fa-fw"></i> Images</a>
			<a class="list-group-item px-4 py-1 mb-0" role="listitem" href="/admin/imagecollection"><i class="fa fa-book fa-fw"></i> Image Collections</a>
		</small>
	</div>
</div>
<div class="list-group">
	<div class="" role="list" id="user-management-heading">
		<a data-toggle="collapse" class="list-group-item p-2 m-0 text-dark" href="#user-management" aria-expanded="<?php echo (isset($_SESSION['preferences']['user_management']) && $_SESSION['preferences']['user_management'] ? "true" : "false"); ?>" aria-controls="user-management" data-reference="side-menu">
			<span class="text-uppercase">User Management</span>
		</a>
	</div>
	<div id="user-management" class="collapse<?php echo (isset($_SESSION['preferences']['user_management']) && $_SESSION['preferences']['user_management'] ? " show" : ""); ?>" aria-labelledby="user-management-heading">
		<small>
			<a class="list-group-item px-4 py-1 mb-0" role="listitem" href="/admin/user"><i class="fa fa-user fa-fw"></i> Users</a>
			<a class="list-group-item px-4 py-1 mb-0" role="listitem" href="/admin/userrole"><i class="fa fa-group fa-fw"></i> User Roles</a>
		</small>
	</div>
</div>
<script>
$(document).ready(function () {
	$('[data-toggle=collapse]').click(function() {
		$.ajax({
			url: '/vendor/papiando/ajax/session-save.php',
			type: 'post',
			data: {
				'set': 'preferences',
				'property': $(this).attr('aria-controls').replace(/-/g,'_'),
				'value': $(this).attr('aria-expanded')=='false'?1:0
			}
		});
	});
});
</script>