	<header>
		<h3><?php echo __("Quick search"); ?></h3>
	</header>
	<section style="width: 96%;">
	<?php echo Form::open('#', array('id'=>'quickSearch', 'class' => 'form-validator', 'onsubmit'=>'return false;'));  ?>
			<p>
	            <?php echo Form::label('firstname', __('Fisrtname:'), array('class'=>'required')); ?><br>
	        	<?php  echo Form::input('firstname','', array('type'=>'text', 'id'=>'firstname', 'class'=>'full'));  ?>
			</p>
			<p>
	            <?php echo Form::label('lastname', __('Lastname:'), array('class'=>'required')); ?><br>
	        	<?php  echo Form::input('lastname','', array('type'=>'text', 'id'=>'lastname', 'class'=>'full'));  ?>
			</p>
			<p>
	            <?php echo Form::label('email', __('Email address:'), array('class'=>'required')); ?><br>
	        	<?php  echo Form::input('email','', array('type'=>'email', 'id'=>'email', 'class'=>'full'));  ?>
			</p>
			<p><hr></p>
			<p class="ta-right">
				<?php echo __(':simple_gray or :big_green', array(
		        	':big_green'=>Form::submit(null, __('Submit'), array('class'=>'btn btn-green big')),
		            ':simple_gray'=>Form::submit(null, __('Reset'), array('type'=>'reset', 'class'=>'btn')),
				)); ?>
			</p>
	<?php echo Form::close(); ?>
	</section>
