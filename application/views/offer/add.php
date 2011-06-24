<header>
	<?php echo $header_tools; ?>
	<?php echo $header_title; ?>
</header>
<section class="container_6 clearfix">
 
  <?php echo Message::display(); ?>
  
	<?php echo Form::open('offer/add/' . $firm->id, array('id'=>'announceForm', 'class' => 'form', 'novalidate' => 'true'));  ?>
		<h3><?php echo __("Offer description"); ?></h3>
		<fieldset>

			<?php echo Form::label("title", __("Title") . " <em>*</em><small>" . __('Enter your announce title') ."</small>"); ?>
      		<?php echo Form::input('title', $post['title'], array('type' => 'text', 'id' => 'title', 'class' => 'half', "required" => "required")); ?>

			<?php echo Form::label("description", __("Description") . " <em>*</em><small>" . __("Describe your skills research") ."</small>"); ?>
			<?php echo Form::textarea("description", $post['description'], array("class" => "half", "id" => "description", "rows" =>  15, "required" => "required")); ?>

		</fieldset>
		
		<h3><?php echo __("Offer location"); ?></h3>
		<fieldset>

			<?php echo Form::label("place", __("Place") . " <em>*</em><small>" . __('(ie Empire state bulding)') ."</small>"); ?>
			<?php echo Form::input("place", $post['place'], array("class" => "half", "id" => "place", "required" => "required")); ?>

			<?php echo Form::label("address", __("Address") . " <em>*</em><small>" . __("Enter announce's address") ."</small>"); ?>
			<?php echo Form::input("address", $post['address'], array("class" => "half", "id" => "address", "required" => "required")); ?>

			<?php echo Form::label("city", __("City") . " <em>*</em>"); ?>
			<?php echo Form::input("city", $post['city'], array("class" => "half", "id" => "city", "required" => "required")); ?>

			<?php echo Form::label("zip", __("Zip code") . " <em>*</em>"); ?>
			<?php echo Form::input("zip", $post['zip'], array("class" => NULL, "id" => "zip", "required" => "required")); ?>

			<?php echo Form::label("country", __("Country") . " <em>*</em>"); ?>
			<?php echo Form::select("country", $countries, $post['country'], array("class" => NULL, "id" => "country", "required" => "required")); ?>

		</fieldset>
		
		<h3><?php echo __("Announce details"); ?></h3>
		<fieldset>

			<?php echo Form::label("begin", __("Begin date") . " <em>*</em><small>" . __('mm/dd/yyyy') ."</small>"); ?>
			<?php echo Form::input("begin", $post['begin'], array("class" => NULL, "id" => "begin", "type" => "date", "required" => "required")); ?>

			<?php echo Form::label("end", __("End date") . " <em>*</em><small>" . __('mm/dd/yyyy') ."</small>"); ?>
			<?php echo Form::input("end", $post['end'], array("class" => NULL, "id" => "end", "type" => "date", "required" => "required")); ?>

			<?php echo Form::label("endsof", __("Registration Ends of") . " <em>*</em><small>" . __('mm/dd/yyyy') ."</small>"); ?>
			<?php echo Form::input("endsof", $post['endsof'], array("class" => NULL, "id" => "endsof", "type" => "date", "required" => "required")); ?>

			<?php echo Form::label("currency", __("Currency") . "<small>" . __('Choose your currrency') ."</small>"); ?>
			<?php echo Form::select("currency", $currencies, $post['currency'], array("class" => NULL, "id" => "currency")); ?>

			<?php echo Form::label("pcondition", __("Periodicity") . "<small>" . __('Choose your payment status') ."</small>"); ?>
			<?php echo Form::select("pcondition", $pcondition, $post['pcondition'], array("class" => NULL, "id" => "pcondition")); ?>

			<?php echo Form::label("remuneration", __("Remuneration") . "<small>" . __('Remuneration (in Thousand)') ."</small>", array()); ?>
			<?php echo Form::input("remuneration", $post['remuneration'], array("class" => "ar", "id" => "remuneration", "type" => "range", "min" => 1, "max" => 100, "alt" => "")); ?>

			<label for="graduation">
				<?php echo __("Graduation"); ?>
				<small><?php echo __("Select one or multiple graduations<br> (Ctrl + select)"); ?></small>
			</label>
			<?php echo Form::select("graduations", $graduations, $post['graduations'], array("multiple" => "multiple", "id" => "graduation", "class" => "half"));?>

			<label for="sectors">
				<?php echo __("Sectors"); ?>
				<small><?php echo __("Select one or multiple industries<br> (Ctrl + select)"); ?></small>
			</label>
			<?php echo Form::select("sectors", $sectors, $post['sectors'], array("multiple" => "multiple", "id" => "experience", "class" => "half"));?>

			<label for="experience">
				<?php echo __("Experience"); ?>
				<small><?php echo __("Select one or multiple experiences<br> (Ctrl + select)"); ?></small>
			</label>
			<?php echo Form::select("experiences", $experiences, $post['experiences'], array("multiple" => "multiple", "id" => "experience", "class" => "half"));?>

			<label for="jobs">
				<?php echo __("Job"); ?>
				<small><?php echo __("Select one or multiple functions<br> (Ctrl + select)"); ?></small>
			</label>
			<?php echo Form::select("jobs", $job_types, $post['jobs'], array("multiple" => "multiple", "id" => "graduation", "class" => "half"));?>

      	</fieldset>

		<h3><?php echo __("Contract type"); ?></h3>
		<fieldset>
			<p class="terms">
	      <?php foreach ($contracts as $key => $value) { ?>
	      	<span>
	         <?php echo Form::input('ocontracts[]', FALSE, array('id' => 'contract_' . $key, 'type' => 'checkbox', 'class' => 'choice')); ?>
	         <?php echo Form::label('contract_' . $key, $value, array('class' => 'choice')); ?>
			</span><br/>
	      <?php } ?>
	      	</p>
      	</fieldset>

		<h3><?php echo __("Job types"); ?></h3>
		<fieldset>
			<p class="terms">
	      <?php foreach ($job_types as $key => $value) { ?>
	      	<span>
	         <?php echo Form::input('job_type_' . $key, FALSE, array('id' => 'job_type_' . $key, 'type' => 'checkbox', 'class' => 'ar')); ?>
	         <?php echo Form::label('job_type_' . $key, $value, array('class' => 'choice')); ?>
			</span><br/>
	      <?php } ?>
	      </p>
      	</fieldset>

		<div class="action ar">
			<?php echo __(':simple_gray :big_green', array(
		        	':big_green'=>Form::button("valid", __('Submit'), array('class'=>'button button-green')),
		            ':simple_gray'=>Form::button("reset", __('Reset'), array('type'=>'reset', 'class'=>'button button-gray')),
				)); ?>
		</div>

	<?php echo Form::close(); ?>
</section>