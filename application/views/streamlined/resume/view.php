<header>
	<?php echo $header_tools; ?>
	<?php echo $header_title; ?>
</header>
<section class="container_7 clearfix resume">
	<div class="user-details grid_7">
		<div class="grid_1 alpha">
			<?php $user_img = "assets/images/user_64.png"; ?>
			<?php if (!empty($user_infos['avatar'])): ?>
				<?php $user_img = $user_infos['avatar']; ?>
			<?php endif; ?>
			<?php echo HTML::image($user_img, array("alt" => $user_infos['display_name'])); ?>
		</div>

		<div class="grid_5">
			<div class="message success">
				<h2><?php echo $user_infos['display_name'] . ", " . $user_infos['job']; ?></h2>
				<h3><?php echo $user_infos['firm']; ?></h3>
				<h4><?php echo $user_infos['city'] . ", " . $user_infos['region']; ?></h4>
				<h4><?php echo $user_infos['country']; ?></h4>
				<h4 class="fr"><?php echo $user_infos['email']; ?></h4>
				<div class="clear"></div>
			</div>
			<p><?php echo $resume['description']; ?></p>
		</div>
		<div class="clear"></div>
	</div>

	<div class="grid_6"><hr /></div>
	<div class="clear"></div>
	
	<!-- Expériences -->
	
	<div class="grid_6">
		<div class="grid_6 alpha omega">
			<h3><?php echo __("Experiences"); ?></h3>
		</div>
  		<div class="clear"></div>
	</div>

<?php foreach ($resume['experiences'] as $experience): ?>
	<div class="grid_6">
		<div class="grid_1 alpha">
	<?php $end_exp = $experience['end_date']; ?>
	<?php $start_exp = $experience['start_date']; ?>
	<?php $range_exp = ""; ?>
	<?php if (empty($end_exp) || null == $end_exp): ?>
		<?php $range_exp .= "Since " . date("F Y", $start_exp); ?>
	<?php else: ?>
		<?php $range_exp .= date("F Y", $start_exp) . " <br> " . date("F Y", $end_exp); ?>
	<?php endif; ?>
			<h6><?php echo $range_exp; ?></h6>
		</div>
		
		<div class="experience grid_5 omega">
			<small class="fr ta-right"><a href="#"><?php echo $experience['city'] . " (" . $experience['zip'] . ")"; ?></a><br /> <a href="#"><?php echo $experience['country']; ?></a></small>
			<h4><a href="<?php echo $experience['firm_id']; ?>"><?php echo $experience['firm_name']; ?></a></h4>
			<h5><?php echo $experience['job_title']; ?>, <a href="<?php echo $experience['job_id']; ?>"><?php echo $experience['job']; ?></a></h5>
			<em><a href="#"><?php echo $experience['industry']; ?></a></em>
			<p><?php echo $experience['description']; ?></p>
	
			<h5>
				<strong><?php echo __("Qualifications :"); ?></strong> 
	<?php $index = 0; ?>
	<?php foreach ($experience['keywords'] as $key=>$value): ?>
		<?php $index++; ?>
		<a href="<?php echo $key; ?>"><?php echo $value; ?></a>
		<?php if (count($experience['keywords']) > $index): ?>
			,
		<?php endif; ?>
	<?php endforeach; ?>
			</h5>
		</div>
	</div>
	<div class="clear"></div>
<?php endforeach; ?>
	<div class="grid_6"><hr /></div>
	<div class="clear"></div>

<!-- Diplomes -->
	
	<div class="grid_6">
		<div class="grid_6 alpha omega">
			<h3><?php echo __("Graduations"); ?></h3>
		</div>
  		<div class="clear"></div>
	</div>

