
<!-- user input dialog -->
<div class="widget modal" id="resume_add_training" style="width: 800px; ">
	<header>
	<h2><?php echo __("New Training"); ?></h2>
	</header>
	<section>
	<!-- input form. you can press enter too -->
	<?php echo Form::open("/resume/add_training/rid", array("class" => "form", "novalidate" => "true")); ?>
		<div id="flight">
			<label style="text-align: center; font-size: 20px; color: #F3FA21; "><?php echo __("Dates"); ?> &raquo;</label>
			<label>
				<?php echo __("Begin"); ?> <br />  
				<input type="text" name="begin" value="Today" class="datepicker" /> 
			</label>
			<label>
				<?php echo __("End") . "<em>*</em>"; ?><br /> 
				<input type="text" name="end" data-value="7" value="After one week" class="datepicker" /> 
			</label>
		</div>

		<?php echo Form::label("name", __("Training name : <em>*</em><small>" . __('or training reference') ."</small>"));?>
		<?php echo Form::input("name", null, array('type' => 'text', 'class' => '', "required" => "required")); ?>

		<?php echo Form::label("trainer", __("Trainer : <em>*</em><small>" . __('Trainer company name') ."</small>"));?>
		<?php echo Form::input("trainer", isset($post['trainer'])? $post['trainer'] : "", array('type' => 'text', 'id' => 'trainer', 'class' => 'autocomplete', "required" => "required", "data-collection" => "firm", "data-field" => "name", "autocomplete" => "off")); ?>

		<?php echo Form::label("content", "Description : <em>*</em><small>" . __('main tasks') ."</small>");?>
		<?php echo Form::textarea("content", null, array('type' => 'text', 'class' => '', "required" => "required", "rows" => "7")); ?>

		<?php echo Form::label("mytags", "Qualifications : <small>" . __('eg. lang, technology') ."</small>");?>
		<ul class="mytags half">
		<?php if (isset($post["tags"]) && count($post['tags']) > 0): ?>
			<?php for ($i = 0; $i < count($post['tags']); $i++): ?>
			<li class="tagit-choice">
			<?php echo $post['tags'][$i]; ?>
			</li>
			<?php endfor; ?>
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
