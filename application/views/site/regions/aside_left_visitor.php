<nav class="global">
<ul class="clearfix">
  <li class="ac avatar"><?php echo $user_card; ?>
  </li>
  <li><?php echo Html::anchor('user/overview', __('Overview'), array('class' => 'nav-icon icon-house')); ?></li>
  <li><?php echo Html::anchor('streamlined/activity', __('Lastest activity'), array('class' => 'nav-icon icon-time')); ?></li>
  <li><?php echo Html::anchor('contacts/',  __(':x contacts', array(':x'=>count($user->_contacts_accepted))), array('class' => 'nav-icon icon-book')); ?></li>
  <li><?php echo Html::anchor('event/', '<span>1</span>' .__('Events'), array('class' => 'nav-icon icon-calendar')); ?></li>
  <li><?php echo Html::anchor('messenger', '<span>2</span>' . __('Messenger'), array('class' => 'nav-icon icon-email')); ?></li>
  <li><?php echo Html::anchor('firm/view/123', __('My company'), array('class' => 'nav-icon icon-building')); ?></li>
</ul>
</nav>

</hr>

<nav class="ac subnav">
<div class="qrcode">
  <p class="ac"><strong><?php echo __('My Kwinji card'); ?></strong></p>
  <?php echo HTML::image('https://chart.googleapis.com/chart?cht=qr&chs=100x100&chl=http://www.viadeo.com'); ?>
</div>
</nav>