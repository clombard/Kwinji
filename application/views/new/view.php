<header>
	<?php echo $header_tools; ?>
	<?php echo $header_title; ?>
</header>
<section class="container_6 clearfix">
	<div class="grid_2 ac alpha">
		<figure class="avatar">
			<?php $image = "static/img/preview-not-available.gif"; ?>
			<?php if ($news->image != NULL): ?>
				<?php $image = $news->image;?>
			<?php elseif ($news->_firm->logo != NULL): ?>
				<?php $image = $news->_firm->logo; ?>
			<?php endif; ?>
			<?php echo HTML::image($image);?>
		</figure>
	</div>
	<div class="grid_4 omega">
		<h2><abbr><?php echo $news->details['teaser']; ?></abbr></h2>
		<small><?php echo date("l d F Y @ H:i", $news->dt_published); ?></small>
		<hr>
		<?php if (count($news->keywords) > 0):?>
		<p>
			<b><?php echo __("Tags : "); ?></b>
			<?php $index = 0; ?>
			<?php foreach ($news->keywords as $tag): ?>
				<?php echo HTML::anchor("#", $tag, array('class' => 'tag')) . " "; ?>
			<?php endforeach; ?>
		</p>
		<hr>
		<?php endif; ?>
		<p><?php echo $news->details['text']; ?></p>
		<hr>
		<p class="ar">
			<small>
	<?php echo __("By "); ?>
	<?php echo HTML::anchor("user/view/" . $news->_user->id, $news->_user->displayname, array("title" => $news->_user->function)) . " "; ?>
	<?php $item = 0; ?>
	<?php foreach ($news->_users as $contributor): ?>
		<?php $item++; ?>
		<?php echo HTML::anchor("user/view/" . $contributor->id, $contributor->displayname, array("title" => $contributor->function)) . " "; ?>
		<?php if (count($news->_users) == $item + 1 ): ?> &amp; <?php elseif (count($news->_users) > $item + 1): ?>, <?php endif; ?>
	<?php endforeach; ?>
			</small>
		</p>
	</div>
</section>