
<!-- user input dialog -->
<div class="widget modal" id="resume_add_hobbie" style="width: 700px;">
	<header>
	<h2><?php echo __("My Hobbies"); ?></h2>
	</header>
	<section>
	<!-- input form. you can press enter too -->
	<?php echo Form::open("/resume/add_hobbies/rid/" . $resume->id, array("class" => "form", "novalidate" => "true")); ?>
		<?php echo Form::label("mytags", "Enter your hobbies : <small>" . __('eg. ski, soccer, skydive...') ."</small>");?>
		<ul class="mytags half">
		<?php $hobbies_count = count($resume->hobbies); ?>
		<?php if (isset($resume->hobbies) && $hobbies_count > 0): ?>
			<?php foreach ($resume->hobbies as $hobbie): ?>
			<li class="tagit-choice">
			<?php echo $hobbie; ?>
			</li>
			<?php endforeach; ?>
		<?php endif; ?>
		</ul>
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
