<div class="message success">
	<h3><?php echo __("Search new contact"); ?></h3>
	<?php echo Form::open('openinviter/invit', array('id'=>'', 'class' => '', 'onsubmit'=>'return false;'));  ?>
			<p class=''>
	            <?php echo Form::label('email', "<em>*</em> " . __('Email address'), array('class'=>'required')); ?><br>
	        	<?php  echo Form::input('email','', array('type'=>'email', 'id'=>'email', 'class'=>'full'));  ?>
			</p>
			<p>
				<?php echo Form::label('password_confirm', "<em>*</em> " . __('Confirm password'), array('class'=>'required')); ?><br>
				<?php  echo Form::input('password_confirm','', array('type'=>'password', 'id'=>'password_confirm', 'class'=>'full'));  ?>
			</p>
			<p>
				<?php echo Form::label('select_provider', "<em>*</em> " . __('Select a provider'), array('class'=>'required')); ?><br>
				<?php  echo Form::select("select_provider", $providers, "", array('type'=>'password', 'id'=>'password_confirm', 'class'=>'half'));  ?>
			</p>
			<hr>
			<p class="ar">
				<?php echo __(':cancel :valid', array(
		        	':valid'=>Form::submit(null, __('Submit'), array('class'=>'button button-green')),
		            ':cancel'=>Form::submit(null, __('Reset'), array('type'=>'reset', 'class'=>'button button-gray')),
				)); ?>
			</p>
	<?php echo Form::close(); ?>
</div>