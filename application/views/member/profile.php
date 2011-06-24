

                    <div class="main-content grid_4 alpha">
                        <header class="clearfix">
                             <hgroup>
                                 <h2>
                                     <?php echo $header_tools; ?>
                                     <?php echo $user['fullname']; ?>
                                 </h2>
                                 <h4><a href="#"><?php echo $user['position']; ?></a> at <a href="#"><?php echo $user['company']; ?></a></h4>
                             </hgroup>
                             <p class="tags"><?php echo HTML::anchor('#', __('Add tags')); ?></p>
                        </header>
                        <section>
                            <form method="post" style="width: 400px;">
                                <textarea class="" style="height: 80px; width: 100%;" placeholder="<?php echo __("What's on your mind")?>"></textarea>
                                <?php echo Form::button(NULL, __('Add note'), array('class' => 'fr button button-gray')); ?>
                            <?php echo Form::close(); ?>
                            <div class="clear"></div>
                            <h3>History</h3>
                            <ul class="listing list-view">
                              <?php foreach ($user['activities'] as $activity) { ?>
                                <li class="note">
                                    <?php echo Html::anchor('panel/editnote' ,'>', array('class' => 'more'));  ?>
                                    <span class="timestamp"><?php echo $activity['timestamp']; ?></span>
                                    <p><?php echo $activity['text']; ?></p>
                                    <div class="entry-meta">
                                        <?php echo $activity['meta']; ?>
                                    </div>
                                </li>
                              <?php } ?>
                            </ul>
                        </section>
                    </div>

                    <div class="preview-pane grid_3 omega">
                        <div class="content">
                            <h3>John's contact information</h3>
                            <ul class="profile-info">
                                <li class="email"><?php echo $user['mail']; ?><span>email</span></li>
                                <li class="phone"><?php echo $user['phone']; ?><span>home</span></li>
                                <li class="mobile"><?php echo $user['mobile']; ?><span>mobile</span></li>
                                <li class="phone"><?php echo $user['fax']; ?><span>work</span></li>
                            </ul>
                            <h3>Tasks About John</h3>
                            None so far. <a href="#">Add a task now</a>
                            <h3>Additional info</h3>
                            <ul class="profile-info">
                                <li class="calendar-day"><?php echo $user['birthday']; ?><span>birthday</span></li>
                                <li class="calendar-day"><?php echo $user['hire']; ?><span>hire date</span></li>
                                <li class="house"><?php echo $user['street']; ?><span>home address</span></li>
                                <li class="building"><?php echo $user['building']; ?><span>office address</span></li>
                            </ul>
                        </div>
                        <div class="preview">
                        </div>
                    </div>
