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
	Administry.progress("#progress1", 19, 20);
	Administry.progress("#progress2", 15, 20);
	Administry.progress("#progress3", 9, 20);

	/* flot graphs */
	var sales = [{
		label: 'Total Paid',
		data: [[1, 0],[2,0],[3,0],[4,0],[5,0],[6,0],[7,900],[8,0],[9,0],[10,0],[11,0],[12,0]]
	},{
		label: 'Total Due',
		data: [[1, 0],[2,0],[3,0],[4,0],[5,0],[6,422.10],[7,0],[8,0],[9,0],[10,0],[11,0],[12,0]]
	}
	];

	var plot = $.plot($("#placeholder"), sales, {
		bars: { show: true, lineWidth: 1 },
		legend: { position: "nw" },
		xaxis: { ticks: [[1, "Jan"], [2, "Feb"], [3, "Mar"], [4, "Apr"], [5, "May"], [6, "Jun"], [7, "Jul"], [8, "Aug"], [9, "Sep"], [10, "Oct"], [11, "Nov"], [12, "Dec"]] },
		yaxis: { min: 0, max: 1000 },
		grid: { color: "#666" },
		colors: ["#0a0", "#f00"]			
    });
	  

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
				
					<div class="colgroup leading">
						<div class="column width3 first">
              <?php echo $welcome; ?>
						</div>
						<div class="column width3">
              <?php echo $last_login; ?>
						</div>
					</div>
					
					<div class="colgroup leading">
						<div class="column width3 first">
							<?php echo $invoices; ?>
						</div>
						<div class="column width3">
							<?php echo $sales; ?>
						</div>
					</div>
				
					<div class="colgroup leading">
						<div class="column width3 first">
							<?php echo $skills; ?>
						</div>
						<div class="column width3">
							<?php echo $reports; ?>
              </div>
					</div>
					<div class="clear">&nbsp;</div>
				
				</section>
				<!-- End of Left column/section -->
				
				<!-- Right column/section -->
				<aside class="column width2">
					<div id="rightmenu">
						<?php echo $account; ?>
					</div>
					<div class="content-box">
						<?php echo $community; ?>
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