<!-- Block title -->
<h3 class="other">
  <span class="application_cascade"></span>
  <?php echo __('My offers'); ?>
</h3>

<!-- Block content -->
<?php echo $content; ?>

<!-- See more link -->
<?php if($more) { ?>
<div class="ar more">
  <hr>
  <?php echo Html::anchor('user/offers', __('see all')); ?>
</div>
<?php } ?>