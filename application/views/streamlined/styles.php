<header>
<ul class="action-buttons clearfix fr">
  <li><?php echo Html::anchor('http://www.google.fr', __('Help') . '<span class="help"></span>', array('class' => 'button button-gray no-text help', 'rel' => '#overlay'))   ?></li>
</ul>
<h2>Styles</h2>
</header>

<section class="container_6 clearfix">
<div class="grid_6">

  <h3>Tooltips</h3>
  <hr>


	<div id="tooltip-demo">
		<?php echo HTML::image('assets/images/autumn/scottwills_autumn4_t.jpg', array('title' => 'A must have tool for designing better layouts and more intuitive user-interfaces.')); ?>
		<?php echo HTML::image('assets/images/autumn/scottwills_autumn5_t.jpg', array('title' => 'Tooltips can be positioned anywhere relative to the trigger element.')); ?>
		<?php echo HTML::image('assets/images/autumn/scottwills_autumn6_t.jpg', array('title' => 'Tooltips can contain any HTML such as links, images, forms, tables, etc.')); ?>
		<?php echo HTML::image('assets/images/autumn/scottwills_autumn2_t.jpg', array('title' => 'There are many built-in show/hide effects and you can also make your own.')); ?>
		<?php echo HTML::image('assets/images/autumn/scottwills_autumnleaf_t.jpg', array('title' => 'A must have tool for designing better layouts and more intuitive user-interfaces.')); ?>
		<?php echo HTML::image('assets/images/autumn/scottwills_butterfly_t.jpg', array('title' => 'Tooltips can be positioned anywhere relative to the trigger element.')); ?>
		<?php echo HTML::image('assets/images/autumn/scottwills_farmhouse2_t.jpg', array('title' => 'Tooltips can contain any HTML such as links, images, forms, tables, etc.')); ?>
	</div>

  <h3>Buttons</h3>
  
  <hr>

  <?php echo Form::button(NULL, __('Gray button'), array('class' => 'button button-gray')); ?>
  <?php echo Form::button(NULL, __('Orange button'), array('class' => 'button button-orange')); ?>
  <?php echo Form::button(NULL, __('Red button'), array('class' => 'button button-red')); ?>
  <?php echo Form::button(NULL, __('Blue button'), array('class' => 'button button-blue')); ?>
  <?php echo Form::button(NULL, __('Green button'), array('class' => 'button button-green')); ?>
  

  <h3>Action Buttons</h3>
  
  <hr>

  <?php echo Form::button(NULL, '<span class="add"></span>' . __('Add'), array('class' => 'button button-gray')); ?>
  <?php echo Form::button(NULL, '<span class="bin"></span>' . __('Delete'), array('class' => 'button button-gray')); ?>
  <?php echo Form::button(NULL, '<span class="accept"></span>' . __('OK'), array('class' => 'button button-gray')); ?>
  <?php echo Form::button(NULL, '<span class="calendar"></span>' . __('Calendar'), array('class' => 'button button-gray')); ?>
  <?php echo Form::button(NULL, '<span class="help"></span>' . __('Help'), array('class' => 'button button-gray')); ?>
  <?php echo Form::button(NULL, '<span class="view-list"></span>' . __('List view'), array('class' => 'button button-gray')); ?>
  <?php echo Form::button(NULL, '<span class="view-grid"></span>' . __('Grid view'), array('class' => 'button button-gray')); ?>
  
  <br>
  <br>
  
  <ul class="action-buttons clearfix">
    <li><?php echo  Html::anchor('#', __('Add') . '<span class="add"></span>', array('class' => 'button button-gray no-text')); ?></li>
    <li><?php echo  Html::anchor('#', __('Edit') . '<span class="pencil"></span>', array('class' => 'button button-gray no-text')); ?></li>
    <li><?php echo  Html::anchor('#', __('Delete') . '<span class="bin"></span>', array('class' => 'button button-gray no-text')); ?></li>
    <li><?php echo  Html::anchor('#', __('OK') . '<span class="accept"></span>', array('class' => 'button button-gray no-text')); ?></li>
    <li><?php echo  Html::anchor('#', __('Calendar') . '<span class="calendar"></span>', array('class' => 'button button-gray no-text')); ?></li>
    <li><?php echo  Html::anchor('#', __('Help') . '<span class="help"></span>', array('class' => 'button button-gray no-text')); ?></li>
    <li><?php echo  Html::anchor('#', __('List view') . '<span class="view-list"></span>', array('class' => 'button button-gray no-text')); ?></li>
    <li><?php echo  Html::anchor('#', __('Grid view') . '<span class="view-grid"></span>', array('class' => 'button button-gray no-text')); ?></li>
  </ul>

  <h3>Pagination</h3>

  <hr>
  
  <ul class="pagination clearfix">
    <li class="first"><?php echo HTML::anchor('#', __('First'), array('class' => 'button-gray')); ?></li>
    <li class="first"><?php echo HTML::anchor('#', '«', array('class' => 'button-gray')); ?></li>
    <?php for($p = 1; $p < 9; $p++) { ?>
      <li><?php echo HTML::anchor('#', $p, array('class' => 'button-gray')); ?></li>
    <?php } ?>
    <li class="first"><?php echo HTML::anchor('#', '»', array('class' => 'button-gray')); ?></li>
    <li class="first"><?php echo HTML::anchor('#', __('Last'), array('class' => 'button-gray')); ?></li>
  </ul>

  <ul class="pagination clearfix">
    <li class="first"><?php echo HTML::anchor('#', __('First'), array('class' => 'button-orange')); ?></li>
    <li class="first"><?php echo HTML::anchor('#', '«', array('class' => 'button-orange')); ?></li>
    <?php for($p = 1; $p < 9; $p++) { ?>
      <li><?php echo HTML::anchor('#', $p, array('class' => 'button-orange')); ?></li>
    <?php } ?>
    <li class="first"><?php echo HTML::anchor('#', '»', array('class' => 'button-orange')); ?></li>
    <li class="first"><?php echo HTML::anchor('#', __('Last'), array('class' => 'button-orange')); ?></li>
  </ul>
  
  <ul class="pagination clearfix">
    <li class="first"><?php echo HTML::anchor('#', __('First'), array('class' => 'button-red')); ?></li>
    <li class="first"><?php echo HTML::anchor('#', '«', array('class' => 'button-red')); ?></li>
    <?php for($p = 1; $p < 9; $p++) { ?>
      <li><?php echo HTML::anchor('#', $p, array('class' => 'button-red')); ?></li>
    <?php } ?>
    <li class="first"><?php echo HTML::anchor('#', '»', array('class' => 'button-red')); ?></li>
    <li class="first"><?php echo HTML::anchor('#', __('Last'), array('class' => 'button-red')); ?></li>
  </ul>
  
  <ul class="pagination clearfix">
    <li class="first"><?php echo HTML::anchor('#', __('First'), array('class' => 'button-blue')); ?></li>
    <li class="first"><?php echo HTML::anchor('#', '«', array('class' => 'button-blue')); ?></li>
    <?php for($p = 1; $p < 9; $p++) { ?>
      <li><?php echo HTML::anchor('#', $p, array('class' => 'button-blue')); ?></li>
    <?php } ?>
    <li class="first"><?php echo HTML::anchor('#', '»', array('class' => 'button-blue')); ?></li>
    <li class="first"><?php echo HTML::anchor('#', __('Last'), array('class' => 'button-blue')); ?></li>
  </ul>
  
  <ul class="pagination clearfix">
    <li class="first"><?php echo HTML::anchor('#', __('First'), array('class' => 'button-green')); ?></li>
    <li class="first"><?php echo HTML::anchor('#', '«', array('class' => 'button-green')); ?></li>
    <?php for($p = 1; $p < 9; $p++) { ?>
      <li><?php echo HTML::anchor('#', $p, array('class' => 'button-green')); ?></li>
    <?php } ?>
    <li class="first"><?php echo HTML::anchor('#', '»', array('class' => 'button-green')); ?></li>
    <li class="first"><?php echo HTML::anchor('#', __('Last'), array('class' => 'button-green')); ?></li>
  </ul>        

  <h3>Progress Bars</h3>

  <hr>
  
  <?php echo HTML::progress(10, 'orange', '10%'); ?>
  <?php echo HTML::progress(20, 'red', '20%'); ?>
  <?php echo HTML::progress(30, 'blue', '30%'); ?>
  <?php echo HTML::progress(40, 'green', '40%'); ?>

  <h3>Notifications</h3>

  <hr>
  
  <?php echo $messages[0]; ?>
  <?php echo $messages[1]; ?>
  <?php echo $messages[2]; ?>
  <?php echo $messages[3]; ?>

  <h3>Closeable Notifications</h3>

  <hr>

  <?php echo $messages[4]; ?>
  <?php echo $messages[5]; ?>
  <?php echo $messages[6]; ?>
  <?php echo $messages[7]; ?>

  <h3>Text Styles</h3>

  <hr>
  <h1>Heading 1</h1>
  <h2>Heading 2</h2>
  <h3>Heading 3</h3>
  <h4>Heading 4</h4>
  <h5>Heading 5</h5>
  <h6>Heading 6</h6>
  <hr>
