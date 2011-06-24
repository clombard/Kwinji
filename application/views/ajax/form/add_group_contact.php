	<?php echo Form::open('#', array('id'=>'contactGroupForm', 'class' => 'form-validator', 'onsubmit'=>'return false;'));  ?>

		<fieldset>
			<legend><?php echo __("Add New Contact Group"); ?></legend>
			<div class="column width1 first">&nbsp;</div>
			<div class="column width7">
				<div class="column width4 first">
					<p>
						<?php echo Form::label("title", __("Group name :"), array("class" => "required")); ?><br />
						<?php echo Form::input("title", "", array("class" => "full title", "id" => "title")); ?>
					</p>
				
						<p>
							<?php echo Form::label("description", __("Description :")); ?><br />
							<?php echo Form::textarea("description", "", array("class" => "medium full", "id" => "description")); ?>
						</p>

				</div>
				<div class="column width3">
					<p>
						<?php echo Form::label("", __("Access right :")); ?><br />
						<?php echo Form::checkbox("right", "comment", false, array("id" => "right1", "class" => "choice")); ?>
						<?php echo Form::label("right1", __("Update profile infos")); ?><br />

						<?php echo Form::checkbox("right", "public", false, array("id" => "right7", "class" => "choice")); ?>
						<?php echo Form::label("right7", __("Update profile description")); ?><br />

						<?php echo Form::checkbox("right", "invit", false, array("id" => "right2", "class" => "choice")); ?>
						<?php echo Form::label("right2", __("Create / Delete News post")); ?><br />

						<?php echo Form::checkbox("right", "attendees", false, array("id" => "right3", "class" => "choice")); ?>
						<?php echo Form::label("right3", __("Create / Delete Announce")); ?><br />

						<?php echo Form::checkbox("right", "public", false, array("id" => "right4", "class" => "choice")); ?>
						<?php echo Form::label("right4", __("Add New Contact Group")); ?><br />

						<?php echo Form::checkbox("right", "public", false, array("id" => "right5", "class" => "choice")); ?>
						<?php echo Form::label("right5", __("Add New Contact")); ?><br />

						<?php echo Form::checkbox("right", "public", false, array("id" => "right6", "class" => "choice")); ?>
						<?php echo Form::label("right6", __("Manage Right Access")); ?><br />
					</p>
				
				</div>

			</div>

		</fieldset>

		<fieldset>
			<legend><?php echo __("Confirm"); ?></legend>
			<p class="ta-right">
				<?php echo __(':simple_gray or :big_green', array(
		        	':big_green'=>Form::submit(null, __('Submit'), array('class'=>'btn btn-green big')),
		            ':simple_gray'=>Form::submit(null, __('Reset'), array('type'=>'reset', 'class'=>'btn')),
				)); ?>
			</p>
	
		</fieldset>
	
	<?php echo Form::close(); ?>