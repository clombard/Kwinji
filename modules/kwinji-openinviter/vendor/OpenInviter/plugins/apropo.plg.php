<?php
// $Id$

$_pluginInfo = array(
  'name' => 'Apropo',
  'version' => '1.0.4',
  'description' => "Get the contacts from a Apropo account",
  'base_version' => '1.6.5',
  'type' => 'email',
  'check_url' => 'http://amail.apropo.ro/index.php',
  'requirement' => 'user',
  'allowed_domains' => FALSE,
  'imported_details' => array('first_name', 'middle_name', 'last_name', 'nickname', 'email_1', 'email_2', 'email_3', 'organization', 'phone_mobile', 'phone_home', 'phone_work', 'fax', 'pager', 'address_home', 'address_work', 'website', 'address_city', 'address_state', 'address_country', 'postcode_home', 'isq_messenger', 'skype_messenger', 'yahoo_messenger', 'msn_messenger', 'aol_messenger', 'other_messenger'),
);

/**
 * Apropo.com Plugin
 *
 * Imports user's contacts from Apropo.ro AddressBook
 *
 * @author OpenInviter
 * @version 1.0.0
 */
class apropo extends openinviter_base {
  private $login_ok = FALSE;
  public $showContacts = TRUE;
  public $internalError = FALSE;
  protected $timeout = 30;

  public $debug_array = array(
    'initial_get' => 'pop3host',
    'login_post' => 'Location',
    'url_inbox' => 'parse',
    'contacts_file' => 'Email',
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
    $this->service = 'apropo';
    $this->service_user = $user;
    $this->service_password = $pass;
    if (!$this->init()) {
      return FALSE;
    }

    $res = $this->get("http://amail.apropo.ro/index.php");
    if ($this->checkResponse("initial_get", $res)) {
      $this->updateDebugBuffer('initial_get', "http://amail.apropo.ro/index.php", 'GET');
    }
    else {
      $this->updateDebugBuffer('initial_get', 'http://amail.apropo.ro/index.php', 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $form_action   = 'http://login.apropo.ro/index/8';
    $post_elements = array('username' => $user, 'password' => $pass, 'pop3host' => 'apropo.ro', 'Language' => 'romanian', 'LoginType' => 'simple', 'btnContinue' => ' ');
    $res           = $this->post($form_action, $post_elements, FALSE, TRUE, FALSE, array(), FALSE, FALSE);
    if ($this->checkResponse('login_post', $res)) {
      $this->updateDebugBuffer('login_post', $form_action, 'POST', TRUE, $post_elements);
    }
    else {
      $this->updateDebugBuffer('login_post', $form_action, 'POST', FALSE, $post_elements);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $url_redirect = str_replace(' [following]', '', $this->getElementString($res, 'Location: ', PHP_EOL));
    $res = $this->get($url_redirect, FALSE, TRUE);
    if ($this->checkResponse("url_inbox", $res)) {
      $this->updateDebugBuffer('url_inbox', $url_redirect, 'GET');
    }
    else {
      $this->updateDebugBuffer('url_inbox', $url_redirect, 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $url_export = 'http://amail.apropo.ro/abook.php?func=export&abookview=personal';
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
    $res = $this->get($url);
    if ($this->checkResponse("contacts_file", $res)) {
      $this->updateDebugBuffer('contacts_file', $url, 'GET');
    }
    else {
      $this->updateDebugBuffer('contacts_file', $url, 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $temp             = $this->parseCSV($res);
    $contacts         = array();
    $descriptionArray = array();
    foreach ($temp as $values) {
      if (!empty($values[1])) $contacts[$values[1]] = array('first_name' => (!empty($values[6]) ? $values[6] : FALSE),
        'middle_name' => (!empty($values[18]) ? $values[18] : FALSE),
        'last_name' => (!empty($values[17]) ? $values[17] : FALSE),
        'nickname' => (!empty($values[3]) ? $values[3] : FALSE),
        'email_1' => (!empty($values[1]) ? $values[1] : FALSE),
        'email_2' => (!empty($values[2]) ? $values[2] : FALSE),
        'email_3' => (!empty($values[3]) ? $values[3] : FALSE),
        'organization' => FALSE,
        'phone_mobile' => (!empty($values[12]) ? $values[12] : FALSE),
        'phone_home' => (!empty($values[10]) ? $values[10] : FALSE),
        'pager' => FALSE,
        'address_home' => (!empty($values[8]) ? $values[8] : FALSE),
        'address_city' => (!empty($values[9]) ? $values[9] : FALSE),
        'address_state' => FALSE,
        'address_country' => (!empty($values[10]) ? $values[10] : FALSE),
        'postcode_home' => (!empty($values[15]) ? $values[15] : FALSE),
        'company_work' => (!empty($values[24]) ? $values[24] : FALSE),
        'address_work' => (!empty($values[22]) ? $values[22] : FALSE),
        'address_work_city' => (!empty($values[23]) ? $values[23] : FALSE),
        'address_work_country' => (!empty($values[25]) ? $values[25] : FALSE),
        'address_work_state' => (!empty($values[25]) ? $values[25] : FALSE),
        'address_work_postcode' => (!empty($values[33]) ? $values[33] : FALSE),
        'fax_work' => (!empty($values[27]) ? $values[27] : FALSE),
        'phone_work' => (!empty($values[30]) ? $values[30] : FALSE),
        'website' => (!empty($values[21]) ? $values[21] : FALSE),
        'isq_messenger' => FALSE,
        'skype_essenger' => FALSE,
        'yahoo_essenger' => FALSE,
        'msn_messenger' => FALSE,
        'aol_messenger' => FALSE,
        'other_messenger' => FALSE,
      );
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
    $res = $this->get('http://login.apropo.ro/logout/8/?TB_iframe=TRUE&width=400&height=400', TRUE);
    $this->debugRequest();
    $this->resetDebugger();
    $this->stopPlugin();
    return TRUE;
  }
}



