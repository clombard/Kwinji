
<!-- user input dialog -->
<div class="widget modal" id="resume_add_keyword" style="width: 700px;">
	<header>
	<h2><?php echo __("My Keywords"); ?></h2>
	</header>
	<section>
	<!-- input form. you can press enter too -->
	<?php echo Form::open("/resume/add_keywords/rid/" . $resume->id, array("class" => "form", "novalidate" => "true")); ?>
		<?php echo Form::label("mytags", "Keywords : <small>" . __('eg. marketing, high technology') ."</small>");?>
		<ul class="mytags half">
		<?php if (isset($resume->keywords) && count($resume->keywords) > 0): ?>
			<?php foreach ($resume->keywords as $keyword): ?>
			<li class="tagit-choice">
			<?php echo $keyword; ?>
			</li>
			<?php endforeach; ?>
		<?php endif; ?>
		</ul>
		<div class="clear"></div>
		<hr>
		<div class="ar">
			<?php echo __(':simple_gray :big_green', array(
		        	':big_green'=>Form::button("valid", __('Submit'), array('class'=>'button button-green', 'id' => 'valid')),
		            ':simple_gray'=>Form::button("reset", __('Reset'), array('type'=>'reset', 'class'=>'button button-gray')),
				)); ?>
		</div>
	<?php echo Form::close(); ?>
	</section>
</div>
