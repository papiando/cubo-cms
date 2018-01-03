<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");
?><h1><?php echo Cubo\Language::plural('article'); ?></h1>
<ul>
<?php
if($this->_data) {
	foreach($this->_data as $article) {
?>	<li><a href="/article/<?php echo $article->name; ?>?action=view"><?php echo $article->title; ?></a></li>
<?php
	}
}
?>
</ul>