<h3>Edit Note</h3>
<?php echo Form::open(); ?>
    <textarea required="required" style="height: 200px; width: 97%;" placeholder="<?php echo __("Write a comment..."); ?>"></textarea>
    <hr />
    <?php echo Form::button(NULL, '<span class="accept"></span>' . __('Add note'), array('class' => 'button button-gray')); ?>
    <?php echo Form::button(NULL, __('Cancel'), array('class' => 'button button-gray close')); ?>
<?php echo Form::close(); ?>