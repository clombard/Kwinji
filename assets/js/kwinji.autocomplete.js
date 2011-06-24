
$(document).ready(function() {
});

$(function() {

	function log(event, data, formatted) {
		$("<li>").html( !data ? "No match!" : "Selected: " + formatted).appendTo("#result");
	}
	
	function formatItem(row) {
		return row[0] + " (<strong>id: " + row[1] + "</strong>)";
	}
	function formatResult(row) {
		return row[0].replace(/(<.+?>)/gi, '');
	}

	$(".autocomplete").each(function() {
		var input_name = $(this).attr("name");
		var collection = $(this).attr("data-collection");
		var field = $(this).attr("data-field");
		var scope = $(this).attr("data-scope");
		var scope_value = $(this).attr("data-scope-value");
		$('input[name="' + input_name + '"]').autocomplete({
			source: function( request, response ) {
				$.ajax({
					url: "http://www.kwinji.com/ajax/autocomplete/",
					dataType: "json",
					data: {
						collectionName: collection,
						fieldName: field,
						scope: scope,
						scopeData: scope_value,
						name_startsWith: request.term
					},
					success: function( data ) {
						response( $.map( data.result, function( item ) {
							return {
								label: item.label,
								value: item.label
							}
						}));
					}
				});
			},
			select: function( event, ui ) {
				log( ui.item ?
					"Selected: " + ui.item.label :
					"Nothing selected, input was " + this.value);
			},
			open: function() {
				$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
			},
			close: function() {
				$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
			},
			minLength: 1
		});
	});

	$('input#city').autocomplete("http://ws.geonames.org/searchJSON", {
		dataType: 'jsonp',
		parse: function(data) {
			alerte($(this).val());
			var rows = new Array();
			data = data.geonames;
			for(var i=0; i<data.length; i++){
				rows[i] = { data:data[i], value:data[i].name, label:data[i].name };
			}
			return rows;
		},
		formatItem: function(row, i, n) {
			return row.name + ', ' + row.adminCode1;
		},
		extraParams: {
			// geonames doesn't support q and limit, which are the autocomplete plugin defaults, so let's blank them out.
			q: '',
			limit: '',
  			country: 'US',
			featureClass: 'P',
			style: 'full',
			maxRows: 50,
			name_startsWith: function () { return $('input#city').val(); }
		},
		max: 50
	});
});
function changeOptions(){
	var max = parseInt(window.prompt('Please type number of items to display:', jQuery.Autocompleter.defaults.max));
	if (max > 0) {
		$("#suggest1").setOptions({
			max: max
		});
	}
}

function changeScrollHeight() {
    var h = parseInt(window.prompt('Please type new scroll height (number in pixels):', jQuery.Autocompleter.defaults.scrollHeight));
    if(h > 0) {
        $("#suggest1").setOptions({
			scrollHeight: h
		});
    }
}

function changeToMonths(){
	$("#suggest1")
		// clear existing data
		.val("")
		// change the local data to months
		.setOptions({data: months})
		// get the label tag
		.prev()
		// update the label tag
		.text("Month (local):");
}
