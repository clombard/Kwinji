<header> 
	<?php echo $header_tools; ?> 
	<?php echo $header_title; ?> 
</header>

<section class="container_6 clearfix company">

	<div class="grid_2 alpha" style="vertical-align: center;">
		<figure class="ac avatar"> 
			<?php $logo = "static/img/preview-not-available.gif"; ?> 
			<?php if (isset($firm->logo)): ?>
				<?php $logo = $firm->logo; ?>
			<?php endif; ?>
			<?php if (isset($firm->website)): ?>
				<?php echo HTML::anchor($firm->website, HTML::image($logo), array("target" => "_blank")); ?>
			<?php else: ?>
	   			<?php echo HTML::image($logo);?>
			<?php endif; ?>
		</figure>
	</div>
	<div class="grid_4 omega">
		<h2><?php echo $firm->industry; ?></h2>
	</div>
	<div class="grid_4 omega">
		<div class="message success">
			<div class="grid_2 alpha omega">
				<h3><?php echo __("Headquarter"); ?></h3>
				<dl>
					<dd><?php echo $firm->street; ?></dd>
					<dd><?php echo $firm->_place_city->code . " " . $firm->_place_city->name; ?></dd>
					<dd><?php //echo KCountry::get($firm->ref_place->country_iso); ?></dd>
				<?php if (isset($firm->phones['office'])): ?>
					<dd><?php echo __("Std : ") . $firm->phones['office']; ?></dd>
				<?php endif; ?>
				<?php if (isset($firm->phones['fax'])): ?>
					<dd><?php echo __("Fax : ") . $firm->phones['fax']; ?></dd>
				<?php endif; ?>
				<?php if (isset($firm->website)): ?>
					<dd><?php echo HTML::anchor($firm->website, $firm->website, array("title" => __("Access to website"), "target" => "_blank")); ?></dd>
				<?php endif; ?>
				</dl>
			</div>
	
			<div class=" grid_2 alpha omega">
				<h3><?php echo __("Details"); ?></h3>
				<dl>
				<?php foreach ($firm->identities as $identity): ?>
					<dd><?php echo $identity['name'] . ' : ' . $identity['value']; ?></dd>
				<?php endforeach; ?>
					<dd><?php echo $firm->employees . " " . __("employees"); ?></dd>
					<dd><?php echo __("Turnover : ") . $firm->turnover . " " . $firm->currency; ?></dd>
				<?php //if (count($firm['international']) == -1): ?>
					<dd>
		      		<?php //foreach ($firm['international'] as $key => $value): ?>
		      		<?php //echo HTML::anchor($value, HTML::image("static/img/flags/" . $key . ".png"), array("class" => "no-style")); ?>
		      		<?php //endforeach; ?>
					</dd>
				<?php //endif; ?>
				</dl>
			</div>
			<div class="clear"></div>
		</div>
	</div>

	<div class="grid_4 omega">
		<div class="grid_2 alpha">
		<?php if (!in_array($firm->id, (array)$user->firms_followed)): ?>
			<?php echo Html::anchor("ajax/follow_firm/fid/" . $firm->id . "/uid/" . $user->id, __("Follow this company"), array('class' => 'button button-blue notify', 'data-id' => $firm->id.$user->id)); ?>
		<?php endif; ?>
		</div>
	</div>
</section>
<section class="container_6 clearfix">

	<hr />
	<!-- the tabs -->
	<div class="tabbed-pane">
		<ul class="tabs">
			<li><?php echo HTML::anchor('#tabs-1', __('Presentation')); ?></li>
<?php if (count($news) > 0): ?>
			<li><?php echo HTML::anchor('#tabs-2', __('News') . " (" . count($news) . ")"); ?></li>
<?php endif; ?>
<?php if (count($offers) > 0): ?>
			<li><?php echo HTML::anchor('#tabs-3', __('Offers') . " (" . count($offers) . ")"); ?></li>
<?php endif; ?>
<?php if (count($events) > 0): ?>
			<li><?php echo HTML::anchor('#tabs-4', __('Events') . " (" . count($events) . ")"); ?></li>
<?php endif; ?>
<?php if (count($firm->groups_users) > 0): ?>
			<li><?php echo HTML::anchor('#tabs-5', __('Contacts') . " (" . count($firm->groups_users) . ")"); ?></li> 
<?php endif; ?>
<?php if (count(KData::getFirmFollowers($firm->id)) > 0): ?>
			<li><?php echo HTML::anchor('#tabs-6', __('Followers') . " (" . count(KData::getFirmFollowers($firm->id)) . ")"); ?></li>      
<?php endif; ?>
		</ul>

		<!-- tab "panes" -->
		<div class="panes clearfix">
			<section><?php echo $tab_presentation; ?></section>
<?php if (count($news) > 0): ?>
			<section><?php echo $tab_news; ?></section>
<?php endif; ?>
<?php if (count($offers) > 0): ?>
			<section><?php echo $tab_announces; ?></section>
<?php endif; ?>
<?php if (count($events) > 0): ?>
			<section><?php echo $tab_events; ?></section>
<?php endif; ?>
<?php if (count($firm->groups_users) > 0): ?>
			<section class="contacts_list"><?php echo $tab_contacts; ?></section>
<?php endif; ?>
<?php if (count(KData::getFirmFollowers($firm->id)) > 0): ?>
			<section class="contacts_list"><?php echo $tab_followers; ?></section>
<?php endif; ?>
		</div>
	</div>

</section>
