<?php
// $Id$

$_pluginInfo = array(
  'name' => 'Mail.com',
  'version' => '1.1.5',
  'description' => "Get the contacts from a Mail.com account",
  'base_version' => '1.8.4',
  'type' => 'email',
  'check_url' => 'http://www.mail.com/int/',
  'requirement' => 'email',
  'allowed_domains' => FALSE,
  'imported_details' => array('first_name', 'middle_name', 'last_name', 'email_1', 'email_2', 'phone_home', 'phone_mobile', 'phone_work'),
);

/**
 * Mail.com
 *
 * Import user's contacts from Mail.com's AddressBook.
 *
 * @author OpenInviter
 * @version 1.0.9
 */
class mail_com extends openinviter_base {
  private $login_ok = FALSE;
  public $showContacts = TRUE;
  public $internalError = FALSE;
  protected $timeout = 30;

  public $debug_array = array(
    'initial_get' => 'service.mail',
    'login_post' => 'snsInFrameRedir',
    'redirect1' => 'gSuccessURL',
    'redirect2' => 'LoadHandler',
    'file_contacts' => 'FirstName',
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
    $this->service = 'mail_com';
    $this->service_user = $user;
    $this->service_password = $pass;
    if (!$this->init()) {
      return FALSE;
    }

    $res = $this->get("http://www.mail.com/int/", TRUE);
    if ($this->checkResponse('initial_get', $res)) {
      $this->updateDebugBuffer('initial_get', "http://www.mail.com/int/", 'GET');
    }
    else {
      $this->updateDebugBuffer('initial_get', "http://www.mail.com/int/", 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }
    $form_action   = 'http://service.mail.com/login.html#.'. $this->getElementString($res, 'http://service.mail.com/login.html#.', '-bluestripe-login-undef') .'-bluestripe-login-undef';
    $post_elements = array("rdirurl" => "http://www.mail.com/int/", "login" => "{$user}", "password" => "{$pass}", "x" => 211, "y" => 150);
    $res           = $this->post($form_action, $post_elements, TRUE);
    if ($this->checkResponse('login_post', $res)) {
      $this->updateDebugBuffer('login_post', "{$form_action}", 'POST', TRUE, $post_elements);
    }
    else {
      $this->updateDebugBuffer('login_post', "{$form_action}", 'POST', FALSE, $post_elements);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $redirect_url = $this->getElementString($res, 'snsInFrameRedir("', '"');
    $res = $this->get($redirect_url, TRUE);
    if ($this->checkResponse('redirect1', $res)) {
      $this->updateDebugBuffer('redirect1', "{$redirect_url}", 'GET');
    }
    else {
      $this->updateDebugBuffer('redirect1', "{$redirect_url}", 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $redirect_url = "http://web.mail.com". $this->getElementString($res, 'var gSuccessURL = "', '"');
    $baseUrl      = $this->getElementString($redirect_url, "http://web.mail.com/", "/Suite.aspx");
    $res          = $this->get($redirect_url, TRUE);
    if ($this->checkResponse('redirect2', $res)) {
      $this->updateDebugBuffer('redirect2', "{$redirect_url}", 'GET');
    }
    else {
      $this->updateDebugBuffer('redirect2', "{$redirect_url}", 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $this->login_ok = "http://web.mail.com/{$baseUrl}/AB/ABExport.aspx?command=all&format=csv&user={$user}";
    file_put_contents($this->getLogoutPath(), $baseUrl);
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
      $this->updateDebugBuffer('file_contacts', "{$url}", 'GET');
    }
    else {
      $this->updateDebugBuffer('file_contacts', "{$url}", 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $contacts = array();
    $temp     = $this->parseCSV($res);
    $contacts = array();
    if (!empty($temp)) foreach ($temp as $values) {
      if (!empty($values[4])) $contacts[$values[4]] = array('first_name' => (!empty($values[0]) ? $values[0] : FALSE),
        'middle_name' => (!empty($values[1]) ? $values[1] : FALSE),
        'last_name' => (!empty($values[3]) ? $values[3] : FALSE),
        'nickname' => FALSE,
        'email_1' => (!empty($values[4]) ? $values[4] : FALSE),
        'email_2' => (!empty($values[5]) ? $values[5] : FALSE),
        'email_3' => FALSE,
        'organization' => FALSE,
        'phone_mobile' => (!empty($values[6]) ? $values[6] : FALSE),
        'phone_home' => (!empty($values[8]) ? $values[8] : FALSE),
        'pager' => FALSE,
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
        'phone_work' => (!empty($values[10]) ? $values[10] : FALSE),
        'website' => FALSE,
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
      $urlLogout = "http://web.mail.com/". file_get_contents($this->getLogoutPath()) ."/common/Logout.aspx";
      $res = $this->get($urlLogout, TRUE);
    }
    $this->debugRequest();
    $this->resetDebugger();
    $this->stopPlugin();
    return TRUE;
  }
}



