<!DOCTYPE html>
<html lang="en" itemscope itemtype="https://schema.org/WebPage">
<head>
	<title itemprop="name headline"><cubo:param name='site_name' /></title>
	<base itemprop="url" href="<cubo:param name='base_url' />/admin" />
	<meta charset="utf-8" />
	<meta name="application_name" content="<cubo:param name='site_name' />" />
	<meta name="generator" content="<cubo:param name='generator' />" />
	<meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no" />
	<link href="/vendor/bootswatch/4.0.0-beta.2/cosmo/bootstrap.min.css" rel="stylesheet" />
	<link href="/vendor/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="/template/<cubo:param name='template' />/css/style.css" />
	<link rel="icon" type="image/png" href="/vendor/cubo-cms/cubo-b192.png" />
	<script src="/vendor/jquery/3.2.1/js/jquery.min.js"></script>
	<script src="/vendor/popper.js/1.12.3/js/popper.min.js"></script>
	<script src="/vendor/tether/1.3.3/js/tether.min.js"></script>
    <script src="/vendor/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
</head>
<body>
	<nav id="navigation" class="navbar navbar-toggleable-md navbar-dark bg-primary fixed-top">
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
		<a class="navbar-brand" href="/"><img src="/vendor/cubo-cms/cubo-w192.png" /></a>
		<div class="collapse navbar-collapse" id="menu" role="menubar">
			<ul class="navbar-nav">
	<li class="nav-item"><a class="nav-link" href="/">Home</a></li>
</ul>
			
		</div>
	</nav>
	<header id="header">
		
	</header>
	<main id="main">
		<div class="container">
			<div class="row">
				<menu id="side-menu" class="col-3" role="nav">
					<?php include('menu.php'); ?>
				</menu>
				<section id="main-content" class="col-9" role="main">
					<cubo:content />
				</section>
			</div>
		</div>
	</main>
	<section id="message">
		<cubo:message />
	</section>
	<footer id="footer" class="bg-inverse fixed-bottom">
		
	</footer>
</body>
</html>
