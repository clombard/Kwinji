<div class="login-box main-content">
  <header>
    <h2><?php echo __('Login to Kwinji'); ?></h2>
  </header>
  <section>
  
    <?php echo Message::render(); ?>
	 	 
		<?php echo Form::open('user/login', array('autocomplete' =>'on',  'method' => 'post', 'class' => 'clearfix')); ?>
    
	    <p>
	    	<?php echo Form::label('mail', __('Your mail')); ?>
	  		<?php echo Form::input('mail', $post['mail'], array( 'type' => 'text', 'id' => 'firstname', 'class' => 'full', 'required' => 'required')); ?>
	    </p>  
	    
	    <p>   
	  		<?php echo Form::label('password', __('Your password')); ?>
	  		<?php echo Form::input('password', $post['password'], array( 'type' => 'password', 'id' => 'password', 'class' => 'full', 'required' => 'required')); ?>
	    </p>
      
	    <p class="clearfix">
	      <span class="fl">
	      	<?php echo form::input('remember', NULL, array('checked' => TRUE, 'type' => 'checkbox', 'id' => 'remember')); ?>
					<?php echo Form::label('agreement', __('Remember me'), array('class' => 'choice')); ?>
	      </span>
	    	<?php echo Form::button('login', __('Login'), array('class' => 'button button-green fr', 'type' => 'submit')); ?>
	    </p>
      
	  <?php echo Form::close(); ?>
	  
	  <ul>
      <li><?php echo Html::anchor('user/password', __('Password forgotten?')); ?></li>
	  </ul>
  
  </section>
</div>
