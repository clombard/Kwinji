$(function() {	var dataresponse = eval('(' + response + ')');	if (dataresponse.result == '1') {		var filenametmp = (dataresponse.file);		$('#tempfile').val(filenametmp);		var img = new Image();		$(img).load(				function() {					alert("MERDE");					$imgpos.width = dataresponse.imagewidth;					$imgpos.height = dataresponse.imageheight;					$("#cropbox").remove();					$(".jcrop-holder").remove();					$(this).attr('id', 'cropbox');					$(this).hide();					$('#image_container').append(this);					$(this).fadeIn().Jcrop({						onChange : showPreview,						onSelect : showPreview,						aspectRatio : 0.68,						onSelect : updateCoords,						setSelect : [ 0, 0, 150, 150 ],						bgOpacity : .8,						sideHandles : false					});					$("#preview").remove();					var _imgprev = $(document.createElement('img')).attr('id',							'preview').attr('src', dataresponse.file);					$('#preview_container').append(_imgprev);				}).attr('src', dataresponse.file);	} else		alert('error');	function updateCoords(c) {		$('#x').val(c.x);		$('#y').val(c.y);		$('#w').val(c.w);		$('#h').val(c.h);	}	;	function checkCoords() {		if (parseInt($('#w').val())) {			return true;		}		$('#x').val(0);		$('#y').val(0);		$('#w').val(150);		$('#h').val(150);		return true;	}	;	function showPreview(coords) {		if (parseInt(coords.w) > 0) {			var rx = 110 / coords.w;			var ry = 160 / coords.h;			$('#preview').css({				width : Math.round(rx * $imgpos.width) + 'px',				height : Math.round(ry * $imgpos.height) + 'px',				marginLeft : '-' + Math.round(rx * coords.x) + 'px',				marginTop : '-' + Math.round(ry * coords.y) + 'px'			});		}	}	;	$imgpos = {		width : '100',		height : '100'	};});