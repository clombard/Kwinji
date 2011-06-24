<ul>
  <?php foreach ($menu['items'] as &$item) { ?>
  <li>
    <?php echo HTML::anchor($item['url'], $item['title'], array('class'=> $item['classes']));   ?>
  </li>
  <?php } ?>
</ul>