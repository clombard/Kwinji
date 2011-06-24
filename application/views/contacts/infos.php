<?php if (count($all_infos['contactsToConfirm']) > 0):?>
<div class="message info">

	<?php  echo __('You have :x_contacts to confirm.', array(':x_contacts' => Html::anchor('#', __(':nbcontacts contact(s)', array(":nbcontacts" => count($all_infos['contactsToConfirm']))), array('class' => 'has-popupballoon')))) ;  ?>

    <div class="popupballoon top">
    	<?php echo Html::anchor("#", "X", array('class' => 'close fr'));?>
		<?php foreach ($all_infos['contactsToConfirm'] as $toConfirm): ?>
			<?php echo $toConfirm->displayname . "<br>" . $toConfirm->function . " @ " . $toConfirm->_firm->name; ?>
		<?php endforeach; ?>
		<br />
		<hr />
		<?php echo Html::anchor("contacts/confirm", __("Go to confitm"), array('class' => 'button button-orange'));?>
    </div>
</div>
<?php endif; ?>
<?php if (count($all_infos['contactsWished']) > 0):?>
<div class="message info">
	<?php  echo __('You have :x_contacts waiting for confirmation.', array(':x_contacts' => Html::anchor('#', __(':nbcontacts contact(s)', array(":nbcontacts" => count($all_infos['contactsWished']))), array('class' => 'has-popupballoon')))) ;  ?>
    <div class="popupballoon top">
    	<?php echo Html::anchor("#", "X", array('class' => 'close fr'));?>
		<?php foreach ($all_infos['contactsWished'] as $toConfirm): ?>
			<?php echo $toConfirm->displayname . "<br>" . $toConfirm->function . " @ " . $toConfirm->_firm->name; ?>
		<?php endforeach; ?>
		<br />
		<hr />
		<?php echo Html::anchor("contacts/confirm", __("Go to confitm"), array('class' => 'button button-orange'));?>
    </div>
</div>
<?php endif; ?>
