<div class="main-content grid_5 alpha ">
	<header>
		<?php echo $header_tools; ?>
		<h2><?php echo __("Search result");?></h2>
	</header>
	
	<section class="clearfix">
		<ul class="listing list-view">
			<li>
				<?php echo Html::anchor("panel/user/2435", "&raquo;", array("class" => "more"));?>
				<span class="avatar"><?php echo Html::anchor("user/view/234", Html::image("")); ?></span>
				<span class="timestamp"><?php echo "Category"; ?></span>
				<h3><?php echo Html::anchor("event/view/1234", "Event title"); ?></h3>
				<p>
					<span class="icon"><span class="time"></span><?php echo date("D, d M Y @ H:i", time()); ?>, <?php echo "City - Country"; ?></span>
				</p><br />
				<p>Cras egestas vestibulum nisl, nec eleifend nunc pulvinar non.Cras egestas vestibulum nisl, nec eleifend nunc Cras egestas vestibulum nisl, nec eleifend nunc pulvinar non.Cras egestas vestibulum nisl, nec eleifend nunc pulvinar non.</p>
				<div class="entry-meta"><?php echo __("By ") . Html::anchor("user/view/123", "Lucas Michot") . ", " . "Directeur Technique @ Kwinji"; ?></div>
				<div class="clear"></div>
			</li>
		</ul>
	
	</section>
</div>