<header>
	<?php echo $header_tools; ?>
	<?php echo $header_title; ?>
</header>

<section class="container_6 clearfix resume">

	<div class="grid_6 alpha omega user-details">

		<div class="grid_3 alpha">
			<div class="user_card">
				<?php echo Html::anchor("contact", "<span class='contact'></span>" . count($resume->_user->_contacts_accepted), array("class" => "fr button button-gray", "title" => __("View all"))); ?>
				<h2><?php echo $resume->_user->displayname; ?></h2>
				<h4><?php echo $resume->_user->function; ?></h4>
				<br>
				<br>
				<abbr><?php echo $resume->_user->_firm->name; ?></abbr>
				<hr>
				<ul class="profile-info fr">
					<li class="email"><?php echo KData::userMail($resume->_user->id); ?></li>
					<li class="building"><small><?php echo $resume->_user->phones['office']; ?></small></li>
					<li class="mobile"><small><?php echo $resume->_user->phones['mobile']; ?></small></li>
				</ul>
				<h5><?php echo $resume->_user->_firm->street; ?></h5>
				<h5><?php echo __(':city, :region', array(':city' => $resume->_user->_place_city->name, ':region' => $resume->_user->_place_region->name)); ?></h5>
				<h5><?php echo $resume->_user->_place_country->name; ?></h5>
					<div class="clear"></div>
			</div>
			<div class="shadow_card">&nbsp;</div>
		</div>
		<div class="grid_3 omega">
			<p class="citation"><?php echo $resume->description; ?></p>
		</div>
			
	</div>

	<div class="clear"></div>

	<div class="accordion">
		
		
		
		
	<!-- EXPERIENCES -->
		<header>
			<ul class="action-buttons fr">
				<li>
					<?php echo Html::anchor("#", "<span class='add'></span>", array("class" => "button button-gray no-text modalInput", "title" => __("New experience"), "rel" => "#resume_add_experience")); ?>
				</li>
			</ul>
			<h2><?php echo __("Experiences"); ?></h2>
		</header>
		<section class="pane container_6 clearfix">
			<!-- ALL EXPERIENCES DATA -->
		    <?php foreach ($resume->_experiences as  $experience): ?>
			<div class="experience resume-item clearfix" data-id="<?php echo $experience->id; ?>">
			
				<!-- EXPERIENCES PERIODS -->
				<div class="grid_1 alpha ar">
			        <h6>
			          <?php if(isset($experience->dt_finishes) && $experience->dt_finishes): ?>
			            <?php echo date('F Y', $experience->dt_starts); ?><br><?php echo date('F Y', $experience->dt_finishes); ?>
			          <?php else: ?>
			            <?php echo __('Since :starts', array(':starts'=>date('F Y', $experience->dt_starts))); ?>
			          <?php endif; ?>
					</h6>
					<br>
					<br>
					<br>
					<h6>
			          <?php echo KDate::difference($experience->dt_starts, $experience->dt_finishes); ?>
					</h6>
				</div>
			
				<div class="grid_5 omega">
			      
			        <small class="fr ar">
			        	<?php echo html::anchor('place/view/' . $experience->_place_city->id,  $experience->_place_city->code . " " . $experience->_place_city->name); ?>
						<br>
						<?php echo html::anchor('place/view/' . $experience->_place_country->id,    $experience->_place_country->name  )  ; ?>    
			        </small>
			               
					<h3><?php echo Html::anchor('firm/view/id/' . $experience->_firm->id, $experience->_firm->name ); ?></h3>
			               
					<em><?php echo $experience->function; ?>, <?php echo Html::anchor("search/profile/jid/" . $experience->_industry->id, $experience->function); ?></em><br>
					<small><?php echo Html::anchor("search/profile/iid/" . $experience->_industry->id, $experience->_industry->name); ?></small>
					<p><?php echo $experience->description; ?></p>
					
					<ul class="action-buttons fr">
						<li>
							<?php echo Html::anchor("ajax/delete_experience/id/" . $experience->id . "/rid/" . $resume->id, "<span class='delete'></span>". __("Delete"), array("class" => "button button-red no-text modalInput", "title" => __("Delete"), 'rel' => '#confirm', 'data-id' => $experience->id, 'data-message' => __('Are you sure you want to delete this experience ?'))); ?>
						</li>
						<li>
							<?php echo Html::anchor("resume/edit_experience/id/" . $experience->id, "<span class='pencil'></span>". __("Edit"), array("class" => "button button-blue no-text modalInput", "title" => __("Edit"), "rel" => "#resume_add_experience", "data-id" => $experience->id)); ?>
						</li>
					</ul>
	
					<h5>
						<strong><?php echo __("Qualifications : "); ?></strong>
						<?php $content = array(); ?>
						<?php foreach ($experience->_skills as $skill) { ?>
							<?php $content[] = HTML::anchor('skill/view/'.$skill->id, $skill->name, array('class' => 'tag')); ?>
							<?php //$content[] = Html::anchor("#", $skill, array("class" => "tag")); ?>
						<?php } ?>
						<?php echo implode(' ', $content); ?>
					</h5>
				</div>
				<div class="grid_6">
					<hr>
				</div>
			</div>
			<?php endforeach; ?>
		</section>
		<div class="clear"></div>
	
	
	
	
	
		<!-- GRADUATIONS -->
		<header>
			<ul class="action-buttons fr">
				<li>
					<?php echo Html::anchor("#", "<span class='add'></span>", array("class" => "button button-gray no-text modalInput", "title" => __("New graduation"), "rel" => "#resume_add_graduation")); ?>
				</li>
			</ul>
			<h2><?php echo __("Graduations"); ?></h2>
		</header>
	  	<section class="pane container_6 clearfix">
		<?php foreach ($resume->_graduations as $graduation): ?>
			<div class="experience resume-item clearfix" data-id="<?php echo $graduation->id; ?>">
		
				<div class="grid_1 alpha ar">
					<h6>
			          <?php if(isset($graduation->dt_finishes)) { ?>
			            <?php echo date('F Y', $graduation->dt_starts); ?><br><?php echo date('F Y', $graduation->dt_finishes); ?>
			          <?php } else { ?>
			            <?php echo __('Since :starts', array(':starts'=>date('F Y', $graduation->dt_starts))); ?>
			          <?php } ?>
			        </h6>
				</div>
					
				<div class="grid_5 omega"> 
				        <small class="fr ar">
				        	<?php echo html::anchor('place/view/' . $graduation->_place_city->id,  $graduation->_place_city->code . " " . $graduation->_place_city->name); ?>
							<br>
							<?php echo html::anchor('place/view/' . $graduation->_place_country->id,    $graduation->_place_country->name  )  ; ?>    
				        </small>
				    <h3><?php echo Html::anchor('school/view/' . $graduation->_school->id, $graduation->_school->name ); ?></h3>
					<abbr><?php echo $graduation->speciality; ?></abbr><br>
					<small><?php echo Html::anchor('search/profile/gid/' . $graduation->_level->id, $graduation->_level->value); ?></small>
					<p><?php echo $graduation->description; ?></p>
				
					<ul class="action-buttons fr">
						<li>
							<?php echo Html::anchor("ajax/delete_graduation/id/" . $graduation->id . "/rid/" . $resume->id, "<span class='delete'></span>". __("Delete"), array("class" => "button button-red no-text modalInput", "title" => __("Delete"), 'rel' => '#confirm', 'data-id' => $graduation->id, 'data-message' => __('Are you sure you want to delete this graduation ?'))); ?>
						</li>
						<li>
							<?php echo Html::anchor("resume/edit_graduation/id/" . $graduation->id, "<span class='pencil'></span>". __("Edit"), array("class" => "button button-blue no-text modalInput", "title" => __("Edit"), "rel" => "#resume_add_experience", "data-id" => $experience->id)); ?>
						</li>
					</ul>
	
				 	<h5>
				      <strong><?php echo __("Qualifications :"); ?></strong>
				        <?php foreach ($graduation->_skills as $skill) { ?>
				        <?php echo HTML::anchor('skill/view/'.$skill->id, $skill->name, array("class" => "tag")); ?>
				        <?php } ?>
				    </h5>
				</div>

				<div class="grid_6">
					<hr>
				</div>
				
			</div>
		<?php endforeach; ?>
		</section>
	<!-- END GRADUATIONS -->
	
	
	
	
	
	
		<div class="clear"></div>
	
	
	
	
	
	
	<!-- TRAININGS -->
		<header>
			<ul class="action-buttons fr">
				<li>
					<?php echo Html::anchor("#", "<span class='add'></span>", array("class" => "button button-gray no-text modalInput", "title" => __("New training"), "rel" => "#resume_add_training")); ?>
				</li>
			</ul>
			<h2><?php echo __("Trainings"); ?></h2>
		</header>
	  	<section class="pane clearfix">
	  	<?php if (count($resume->_trainings) > 0): ?>
			<?php foreach ($resume->_trainings as $training): ?>
				
				<div class="grid_1 alpha ar">
				<?php $end_exp = $training['end_date']; ?>
				<?php $start_exp = $training['start_date']; ?>
				<?php $range_exp = ""; ?>
				<?php if (empty($end_exp) || null == $end_exp): ?>
					<?php $range_exp .= "Since " . date("F Y", $start_exp); ?>
				<?php else: ?>
					<?php $range_exp .= date("F Y", $start_exp) . " <br> " . date("F Y", $end_exp); ?>
				<?php endif; ?>
					<h6><?php echo $range_exp; ?></h6>
				</div>
			
				<div class="experience grid_5 omega">
					<small class="fr ta-right"><a href="#"><?php echo $training['city'] . " (" . $training['zip'] . ")"; ?></a><br /> <a href="#"><?php echo $training['country']; ?></a></small>
					<h4><abbr><a href="<?php echo $training['firm_id']; ?>"><?php echo $training['firm_name']; ?></a></abbr>, <a href="<?php echo $training['title_link']; ?>"><?php echo $training['title']; ?></a></h4>
					<abbr><?php echo $training['teaser']; ?></abbr>
					<p><?php echo $training['description']; ?></p>
			
					<h5>
						<strong><?php echo __("Qualifications :"); ?></strong> 
				<?php $index = 0; ?>
				<?php foreach ($training['keywords'] as $key=>$value): ?>
					<?php $index++; ?>
							<a href="<?php echo $key; ?>"><?php echo $value; ?></a>
					<?php if (count($training['keywords']) > $index): ?>
						,
					<?php endif; ?>
				<?php endforeach; ?>
					</h5>
				</div>
				<div class="grid_6">
					<hr>
				</div>
			<?php endforeach; ?>
		<?php else: ?>
			<div class="grid_6 ac">
				<h6><?php echo __("No training records in"); ?></h6>
			</div>
		<?php endif; ?>
		</section>
	<!-- END TRAININGS -->
	
	
	
	

		<div class="clear"></div>
	
	
	
	
	
	
	<!-- HOBBIES -->
		<header>
			<ul class="action-buttons fr">
				<li>
					<?php echo Html::anchor("#", "<span class='add'></span>", array("class" => "button button-gray no-text modalInput", "title" => __("New hobbie"), "rel" => "#resume_add_hobbie")); ?>
				</li>
			</ul>
			<h2><?php echo __("Hobbies"); ?></h2>
		</header>
	  	<section class="pane clearfix">
		<!-- HOBBIES DATA -->
			<div class="grid_1 alpha ar">&nbsp;</div>
			<div class="grid_5 omega">
				<?php $hobbies_count = count($resume->hobbies); ?>
				<?php $index = 0; ?>
				<?php if (isset($resume->hobbies) && $hobbies_count > 0): $index++; ?>
				<?php foreach ($resume->hobbies as $hobbie): ?>
					<abbr>
						<?php $hobbie = ($hobbies_count > $index)? $hobbie . ", " : $hobbie; ?>
						<?php echo $hobbie . " "; ?>
					</abbr>
				<?php endforeach; ?>
			<?php else: ?>
				<abbr><?php echo __("No hobbies"); ?></abbr>
			<?php endif; ?>
			</div>
		</section>
	<!-- END HOBBIES -->
	
	
	
	
	
		<div class="clear"></div>
	
	
	
		
	
	<!-- KEYWORDS -->
		<header>
			<ul class="action-buttons fr">
				<li>
					<?php echo Html::anchor("#", "<span class='add'></span>", array("class" => "button button-gray no-text modalInput", "title" => "New keyword", "rel" => "#resume_add_keyword")); ?>
				</li>
			</ul>
			<h2><?php echo __("Keywords"); ?></h2>
		</header>
	  	<section class="pane clearfix">
			<div class="grid_1 alpha">&nbsp;</div>
			<div class="grid_5 omega">
			<?php if (isset($resume->keywords) && count($resume->keywords) > 0): ?>
				<?php foreach ($resume->keywords as $keyword): ?>
					<?php echo Html::anchor("#", $keyword, array("class" => "tag")); ?>
				<?php endforeach; ?>
			<?php else: ?>
				<abbr><?php echo __("No keywords"); ?></abbr>
			<?php endif; ?>
			</div>
		</section>
	<!-- END KEYWORDS -->
		




		<div class="clear"></div>
	
	
	
		
	
	<!-- STATISTICS -->
		<header>
			<h2><?php echo __("Knowledge Industries"); ?></h2>
		</header>
	  	<section class="pane clearfix">
			<div id="chart-container-1" style="width: 100%; height: 400px"></div>
		</section>
	<!-- END STATISTICS -->
	





		<div class="clear"></div>
		



	
	
	<!-- SKILLS -->
		<header>
			<ul class="action-buttons fr">
				<li><?php echo Html::anchor("#", "<span class='pencil'></span>", array("class" => "button button-gray no-text modalInput", "title" => "Update Skill", "rel" => "#resume_edit_skill")); ?></li>
				<li><?php echo Html::anchor("#", "<span class='add'></span>", array("class" => "button button-gray no-text modalInput", "title" => "New Skill", "rel" => "#resume_add_skill")); ?></li>
			</ul>
			<h2><?php echo __("Skills"); ?></h2>
		</header>
	  	<section class="pane clearfix">
			<div id="skills_chart" data-resume="<?php echo $resume->id; ?>" style="width: 100%; height: 400px"></div>
			<br>
			<?php if (isset($resume->skills) && count($resume->skills) > 0): ?>
			<ul class="tagit ui-widget ui-widget-content ui-corner-all" style="display: block;">	
				<?php foreach ($resume->skills as $id => $skill): ?>
				<li class="tagit-choice ui-widget-content ui-state-default ui-corner-all">
					<span class="tagit-label"><?php echo $skill['item']; ?></span>
					<?php echo Html::anchor("resume/delete_skill/id/" . $id . "/rid/" . $resume->id, "", array("class" => "ui-icon ui-icon-close close")); ?>
				</li>
				<?php endforeach; ?>
			</ul>
			<?php else: ?>
				<abbr><?php echo __("No keywords"); ?></abbr>
			<?php endif; ?>
		</section>
	<!-- END SKILLS -->



	</div>
</section>