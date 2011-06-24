                        <header>
                            <ul class="action-buttons clearfix fr">
                                <li>
                                  <?php echo Html::anchor('http://www.google.fr', __('Help') . '<span class="help"></span>', array('class' => 'button button-gray no-text help', 'rel' => '#overlay'))   ?>
                                </li>
                            </ul>
                            <div class="view-switcher">
                                <h2>Default Layout <a href="#">&darr;</a></h2>
                                <ul>
                                  <?php foreach ($layouts as $layout) { ?>
                                     <li><?php echo Html::anchor($layout['href'], $layout['title']); ?></li>
                                  <?php } ?>
                                </ul>
                            </div>
                        </header>
                        <section class="container_6 clearfix">
                            <div class="grid_6">
                                <div class="message info ac">
                                    <h3>This is the default layout</h3>
                                    <p>Vestibulum ultrices vehicula leo ac tristique. Mauris id nisl nibh. Cras egestas vestibulum nisl, nec eleifend nunc pulvinar non.</p>
                                </div>
                            </div>

                            <hgroup class="grid_6 ac">
                                <h2>Sed magna enim, tempus eu rutrum ornare.</h2>
                                <h4>Donec suscipit fermentum turpis, a feugiat felis tincidunt eu</h4>
                            </hgroup>

                            <figure class="grid_2 ac">
                            	<?php echo Html::image('assets/images/asset1.jpg'); ?>
                                <h3>Lorem Ipsum Dolor Sit Amet</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sit amet massa at lorem molestie egestas. Donec ipsum purus, consequat ac gravida sed, volutpat ut velit.</p>
                            </figure>
                            <figure class="grid_2 ac">
                                <?php echo Html::image('assets/images/asset2.jpg'); ?>
                                <h3>Lorem Ipsum Dolor Sit Amet</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sit amet massa at lorem molestie egestas. Donec ipsum purus, consequat ac gravida sed, volutpat ut velit.</p>
                            </figure>
                            <figure class="grid_2 ac">
                                <?php echo Html::image('assets/images/asset3.jpg'); ?>
                                <h3>Lorem Ipsum Dolor Sit Amet</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sit amet massa at lorem molestie egestas. Donec ipsum purus, consequat ac gravida sed, volutpat ut velit.</p>
                            </figure>

                            <div class="clear"></div>

                            <figure class="grid_3 ac">
                                <h3>Lorem Ipsum Dolor Sit Amet</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sit amet massa at lorem molestie egestas. Donec ipsum purus, consequat ac gravida sed, volutpat ut velit.</p>
                            </figure>
                            <figure class="grid_3 ac">
                                <h3>Lorem Ipsum Dolor Sit Amet</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sit amet massa at lorem molestie egestas. Donec ipsum purus, consequat ac gravida sed, volutpat ut velit.</p>
                            </figure>

                            <div class="clear"></div>

                            <figure class="grid_4 ac">
                                <h3>Lorem Ipsum Dolor Sit Amet</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sit amet massa at lorem molestie egestas. Donec ipsum purus, consequat ac gravida sed, volutpat ut velit.</p>
                            </figure>
                            <figure class="grid_2 ac">
                                <h3>Lorem Ipsum Dolor Sit Amet</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sit amet massa at lorem molestie egestas. Donec ipsum purus, consequat ac gravida sed, volutpat ut velit.</p>
                            </figure>

                        </section>