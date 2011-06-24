
<nav class="global">
<ul class="clearfix">
	<li><?php echo Html::anchor('user/edit', __('Account settings'), array('class' => 'nav-icon icon-user')); ?>
	</li>
	<li><?php echo Html::anchor('streamlined/activity', __('Privacy settings'), array('class' => 'nav-icon icon-time')); ?>
	</li>
	<li><?php echo Html::anchor('streamlined/contacts', '<span>2</span>' . __('Contacts'), array('class' => 'nav-icon icon-book')); ?>
	</li>
	<li><?php echo Html::anchor('event/', '<span>1</span>' .__('Events'), array('class' => 'nav-icon icon-calendar')); ?>
	</li>
	<li><?php echo Html::anchor('messenger', '<span>2</span>' . __('Messenger'), array('class' => 'nav-icon icon-email')); ?>
	</li>
	<li><?php echo Html::anchor('firm/view/123', __('My company'), array('class' => 'nav-icon icon-building')); ?>
	</li>
</ul>
</nav>
