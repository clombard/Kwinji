<header>
	<?php echo $header_tools; ?>
	<?php echo $header_title; ?>
</header>
<section class="container_6 clearfix">
	<?php echo Message::display(); ?>
	<?php $form_url = 'new/add'; ?>
	<?php if ($firm != NULL): ?>
		<?php $form_url .= "/fid/". $firm->id; ?>
	<?php endif; ?>
	<?php echo Form::open($form_url, array('id'=>'news_form', 'class' => 'form', 'novalidate' => 'true'));  ?>
	
		<h3><?php echo __("New Article"); ?></h3>
		<fieldset>
			<?php echo Form::input("new_id", $post['id'], array('type' => 'hidden')); ?>
			<?php echo Form::label("title", __("Title") . " <em>*</em><small>" . __('Enter your post title') ."</small>", array("required" => "required")); ?>
			<?php echo Form::input("title", $post['title'], array("class" => "half", "id" => "title", "required" => "required")); ?>
	
			<?php echo Form::label("teaser", __("Teaser") . " <em>*</em><small>" . __('About this post') ."</small>", array("required" => "required")); ?>
			<?php echo Form::input("teaser", $post['teaser'], array("class" => "half", "id" => "teaser", "required" => "required")); ?>
	
			<?php echo Form::label("description", __("Description") . " <em>*</em><small>" . __('Define the news content') ."</small>", array("required" => "required")); ?>
			<?php echo Form::textarea("description", $post['description'], array("class" => "half", "id" => "description", "required" => "required", "rows" => 10)); ?>
	
			<?php echo Form::label("mytags", __("Tags") . "<small>" . __('Keywords to index your post') ."</small>", array(NULL)); ?>
			<ul class="mytags half">
			<?php if (isset($post["tags"]) && count($post['tags']) > 0): ?>
				<?php for ($i = 0; $i < count($post['tags']); $i++): ?>
				<li class="tagit-choice">
				<?php echo $post['tags'][$i]; ?>
				</li>
				<?php endfor; ?>
			<?php endif; ?>
			</ul>
	
		</fieldset>
	
		<div class="action ar">
				<?php echo __(':simple_gray :big_green', array(
		        	':big_green'=>Form::button("valid", __('Submit'), array('class'=>'button button-green')),
		            ':simple_gray'=>Html::anchor("firm/view/id/" . $firm->id . "#tabs-2", __('Reset'), array('class'=>'button button-gray')),
				)); ?>
		</div>

	<?php echo Form::close(); ?>
</section>