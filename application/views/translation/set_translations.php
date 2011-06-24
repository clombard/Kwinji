<h3><?php echo __('Translations'); ?></h3>
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
      <tr>
        <td><?php echo $translation->lang; ?></td>
        <td><?php echo $translation->string; ?></td>
        <td><?php echo $translation->translation; ?></td>
      </tr>
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
