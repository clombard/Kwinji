
<div class="main-content grid_5 alpha">
	<header>
		<div class="action-buttons clearfix fr">
			<?php echo Html::anchor("event/", " 211 " . __("visit(s)"), array("class" => "button button-gray")); ?>
			<?php echo Html::anchor("#", __("Post an event"), array("class" => "button button-green")); ?>
		</div>
	<div class="view-switcher">
		<h2><?php echo __("Dashboard"); ?></h2>
		<ul>
			<li><a href="layouts.html">Default Layout</a></li>
			<li><a href="layout2.html">Preview Pane</a></li>
			<li><a href="layout3.html">3 Columns</a></li>
			<li><a href="layout4.html">Promo Layout</a></li>
		</ul>
	</div>
	</header>
	<section>
	<?php echo Form::open("ajax/post_new", array("method" => "post", "id" => "ajax_post", "class" => "clearfix"));?>
	<?php echo Form::textarea("personal_post", "", array("class" => "auto-resize", "id" => "personal_post", "placeholder" => __("What's on your mind"))); ?>
	<?php echo Form::button(NULL, __('Send'), array('class' => 'fr button button-green')); ?>
	<?php echo Form::input("user_id", $user->id, array("type" => "hidden", "id" => "user_id"));?>
	<?php echo Form::close(); ?>
	<h3><?php echo __("News feed"); ?></h3>
	<ul id="newsfeed" class="listing list-view">
		<?php echo $news_feeds; ?>
	</ul>
	</section>
</div>

<div class="preview-pane grid_2 alpha omega">
	<h3><?php echo __("Complete"); ?></h3>
	<?php echo Html::progress(20, "20%"); ?>
	<?php echo Html::anchor("user/edit/".$user->id, __("Edit my profile"), array("class" => "fr")); ?>
	<div class="clear"></div>
	<hr>
	<h4><?php echo __("You may know ?"); ?></h4>
	<ul class="list-item">
		<?php for ($i = 0; $i < 4; $i++): ?>
		<li class="clearfix">
			<figure class="avatar fl">
				<?php echo Html::anchor("user/view/", Html::image("assets/images/user_32.png")); ?>
			</figure>
			<div class="action-buttons clearfix fr">
				<?php echo Html::anchor("ajax/add_user/123", "<span class='add'></span>" . __("Add contact"), array("class" => "modalInput button button-gray no-text", 'rel' => '#confirm', 'data-message' => __("Are you sure you want to add :user to your contacts ?", array(':user' => 'Paul Smith')))); ?>
			</div>
			<b><?php echo Html::anchor("user/view", 'Displayname');?></b><br />
			<small>Function</small>
		</li>
		<?php endfor; ?>
	</ul>
	<hr>
	<?php echo Html::anchor("user/edit", __("View all"), array("class" => "fr")); ?>
	<div class="content">
	</div>

</div>
