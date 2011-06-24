<div class="login-box main-content">
  <header>
  <h2><?php __('Streamlined login'); ?></h2>
  </header>
  <section>
  <div class="message info">Enter any letter and press Login</div>
  
	<?php echo Form::open('streamlined/dashboard', array('method' => 'post', 'class' => 'clearfix')); ?>
    <p>
      <?php echo Form::input('username', null, array('type' => 'text', 'id' => 'username', 'class' => 'full', 'required' => 'required', 'placeholder' => __('Username'))); ?>
    </p>
    <p>
      <?php echo Form::input('password', null, array('type' => 'password', 'id' => 'password', 'class' => 'full', 'required' => 'required', 'placeholder' => __('Password'))); ?>
    </p>    
    <p class="clearfix">
      <span class="fl"> 
      	<?php echo form::input('remember', "1", array('type' => 'checkbox', 'id' => 'remember')); ?>
      	<?php echo Form::label('remember', __('Remember me'), array('class' => 'choice')); ?>
      </span>
      <?php echo Form::button('submit', __('Login'), array('class' => 'button button-gray fr', 'type' => 'submit')); ?>
    </p>
  <?php echo Form::close(); ?>
  <ul>
    <li><strong>HELP!</strong>&nbsp;<a href="#">I forgot my password!</a></li>
  </ul>
  </section>
</div>
