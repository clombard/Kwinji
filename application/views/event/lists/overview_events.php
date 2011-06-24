<h3 class="other">
  <span class="calendar"></span>
  <?php echo __("My events"); ?>
</h3>
  <?php echo $content; ?>

<?php if($more) { ?>
<div class="ar more">
  <hr>
  <?php echo Html::anchor("user/events", __("see all"), array("class" => ""));?>
</div>
<?php } ?>
