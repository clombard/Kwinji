                    <nav class="global">
                        <ul class="clearfix">
                        	<li class="ac avatar">
                            <?php echo $user_card; ?>
                        	</li>
                            <li><?php echo Html::anchor('user/overview', __('Overview'), array('class' => 'nav-icon icon-house')); ?></li>
                            <li><?php echo Html::anchor('streamlined/activity', __('Lastest activity'), array('class' => 'nav-icon icon-time')); ?></li>

							<?php $contact_label = ''; ?>
                            <?php if (count($user->_contacts_waiting) > 0 || count($user->_contacts_wished) > 0): ?>
                            	<?php $contact_label = '<span>' . (count($user->_contacts_waiting) + count($user->_contacts_wished)) . '</span>';?>
                            <?php endif; ?>
                            <li><?php echo Html::anchor('contacts/', $contact_label . __('Contacts'), array('class' => 'nav-icon icon-book')); ?></li>

                            <li><?php echo Html::anchor('event/', '<span>1</span>' .__('Events'), array('class' => 'nav-icon icon-calendar')); ?></li>
                            <li><?php echo Html::anchor('messenger', '<span>2</span>' . __('Messenger'), array('class' => 'nav-icon icon-email')); ?></li>
                            <li><?php echo Html::anchor('firm/view/id/' . $user->_firm->id, __('My company'), array('class' => 'nav-icon icon-building')); ?></li>
                            <li><?php echo Html::anchor('search/', __('Search'), array('class' => 'nav-icon icon-search')); ?></li>
                        </ul>
                    </nav>

                    <nav class="subnav recent">
                        <h4><?php echo __("Recent Contacts"); ?></h4>
                        <ul class="clearfix">
                            <li>
                                <?php echo  Html::anchor('streamlined/profile', '<h5>John Doe</h5><h6>Some Company LTD</h6>', array('class' => 'contact'));  ?>
                                <div class="tooltip left">
                                    <span class="avatar">
                                    </span>
                                    <h5>John Doe</h5>
                                    <h6>Some Company LTD</h6>
                                    <address>123 Some Street, LA</address>
                                </div>
                            </li>
                            <li>
                                 <?php echo  Html::anchor('streamlined/profile', '<h5>Jane Roe</h5><h6>Other Company Inc.</h6>', array('class' => 'contact'));  ?>
                                <div class="tooltip left">
                                    <span class="avatar">
                                    </span>
                                    <h5>Jane Roe</h5>
                                    <h6>Other Company Inc.</h6>
                                    <address>456 Other Street, LA</address>
                                </div>
                            </li>
                        </ul>
                    </nav>

                    <nav class="subnav">
                        <h4>Style Templates</h4>
                        <ul class="clearfix">
                            <li><?php echo Html::anchor('streamlined/layouts', __('Layouts')); ?></li>
                            <li><?php echo Html::anchor('streamlined/styles', __('Styles')); ?></li>
                            <li><?php echo Html::anchor('streamlined/forms', __('Forms')); ?></li>
                            <li><?php echo Html::anchor('streamlined/tables', __('Tables')); ?></li>
                        </ul>
                    </nav>
                    