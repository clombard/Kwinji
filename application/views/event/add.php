<header>
	<?php echo $header_tools; ?>
	<?php echo $header_title; ?>
</header>
<section class="container_6 clearfix">
	<?php echo Message::display(); ?>
	<?php $form_url = 'event/add'; ?>
	<?php if ($firm != NULL): ?>
		<?php $form_url .= "/fid/". $firm->id; ?>
	<?php endif; ?>
	<?php echo Form::open($form_url, array('id'=>'eventForm', 'class' => 'form', 'novalidate' => 'true'));  ?>

		<h3><?php echo __("Create New Event"); ?></h3>

		<fieldset>
			<?php echo Form::input("event_id", $post['id'], array("class" => "half", "type" => "hidden")); ?>

			<?php echo Form::label("title", __("Title") . " <em>*</em><small>" . __("Enter your event title") ."</small>"); ?>
			<?php echo Form::input("title", $post['title'], array("class" => "half", "id" => "title", "required" => "required")); ?>

			<?php echo Form::label("teaser", __("Teaser") . " <em>*</em><small>" . __("About your event") ."</small>"); ?>
			<?php echo Form::input("teaser", $post['teaser'], array("class" => "half", "id" => "teaser", "required" => "required")); ?>

			<?php echo Form::label("description", __("Description") . " <em>*</em><small>" . __("Describe this event") ."</small>"); ?>
			<?php echo Form::textarea("description", $post['description'], array("class" => "half", "id" => "description", "rows" => 10, "required" => "required")); ?>

			<?php echo Form::label("mytags", __("Tags") . "<small>" . __('Keywords to index your post') ."</small>"); ?>
			<ul class="mytags">
			<?php if (isset($post["tags"]) && count($post['tags']) > 0): ?>
				<?php for ($i = 0; $i < count($post['tags']); $i++): ?>
				<li class="tagit-choice">
				<?php echo $post['tags'][$i]; ?>
				</li>
				<?php endfor; ?>
			<?php endif; ?>
			</ul>

			<?php echo Form::label("category", __("Category") . " <em>*</em><small>" . __('Select your currnecy') ."</small>"); ?>
			<?php echo Form::select("category", $event_categories, $post['category'], array("class" => "", "required" => "required")); ?>

			<?php echo Form::label("begin", __("Begin date") . " <em>*</em><small>" . __("mm/dd/yyyy") ."</small>"); ?>
			<?php echo Form::input("begin", $post['begin'], array("class" => "datetimepicker", "type" => "text", "style" => "width: 110px;", "id" => "begin", "required" => "required")); ?>

			<?php echo Form::label("end", __("End date") . " <em>*</em><small>" . __("mm/dd/yyyy") ."</small>"); ?>
			<?php echo Form::input("end", $post['end'], array("class" => "datetimepicker", "type" => "text", "style" => "width: 110px;", "id" => "end", "required" => "required")); ?>

			<?php echo Form::label("endsof", __("Registration Ends of") . " <em>*</em><small>" . __("mm/dd/yyyy") ."</small>"); ?>
			<?php echo Form::input("endsof", $post['endsof'], array("class" => "", "type" => "date", "id" => "endsof", "required" => "required")); ?>

			<?php echo Form::label("attendees", __("Limit of attendees") . " <em>*</em><small>" . __("Define the limit") ."</small>"); ?>
			<?php echo Form::input("attendees", $post['attendees'], array("class" => "", "alt" => "integer", "style" => "width: 80px;", "id" => "attendees", "required" => "required", "placeholder" => "300")); ?>

			<?php echo Form::label("contribution", __("Contribution")); ?>
			<?php echo Form::input("contribution", $post['contribution'], array("type" => "text", "alt" => "decimal", "style" => "width: 80px;", "id" => "contribution", "placeholder" => "0")); ?>

			<?php echo Form::label("currency", __("Currency") . " <em>*</em><small>" . __('Select your currnecy') ."</small>"); ?>
			<?php echo Form::select("currency", $currencies, $post['currency'], array("class" => "", "required" => "required")); ?>

		</fieldset>

		<h3><?php echo __("Location"); ?></h3>
		<fieldset>

			<?php echo Form::label("place", __("Place") . " <em>*</em><small>" . __('(ie Empire state bulding)') ."</small>"); ?>
			<?php echo Form::input("place", $post['place'], array("class" => "half", "id" => "place", "required" => "required")); ?>

			<?php echo Form::label("address", __("Address") . " <em>*</em><small>" . __("Enter your event address") ."</small>"); ?>
			<?php echo Form::input("address", $post['address'], array("class" => "half", "id" => "address", "required" => "required")); ?>

			<?php echo Form::label("city", __("City") . " <em>*</em>"); ?>
			<?php echo Form::input("city", $post['city'], array("class" => "half", "id" => "city", "required" => "required")); ?>

			<?php echo Form::label("zip", __("Zip code") . " <em>*</em>"); ?>
			<?php echo Form::input("zip", $post['zip'], array("class" => NULL, "id" => "zip", "required" => "required")); ?>

			<?php echo Form::label("country", __("Country") . " <em>*</em>"); ?>
			<?php echo Form::select("country", $countries, $post['country'], array("class" => NULL, "id" => "country", "required" => "required")); ?>

		</fieldset>
		
		<h3><?php echo __("Options"); ?></h3>
		<fieldset>

			<p class="terms">
				<span>
					<?php echo Form::checkbox("eventOption", "comment", false, array("id" => "evtOpt1", "class" => "choice")); ?>
					<?php echo Form::label("evtOpt1", __("Allows comment")); ?>
				</span><br />
				<span>
					<?php echo Form::checkbox("eventOption", "invit", false, array("id" => "evtOpt2", "class" => "choice")); ?>
					<?php echo Form::label("evtOpt2", __("Allows invit others members")); ?>
				</span><br />
				<span>
					<?php echo Form::checkbox("eventOption", "attendees", false, array("id" => "evtOpt3", "class" => "choice")); ?>
					<?php echo Form::label("evtOpt3", __("Limit count of attendees")); ?>
				</span><br />
				<span>
					<?php echo Form::checkbox("eventOption", "public", false, array("id" => "evtOpt4", "class" => "choice")); ?>
					<?php echo Form::label("evtOpt4", __("It's a public event ?")); ?>
				</span>
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