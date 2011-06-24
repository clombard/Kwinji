<h4>
	<?php echo Html::anchor('resume/view/'.  $resume->id, $resume->details['name']); ?> <?php echo __('(:x visits)', array(':x' => $resume->details['visits'])); ?>
</h4>
<?php echo HTML::progress($resume->details['completion'], $resume->details['completion']. '%'); ?>
