<h1>Add Article</h1>
<form class="form-add" action="" method="post">
	<div class="form-group">
		<label for="title">Title</label>
		<input type="text" name="title" id="title" value="" class="form-control" placeholder="Title" required autofocus />
	</div>
	<div class="form-group">
		<label for="name">Alias</label>
		<input type="text" name="name" id="name" value="" class="form-control" placeholder="Alias" required />
	</div>
	<div class="form-group">
		<label for="html">Contents</label>
		<textarea name="html" id="html" class="form-control" placeholder="Contents" rows="8" required></textarea>
	</div>
	<div class="form-group">
		<input type="checkbox" name="active" id="active" value="1" class="form-check-input" checked />
		<label for="active" class="form-check-label">Published</label>
	</div>
	<div class="form-group">
		<button class="btn btn-primary" type="submit">Save</button>
	</div>
</form>