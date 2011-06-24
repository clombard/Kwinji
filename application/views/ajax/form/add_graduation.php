<script type="text/javascript">

// validate form on keyup and submit
var validator = $("#sampleform, .form-validator")
		.validate(
				{
					rules : {
						titlenews : {
							required : true,
							minlength : 5
						},
						industry : "required",
						job_title : "required",
						job : "required",
						country : "required",
						firm_name : "required",
						firstname : "required",
						lastname : "required",
						begin_date : "required",
						username : {
							required : true,
							minlength : 2
						},
						password : {
							required : true,
							minlength : 5
						},
						password_confirm : {
							required : true,
							minlength : 5,
							equalTo : "#password"
						},
						email : {
							required : true,
							email : true
						},
						dateformat : "required",
						terms : "required"
					},
					messages : {
						titlenews : {
							required : "Enter a title",
							minlength : jQuery
									.format("Enter at least {0} characters")
						},
						begin_date : "Select a begin date",
						firm_name : "Provide a Firm name",
						job_title : "Write a job title",
						country: "Select your country",
						job : "Select your job",
						description : "Provide a description",
						industry : "Write an industry",
						description : "Provide a description",
						firstname : "Enter your firstname",
						lastname : "Enter your lastname",
						username : {
							required : "Enter a username",
							minlength : jQuery
									.format("Enter at least {0} characters")
						},
						password : {
							required : "Provide a password",
							rangelength : jQuery
									.format("Enter at least {0} characters")
						},
						password_confirm : {
							required : "Repeat your password",
							minlength : jQuery
									.format("Enter at least {0} characters"),
							equalTo : "Enter the same password as above"
						},
						email : {
							required : "Please enter a valid email address",
							minlength : "Please enter a valid email address"
						},
						dateformat : "Choose your preferred dateformat",
						terms : " "
					},
					// the errorPlacement has to take the
					// layout into account
					errorPlacement : function(error,
							element) {
						error.insertAfter(element.parent()
								.find('label:first'));
					},
					// specifying a submitHandler prevents
					// the default submit, good for the demo
					submitHandler : function() {
						alert("Data submitted!");
					},
					// set new class to error-labels to
					// indicate valid fields
					success : function(label) {
						// set &nbsp; as text for IE
						label.html("&nbsp;").addClass("ok");
					}
				});


</script>
	<?php echo Form::open('resumes/index', array('id'=>'graduationForm', 'class' => 'form-validator'));  ?>
	
				<fieldset>
					<legend><?php echo __("Add New Graduation"); ?></legend>
					<div class="column width8 first">
						<div class="column width1 first">&nbsp;</div>
						<div class="column width2">
							<p>
								<label class="required dateformat" for="graduation_begin_date"><?php echo __("Begin");?></label><br>
								<input id="graduation_begin_date" type="date" name="graduation_begin_date" class="datepick" />
							</p>
					      	<p>
								<label class="required" for="graduation_end_date"><?php echo __("End");?></label><br>
					      		<input id="graduation_end_date" type="date" name="graduation_end_date" class="disable-elem datepick" />
					            <input id="continue" type="checkbox" name="continue" class="disabled"><label for="continue" class="choice"><?php echo __("Today"); ?></label><br/>
					      	</p>
						</div>
						
						<div class="column width4">
							<p>
								<label class="required" for="school_name"><?php echo __("School name :"); ?></label><br/>
								<input type="text" id="school_name" class="big full" value="" name="school_name"/>
							</p>
							<p>
								<label class="required" for="speciality"><?php echo __("Speciality :"); ?></label><br/>
								<input type="text" id="speciality" class="full" value="" name="speciality"/>
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
								<label class="required" for="graduation_region"><?php echo __("Region / State :"); ?></label><br/>
								<input type="text" id="graduation_region" class="full" value="" name="graduation_region"/>
							</p>
							<p>
								<label for="graduation_city"><?php echo __("City :"); ?></label><br/>
								<input type="text" id="graduation_city" class="full" value="" name="graduation_city"/>
							</p>
						</div>
						<div class="column width4">
							<p>
								<label for="graduation_description"><?php echo __("Description :"); ?></label><br/>
								<textarea id="graduation_description" class="medium full" name="graduation_description"></textarea>
							</p>
							<p>
								<label class="" for="graduation_keywords"><?php echo __("Skills / Keywords :"); ?></label><br/>
								<input type="text" id="graduation_keywords" class="full" value="" name="graduation_keywords"/>
							</p>
						</div>
						<div class="column width1"></div>
					</div>
					<p class="box">
						<?php echo __(':big_green or :simple_gray', array(
				        	':big_green'=>Form::submit(null, __('Submit'), array('class'=>'btn btn-green big')),
				            ':simple_gray'=>Form::submit(null, __('Reset'), array('type'=>'reset', 'class'=>'btn')),
						)); ?>
					</p>
				</fieldset>
	
	<?php echo Form::close(); ?>
