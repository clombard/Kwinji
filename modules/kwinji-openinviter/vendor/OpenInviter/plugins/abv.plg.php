<?php
// $Id$

$_pluginInfo = array(
  'name' => 'Abv',
  'version' => '1.0.6',
  'description' => "Get the contacts from a Abv account",
  'base_version' => '1.8.3',
  'type' => 'email',
  'check_url' => 'http://www.abv.bg/',
  'requirement' => 'email',
  'allowed_domains' => array('/(abv.bg)/i', '/(gyuvetch.bg)/i', '/(gbg.bg)/i'),
  'imported_details' => array('first_name', 'middle_name', 'last_name', 'nickname', 'email_1', 'email_2', 'email_3', 'organization', 'phone_mobile', 'phone_home', 'phone_work', 'fax', 'pager', 'address_home', 'address_work', 'website', 'address_city', 'address_state', 'address_country', 'postcode_home', 'isq_messenger', 'skype_messenger', 'yahoo_messenger', 'msn_messenger', 'aol_messenger', 'other_messenger'),
);

/**
 * Abv Plugin
 *
 * Imports user's contacts from Abv AddressBook
 *
 * @author OpenInviter
 * @version 1.0.0
 */
class abv extends openinviter_base {
  private $login_ok = FALSE;
  public $showContacts = TRUE;
  public $internalError = FALSE;
  protected $timeout = 30;

  public $debug_array = array(
    'initial_get' => 'host',
    'login_post' => 'plogin',
    'url_redirect' => 'Location',
    'url_inbox' => 'addrexport',
    'url_export' => 'EXPORT',
    'contacts_file' => 'Name',
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
    $this->service = 'abv';
    $this->service_user = $user;
    $this->service_password = $pass;
    if (!$this->init()) {
      return FALSE;
    }

    $res = $this->get("http://www.abv.bg/");
    if ($this->checkResponse("initial_get", $res)) {
      $this->updateDebugBuffer('initial_get', "http://www.abv.bg/", 'GET');
    }
    else {
      $this->updateDebugBuffer('initial_get', "http://www.abv.bg/", 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $user_array    = explode('@', $user);
    $hostname      = $user_array[1];
    $username      = $user_array[0];
    $host          = $this->getELementDOM($res, "//input[@name='host']", 'value');
    $form_action   = "https://passport.abv.bg/servlet/passportlogin";
    $post_elements = array('host' => $host[0], 'username' => $username, 'hostname' => $hostname, 'password' => $pass);
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

    $url_redirect = $this->getElementString($res, 'url=', '"');
    $res = $this->get($url_redirect, FALSE, TRUE, FALSE, array(), FALSE, FALSE);
    if ($this->checkResponse("url_redirect", $res)) {
      $this->updateDebugBuffer('url_redirect', $url_redirect, 'GET');
    }
    else {
      $this->updateDebugBuffer('url_redirect', $url_redirect, 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $url_redirect = str_replace(' [following]', '', $this->getElementString($res, 'Location: ', PHP_EOL));
    $url_base     = 'http://'. $this->getElementString($url_redirect, 'http://', '.bg') .'.bg';
    $res          = $this->get($url_redirect, TRUE);
    if ($this->checkResponse("url_inbox", $res)) {
      $this->updateDebugBuffer('url_inbox', $url_redirect, 'GET');
    }
    else {
      $this->updateDebugBuffer('url_inbox', $url_redirect, 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }
    $this->login_ok = $url_base;
    file_put_contents($this->getLogoutPath(), $url_base);
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
    $url_adress = $url .'/app/j/addrexport.jsp';
    $res = $this->get($url_adress);
    if ($this->checkResponse("url_export", $res)) {
      $this->updateDebugBuffer('url_export', $url_adress, 'GET');
    }
    else {
      $this->updateDebugBuffer('url_export', $url_adress, 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $form_action   = $url .'/app/servlet/addrimpex';
    $post_elements = array('action' => 'EXPORT', 'group_id' => 0, 'program' => 10);
    $res           = $this->post($form_action, $post_elements);
    if ($this->checkResponse("contacts_file", $res)) {
      $this->updateDebugBuffer('contacts_file', $form_action, 'POST', TRUE, $post_elements);
    }
    else {
      $this->updateDebugBuffer('contacts_file', $form_action, 'POST', FALSE, $post_elements);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }
    $temp             = $this->parseCSV($res);
    $contacts         = array();
    $descriptionArray = array();
    foreach ($temp as $values) {
      $contacts[$values[4]] = array('first_name' => (!empty($values[0]) ? $values[0] : FALSE),
        'middle_name' => (!empty($values[1]) ? $values[1] : FALSE),
        'last_name' => (!empty($values[2]) ? $values[2] : FALSE),
        'nickname' => (!empty($values[3]) ? $values[3] : FALSE),
        'email_1' => (!empty($values[4]) ? $values[4] : FALSE),
        'email_2' => (!empty($values[5]) ? $values[5] : FALSE),
        'email_3' => FALSE,
        'organization' => (!empty($values[8]) ? $values[8] : FALSE),
        'phone_mobile' => (!empty($values[12]) ? $values[12] : FALSE),
        'phone_home' => (!empty($values[10]) ? $values[10] : FALSE),
        'phone_work' => (!empty($values[11]) ? $values[11] : FALSE),
        'fax' => (!empty($values[13]) ? $values[13] : FALSE),
        'pager' => FALSE,
        'address_home' => (!empty($values[15]) ? $values[15] : FALSE),
        'address_work' => (!empty($values[20]) ? $values[20] : FALSE),
        'website' => FALSE,
        'address_city' => (!empty($values[16]) ? $values[16] : FALSE),
        'address_state' => FALSE,
        'address_country' => (!empty($values[17]) ? $values[17] : FALSE),
        'postcode_home' => (!empty($values[18]) ? $values[18] : FALSE),
        'isq_messenger' => (!empty($values[25]) ? $values[25] : FALSE),
        'skype_messenger' => (!empty($values[26]) ? $values[26] : FALSE),
        'yahoo_messenger' => (!empty($values[27]) ? $values[27] : FALSE),
        'msn_messenger' => (!empty($values[28]) ? $values[28] : FALSE),
        'aol_messenger' => (!empty($values[29]) ? $values[29] : FALSE),
        'other_messenger' => (!empty($values[30]) ? $values[30] : FALSE),
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
    if (file_exists($this->getLogoutPath())) {
      $url_base = file_get_contents($this->getLogoutPath());
      $res = $this->get($url_base .'/app/j/logout.jsp', TRUE);
    }
    $this->debugRequest();
    $this->resetDebugger();
    $this->stopPlugin();
    return TRUE;
  }
}



