<!-- Display a single user dashboard line -->
<h4><?php echo Html::anchor('user/view/'. $user->id, $user->details['firstname'] . ' ' . $user->details['lastname']); ?></h4>
<p><?php echo $user->professional['function'] . ' @ ' . $user->professional['firm']; ?></p>
