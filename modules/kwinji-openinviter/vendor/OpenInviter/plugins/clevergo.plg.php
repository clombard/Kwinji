<?php
// $Id$

$_pluginInfo = array(
  'name' => 'Clevergo',
  'version' => '1.0.4',
  'description' => "Get the contacts from a Clevergo account",
  'base_version' => '1.8.0',
  'type' => 'email',
  'check_url' => 'http://www.clevergo.com/index.php',
  'requirement' => 'user',
  'allowed_domains' => FALSE,
  'imported_details' => array('first_name', 'middle_name', 'last_name', 'nickname', 'email_1', 'email_2', 'email_3', 'organization', 'phone_mobile', 'phone_home', 'phone_work', 'fax', 'pager', 'address_home', 'address_work', 'website', 'address_city', 'address_state', 'address_country', 'postcode_home', 'isq_messenger', 'skype_messenger', 'yahoo_messenger', 'msn_messenger', 'aol_messenger', 'other_messenger'),
);

/**
 * Doramail.com Plugin
 *
 * Imports user's contacts from Clevergo.com AddressBook
 *
 * @author OpenInviter
 * @version 1.0.0
 */
class clevergo extends openinviter_base {
  private $login_ok = FALSE;
  public $showContacts = TRUE;
  public $internalError = FALSE;
  protected $timeout = 30;


  public $debug_array = array(
    'initial_get' => 'email_local',
    'login_post' => 'sid',
    'contacts_file' => 'Firstname',
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
    $this->service = 'clevergo';
    $this->service_user = $user;
    $this->service_password = $pass;
    if (!$this->init()) {
      return FALSE;
    }

    $res = $this->get("http://www.clevergo.com/index.php");
    if ($this->checkResponse("initial_get", $res)) {
      $this->updateDebugBuffer('initial_get', "http://www.doramail.com/scripts/common/index.main?signin=1&lang=us", 'GET');
    }
    else {
      $this->updateDebugBuffer('initial_get', "http://www.doramail.com/scripts/common/index.main?signin=1&lang=us", 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $form_action   = "http://www.clevergo.com/index.php?action=login";
    $post_elements = array('do' => 'login', 'email_local' => $user, 'email_domain' => 'clevergo.com', 'passwordMD5' => md5($pass), 'language' => 'english');
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

    $sid = $this->getElementString($res, 'email.php?sid=', '"');
    $this->login_ok = $sid;
    file_put_contents($this->getLogoutPath(), $sid);
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
    else $sid = $this->login_ok;

    $form_action   = "http://www.clevergo.com/organizer.addressbook.php?action=exportAddressbook&sid={$sid}";
    $post_elements = array('lineBreakChar' => 'lf', 'sepChar' => 'comma', 'quoteChar' => 'double');
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

    $temp = $this->parseCSV($res);
    $teM = explode(PHP_EOL, $res);
    $arrayDescriptionFlag = explode(',', $teM[0]);
    $contacts = array();
    foreach ($temp as $values) {
      if (!empty($values[9])) $contacts[$values[9]] = array('first_name' => (!empty($values[0]) ? $values[0] : FALSE),
        'middle_name' => (!empty($values[2]) ? $values[2] : FALSE),
        'last_name' => (!empty($values[1]) ? $values[1] : FALSE),
        'nickname' => FALSE,
        'email_1' => (!empty($values[9]) ? $values[9] : FALSE),
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
    if (file_exists($this->getLogoutPath())) {
      $sid = file_get_contents($this->getLogoutPath());
      $res = $this->get("http://www.clevergo.com/start.php?sid={$sid}&action=logout", TRUE);
    }
    $this->debugRequest();
    $this->resetDebugger();
    $this->stopPlugin();
    return TRUE;
  }
}



