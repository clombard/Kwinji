<!DOCTYPE html>
<html <?php echo $html_namespaces; ?> lang="en">
<head>
<title><?php echo $title; ?></title>
<?php echo $metas; ?>
<?php echo $links; ?>
<?php echo $css; ?>
<?php echo $js_header; ?>
<script type="text/javascript">

$(document).ready(function(){
	
	/* setup navigation, content boxes, etc... */
	Administry.setup();

	/* progress bar animations - setting initial values */
	Administry.progress("#capacity", 72, 100);
	
	/* tabs */
	$("#tabs").tabs();
	
});
</script>
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
				<section class="column width6 first">					

				<?php echo $style_files; ?>

				</section>
				<!-- End of Left column/section -->
				
				<!-- Right column/section -->
				<aside class="column width2">
					<p class="leading">
          
          <?php echo $files_upload; ?>
          
          </p>
					<div class="box">
						<?php echo $files_storage; ?>
					</div>
					<div class="content-box">
						<?php echo $files_tags; ?>
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