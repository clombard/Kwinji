<h3>Form validation example</h3>
          <div class="box box-info">All fields are required</div>
          
          <?php echo Form::open('forms/index', array('id'=>'sampleform')); ?>
          
          <fieldset>
              <legend>JQuery Form Validation</legend>
          
              <p>
                <?php echo Form::label('firstname', __('First name:'), array('class'=>'required')); ?><br>
                <?php echo Form::input('firstname','', array('type'=>'text', 'id'=>'firstname'));  ?>
              </p>
          
          
               <p>
                <?php echo Form::label('lastname', __('Last name:'), array('class'=>'required')); ?><br>
                <?php echo Form::input('lastname','', array('type'=>'text', 'id'=>'lastname', 'class'=>'half'));  ?>
              </p>
              
              <p>
                <?php echo Form::label('username', __('Username:'), array('class'=>'required')); ?><br>
                <?php  echo Form::input('username','', array('type'=>'text', 'id'=>'username', 'class'=>'half'));  ?>
                <small>e.g. ui.templates</small>
              </p>
              
                    <p>
                <?php echo Form::label('password', __('Password:'), array('class'=>'required')); ?><br>
                <?php  echo Form::input('password','', array('type'=>'password', 'id'=>'password', 'class'=>'half'));  ?>
              </p>
              
                         <p>
                <?php echo Form::label('password_confirm', __('Confirm password:'), array('class'=>'required')); ?><br>
                <?php  echo Form::input('password_confirm','', array('type'=>'password', 'id'=>'password_confirm', 'class'=>'half'));  ?>
              </p>

                        <p>
                <?php echo Form::label('email', __('Email address:'), array('class'=>'required')); ?><br>
                <?php  echo Form::input('email','', array('type'=>'email', 'id'=>'email', 'class'=>'half'));  ?>
              </p>

              <p>
                <?php echo Form::label(null, __('Date format:'), array('class'=>'required')); ?><br>
                
                <?php  echo Form::input('dateformat','dmy', array('type'=>'radio', 'id'=>'dateformat1', 'class'=>''));  ?>
                <?php echo Form::label('dateformat1', __('dd/mm/yyyy'), array('class'=>'choice')); ?>
                
                <?php  echo Form::input('dateformat2','mdy', array('type'=>'radio', 'id'=>'dateformat2', 'class'=>''));  ?>
                <?php echo Form::label('dateformat2', __('mm/dd/yyyy'), array('class'=>'choice')); ?><br>
              </p>
              
              
              <p>
                  <?php  echo Form::input('terms','1', array('type'=>'checkbox', 'id'=>'terms', 'class'=>''));  ?>
                <?php echo Form::label('terms', __('I have read and accept the Terms of Use.'), array('class'=>'choice')); ?>
              
              </p>
              
              <p class="box">              
                <?php echo __(':validate or :reset', array(
                ':validate'=>Form::submit('', __('Validate'), array('class'=>'btn btn-green big')),
                ':reset'=>Form::submit('', __('Reset'), array('type'=>'reset','class'=>'btn')),
                )); ?>
              </p>
              
          
          </fieldset>
          <?php echo Form::close(); ?>