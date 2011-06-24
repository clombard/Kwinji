<header>
	<?php echo $header_tools; ?>
	<h2><?php echo __("Overview");?></h2>
</header>

<section class="container_6 clearfix">

  
  <!-- Display resumes -->
	<figure class="grid_2 other-options">
		<?php echo $resumes; ?>
	</figure>
  
  <!-- Display accepted contacts -->
	<figure class="grid_2 other-options">
		<?php echo $contacts_accepted; ?>
	</figure>
  
  <!-- Display potential contacts -->
	<figure class="grid_2 other-options">
		<?php echo $contacts_potential; ?>
	</figure>
  
  <!-- END OF CONTAINER -->
	<div class="grid_6">&nbsp;</div>

  <figure class="grid_2 other-options">
    <?php echo $offers; ?>
  </figure>
  
  <!-- Display events -->
  <figure class="grid_2 other-options">
    <?php echo $events; ?>
  </figure>

 <!-- END OF CONTAINER -->
	<div class="grid_6">&nbsp;</div>

  <!-- Display news -->
	<figure class="other-options grid_4">
		<?php echo $news; ?>
	</figure>


	<div class="other-options grid_2">
		<h3 class="other"><span class="clock"></span><?php echo __("Notifications"); ?></h3>
		<ul>
			<li class="link" onClick="window.location='../comment/view'">
				<h4><span class="comments"></span><?php echo HTML::anchor('user/view', "Lucas Michot") . __(' commented on ') . HTML::anchor('user/view', "Cedric Lombard") . __("'s event"); ?></h4>
				<p><?php echo __("12 hours ago"); ?></p>
			</li>
			<li class="link" onClick="window.location='../messenger/view'">
				<h4><span class="email"></span><?php echo HTML::anchor('user/view', "Barack Obahma") . __(' responded to ') . HTML::anchor('user/view', "Lucas Michot"); ?></h4>
				<p><?php echo __("on Monday"); ?></p>
			</li>
			<li class="link" onClick="window.location='../user/view/conectedTO'">
				<h4><span class="user_add"></span><?php echo HTML::anchor('user/view', "Barack Obahma") . __(' is now connected to ') . HTML::anchor('user/view', "Lucas Michot"); ?></h4>
				<p><?php echo date("D, d M Y", time());?></p>
			</li>
		</ul>
		<div class="ar more">
			<hr>
			<?php echo Html::anchor("#", __("see all"), array("class" => ""));?>
		</div>
	</div>


</section>
