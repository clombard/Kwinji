<?php
// $Id$

$_pluginInfo = array(
  'name' => 'Live/Hotmail',
  'version' => '1.6.6',
  'description' => "Get the contacts from a Windows Live/Hotmail account",
  'base_version' => '1.8.0',
  'type' => 'email',
  'check_url' => 'http://login.live.com/login.srf?id=2',
  'requirement' => 'email',
  'allowed_domains' => array('/(hotmail)/i', '/(live)/i', '/(msn)/i', '/(chaishop)/i'),
  'imported_details' => array('first_name', 'email_1'),
);

/**
 * Live/Hotmail Plugin
 *
 * Imports user's contacts from Windows Live's AddressBook
 *
 * @author OpenInviter
 * @version 1.5.8
 */
class hotmail extends openinviter_base {
  private $login_ok = FALSE;
  public $showContacts = TRUE;
  public $internalError = FALSE;
  protected $timeout = 30;

  public $debug_array = array(
    'initial_get' => 'LoginOptions',
    'login_post' => 'location.replace',
    'first_redirect' => 'self.location.href',
    'url_inbox' => 'peopleUrlDomain',
    'message_at_login' => 'peopleUrlDomain',
    'url_sent_to' => 'ContactList.aspx',
    'get_contacts' => '\x26\x2364\x3',
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
   */ function login($user, $pass) {
    $this->resetDebugger();
    $this->service = 'hotmail';
    $this->service_user = $user;
    $this->service_password = $pass;
    if (!$this->init()) {
      return FALSE;
    }
    $res = $this->get("http://login.live.com/login.srf?id=2", TRUE);
    if ($this->checkResponse('initial_get', $res)) {
      $this->updateDebugBuffer('initial_get', "http://login.live.com/login.srf?id=2", 'GET');
    }
    else {
      $this->updateDebugBuffer('initial_get', "http://login.live.com/login.srf?id=2", 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    if (strlen($pass) > 16) {

      $pass = substr($pass, 0, 16);

    }
    $post_action = $this->getElementString($res, 'method="POST" target="_top" action="', '"');
    $post_elements = $this->getHiddenElements($res);
    $post_elements["LoginOptions"] = 3;
    $post_elements["login"] = $user;
    $post_elements["passwd"] = $pass;
    $res = $this->post($post_action, $post_elements, TRUE);
    if ($this->checkResponse("login_post", $res)) {
      $this->updateDebugBuffer('login_post', "{$post_action}", 'POST', TRUE, $post_elements);
    }
    else {
      $this->updateDebugBuffer('login_post', "{$post_action}", 'POST', FALSE, $post_elements);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $url_redirect = $this->getElementString($res, '.location.replace("', '"');
    $res = $this->get($url_redirect, TRUE, TRUE);
    if ($this->checkResponse('first_redirect', $res)) {
      $this->updateDebugBuffer('first_redirect', "{$url_redirect}", 'GET');
    }
    else {
      $this->updateDebugBuffer('first_redirect', "{$url_redirect}", 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $url_redirect = $this->getElementString($res, 'rurl:"', '"');
    $base_url     = "http://". $this->getElementString($res, 'burl:"', '"');
    $res          = $this->get($url_redirect, TRUE);

    if (strpos($res, 'MessageAtLoginForm') !== FALSE) {
      $form_action = $base_url .'mail/'. html_entity_decode($this->getElementString($res, 'method="post" action="', '"'));
      $post_elements = $this->getHiddenElements($res);
      $post_elements['TakeMeToInbox'] = 'Continue';
      $res = $this->post($form_action, $post_elements, TRUE);
      if ($this->checkResponse("message_at_login", $res)) {
        $this->updateDebugBuffer('message_at_login', "{$form_action}", 'POST', TRUE, $post_elements);
      }
      else {
        $this->updateDebugBuffer('message_at_login', "{$form_action}", 'POST', FALSE, $post_elements);
        $this->debugRequest();
        $this->stopPlugin();
        return FALSE;
      }
    }
    else {
      if ($this->checkResponse('url_inbox', $res)) {
        $this->updateDebugBuffer('url_inbox', "{$url_redirect}", 'GET');
      }
      else {
        $this->updateDebugBuffer('url_inbox', "{$url_redirect}", 'GET', FALSE);
        $this->debugRequest();
        $this->stopPlugin();
        return FALSE;
      }
    }

    $this->login_ok = $base_url;
    file_put_contents($this->getLogoutPath(), $base_url);
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
    else $base_url = $this->login_ok;
    $res = $this->get("{$base_url}/mail/EditMessageLight.aspx?n=");
    if ($this->checkResponse('url_sent_to', $res)) {
      $this->updateDebugBuffer('url_sent_to', "{$base_url}mail/EditMessageLight.aspx?n=", 'GET');
    }
    else {
      $this->updateDebugBuffer('url_sent_to', "{$base_url}mail/EditMessageLight.aspx?n=", 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $urlContacts = "{$base_url}/mail/ContactList.aspx". $this->getElementString($res, 'ContactList.aspx', '"');
    $res = $this->get($urlContacts);
    if ($this->checkResponse('get_contacts', $res)) {
      $this->updateDebugBuffer('get_contacts', "{$urlContacts}", 'GET');
    }
    else {
      $this->updateDebugBuffer('get_contacts', "{$urlContacts}", 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }
    $res = html_entity_decode(urldecode(str_replace('\x', '%', $res)), ENT_QUOTES, "UTF-8");
    $contacts = array();
    if (preg_match_all("#\'\,\[\'(.+)\@(.+)\'#U", $res, $matches)) {
      if (!empty($matches[1][0]) AND (!empty($matches[2][0]))) {
        unset($matches[1][0]);
        unset($matches[2][0]);
      }
      foreach ($matches[1] as $key => $value) if (!empty($matches[2][$key])) {   $contacts["{$value}@{$matches[2][$key]}"] = array("first_name" => "", "email_1" => "{$value}@{$matches[2][$key]}"); }
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
      $url        = file_get_contents($this->getLogoutPath());
      $url_logout = $url ."mail/logout.aspx";
      $res        = $this->get($url_logout, TRUE);
    }
    $this->debugRequest();
    $this->resetDebugger();
    $this->stopPlugin();
    return TRUE;
  }
}


