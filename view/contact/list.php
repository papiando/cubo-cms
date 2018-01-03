<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");
?><h1>View: Contact/Index</h1>
<ul>
<?php foreach($this->_data as $contact) { ?>
	<li><a href="/contact/view/<?php echo $contact->name; ?>"><?php echo $contact->title; ?></a></li>
<?php } ?>
</ul>
