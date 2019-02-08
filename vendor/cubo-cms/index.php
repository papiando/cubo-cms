<!DOCTYPE html>
<html lang="en" itemscope itemtype="https://schema.org/WebPage">
<head>
	<title itemprop="name headline"><cubo:param name='site_name' /></title>
	<base itemprop="url" href="<cubo:param name='base_url' />/admin" />
	<meta charset="utf-8" />
	<meta name="application_name" content="<cubo:param name='site_name' />" />
	<meta name="generator" content="<cubo:param name='generator' />" />
	<meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no" />
	<link href="/vendor/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="/vendor/cubo-cms/theme/cubo-cms.css" />
	<link rel="stylesheet" href="/vendor/cubo-cms/template/cubo-cms.css" />
	<link rel="icon" type="image/png" href="/vendor/cubo-cms/cubo-b192.png" />
	<script src="/vendor/jquery/3.2.1/js/jquery.min.js"></script>
	<script src="/vendor/popper.js/1.12.3/js/popper.min.js"></script>
	<script src="/vendor/tether/1.3.3/js/tether.min.js"></script>
    <script src="/vendor/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
</head>
<body class="has-fixed-nav">
	<nav id="navigation" class="navbar navbar-toggleable-md navbar-dark bg-primary text-inverse fixed-top">
		<div class="container d-flex flex-nowrap">
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
			<a class="navbar-brand" href="/"><img class="brand-logo" src="<cubo:param name='brand_logo' />" /><span class="brand-name"><cubo:param name='brand_name' /></span></a>
		</div>
	</nav>
	<header id="header">
		<cubo:module name="header" />
	</header>
	<section id="message">
		<div class="container">
			<cubo:message />
		</div>
	</section>
	<main id="main">
		<div class="container">
			<section id="main-content" role="main">
				<cubo:content />
			</section>
		</div>
	</main>
	<footer id="footer" class="bg-inverse fixed-bottom">
		<cubo:module name="footer" />
	</footer>
</body>
</html>
