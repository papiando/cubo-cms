<!DOCTYPE html>
<html lang="<cubo:param name='language' />" itemscope itemtype="https://schema.org/WebPage">
<head>
	<link href="/template/<cubo:param name='template' />/stylesheet/style.css" rel="stylesheet" />
	<link href="/vendor/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
	<script src="/vendor/jquery/3.2.1/js/jquery.slim.min.js"></script>
	<script src="/vendor/popper.js/1.12.3/js/popper.min.js"></script>
	<script src="/vendor/tether/1.3.3/js/tether.min.js"></script>
    <script src="/vendor/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
	<meta name="theme-color" content="dd4814" />
	<meta name="msapplication-navbutton-color" content="dd4814" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	<cubo:head />
</head>
<body class="has-fixed-nav">
	<nav id="navigation" class="navbar navbar-toggleable-md navbar-inverse bg-primary fixed-top">
		<div class="container">
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
			<a class="navbar-brand" href="/"><cubo:module position="logo" /></a>
			<div class="collapse navbar-collapse" id="menu">
				<cubo:module position="menu" />
				<cubo:module position="search" />
			</div>
		</div>
	</nav>
	<header id="header">
		<cubo:module position="header" />
	</header>
	<section id="breadcrumb">
		<cubo:module position="breadcrumb" />
	</section>
	<section id="message">
		<div class="container">
			<cubo:message />
		</div>
	</section>
	<main id="main" class="container" role="main" itemProp="mainContentOfPage" itemscope itemtype="https://schema.org/webPageElement">
		<div class="container">
			<cubo:content />
		</div>
	</main>
	<footer id="footer" class="bg-primary fixed-bottom">
		<cubo:module position="footer" />
	</footer>
</body>
</html>