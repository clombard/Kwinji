
                        <header>
                            <ul class="action-buttons clearfix fr">
                                <li><a href="documentation/index.html" class="button button-gray no-text help" rel="#overlay">Help<span class="help"></span></a></li>
                            </ul>
                            <h2>
                                Tables
                            </h2>
                        </header>
                        <section class="container_6 clearfix">
                            <div class="grid_6">
                                <h3>Table with pagination and sorting</h3>

                                <hr />

                                <table class="datatable paginate sortable full">
                                    <thead>
                                        <tr>
                                            <th>Browser</th>
                                            <th>Platform</th>
                                            <th>Table Cell</th>
                                            <th>Table Cell</th>
                                            <th>Table Cell</th>
                                            <th style="width:70px"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                 
                                        <?php foreach ($browsers as $browser) { ?>
                                        <tr>
                                          <td><?php echo $browser['browser']; ?></td>
                                            <td><?php echo $browser['os']; ?></td>
                                            <td>Table Cell</td>
                                            <td>Table Cell</td>
                                            <td>Table Cell</td>
                                            <td>
                                                <ul class="action-buttons">
                                                  <li><?php echo Html::anchor('#', '<span class="pencil"></span>' . __('Edit'), array('class' => 'button button-gray no-text')); ?>   </li>
                                                  <li><?php echo Html::anchor('#', '<span class="bin"></span>' . __('Delete'), array('class' => 'button button-gray no-text')); ?>   </li>
                                                </ul>
                                            </td>
                                          
                                        
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

                            </div>
                            <div class="grid_6">
                                <h3>Usage</h3>

                                <hr />

                                <div class="message warning">
                                     <b>NOTE:</b> Make sure you have included js/jquery.tables.js after jquery.tools.min.js and the corresponding stylesheet, css/tables.css
                                </div>

                                <h4>Automatically enable pagination on a table</h4>
                                <p>To automatically paginate a table, add the <span class="code">paginate</span> class </p>
                                <h5>HTML</h5>
                                <code>
                                    &lt;table class="paginate"&gt;<br />
                                    &lt;/table&gt;
                                </code>
                                <h4>Manually enable pagination on a table</h4>
                                <h5>HTML</h5>
                                <code>
                                    &lt;table class="mytableclass"&gt;<br />
                                    &lt;/table&gt;
                                </code>
                                <h5>Add the following javascript</h5>
                                <code>
                                    $(document).ready(function(){<br />
                                        $("table.mytableclass").paginate({rows: 10, buttonClass: 'button-blue'});<br />
                                    });
                                </code>
                                <p><span class="code">rows</span>: The number of rows to show per page</p>
                                <p><span class="code">buttonClass</span>: button-gray, button-blue, button-green, button-orange</p>
                                <h4>Automatically enable sorting on a table</h4>
                                <p>To automatically allow column sorting on a table, add the <span class="code">sortable</span> class </p>
                                <h5>HTML</h5>
                                <code>
                                    &lt;table class="sortable"&gt;<br />
                                    &lt;/table&gt;
                                </code>
                                <h4>Manually enable sorting on a table</h4>
                                <h5>HTML</h5>
                                <code>
                                    &lt;table class="mytableclass"&gt;<br />
                                    &lt;/table&gt;
                                </code>
                                <h5>Add the following javascript</h5>
                                <code>
                                    $(document).ready(function(){<br />
                                        $("table.mytableclass").tablesort();<br />
                                    });
                                </code>
                            </div>
                        </section>