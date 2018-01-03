<?php
defined('__CUBO__') || new \Exception("No use starting this code without an include");
$image = Cubo\Application::getDB()->loadItem("SELECT `name`,`title` FROM `image` WHERE `id`='{$this->_data->image}' LIMIT 1");
if($image && $this->getAttribute('show_image')) {
?>
<figure class="img-container" itemProp="image" itemscope itemtype="https://schema.org/ImageObject">
	<img class="img-fluid" src="<?php echo __BASE__; ?>/image/<?php echo $image['name']; ?>" alt="<?php echo $image['title']; ?>" />
	<meta itemProp="url" content="<?php echo __BASE__; ?>/image/<?php echo $image['name']; ?>" />
</figure>
<?php
}
?>