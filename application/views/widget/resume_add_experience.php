
<!-- user input dialog -->
<div class="widget modal" id="resume_add_experience" style="width: 800px; top: 50px !important;">
	<header>
	<h2><?php echo __("New Experience"); ?></h2>
	</header>
	<section>
	<!-- input form. you can press enter too -->
	<?php echo Form::open("/resume/add_experience/rid/" . $resume->id, array("class" => "form", "novalidate" => "true")); ?>
		<div id="flight">
			<label style="text-align: center; font-size: 20px; color: #F3FA21; "><?php echo __("Dates"); ?> &raquo;</label>
			<label>
				<?php echo __("Begin") . "<em>*</em>"; ?> <br />  
				<input type="text" name="begin" value="<?php echo isset($post['begin'])? $post['begin'] : __("Today"); ?>" class="datepicker" "required"="required" /> 
			</label>
			<label>
				<?php echo __("End"); ?><br /> 
				<input type="text" name="end" data-value="7" value="<?php echo isset($post['end'])? $post['end'] : __("After one week"); ?>" class="datepicker" /> 
			</label>
		</div>

		<?php echo Form::label("firm", __("Company : <em>*</em><small>" . __('Enter your firm name') ."</small>"));?>
		<?php echo Form::input("firm", isset($post['firm'])? $post['firm'] : "", array('type' => 'text', 'id' => 'firm', 'class' => 'autocomplete', "required" => "required", "data-collection" => "firm", "data-field" => "name", "autocomplete" => "off")); ?>

		<?php echo Form::label("industry", __("Industry : <em>*</em><small>" . __('Enter your firm industry') ."</small>"));?>
		<?php echo Form::select("industry", $industries, isset($post['industry'])? $post['industry'] : NULL, array('type' => 'text', 'id' => 'industry', 'class' => 'half', "required" => "required", "data-collection" => "sector", "data-field" => "name", "autocomplete" => "off")); ?>

		<?php echo Form::label("function", __("Function : <em>*</em><small>" . __('Your job function') ."</small>"));?>
		<?php echo Form::input("function", isset($post['function'])? $post['function'] : "", array('type' => 'text', 'id' => 'function', 'class' => '', "required" => "required")); ?>

		<?php echo Form::label("country", __("Location : <em>*</em><small>" . __('Enter your job city location') ."</small>"));?>
		<?php echo Form::select("country", $countries, $post['country'], array('type' => 'text', 'id' => 'country', "required" => "required", "data-collection" => "sector", "data-field" => "name", "autocomplete" => "off")); ?>
		<?php echo Form::input("city", $post['city'], array('id' => '', 'type' => 'text', 'class' => 'medium autocomplete', "required" => "required", "placeholder" => __("City name"), "data-collection" => "place", "data-field" => "name", "data-scope" => "type", "data-scope-value" => "city", "autocomplete" => "off")); ?>
		<?php echo Form::input("zip", $post['zip'], array('type' => 'text', 'class' => 'medium', "required" => "required", "placeholder" => __("Zip code"))); ?>

		<?php echo Form::label("description", "Description : <em>*</em><small>" . __('main tasks') ."</small>");?>
		<?php echo Form::textarea("description", isset($post['description'])? $post['description'] : "", array( 'id' => 'description', 'class' => '', "required" => "required", "rows" => "9")); ?>

		<?php echo Form::label("mytags", "Qualifications : <small>" . __('eg. marketing, high technology') ."</small>");?>
		<ul class="mytags">
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
