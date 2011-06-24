


<header>
<ul class="action-buttons clearfix fr">
  <li><?php echo Html::anchor('http://www.google.fr', __('Help') . '<span class="help"></span>', array('class' => 'button button-gray no-text help', 'rel' => '#overlay'))   ?></li>
</ul>
<h2>Form Templates</h2>
</header>
<section class="container_6 clearfix">
<div class="grid_6">
  <h3>Modal Dialogs</h3>
  <hr />
  <!-- the triggers -->
  <p>
  <?php echo Html::anchor(NULL, __('Simple dialog'), array('rel' => '#simpledialog', 'class' => 'modalInput button button-green')); ?>
  <?php echo Html::anchor(NULL, __('Yes or no?'), array('rel' => '#yesno', 'class' => 'modalInput button button-blue')); ?>
  <?php echo Html::anchor(NULL, __('User input'), array('rel' => '#prompt', 'class' => 'modalInput button button-orange')); ?>
  </p>
  <hr />
</div>


<?php echo Form::open(NULL, array('id' => 'form', 'class' => 'form grid_6'));  ?>

  <fieldset>
    <legend>HTML5 form with validation</legend>
    <?php echo Form::label('name', 'Name <em>*</em><small>Enter your name</small>');  ?>
    <?php echo Form::input('name', NULL, array('type' => 'text', 'required' => 'required'));  ?>

    <?php echo Form::label('email', 'Email <em>*</em><small>A valid email address</small>');  ?>
    <?php echo Form::input('email', NULL, array('type' => 'email', 'required' => 'required'));  ?>

    <?php echo Form::label('birthdate', 'Birthdate<small>mm/dd/yyyy</small>');  ?>
    <?php echo Form::input('birthdate', NULL, array('type' => 'date', 'required' => 'required'));  ?>

    <?php echo Form::label('username', 'Username <em>*</em><small>Alphanumeric (max 12 char.)</small>');  ?>
    <?php echo Form::input('username', NULL, array('type' => 'text', 'required' => 'required', 'maxlength' => '12'));  ?>    

    <?php echo Form::label('password', 'Password<small>max. 30 char.</small>');  ?>
    <?php echo Form::input('password', NULL, array('type' => 'password', 'maxlength' => '30'));  ?>

    <?php echo Form::label('check', 'Password check<small>Re-enter your password</small>');  ?>
    <?php echo Form::input('check', NULL, array('type' => 'password', 'maxlength' => '30', 'data-equals' => 'password'));  ?>

    <?php echo Form::label('website', 'Website <em>*</em><small>A valid URL</small>');  ?>
    <?php echo Form::input('website', NULL, array('type' => 'url', 'required' => 'required'));  ?>

    <?php echo Form::label('tz', 'Timezone<small>Your timezone</small>');  ?>
    <?php echo Form::select('tz', array('America/New York', 'Asia/Manila'));   ?>

    <div class="action">
      <?php echo Form::button(NULL, '<span class="accept"></span>' . __('OK'), array('class' => 'button button-gray', 'type' => 'submit')); ?>
      <?php echo Form::button(NULL, __('Reset'), array('class' => 'button button-gray', 'type' => 'reset')); ?>
    </div>
  </fieldset>

<?php echo Form::close(); ?>

<div class="grid_6">
  <h3>Tabs</h3>

  <hr />

  <!-- the tabs -->
  <div class="tabbed-pane">
    <ul class="tabs">
      <li><a href="#">Tab 1</a></li>
      <li><a href="#">Tab 2</a></li>
      <li><a href="#">Tab 3</a></li>
    </ul>

    <!-- tab "panes" -->
    <div class="panes clearfix">
      <section>
      <h4>First tab content.</h4>
      Tab contents are called "panes"</section>
      <section>Second tab content</section>
      <section>Third tab content</section>
    </div>
  </div>
</div>
</section>
