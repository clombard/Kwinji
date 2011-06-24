<?php
// $Id$


defined('SYSPATH') OR die('No direct access allowed.');

return array(
  // the view file
  'view' => '_menus/login',
  // the set_current() method uses this setting to mark the current menu item
  'current_class' => 'current',
  'items' => array(
    array(
      'url' => 'user/login',
      'title' => __('Login'),
    ),
    array(
      'url' => 'user/register',
      'title' => __('Register'),
    ),
  ),
);

