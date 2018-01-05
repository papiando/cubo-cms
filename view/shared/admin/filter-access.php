<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");
$items = array(
	array('id'=>ACCESS_ANY,'title'=>'Any access level'),
	array('id'=>ACCESS_PUBLIC,'title'=>'Public'),
	array('id'=>ACCESS_REGISTERED,'title'=>'Registered'),
	array('id'=>ACCESS_GUEST,'title'=>'Guest'),
	array('id'=>ACCESS_PRIVATE,'title'=>'Private')
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