
<div class="widget modal" id="contacts">
	<header>
		<h2><?php echo __("Network of this contact"); ?></h2>
	</header>
	<section>
		<ul class="listing list-view">
<?php foreach ($list_contacts as $contact): ?>
			<li>
				<div class="action-buttons clearfix fr">
	<?php if (KData::userIsContactOf($contact->id, $user->id)): ?>
		<?php echo  HTML::anchor('ajax/user_add/' . $contact->id, '<span class="user_add"></span>' . __("Add as contact"), array('class' => 'button no-style button-gray modalInput', 'rel' => '#confirm', 'data-message' => __('Are you sure you want to delete this news ? <br><h3>&laquo; :title &raquo;</h3><h4><abbr>:teaser</abbr></h4>', array(':title' => $contact->displayname, ':teaser' => $contact->funcion)))); ?>
	<?php endif; ?>
				</div>
	<?php if (empty($contact->image)): ?>
		<?php echo  HTML::anchor('user/view/' . $contact->id, HTML::image('static/img/user_32.png', array('class'=>'avatar'))); ?>
	<?php else: ?>
		<?php echo  HTML::anchor('user/view/' . $contact->id, HTML::image($contact->image, array('class'=>'avatar'))); ?>
	<?php endif; ?>
		<?php echo HTML::anchor('user/view/'.$contact->id, $contact->displayname); ?><br/>
				<div class="entry-meta"><?php echo $contact->function . ' @ ' . $contact->_firm->name; ?></div>
				
				<span class="icon fr"><?php echo count($contact->_contacts_accepted); ?><span class="twitter fr"></span></span>
				<div class="clear"></div>
		<?php $common = array();//KData::commonContacts($user->id, $contact->id); ?>
		<?php if (count($common) > 0): ?>
			<?php  echo Html::anchor('#', __(':nbcontacts common contact(s)', array(":nbcontacts" => count($common), array('class' => 'has-popupballoon')))) ;  ?>
			    <div class="popupballoon top">
			    	<?php echo Html::anchor("#", "X", array('class' => 'close fr'));?>
					<?php foreach ($common as $toConfirm): ?>
						<?php echo $toConfirm->displayname . "<br>"; ?>
					<?php endforeach; ?>
					<br />
			    </div>
		<?php endif; ?>
			</li>
<?php endforeach; ?>
		</ul>
	</section>
</div>
