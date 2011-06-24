<h3><?php echo __('Form elements')	; ?></h3>
          
          <h5>Step 1/6</h5>
          <div id="progress1" class="progress full progress-green"><span><b></b></span></div>
          
          <?php /* echo Form::open('#', array('id'=>'samplefom2', 'onsubmit'=>'resturn false;')); */ ?>
          <?php echo Form::open('#', array('id'=>'samplefom2', 'onsubmit'=>'resturn false;'));  ?>
              <fieldset>
              <legend><?php echo __('Error message'); ?></legend>
              <div class="box box-error"><?php echo __('Invalid credit card'); ?></div>
              <div class="box box-error-msg">
                <ol>
                  <li><?php echo __('Credit card number entered is invalid'); ?></li>
                  <li><?php echo __('Credit card verification number must be a valid number'); ?></li>
                </ol>
              </div>
            </fieldset>
          
            <fieldset>
              <legend>Text fields</legend>
              <p>
                <?php echo Form::label('input2', __('Big title:')); ?><br>
                <?php echo Form::input('input2','', array('type'=>'text', 'id'=>'input2',  'class'=>'half title')); ?>
                <small>class="half title"</small>
              </p>
              <p>
                <?php echo Form::label('input1', __('Full textbox:')); ?><br>
                <?php echo Form::input('input1','', array('type'=>'text', 'id'=>'input1',  'class'=>'full')); ?>
                <small>class="full"</small>
              </p>
              <p>
                <?php echo Form::label('datepick', __('Date input field:')); ?><br>
                <?php echo Form::input('datepick','', array('type'=>'date', 'id'=>'input1',  'class'=>'')); ?>
              </p>
            </fieldset>
            
            <fieldset>
              <legend>Text area</legend>
              <p>
                <?php echo Form::label('area1', __('Small textarea:')); ?><br>
                <?php echo Form::textarea('area1', '', array('id'=>'area1', 'class'=>'small'));  ?>
                <small>class="small"</small>
              </p>
              <p>
                <?php echo Form::label('area2', __('Medium textarea:')); ?><br>
                <?php echo Form::textarea('area2', '', array('id'=>'area2', 'class'=>'medium half'));  ?>
                <small>class="medium half"</small>
              </p>
              <p>
                <?php echo Form::label('area3', __('Large textarea:')); ?><br>
                <?php echo Form::textarea('area3', '', array('id'=>'area3', 'class'=>'large full'));  ?>
                <small>class="large full"</small>
              </p>
              <p>
                <?php echo Form::label('wysiwyg', __('HTML editor:')); ?><br>
                <?php echo Form::textarea('wysiwyg', '', array('id'=>'wysiwyg', 'class'=>'full wysiwyg'));  ?>
                <small>class="wysiwyg"</small>
              </p>
            </fieldset>
            
            <fieldset>
              <legend>Selections</legend>
              <div class="clearfix">
                <div class="column width3 first">                 
                  <p>                    
                    <?php echo Form::label(null, _('Radios buttons:')); ?><br>
                    <?php echo Form::input('rb','', array('type'=>'radio', 'id'=>'rb1', 'class'=>'')); ?>
                    <?php echo Form::label('rb1', __('Lorem ipsum dolor sit amet'), array('class'=>'choice')); ?><br>
                    <?php echo Form::input('rb','', array('type'=>'radio', 'id'=>'rb2', 'class'=>'')); ?>
                    <?php echo Form::label('rb2', __('Lorem ipsum dolor sit amet'), array('class'=>'choice')); ?>
                  </p>
                  <p>
                    <?php echo Form::label('select1', _('Single selection:')); ?><br>
                    <?php 
                    $options = array(
                      1 => __('Lorem'),
                      2 => __('Ipsum'),
                      3 => __('Dolor'),
                      4 => __('Sit'),
                      5 => __('Amet'),
                    );
                    ?>
                    <?php echo Form::select('select1',  $options,null, array('id'=>'select1', 'class'=>'half'));  ?>
                    
                  </p>
                </div>
                <div class="column width3">
                  <p>
                    <?php echo Form::label(null, _('Check boxes:')); ?><br>
                    <?php echo Form::input('cb','', array('type'=>'checkbox', 'id'=>'cb1', 'class'=>'')); ?>
                    <?php echo Form::label('cb1', __('Lorem ipsum dolor sit amet'), array('class'=>'choice')); ?><br>
                    <?php echo Form::input('cb','', array('type'=>'checkbox', 'id'=>'cb2', 'class'=>'')); ?>
                    <?php echo Form::label('cb2', __('Lorem ipsum dolor sit amet'), array('class'=>'choice')); ?>
                  </p>
                  <p>
                    <?php echo Form::label('select2', _('Multiple selection:')); ?><br>
                    <?php 
                    $options = array(
                      'Set 1' => array(
                        1 => __('Lorem'),
                        2 => __('Ipsim'),
                      ),
                      'Set 2' => array(
                        3 => __('Dolor'),
                        4 => __('Sit'),
                        5 => __('Amet'),
                      ),
                    );
                    ?>
                    <?php echo Form::select('select2', $options, array(1), array('size'=>'6', 'class'=>'half'));    ?>
                  </p>
                </div>
              </div>
            </fieldset>
            
            <fieldset>
              <legend>Buttons</legend>
              <?php echo Form::label(null, _('Some combinations:')); ?>
              <p class="">              
                <?php echo __(':big_green :standard_red or :simple_gray', array(
                ':big_green'=>Form::submit(null, __('Big green'), array('class'=>'btn btn-green big')),
                ':standard_red'=>Form::submit(null, __('Standard red'), array('class'=>'btn btn-red')),
                ':simple_gray'=>Form::submit(null, __('Simple gray'), array('type'=>'reset', 'class'=>'btn')),
                )); ?>
              </p>
              
            </fieldset>
          
          <?php echo Form::close(); ?>