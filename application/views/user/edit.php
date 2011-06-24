<header>
	<div class="action-buttons clearfix fr">
		<?php echo Html::anchor("#", __("Preview my card"), array("class" => "button button-blue")); ?>
	</div>
	<h2><?php echo __("Account Settings"); ?></h2>
</header>
<section class="container_6" >
	<div class="grid_6">
		<h3><?php echo __("Profile informations"); ?></h3>
		<hr>
	</div>
	<?php echo Form::open('user/edit', array('autocomplete' =>'on',  'method' => 'post', 'class' => 'clearfix', 'enctype' => "multipart/form-data")); ?>
	<div class="grid_2">
		<p>
			<?php echo Form::label('firstname', "<em>*</em>" . __('First name')); ?>
			<?php echo Form::input('firstname', $user->firstname, array( 'type' => 'text', 'id' => 'firstname', 'class' => 'full', 'required' => 'required')); ?>
		</p>
		<p>
			<?php echo Form::label('lastname', "<em>*</em>" . __('Last name')); ?>
			<?php echo Form::input('lastname', $user->lastname, array( 'type' => 'text', 'id' => 'lastname', 'class' => 'full', 'required' => 'required')); ?>
		</p>
		<p>
			<?php echo Form::label('function', "<em>*</em>" . __('Function')); ?>
			<?php echo Form::input('function', $user->function, array( 'type' => 'text', 'id' => 'function', 'class' => 'full', 'required' => 'required')); ?>
		</p>
		<p>
			<?php echo Form::label('website', __('Website')); ?>
			<?php echo Form::input('website', $user->website, array( 'type' => 'text', 'id' => 'website', 'placeholder' => 'http://', 'class' => 'full', )); ?>
		</p>
	</div>
	<div class="grid_2">
		<p>
			<?php echo Form::label('workphone', "<em>*</em>" . __('Work phone')); ?><br/>
			<?php echo Form::input('workphone', $user->phones['work'], array( 'type' => 'text', 'id' => 'workphone', 'required' => 'required')); ?>
		</p>
		<p>
			<?php echo Form::label('mobilephone', "<em>*</em>" . __('Mobile phone')); ?><br/>
			<?php echo Form::input('mobilephone', $user->phones['mobile'], array( 'type' => 'text', 'id' => 'mobilephone', 'required' => 'required')); ?>
		</p>
		<p>
			<?php echo Form::label('homephone', "<em>*</em>" . __('Home phone')); ?><br/>
			<?php echo Form::input('homephone', $user->phones['home'], array( 'type' => 'text', 'id' => 'homephone', 'required' => 'required')); ?>
		</p>
	</div>
	<div class="grid_2">
		<p>
			<?php echo Form::label('address', "<em>*</em>" . __('Address')); ?>
			<?php echo Form::input('address', $user->street, array( 'type' => 'text', 'id' => 'address', 'class' => 'full', 'required' => 'required')); ?>
		</p>
		<p>
			<?php echo Form::label('city', "<em>*</em>" . __('City')); ?>
			<?php echo Form::input('city', $user->_place_city->name, array( 'type' => 'text', 'id' => 'city', 'class' => 'full', 'required' => 'required')); ?>
		</p>
		<p>
			<?php echo Form::label('zip', "<em>*</em>" . __('Zip code')); ?>
			  <?php echo Form::input('zip', $user->_place_city->code, array( 'type' => 'text', 'id' => 'zip', 'class' => 'full', 'required' => 'required')); ?>
		</p>
		<p>
			<?php echo Form::label('country', "<em>*</em>" . __('Country')); ?>
			<?php echo Form::select("country", $countries, $user->_place_country->code, array("style" => "width: 240px;"));?>
		</p>
	</div>
	<div class="grid_6">
		<h3><?php echo __("Profile pictures"); ?></h3>
		<hr>
	</div>
	<div class="grid_2 ac">
	  	<figure class="original_image_profile">
			<div id="preview_container" class="preview_container">
		  		<?php echo Html::image($user->image, array('id' => 'preview')); ?>
			</div>
	  		<?php echo Form::input("uploadify", __("Upload file"), array("type" => "file" ,"class" => "button button-orange", 'id' => 'uploadify'));?>
		</figure>
	</div>
	<div class="grid_2">
		<p>
			<?php echo Form::label('firstname', __('First name')); ?>
			<?php echo Form::input('firstname', $user->firstname, array( 'type' => 'text', 'id' => 'firstname', 'class' => 'full', 'required' => 'required')); ?>
		</p>
		<p>
			<?php echo Form::label('lastname', __('Last name')); ?>
			<?php echo Form::input('lastname', $user->lastname, array( 'type' => 'text', 'id' => 'lastname', 'class' => 'full', 'required' => 'required')); ?>
		</p>
		<p>
			<?php echo Form::label('function', __('Function')); ?>
			<?php echo Form::input('function', $user->function, array( 'type' => 'text', 'id' => 'function', 'class' => 'full', 'required' => 'required')); ?>
		</p>
	</div>
	<div class="grid_2">
		<p>
			<?php echo Form::label('address', __('Address')); ?>
			<?php echo Form::input('address', $user->street, array( 'type' => 'text', 'id' => 'address', 'class' => 'full', 'required' => 'required')); ?>
		</p>
		<p>
			<?php echo Form::label('city', __('City')); ?>
			<?php echo Form::input('city', $user->_place_city->name, array( 'type' => 'text', 'id' => 'city', 'class' => 'full', 'required' => 'required')); ?>
		</p>
		<p>
			<?php echo Form::label('zip', __('Zip code')); ?>
			  <?php echo Form::input('zip', $user->_place_city->code, array( 'type' => 'text', 'id' => 'zip', 'class' => 'full', 'required' => 'required')); ?>
		</p>
		<p>
			<?php echo Form::label('country', __('Country')); ?>
			<?php echo Form::select("country", $countries, $user->_place_country->code, array("style" => "width: 240px;"));?>
		</p>
	</div>
	<div class="grid_6"><hr></div>
	<p class="clearfix">
		<?php echo Form::button('register', __('Register'), array('class' => 'button button-green fr', 'type' => 'submit', 'onClick' => 'return checkCoords();')); ?>
	</p>
	<?php echo Form::close(); ?>
</section>
