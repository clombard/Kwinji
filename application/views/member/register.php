<div class="login-box main-content">
  
  <header>
    <h2>
    	<?php echo __('Register to Kwinji'); ?>
    </h2>
  </header>
  
  <section>

	  <?php echo Message::render(); ?>
	  
	  <?php echo Form::open('user/register', array('autocomplete' =>'on',  'method' => 'post', 'class' => 'clearfix')); ?>
	  
		  <p>
			  <?php echo Form::label('firstname', __('First name')); ?>
			  <?php echo Form::input('firstname', $post['firstname'], array( 'type' => 'text', 'id' => 'firstname', 'class' => 'full', 'required' => 'required')); ?>
		  </p>
      
		  <p>
			  <?php echo Form::label('lastname', __('Last name')); ?>
			  <?php echo Form::input('lastname', $post['lastname'], array( 'type' => 'text', 'id' => 'lastname', 'class' => 'full', 'required' => 'required')); ?>
		  </p>
      
		  <p>
			  <?php echo Form::label('mail', __('Your mail')); ?>
			  <?php echo Form::input('mail', $post['mail'], array( 'type' => 'text', 'id' => 'mail', 'class' => 'full', 'required' => 'required')); ?>
		  </p>
      
		  <p>
			  <?php echo Form::label('password', __('Your password')); ?>
			  <?php echo Form::input('password', $post['password'], array( 'type' => 'password', 'id' => 'password', 'class' => 'full', 'required' => 'required')); ?>
		  </p>

      <p>
        <?php echo Form::label('password_repeat', __('Repeat our password')); ?>
        <?php echo Form::input('password_repeat', $post['password_repeat'], array( 'type' => 'password', 'id' => 'password', 'class' => 'full', 'required' => 'required')); ?>
      </p>
      
		  <p class="clearfix">
		    <span class="fl"> 
			    <?php echo form::input('agreement', NULL, array('checked' => true, 'type' => 'checkbox', 'id' => 'agreement')); ?>
			    <?php echo Form::label('agreement', __('Accept license agreement'), array('class' => 'choice')); ?>
		    </span>
		    <?php echo Form::button('register', __('Register'), array('class' => 'button button-green fr', 'type' => 'submit')); ?>
		  </p>
	    
	  <?php echo Form::close(); ?>
  
  </section>
</div>
