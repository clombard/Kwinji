
<!-- user input dialog -->
<div class="widget modal" id="new_message">
	<header>
	<h2><?php echo __("New Message"); ?></h2>
	</header>
	<section>
	<!-- input form. you can press enter too -->
	<?php echo Form::open("/messenger/add", array("class" => "form")); ?>
		<?php echo Form::label("to", __("To : "));?>
		<?php echo Form::input("to", null, array('type' => 'text', 'class' => 'full')); ?>
		<?php echo Form::label("subject", __("Subject : "));?>
		<?php echo Form::input("subject", null, array('type' => 'text', 'class' => 'full')); ?>
		<?php echo Form::label("content", "&nbsp;");?>
		<?php echo Form::textarea("content", null, array('type' => 'text', 'class' => 'full')); ?>
		<div class="clear"></div>
		<hr>
		<div class="ta-right">
			<?php echo __(':simple_gray :big_green', array(
		        	':big_green'=>Form::button("valid", __('Submit'), array('class'=>'button button-green')),
		            ':simple_gray'=>Form::button("reset", __('Reset'), array('type'=>'reset', 'class'=>'button button-gray')),
				)); ?>
		</div>
	<?php echo Form::close(); ?>
	</section>
</div>
