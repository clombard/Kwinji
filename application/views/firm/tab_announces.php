
	<h1><?php echo __("All offers"); ?></h1>
	<table class="datatable paginate sortable full">
		<thead>
			<tr>
				<th><?php echo __("Job title"); ?></th>
				<th><?php echo __("City"); ?></th>
				<th><?php echo __("Country"); ?></th>
				<th style="width:100px;"></th>
			</tr>
		</thead>
		<tbody style="display: table-row-group;">

<?php foreach ($offers as  $offer): ?>
			<tr>
				<td class="ac"><?php echo $offer->details['name']; ?></td>
				<td class="ac"><?php echo $offer->_place_city->name; ?></td>
				<td class="ac"><?php echo $offer->_place_country->name; ?></td>
				<td>
					<ul class="action-buttons">
                        <li><?php echo Html::anchor('offer/view/id/' . $offer->id, '<span class="find"></span>' . __('View'), array('class' => 'button button-gray no-text')); ?>   </li>
                        <li><?php echo Html::anchor('offer/edit/id/' . $offer->id, '<span class="pencil"></span>' . __('Edit'), array('class' => 'button button-gray no-text')); ?>   </li>
                    	<li><?php echo Html::anchor('offer/delete/id/' . $offer->id, '<span class="bin"></span>' . __('Delete'), array('class' => 'modalInput button button-gray no-text', 'rel' => '#confirm', 'data-message' => __('Are you sure you want to delete this offer ? <br><h3>&laquo; :offer &raquo;</h3>', array(':offer' => $offer->details['name'])))); ?>   </li>
                	</ul>
				</td>
			</tr>
<?php endforeach; ?>

    	</tbody>
	</table>
