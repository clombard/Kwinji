<?php
// $Id$


defined('SYSPATH') or die('No direct script access.');
function __($string, array$values = NULL, $lang = 'en-us') {
  if ($lang !== M18n::$lang) {
    // The message and target languages are different
    // Get the translation for this message
    $string = M18n::get($string);
  }

  return empty($values) ? $string : strtr($string, $values);
}

