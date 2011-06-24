<?php if (!empty($all_firms)): ?>
	<?php $item = 0; ?>
	<?php $logo = "static/img/preview-not-available.gif"; ?>
	<?php $vignet_class = "width1 column ta-center"; ?>
	<?php $industry = ""; ?>
	<?php foreach ($all_firms as $key => $value): ?>
		<?php $industryItem = $value['industry']; ?>
		<?php $item++; ?>
		<?php if (($item % 6) == 0 || ($industry != $industryItem && $item != 1)): ?>
	</div>
</div>
<div class="colgroup">
	<div class="width6 column first">
		<?php elseif ($item == 1): ?> <!-- IF IT'S FIRST  -->
<div class="colgroup">
	<div class="width6 column first">
		<?php endif; ?>
		<?php if ($industry != $industryItem): ?>
			<?php $industry = $industryItem; ?>
	<p class="subtitle"><?php echo $industry; ?></p>
	<hr>
		<?php endif; ?>
	<div class="<?php echo $vignet_class; ?>">
		<?php echo HTML::anchor("firms/view/".$key, HTML::image($logo), array("class" => "no-style")); ?><br />
		<?php echo $value['name']; ?><br />
	</div>
	<?php endforeach; ?>
<?php endif; ?>
	</div>
</div>
