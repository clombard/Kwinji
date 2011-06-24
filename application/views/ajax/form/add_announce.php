<header>
	<?php echo $header_tools; ?>
	<?php echo $header_title; ?>
</header>
<section class="container_6 clearfix">
	<div class="grid_6">
		<div class="message info ac">
	    	<h3>Get started: <a href="#">Add contacts to your account</a></h3>
	        <p>Vestibulum ultrices vehicula leo ac tristique. Mauris id nisl nibh. Cras egestas vestibulum nisl, nec eleifend nunc pulvinar non.</p>
		</div>
	</div>
	<?php echo Form::open('#', array('id'=>'announceForm', 'class' => 'form grid_6 form-validator'));  ?>

		<h3><?php echo __("Announce description"); ?></h3>
		<fieldset>

			<label class="required" for="title">
				<?php echo __("Title"); ?> <em>*</em>
				<small><?php echo __("Enter your announce title"); ?></small>
			</label>
			<input type="text" id="title" class="half" value="" name="title" />

			<label for="description"><?php echo __("Description"); ?> <em>*</em>
				<small><?php echo __("Describe your skills research"); ?></small>
			</label>
			<textarea id="description" class="half" name="description"></textarea>

		</fieldset>
		
		<h3><?php echo __("Location of your announce"); ?></h3>
		<fieldset>

			<?php echo Form::label("place", __("Place") . "<small>" . __('(ie Empire state bulding)') ."</small>", array("class" => "required")); ?>
			<?php echo Form::input("place", "", array("class" => "half", "id" => "place")); ?>

			<?php echo Form::label("address", __("Address") . "<small>" . __("Enter announce's address") ."</small>", array("class" => "required")); ?>
			<?php echo Form::input("address", "", array("class" => "half", "id" => "address")); ?>

			<?php echo Form::label("city", __("City"), array("class" => "required")); ?>
			<?php echo Form::input("city", "", array("class" => "half", "id" => "city")); ?>

			<?php echo Form::label("zip", __("Zip code"), array("class" => "required")); ?>
			<?php echo Form::input("zip", "", array("class" => "", "id" => "zip")); ?>

			<?php echo Form::label("country", __("Country"), array("class" => "required")); ?>
			<?php echo Form::select("country", $countries, null, array("class" => "", "id" => "country")); ?>

		</fieldset>
		
		<h3><?php echo __("Announce details"); ?></h3>
		<fieldset>

			<?php echo Form::label("begin", __("Begin date") . " <em>*</em><small>" . __('dd/mm/yyyy') ."</small>", array("class" => "required")); ?>
			<?php echo Form::input("begin", "", array("class" => "", "id" => "begin", "type" => "date")); ?>

			<?php echo Form::label("end", __("End date") . " <em>*</em><small>" . __('dd/mm/yyyy') ."</small>", array("class" => "required")); ?>
			<?php echo Form::input("end", "", array("class" => "", "id" => "end", "type" => "date")); ?>

			<?php echo Form::label("endsof", __("Registration Ends of") . " <em>*</em><small>" . __('dd/mm/yyyy') ."</small>", array("class" => "required")); ?>
			<?php echo Form::input("endsof", "", array("class" => "", "id" => "endsof", "type" => "date")); ?>

			<label for="graduation">
				<?php echo __("Graduation"); ?>
				<small><?php echo __("Select one or multiple graduations"); ?></small>
			</label>
			<?php echo Form::select("graduations", $graduations, null, array("multiple" => "multiple", "id" => "graduation"));?>

			<label for="industries">
				<?php echo __("Industries"); ?>
				<small><?php echo __("Select one or multiple industries"); ?></small>
			</label>
			<?php echo Form::select("experiences", $industries, null, array("multiple" => "multiple", "id" => "experience"));?>

			<label for="experience">
				<?php echo __("Experience"); ?>
				<small><?php echo __("Select one or multiple experiences"); ?></small>
			</label>
			<?php echo Form::select("experiences", $experiences, null, array("multiple" => "multiple", "id" => "experience"));?>

			<label for="graduation">
				<?php echo __("Job"); ?>
				<small><?php echo __("Select one or multiple functions"); ?></small>
			</label>
			<?php echo Form::select("graduations", $graduations, null, array("multiple" => "multiple", "id" => "graduation"));?>

			<label><?php echo __("Engagement type"); ?></label>
       <?php echo Form::checkbox('test', 1);	   ?>
            <input value="11454.11752" id="EtyIdChbx1" name="chbEngagement" type="checkbox"><label for="EtyIdChbx1" class="choice">CDI</label>
            <input value="11454.11752" id="EtyIdChbx2" name="chbEngagement" type="checkbox"><label for="EtyIdChbx2" class="choice">CDD / Interim / Mission</label>
            <input value="11454.11752" id="EtyIdChbx3" name="chbEngagement" type="checkbox"><label for="EtyIdChbx3" class="choice">Freelance / Ind&eacute;pendant / saisonnier</label>
            <input value="11454.11752" id="EtyIdChbx4" name="chbEngagement" type="checkbox"><label for="EtyIdChbx4" class="choice">Titulaire de la fonction publique</label>
            <input value="11454.11752" id="EtyIdChbx5" name="chbEngagement" type="checkbox"><label for="EtyIdChbx5" class="choice">Stage</label>
			<label for="exp_level">Experience Level:</label>
	        <select name="exp_level" id="exp_level" multiple="multiple" class="">
	          <option value="">Dirigeant / Entrepreneur</option>
	          <option value="">Responsable de d&eacute;partement</option>
	          <option value="">Responsable d'&eacute;quipe</option>
	          <option value="">Confirm&eacute; / Senior</option>
	          <option value="">Junior</option>
	          <option value="">Jeune Dipl&ocirc;m&eacute;</option>
	          <option value="">Etudiant</option>
	        </select>

			<label>Job type:</label>
      <input>
            <input value="11454.11752" id="JtyIdChbx1" name="chbJType" type="checkbox"><label for="JtyIdChbx1" class="choice">Temps plein</label>
            <input value="11454.11752" id="JtyIdChbx2" name="chbJType" type="checkbox"><label for="JtyIdChbx2" class="choice">Temps partiel</label>
            <input value="11454.11752" id="JtyIdChbx3" name="chbJType" type="checkbox"><label for="JtyIdChbx3" class="choice">Journalier</label>
		</fieldset>
			
			<div class="action ta-right">
					<?php echo __(':simple_gray orbig_green', array(
			        	':big_green'=>Form::button("valid", __('Submit'), array('class'=>'button button-green')),
			            ':simple_gray'=>Form::button("reset", __('Reset'), array('type'=>'reset', 'class'=>'button button-gray')),
					)); ?>
			</div>

	<?php echo Form::close(); ?>
</section>