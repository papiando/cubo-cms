<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");
?><div class="info text-muted">
<?php
$person = 'author';
include($this->sharedPath.'show-user.php');
$person = 'editor';
include($this->sharedPath.'show-user.php');
$person = 'publisher';
include($this->sharedPath.'show-user.php');
?>
</div>