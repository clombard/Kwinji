<?php
// $Id$

$_pluginInfo = array(
  'name' => 'O2',
  'version' => '1.0.2',
  'description' => "Get the contacts from a O2 account",
  'base_version' => '1.6.9',
  'type' => 'email',
  'check_url' => 'http://poczta.o2.pl/',
  'requirement' => 'user',
  'allowed_domains' => FALSE,
  'imported_details' => array('first_name', 'middle_name', 'last_name', 'nickname', 'email_1', 'email_2', 'email_3', 'organization', 'phone_mobile', 'phone_home', 'phone_work', 'fax', 'pager', 'address_home', 'address_work', 'website', 'address_city', 'address_state', 'address_country', 'postcode_home', 'isq_messenger', 'skype_messenger', 'yahoo_messenger', 'msn_messenger', 'aol_messenger', 'other_messenger'),
);

/**
 * O2 Plugin
 *
 * Imports user's contacts from O2's AddressBook
 *
 * @author OpenInviter
 * @version 1.0.0
 */
class o2 extends openinviter_base {
  private $login_ok = FALSE;
  public $showContacts = TRUE;
  public $internalError = FALSE;
  protected $timeout = 30;

  public $debug_array = array(
    'initial_get' => 'login',
    'post_login' => 'ssid',
    'url_webinterface' => 'kbshortcut',
    'url_get_webinterface' => 'kbshortcut',
    'contacts_page' => 'MSignal_UA-Download*',
    'contacts_file' => 'Title',
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
    $this->service = 'o2';
    $this->service_user = $user;
    $this->service_password = $pass;
    if (!$this->init()) {
      return FALSE;
    }

    $res = $this->get("http://poczta.o2.pl/");
    if ($this->checkResponse('initial_get', $res)) {
      $this->updateDebugBuffer('initial_get', "http://www.fastmail.fm/", 'GET');
    }
    else {
      $this->updateDebugBuffer('initial_get', "http://www.fastmail.fm/", 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $form_action   = "https://poczta.o2.pl/login.html";
    $post_elements = array('username' => $user, 'password' => $pass, 'ssl' => 'login', 'x' => rand(1, 100), 'y' => rand(1, 100));
    $res           = $this->post($form_action, $post_elements, FALSE, TRUE, FALSE, array(), FALSE, FALSE);
    if ($this->checkResponse('post_login', $res)) {
      $this->updateDebugBuffer('post_login', "{$form_action}", 'POST', TRUE, $post_elements);
    }
    else {
      $this->updateDebugBuffer('post_login', "{$form_action}", 'POST', FALSE, $post_elements);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }
    $sesid          = $this->getElementString($res, 'ssid=', ";");
    $url_export     = "http://poczta.o2.pl/a?cmd=export_addressbook&requestid=2&xsfr-cookie={$sesid}&fmt=xml&upid=&";
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
    $res      = $this->post($url, array('outputformat' => 'outlook'));
    $temp     = $this->parseCSV($res);
    $contacts = array();
    foreach ($temp as $values) {
      if (!empty($values[11])) $descriptionArray[$values[11]] = array('first_name' => (!empty($values[0]) ? $values[0] : FALSE),
        'middle_name' => (!empty($values[1]) ? $values[1] : FALSE),
        'last_name' => (!empty($values[3]) ? $values[3] : FALSE),
        'nickname' => (!empty($values[6]) ? $values[6] : FALSE),
        'email_1' => (!empty($values[11]) ? $values[11] : FALSE),
        'email_2' => (!empty($values[4]) ? $values[4] : FALSE),
        'email_3' => FALSE,
        'organization' => FALSE,
        'phone_mobile' => (!empty($values[6]) ? $values[6] : FALSE),
        'phone_home' => (!empty($values[8]) ? $values[8] : FALSE),
        'pager' => (!empty($values[12]) ? $values[12] : FALSE),
        'address_home' => FALSE,
        'address_city' => FALSE,
        'address_state' => FALSE,
        'address_country' => FALSE,
        'postcode_home' => FALSE,
        'company_work' => FALSE,
        'address_work' => FALSE,
        'address_work_city' => FALSE,
        'address_work_country' => FALSE,
        'address_work_state' => FALSE,
        'address_work_postcode' => FALSE,
        'fax_work' => FALSE,
        'phone_work' => (!empty($values[13]) ? $values[13] : FALSE),
        'website' => (!empty($values[9]) ? $values[9] : FALSE),
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
      $url = file_get_contents($this->getLogoutPath());
      //go to url adress book  url in order to make the logout
      $res = $this->get($url, TRUE);
      $form_action = $this->getElementString($res, 'action="', '"');
      $post_elements = $this->getHiddenElements($res);
      $post_elements['MSignal_AD-LGO*C-1.N-1'] = 'Logout';

      //get the post elements and make de logout
      $res = $this->post($form_action, $post_elements, TRUE);
    }
    $this->debugRequest();
    $this->resetDebugger();
    $this->stopPlugin();
    return TRUE;
  }
}


