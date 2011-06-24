<h4><?php echo Html::anchor('offer/view/'. $offer->id, $offer->details['name']);?></h4>
<p>
  <?php echo $offer->ref_firm->details['name']; ?>
  &nbsp;
  <span class="timestamp"><?php echo date("d M", $offer->dates['starts']);?> </span>
</p>
