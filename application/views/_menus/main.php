<ul class="sf-menu">
<?php
	foreach ($menu['items'] as &$item):
		$classes = '';
		if (isset($item['classes']))
			$classes = ' class="'.join(' ', $item['classes']).'"';
?>

<?php if(isset ($item['perms']) ==false || $item['perms']==true ) { ?>

	<li<?php echo $classes; ?>>
	<?php
		echo HTML::anchor($item['url'], $item['title']);
		if (isset($item['items']))
		{
			$items = array('items' => &$item['items']);
			echo View::factory('menu')->bind('menu', $items)->render();
		}
	?>
	</li>
  
<?php } ?>  
  
<?php endforeach; ?>
</ul>