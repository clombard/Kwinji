<header>
	<?php echo $header_tools; ?>
	<h2><?php echo __("Search members");?></h2>
</header>

<section class="container_6 clearfix">
	<!-- the tabs -->
	<div class="tabbed-pane">
		<ul class="tabs">
			<li><?php echo HTML::anchor('#Members', __('All members')); ?></li>
			<li><?php echo HTML::anchor('#Freelance', __('Freelance')); ?></li>
			<li><?php echo HTML::anchor('#Offers', __('Offers')); ?></li>
			<li><?php echo HTML::anchor('#Events', __('Events')); ?></li>
			<li><?php echo HTML::anchor('#Alumni', __('Alumni')); ?></li> 
			<li><?php echo HTML::anchor('#Quick', __('Quick Search')); ?></li> 
		</ul>

	    <!-- tab "panes" -->
		<div class="panes clearfix">
			<section class="clearfix"><?php echo $tab_all_members; ?></section>
			<section class="clearfix"><?php echo $tab_freelance; ?></section>
			<section class="clearfix"><?php echo $tab_offer; ?></section>
			<section class="clearfix"><?php echo $tab_event; ?></section>
			<section class="clearfix"><?php echo $tab_alumni; ?></section>
			<section class="clearfix"><?php echo $tab_quick; ?></section>
		</div>
	</div>

</section>
