<!DOCTYPE html>
<html lang="<cube:param name='language' />" itemscope itemtype="https://schema.org/WebPage">
<head>
	<link href="/vendor/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" rel="stylesheet">
	<link href="/vendor/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="/template/<cube:param name='template' />/css/style.css" />
	<script src="/vendor/jquery/3.2.1/js/jquery.slim.min.js"></script>
	<script src="/vendor/popper.js/1.12.3/js/popper.min.js"></script>
	<script src="/vendor/tether/1.3.3/js/tether.min.js"></script>
    <script src="/vendor/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
	<cube:head />
</head>
<body>
	<nav id="navigation" class="navbar navbar-toggleable-md navbar-inverse bg-inverse fixed-top">
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
		<a class="navbar-brand" href="/"><cube:module position="logo" /></a>
		<div class="collapse navbar-collapse" id="menu">
			<cube:module position="menu" />
			<cube:module position="search" />
		</div>
	</nav>
	<header id="header">
		<cube:module position="header" />
	</header>
	<section id="breadcrumb">
		<cube:module position="breadcrumb" />
	</section>
	<main id="main" role="main" itemProp="mainContentOfPage" itemscope itemtype="https://schema.org/webPageElement">
		<cube:content />
	</main>
	<section id="message">
		<cube:message />
	</section>
	<footer id="footer" class="bg-inverse fixed-bottom">
		<cube:module position="footer" />
	</footer>
</body>
</html>