</div>

<div class="clear"></div>

<div class="grid_2">
  <dl>
    <dt class="code">&lt;a&gt;</dt>
    <dd>
      <a href="#">Lorem ipsum dolor sit amet</a>
    </dd>
    <dt class="code">&lt;abbr&gt;</dt>
    <dd>
      <abbr>Lorem ipsum dolor sit amet</abbr>
    </dd>
    <dt class="code">&lt;code&gt;</dt>
    <dd>
      <code>Lorem ipsum dolor sit amet</code>
    </dd>
  </dl>
</div>
<div class="grid_2">
  <dl>
    <dt class="code">&lt;em&gt;</dt>
    <dd>
      <em>Lorem ipsum dolor sit amet</em>
    </dd>
    <dt class="code">&lt;del&gt;</dt>
    <dd>
      <del>Lorem ipsum dolor sit amet</del>
    </dd>
    <dt class="code">&lt;mark&gt;</dt>
    <dd>
      <mark>Lorem ipsum dolor sit amet</mark>
    </dd>
  </dl>
</div>
<div class="grid_2">
  <dl>
    <dt class="code">&lt;small&gt;</dt>
    <dd>
      <small>Lorem ipsum dolor sit amet</small>
    </dd>
    <dt class="code">&lt;strong&gt;</dt>
    <dd>
      <strong>Lorem ipsum dolor sit amet</strong>
    </dd>
  </dl>
