<!-- user input dialog --><div class="widget modal" id="firm_add_contact">	<header>	<h2><?php echo __("Add new contact"); ?></h2>	</header>	<section>	<!-- input form. you can press enter too -->	<?php echo Form::open("#", array("class" => "")); ?>		<?php echo Form::label("mytags", __("Choose contacts : "));?><br>		<ul id="mytags" class="full"></ul>		<?php echo Form::label("group", __("Groups : "));?><br>		<?php echo Form::select("group", $firm->groups, NULL);?>		<div class="clear"></div>		<hr>		<div class="ar">			<?php echo __(':simple_gray :big_green', array(		        	':big_green'=>Form::button("valid", __('Submit'), array('class'=>'button button-green')),		            ':simple_gray'=>Form::button("reset", __('Reset'), array('type'=>'reset', 'class'=>'button button-gray')),				)); ?>		</div>	<?php echo Form::close(); ?>	</section></div>