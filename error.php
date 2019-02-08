<?php if(http_response_code() == 200) http_response_code(500); ?><!DOCTYPE html>
<html lang="en" itemscope itemtype="https://schema.org/WebPage">
<head>
	<title itemprop="name headline">Error</title>
	<base itemprop="url" href="http://cubo-cms.local/admin" />
	<meta charset="utf-8" />
	<meta name="application_name" content="Cubo CMS" />
	<meta name="generator" content="Cubo CMS by Papiando" />
	<meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no" />
	<link href="/vendor/bootswatch/4.0.0-beta.2/cosmo/bootstrap.min.css" rel="stylesheet" />
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
	<nav id="navigation" class="navbar navbar-toggleable-md navbar-dark bg-primary fixed-top">
		<div class="container d-flex flex-nowrap">
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
			<a class="navbar-brand" href="/"><img class="brand-logo" src="/vendor/cubo-cms/cubo-w192.png" /><span class="brand-name"><strong>Cubo</strong> <em>CMS</em></span></a>
		</div>
	</nav>
	<header id="header"></header>
	<main id="main">
		<div class="container">
			<section id="main-content" role="main">
				<article itemProp="hasPart" itemScope itemType="https://schema.org/Article"><h1>Error</h1><h4 class="text-danger"><?php echo $_error->message ?? "Unknown error"; ?></h4><div itemProp="articleBody"><p><?php echo $_error->description ?? "Sorry for the inconvenience. Please be patient while this is resolved."; ?></p></div></article>
			</section>
		</div>
	</main>
	<section id="message"></section>
	<footer id="footer" class="bg-inverse fixed-bottom"></footer>
</body>
</html>