</div>

<div class="clear"></div>

<div class="grid_6">
  <hr>
</div>

<div class="clear"></div>

<div class="grid_2">
  <div class="code">&lt;dl&gt;&lt;dt&gt;&lt;dd&gt;</div>
  <dl>
    <dt>Lorem ipsum</dt>
    <dd>Lorem ipsum dolor sit amet.</dd>
    <dt>Lorem ipsum</dt>
    <dd>Lorem ipsum dolor sit amet.</dd>
    <dt>Lorem ipsum</dt>
    <dd>Lorem ipsum dolor sit amet.</dd>
  </dl>
</div>
<div class="grid_2">
  <div class="code">&lt;ol&gt;&lt;li&gt;</div>
  <ol class="nostyle">
    <li>Lorem ipsum dolor sit amet</li>
    <li>Lorem ipsum dolor sit amet
      <ol>
        <li>Lorem ipsum dolor sit amet</li>
        <li>Lorem ipsum dolor sit amet
          <ol>
            <li>Lorem ipsum dolor sit amet</li>
            <li>Lorem ipsum dolor sit amet</li>
          </ol>
        </li>
      </ol>
    </li>
  </ol>
</div>
<div class="grid_2">
  <div class="code">&lt;ul&gt;&lt;li&gt;</div>
  <ul class="nostyle">
    <li>Lorem ipsum dolor sit amet</li>
    <li>Lorem ipsum dolor sit amet
      <ul>
        <li>Lorem ipsum dolor sit amet</li>
        <li>Lorem ipsum dolor sit amet
          <ul>
            <li>Lorem ipsum dolor sit amet</li>
            <li>Lorem ipsum dolor sit amet</li>
          </ul>
        </li>
      </ul>
    </li>
  </ul>
</div>
</section>
