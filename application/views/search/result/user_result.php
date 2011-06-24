<div class="main-content grid_5 alpha ">
	<header>
		<?php echo $header_tools; ?>
		<h2><?php echo __("Search result");?></h2>
	</header>
	
	<section class="clearfix users">
		<ul class="listing list-view">
			<li>
				<?php echo Html::anchor("panel/user/", "&raquo;", array("class" => "more"));?>
				<span class="avatar"><?php echo Html::anchor("user/view/234", Html::image("")); ?></span>
				<span class="timestamp"><?php echo "industry"; ?></span>
				<h3><?php echo Html::anchor("user/view/", "User name"); ?></h3>
				<div class="entry-meta">
					Function<br>
					<abbr>Company name, </abbr><?php echo "City - Country"; ?>
				</div>
				<br />
				<p>Cras egestas vestibulum nisl, nec eleifend nunc pulvinar non.Cras egestas vestibulum nisl, nec eleifend nunc Cras egestas vestibulum nisl, nec eleifend nunc pulvinar non.Cras egestas vestibulum nisl, nec eleifend nunc pulvinar non.</p>
				<br />
				<div class="entry-meta">
					<?php echo Html::anchor("firm/view/", "EM Lyon"); ?>
					<br />
					<?php echo __("Tags : ") . Html::anchor("user/view/123", "J2EE"); ?>
				</div>
				<div class="clear"></div>
			</li>
		</ul>
	
	</section>
</div>
<div class="preview-pane grid_2 omega">
	<div class="content">
		<h3><?php echo __("Filters"); ?></h3>
		<div class="message info">
			<h3><?php echo __("Cities"); ?></h3>
		</div>
		<div class="message info">
			<h3><?php echo __("Regions"); ?></h3>
		</div>
		<div class="message info">
			<h3><?php echo __("Country"); ?></h3>
		</div>
		<div class="message info">
			<h3><?php echo __("Industries"); ?></h3>
		</div>
	</div>
	<?php echo $ads; ?>
	<div class="preview"></div>
</div>