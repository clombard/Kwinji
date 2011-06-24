<?php
// $Id$

$_pluginInfo = array(
  'name' => '5Fm',
  'version' => '1.0.3',
  'description' => "Get the contacts from a 5fm.za.com account",
  'base_version' => '1.6.5',
  'type' => 'email',
  'check_url' => 'http://www.5fm.za.com/',
  'requirement' => 'user',
  'allowed_domains' => FALSE,
  'imported_details' => array('first_name', 'middle_name', 'last_name', 'nickname', 'email_1', 'email_2', 'email_3', 'organization', 'phone_mobile', 'phone_home', 'phone_work', 'fax', 'pager', 'address_home', 'address_work', 'website', 'address_city', 'address_state', 'address_country', 'postcode_home', 'isq_messenger', 'skype_messenger', 'yahoo_messenger', 'msn_messenger', 'aol_messenger', 'other_messenger'),
);

/**
 * 5FM.za.com Plugin
 *
 * Imports user's contacts from 5FM.za.com AddressBook
 *
 * @author OpenInviter
 * @version 1.0.0
 */
class fm5 extends openinviter_base {
  private $login_ok = FALSE;
  public $showContacts = TRUE;
  public $internalError = FALSE;
  protected $timeout = 30;

  public $debug_array = array(
    'initial_get' => 'secretkey',
    'login_post' => 'webmail',
    'url_export' => 'export',
    'contacts_file' => ',',
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
    $this->service = '5fm';
    $this->service_user = $user;
    $this->service_password = $pass;
    if (!$this->init()) {
      return FALSE;
    }

    $res = $this->get("http://www.5fm.za.com/");
    if ($this->checkResponse("initial_get", $res)) {
      $this->updateDebugBuffer('initial_get', "http://www.5fm.za.com/", 'GET');
    }
    else {
      $this->updateDebugBuffer('initial_get', "http://www.5fm.za.com/", 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $form_action = "http://webmail.5fm.za.com/src/redirect.php";
    $post_elements = array('login_domain' => '5fm.za.com',
      'login_username' => $user,
      'secretkey' => $pass,
      'login' => 'login',
    );
    $res = $this->post($form_action, $post_elements, FALSE, TRUE, FALSE, array(), FALSE, FALSE);
    if ($this->checkResponse('login_post', $res)) {
      $this->updateDebugBuffer('login_post', $form_action, 'POST', TRUE, $post_elements);
    }
    else {
      $this->updateDebugBuffer('login_post', $form_action, 'POST', FALSE, $post_elements);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }
    $url_adressbook = 'http://webmail.5fm.za.com/src/addressbook.php';
    $this->login_ok = $url_adressbook;
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
    if ($this->checkResponse("url_export", $res)) {
      $this->updateDebugBuffer('url_export', $url, 'GET');
    }
    else {
      $this->updateDebugBuffer('url_export', $url, 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $form_action = 'http://webmail.5fm.za.com/plugins/abook_import_export/address_book_export.php';
    $res = $this->post($form_action, array());
    if ($this->checkResponse("contacts_file", $res)) {
      $this->updateDebugBuffer('contacts_file', $form_action, 'POST', TRUE, array());
    }
    else {
      $this->updateDebugBuffer('contacts_file', $form_action, 'POST', FALSE, array());
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }
    $temp = $this->parseCSV($res);
    $contacts = array();
    foreach ($temp as $values) {
      if (!empty($values[4])) $contacts[$values[4]] = array('first_name' => (!empty($values[0]) ? $values[0] : FALSE),
        'middle_name' => (!empty($values[2]) ? $values[2] : FALSE),
        'last_name' => (!empty($values[1]) ? $values[1] : FALSE),
        'nickname' => FALSE,
        'email_1' => (!empty($values[4]) ? $values[4] : FALSE),
        'email_2' => FALSE,
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
    $res = $this->get('http://webmail.5fm.za.com/src/signout.php', TRUE);
    $this->debugRequest();
    $this->resetDebugger();
    $this->stopPlugin();
    return TRUE;
  }
}



