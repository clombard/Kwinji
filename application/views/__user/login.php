
<?php echo Form::open('user/login');   ?>

	<?php echo Form::label('email', 'Your email'); ?>
	<?php echo Form::input('email', null, array('type'=>'email', 'id'=>'email', 'required'=>'required')); ?>

	<?php echo Form::label('password', 'Your password'); ?>
	<?php echo Form::input('password', null, array('type'=>'password', 'id'=>'password', 'required'=>'required')); ?>

	<?php echo Form::label('remember', 'Remember me'); ?>
	<?php echo Form::input('remember', null, array('type'=>'checkbox', 'id'=>'remember')); ?>

	<?php echo Form::submit('login', 'Login',array( 'id'=>'login')); ?>

<?php echo Form::close();   ?>

