<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");
?><h1>User Login</h1>
<form class="form-login" action="" method="post">
	<div class="form-group">
		<label for="login">Login name</label>
		<input type="text" name="login" id="login" value="" class="form-control" placeholder="Login name" required autofocus />
	</div>
	<div class="form-group">
		<label for="password">Password</label>
		<input type="password" name="password" id="password" value="" class="form-control" placeholder="Password" required />
	</div>
	<div class="form-group">
		<button class="btn btn-primary" type="submit">Login</button>
	</div>
</form>