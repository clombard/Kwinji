<?php if (isset($events) && count($events) > 0): ?>
	<?php $sameDate = null;?>
	<?php foreach ($events as $event):?>
		<?php if ($sameDate != date("D, d F Y", $event->dt_starts)): ?>
			<?php $sameDate = date("D, d F Y", $event->dt_starts); ?>
<h2><?php echo date("D, d F Y", $event->dt_starts);?></h2>
		<?php else: ?>
<hr>			
		<?php endif; ?>
<div class="grid_6 item-result" data-id="<?php echo $event->id; ?>">
	<div class="grid_1 ac alpha">
		<?php $image = "static/img/preview-not-available.gif"; ?>
		<?php echo HTML::anchor("event/view/" . $event->id, Html::image($image)); ?>
	</div>
	<div class="grid_4 alpha omega">
		<h3><?php echo HTML::anchor("event/view/" . $event->id, $event->name, array("class" => "no-style black")); ?></h3>
		<abbr><?php echo $event->teaser; ?></abbr><br/>
		<span class="icon"><span class="time"></span><?php echo __("Start to ") . date("H:i", $event->dt_starts); ?></span> @ 
		<span class="subtitle"><?php echo $event->_place_city->name .  ' (' .$event->_place_city->code . ')' . ' - ' . $event->_place_country->name; ?></span><br/>
		<p><?php echo substr($event->content, 0, 300); ?></p>
		<small>
			<b><?php echo __("Author(s) : "); ?></b>
			<?php echo HTML::anchor("user/view/". $event->_user->id, $event->_user->displayname); ?>
			<?php $index = 0; ?>
			<?php foreach ($event->_users as $contributor): ?>
				<?php if (count($event->_users) > $index): ?>
					<?php $index++; echo ", "; ?>
				<?php endif; ?>
				<?php echo HTML::anchor("user/view/".$contributor->id, $contributor->displayname); ?>
			<?php endforeach; ?>
			
			| <b><?php echo __("Tags : "); ?></b>
			<?php $index = 0; ?>
			<?php if (isset($event->keywords)): ?>
				<?php foreach ($event->keywords as $tag): ?>
					<?php echo HTML::anchor("#", $tag, array("class" => "tag")); ?>
				<?php endforeach; ?>
			<?php endif; ?>
		</small><br/>
	</div>
	<div class="grid_1 ac omega">
		<abbr><?php echo $event->_category->category; ?></abbr><br>
		<small><?php echo count($event->attendees) . "/" . $event->attendees_max_count . __(" attendees"); ?></small><br>
	</div>
	<ul class="action-buttons fr clearfix">
		<li>
			<?php echo Html::anchor("ajax/delete_event/id/". $event->id, "<span class='delete'></span>", array('class' => 'button button-gray no-text delete modalInput', 'title' => __('Delete it !'), 'rel' => '#confirm', 'data-id' => $event->id, 'data-message' => __('Are you sure you want to delete this event ? <br><h3>&laquo; :title &raquo;</h3><h4><abbr>:teaser</abbr></h4>', array(':title' => $event->name, ':teaser' => $event->teaser)))); ?>
		</li>
		<li>
			<?php echo Html::anchor("ajax/publish_event/id/". $event->id, "<span class='publish'></span>", array('class' => 'button button-gray no-text modalInput', 'title' => __('Publish'), 'rel' => '#confirm', 'data-id' => $event->id, 'data-message' => __('Confirm to publish this event ! <fieldset><h3>&laquo; :title &raquo;</h3><h4><abbr>:teaser</abbr></h4><p>:content</p></fieldset>', array(':title' => $event->name, ':teaser' => $event->teaser, ':content' => $event->content)))); ?>
		</li>
		<li>
			<?php echo Html::anchor("event/edit/id/". $event->id, "<span class='pencil'></span>", array('class' => 'button button-gray no-text', 'title' => __('Edit !'))); ?>
		</li>
	</ul>
</div>
<div class="clear"></div>
	<?php endforeach; ?>
<?php else: ?>
<div class="ac">
	<div class="message info ac">
		<h3 class=""><?php echo __("No event in your calendar"); ?></h3>
		<p><?php echo Html::anchor("event/new/" . $company->id, __("Create a new event"));?></p>
	</div>
</div>
<?php endif; ?>