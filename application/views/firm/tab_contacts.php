<?php if (count($firm->groups) > 0): ?>
	<?php foreach ($firm->groups as $group_id => $group_name): ?>
<h2><?php echo $group_name; ?></h2>
		<?php $index = 0; ?>
		<?php foreach ($firm->groups_users as $member): ?>
			<?php if (in_array($group_id, $member['groups'])): ?>
				<?php $user = KData::getUser($member['user']); ?>
				<?php $index++; ?>
				<?php if ($index == 1): ?>
<div class="grid_6">
				<?php elseif ($index % 5 == 1): ?>
</div>
<div class="grid_6">
				<?php endif; ?>
	<div class="grid_1 ac avatar">
			<?php $avatar = "../static/img/user_32.png"; ?>
			<?php if (!empty($user->image)): ?>
				<?php $avatar = $user->image; ?>
			<?php endif; ?>
			<?php echo Html::anchor("user/view/" . $user->id, HTML::image($avatar), array('class' => 'avatar')); ?><br />
		<strong><?php echo $user->displayname; ?></strong><br/>
		<small><?php echo $user->function; ?></small><br/>
	</div>
			<?php endif; ?>
		<?php endforeach; ?>
</div>
<div class="clear"></div>
	<?php endforeach; ?>
<?php else: ?>
<h3 class="ac"><?php echo __("You havent got any public contact in your company.") . Html::anchor("firm/add_contact/" . $firm->id, __("Add a new public contact")); ?></h3>
<?php endif; ?>