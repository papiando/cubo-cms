<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");
?><div class="form-group">
	<label for="<?php echo $select['name']; ?>"><?php echo $select['title']; ?></label>
	<select id="<?php echo $select['name']; ?>" name="<?php echo $select['prefix'].$select['name']; ?>" class="form-control <?php echo $select['class']; ?>">
<?php
$items = Cubo\Application::getDB()->loadItems($select['query']);
foreach($items as $item) {
	$item = (object)$item;
?>		<option value="<?php echo $item->id; ?>"<?php echo ($item->id == ($select['value'] ?? $select['default']) ? ' selected' : ''); ?>><?php echo $item->title; ?></option>
<?php
}
?>	</select>
</div>