<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");
?><div class="info text-muted">
<?php
$person = 'author';
include($this->_sharedPath.'show-user.php');
$person = 'creator';
include($this->_sharedPath.'show-user.php');
$person = 'editor';
include($this->_sharedPath.'show-user.php');
$person = 'publisher';
include($this->_sharedPath.'show-user.php');
?>
</div>