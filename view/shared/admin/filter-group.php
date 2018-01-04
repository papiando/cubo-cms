<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");
?><div class="form-group">
	<label for="<?php echo $filter['id']; ?>"><?php echo $filter['label']; ?></label>
	<select id="<?php echo $filter['prefix'].$filter['id']; ?>" name="-<?php echo $filter['id']; ?>" class="form-control">
		<option value="<?php echo GROUP_ANY; ?>"<?php echo ($filter['value'] == GROUP_ANY ? " selected" : ""); ?>>Any group</option>
<?php
if(isset($root) and $root) {
	$query = "SELECT `id`,`title` FROM `contactgroup` WHERE `status`=".STATUS_PUBLISHED." ORDER BY `title`";
} else {
	$query = "SELECT `id`,`title` FROM `contactgroup` WHERE `status`=".STATUS_PUBLISHED." AND `access` ORDER BY `title`";
}
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