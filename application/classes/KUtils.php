<?php
// $Id$


defined('SYSPATH') or die('No direct script access.');
class KUtils {

  // Generate a random heaxadecimal string
  public static function randomString($length = 32, $pattern = 'abcdef0123456789') {
    $random_string = NULL;
    mt_srand((double)microtime() * 1000000);
    while (strlen($random_string) < $length + 1) {
      $random_string .= substr($pattern, mt_rand(0, strlen($pattern) - 1), 1);
    }
    return $random_string;
  }

  public static function encryptString($string) {
    return $string;
  }

  public static function decryptString($string) {
    return $string;
  }

  public static function formatBirthdate($birthdate) {
    $year  = substr($birthdate, 0, 4);
    $month = substr($birthdate, 4, 2);
    $day   = substr($birthdate, 6, 2);
    $date  = mktime(0, 0, 0, $month, $day, $year);
    return date('d/m/Y', $date);
  }


  public static function array2object(array$array) {
    $object = new stdClass();
    foreach ($array as $key => $value) {
      if (is_array($value)) {
        $object->$key = self::array2object($value);
      }
      else {
        $object->$key = $value;
      }
    }
    return $object;
  }
}

