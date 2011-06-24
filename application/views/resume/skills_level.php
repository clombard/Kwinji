	<div id="skills" class="setting">
		<div class="show">
			<h3 class="full"><?php echo __("Skills"); ?></h3>
			<hr>
			<table class="no-style full">
				<tbody>
				<?php foreach ($skills as $key=>$value): ?>
					<tr>
						<td>
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
						<!-- END OF PROGRESS BAR COLOR --></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
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