<!DOCTYPE html>
<html <?php echo $html_namespaces; ?> lang="en">
<head>
<title><?php echo $title; ?></title>
<?php echo $metas; ?>
<?php echo $links; ?>
<?php echo $css; ?>
<?php echo $js_header; ?>
<script type="text/javascript">

/* sample tags */
var tags=[
	{tag:"js",freq:30},{tag:"jquery",freq:25}, {tag:"pojo",freq:10},{tag:"agile",freq:4},
	{tag:"blog",freq:3},{tag:"canvas",freq:8}, {tag:"dialog",freq:3},{tag:"excel",freq:4},
	{tag:"engine",freq:5},{tag:"flex",freq:18}, {tag:"firefox",freq:23},{tag:"javascript",freq:40},
	{tag:"graph",freq:15},{tag:"grid",freq:20}, {tag:"hibernate",freq:13},{tag:"ical",freq:4},
	{tag:"ldap",freq:9},{tag:"load",freq:20}, {tag:"security",freq:13},{tag:"XSS",freq:21},
	{tag:"CSRF",freq:19},{tag:"html",freq:22}, {tag:"xml",freq:13},{tag:"tools",freq:21}
];

$(document).ready(function(){
	
	/* setup navigation, content boxes, etc... */
	Administry.setup();
	
	$('#productdesc').wysiwyg({
		controls: {
			strikeThrough : { visible : true },
			underline     : { visible : true },

			justifyLeft   : { visible : true },
			justifyCenter : { visible : true },
			justifyRight  : { visible : true },
			justifyFull   : { visible : true },

			indent  : { visible : true },
			outdent : { visible : true },

			subscript   : { visible : true },
			superscript : { visible : true },

			undo : { visible : true },
			redo : { visible : true },

			insertOrderedList    : { visible : true },
			insertUnorderedList  : { visible : true },
			insertHorizontalRule : { visible : true },

			h4: {
				  visible: true,
				  className: 'h4',
				  command: $.browser.msie ? 'formatBlock' : 'heading',
				  arguments: [$.browser.msie ? '<h4>' : 'h4'],
				  tags: ['h4'],
				  tooltip: 'Header 4'
			},
			h5: {
				  visible: true,
				  className: 'h5',
				  command: $.browser.msie ? 'formatBlock' : 'heading',
				  arguments: [$.browser.msie ? '<h5>' : 'h5'],
				  tags: ['h5'],
				  tooltip: 'Header 5'
			},
			h6: {
				  visible: true,
				  className: 'h6',
				  command: $.browser.msie ? 'formatBlock' : 'heading',
				  arguments: [$.browser.msie ? '<h6>' : 'h6'],
				  tags: ['h6'],
				  tooltip: 'Header 6'
			},

			cut   : { visible : true },
			copy  : { visible : true },
			paste : { visible : true },
			html  : { visible: true }
		}
	}); 
  
	/* tag input field */
	$("#tags").tagInput({
		tags:tags,
		//jsonUrl:"tags.json",
		sortBy:"frequency",
		suggestedTags:["jquery", "tagging", "tag", "component", "delicious", "javascript"],
		tagSeparator:" ",
		autoFilter:true,
		autoStart:false,
		//suggestedTagsPlaceHolder:$("#suggested"),
		boldify:true
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

					<?php echo $styleproducts; ?>
          

				</section>
				<!-- End of Left column/section -->
				
				<!-- Right column/section -->
				<aside class="column width2">

          <?php echo $preview; ?>

          <?php echo $draft; ?>
          
          
					<div class="content-box">
						<?php echo $visibility; ?>
					</div>
					<div class="content-box">
						<?php echo $tags; ?>
					</div>
					<div id="rightmenu">
						<?php echo $help; ?>
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