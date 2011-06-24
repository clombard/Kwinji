<h3><?php echo __('Unset translations'); ?></h3>

<table class="display stylized" id="example">
  <thead>
    <tr>
      <th><?php echo __('Language'); ?></th>
      <th><?php echo __('Original string'); ?></th>
      <th><?php echo __('Translation'); ?></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($translations as $translation) { ?>
  <?php $lang = $translation->lang; ?>
	<?php foreach ($translation->strings as $item) { ?>
      <tr>
    <td><?php echo $lang; ?></td>
    <td><?php echo $item['string']; ?></td>
    <td><?php echo $item['translation']; ?></td>
      </tr>
  <?php } ?>
  <?php } ?>
  </tbody>
  <tfoot>
    <tr>
      <th><?php echo __('Language'); ?></th>
      <th><?php echo __('Original string'); ?></th>
      <th><?php echo __('Translation'); ?></th>
    </tr>
  </tfoot>
</table>
