<nav class="grid_5">
<ul class="clearfix">
  <li class="action"><a href="#" class="has-popupballoon button button-blue"><span class="add"></span>New Contact</a>
    <div class="popupballoon top">
      <h3>Add new contact</h3>
      First Name<br />
      <?php echo Form::input(NULL, NULL, array('type' => 'text')); ?>
      <br /> Last Name<br />
      <?php echo Form::input(NULL, NULL, array('type' => 'text')); ?>
      <br /> Company<br />
      <?php echo Form::input(NULL, NULL, array('type' => 'text')); ?>
      <hr />
      <?php echo Form::button(NULL, __('Add contact'), array('class' => 'button button-orange')); ?>
      <?php echo Form::button(NULL, __('Cancel'), array('class' => 'button button-gray close')); ?>
    </div></li>
  <li class="action"><a href="#" class="has-popupballoon button button-blue"><span class="add"></span>New Task</a>
    <div class="popupballoon top">
      <h3>Add new task</h3>
      <?php echo Form::input(NULL, NULL, array('type' => 'text')); ?>
      <br />
      <br /> When it's due?<br />
      <?php echo Form::input(NULL, NULL, array('type' => 'date')); ?>
      <br /> What category?<br />
      <?php echo Form::select(NULL, array('none' => __('None'))); ?>
      <hr />
      <?php echo Form::button(NULL, __('Add task'), array('class' => 'button button-orange')); ?>
      <?php echo Form::button(NULL, __('Cancel'), array('class' => 'button button-gray close')); ?>
    </div></li>
  <li class="active"><?php echo Html::anchor('dashboard/', __('Dashboard')); ?>
  </li>
  <li><?php echo Html::anchor('user/view/' . $user->id, __('Profile')); ?>
  </li>
  <li class="fr"><?php echo HTML::anchor(null, __('Administrator') . '<span class="arrow-down"></span>'); ?>
  </li>
  <ul>
    <li><?php echo Html::anchor('#', __('Account')); ?>
    </li>
    <li><?php echo Html::anchor('#', __('Users')); ?>
    </li>
    <li><?php echo Html::anchor('#', __('Groups')); ?>
    </li>
    <li><?php echo Html::anchor('#', __('Sign out')); ?>
    </li>
  </ul>
  </li>
</ul>
</nav>
