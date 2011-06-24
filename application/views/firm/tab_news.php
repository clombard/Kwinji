<?php if (isset($news) && count($news) > 0): ?>
	<?php $sameDate = null; ?>
	<?php foreach ($news as $new): ?>
		<?php if ($sameDate != date("D, d F Y", $new->dt_published)): ?>
			<?php $sameDate = date("D, d F Y", $new->dt_published); ?>
<h2><?php echo date("D, d F Y", $new->dt_published);?></h2>
		<?php else: ?>
<hr>			
		<?php endif; ?>
		
<div class="grid_6 item-result alpha omega" data-id="<?php echo $new->id; ?>">
	<div class="grid_1 ac alpha">
		<?php $image = "static/img/preview-not-available.gif"; ?>
		<?php echo HTML::anchor("news/view/".$new->id, HTML::image($image)); ?>
	</div>
	<div class="grid_4 alpha omega">
		<span class="timestamp"><?php echo date("l d F Y @ H:i", $new->dt_published); ?></span>
		<h3><?php echo HTML::anchor("new/view/" . $new->id, $new->details['title'], array("class" => "big no-style black")); ?></h3>
		<abbr><?php echo $new->details['teaser']; ?></abbr><br/>
		<p><?php echo substr($new->details['text'],0 ,200); ?></p>
		<small>
		<b><?php echo __("Author : "); ?></b>
		<?php echo HTML::anchor("user/view/". $new->_user->id, $new->_user->displayname) . " "; ?>

		<?php foreach ($new->_users as $contributor): ?>
			<?php echo HTML::anchor("user/view/".$contributor->id, $contributor->displayname) . " "; ?>
		<?php endforeach; ?>

		<?php if (count($new->keywords) > 0):?>

		| <b><?php echo __("Tags : "); ?></b>
		
			<?php foreach ($new->keywords as $tag): ?>
				<?php echo HTML::anchor("#", $tag, array("class" => "tag")) . " "; ?>
			<?php endforeach; ?>
		
		<?php endif; ?>

		</small>
	</div>
	<div class="grid_1 ac omega">
		<?php if ($new->published): echo __("Published"); endif; ?>
	</div>
	<ul class="action-buttons fr">
		<li>
			<?php echo Html::anchor("ajax/delete_news/id/". $new->id, "<span class='delete'></span>", array('class' => 'button button-gray no-text delete modalInput', 'title' => __('Delete !'), 'rel' => '#confirm', 'data-id' => "".$new->id, 'data-message' => __('Are you sure you want to delete this article ? <br><h3>&laquo; :title &raquo;</h3><h4><abbr>:teaser</abbr></h4>', array(':title' => $new->details['title'], ':teaser' => $new->details['teaser'])))); ?>
		</li>
		<li>
			<?php echo Html::anchor("ajax/publish_news/id/". $new->id, "<span class='publish'></span>", array('class' => 'button button-gray no-text modalInput', 'title' => __('Publish !'), 'rel' => '#confirm', 'data-id' => "".$new->id, 'data-message' => __('Confirm to publish this article ! <fieldset><h3>&laquo; :title &raquo;</h3><h4><abbr>:teaser</abbr></h4><p>:content</p></fieldset>', array(':title' => $new->details['title'], ':teaser' => $new->details['teaser'], ':content' => $new->details['text'])))); ?>
		</li>
		<li>
			<?php echo Html::anchor("new/edit/id/". $new->id, "<span class='pencil'></span>", array('class' => 'button button-gray no-text', 'title' => __('Edit !'))); ?>
		</li>
	</ul>
</div>
<div class="clear"></div>

	<?php endforeach; ?>

<?php else: ?>
<h3 class="ac"><?php echo __("No news in your journal"); ?></h3>
<?php endif; ?>