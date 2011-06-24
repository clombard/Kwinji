<?php



defined('SYSPATH') or die('No direct script access.');
class KAuthenticate {

  public static function checkGrants($mail, $password) {
    $user = Mongo_Document::factory('user');
    $criteria = array(
      'identities.mail' => $mail,
      'password' => md5($password),
    );
    $user->load($criteria);

    global $logged_user;
    if ($user->loaded()) {
      $temp = $user->as_array();
      $logged_user = KUtils::array2object($temp);
      $_SESSION['logged_user'] = $logged_user;
      return TRUE;
    }
    else {
      return FALSE;
    }
  }
}

