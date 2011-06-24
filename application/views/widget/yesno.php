   <!-- yes/no dialog -->
    <div class="widget modal" id="yesno">
        <header><h2>This is a modal dialog</h2></header>
        <section>
            <p>
                You can only interact with elements that are inside this dialog.
                To close it click a button or use the ESC key.
            </p>

            <!-- yes/no buttons -->
            <p>
                <?php echo Form::button(NULL, __('Yes'), array('class' => 'button button-blue close')); ?>
                 <?php echo Form::button(NULL, __('No'), array('class' => 'button button-gray close')); ?>
            </p>
        </section>
     </div>