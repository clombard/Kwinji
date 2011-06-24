<?php
// $Id$

$_pluginInfo = array(
  'name' => 'KataMail',
  'version' => '1.1.0',
  'description' => "Get the contacts from a KataMail account",
  'base_version' => '1.6.3',
  'type' => 'email',
  'check_url' => 'http://webmail.katamail.com',
  'requirement' => 'email',
  'allowed_domains' => array('/(katamail.com)/i'),
  'imported_details' => array('first_name', 'middle_name', 'last_name', 'nickname', 'email_1', 'email_2', 'email_3', 'organization', 'phone_mobile', 'phone_home', 'phone_work', 'fax', 'pager', 'address_home', 'address_work', 'website', 'address_city', 'address_state', 'address_country', 'postcode_home', 'isq_messenger', 'skype_messenger', 'yahoo_messenger', 'msn_messenger', 'aol_messenger', 'other_messenger'),
);

/**
 * KataMail Plugin
 *
 * Imports user's contacts from KataMail's AddressBook
 *
 * @author OpenInviter
 * @version 1.0.5
 */
class katamail extends openinviter_base {
  private $login_ok = FALSE;
  public $showContacts = FALSE;
  private $server, $id = "";
  protected $timeout = 30;
  public $debug_array = array(
    'main_redirect' => 'location.href',
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
    $this->service = 'katamail';
    $this->service_user = $user;
    $this->service_password = $pass;
    if (!$this->init()) {
      return FALSE;
    }
    $postvars = array(
      "Language" => "italiano",
      "pop3host" => "katamail.com",
      "username" => $user,
      "LoginType" => "xp",
      "language" => "italiano",
      "MailType" => "imap",
      "email" => $user ."@katamail.com",
      "password" => $pass,
    );
    $res = $this->get("http://webmail.katamail.com", TRUE);
    $res = $this->post("http://webmail.katamail.com/atmail.php", $postvars, TRUE);
    $res = htmlentities($res);
    if ($this->checkResponse("main_redirect", $res)) {
      $this->updateDebugBuffer('main_redirect', "http://webmail.katamail.com/atmail.php", 'POST');
    }
    else {
      $this->updateDebugBuffer('main_redirect', "http://webmail.katamail.com/atmail.php", 'POST', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }
    $this->login_ok = "http://webmail.katamail.com/abook.php?func=export&abookview=personal";
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
    else {
      $contacts = array();
      $res      = $this->get($this->login_ok);
      $temp     = $this->parseCSV($res);
      foreach ($temp as $values) {
        if (!empty($values[1])) $contacts[$values[1]] = array('first_name' => (!empty($values[6]) ? $values[6] : FALSE),
          'middle_name' => (!empty($values[18]) ? $values[18] : FALSE),
          'last_name' => (!empty($values[17]) ? $values[17] : FALSE),
          'nickname' => FALSE,
          'email_1' => (!empty($values[1]) ? $values[1] : FALSE),
          'email_2' => (!empty($values[2]) ? $values[2] : FALSE),
          'email_3' => (!empty($values[3]) ? $values[3] : FALSE),
          'organization' => FALSE,
          'phone_mobile' => (!empty($values[12]) ? $values[12] : FALSE),
          'phone_home' => (!empty($values[13]) ? $values[13] : FALSE),
          'pager' => FALSE,
          'address_home' => FALSE,
          'address_city' => (!empty($values[9]) ? $values[9] : FALSE),
          'address_state' => (!empty($values[14]) ? $values[14] : FALSE),
          'address_country' => (!empty($values[10]) ? $values[10] : FALSE),
          'postcode_home' => FALSE,
          'company_work' => (!empty($values[24]) ? $values[24] : FALSE),
          'address_work' => (!empty($values[22]) ? $values[22] : FALSE),
          'address_work_city' => (!empty($values[23]) ? $values[23] : FALSE),
          'address_work_country' => (!empty($values[25]) ? $values[25] : FALSE),
          'address_work_state' => (!empty($values[31]) ? $values[31] : FALSE),
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
    }
    $this->showContacts = TRUE;
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
    $res = $this->get("http://webmail.katamail.com/index.php?func=logout");
    $this->debugRequest();
    $this->resetDebugger();
    $this->stopPlugin();
    return TRUE;
  }
}


