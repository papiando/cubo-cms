<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");
?><div class="form-group">
	<label for="<?php echo $filter['id']; ?>"><?php echo $filter['label']; ?></label>
	<select id="<?php echo $filter['prefix'].$filter['id']; ?>" name="-<?php echo $filter['id']; ?>" class="form-control">
		<option value="<?php echo LANGUAGE_ANY; ?>"<?php echo ($filter['value'] == LANGUAGE_ANY ? " selected" : ""); ?>>Any language</option>
<?php
$query = "SELECT `id`,`title` FROM `language` WHERE `active` ORDER BY `title`";
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