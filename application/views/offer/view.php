<header>
	<?php echo $header_tools; ?>
	<?php echo $header_title; ?>
</header>
<section class="container_6 clearfix">
	
	<div class="grid_2">
		<figure class="ac">
	<?php $logo = "static/img/preview-not-available.gif"; ?>
	<?php if (isset($offer->image)): ?>
		<?php $logo = $offer->image; ?>
	<?php elseif (isset($offer->_firm->image)): ?>
		<?php $logo = $offer->_firm->image; ?>
	<?php endif; ?>
	<?php if (isset($offer->website)): ?>
		<?php echo HTML::anchor($offer->website, HTML::image($logo), array("class" => NULL)); ?>
	<?php else: ?>
		<?php echo HTML::image($logo);?>
	<?php endif; ?>
		</figure>
		<h3><?php echo __("Details"); ?></h3>
		<div class="message info">
			<h4><?php echo __('Graduation'); ?></h4>
			<p>
			<?php foreach ($offer->graduations as $graduation): ?>
				<?php echo $graduation->value;?><br />
			<?php endforeach; ?>
			</p>
			<h4><?php echo __('Industry'); ?></h4>
			<p>
			<?php foreach ($offer->sectors as $industry): ?>
				<?php echo $industry; ?></a><br />
			<?php endforeach; ?>
			</p>
			<h4><?php echo __('Function'); ?></h4>
			<p>
			<?php foreach ($offer->jobs as $job_type): ?>
				<?php echo $job_type->value; ?><br />
			<?php endforeach; ?>
			</p>
			<h4><?php echo __('Remuneration'); ?></h4>
			<p>
				<?php echo $offer->bill; ?><br />
			</p>
			<h4><?php echo __('Contract type'); ?></h4>
			<p>
			<?php foreach ($offer->contracts as $contract_type): ?>
				<?php echo $contract_type; ?><br />
			<?php endforeach; ?>
			</p>
		</div>
	</div>
	
	<div class="other-options grid_4">
	
		<h2><?php echo $offer->details['name']; ?></h2>
		
		<button class="button button-green"><?php echo __("Postulate"); ?></button>
		<button class="button button-red"><?php echo __("Cancel"); ?></button>
		<h3 class="others"><?php echo __("Address"); ?></h3>
		<ul class="profile-info">
		<?php if (isset($offer->street)): ?>
			<li class="building"><?php echo $offer->street; ?></li>
		<?php endif; ?>
		<?php if (isset($offer->street_details)): ?>
			<li><?php echo $offer->street_details; ?></li>
		<?php endif; ?>
		<?php if (isset($offer->_place_city->code)): ?>
			<li><?php echo $offer->_place_city->code . " " . $offer->_place_city->name; ?></li>
		<?php endif; ?>
		<?php if (isset($offer->_place_country->name)): ?>
			<li><?php echo Html::anchor('offer/view/country/' . $offer->_place_country->id, $offer->_place_country->name); ?></li>
		<?php endif; ?>
		</ul>

		<h3 class="others"><?php echo __("Description"); ?></h3>
		<p><?php echo $offer->description; ?></p>
		
		<h3 class="others"><?php echo __("SKills required"); ?></h3>
<?php foreach ($offer->skills as $skill): ?>
		<!-- PROGRESS BAR COLOR  --> 
	<?php $progress_class = 'progress'; ?>
	<?php $level = intval($skill['level']); ?>
	<?php if($level < 20): ?>
		<?php $progress_class .= '-red'; ?>
	<?php elseif ($level >= 20 && $level <= 50):?>
		<?php $progress_class .= '-orange'; ?>
	<?php elseif ($level >= 50 && $level <= 70):?>
		<?php $progress_class .= '-blue'; ?>
	<?php elseif ($level > 70):?>
		<?php $progress_class .= '-green'; ?>
	<?php endif; ?>
		<div id="" class="progress <?php echo $progress_class; ?>" value="19"><span style="width: <?php echo $level; ?>%; display: block;"><b style="display: inline;"><?php echo $skill['value']; ?></b></span></div>
		<!-- END OF PROGRESS BAR COLOR --></td>
<?php endforeach; ?>
	</div>
	
	<div class="grid_6">
		<hr>
		<p class="ta-right">
			<small>
			<?php echo __("Created on ") . date("D, d F Y", $offer->dt_created) . " ";?>
			<?php echo __("By "); ?>
			<?php $item = 0; ?>
			<?php foreach ($offer['authors'] as $author): ?>
				<?php $item++; ?>
				<?php echo HTML::anchor($author['path'], $author['value'], array("title" => $author['value'])); ?>
				<?php if (count($offer['authors']) == $item + 1 ): ?> &amp; <?php elseif (count($offer['authors']) > $item + 1): ?>, 
				<?php endif; ?>
			<?php endforeach; ?>
			</small>
		</p>
	</div>	
</section>