<?php if (isset($header_title['titles']) && count($header_title['titles']) == 0): ?>
  <h2><?php echo $header_title['title']; ?></h2>
<?php else: ?>
<div class="view-switcher">
	<h2>
		<?php echo $header_title['title']; ?>
    <a href="<?php echo $header_title['url']; ?>">↓</a>
  </h2>
	<ul>
    <li><?php echo Html::anchor($header_title['url'], $header_title['title']); ?></li>
		<?php foreach ($header_title['titles'] as $title): ?>
      <li><?php echo $title; ?></li>
		<?php endforeach; ?>
	</ul>
</div>
<?php endif; ?>
