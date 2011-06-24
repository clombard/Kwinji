<div>
	<?php echo Form::open('resumes/index', array('id'=>'graduationForm', 'class' => 'form-validator'));  ?>
	
		<fieldset>
			<legend><?php echo __("Confirm this contact"); ?></legend>
			<div class="column width8 first">
				<div class="column width1 ta-right"><?php echo HTML::image("static/img/user_32.png")?></div>
				
				<div class="column width3">
					<p class="big">First Lastname</p>
					<p>Function, Company</p>
					<p class="subtitle">Industry</p>
					<small>Address</small>
					<small>Region, Country</small>
					<small>mobile</small>
					<small>Fixe</small>
					<q>Description</q>
				</div>
				<div class="column width3">
					<p>
						<?php echo Form::radio("confirm", "accept", null, array("id" => "accept_contact")) . " " . Form::label("accept_contact", "Add to my contacts"); ?>
						<?php echo Form::radio("confirm", "reject", null, array("id" => "reject_contact")) . " " . Form::label("reject_contact", "Reject request"); ?>
					</p>
					<p>
						<label class="" for="message"><?php echo __("Personalize message:"); ?></label><br/>
						<textarea id="message" class="full" name="msg_perso"></textarea>
					</p>
					<p>
						<?php echo Form::checkbox("card", "my_pro_card", null, array("id" => "pro_card")) . " " . Form::label("pro_card", "My professional contact card"); ?><br />	
						<?php echo Form::checkbox("card", "my_details", null, array("id" => "my_details")) . " " . Form::label("my_details", "My personal details"); ?>
					</p>
				</div>
				<div class="column width1"></div>
			</div>
			<p class="box ta-right">
				<?php echo __(':big_green or :simple_gray', array(
		        	':big_green'=>Form::submit(null, __('Submit'), array('class'=>'btn btn-green big', 'onClick' => 'formValidator();')),
		            ':simple_gray'=>Form::submit(null, __('Reset'), array('type'=>'reset', 'class'=>'btn')),
				)); ?>
			</p>
		</fieldset>
	
	<?php echo Form::close(); ?>
</div>