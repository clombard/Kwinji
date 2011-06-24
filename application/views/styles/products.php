<h3>Add new product</h3>
          
          <?php
// $Id$

echo Form::open('#', array('id' => 'sampleform', 'method' => 'post')); ?>
            <fieldset>
              <legend>Product info</legend>

              <p>
                <?php echo Form::label('producttitle', __('Title'), array('class' => 'required')); ?><br>
                <?php echo Form::input('producttitle', '', array('type' => 'text', 'id' => 'producttitle', 'class' => 'half title')); ?>
                <small>e.g. T-Shirt</small>
              </p>

              <p>
                <?php echo Form::label('productdesc', __('Describe your product')); ?><br>
                <?php echo Form::textarea('productdesc', '', array('class' => 'large full', 'id' => 'productdesc')); ?>
              </p>
              
              <div class="clearfix leading">
                <div class="column width3 first">
                  <p>
                    <?php echo Form::label('productcat', __('Product type'), array('class' => 'full')); ?><br>
                    <?php echo Form::select('productcat', array(1 => __('T-Shirts'), 2 => __('Misc')), 1, array('id' => 'productcat', 'class' => 'full')); ?>
                    <small>e.g. T-Shirts</small>
                  </p>
                  <p><?php echo HTML::anchor('#', __('+ Add new product type')); ?> </p>
                  
                  
                  
                </div>
                
                <div class="column width3">
                  <p>
                     <?php echo Form::label('productvendor', __('Product vendor')); ?><br>
                    <?php echo Form::select('productvendor', array(1 => __('Adidas'), 2 => __('Unknown')), 1, array('id' => 'productvendor', 'class' => 'full')); ?>
                    <small><?php echo __('Product creator or manufacturer e.g. Adidas'); ?></small>

                  </p>
                  <p><?php echo HTML::anchor('#', __('+ Add new category')); ?> </p>
                </div>
              </div>
            
              <p class="box">
              <?php echo __(':save or :cancel', array(
    ':save' => Form::submit(NULL, __('Save'), array('class' => 'btn btn-green big')),
    ':cancel' => html::anchor('#', __('Cancel')),
  ));
?>
              
              </p>

            </fieldset>
          
          
          <?php echo Form::close(); 

