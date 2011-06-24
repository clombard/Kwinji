<?php
// $Id$

$_pluginInfo = array(
  'name' => 'Mail.ru',
  'version' => '1.1.4',
  'description' => "Get the contacts from a Mail.ru account",
  'base_version' => '1.6.3',
  'type' => 'email',
  'check_url' => 'http://www.mail.ru',
  'requirement' => 'email',
  'allowed_domains' => array('/(list.ru)/i', '/(inbox.ru)/i', '/(bk.ru)/i', '/(mail.ru)/i'),
  'imported_details' => array('first_name', 'middle_name', 'last_name', 'nickname', 'email_1', 'email_2', 'email_3', 'organization', 'phone_mobile', 'phone_home', 'phone_work', 'fax', 'pager', 'address_home', 'address_work', 'website', 'address_city', 'address_state', 'address_country', 'postcode_home', 'isq_messenger', 'skype_messenger', 'yahoo_messenger', 'msn_messenger', 'aol_messenger', 'other_messenger'),
);

/**
 * Mail.ru Plugin
 *
 * Import user's contacts from Mail.ru's AddressBook
 *
 * @author OpenInviter
 * @version 1.0.9
 */
class mail_ru extends openinviter_base {
  private $login_ok = FALSE;
  public $showContacts = TRUE;
  public $internalError = FALSE;
  protected $timeout = 30;

  public $debug_array = array(
    'initial_get' => 'login',
    'login_post' => 'lowSupported',
    'file_contacts' => '"',
  );

  /**
   * Login function
   *
   * Makes all the necessary requests to authenticate
   * the current user to the server.
   *
   * @param string $user The current user.
   * @param string $pass The password for the current user.
   *
   * @return bool TRUE if the current user was authenticated successfully, FALSE otherwise.
   */
  public function login($user, $pass) {
    $this->resetDebugger();
    $this->service = 'mail_ru';
    $this->service_user = $user;
    $this->service_password = $pass;
    if (!$this->init()) {
      return FALSE;
    }

    $res = $this->get("http://www.mail.ru/", TRUE);
    if ($this->checkResponse("initial_get", $res)) {
      $this->updateDebugBuffer('initial_get', "http://www.mail.ru/", 'GET');
    }
    else {
      $this->updateDebugBuffer('initial_get', "http://www.mail.ru/", 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $array_user     = explode("@", $user);
    $domain         = strtolower($array_user[1]);
    $hidden_element = $this->getElementDOM($res, "//input[@name='Mpopl']", "value");
    $post_elements  = array('Domain' => $domain, 'Login' => $user, 'Password' => $pass, 'Mpopl' => $hidden_element[0]);
    $res            = $this->post("http://win.mail.ru/cgi-bin/auth", $post_elements, TRUE);
    if ($this->checkResponse("login_post", $res)) {
      $this->updateDebugBuffer('login_post', "http://win.mail.ru/cgi-bin/auth", 'POST', TRUE, $post_elements);
    }
    else {
      $this->updateDebugBuffer('login_post', "http://win.mail.ru/cgi-bin/auth", 'POST', FALSE, $post_elements);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }
    $url_export = "http://win.mail.ru/cgi-bin/abexport/addressbook.csv";
    $this->login_ok = $url_export;
    return TRUE;
  }

  /**
   * Get the current user's contacts
   *
   * Makes all the necesarry requests to import
   * the current user's contacts
   *
   * @return mixed The array if contacts if importing was successful, FALSE otherwise.
   */
  public function getMyContacts() {
    if (!$this->login_ok) {
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }
    else $url = $this->login_ok;
    $post_elements = array("confirm" => "1", "abtype" => "1");
    $res = $this->post($url, $post_elements);
    if ($this->checkResponse("file_contacts", $res)) {
      $temp = $this->parseCSV($res);
      $teM = explode(PHP_EOL, $res);
      $arrayDescriptionFlag = explode(',', $teM[0]);
      $contacts = array();
      foreach ($temp as $values) {
        $contacts[$values[8]] = array('first_name' => (!empty($values[0]) ? $values[0] : FALSE),
          'middle_name' => (!empty($values[2]) ? $values[2] : FALSE),
          'last_name' => (!empty($values[1]) ? $values[1] : FALSE),
          'nickname' => FALSE,
          'email_1' => (!empty($values[8]) ? $values[8] : FALSE),
          'email_2' => (!empty($values[9]) ? $values[9] : FALSE),
          'email_3' => FALSE,
          'organization' => FALSE,
          'phone_mobile' => (!empty($values[11]) ? $values[11] : FALSE),
          'phone_home' => (!empty($values[9]) ? $values[9] : FALSE),
          'pager' => FALSE,
          'address_home' => FALSE,
          'address_city' => (!empty($values[5]) ? $values[5] : FALSE),
          'address_state' => (!empty($values[7]) ? $values[7] : FALSE),
          'address_country' => (!empty($values[8]) ? $values[8] : FALSE),
          'postcode_home' => (!empty($values[6]) ? $values[6] : FALSE),
          'company_work' => (!empty($values[14]) ? $values[14] : FALSE),
          'address_work' => FALSE,
          'address_work_city' => (!empty($values[16]) ? $values[16] : FALSE),
          'address_work_country' => (!empty($values[19]) ? $values[19] : FALSE),
          'address_work_state' => (!empty($values[17]) ? $values[17] : FALSE),
          'address_work_postcode' => (!empty($values[18]) ? $values[18] : FALSE),
          'fax_work' => (!empty($values[21]) ? $values[21] : FALSE),
          'phone_work' => (!empty($values[20]) ? $values[20] : FALSE),
          'website' => (!empty($values[12]) ? $values[12] : FALSE),
          'isq_messenger' => FALSE,
          'skype_essenger' => FALSE,
          'yahoo_essenger' => FALSE,
          'msn_messenger' => FALSE,
          'aol_messenger' => FALSE,
          'other_messenger' => FALSE,
        );
      }
      $this->updateDebugBuffer('file_contacts', "{$url}", 'POST', TRUE, $post_elements);
    }
    else {
      $this->updateDebugBuffer('file_contacts', "{$url}", 'POST', FALSE, $post_elements);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }
    foreach ($contacts as $email => $name) if (!$this->isEmail($email))unset($contacts[$email]);
    return $this->returnContacts($contacts);
  }

  /**
   * Terminate session
   *
   * Terminates the current user's session,
   * debugs the request and reset's the internal
   * debudder.
   *
   * @return bool TRUE if the session was terminated successfully, FALSE otherwise.
   */
  public function logout() {
    if (!$this->checkSession()) {
      return FALSE;
    }
    $res = $this->get("http://win.mail.ru/cgi-bin/logout", TRUE);
    $this->debugRequest();
    $this->resetDebugger();
    $this->stopPlugin();
    return TRUE;
  }
}



