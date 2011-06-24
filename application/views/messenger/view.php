
<div class="main-content grid_5 alpha" style="height: 100%;">
	<header>
		<ul class="action-buttons clearfix fr">
			<li><?php echo Html::anchor('/unread', __('Unread') . '<span class="email"></span>', array('class' => 'button button-gray no-text email', 'title' => 'Mark as unread')); ?></li>
			<li><?php echo Html::anchor('/archived', __('Archived') . '<span class="package"></span>', array('class' => 'button button-gray no-text package', 'title' => 'Archived')); ?></li>
			<li><?php echo Html::anchor('/trash', __('Trash') . '<span class="bin"></span>', array('class' => 'button button-gray no-text arrow-left', 'title' => 'Delete this email')); ?></li>
			<li>&nbsp;</li>
			<li><?php echo Html::anchor('/previous', __('Settings') . '<span class="arrow-left"></span>', array('class' => 'button button-gray no-text arrow-left', 'title' => 'Previous')); ?></li>
			<li><?php echo Html::anchor('/next', __('Settings') . '<span class="arrow-right"></span>', array('class' => 'button button-gray no-text arrow-right', 'title' => 'Next')); ?></li>
		</ul>
		<hgroup>
			<h2><?php echo "Message title"; ?></h2>
		</hgroup>
	</header>
	<section>
		<p>
			<?php echo __("Between") . " "; ?>
			<?php $max_count = 4; ?>
			<?php for ($i = 0; $i < $max_count; $i++): ?>
				<?php echo Html::anchor("../user/view/123", 'First Lastname'); ?><?php if ($i < $max_count - 1): ?>, <?php endif;?>
			<?php endfor; ?>
		</p>
		<hr>
		<div class="message info ac"><abbr><?php echo Html::anchor("#", __("Earlier"), array("class" => "ac")); ?></abbr></div>
	<?php for ($i = 0; $i < 4; $i++): ?>
		<figure class="clearfix">
			<?php echo Html::anchor("../user/view/123", Html::image("../assets/images/user_64.png"), array("class" => "grid_1 ac")); ?>
			<div class="grid_3">
				<?php echo __("From ") . Html::anchor("../user/view/123", 'Lucas Michot') . " <small>" . date("D, d M Y @ H:m", time()) . "</small> &middot " . Html::anchor("", __("Reply")) . " &middot " . Html::anchor("", __("Report"));?> <br>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sit amet massa at lorem molestie egestas. Donec ipsum purus, consequat ac gravida sed, volutpat ut velit.</p>
			</div>
		</figure>
		<hr>
	<?php endfor; ?>
		<h3><?php echo __("Reply"); ?></h3>
		<?php Form::open("", array("method" => "post"));?>
			<textarea class="" style="height: 80px; width: 97%;" placeholder="<?php echo __("Write your message...")?>"></textarea>
		<div class="clear"></div>
		<hr>
		<div class="ta-right">
			<?php echo __(':simple_gray :reply :reply_all', array(
		        	':reply_all'=>Form::button("valid", __('Reply'), array('class'=>'button button-green')),
		        	':reply'=>Form::button("valid", __('Reply All'), array('class'=>'button button-green')),
					':simple_gray'=>Form::button("reset", __('Cancel'), array('type'=>'reset', 'class'=>'button button-red')),
				)); ?>
		</div>
		<?php echo Form::close(); ?>
	</section>
</div>

<div class="preview-pane grid_2 omega">
	<div class="content">
		<h3><?php echo __("Advertise"); ?></h3>
		<ul>
			<li>
				<hr>
				<h4><?php echo Html::anchor("news/view", 'Dernière news de ...');?></h4>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sit amet massa at lorem molestie egestas. Donec ipsum purus, consequat ac gravida sed, volutpat ut velit.</p>
			</li>
		</ul>
		<h3><?php echo __("Latest news"); ?></h3>
		<ul>
			<?php for ($i = 0; $i < 4; $i++): ?>
			<li>
				<hr>
				<h4><?php echo Html::anchor("news/view", 'Dernière news de ...');?></h4>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sit amet massa at lorem molestie egestas. Donec ipsum purus, consequat ac gravida sed, volutpat ut velit.</p>
			</li>
			<?php endfor; ?>
		</ul>
	</div>
</div>
