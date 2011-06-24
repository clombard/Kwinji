<?php echo Html::anchor("firm/view/id/" . $contact->_firm->id, Html::image($contact->_firm->logo), array("class" => "firm_logo fr")); ?>
<h4>
<?php echo __(":firstname's informations", array(':firstname' => $contact->displayname)); ?>
</h4>
<hr />
<ul class="profile-info">
	<li class="email"><span><?php echo __("email"); ?></span> <?php echo KData::userMail($contact->id); ?></li>
	<li class="phone"><span><?php echo __("home"); ?></span> <?php echo $contact->phones['home']; ?>
	</li>
	<li class="mobile"><span><?php echo __("mobile"); ?></span> <?php echo $contact->phones['mobile']; ?>
	</li>
	<li class="building"><span><?php echo __("office"); ?></span> <?php echo $contact->phones['office']; ?>
	</li>
</ul>
<h4><?php echo __("Additional info"); ?></h4>
<hr />
<ul class="profile-info">
	<li class="calendar-day"><span><?php echo __("birthday"); ?></span> <?php echo $contact->birthdate; ?>
	</li>
	<li class="calendar-day"><span><?php echo __("hire date"); ?></span> <?php echo date("D, d M Y", $contact->dt_hire); ?>
	</li>
	<li class="house"><span><?php echo __("home address"); ?></span> <?php echo $contact->street; ?>
	</li>
	<li><?php echo $contact->_place_city->name . " (" . $contact->_place_city->code . ") - " . $contact->_place_country->name; ?>
	</li>
	<li class="building"><span><?php echo __("office address"); ?></span> <?php echo $contact->_firm->name; ?></li>
	<li><?php echo $contact->_firm->street; ?>
	</li>
	<li><?php echo  $contact->_firm->_place_city->name  . " (" . $contact->_firm->_place_city->code . ") - " . $contact->_firm->_place_country->name;?></li>
</ul>
<hr />
<div class="action-buttons clearfix fr">
	<?php echo Html::anchor("firm/view/id/" . $contact->_firm->id, $contact->_firm->name . __("'s profile") . "<span class='building'></span>", array("class" => "button button-orange"));?>
</div>
<ul class="action-buttons clearfix">
	<li><?php echo HTML::anchor('messenger/'.$contact->id, '<span class="email"></span>' . __("Send email"),  array('class' => 'button button-gray no-text email')); ?>
	</li>
	<li><?php echo HTML::anchor('watchlist/'.$contact->id, '<span class="star"></span>' . __("Follow"),  array('class' => 'button button-gray no-text')); ?>
	</li>
</ul>
