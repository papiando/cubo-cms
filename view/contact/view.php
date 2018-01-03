<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");
?><h1><?php echo $this->_data->title; ?></h1>
<?php echo $this->_data->html; ?>
<form class="form-contact" action="" method="post">
	<div class="form-group">
		<label for="name" class="sr-only">Name</label>
		<input type="text" name="name" id="name" class="form-control" placeholder="Name" required autofocus />
	</div>
	<div class="form-group">
		<label for="email" class="sr-only">Email</label>
		<input type="email" name="email" id="email" class="form-control" placeholder="Email" required />
	</div>
	<div class="form-group">
		<label for="subject" class="sr-only">Subject</label>
		<input type="text" name="subject" id="subject" class="form-control" placeholder="Subject" required />
	</div>
	<div class="form-group">
		<label for="message" class="sr-only">Message</label>
		<textarea name="message" id="message" class="form-control" placeholder="Message" required></textarea>
	</div>
	<div class="form-group">
		<button class="btn btn-lg btn-primary btn-block" type="submit">Send</button>
	</div>
</form>