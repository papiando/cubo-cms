<?php
/**
 * @application    Cubo CMS
 * @type           View
 * @controller     Dashboard
 * @method         Create
 * @version        1.1.0
 * @date           2019-01-19
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2019 Papiando Riba Internet. All rights reserved.
 * @license        GNU General Public License version 3 or later; see LICENSE.md
 */
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting this code without an include");

?><h1>Create Dashboard</h1>
<form class="form-create" action="" method="post">
	<div class="form-group">
		<button class="btn btn-success" id="submit" type="submit" disabled><i class="fa fa-check"></i> Save</button>
		<a href="/admin/<?php echo strtolower($this->_class); ?>" class="btn btn-danger" id="cancel"><i class="fa fa-times"></i> Cancel</a>
	</div>
	<div class="grid-columns">
		<div class="form-group grid-column-2">
			<label for="title">Title</label>
			<input type="text" name="title" id="title" class="form-control" placeholder="Title" required autofocus />
		</div>
		<div class="form-group">
			<label for="name">Alias</label>
			<input type="text" name="name" id="name" class="form-control" placeholder="Alias" required />
		</div>
	</div>
	<ul class="nav nav-tabs" id="tabs" role="tablist">
		<li class="nav-item">
			<a class="nav-link active" id="content-tab" data-toggle="tab" href="#content-pane" role="tab" aria-controls="content-pane" aria-selected="true">Content</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="image-tab" data-toggle="tab" href="#image-pane" role="tab" aria-controls="image-pane" aria-selected="false">Image and Metadata</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="publishing-tab" data-toggle="tab" href="#publishing-pane" role="tab" aria-controls="publishing-pane" aria-selected="false">Publishing</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="options-tab" data-toggle="tab" href="#options-pane" role="tab" aria-controls="options-pane" aria-selected="false">View Options</a>
		</li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane fade show active" id="content-pane" role="tabpanel" aria-labelledby="content-tab">
			<div class="grid-columns">
				<div class="form-group grid-column-2">
					<label for="html">Article Content</label>
					<textarea name="html" id="html" class="form-control text-html" placeholder="Contents" rows="12" required></textarea>
				</div>
				<div>
					<?php echo Form::select(array(
						'name'=>'status',
						'title'=>'Status',
						'default'=>(ArticleController::canPublish() ? STATUS_PUBLISHED : STATUS_UNPUBLISHED),
						'class'=>' form-control-sm',
						'query'=>Form::query('publishingstatus',Session::isAccessible()),
						'readonly'=>ArticleController::cannotPublish())); ?>
					<?php echo Form::select(array(
						'name'=>'category',
						'title'=>'Category',
						'default'=>CATEGORY_UNDEFINED,
						'class'=>' form-control-sm',
						'query'=>Form::query('articlecategory',Session::isAccessible()))); ?>
					<?php echo Form::select(array(
						'name'=>'language',
						'title'=>'Language',
						'default'=>LANGUAGE_UNDEFINED,
						'class'=>' form-control-sm',
						'query'=>Form::query('language',Session::isAccessible()))); ?>
					<?php echo Form::select(array(
						'name'=>'access',
						'title'=>'Access',
						'default'=>ACCESS_PUBLIC,
						'class'=>' form-control-sm',
						'query'=>Form::query('accesslevel',Session::isAccessible()))); ?>
				</div>
			</div>
		</div>
		<div class="tab-pane fade" id="image-pane" role="tabpanel" aria-labelledby="image-tab">
			<div class="grid-columns">
				<div>
					<div class="form-group">
						<label for="description">Summary</label>
						<textarea name="description" id="description" class="form-control" placeholder="Summary" rows="3"></textarea>
					</div>
					<div class="form-group">
						<?php
							$id = 'image';
							$label = 'Image';
							$prefix = '-';
							$value = null;
							include($this->_sharedPath.'select-image.php'); ?>
					</div>
				</div>
				<div>
					<div class="form-group">
						<label for="tags">Tags</label>
						<textarea name="tags" id="tags" class="form-control" placeholder="Tags" rows="3"></textarea>
					</div>
					<div class="form-group">
						<label>Image Preview</label>
						<figure>
							<img id="image-preview" class="img-fluid img-thumbnail full-width" src="<?php echo $url; ?>" />
						</figure>
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane" id="publishing-pane" role="tabpanel" aria-labelledby="publishing-tab">
			<div class="grid-columns">
				<div>
					<?php echo Form::select(array(
						'name'=>'author',
						'title'=>'Author',
						'prefix'=>'-',
						'default'=>Session::getUser(),
						'class'=>' form-control-sm',
						'query'=>Form::query('user',Session::isAccessible()),
						'readonly'=>true)); ?>
					<?php echo Form::select(array(
						'name'=>'editor',
						'title'=>'Editor',
						'prefix'=>'-',
						'default'=>USER_NOBODY,
						'class'=>' form-control-sm',
						'query'=>Form::query('user',Session::isAccessible(true)),
						'readonly'=>true)); ?>
					<?php echo Form::select(array(
						'name'=>'publisher',
						'title'=>'Publisher',
						'prefix'=>'-',
						'default'=>USER_NOBODY,
						'class'=>' form-control-sm',
						'query'=>Form::query('user',Session::isAccessible(true)),
						'readonly'=>true)); ?>
				</div>
				<div>
					<div class="form-group">
						<label for="created">Created Date</label>
						<input type="datetime-local" name="-created" id="created" class="form-control form-control-sm" readonly />
					</div>
					<div class="form-group">
						<label for="modified">Modified Date</label>
						<input type="datetime-local" name="-modified" id="modified" class="form-control form-control-sm" readonly />
					</div>
					<div class="form-group">
						<label for="published">Published Date</label>
						<input type="datetime-local" name="-published" id="published" class="form-control form-control-sm" readonly />
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane" id="options-pane" role="tabpanel" aria-labelledby="options-tab">
			<div class="grid-columns">
				<div>
					<?php $options = array(
						array('id'=>SETTING_GLOBAL,'title'=>'Global setting'),
						array('id'=>SETTING_SHOW,'title'=>'Show'),
						array('id'=>SETTING_HIDE,'title'=>'Hide')); ?>
					<?php echo Form::select(array(
						'name'=>'show_title',
						'title'=>'Show title',
						'prefix'=>'@',
						'default'=>SETTING_GLOBAL,
						'class'=>' form-control-sm',
						'list'=>$options)); ?>
					<?php $options_author = array(
						array('id'=>SETTING_GLOBAL,'title'=>'Global setting'),
						array('id'=>SETTING_AUTHOR,'title'=>'Show author'),
						array('id'=>SETTING_EDITOR,'title'=>'Show editor'),
						array('id'=>SETTING_PUBLISHER,'title'=>'Show publisher'),
						array('id'=>SETTING_HIDE,'title'=>'Hide')); ?>
					<?php echo Form::select(array(
						'name'=>'show_author',
						'title'=>'Show author',
						'prefix'=>'@',
						'default'=>SETTING_GLOBAL,
						'class'=>' form-control-sm',
						'list'=>$options_author)); ?>
					<?php echo Form::select(array(
						'name'=>'show_category',
						'title'=>'Show category',
						'prefix'=>'@',
						'default'=>SETTING_GLOBAL,
						'class'=>' form-control-sm',
						'list'=>$options)); ?>
					<?php echo Form::select(array(
						'name'=>'show_tags',
						'title'=>'Show tags',
						'prefix'=>'@',
						'default'=>SETTING_GLOBAL,
						'class'=>' form-control-sm',
						'list'=>$options)); ?>
					<?php $options_date = array(
						array('id'=>SETTING_GLOBAL,'title'=>'Global setting'),
						array('id'=>SETTING_CREATEDDATE,'title'=>'Show created date'),
						array('id'=>SETTING_MODIFIEDDATE,'title'=>'Show modified date'),
						array('id'=>SETTING_PUBLISHEDDATE,'title'=>'Show published date'),
						array('id'=>SETTING_HIDE,'title'=>'Hide')); ?>
					<?php echo Form::select(array(
						'name'=>'show_date',
						'title'=>'Show date',
						'prefix'=>'@',
						'default'=>SETTING_GLOBAL,
						'class'=>' form-control-sm',
						'list'=>$options_date)); ?>
				</div>
				<div>
					<?php echo Form::select(array(
						'name'=>'show_image',
						'title'=>'Show image',
						'prefix'=>'@',
						'default'=>SETTING_GLOBAL,
						'class'=>' form-control-sm',
						'list'=>$options)); ?>
					<?php $options_position = array(
						array('id'=>SETTING_GLOBAL,'title'=>'Global setting'),
						array('id'=>SETTING_ABOVETITLE,'title'=>'Above title'),
						array('id'=>SETTING_BELOWTITLE,'title'=>'Below title'),
						array('id'=>SETTING_FLOATLEFT,'title'=>'Float left'),
						array('id'=>SETTING_FLOATRIGHT,'title'=>'Float right')); ?>
					<?php echo Form::select(array(
						'name'=>'position_image',
						'title'=>'Image position',
						'prefix'=>'@',
						'default'=>SETTING_GLOBAL,
						'class'=>' form-control-sm',
						'list'=>$options_position)); ?>
					<?php echo Form::select(array(
						'name'=>'show_info',
						'title'=>'Show info',
						'prefix'=>'@',
						'default'=>SETTING_GLOBAL,
						'class'=>' form-control-sm',
						'list'=>$options)); ?>
					<?php $options_position = array(
						array('id'=>SETTING_GLOBAL,'title'=>'Global setting'),
						array('id'=>SETTING_ABOVECONTENT,'title'=>'Above content'),
						array('id'=>SETTING_ABOVETITLE,'title'=>'Above title'),
						array('id'=>SETTING_BELOWTITLE,'title'=>'Below title'),
						array('id'=>SETTING_BELOWCONTENT,'title'=>'Below content')); ?>
					<?php echo Form::select(array(
						'name'=>'position_info',
						'title'=>'Info position',
						'prefix'=>'@',
						'default'=>SETTING_GLOBAL,
						'class'=>' form-control-sm',
						'list'=>$options_position)); ?>
					<?php $options_readmore = array(
						array('id'=>SETTING_GLOBAL,'title'=>'Global setting'),
						array('id'=>SETTING_PARAGRAPH,'title'=>'After first paragraph'),
						array('id'=>SETTING_TENLINES,'title'=>'After ten lines'),
						array('id'=>SETTING_HIDE,'title'=>'Hide')); ?>
					<?php echo Form::select(array(
						'name'=>'show_readmore',
						'title'=>'Show read more',
						'prefix'=>'@',
						'default'=>SETTING_GLOBAL,
						'class'=>' form-control-sm',
						'list'=>$options_readmore)); ?>
				</div>
			</div>
		</div>
	</div>
</form>
<script src="/view/shared/js/editing.js"></script>