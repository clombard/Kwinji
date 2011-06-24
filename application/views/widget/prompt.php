     <!-- user input dialog -->
     <div class="widget modal" id="prompt">
         <header><h2>This is a modal dialog</h2></header>
         <section>
             <p>
                 You can only interact with elements that are inside this dialog.
                 To close it click a button or use the ESC key.
             </p>

             <!-- input form. you can press enter too -->
             <?php echo Form::open(); ?>
                 <?php echo Form::input(NULL, array('type' => 'text')); ?>
                 <hr />
                 <?php echo Form::button(NULL, __('OK'), array('type' => 'submit', 'class' => 'button button-gray')); ?>
                 <?php echo Form::button(NULL, __('Cancel'), array('type' => 'button', 'class' => 'button button-gray close')); ?>
             <?php echo Form::close(); ?>
         </section>
      </div>