<?php if (count(KData::getFirmFollowers($firm->id)) > 0): ?>
	<?php $index = 0; ?>
	<?php foreach (KData::getFirmFollowers($firm->id) as $user): ?>
		<?php $index++; ?>
		<?php if ($index == 1): ?>
<div class="container_6">
		<?php elseif ($index % 5 == 1): ?>
</div>
<div class="container_6">
		<?php endif; ?>
	<div class="grid_1 omega ac">
	<?php $avatar = "../static/img/user_32.png"; ?>
	<?php if (!empty($user->image)): ?>
		<?php $avatar = $user->image; ?>
	<?php endif; ?>
		<?php echo Html::anchor("user/view/" . $user->id, HTML::image($avatar), array('class' => 'avatar')); ?><br />
		<strong><?php echo $user->displayname; ?></strong><br/>
		<small><?php echo $user->function; ?></small><br/>
	</div>
	<?php endforeach; ?>
</div>
<div class="clear"></div>
<?php else: ?>
<h3 class="ac"><?php echo __("You havent got any followers for your company."); ?></h3>
<?php endif; ?>