<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");
?><div class="form-group">
	<label for="<?php echo $filter['id']; ?>"><?php echo $filter['label']; ?></label>
	<input id="<?php echo $filter['prefix'].$filter['id']; ?>" name="-<?php echo $filter['id']; ?>" class="form-control" type="text" placeholder="<?php echo $filter['label']; ?>" value="<?php echo $filter['value']; ?>" />
</div>