<?php foreach ($resume['graduations'] as $graduation): ?>
	<div class="grid_6">
		<div class="grid_1 alpha">
	<?php $end_exp = $graduation['end_date']; ?>
	<?php $start_exp = $graduation['start_date']; ?>
	<?php $range_exp = ""; ?>
	<?php if (empty($end_exp) || null == $end_exp): ?>
		<?php $range_exp .= "Since " . date("F Y", $start_exp); ?>
	<?php else: ?>
		<?php $range_exp .= date("F Y", $start_exp) . " <br> " . date("F Y", $end_exp); ?>
	<?php endif; ?>
			<h6><?php echo $range_exp; ?></h6>
		</div>
		
		<div class="grid_5 omega">
			<small class="fr ta-right"><a href="#"><?php echo $graduation['city'] . " (" . $graduation['zip'] . ")"; ?></a><br /> <a href="#"><?php echo $graduation['country']; ?></a></small>
			<h4><a href="<?php echo $graduation['school_id']; ?>"><?php echo $graduation['school_name']; ?></a></h4>
			<abbr><?php echo $graduation['speciality']; ?></abbr>
			<p><?php echo $graduation['description']; ?></p>
	
			<h5>
				<strong><?php echo __("Qualifications :"); ?></strong> 
	<?php $index = 0; ?>
	<?php foreach ($graduation['keywords'] as $key=>$value): ?>
		<?php $index++; ?>
		<a href="<?php echo $key; ?>"><?php echo $value; ?></a>
		<?php if (count($graduation['keywords']) > $index): ?>
			,
		<?php endif; ?>
	<?php endforeach; ?>
			</h5>
		</div>
	</div>
	<div class="clear"></div>
<?php endforeach; ?>
	<div class="grid_6"><hr /></div>
	<div class="clear"></div>

<!-- Formations -->

	<div class="grid_6">
		<div class="grid_6 alpha omega">
			<h3><?php echo __("Trainings"); ?></h3>
		</div>
  		<div class="clear"></div>
	</div>

<?php foreach ($resume['trainings'] as $training): ?>
	<div class="grid_6">
		<div class="grid_1 alpha">
	<?php $end_exp = $training['end_date']; ?>
	<?php $start_exp = $training['start_date']; ?>
	<?php $range_exp = ""; ?>
	<?php if (empty($end_exp) || null == $end_exp): ?>
		<?php $range_exp .= "Since " . date("F Y", $start_exp); ?>
	<?php else: ?>
		<?php $range_exp .= date("F Y", $start_exp) . " <br> " . date("F Y", $end_exp); ?>
	<?php endif; ?>
			<h6><?php echo $range_exp; ?></h6>
		</div>
		
		<div class="experience grid_5 omega">
			<small class="fr ta-right"><a href="#"><?php echo $training['city'] . " (" . $training['zip'] . ")"; ?></a><br /> <a href="#"><?php echo $training['country']; ?></a></small>
			<h4><abbr><a href="<?php echo $training['firm_id']; ?>"><?php echo $training['firm_name']; ?></a></abbr>, <a href="<?php echo $training['title_link']; ?>"><?php echo $training['title']; ?></a></h4>
			<abbr><?php echo $training['teaser']; ?></abbr>
			<p><?php echo $training['description']; ?></p>
	
			<h5>
				<strong><?php echo __("Qualifications :"); ?></strong> 
	<?php $index = 0; ?>
	<?php foreach ($training['keywords'] as $key=>$value): ?>
		<?php $index++; ?>
		<a href="<?php echo $key; ?>"><?php echo $value; ?></a>
		<?php if (count($training['keywords']) > $index): ?>
			,
		<?php endif; ?>
	<?php endforeach; ?>
			</h5>
		</div>
	</div>
	<div class="clear"></div>
<?php endforeach; ?>

	<div class="grid_6"><hr /></div>
	<div class="clear"></div>
	
