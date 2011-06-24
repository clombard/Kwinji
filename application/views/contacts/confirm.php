<div class="main-content grid_4 alpha">
	<header>
		<h2><?php echo __("Contacts to confirm"); ?></h2>
	</header>
	<section class="addressbook"> <?php echo $contacts_list; ?> </section>
</div>

<div class="preview-pane grid_3 omega">
	<div class="content">
	<p><?php echo Form::input("", "", array('class' => 'full', 'placeholder' => 'Quick serach ...')); ?></p>
	
	<?php echo $infos; ?>
	<?php echo $search_contacts; ?>
	<?php echo $ads; ?>
	</div>
	<div class="preview"></div>
</div>