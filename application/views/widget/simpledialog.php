    <!-- simple dialog -->
    <div class="widget modal" id="simpledialog">
        <header><h2>This is a simple modal dialog</h2></header>
        <section>
            <p>
                Are you sure you want to do this?
            </p>

            <!-- yes/no buttons -->
            <p>
                <?php echo Form::button(NULL, __('Yes'), array('class' => 'button button-blue close')); ?>
                <?php echo Form::button(NULL, __('No'), array('class' => 'button button-gray close')); ?>
            </p>
        </section>
    </div>