
<!-- user input dialog -->
<div class="widget modal" id="resume_add_graduation" style="width: 800px; top: 50px !important;">
	<header>
	<h2><?php echo __("New Graduation"); ?></h2>
	</header>
	<section>
	<?php echo Form::open("/resume/add_graduation/rid/" . $resume->id, array("class" => "form", "novalidate" => "true")); ?>
		<div id="flight">
			<label style="text-align: center; font-size: 20px; color: #F3FA21; "><?php echo __("Dates"); ?> &raquo;</label>
			<label>
				<?php echo __("Begin") . "<em>*</em>"; ?> <br />  
				<input type="text" name="begin" value="Today" class="datepicker" required="required" /> 
			</label>
			<label>
				<?php echo __("End") . "<em>*</em>"; ?><br /> 
				<input type="text" name="end" data-value="7" value="After one week" class="datepicker" required="required"/> 
			</label>
		</div>

		<?php echo Form::label("school", __("School : <em>*</em><small>" . __('Enter your school name') ."</small>"));?>
		<?php echo Form::input("school", isset($post['school'])? $post['school'] : "", array('type' => 'text', 'id' => 'school', 'class' => 'autocomplete', "required" => "required", "data-collection" => "school", "data-field" => "name", "autocomplete" => "off")); ?>
		<?php echo Form::select("level", $graduations, isset($post['level'])? $post['level'] : "", array('type' => 'text', 'id' => 'level', "required" => "required")); ?>

		<?php echo Form::label("speciality", __("Speciality : <em>*</em><small>" . __('Your main qualification') ."</small>"));?>
		<?php echo Form::input("speciality", null, array('type' => 'text', 'class' => '', "required" => "required")); ?>

		<?php echo Form::label("country", __("Location : <em>*</em><small>" . __('Enter your school city location') ."</small>"));?>
		<?php echo Form::select("country", $countries, $post['country'], array('type' => 'text', 'id' => 'country', "required" => "required", "data-collection" => "sector", "data-field" => "name", "autocomplete" => "off")); ?>
		<?php echo Form::input("city", $post['city'], array('id' => '', 'type' => 'text', 'class' => 'medium autocomplete', "required" => "required", "placeholder" => __("City name"), "data-collection" => "place", "data-field" => "name", "data-scope" => "type", "data-scope-value" => "city", "autocomplete" => "off")); ?>
		<?php echo Form::input("zip", $post['zip'], array('type' => 'text', 'class' => 'medium', "required" => "required", "placeholder" => __("Zip code"))); ?>


		<?php echo Form::label("description", "Description : <em>*</em><small>" . __('main tasks') ."</small>");?>
		<?php echo Form::textarea("description", null, array('type' => 'text', 'class' => '', "required" => "required", "rows" => "9")); ?>

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
