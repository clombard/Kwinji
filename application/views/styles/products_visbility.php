<header>
              <h3>Product Visibility</h3>
            </header>
            <section>
              Choose whether or not you want this product to be publicly visible.
              <p>
                    <?php 
                  $options = array(1=>__('published'), 2 => __('draft'));
                  $selected = 1;
                  echo Form::select('visibility', $options,$selected, array('id'=>'visibility', 'class'=>'full'));
                  
                  ?>
              </p>
            </section>