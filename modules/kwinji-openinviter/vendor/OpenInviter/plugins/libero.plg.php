<?php
// $Id$

$_pluginInfo = array(
  'name' => 'Libero',
  'version' => '1.0.6',
  'description' => "Get the contacts from a Libero account",
  'base_version' => '1.8.0',
  'type' => 'email',
  'check_url' => 'http://m.libero.it/mail',
  'requirement' => 'email',
  'allowed_domains' => array('/(libero.it)/i', '/(inwind.it)/i', '/(iol.it)/i', '/(blu.it)/i'),
  'imported_details' => array('email_1'),
);

/**
 * Libero Plugin
 *
 * Imports user's contacts from Libero's AddressBook
 *
 * @author OpenInviter
 * @version 1.0.5
 */
class libero extends openinviter_base {
  private $login_ok = FALSE;
  public $showContacts = TRUE;
  public $internalError = FALSE;
  protected $timeout = 30;
  public $debug_array = array('initial_get' => 'password',
    'post_login' => 'Postaarrivata',
    'get_contacts' => 'NEW',
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
    $this->service = 'libero';
    $this->service_user = $user;
    $this->service_password = $pass;
    if (!$this->init()) {
      return FALSE;
    }

    $res = $this->get("http://m.libero.it/mail", TRUE);
    if ($this->checkResponse('initial_get', $res)) {
      $this->updateDebugBuffer('initial_get', "http://m.libero.it/mail", 'GET');
    }
    else {
      $this->updateDebugBuffer('initial_get', "http://m.libero.it/mail", 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }
    $form_action = "https://login.libero.it/logincheck.php";
    $post_elements = array("SERVICE_ID" => "m_mail",
      "RET_URL" => "http://m.mailbeta.libero.it/m/wmm/auth/check",
      "LAYOUT" => "m",
      "LOGINID" => $user,
      "PASSWORD" => $pass,
      "REMEMBERME" => "S",
      "CAPTCHA_ID" => "",
      "CAPTCHA_INP" => "",
      "login" => "+Accedi+",
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
    $this->login_ok = "http://m.mailbeta.libero.it/m/wmm/contacts";
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

    $contacts = array();
    $res = $this->get($url, TRUE);
    if ($this->checkResponse('get_contacts', $res)) {
      $this->updateDebugBuffer('get_contacts', "{$url}", 'GET');
    }
    else {
      $this->updateDebugBuffer('get_contacts', "{$url}", 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }
    if (preg_match_all("#send\/NEW\/(.+)\"#siU", $res, $matches)) foreach ($matches[1] as $key => $email) {
      $contacts[$email] = array('email_1' => $email);
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
    $res = $this->get("http://m.mailbeta.libero.it/doLogout", TRUE);
    $this->debugRequest();
    $this->resetDebugger();
    $this->stopPlugin();
  }
}


