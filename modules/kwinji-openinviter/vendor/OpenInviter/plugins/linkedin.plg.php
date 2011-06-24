<?php
// $Id$

$_pluginInfo = array(
  'name' => 'LinkedIn',
  'version' => '1.1.4',
  'description' => "Get the contacts from a LinkedIn account",
  'base_version' => '1.8.0',
  'type' => 'email',
  'check_url' => 'http://m.linkedin.com/session/new',
  'requirement' => 'email',
  'allowed_domains' => FALSE,
);

/**
 * LinkedIn
 *
 * Imports user's email contacts from LinkedIn
 *
 * @author OpenInviter
 * @version 1.1.1
 */
class linkedin extends openinviter_base {
  private $login_ok = FALSE;
  public $showContacts = TRUE;
  public $internalError = FALSE;
  protected $timeout = 30;

  public $debug_array = array(
    'initial_get' => 'login',
    'login_post' => 'contacts',
    'get_friends' => 'mailto',
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
    $this->service = 'linkedin';
    $this->service_user = $user;
    $this->service_password = $pass;
    if (!$this->init()) {
      return FALSE;
    }

    $res = $this->get("http://m.linkedin.com/session/new");
    if ($this->checkResponse("initial_get", $res)) {
      $this->updateDebugBuffer('initial_get', "http://m.linkedin.com/session/new", 'GET');
    }
    else {
      $this->updateDebugBuffer('initial_get', "http://m.linkedin.com/session/new", 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }
    $form_action = "https://m.linkedin.com/session";
    $post_elements = array('login' => $user,
      'authenticity_token' => $this->getElementString($res, 'name="authenticity_token" type="hidden" value="', '"'),
      'password' => $pass,
    );
    $res = $this->post($form_action, $post_elements, TRUE);
    if ($this->checkResponse("login_post", $res)) {
      $this->updateDebugBuffer('login_post', "{$form_action}", 'POST', TRUE, $post_elements);
    }
    else {
      $this->updateDebugBuffer('login_post', "{$form_action}", 'POST', FALSE, $post_elements);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }
    $this->login_ok = "https://m.linkedin.com/contacts";
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
    if ($this->checkResponse("get_friends", $res)) {
      $this->updateDebugBuffer('get_friends', "{$url}", 'GET');
    }
    else {
      $this->updateDebugBuffer('get_friends', "{$url}", 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $res = str_replace(PHP_EOL, "", $res);
    preg_match_all("#mailto\:(.+)\"#U", $res, $emails);
    preg_match_all("#252Fcontacts\"\>(.+)\<\/#U", $res, $names);
    $contacts = array();
    if (!empty($emails[1])) foreach ($emails[1] as $key => $email) if (!empty($names[1][$key])) {
      $contacts[$email] = $names[1][$key];
    }
    foreach ($contacts as $email => $name) if (!$this->isEmail($email))unset($contacts[$email]);
    return $contacts;
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
    $res = $this->get("http://m.linkedin.com/session/logout", TRUE);
    $this->debugRequest();
    $this->resetDebugger();
    $this->stopPlugin();
    return TRUE;
  }
}



