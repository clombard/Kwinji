<!-- IMAGE AND LINK -->
<?php echo HTML::anchor('user/view/' . $user->id, Html::image($user->image) . "<div>" . $user->displayname . "</div>"); ?>
