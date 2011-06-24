<div class="main-content grid_5 alpha events">
	<header>
		<div class="action-buttons clearfix fr">
			<?php echo Html::anchor("event/", __("Manage my events"), array("class" => "button button-gray")); ?>
			<?php echo Html::anchor("#", __("Post an event"), array("class" => "button button-green")); ?>
		</div>
		<h2><?php echo $all_event_title; ?></h2>
	</header>
	<section>
		<?php echo Form::open("event/all", array("class" => "form")); ?>
			<h3><?php echo "Title search area"; ?></h3>
			<fieldset>
				<?php echo Form::label("search", __("Search")); ?>
				<?php echo Form::input("search", "", array("class" => "half", "id" => "search")); ?>
				<?php echo Form::label("period", "Dates"); ?>
				<?php echo Form::select("period", $periods, "", array("class" => "half", "id" => "period")); ?>
				<?php echo Html::anchor("#", __("Advanced search"), array("class" => "fr")); ?>
			</fieldset>
			<fieldset>
				<?php echo Form::label("keywords", __("Keywords")); ?>
				<?php echo Form::input("keywords", "", array("class" => "half", "id" => "keywords")); ?>
				<?php echo Form::label("period", "Dates"); ?>
				<?php echo Form::select("period", $periods, "", array("class" => "half", "id" => "period")); ?>
				<?php echo Html::anchor("#", __("Advanced search"), array("class" => "fr")); ?>
			</fieldset>
			<div class="action ar">
				<?php echo __(':simple_gray :big_green', array(
			        	':big_green'=>Form::button("valid", __('Submit'), array('class'=>'button button-orange')),
			            ':simple_gray'=>Form::button("reset", __('Reset'), array('type'=>'reset', 'class'=>'button button-gray')),
					)); ?>
			</div>
		<?php echo Form::close(); ?>
		<h4><?php echo " 10 " . __("Results of") . " 78 "; ?></h4>
		<ul class="listing list-view clearfix">
			<?php for ($i = 0; $i < 8; $i++): ?>
			<li class="tick">
				<?php echo Html::anchor("panel/event/", "&raquo;", array("class" => "more"));?>
				<span class="avatar"><?php echo Html::anchor("user/view/234", Html::image("")); ?></span>
				<span class="timestamp"><?php echo "Category"; ?></span>
				<h3><?php echo Html::anchor("event/view/1234", "Event title"); ?></h3>
				<p>
					<span class="icon"><span class="time"></span><?php echo date("D, d M Y @ H:i", time()); ?>, <?php echo "City - Country"; ?></span>
				</p><br />
				<p>Cras egestas vestibulum nisl, nec eleifend nunc pulvinar non.Cras egestas vestibulum nisl, nec eleifend nunc Cras egestas vestibulum nisl, nec eleifend nunc pulvinar non.Cras egestas vestibulum nisl, nec eleifend nunc pulvinar non.</p>
				<br />
				<div class="action-buttons clearfix fr">
					<?php echo Html::anchor("", "<span class='tag_blue'></span> 20 €", array("class" => "button button-orange")); ?>
					<?php echo Html::anchor("", "<span class='user'></span> 9 attendees", array("class" => "button button-green")); ?>
				</div>
				<div class="entry-meta"><?php echo __("By ") . Html::anchor("user/view/123", "Lucas Michot") . ", " . "Directeur Technique @ Kwinji"; ?></div>
				<div class="clear"></div>
			</li>
			<?php endfor; ?>
		</ul>
		<div class="clear"></div>
		<ul class="pagination clearfix">
			<li><a href="#" class="button-blue">&laquo;</a></li>
			<li><a href="#" class="current button-blue">1</a></li>
			<li><a href="#" class="button-blue">2</a></li>
			<li><a href="#" class="button-blue">3</a></li>
			<li><a href="#" class="button-blue">&raquo;</a></li>
		</ul>
	</section>
</div>

<div class="preview-pane grid_2 omega">
	<div class="content">
    
       
    	<?php     
    		$countries = array();
    		foreach ($events_countries_categories as $key => $c) {
    			$countries[$key] = $c['country']['name'];
    		}	
    	?>
    
			<?php echo Form::open('event/all/', array('action' => 'post', 'class' => 'form')); ?>
				<?php echo Form::select("events_countries", /*$events_countries*/ $countries,  $country_id, array('style' => 'width: 200px; margin-left: 0;'));?>
			<?php echo Form::close();?>

    <br>

    <dl>
      <dd><?php echo Html::anchor("event/all/", "<span class='none'></span> Country", array("class" => "full button button-gray al", "style" => "width:100%;")); ?></dd>
    </dl>
    
    <br>
    
		<dl>
			<dd><?php echo Html::anchor("event/", "<span class='none'></span> Category", array("class" => "full button button-gray al", "style" => "width:100%;")); ?></dd>
			<dd><?php echo Html::anchor("event/all/123", "<span class='arrow-left'></span> SubCategory", array("class" => "full button button-blue al", "style" => "width:100%;")); ?></dd>
		</dl>
    
    
    <br>
    
    <dl>
     <dd><?php echo Html::anchor("event/", "<span class='none'></span> Category", array("class" => "full button button-gray al", "style" => "width:100%;")); ?></dd>
      <dd><?php echo Html::anchor("event/all/123", "<span class='arrow-left'></span> SubCategory", array("class" => "full button button-blue al", "style" => "width:100%;")); ?></dd>
    </dl>






		<h3><?php echo __("Advertise"); ?></h3>
		<ul>
			<li>
				<hr>
				<h4><?php echo Html::anchor("news/view", 'Publicité'); ?></h4>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sit amet massa at lorem molestie egestas. Donec ipsum purus, consequat ac gravida sed, volutpat ut velit.</p>
			</li>
		</ul>
	</div>
	<div class="preview"></div>
</div>
