
<div class="main-content grid_5 alpha" style="height: 100%;">
	<header>
	<?php echo $header_tools; ?>
	<div class="view-switcher">
		<h2><?php echo __("Messenger : Inbox"); ?> <a href="#">&darr;</a></h2>
		<ul>
			<li><a href="layouts.html"><?php echo __("Messenger : Inbox"); ?></a></li>
			<li><a href="layouts.html"><?php echo __("Messenger : Deleted"); ?></a></li>
			<li><a href="layouts.html"><?php echo __("Messenger : Archived"); ?></a></li>
			<li><a href="layouts.html"><?php echo __("Messenger : Inbox"); ?></a></li>
		</ul>
	</div>
	</header>
	<section>
		<?php echo Html::anchor('/unread', __('All'), array('class' => 'email')); ?>
		&nbsp;
		<?php echo Html::anchor('/unread', __('Unread'), array('class' => 'email')); ?>
		&nbsp;
		<?php echo Html::anchor('/unread', __('Read'), array('class' => 'email')); ?>
		&nbsp;
		<a rel="#new_message" class="modalInput button button-orange"><?php echo  __('New message') . '<span class="add"></span>'; ?></a>
		<ul class="action-buttons clearfix fr">
			<li><?php echo Html::anchor('/unread', __('Unread') . '<span class="email"></span>', array('class' => 'button button-gray no-text email', 'title' => 'Unread')); ?></li>
			<li><?php echo Html::anchor('/read', __('Read') . '<span class="email_open"></span>', array('class' => 'button button-gray no-text email_open', 'title' => 'Read')); ?></li>
			<li><?php echo Html::anchor('/archived', __('Archived') . '<span class="package"></span>', array('class' => 'button button-gray no-text package', 'title' => 'Archived')); ?></li>
			<li><?php echo Html::anchor('/trash', __('Trash') . '<span class="bin"></span>', array('class' => 'button button-gray no-text arrow-left', 'title' => 'Trash')); ?></li>
		</ul>
		<br />
		<br />
		<ul class="listing messenger-view">
			<?php for ($i = 0; $i < 8; $i++): ?>
			<li>
				<input type="checkbox" />
				<span class="avatar"><img src="" /></span>
				<a href="messenger/view/123" class="more"></a>
				<span class="timestamp"><?php echo date("D, d M Y - H:i", time()); ?></span>
				<a href="user/view">Lucas Michot</a>
				<p><?php echo __('(No Subject)');?></p>
				<div class="entry-meta">Piece of message...</div>
			</li>
			<?php endfor; ?>
		</ul>
		<ul class="pagination clearfix">
			<li><a class="button-blue" href="#">«</a></li>
			<li><a class="current button-blue" href="#">1</a></li>
			<li><a class="button-blue" href="#">2</a></li>
			<li><a class="button-blue" href="#">3</a></li>
			<li><a class="button-blue" href="#">»</a></li>
		</ul>
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
	<div class="preview"></div>
</div>
