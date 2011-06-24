<?php
// $Id$

$_pluginInfo = array(
  'name' => 'Lycos',
  'version' => '1.1.5',
  'description' => "Get the contacts from a Lycos account",
  'base_version' => '1.6.3',
  'type' => 'email',
  'check_url' => 'http://lycos.com',
  'requirement' => 'user',
  'allowed_domains' => FALSE,
  'imported_details' => array('first_name', 'middle_name', 'last_name', 'nickname', 'email_1', 'email_2', 'email_3', 'organization', 'phone_mobile', 'phone_home', 'phone_work', 'fax', 'pager', 'address_home', 'address_work', 'website', 'address_city', 'address_state', 'address_country', 'postcode_home', 'isq_messenger', 'skype_messenger', 'yahoo_messenger', 'msn_messenger', 'aol_messenger', 'other_messenger'),
);

/**
 * Lycos Plugin
 *
 * Import user's contacts from Lycos' AddressBook
 *
 * @author OpenInviter
 * @version 1.0.9
 */
class lycos extends openinviter_base {
  private $login_ok = FALSE;
  public $showContacts = TRUE;
  public $internalError = FALSE;
  protected $timeout = 30;

  public $debug_array = array(
    'initial_get' => 'm_U',
    'login' => 'frame',
    'export_url' => 'csv',
    'file_contacts' => 'First Name',
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
    $this->service = 'lycos';
    $this->service_user = $user;
    $this->service_password = $pass;
    $this->timeout = 30;
    if (!$this->init()) {
      return FALSE;
    }

    $res = $this->get("http://mail.lycos.com/lycos/mail/IntroMail.lycos", TRUE);
    if ($this->checkResponse("initial_get", $res)) {
      $this->updateDebugBuffer('initial_get', "http://lycos.com/", 'GET');
    }
    else {
      $this->updateDebugBuffer('initial_get', "http://lycos.com/", 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }
    $post_elements = $this->getHiddenElements($res);
    $post_elements["m_U"] = $user;
    $post_elements["m_P"] = $pass;
    $post_elements['login'] = 'Sign In';
    $url_login = "https://registration.lycos.com/login.php";
    $res = $this->post($url_login, $post_elements, TRUE);

    if ($this->checkResponse("login", $res)) {

      $this->updateDebugBuffer('login', "http://registration.lycos.com/login.php?", 'GET', TRUE, $post_elements);

    }
    else {
      $this->updateDebugBuffer('login', "http://registration.lycos.com/login.php?", 'GET', FALSE, $post_elements);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }
    $url_export = "http://mail.lycos.com/lycos/addrbook/ExportAddr.lycos?ptype=act&fileType=OUTLOOK";

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
    $post_elements = array('ftype' => 'OUTLOOK');
    $res = $this->post($url, $post_elements);
    if ($this->checkResponse("file_contacts", $res)) {
      $temp = $this->parseCSV($res);
      $contacts = array();
      foreach ($temp as $values) {
        if (!empty($values[4])) $contacts[$values[4]] = array('first_name' => (!empty($values[0]) ? $values[0] : FALSE),
          'middle_name' => (!empty($values[1]) ? $values[1] : FALSE),
          'last_name' => (!empty($values[3]) ? $values[3] : FALSE),
          'nickname' => FALSE,
          'email_1' => (!empty($values[4]) ? $values[4] : FALSE),
          'email_2' => FALSE,
          'email_3' => FALSE,
          'organization' => FALSE,
          'phone_mobile' => (!empty($values[5]) ? $values[5] : FALSE),
          'phone_home' => (!empty($values[8]) ? $values[8] : FALSE),
          'pager' => FALSE,
          'address_home' => FALSE,
          'address_city' => (!empty($values[12]) ? $values[12] : FALSE),
          'address_state' => (!empty($values[13]) ? $values[13] : FALSE),
          'address_country' => (!empty($values[15]) ? $values[15] : FALSE),
          'postcode_home' => (!empty($values[14]) ? $values[14] : FALSE),
          'company_work' => (!empty($values[6]) ? $values[6] : FALSE),
          'address_work' => FALSE,
          'address_work_city' => (!empty($values[19]) ? $values[19] : FALSE),
          'address_work_country' => (!empty($values[22]) ? $values[22] : FALSE),
          'address_work_state' => (!empty($values[20]) ? $values[20] : FALSE),
          'address_work_postcode' => (!empty($values[21]) ? $values[21] : FALSE),
          'fax_work' => FALSE,
          'phone_work' => (!empty($values[7]) ? $values[7] : FALSE),
          'website' => (!empty($values[16]) ? $values[16] : FALSE),
          'isq_messenger' => FALSE,
          'skype_essenger' => FALSE,
          'yahoo_essenger' => FALSE,
          'msn_messenger' => FALSE,
          'aol_messenger' => FALSE,
          'other_messenger' => FALSE,
        );
      }
      $this->updateDebugBuffer('file_contacts', "{$url}", 'GET');
    }
    else {
      $this->updateDebugBuffer('file_contacts', "{$url}", 'GET', FALSE);
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
    $res = $this->get("https://registration.lycos.com/logout.php", TRUE);
    $this->debugRequest();
    $this->resetDebugger();
    $this->stopPlugin();
    return TRUE;
  }
}



