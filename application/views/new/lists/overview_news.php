<!-- TITLE -->
<h3 class="other">
  <span class="newspaper"></span>
  <?php echo __("My news"); ?>
</h3>

<!-- CONTENT -->
<?php echo $content; ?>

<!-- SEE MORE -->
<?php if($more) { ?>
<div class="ar more">
  <hr>
  <?php echo Html::anchor("user/news", __("see all"));?>
</div>
<?php } ?>
