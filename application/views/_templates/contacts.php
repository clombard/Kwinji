<!DOCTYPE html>
<html <?php echo $html_namespaces; ?> lang="en">
<head>
<title><?php echo $title; ?></title>
<?php echo $metas; ?>
<?php echo $links; ?>
<?php echo $css; ?>
<?php echo $js_header; ?>
</head>
<body>
	<!-- Header -->
	<header id="top">
		<?php echo $header; ?>
	</header>
	<!-- End of Header -->
	<!-- Page title -->
	<div id="pagetitle">
		<div class="wrapper">
			<?php echo $breadcrumbs; ?>
      <?php echo $search; ?>
		</div>
	</div>
	<!-- End of Page title -->
	
	<!-- Page content -->
	<div id="page">
		<!-- Wrapper -->
		<div class="wrapper">
				<!-- Left column/section -->
				<section class="column width5 first">					
		          <?php echo $main; ?>
				</section>
				<!-- End of Left column/section -->
				
				<!-- Right column/section -->
				<aside class="column width3"> 
					<?php if (isset($infos)): ?>
						<?php echo $infos; ?>
					<?php endif; ?>
					<div class="content-box corners">
					<?php echo $right_top; ?>
					</div>
					<div class="content-box corners">
						<?php echo $ads; ?>
					</div>
				</aside>
				<!-- End of Right column/section -->
				
		</div>
		<!-- End of Wrapper -->
	</div>
	<!-- End of Page content -->
	
<?php echo $footer; ?>
	
	<!-- Scroll to top link -->
  <?php echo HTML::anchor('#', __('^ scroll to top'), array('id'=>'totop')); ?>

<?php echo $js_footer; ?>
</body>
</html>