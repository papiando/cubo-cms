<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");
?><div class="form-group">
	<label for="<?php echo $filter['id']; ?>"><?php echo $filter['label']; ?></label>
	<select id="<?php echo $filter['prefix'].$filter['id']; ?>" name="-<?php echo $filter['id']; ?>" class="form-control">
		<option value="<?php echo COLLECTION_ANY; ?>"<?php echo ($filter['value'] == COLLECTION_ANY ? " selected" : ""); ?>>Any collection</option>
<?php
$query = "SELECT `id`,`title` FROM `imagecollection` WHERE 1 ORDER BY `title`";
$items = Cubo\Application::getDB()->loadItems($query);
foreach($items as $item) {
	$item = (object)$item;
?>
		<option value="<?php echo $item->id; ?>"<?php echo ($filter['value'] == $item->id ? " selected" : ""); ?>><?php echo $item->title; ?></option>
<?php
}
?>
	</select>
</div>