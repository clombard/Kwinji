<div class="main-content grid_4 alpha">
                        <header>
                            <ul class="action-buttons clearfix fr">
                                
                            <li><?php echo Html::anchor('http://www.google.fr', __('Help') . '<span class="help"></span>', array('class' => 'button button-gray no-text help', 'rel' => '#overlay'))   ?>
                                
                                  </li>
                            
                            </ul>
                            <h2>
                                Latest Activity
                            </h2>
                        </header>
                        <section>
                            <ul class="listing list-view">
                              <?php foreach ($activities as $activity) { ?>
                                <li class="<?php echo $activity['type']; ?>">
                                    <?php echo HTML::anchor($activity['details_panel'], '»', array('class' => 'more')); ?>
                                    <span class="timestamp"><?php echo $activity['timestamp']; ?></span>
                                    <?php echo HTML::anchor('#', $activity['title']); ?>
                                    <p><?php echo $activity['text']; ?></p>
                                    <div class="entry-meta"><?php echo $activity['meta']; ?></div>
                                </li>
                              <?php } ?>
                            
                            </ul>
                            <ul class="pagination clearfix">
                                <li><a class="button-blue" href="#">«</a></li>
                                <li><a class="current button-blue" href="#">1</a></li>
                                <li><a class="button-blue" href="#">2</a></li>
                                <li><a class="button-blue" href="#">3</a></li>
                                <li><a class="button-blue" href="#">»</a></li>
                            </ul>
                        </section>
                    </div>
                    
                    <div class="preview-pane grid_3 omega">
                        <div class="content">
                            <h3><?php echo __('Preview pane'); ?></h3>
                            <p>This is the preview pane. Click on the more button on an item to view more information.</p>
                            <div class="message info">
                                <h3>Helpful Tips</h3>
   
                                <?php echo Html::image('assets/images/lightbulb_32.png', array('class' => 'fl')); ?>
                                <p>Phasellus at sapien eget sapien mattis porttitor. Donec ultricies turpis pulvinar enim convallis egestas. Pellentesque egestas luctus mattis. Nulla eu risus massa, nec blandit lectus. Aliquam vel augue eget ante dapibus rhoncus ac quis risus.</p>
                            </div>
                        </div>
                        <div class="preview">
                        </div>
                    </div>