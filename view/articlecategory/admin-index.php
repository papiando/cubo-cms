<h1>Articles</h1>
<table class="table table-sm table-striped table-hover">
	<thead class="bg-warning">
		<tr>
			<td>Title</td>
			<td class="text-right">
				<a href="/admin/article/add"><button class="btn btn-sm btn-success">add</button></a>
			</td>
		</tr>
	</thead>
	<tbody>
	<?php foreach($this->_data as $article) { ?>
		<tr>
			<td><?php echo $article->title; ?></td>
			<td class="text-right">
				<a href="/admin/article/edit?id=<?php echo $article->id; ?>"><button class="btn btn-sm btn-primary">edit</button></a>
				<a href="/admin/article/delete?id=<?php echo $article->id; ?>"><button class="btn btn-sm btn-danger">delete</button></a>
			</td>
		</tr>
	<?php } ?>
	</tbody>
</table>
