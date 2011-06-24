<div class="colgroup">
	<div class="width2 column first">
		<h3><?php echo $firm['name']; ?></h3>
		<span class="subtitle"><?php echo $firm['industry']; ?></span>
		<figure class="ta-center">
<?php $logo = "static/img/preview-not-available.gif"; ?>
<?php if (isset($firm['logo'])): ?>
	<?php $logo = $firm['logo']; ?>
<?php endif; ?>
<?php if (isset($firm['website'])): ?>
	<?php echo HTML::anchor($firm['website'], HTML::image($logo), array("class" => "no-style")); ?>
<?php else: ?>
	<?php echo HTML::image($logo);?>
<?php endif; ?>
		</figure>
	</div>
	<div class="column width2">
		<h5><?php echo __("Headquarter"); ?></h5>
		<dl>
			<dd><?php echo $firm['address']; ?></dd>
			<dd><?php echo $firm['zip'] . " " . $firm['city']; ?></dd>
			<dd><?php echo $firm['country']; ?></dd>
<?php if (isset($firm['phones']['standard'])): ?>
			<dd><?php echo __("Std : ") . $firm['phones']['standard']; ?></dd>
<?php endif; ?>
<?php if (isset($firm['phones']['fax'])): ?>
			<dd><?php echo __("Fax : ") . $firm['phones']['fax']; ?></dd>
<?php endif; ?>
<?php if (isset($firm['website'])): ?>
			<dd><?php echo HTML::anchor("http://" . $firm['website'], $firm['website'], array("title" => __("Access to website"), "target" => "_blank")); ?></dd>
<?php endif; ?>
		</dl>
	</div>
	<div class="column width2">
		<h5><?php echo __("Details"); ?></h5>
		<dl>
			<dd><?php echo __("RCS : ") . $firm['identity']; ?></dd>
			<dd><?php echo $firm['nbemployees'] . " " . __("employees");?></dd>
			<dd><?php echo __("CA : ") . $firm['ca'] . " " . $firm['currency']; ?></dd>
<?php if (count($firm['international']) > 0): ?>
			<dd>
	<?php foreach ($firm['international'] as $key=>$value): ?>
		<?php echo HTML::anchor($value, HTML::image("static/img/flags/" . $key . ".png"), array("class" => "no-style")); ?>
	<?php endforeach; ?>
			</dd>
<?php endif; ?>
		</dl>
	</div>
	<div class="width6 column first">
		<hr>
	</div>
</div>
<div class="colgroup">
	<div class="width6 column first">
	
		<div id="tabs">
			<ul>
				<li><a class="corner-tl" href="#tabs-1"><?php echo __("Presentation"); ?></a></li>
				<li><a href="#tabs-2"><?php echo __("News"); ?></a></li>
				<li><a href="#tabs-3"><?php echo __("Announces") . " ( " . $firm['announces'] . " )"; ?></a></li>
				<li><a href="#tabs-4"><?php echo __("Calendar") . " ( " . $firm['events'] . " )"; ?></a></li>
				<li><a href="#tabs-5"><?php echo __("Contacts") . " ( " . $firm['contacts'] . " )"; ?></a></li>
				<li><a class="corner-tr" href="#tabs-6"><?php echo __("Followers") . " ( " . $firm['followers'] . " )" ; ?></a></li>
			</ul>
			<div id="tabs-1">
				<?php echo $tab_presentation; ?>
			</div>
			<div id="tabs-2">
				<div class="ta-right"><?php echo Html::anchor("ajax/form/add_news",HTML::image('static/img/add.png', array('class' => 'icon')) . __('Add news post'), array("class" => "btn btn-blue nyroModal"));?></div>
				<hr />
				<?php echo $tab_news; ?>
			</div>
			<div id="tabs-3">
				<div class="ta-right"><?php echo Html::anchor("ajax/form/add_announce",HTML::image('static/img/add.png', array('class' => 'icon')) . __('Add announce'), array("class" => "btn btn-blue nyroModal"));?></div>
				<hr />
				<?php echo $tab_announces; ?>
			</div>
			<div id="tabs-4">
				<div class="ta-right"><?php echo Html::anchor("ajax/form/add_event",HTML::image('static/img/add.png', array('class' => 'icon')) . __('Add event'), array("class" => "btn btn-blue nyroModal"));?></div>
				<hr />
				<?php echo $tab_calendar; ?>
			</div>
			<div id="tabs-5">
				<div class="ta-right">
					<?php echo Html::anchor("ajax/form/add_group_contact",HTML::image('static/img/add.png', array('class' => 'icon')) . __('New Group'), array("class" => "btn btn-blue nyroModal"));?>
					<?php echo Html::anchor("ajax/form/add_contact_to_group",HTML::image('static/img/add.png', array('class' => 'icon')) . __('New Contact'), array("class" => "btn btn-blue nyroModal"));?>
				</div>
				<hr />
				<?php echo $tab_contacts; ?>
			</div>
			<div id="tabs-6">
				<div class="leading clearfix">
					<div class="column width6 first">

					</div>
				</div>
				<div class="colgroup">
					<section class="column width6 first">
						<div class="colgroup ta-center">
							<div class="column width1 first">
								<img class="ta-left" src="static/img/user_32.png" alt="">
							</div>
							<div class="column width1">
								<img class="ta-left" src="static/img/user_32.png" alt="">
							</div>
							<div class="column width1">
								<img class="ta-left" src="static/img/user_32.png" alt="">
							</div>
							<div class="column width1">
								<img class="ta-left" src="static/img/user_32.png" alt="">
							</div>
							<div class="column width1">
								<img class="ta-left" src="static/img/user_32.png" alt="">
							</div>
							<div class="column width1">
								<img class="ta-left" src="static/img/user_32.png" alt="">
							</div>
						</div>
					</section>
				</div>
				<div class="colgroup">
					<section class="column width6 first">
						<div class="colgroup ta-center">
							<div class="column width1 first">
								<img class="ta-left" src="static/img/user_32.png" alt="">
							</div>
							<div class="column width1">
								<img class="ta-left" src="static/img/user_32.png" alt="">
							</div>
							<div class="column width1">
								<img class="ta-left" src="static/img/user_32.png" alt="">
							</div>
							<div class="column width1">
								<img class="ta-left" src="static/img/user_32.png" alt="">
							</div>
							<div class="column width1">
								<img class="ta-left" src="static/img/user_32.png" alt="">
							</div>
							<div class="column width1">
								<img class="ta-left" src="static/img/user_32.png" alt="">
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
	</div>
</div>
