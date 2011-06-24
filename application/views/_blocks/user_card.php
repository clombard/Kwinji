<div class="card">
	<div class="box content corners">
		<?php echo  HTML::anchor('#', HTML::image('static/img/user_32.png', array('class'=>'avatar', 'title' => __("Acces to profile")))); ?>
		<?php echo  HTML::anchor('#', $card_infos["display_name"], array('class'=>'big'));   ?><br>
		<?php echo  HTML::anchor('#', $card_infos["job"], array('class'=>'subtitle')); ?><br>
		<em><?php echo  HTML::anchor('#', $card_infos["firm"], array('class'=>'black')); ?></em><br><br>
		<small><?php echo  HTML::anchor('#', $card_infos["region"] . " - " . $card_infos["country"]); ?></small><br>
		<code><?php echo  $card_infos["email"]; ?></code>
		<div id="box-icon-toolbar" class="corner-bl corner-br ta-right" style="position: relative;">
			<?php echo  HTML::anchor('#', '<span class="icon icon-add" title="'. __("Add as contact") .'">&nbsp;</span>'); ?>
			<?php echo  HTML::anchor('#', '<span class="icon icon-new-msg" title="'. __("Send an email") .'">&nbsp;</span>',  array('title' => __("Send an email")));   ?>
			<?php echo  HTML::anchor('#', '<span class="icon icon-bookmark" title="'. __("Add to my watchlist") .'">&nbsp;</span>',  array('title' => __("Add to my watchlist")));   ?>
			<?php echo  HTML::anchor('#', '<span class="icon icon-arrow-down" title="'. __("View his QRcode") .'">&nbsp;</span>',  array('title' => __("View his QRcode")));   ?>
		</div>
	</div>
	<div class="hallow">&nbsp;</div>
</div>
	