<!-- Hobbies -->
	
	<div class="grid_6">
		<div class="grid_6 alpha omega">
			<h3><?php echo __("Hobbies"); ?></h3>
		</div>
  		<div class="clear"></div>
	</div>

	<div class="grid_6">
		<div class="grid_1 alpha">&nbsp;</div>
		<div class="grid_5 omega"><abbr><?php echo $resume['hobbies']; ?></abbr></div>
	</div>
	<div class="clear"></div>

	<div class="grid_6"><hr /></div>
	<div class="clear"></div>
	
<!-- Hobbies -->
	
	<div class="grid_6">
		<div class="grid_6 alpha omega">
			<h3><?php echo __("Keywords"); ?></h3>
		</div>
  		<div class="clear"></div>
	</div>

	<div class="grid_6">
		<div class="grid_1 alpha">&nbsp;</div>
		<div class="grid_5 omega"><abbr><?php echo $resume['keywords']; ?></abbr></div>
	</div>
	<div class="clear"></div>

	<div class="grid_6"><hr /></div>
	<div class="clear"></div>
	
<!-- Statistics -->
	
	<div class="grid_6">
		<div class="grid_6 alpha omega">
			<h3><?php echo __("Keywords"); ?></h3>
		</div>
  		<div class="clear"></div>
	</div>

	<div class="grid_6">
		<div class="grid_1 alpha">&nbsp;</div>
		<div class="grid_5 omega">
			<div id="chart-container-1" style="width: 100%; height: 400px"></div>
		</div>
	</div>
	<div class="clear"></div>

	<div class="grid_6"><hr /></div>
	<div class="clear"></div>
	
<!-- Skills -->
	
	<div class="grid_6">
		<div class="grid_6 alpha omega">
			<h3><?php echo __("Skills"); ?></h3>
		</div>
  		<div class="clear"></div>
	</div>

	<div id="skills" class="grid_6">
		<div class="grid_1 alpha">&nbsp;</div>
		<div class="grid_5 omega">
<?php foreach ($skills as $key=>$value): ?>
		<!-- PROGRESS BAR COLOR  --> 
	<?php $progress_class = 'progress'; ?>
	<?php $level = intval($value['level']); ?>
	<?php if($level < 30): ?>
		<?php $progress_class .= '-red'; ?>
	<?php elseif ($level > 30 && $value['level'] < 60):?>
		<?php $progress_class .= '-blue'; ?>
	<?php elseif ($level > 60):?>
		<?php $progress_class .= '-green'; ?>
	<?php endif; ?>
			<div id="" class="progress full <?php echo $progress_class; ?>" value="19"><span style="width: <?php echo $value["level"]; ?>%; display: block;"><b style="display: inline;"><?php echo $key; ?></b></span></div>
		<!-- END OF PROGRESS BAR COLOR -->
<?php endforeach; ?>

			<div class="form" style="display:none;">
	<?php echo Form::open('#', array('id'=>'skillsForm', 'class' => 'form-validator', 'onsubmit'=>'return false;'));  ?>
			<fieldset>
				<legend><?php echo __("Skills update"); ?></legend>

		<?php foreach ($skills as $key=>$value): ?>
				<p>
					<label><?php echo $key; ?></label><br />
					<div id="example" class="ui-slider" style="margin:10px;">
						<div class="ui-slider-handle"></div>
					</div>
					<input class="slider" value="<?php echo $value["level"]; ?>"/>
				</p>
		<?php endforeach; ?>
				<p class="box">
				<?php echo __(':big_green or :simple_gray', array(
		        	':big_green'=>Form::submit(null, __('Submit'), array('class'=>'btn btn-green big')),
		            ':simple_gray'=>Form::submit(null, __('Reset'), array('type'=>'reset', 'class'=>'btn')),
				)); ?>
				</p>
			</fieldset>
	<?php echo Form::close(); ?>
		</div>
		<div class="settings ta-right">
			<?php echo  HTML::anchor('#', __('Settings'), array('class' => 'setting-link', 'title' => __("Settings"))); ?>
		</div>
	</div>
</section>