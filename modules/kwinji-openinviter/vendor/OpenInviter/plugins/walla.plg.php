<?php
// $Id$

$_pluginInfo = array(
  'name' => 'Walla',
  'version' => '1.0.4',
  'description' => "Get the contacts from a Walla mail account",
  'base_version' => '1.6.5',
  'type' => 'email',
  'check_url' => 'http://friends.walla.co.il/?tsscript=login&theme=&ReturnURL=http://mail.walla.co.il/index.cgi',
  'requirement' => 'user',
  'allowed_domains' => FALSE,
  'imported_details' => array('first_name', 'email_1'),
);

/**
 * Walla Plugin
 *
 * Imports user's contacts from Walla's AddressBook
 *
 * @author OpenInviter
 * @version 1.0.0
 */
class walla extends openinviter_base {
  private $login_ok = FALSE;
  public $showContacts = TRUE;
  public $internalError = FALSE;
  protected $timeout = 30;

  public $debug_array = array(
    'initial_get' => '@login',
    'post_login' => 'newaddress',
    'url_contacts' => '@compose',
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
    $this->service = 'walla';
    $this->service_user = $user;
    $this->service_password = $pass;
    if (!$this->init()) {
      return FALSE;
    }

    $res = $this->get("http://friends.walla.co.il/?tsscript=login&theme=&ReturnURL=http://mail.walla.co.il/index.cgi", TRUE);
    if ($this->checkResponse('initial_get', $res)) {
      $this->updateDebugBuffer('initial_get', "http://www.gawab.com/default.php", 'GET');
    }
    else {
      $this->updateDebugBuffer('initial_get', "http://www.gawab.com/default.php", 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $form_action = "http://friends.walla.co.il/";
    $post_elements = array('w' => '/@login.commit',
      'ReturnURL' => 'http://mail.walla.co.il/index.cgi',
      'username' => $user,
      'password' => $pass,
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
    $url_contacts = "http://newaddress.walla.co.il";
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
    $res = $this->get($url);
    if ($this->checkResponse('url_contacts', $res)) {
      $this->updateDebugBuffer('url_contacts', $url, 'GET');
    }
    else {
      $this->updateDebugBuffer('url_contacts', $url, 'GET', FALSE);
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
    foreach ($data as $node) {
      if (strpos($node->getAttribute('href'), '@view') !== FALSE) {
        $name = $node->nodeValue;
      }
      if (strpos($node->getAttribute('href'), 'w=/@compose') !== FALSE) {
        $email = $node->nodeValue;
      }
      if (!empty($email)) $contacts[$email] = array('first_name' => (!empty($name) {
        ? $name : FALSE), 'email_1' => $email);
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
    $res = $this->get("http://friends.walla.co.il/?w=/@logout", TRUE);
    $this->debugRequest();
    $this->resetDebugger();
    $this->stopPlugin();
    return TRUE;
  }
}


