<?php
// $Id$

$_pluginInfo = array(
  'name' => 'Meta',
  'version' => '1.0.4',
  'description' => "Get the contacts from a Meta account",
  'base_version' => '1.6.5',
  'type' => 'email',
  'check_url' => 'http://meta.ua/',
  'requirement' => 'user',
  'allowed_domains' => FALSE,
  'imported_details' => array('first_name', 'middle_name', 'last_name', 'nickname', 'email_1', 'email_2', 'email_3', 'organization', 'phone_mobile', 'phone_home', 'phone_work', 'fax', 'pager', 'address_home', 'address_work', 'website', 'address_city', 'address_state', 'address_country', 'postcode_home', 'isq_messenger', 'skype_messenger', 'yahoo_messenger', 'msn_messenger', 'aol_messenger', 'other_messenger'),
);

/**
 * Meta Plugin
 *
 * Imports user's contacts from Meta AddressBook
 *
 * @author OpenInviter
 * @version 1.0.0
 */
class meta extends openinviter_base {
  private $login_ok = FALSE;
  public $showContacts = TRUE;
  public $internalError = FALSE;
  protected $timeout = 30;

  public $debug_array = array(
    'initial_get' => 'login',
    'login_post' => 'INBOX',
    'file_contacts' => 'Name',
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
    $this->service = 'meta';
    $this->service_user = $user;
    $this->service_password = $pass;
    if (!$this->init()) {
      return FALSE;
    }

    $res = $this->get("http://meta.ua/");
    if ($this->checkResponse("initial_get", $res)) {
      $this->updateDebugBuffer('initial_get', "http://meta.ua/", 'GET');
    }
    else {
      $this->updateDebugBuffer('initial_get', "http://meta.ua/", 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $form_action   = "http://passport.meta.ua/";
    $post_elements = array('login' => $user, 'password' => $pass, 'mode' => 'login', 'from' => 'mail', 'lifetime' => 'alltime', 'subm' => 'Enter');
    $res           = $this->post($form_action, $post_elements, TRUE);
    if ($this->checkResponse('login_post', $res)) {
      $this->updateDebugBuffer('login_post', $form_action, 'POST', TRUE, $post_elements);
    }
    else {
      $this->updateDebugBuffer('login_post', $form_action, 'POST', FALSE, $post_elements);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $this->login_ok = TRUE;
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

    $form_action   = "http://webmail.meta.ua/adress_transfer.php";
    $post_elements = array('mail_client' => 'outlook_en', 'js_enable' => FALSE, 'action' => 'export', 'groups[]' => 'all', 'subm' => TRUE);
    $res           = $this->post($form_action, $post_elements);
    if ($this->checkResponse("file_contacts", $res)) {
      $this->updateDebugBuffer('file_contacts', $form_action, 'POST', TRUE, $post_elements);
    }
    else {
      $this->updateDebugBuffer('file_contacts', $form_action, 'POST', FALSE, $post_elements);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $contacts = array();
    $tempFile = explode(PHP_EOL, $res);
    unset($tempFile[0]);
    foreach ($tempFile as $valuesTemp) {
      $values = explode(';', $valuesTemp);
      if (!empty($values[4])) $contacts[$values[4]] = array('first_name' => (!empty($values[0]) ? $values[0] : FALSE),
        'middle_name' => (!empty($values[2]) ? $values[2] : FALSE),
        'last_name' => (!empty($values[1]) ? $values[1] : FALSE),
        'nickname' => FALSE,
        'email_1' => (!empty($values[4]) ? $values[4] : FALSE),
        'email_2' => (!empty($values[5]) ? $values[5] : FALSE),
        'email_3' => FALSE,
        'organization' => FALSE,
        'phone_mobile' => (!empty($values[13]) ? $values[13] : FALSE),
        'phone_home' => (!empty($values[11]) ? $values[11] : FALSE),
        'pager' => (!empty($values[23]) ? $values[23] : FALSE),
        'address_home' => FALSE,
        'address_city' => (!empty($values[7]) ? $values[7] : FALSE),
        'address_state' => (!empty($values[9]) ? $values[9] : FALSE),
        'address_country' => (!empty($values[10]) ? $values[10] : FALSE),
        'postcode_home' => (!empty($values[8]) ? $values[8] : FALSE),
        'company_work' => (!empty($values[24]) ? $values[24] : FALSE),
        'address_work' => FALSE,
        'address_work_city' => (!empty($values[16]) ? $values[16] : FALSE),
        'address_work_country' => (!empty($values[19]) ? $values[19] : FALSE),
        'address_work_state' => (!empty($values[18]) ? $values[18] : FALSE),
        'address_work_postcode' => (!empty($values[17]) ? $values[17] : FALSE),
        'fax_work' => (!empty($values[21]) ? $values[21] : FALSE),
        'phone_work' => (!empty($values[20]) ? $values[20] : FALSE),
        'website' => (!empty($values[14]) ? $values[14] : FALSE),
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
    $res = $this->get('http://webmail.meta.ua/logout.php', TRUE);
    $this->debugRequest();
    $this->resetDebugger();
    $this->stopPlugin();
    return TRUE;
  }
}



