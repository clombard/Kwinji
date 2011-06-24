var chart;
var skills_chart;
$(document).ready(
		function() {
			var resume_id = $('#skills_chart').attr("data-resume");

			// CHART LINE - SKILLS
			$.ajax({
				url : "ajax/resume_chart/rid/" + resume_id,
				type : "GET",
				data : null,
				success : function(data, textStatus, jqXHR) {
					var obj = jQuery.parseJSON(data);
					// Search element to delete from IHM.
					var objId = obj.id;
					var title = obj.title;
					var subtitle = obj.subtitle;
					var yAxisTitle = obj.y_title;
					var xAxisItems = obj.x_items;
					var series = obj.series;
					var series_type = obj.series_type;
					var series_name = obj.series_name;

					skills_chart = new Highcharts.Chart({
						chart : {
							renderTo : 'skills_chart',
							marginRight : 0,
							marginBottom : 55
						},
						title : {
							text : title
						},
						subtitle : {
							text : subtitle
						},
						xAxis : {
							categories : xAxisItems
						},
						yAxis : {
							title : {
								text : yAxisTitle
							},
							plotLines : [ {
								value : 0,
								width : 1,
								color : '#808080'
							} ]
						},
						legend : {
							layout : 'horizontal',
							align : 'right',
							verticalAlign : 'top',
							x : -10,
							y : 0,
							borderWidth : 0
						},
						tooltip : {
							formatter : function() {
								var s;
								if (this.point.name) { // the pie chart
									s = '' + this.point.name + ': ' + this.y;
								} else {
									s = '' + this.x + ': ' + this.y;
								}
								return s;
							}
						},
						series : [ {
							type : series_type,
							name : series_name,
							data : series
						} ]
					});
				}
			});

			
			$.ajax({
				url : "ajax/resume_industries/rid/" + resume_id,
				type : "GET",
				data : null,
				success : function(data, textStatus, jqXHR) {
					var obj = jQuery.parseJSON(data);
					// Search element to delete from IHM.
					var objId = obj.id;
					var title = obj.title;
					var series = obj.series;
					var series_name = obj.series_name;
					// HIGHCHART
					chart = new Highcharts.Chart({
						chart : {
							renderTo : 'chart-container-1',
							plotBackgroundColor : null,
							plotBorderWidth : null,
							plotShadow : false
						},
						title : {
							text : title
						},
						tooltip : {
							formatter : function() {
								return '<b>' + this.point.name + '</b>: ' + this.y
										+ ' %';
							}
						},
						plotOptions : {
							pie : {
								allowPointSelect : true,
								cursor : 'pointer',
								dataLabels : {
									enabled : true,
									color : '#000000',
									connectorColor : '#000000',
									formatter : function() {
										return '<b>' + this.point.name + '</b>: '
												+ this.y + ' %';
									}
								}
							}
						},
						series : [ {
							type : 'pie',
							name : series_name,
							data : series
						} ]
					});
				}
			});

		});