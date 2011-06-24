<?php
// $Id$

/*Import Friends from Famiva
 * You can Write Private Messages using Famiva system
 */

$_pluginInfo = array(
  'name' => 'Famiva',
  'version' => '1.0.3',
  'description' => "Get the contacts from a Famiva account",
  'base_version' => '1.8.0',
  'type' => 'social',
  'check_url' => 'http://www.famiva.com/',
  'requirement' => 'email',
  'allowed_domains' => FALSE,
);

/**
 * Famiva Plugin
 *
 * Import Friends from Famiva
 * You can Write Private Messages using Famiva system
 *
 * @author OpenInviter
 * @version 1.0.0
 */
class famiva extends openinviter_base {
  private $login_ok = FALSE;
  public $showContacts = TRUE;
  public $internalError = FALSE;
  protected $timeout = 30;

  public $debug_array = array(
    'initial_get' => 'member[email]',
    'login_post' => 'logout',
    'get_friends' => 'data',
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
    $this->service = 'famiva';
    $this->service_user = $user;
    $this->service_password = $pass;
    if (!$this->init()) {
      return FALSE;
    }

    $res = $this->get("http://www.famiva.com/", TRUE);
    if ($this->checkResponse("initial_get", $res)) {
      $this->updateDebugBuffer('initial_get', "http://www.famiva.com/", 'GET');
    }
    else {
      $this->updateDebugBuffer('initial_get', "http://www.famiva.com/", 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $form_action = "http://famiva.com/login/login";
    $post_elements = array('member[email]' => $user,
      'member[password]' => $pass,
      'remember_me' => TRUE,
      'commit' => 'Login',
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
    $url_friends = 'http://famiva.com/members/explore';
    $this->login_ok = $url_friends;
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
    if ($this->checkResponse("get_friends", $res)) {
      $this->updateDebugBuffer('get_friends', $url, 'GET');
    }
    else {
      $this->updateDebugBuffer('get_friends', $url, 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $contacts = array();
    $doc = new DOMDocument();
    libxml_use_internal_errors(TRUE);
    if (!empty($res)) {
      $doc->loadHTML($res);
    }
    libxml_use_internal_errors(FALSE);
    $xpath = new DOMXPath($doc);
    $query = "//a";
    $data  = $xpath->query($query);
    foreach ($data as $node) if (strpos($node->getAttribute('href'), 'profiles/view') != FALSE) {
      $name = $node->nodeValue;
      $email = $node->parentNode->nextSibling->nextSibling->nodeValue;
      if (!empty($email)) $contacts[$email] = !empty($name) {
        ? $name : FALSE;
      }
    }
    if (isset($contacts[$this->service_user]))unset($contacts[$this->service_user]);
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
    $res = $this->get("http://www.famiva.com/login/logout");
    $this->debugRequest();
    $this->resetDebugger();
    $this->stopPlugin();
    return TRUE;
  }
}



