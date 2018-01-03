<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");
$items = array(
	array('id'=>STATUS_ANY,'title'=>'Any status'),
	array('id'=>STATUS_PUBLISHED,'title'=>'Published'),
	array('id'=>STATUS_UNPUBLISHED,'title'=>'Unpublished'),
	array('id'=>STATUS_TRASHED,'title'=>'Trashed')
	);
?><div class="form-group">
	<label for="<?php echo $filter['id']; ?>"><?php echo $filter['label']; ?></label>
	<select id="<?php echo $filter['prefix'].$filter['id']; ?>" name="-<?php echo $filter['id']; ?>" class="form-control">
<?php
foreach($items as $item) {
	$item = (object)$item;
?>
		<option value="<?php echo $item->id; ?>"<?php echo ($filter['value'] == $item->id ? " selected" : ""); ?>><?php echo $item->title; ?></option>
<?php
}
?>
	</select>
</div>