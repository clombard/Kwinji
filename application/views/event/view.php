<header>
	<div class="action-buttons clearfix fr">
		<?php echo Html::anchor("event/forward/" . $event->id, "Forward this event", array("class" => "button button-gray")); ?>
		<?php echo Html::anchor("event/confirm/" . $event->id, "Confirm", array("class" => "button button-green")); ?>
		<?php echo Html::anchor("event/interest/" . $event->id, "Interested", array("class" => "button button-blue")); ?>
		<?php echo Html::anchor("event/cancel/" . $event->id, "Cancel", array("class" => "button button-red")); ?>
	</div>
	<h2><?php echo $event->name; ?></h2>
</header>
<section class="container_6 clearfix event">
	<div class="grid_2 alpha" style="height: 100%; ">
		<figure class="ac avatar">
			<?php $image = "assets/images/user_64.png"; ?>
			<?php if ($event->_user->image != null): ?>
				<?php $image = $event->_user->image; ?>
			<?php endif; ?>
			<?php echo Html::anchor("user/view/" . $event->_user->id, Html::image($image)); ?>
			<h4><?php echo Html::anchor("user/view/" . $event->_user->id, $event->_user->displayname); ?></h4>
			<?php echo $event->_user->function . ", " . $event->_user->_firm->name; ?>
		</figure>
		<hr>
		<div class="action-buttons clearfix fr">
			<?php echo Html::anchor('#', '<span class="asterisk_yellow"></span> ' . count($event->_user->contacts_accepted) . " " . __('Contacts'), array('class' => 'modalInput button button-blue asterisk_yellow', 'rel' => '#contacts')); ?>
		</div>
		<ul class="action-buttons clearfix">
			<li><?php echo Html::anchor('messenger/send/' . $event->_user->id, __('Send a message') . '<span class="email"></span>', array('class' => 'button button-gray no-text email', 'title' => 'Send a message')); ?></li>
			<li><?php echo Html::anchor('user/add/' . $event->_user->id, __('Add to contacts') . '<span class="user_add"></span>', array('class' => 'button button-gray no-text user_add', 'title' => 'Add to contacts')); ?></li>
			<li><?php echo Html::anchor('watchlist/add/' . $event->_user->id, __('Follow this contact') . '<span class="star"></span>', array('class' => 'button button-gray no-text star', 'title' => 'Follow this contact')); ?></li>
		</ul>
		<br>
		<?php if (count($his_events) > 0): ?>
		<div class="message info clearfix">
			<h3><?php echo $event->_user->displayname . __("'s other events");?></h3>
			<hr>
			<?php foreach ($his_events as $his_event): ?>
				<?php if ($his_event->id != $event->id): ?>
			<h4><?php echo Html::anchor("event/view/" . $his_event->id, $his_event->name);?></h4>
			<span class="icon"><span class="time"></span><?php echo date("D, d M Y @ H:i", $his_event->dt_starts); ?></span><br />
			<span class="icon"><span class="map"></span><?php echo $his_event->_place_city->name . " - " . $his_event->_place_country->name; ?></span>
			<p><?php echo substr($his_event->content, 0, 150); ?></p>
			<hr>
				<?php endif; ?>
			<?php endforeach; ?>
			<?php echo Html::anchor("event/all/" . $event->_user->id, __("View all"), array("class" => "fr"));?>
		</div>
		<?php endif; ?>
	</div>
	<div class="grid_4 omega fr">
		<?php echo Html::anchor("event/all/" . $event->_place_country->id, "Events | " . $event->_place_country->name) . " &gt; " . Html::anchor("event/group/" . $event->_category->id, $event->_category->group) . " &gt; " . Html::anchor("event/all/" . $event->_category->id, $event->_category->category); ?>
		<hr>
	</div>
	<div class="grid_2 fr">
		<div class="message warning">
			<h3><?php echo __("Dates"); ?></h3>
			<p>
				<?php echo date("D, d M Y @ H:i", $event->dt_starts) . " &gt; " . __("Start"); ?><br />
				<?php echo date("D, d M Y @ H:i", $event->dt_finishes) . " &gt; " . __("End"); ?>
			</p>
		</div>
		<div class="message error">
		<h3><?php echo __("Registration deadline"); ?></h3>
		<abbr>
			<b><?php echo date("l d F Y", $event->dt_register_ends); ?></b><br/>
			<?php echo $event->attendees_max_count - count($event->atendees) . __(" spot(s) left."); ?></abbr>
		</div>
	</div>
	<div class="grid_2 omega fr">
		<div class="action-buttons clearfix">
			<span><?php echo __("Share"); ?></span> 
			<?php echo Html::anchor('#', '<span class="twitter"></span>' . __('Twitter'), array('class' => 'icon')); ?>
			<?php echo Html::anchor($event->_firm->facebook, '<span class="facebook"></span>' . __('Facebook'), array('class' => 'icon', 'target' => '_blank')); ?>
		</div>
		<hr>
			<dt>PAF : 20 &euro;</dt>
			<dd>
				<?php  echo __(':x out of :total maximum attendees.', array(':total' => $event->attendees_max_count, ':x' => Html::anchor('#', __(':nbattendees Attendees', array(":nbattendees" => count($event->atendees)))))) ;  ?>
			</dd>
			<dd><?php echo Html::anchor("event/attendees/", count($event->_followers) . " " . __("Confirmed"));?></dd>
			<dd><?php echo Html::anchor("event/attendees/", " 24 " . __("Are interested"));?></dd>
		</dl>
	</div>
	<div class="grid_4 omega fr">
		<h3><?php echo __("Description"); ?></h3>
		<hr>
		<p><?php echo $event->content; ?></p>
		<h3><?php echo __("Location"); ?></h3>
		<hr>
	</div>
	<div class="grid_4 omega fr">
		<p>
			<?php if ($event->street_details != NULL): ?>
				<?php echo $event->street_details; ?><br />
			<?php endif; ?>
			<?php echo $event->street; ?><br />
			<?php echo $event->_place_city->code . " " . $event->_place_city->name; ?><br />
			<?php echo $event->_place_country->name; ?><br />
		</p>
	</div>
	<div class="grid_4 omega fr">
		<hr>
		<div id="map_canvas" style="width: 500px; height: 300px"></div>
		<h3><?php echo __("Organized by"); ?></h3>
		<hr>
	</div>
	<div class="grid_3 omega fr">
		<h3><abbr><?php echo $event->_firm->name; ?></abbr></h3>
		<p>
			<?php echo $event->_firm->street; ?><br />
			<?php echo $event->_firm->_place_city->code . " " . $event->_firm->_place_city->name; ?><br />
			<?php echo $event->_firm->_place_country->name; ?><br />
			<?php echo $event->_firm->phones['office']; ?><br />
			<?php echo $event->_firm->phones['fax']; ?><br />
			<?php echo Html::anchor($event->_firm->website, $event->_firm->website); ?>
		</p>
	</div>
	<div class="grid_1 alpha omega ac avatar fr">
		<?php echo Html::anchor("firm/view/id/" . $event->_firm->id, Html::image($event->_firm->logo));?>
	</div>
</section>
