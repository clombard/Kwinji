	<?php echo Form::open('resumes/index', array('id'=>'graduationForm', 'class' => 'form-validator'));  ?>
	
				<fieldset>
					<legend><?php echo __("Add New Training"); ?></legend>
					<div class="column width8 first">
						<div class="column width1 first">&nbsp;</div>
						<div class="column width2">
							<p>
								<label class="required dateformat" for="begin_date"><?php echo __("Begin");?></label><br>
								<input id="begin_date" type="date" name="begin_date" class="datepick" />
							</p>
					      	<p>
								<label class="required" for="end_date"><?php echo __("End");?></label><br>
					      		<input id="end_date" type="date" name="end_date" class="datepick" />
					      	</p>
						</div>
						
						<div class="column width4">
							<p>
								<label class="required" for="firm_name"><?php echo __("Firm training :"); ?></label><br/>
								<input type="text" id="firm_name" class="big full" value="" name="firm_name"/>
							</p>
							<p>
								<label class="required" for="title"><?php echo __("Training title :"); ?></label><br/>
								<input type="text" id="title" class="full" value="" name="title" />
							</p>
						</div>
						<div class="column width1"></div>
					</div>
					<div class="column width8 first clearfix">
						<div class="column width1 first">&nbsp;</div>
						<div class="column width2">
							<p>
								<label class="required" for="country"><?php echo __("Country :"); ?></label><br/>
								<select id="country" class="full" name="country">
									<option value="1">Lorem</option>
									<option value="2">Ipsum</option>
									<option value="3">Dolor</option>
									<option value="4">Sit</option>
									<option value="5">Amet</option>
								</select>
							</p>
							<p>
								<label class="required" for="region"><?php echo __("Region / State :"); ?></label><br/>
								<input type="text" id="region" class="full" value="" name="region"/>
							</p>
							<p>
								<label for="city"><?php echo __("City :"); ?></label><br/>
								<input type="text" id="city" class="full" value="" name="city"/>
							</p>
						</div>
						<div class="column width4">
							<p>
								<label for="description"><?php echo __("Description :"); ?></label><br/>
								<textarea id="description" class="medium full" name="description"></textarea>
							</p>
							<p>
								<label class="" for="keywords"><?php echo __("Skills / Keywords :"); ?></label><br/>
								<input type="text" id="keywords" class="full" value="" name="keywords"/>
							</p>
						</div>
						<div class="column width1"></div>
					</div>
					<p class="box">
						<?php echo __(':big_green or :simple_gray', array(
				        	':big_green'=>Form::submit(null, __('Submit'), array('class'=>'btn btn-green big', 'onClick' => 'formValidator();')),
				            ':simple_gray'=>Form::submit(null, __('Reset'), array('type'=>'reset', 'class'=>'btn')),
						)); ?>
					</p>
				</fieldset>
	
	<?php echo Form::close(); ?>
<script type="text/javascript">
$(document).ready(function() {
	Administry.dateInput('.datepick');
});

<!--

//-->
</script>
