<?php
$router = Cubo\Application::getRouter()->getController();
?>
<h1>Article Categories</h1>
<ul>
<?php foreach($this->_data as $category) { ?>
	<li><a href="/<?php echo $router; ?>/view/<?php echo $category->name; ?>"><?php echo $category->title; ?></a></li>
<?php } ?>
</ul>
