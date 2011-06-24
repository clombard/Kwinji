<?php if(isset($options) && isset($options["alpha"])): ?>
	<div class="alpha-pagination">
	    <ul class="ac">
	<?php  foreach (array_merge(array('#'), range('A', 'Z')) as $element): ?>
		<?php if (in_array(strtolower($element), KData::getUserContactsAcceptedLetters($user->id)) || $element == "#"): ?>
				<li><?php echo HTML::anchor('#', $element); ?></li>
		<?php else: ?>
				<li><?php echo $element; ?></li>
		<?php endif; ?>
	<?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?>
	<ul class="listing list-view">
<?php $list_contacts = null; ?>
<?php if (isset($options)): ?>
	<?php if (isset($options["contacts_accepted"])): ?>
		<?php $list_contacts = $options["contacts_accepted"]; ?>
	<?php elseif (isset($options["contacts_wished"])): ?>
		<?php $list_contacts = $options["contacts_wished"]; ?>
	<?php endif; ?>
<?php endif; ?>
		<?php foreach ($list_contacts as $contact): ?>
		<li>
			<div class="action-buttons clearfix fr">
		<?php if (KData::userIsContactOf($contact->id, $user->id)): ?>
				<a class="icon" href="#"><?php echo count($contact->_contacts_accepted); ?><span class="twitter"></span></a>
		<?php else: ?>
				<?php echo  HTML::anchor('#', '<span class="user_add"></span>', array('class' => 'button button-gray no-text', 'title' => __("Add as contact"))); ?></li>
		<?php endif; ?>
			</div>
		<?php echo Html::anchor("panel/user/".$contact->id, "&raquo;", array("class" => "more"));?>
		<?php if (empty($contact->image)): ?>
			<?php echo  HTML::anchor('user/view/id/' . $contact->id, HTML::image('static/img/user_32.png', array('class'=>'avatar'))); ?>
		<?php else: ?>
			<?php echo  HTML::anchor('user/view/id/' . $contact->id, HTML::image($contact->image), array('class'=>'avatar')); ?>
		<?php endif; ?>
			<?php echo HTML::anchor('user/view/id/' . $contact->id, $contact->displayname); ?><br/>
			<div class="entry-meta"><?php echo $contact->function . ' @ ' . $contact->_firm->name; ?></div>
			<div class="clear"></div>
		</li>
	<?php endforeach; ?>
	</ul>
<?php if(!isset($options) || !$options["alpha"]): ?>
	<div class="ar"><?php echo  HTML::anchor('#', __("View more")); ?></div>
<?php endif; ?>	
	
