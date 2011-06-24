<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');

return array(
  // Default cache system
  'file' => array(
    'driver' => 'file',
    'cache_dir' => APPPATH .'cache',
    'default_expire' => 20,
  ),
);

