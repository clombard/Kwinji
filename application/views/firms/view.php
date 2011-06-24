<div class="firm-details">
  <h3>Firm details</h3>
  <span class="firm-details-name">Firm name : <?php echo $firm->details['name']; ?></span><br>
</div>

<div class="firm-users-following">
  <h3>Users following that firm</h3>
  <ul>
    <?php foreach ($users_following as $user) { ?>  
      <li><a href="<?php echo URL::site('user/view/'. $user->id); ?>"><?php echo $user->details['firstname']; ?></a></li>
    <?php } ?> 
  </ul>
  <span class="firm-followers">Firm name : <?php echo $firm->details['name']; ?></span><br>
</div>