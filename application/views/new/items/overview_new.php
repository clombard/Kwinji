<h4>
<?php echo HTML::anchor('new/view/'.$new->id, $new->details['title']); ?>
<?php if(isset($new->ref_firm->details['name'])) { ?>
<?php echo ' ('. $new->ref_firm->details['name'] .')'; ?>
<?php } ?>
</h4>
<p>
	<?php echo $new->details['teaser']; ?>
  <span class="timestamp"><?php echo date("d M", $new->dates['created']);?> </span>
</p>
