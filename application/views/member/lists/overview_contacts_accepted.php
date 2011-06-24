<!-- Display list title -->
<h3 class="other">
  <span class="book"></span>
  <?php echo __("My contacts");?>
</h3>

<!-- Display accepted contacts -->
<?php echo $content; ?>

<!-- Display see more -->
<?php if($more) { ?>
<div class="ar more">
  <hr>
  <?php echo Html::anchor('user/contacts', __('see all'));?>
</div>
<?php } ?>
