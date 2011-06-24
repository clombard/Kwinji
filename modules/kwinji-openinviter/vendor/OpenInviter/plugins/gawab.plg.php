<?php
// $Id$

$_pluginInfo = array(
  'name' => 'Gawab',
  'version' => '1.0.5',
  'description' => "Get the contacts from a Gawab account",
  'base_version' => '1.8.0',
  'type' => 'email',
  'check_url' => 'http://www.gawab.com/default.php',
  'requirement' => 'email',
  'allowed_domains' => array('/(gawab.com)/i'),
  'imported_details' => array('first_name', 'middle_name', 'last_name', 'nickname', 'email_1', 'email_2', 'email_3', 'organization', 'phone_mobile', 'phone_home', 'phone_work', 'fax', 'pager', 'address_home', 'address_work', 'website', 'address_city', 'address_state', 'address_country', 'postcode_home', 'isq_messenger', 'skype_messenger', 'yahoo_messenger', 'msn_messenger', 'aol_messenger', 'other_messenger'),
);

/**
 * Gawab Plugin
 *
 * Imports user's contacts from Gawab's AddressBook
 *
 * @author OpenInviter
 * @version 1.0.0
 */
class gawab extends openinviter_base {
  private $login_ok = FALSE;
  public $showContacts = TRUE;
  public $internalError = FALSE;
  protected $timeout = 30;

  public $debug_array = array(
    'initial_get' => 'service',
    'post_login' => '&_host',
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
    $this->service = 'gawab';
    $this->service_user = $user;
    $this->service_password = $pass;
    if (!$this->init()) {
      return FALSE;
    }

    $res = $this->get("http://www.gawab.com/default.php", TRUE);
    if ($this->checkResponse('initial_get', $res)) {
      $this->updateDebugBuffer('initial_get', "http://www.gawab.com/default.php", 'GET');
    }
    else {
      $this->updateDebugBuffer('initial_get', "http://www.gawab.com/default.php", 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }
    $login_array   = explode("@", $user);
    $form_action   = "http://mail.gawab.com/login";
    $post_elements = array('service' => 'webmail',
      'username' => $login_array[0],
      'domain' => $login_array[1],
      'password' => $pass,
    );
    $res = $this->post($form_action, $post_elements, TRUE);
    if ($this->checkResponse('post_login', $res)) {
      $this->updateDebugBuffer('post_login', "{$form_action}", 'POST', TRUE, $post_elements);
    }
    else {
      $this->updateDebugBuffer('post_login', "{$form_action}", 'POST', FALSE, $post_elements);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }
    $host              = $this->getElementString($res, '&_host=', "'");
    $url_file_contacts = "http://mail.gawab.com/{$host}/gwebmail?_module=contact&_action=export&format=outlook&_address=dbautu@gawab.com";
    $this->login_ok    = $url_file_contacts;
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
    if ($this->checkResponse('file_contacts', $res)) {
      $this->updateDebugBuffer('file_contacts', $url, 'GET');
    }
    else {
      $this->updateDebugBuffer('file_contacts', $url, 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $temp = $this->parseCSV($res);
    $contacts = array();
    foreach ($temp as $values) {
      if (!empty($values[1])) $contacts[$values[1]] = array('first_name' => (!empty($values[0]) ? $values[0] : FALSE),
        'middle_name' => FALSE,
        'last_name' => FALSE,
        'nickname' => FALSE,
        'email_1' => (!empty($values[1]) ? $values[1] : FALSE),
        'email_2' => (!empty($values[2]) ? $values[2] : FALSE),
        'email_3' => (!empty($values[3]) ? $values[3] : FALSE),
        'organization' => FALSE,
        'phone_mobile' => (!empty($values[5]) ? $values[5] : FALSE),
        'phone_home' => (!empty($values[9]) ? $values[9] : FALSE),
        'pager' => (!empty($values[6]) ? $values[6] : FALSE),
        'address_home' => (!empty($values[12]) ? $values[12] : FALSE),
        'address_city' => FALSE,
        'address_state' => FALSE,
        'address_country' => FALSE,
        'postcode_home' => FALSE,
        'company_work' => (!empty($values[7]) ? $values[7] : FALSE),
        'address_work' => (!empty($values[16]) ? $values[16] : FALSE),
        'address_work_city' => FALSE,
        'address_work_country' => FALSE,
        'address_work_state' => FALSE,
        'address_work_postcode' => FALSE,
        'fax_work' => (!empty($values[15]) ? $values[15] : FALSE),
        'phone_work' => (!empty($values[13]) ? $values[13] : FALSE),
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
    $res = $this->get("http://www.gawab.com/", TRUE);
    $this->debugRequest();
    $this->resetDebugger();
    $this->stopPlugin();
    return TRUE;
  }
}


