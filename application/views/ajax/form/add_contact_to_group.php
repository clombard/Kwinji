	<?php echo Form::open('#', array('id'=>'contactToGroupForm', 'class' => 'form-validator', 'onsubmit'=>'return false;'));  ?>

		<fieldset>
			<legend><?php echo __("Add New Contact"); ?></legend>
			<div class="column width1 first">&nbsp;</div>
			<div class="column width7">
				<div class="column width4 first">
					<p>
						<?php echo Form::label("contactList", __("Contact list :"), array("class" => "required")); ?><br />
						<?php echo Form::select("contactList", $contacts, null, array("id" => "contactList", "class" => "full")); ?>
					</p>

					<p>
						<?php echo Form::label("groupList", __("Contact list :"), array("class" => "required")); ?><br />
						<?php echo Form::select("groupList", $groupContacts, null, array("id" => "groupList", "class" => "full")); ?>
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