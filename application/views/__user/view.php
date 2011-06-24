<div class="user-status">
  <h3>User status</h3>
  <span>User status : <?php echo $user->status; ?></span>
</div>

<div class="user-details">
  <h3>User details</h3>
  <span>First name : <?php echo $user->details['firstname']; ?></span><br>
  <span>Last name : <?php echo $user->details['lastname']; ?></span><br>
  <span>Nationality : <?php echo $user->details['nationality']; ?></span><br>
  <span>Title : <?php echo $user->details['title']; ?></span><br>
  <span>Birthdate : <?php echo $user->details['birthdate']; ?></span><br>
  <span>Driver license : <?php echo $user->details['driver_license']; ?></span>
</div>

<div class="user-address">
  <h3>User address</h3>
  <span>Street : <?php echo $user->address['street']; ?></span><br>
  <span>Zip code : <?php echo $user->address['zip-code']; ?></span><br>
  <span>City : <?php echo $user->address['city']; ?></span><br>
  <span>Country : <?php echo $user->address['country']; ?></span>
</div>

<div class="user-dates">
  <h3>Dates</h3>
  <span>Created : <?php echo $user->dates['created']; ?></span><br>
  <span>Updated : <?php echo $user->dates['updated']; ?></span><br>
  <span>Logged : <?php echo $user->dates['logged']; ?></span><br>
  <span>Availbale : <?php echo $user->dates['available']; ?></span>
</div>

<div class="user-mails">
  <h3>User mails (validated mails)</h3>
  <ul>
    <?php foreach ($user->mails as $mail) { ?>  
      <li><?php echo $mail; ?></li>
    <?php } ?> 
  </ul>
</div>

<div class="user-mails-waiting">
  <h3>User mails (mails awaiting validation)</h3>
  <ul>
    <?php foreach ($user->mails_waiting as $mail) { ?>  
      <li><?php echo $mail; ?></li>
    <?php } ?> 
  </ul>
</div>

<div class="user-resumes">
  <h3>User resumes</h3>
  <ul>
    <?php foreach ($user->ref_resumes as $resume) { ?>  
      <li><a href="<?php echo URL::site('resume/view/'. $resume->id); ?>"><?php echo $resume->title; ?></a></li>
    <?php } ?> 
  </ul>
</div>

<div class="user-firms">
  <h3>User firms (firms that I follow)</h3>
  <ul>
    <?php foreach ($user->ref_firms as $firm) { ?>  
      <li><a href="<?php echo URL::site('firm/view/'. $firm->id); ?>"><?php echo $firm->details['name']; ?></a></li>
    <?php } ?> 
  </ul>
</div>

<div class="user-schools">
  <h3>User schools (schools that I follow)</h3>
  <ul>
    <?php foreach ($user->ref_schools as $school) { ?>  
      <li><a href="<?php echo URL::site('school/view/'. $school->id); ?>"><?php echo $school->details['name']; ?></a></li>
    <?php } ?> 
  </ul>
</div>

<div class="user-skills">
  <h3>User skills (my global skills)</h3>
  <ul>
    <?php foreach ($user->skills as $skill) { ?>  
      <li><?php echo $skill['name']; ?> : (Duration = <?php echo $skill['duration']; ?>; Level = <?php echo $skill['level']; ?>)</li>
    <?php } ?> 
  </ul>
</div>
