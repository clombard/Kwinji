	<header>
		<div class="action-buttons clearfix fr">
			<?php echo Html::anchor("event/", __("Manage my events"), array("class" => "button button-gray")); ?>
			<?php echo Html::anchor("#", __("Post an event"), array("class" => "button button-green")); ?>
		</div>
		<h2>Visite</h2>
	</header>
	<section class="container_6 clearfix">
		<div class="grid_3 alpha card">
			<div class="ar"><?php echo date("d M", time());?></div>
			<div class="user_card info ">
				<figure class="fl">
					<?php echo HTML::anchor('dashboard/view/' . $user->id, Html::image($user->image)); ?>
				</figure>
				<h3><?php echo $user->displayname; ?></h3>
				<dl class="fl">
					<dt><?php echo $user->function . " @ " . $user->_firm->name; ?></dt>
					<dd><?php echo $user->_place_city->name . " (" . $user->_place_city->code . ") - " . $user->_place_country->name;?></dd>
					<dd><?php echo count($user->_contacts_accepted) . " &amp; " .  __("common(s)"); ?> </dd>
				</dl>
			</div>
			<?php foreach ($user->_contacts_accepted as $c) { echo ($c->id); } ?>
			<div class="shadow_card">&nbsp;</div>
		</div>
		<div class="grid_3 omega">
			<div class="ar"><?php echo date("d M", time());?></div>
			<div class="user_card info">
				<figure>
					<?php echo Html::image("assets/images/user_64.png"); ?>
				</figure>
			</div>
			<div class="shadow_card">&nbsp;</div>
		</div>
		<div class="grid_3 alpha">
			<div class="ar"><?php echo date("d M", time());?></div>
			<div class="user_card info">
				<figure>
					<?php echo Html::image("assets/images/user_64.png"); ?>
				</figure>
			</div>
			<div class="shadow_card">&nbsp;</div>
		</div>
	</section>
