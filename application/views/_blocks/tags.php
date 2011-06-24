<header>
<h3><?php echo __("Tags"); ?></h3>
</header>
<section>
<div class="tagcloud">
	<?php if (isset($tags) && !empty($tags)): ?>
		<?php foreach ($tags as $tag=>$content): ?>
			<?php echo HTML::anchor($content['link'], $tag, array('class' => 'tag'.$content['cardinality'])); ?>
		<?php endforeach; ?>
	<?php endif; ?>
</div>
</section>

