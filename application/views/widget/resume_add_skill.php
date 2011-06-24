
<!-- user input dialog -->
<div class="widget modal" id="resume_add_skill" style="width: 600px; ">
	<header>
		<h2><?php echo __("New Training"); ?></h2>
	</header>
	<section>
	<!-- input form. you can press enter too -->
	<?php echo Form::open("resume/add_skill/rid/" . $resume->id, array("class" => "form", "novalidate" => "true")); ?>

		<?php echo Form::label("item", __("Skill : <em>*</em><small>" . __('Skill item') ."</small>"));?>
		<?php echo Form::input("item", null, array('type' => 'text', 'id' => 'item', 'class' => 'autocomplete', "required" => "required", "data-collection" => "skill", "data-field" => "name", "autocomplete" => "off")); ?>

		<?php echo Form::input("type", "column", array("type" => "hidden")); ?>

		<?php echo Form::label("value", __("Level : <em>*</em><small>" . __('Define your value') ."</small>"));?>
		<?php echo Form::input("value", NULL, array("class" => "ar", "id" => "value", "type" => "range", "min" => 1, "max" => 100, "alt" => "")); ?>
		<div class="clear"></div>
		<hr>
		<div class="ar">
			<?php echo __(':simple_gray :big_green', array(
		        	':big_green'=>Form::button("valid", __('Submit'), array('class'=>'button button-green')),
		            ':simple_gray'=>Form::button("reset", __('Reset'), array('type'=>'reset', 'class'=>'button button-gray')),
				)); ?>
		</div>
	<?php echo Form::close(); ?>
	</section>
</div>
