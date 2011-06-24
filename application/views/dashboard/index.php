
                        <header>
                            <ul class="action-buttons clearfix fr">
                                <li>
                                  <?php echo Html::anchor('http://www.google.fr', __('Help') . '<span class="help"></span>', array('class' => 'button button-gray no-text help', 'rel' => '#overlay'))   ?>
                                </li>
                            </ul>
                            <h2><?php echo __("Dashboard");?></h2>
                        </header>
                        <section class="container_6 clearfix">
                        	<div class="grid_4 alpha">
								<?php echo Form::open("", array("method" => "post", "class" => "clearfix"));?>
	                                <textarea class="" style="height: 40px; width: 97%;" placeholder="<?php echo __("What's on your mind")?>"></textarea>
	                                <?php echo Form::button(NULL, __('Send'), array('class' => 'fr button button-green')); ?>
	                            <?php echo Form::close(); ?>
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
							</div>
                            <figure class="grid_2 omega ac">
                                <?php echo Html::image('assets/images/asset1.jpg'); ?>
                                <h3>Lorem Ipsum Dolor Sit Amet</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sit amet massa at lorem molestie egestas. Donec ipsum purus, consequat ac gravida sed, volutpat ut velit.</p>
                            </figure>
                            <div class="other-options grid_6">
                                <h3 class="other">Other things to do...</h3>
                                <ul>
                                    <li>
                                        <h4><?php echo HTML::anchor('#', __('Lorem Ipsum Dolor Sit Amet')); ?></h4>
                                        <p>Nam sit amet massa at lorem molestie egestas.</p>
                                    </li>
                                    <li>
                                        <h4><?php echo HTML::anchor('#', __('Lorem Ipsum Dolor Sit Amet')); ?></h4>
                                        <p>Nam sit amet massa at lorem molestie egestas.</p>
                                    </li>
                                    <li>
                                        <h4><?php echo HTML::anchor('#', __('Lorem Ipsum Dolor Sit Amet')); ?></h4>
                                        <p>Nam sit amet massa at lorem molestie egestas.</p>
                                    </li>
                                </ul>
                            </div>
                        </section>
                    </div>

                </section>