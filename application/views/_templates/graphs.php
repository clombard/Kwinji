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
	
	/* sparklines */
	var _values = [0,3,3,2,0,1,5,7,5,5,0,6,4,6,3,6,14,8,2,9,2,6,9,3,6,5,7,1,7,7,0];
	$('#sparkline1').sparkline(_values, {type: 'bar', barColor: '#A8B2AC', zeroColor: '#DBE6DF', barWidth: 2, barSpacing: 0} );
	$('#sparkline2').sparkline(_values);
	
	/* flot graphs */
    var d1 = [];
    for (var i = 0; i < 14; i += 0.5)
        d1.push([i, Math.sin(i)]);

    var d2 = [[0, 3], [4, 8], [8, 5], [9, 13]];

    var d3 = [];
    for (var i = 0; i < 14; i += 0.5)
        d3.push([i, Math.cos(i)]);

    var d4 = [];
    for (var i = 0; i < 14; i += 0.1)
        d4.push([i, Math.sqrt(i * 10)]);
    
    var d5 = [];
    for (var i = 0; i < 14; i += 0.5)
        d5.push([i, Math.sqrt(i)]);

    var d6 = [];
    for (var i = 0; i < 14; i += 0.5 + Math.random())
        d6.push([i, Math.sqrt(2*i + Math.sin(i) + 5)]);
                        
    $.plot($("#placeholder"), [
        {
            data: d1,
            lines: { show: true, fill: true }
        },
        {
            data: d2,
            bars: { show: true }
        },
        {
            data: d3,
            points: { show: true }
        },
        {
            data: d4,
            lines: { show: true }
        },
        {
            data: d5,
            lines: { show: true },
            points: { show: true }
        },
        {
            data: d6,
            lines: { show: true, steps: true }
        }
    ]); 
	
	var fh_data = [
	{
		label: 'max',
		data: [[1267873200 * 1000, 2],[1267959600 * 1000, 2],[1268046000 * 1000, 2],[1268132400 * 1000, 3],[1268218800 * 1000, 3],[1268305200 * 1000, 3],[1268391600 * 1000, 3],[1268478000 * 1000, 5],[1268564400 * 1000, 7],[1268650800 * 1000, 4],[1268737200 * 1000, 7],[1268823600 * 1000, 7],[1268910000 * 1000, 12],[1268996400 * 1000, 14],[1269082800 * 1000, 16],[1269169200 * 1000, 18],[1269255600 * 1000, 14],[1269342000 * 1000, 15],[1269428400 * 1000, 17],[1269514800 * 1000, 18],[1269601200 * 1000, 20],[1269687600 * 1000, 16],[1269774000 * 1000, 14],[1269856800 * 1000, 17],[1269943200 * 1000, 19],[1270029600 * 1000, 15],[1270116000 * 1000, 16],[1270202400 * 1000, 13],[1270288800 * 1000, 16],[1270375200 * 1000, 19],[1270461600 * 1000, 13],[1270548000 * 1000, 14],[1270634400 * 1000, 15]]
	},
	{
		label: 'min',
		data: [[1267873200 * 1000, -3],[1267959600 * 1000, -3],[1268046000 * 1000, -2],[1268132400 * 1000, -2],[1268218800 * 1000, 0],[1268305200 * 1000, 0],[1268391600 * 1000, -2],[1268478000 * 1000, 0],[1268564400 * 1000, 2],[1268650800 * 1000, 0],[1268737200 * 1000, -1],[1268823600 * 1000, 2],[1268910000 * 1000, 4],[1268996400 * 1000, 6],[1269082800 * 1000, 9],[1269169200 * 1000, 11],[1269255600 * 1000, 9],[1269342000 * 1000, 9],[1269428400 * 1000, 8],[1269514800 * 1000, 10],[1269601200 * 1000, 11],[1269687600 * 1000, 7],[1269774000 * 1000, 6],[1269856800 * 1000, 9],[1269943200 * 1000, 11],[1270029600 * 1000, 7],[1270116000 * 1000, 7],[1270202400 * 1000, 5],[1270288800 * 1000, 6],[1270375200 * 1000, 9],[1270461600 * 1000, 8],[1270548000 * 1000, 5],[1270634400 * 1000, 7]]
	}
	];
	function weekendAreas(plotarea) {
		var areas = [];
		var d = new Date(plotarea.xmin);
		// go to the first Saturday
		d.setDate(d.getDate() - ((d.getDay() + 1) % 7))
		d.setSeconds(0);
		d.setMinutes(0);
		d.setHours(0);
		var i = d.getTime();
		do {
			areas.push({ x1: i, x2: i + 2 * 24 * 60 * 60 * 1000 });
			i += 7 * 24 * 60 * 60 * 1000;
		} while (i < plotarea.xmax);

		return areas;
	}
	function showTooltip(x, y, contents) {
		$('<div id="hovertip">' + contents + '</div>').css( {
			position: 'absolute',
			display: 'none',
			top: y + 5,
			left: x + 15,
			border: '2px solid #666',
			padding: '4px',
			'background-color': '#fff',
			opacity: 0.9,
			color: '#666',
			fontSize: '13px'
		}).appendTo("body").fadeIn('fast');
	}
	
	var options = {
		lines: { show: true, lineWidth: 3 },
		points: { show: true },
		legend: { noColumns: 2, position: "se"/*, container: '#flot-legend'*/ },
		yaxis: { min: -25, max: 25 },
		xaxis: { mode: "time", timeformat: "%d %b", monthNames: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"] },
		selection: { mode: "x" },
		grid: { color: "#666", coloredAreas: weekendAreas, hoverable: true },
		colors: ["#E92424", "#75C5F0"]			
	};
	
	var plot = $.plot($("#flotPlaceholder"), fh_data, options);
	
	$("#flotPlaceholder").bind("selected", function (event, area) {
		plot = $.plot($("#flotPlaceholder"), fh_data,
			  $.extend(true, {}, options, {
				  xaxis: { min: area.x1, max: area.x2 }
			  }));
		$('#clearSelection').show();
	});
	var previousPoint = null;
	$("#flotPlaceholder").bind("plothover", function (event, pos, item) {
		if (item) {
			if (previousPoint != item.datapoint) {
				previousPoint = item.datapoint;
				
				$("#hovertip").remove();
				var y = item.datapoint[1];
				
				showTooltip(item.pageX, item.pageY, y + '�C');
			}
		}
		else {
			$("#hovertip").remove();
			previousPoint = null;            
		}
	});
	$("#clearSelection").click(function () {
		$.plot($("#flotPlaceholder"), fh_data, options);
		$('#clearSelection').hide();
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
			<!-- Quick search box -->
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

					<?php echo $sparklines; ?>
					
					<?php echo $graphical_plots; ?>
				
					<?php echo $sample_usage; ?>
					
				</section>
				<!-- End of Left column/section -->
				
				<!-- Right column/section -->
				<aside class="column width2">
					<div id="rightmenu">
						<?php echo $checkout; ?>
					</div>
					<div class="content-box">
						<?php echo $alternative; ?>
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