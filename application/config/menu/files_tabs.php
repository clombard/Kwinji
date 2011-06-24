<?php
// $Id$

defined('SYSPATH') OR die('No direct access allowed.');

return array(
  // the view file
  'view' => '_menus/files_tabs',
  // the set_current() method uses this setting to mark the current menu item
  'current_class' => 'ui-tabs-selected',
  'items' => array(
    array(
      'url' => '#tabs-date',
      'title' => __('List by date'),
      'classes' => 'corner-tl',
    ),
    array(
      'url' => '#tabs-abc',
      'title' => __('List by alphabet'),
      'classes' => 'corner-tr',
    ),
  ),
);

