<div class="school-details">
  <h3>School details</h3>
  <span class="school-details-name">School name : <?php echo $school->details['name']; ?></span><br>
</div>

<div class="school-users-following">
  <h3>Users following that school</h3>
  <ul>
    <?php foreach ($users_following as $user) { ?>  
      <li><a href="<?php echo URL::site('user/view/'. $user->id); ?>"><?php echo $user->details['firstname']; ?></a></li>
    <?php } ?> 
  </ul>
</div>


<div class="school-users-members">
  <h3>Members that school</h3>
  <ul>
    <?php foreach ($users_following as $user) { ?>  
      <li><a href="<?php echo URL::site('user/view/'. $user->id); ?>"><?php echo $user->details['firstname']; ?></a></li>
    <?php } ?> 
  </ul>
</div>

<div class="school-users-working">
  <h3>Members working now in that school</h3>
  <ul>
    <?php foreach ($users_following as $user) { ?>  
      <li><a href="<?php echo URL::site('user/view/'. $user->id); ?>"><?php echo $user->details['firstname']; ?></a></li>
    <?php } ?> 
  </ul>
</div>