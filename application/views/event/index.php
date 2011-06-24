<div class="main-content grid_5 alpha events">
	<header>
		<?php echo $header_tools; ?>
		<?php echo $header_title; ?>
	</header>
	<section>
		<?php $events_count = count($my_events); ?>
		<h2><?php echo __("Coming soon : ") . $events_count . " " . __("events"); ?></h2>
		<ul class="listing list-view">
			<?php foreach ($my_events as $event): ?>
			<li>
				<?php echo Html::anchor("panel/event/" . $event->id, "&raquo;", array("class" => "more"));?>
				<span class="avatar"><?php echo Html::anchor("event/view/" . $event->id, Html::image($event->logo)); ?></span>
				<span class="timestamp"><?php echo $event->_category->category; ?></span>
				<h3><?php echo Html::anchor("event/view/" . $event->id, $event->name); ?></h3>
				<span class="icon"><span class="time"></span><?php echo date("D, d M Y @ H:i", $event->dt_starts); ?>, <?php echo $event->_place_city->name . " - " . $event->_place_country->name; ?></span><br />
				<p><?php echo substr($event->content, 0, 300) . "..."; ?></p>
				<div class="action-buttons clearfix fr">
					<?php echo Html::anchor("", "<span class='tag_blue'></span> 20 €", array("class" => "button button-orange")); ?>
					<?php echo Html::anchor("", __(":x attendees", array(":x" => count($event->atendees))), array("class" => "button button-green")); ?>
				</div>
				<div class="entry-meta"><?php echo __("By ") . Html::anchor("user/view/" . $event->_user->id, $event->_user->displayname) . ", " . "Directeur Technique @ Kwinji"; ?></div>
				<div class="clear"></div>
			</li>
			<?php endforeach; ?>
		</ul>
		<ul class="pagination clearfix">
			<li><a href="#" class="button-blue">&laquo;</a></li>
			<li><a href="#" class="current button-blue">1</a></li>
			<li><a href="#" class="button-blue">2</a></li>
			<li><a href="#" class="button-blue">3</a></li>
			<li><a href="#" class="button-blue">&raquo;</a></li>
		</ul>
	</section>
</div>

<div class="preview-pane grid_2 omega">
	<div class="content">
		<div class="message info">
			<h3>Helpful Tips</h3>
			<img src="assets/images/lightbulb_32.png" class="fl" />
			<p><?php echo __("This is the preview pane. Click on the arrow ('more') button on an item to view more information."); ?></p>
			<p><?php echo __("Add, view all events by clicking on window menu."); ?></p>
		</div>
		<h3><?php echo __("Advertise"); ?></h3>
		<ul>
			<li>
				<hr>
				<h4><?php echo Html::anchor("news/view", 'Publicité'); ?></h4>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sit amet massa at lorem molestie egestas. Donec ipsum purus, consequat ac gravida sed, volutpat ut velit.</p>
			</li>
		</ul>
		<h3><?php echo __("Latest events"); ?></h3>
		<ul>
			<?php for ($i = 0; $i < 6; $i++): ?>
			<li>
				<hr>
				<h4><?php echo Html::anchor("news/view", 'Dernier événement ...');?></h4>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sit amet massa at lorem molestie egestas. Donec ipsum purus, consequat ac gravida sed, volutpat ut velit.</p>
			</li>
			<?php endfor; ?>
		</ul>
	</div>
	<div class="preview"></div>
</div>
