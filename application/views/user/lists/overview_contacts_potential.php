<!-- Display list title -->
<h3 class="other">
  <span class="group"></span>
  <?php echo __("Potential contacts");?>
</h3>

<!-- Display potential contacts -->
<?php echo $content; ?>

<!-- Display see more -->
<?php if($more) { ?>
<div class="ar more">
  <hr>
  <?php echo Html::anchor('user/contacts', __('see all'));?>
</div>
<?php } ?>