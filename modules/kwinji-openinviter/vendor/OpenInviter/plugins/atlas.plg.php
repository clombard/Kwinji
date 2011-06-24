<?php
// $Id$

$_pluginInfo = array(
  'name' => 'Atlas',
  'version' => '1.0.4 ',
  'description' => "Get the contacts from a Atlas account",
  'base_version' => '1.6.5',
  'type' => 'email',
  'check_url' => 'http://www.atlas.cz/',
  'requirement' => 'user',
  'allowed_domains' => FALSE,
  'imported_details' => array('first_name', 'last_name', 'email_1'),
);

/**
 * Atlas.cz Plugin
 *
 * Imports user's contacts from Atlas.cz AddressBook
 *
 * @author OpenInviter
 * @version 1.0.0
 */
class atlas extends openinviter_base {
  private $login_ok = FALSE;
  public $showContacts = TRUE;
  public $internalError = FALSE;
  protected $timeout = 30;

  public $debug_array = array(
    'initial_get' => 'name',
    'login_post' => 'password',
    'redirect_post' => 'href="',
    'logged' => 'addressbook',
    'url_contacts' => 'rm',
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
    $this->service = 'atlas';
    $this->service_user = $user;
    $this->service_password = $pass;
    if (!$this->init()) {
      return FALSE;
    }

    $res = $this->get("http://auser.centrum.cz/");
    if ($this->checkResponse("initial_get", $res)) {
      $this->updateDebugBuffer('initial_get', "http://auser.centrum.cz/", 'GET');
    }
    else {
      $this->updateDebugBuffer('initial_get', 'http://auser.centrum.cz/', 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $form_action   = 'https://auser.centrum.cz/';
    $post_elements = array('url' => 'http://profil.centrum.cz/verify.aspx', 'ego_user' => $user, 'ego_domain' => 'atlas.cz', 'ego_secret' => $pass);
    $res           = $this->post($form_action, $post_elements);
    if ($this->checkResponse('login_post', $res)) {
      $this->updateDebugBuffer('login_post', $form_action, 'POST', TRUE, $post_elements);
    }
    else {
      $this->updateDebugBuffer('login_post', $form_action, 'POST', FALSE, $post_elements);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $form_action   = 'https://profil.mujblog.centrum.cz/verify.aspx';
    $post_elements = array('name' => "{$user}@atlas.cz", 'password' => "{$pass}", "refapp" => "http://atlasmail.centrum.cz", "emptyurl" => "http://profil.mujblog.centrum.cz/login.aspx");
    $res           = $this->post($form_action, $post_elements);
    if ($this->checkResponse('redirect_post', $res)) {
      $this->updateDebugBuffer('redirect_post', $form_action, 'POST', TRUE, $post_elements);
    }
    else {
      $this->updateDebugBuffer('redirect_post', $form_action, 'POST', FALSE, $post_elements);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $url_redirect = $this->getElementString($res, 'href="', '"');
    $res = $this->get($url_redirect, TRUE);
    if ($this->checkResponse("logged", $res)) {
      $this->updateDebugBuffer('logged', "{$url_redirect}", 'GET');
    }
    else {
      $this->updateDebugBuffer('logged', "{$url_redirect}", 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $url_contacts = 'http://atlasmail.centrum.cz/addressbook.aspx';
    $this->login_ok = $url_contacts;
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
    if ($this->checkResponse("url_contacts", $res)) {
      $this->updateDebugBuffer('contacts_file', $url, 'GET');
    }
    else {
      $this->updateDebugBuffer('contacts_file', $url, 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $contacts = array();
    if (preg_match_all("#abeditcontact.aspx\?contactid\=(.+)\"\>#U", $res, $matches)) {
      $matches = array_unique($matches[1]);
      foreach ($matches as $matchValue) {
        $last_name = FALSE;
        $first_name = FALSE;
        preg_match_all("#{$matchValue}\"\>(.+)</a>#U", $res, $matches2);
        if (!empty($matches2[1])) {
          $last_name = (!empty($matches2[1][1]) ? $matches2[1][1] : FALSE);
          $first_name = (!empty($matches2[1][0]) ? $matches2[1][0] : FALSE);
          if (!empty($matches2[1][2])) {
            $contacts[$matches2[1][2]] = array('first_name' => $first_name, 'last_name' => $last_name, 'email_1' => $matches2[1][2]);
          }
        }
      }
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
    $res = $this->get('http://www.atlas.cz/r/?ump', TRUE);
    $this->debugRequest();
    $this->resetDebugger();
    $this->stopPlugin();
    return TRUE;
  }
}



