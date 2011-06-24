<header>
<h3><?php echo __('You might also want to check out...'); ?></h3>
</header>
<dl class="first">
  <dt>
  <?php echo HTML::image('static/img/style.png', array('width'=>16, 'height'=>16, 'alt'=>'Basic styles')); ?>
  </dt>
  <dd>
    <?php echo HTML::anchor('styles', __('Basic styles'));  ?>
  </dd>
  <dd class="last">Basic elements and styles</dd>

  <dt>
  <?php echo HTML::image('static/img/book.png', array('width'=>16, 'height'=>16)); ?>
  </dt>
  <dd>
    <?php echo HTML::anchor('http://omnipotent.net/jquery.sparkline/', __('jQuery Sparkline'));  ?>
  </dd>
  <dd class="last">jQuery Sparkline documentation</dd>

  <dt>
  <?php echo HTML::image('static/img/book.png', array('width'=>16, 'height'=>16)); ?>
  </dt>
  <dd>
    <?php echo HTML::anchor('http://code.google.com/p/flot/', __('jQuery flot'));  ?>
  </dd>
  <dd class="last">jQuery flot documentation</dd>
</dl>
