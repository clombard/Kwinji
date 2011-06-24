<?php if (count($breadcrumbs)) { ?>
<h1 class="breadcrumbs">
	<?php for($b = 0; $b < count($breadcrumbs); $b++) { ?>
    <?php if ($breadcrumbs[$b]->get_url()) { ?>
      <?php $breadcrumb = HTML::anchor($breadcrumbs[$b]->get_url(), $breadcrumbs[$b]->get_title());  ?>
    <?php }else{ ?>
       <?php $breadcrumb = $breadcrumbs[$b]->get_title();  ?>   
    <?php } ?>
    <?php if($b > 0) {?>
      <?php echo ' → '; ?><span><?php echo $breadcrumb; ?></span>
    <?php }else{ ?>
      <?php echo $breadcrumb; ?>
    <?php } ?>
  <?php } ?>
</h1>
<?php } ?>