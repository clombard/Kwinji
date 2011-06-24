<h4>
	<?php echo Html::anchor("event/view/". $event->id, $event->details['name']); ?>
  <?php if (isset($event->ref_firm->details['name'])) { ?>
	<?php echo ' ('. $event->ref_firm->details['name'] .')'; ?>
  <?php } ?>
</h4>
<p>
	<?php echo date("d M Y, H:i", $event->dates['starts']); ?>
  <span class="timestamp"><?php echo Html::anchor("event/delete/". $event->id, __('delete')); ?> </span>
</p>
