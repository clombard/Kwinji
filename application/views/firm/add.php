<header>
	<?php echo $header_tools; ?>
	<?php echo $header_title; ?>
</header>
<section class="container_6 clearfix">
	
	<?php echo Message::display(); ?>
	
	<?php echo Form::open('firm/add', array('id' => 'companyForm', 'name' => 'companyForm', 'class' => 'form', 'method' => 'post'));  ?>

		<h3><?php echo __("Main informations"); ?></h3>
		<fieldset>

			<?php echo Form::label("name", __("Company name") . " <em>*</em><small>" . __('Official name of your company') ."</small>"); ?>
			<?php echo Form::input("name", $post['name'], array("class" => "half", "required" => "required")); ?>

			<?php echo Form::label("identity", __("RCS") . " <em>*</em><small>" . __('Unique ID of your company') ."</small>"); ?>
			<?php echo Form::input("identity", $post['identity'], array("class" => "half", "required" => "required")); ?>

			<?php echo Form::label("ca", __("Turnover") . " <em>*</em><small>" . __('In thousands ($, €, £, ¥)') ."</small>"); ?>
			<?php echo Form::input("ca", $post['turnover'], array("class" => "", "required" => "required")); ?>

			<?php echo Form::label("currency", __("Currency") . " <em>*</em><small>" . __('Select your currnecy') ."</small>"); ?>
			<?php echo Form::select("currency", $currencies, $post['currency'], array("class" => "", "required" => "required")); ?>

			<?php echo Form::label("employees", __("Employees") . "<small>" . __('Select your range staff') ."</small>"); ?>
			<?php echo Form::select("employees", $firm_staff, $post['firm_staff'], array("class" => "")); ?>

			<?php echo Form::label("industry", __("Industry") . $sector->id . " <em>*</em><small>" . __('Select your industry') ."</small>"); ?>
			<?php echo Form::select("industry", $sectors, $post['industry'], array("class" => "", "required" => "required")); ?>

		</fieldset>
		
		<h3><?php echo __("Location / Contacts"); ?></h3>
		<fieldset>

			<?php echo Form::label("place", __("Place") . " <em>*</em><small>" . __('(e.g. Empire state bulding)') ."</small>"); ?>
			<?php echo Form::input("place", $post['street_details'], array("class" => "half", "id" => "place", "required" => "required")); ?>

			<?php echo Form::label("address", __("Address") . " <em>*</em><small>" . __("Enter your address") ."</small>"); ?>
			<?php echo Form::input("address", $post['street'], array("class" => "half", "id" => "address", "required" => "required")); ?>

			<?php echo Form::label("city", __("City") . " <em>*</em>"); ?>
			<?php echo Form::input("city", $post['city'], array("class" => "half", "id" => "city", "required" => "required")); ?>

			<?php echo Form::label("zip", __("Zip code") . " <em>*</em>"); ?>
			<?php echo Form::input("zip", $post['zip'], array("class" => "", "id" => "zip", "required" => "required")); ?>

			<?php echo Form::label("country", __("Country") . " <em>*</em>"); ?>
			<?php echo Form::select("country", $countries, $post['country'], array("class" => NULL, "id" => "country", "required" => "required")); ?>

			<?php echo Form::label("website", __("Web site")); ?>
			<?php echo Form::input("website", $post['website'], array("class" => "half", "placeholder" => "http://", "type" => "url")); ?>

			<?php echo Form::label("std", __("Phone number (Standard)")); ?>
			<?php echo Form::input("std", $post['std'], array("class" => "", "alt" => "phone")); ?>

			<?php echo Form::label("fax", __("Phone number (Fax)")); ?>
			<?php echo Form::input("fax", $post['fax'], array("mask" => "phone", "type" => "text", "alt" => "phone", "class" => "{mask:'555-666'}")); ?>

		</fieldset>
			<div class="action ar">
					<?php echo __(':simple_gray :big_green', array(
			        	':big_green'=>Form::button("valid", __('Submit'), array('class'=>'button button-green')),
			            ':simple_gray'=>Form::button("reset", __('Reset'), array('type'=>'reset', 'class'=>'button button-gray')),
					)); ?>
			</div>

	<?php echo Form::close(); ?>
</section>