<?php
// $Id$


defined('SYSPATH') OR die('No direct access allowed.');

return array(
  // the view file
  'view' => 'menu',
  // the set_current() method uses this setting to mark the current menu item
  'current_class' => 'current',
  'items' => array(
    array(
      'url' => 'member/register',
      'title' => __('Home'),
    ),
    array(
      'url' => 'download',
      'title' => __('Download'),
      'classes' => array('test'),
    ),
    array(
      'url' => 'documentation',
      'title' => __('Documentation'),
      'items' => array(
        array(
          'url' => 'documentation/lorem-ipsum',
          'title' => __('Lorem ipsum'),
        ),
        array(
          'url' => 'documentation/dolor-sit-amet',
          'title' => __('Dolor sit amet'),
        ),
      ),
    ),
    array(
      'url' => 'community',
      'title' => __('Community'),
    ),
    array(
      'url' => 'development',
      'title' => __('Development'),
    ),
  ),
);

