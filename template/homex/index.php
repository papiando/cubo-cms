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
<body>

	<div id="screen-wrapper">
		<!-- Sidebar  -->
		<nav id="sidebar" class="navbar-inverse bg-primary sticky-top">
			<div class="sidebar-header">
          <button type="button" id="sidebar-toggle" class="btn btn-info">
            <span class="when-expanded"><i class="fa fa-arrow-left"></i> Collapse</span>
            <span class="when-collapsed"><i class="fa fa-arrow-right"></i></span>
          </button>
        </div>
        <ul class="list-unstyled navbar-nav components">
          <li class="active">
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link"><i class="fa fa-home"></i><span class="when-expanded"> Home</span></a>
            <ul class="collapse list-unstyled" id="homeSubmenu">
              <li class="navbar-link">
                <a href="#">Home 1</a>
              </li>
              <li class="navbar-link">
                <a href="#">Home 2</a>
              </li>
              <li class="navbar-link">
                <a href="#">Home 3</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="#" class="nav-link"><i class="fa fa-briefcase"></i><span class="when-expanded"> About</span></a>
		  </li>
		  <li>
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link"><i class="fa fa-bath"></i><span class="when-expanded"> Pages</span></a>
            <ul class="collapse list-unstyled" id="pageSubmenu">
              <li class="navbar-link">
                <a href="#">Page 1</a>
              </li>
              <li class="navbar-link">
                <a href="#">Page 2</a>
              </li>
              <li class="navbar-link">
                <a href="#">Page 3</a>
              </li>
            </ul>
          </li>
        </ul>
		</nav>
		<section id="content">
			<nav id="navigation" class="navbar navbar-toggleable-md navbar-inverse bg-primary sticky-top">
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
			<section id="breadcrumb" class="container">
				<cubo:module position="breadcrumb" />
			</section>
			<section id="message" class="container">
				<cubo:message />
			</section>
			<main id="main" class="container" role="main" itemProp="mainContentOfPage" itemscope itemtype="https://schema.org/webPageElement">
				<cubo:content />
			</main>
			<footer id="footer" class="bg-primary fixed-bottom">
				<cubo:module position="footer" />
			</footer>
		</section>
	</div>
</body>
</html>