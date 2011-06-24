<h3><?php echo $event->name; ?></h3>
<hr>
<ul class="profile-info">
	<li class="house">
		<span><?php echo __("Address");?></span>
		<?php echo $event->street . " (" . $event->_place_city->code . ")"; ?>
	</li>
	<li class="calendar-day">
		<span><?php echo __("End");?></span>
		<?php echo date("D, d M Y @ H:i", $event->dt_finishes); ?>
	</li>
</ul>
<hr>
<h4><?php echo __("Event description"); ?></h4>
<div class="description">
	<p><?php echo $event->content; ?></p>
</div>
<hr>
<?php echo Html::anchor("event/view/" . $event->id, __("More details") . "<span class='find'></span>", array("class" => "button button-orange", "title" => __("More details")));?>

<ul class="action-buttons clearfix fr">
<?php if ($event->_user->id == $user->id): ?>
	<li><?php echo Html::anchor("event/edit/id/" . $event->id, __("Edit event") . "<span class='pencil'></span>", array("class" => "button button-gray no-text", "title" => __("Edit this event")));?></li>
	<li><?php echo Html::anchor("event/delete/id/" . $event->id, __("Delete") . "<span class='bin'></span>", array("class" => "button button-gray no-text", "title" => __("Delete this event")));?></li>
<?php else: ?>
	<li><?php echo Html::anchor("event/subscribe/" . $event->id, __("Subscribe") . "<span class='subscribe'></span>", array("class" => "button button-gray no-text", "title" => __("Subscribe")));?></li>
	<li><?php echo Html::anchor("event/unscribre/" . $event->id, __("Unscribe") . "<span class='unscribe'></span>", array("class" => "button button-gray no-text", "title" => __("Unscribe")));?></li>
<?php endif; ?>
</ul>
