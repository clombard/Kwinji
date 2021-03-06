<?php
// $Id$

$_pluginInfo = array(
  'name' => 'India',
  'version' => '1.0.4',
  'description' => "Get the contacts from an India account",
  'base_version' => '1.8.4',
  'type' => 'email',
  'check_url' => 'http://mail.india.com/',
  'requirement' => 'email',
  'allowed_domains' => FALSE,
  'imported_details' => array('email_1'),
);

/**
 * India plugin
 *
 * Imports user's contacts from India AddressBook
 *
 * @author OpenInviter
 * @version 1.0.1
 */
class india extends OpenInviter_base {
  private $login_ok = FALSE;
  public $showContacts = TRUE;
  public $internalError = FALSE;
  protected $timeout = 30;

  public $debug_array = array('initial_get' => 'authenticity_token',
    'login_post' => 'mails/new',
    'get_contacts' => 'mail',
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
    $this->service = 'india';
    $this->service_user = $user;
    $this->service_password = $pass;
    if (!$this->init()) {
      return FALSE;
    }

    $res = $this->get("http://mail.india.com/login");
    if ($this->checkResponse("initial_get", $res)) {
      $this->updateDebugBuffer('initial_get', "http://mail.india.com/login", 'GET');
    }
    else {
      $this->updateDebugBuffer('initial_get', "http://mail.india.com/login", 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $form_action = "http://mail.india.com/authenticate";
    $post_elements = array('utf8' => $this->getElementString($res, 'name="utf8" type="hidden" value="', '"'),
      'authenticity_token' => $this->getElementString($res, 'name="authenticity_token" type="hidden" value="', '"'),
      'user[email]' => $user,
      'user[password]' => $pass,
      'Submit' => FALSE,
    );
    $res = $this->post($form_action, $post_elements, TRUE);
    if ($this->checkResponse("login_post", $res)) {
      $this->updateDebugBuffer('login_post', $form_action, 'POST', TRUE, $post_elements);
    }
    else {
      $this->updateDebugBuffer('login_post', $form_action, 'POST', FALSE, $post_elements);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $this->login_ok = "http://mail.india.com/mails/new";
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
    $res = $this->get($url, TRUE);
    if ($this->checkResponse("initial_get", $res)) {
      $this->updateDebugBuffer('get_contacts', "{$url}", 'GET');
    }
    else {
      $this->updateDebugBuffer('get_contacts', "{$url}", 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $contacts = array();
    if (preg_match_all("#class\=\"mail\"\>(.+)\<\/span\>#U", $res, $matches)) if (!empty($matches[1])) foreach ($matches[1] as $d => $email) {
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
    $res = $this->get("http://mail.india.com/logout", TRUE);
    $this->debugRequest();
    $this->resetDebugger();
    $this->stopPlugin();
  }
}


