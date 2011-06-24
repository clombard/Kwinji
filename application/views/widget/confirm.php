
<!-- user input dialog -->
<div class="widget modal" id="confirm">
	<header>
	<h2><?php echo __("Confirm"); ?></h2>
	</header>
	<section>
		<!-- the external content is loaded inside this tag -->
		<p class="contentWrap"></p>
			<hr>
		<div class="ar">
			<?php echo __(':green :gray', array(
		        	':green' => Form::button("confirm", __('Confirm'), array('class'=>'button button-green close')),
		            ':gray' => Form::button(NULL, __('Cancel'), array('type'=>'reset', 'class'=>'button button-gray close')),
				)); ?>
		</div>
	</section>
</div>
