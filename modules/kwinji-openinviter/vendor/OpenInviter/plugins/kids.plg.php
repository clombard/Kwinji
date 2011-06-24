<?php
// $Id$

$_pluginInfo = array(
  'name' => 'Kids',
  'version' => '1.0.2',
  'description' => "Get the contacts from a Kids account",
  'base_version' => '1.6.5',
  'type' => 'email',
  'check_url' => 'http://www.kids.co.uk/email/index.php',
  'requirement' => 'user',
  'allowed_domains' => FALSE,
  'imported_details' => array('first_name', 'email_1'),
);

/**
 * Kids Plugin
 *
 * Import user's contacts from Kids account
 *
 *
 * @author OpenInviter
 * @version 1.0.0
 */
class kids extends openinviter_base {
  private $login_ok = FALSE;
  public $showContacts = TRUE;
  public $internalError = FALSE;
  protected $timeout = 30;

  public $debug_array = array(
    'initial_get' => 'login_id',
    'login_post' => 'frame',
    'url_contacts' => 'doaddresses.php?_MATRIXaction=',
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
    $this->service = 'kids';
    $this->service_user = $user;
    $this->service_password = $pass;
    if (!$this->init()) {
      return FALSE;
    }

    $res = $this->get("http://www.kids.co.uk/email/index.php", TRUE);
    if ($this->checkResponse("initial_get", $res)) {
      $this->updateDebugBuffer('initial_get', "http://www.kids.co.uk/email/index.php", 'GET');
    }
    else {
      $this->updateDebugBuffer('initial_get', "http://www.kids.co.uk/email/index.php", 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $form_action = "http://www.kids.co.uk/email/home/dologin.php";
    $post_elements = array('did' => 2,
      'login_id' => $user,
      'did' => 2,
      'login_pwd' => $pass,
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

    $url_addressbook = 'http://www.kids.co.uk/email/home/addressbook.php';
    $this->login_ok = $url_addressbook;
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
    if ($this->checkResponse("url_contacts", $res)) {
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
    $odd   = TRUE;
    foreach ($data as $node) {
      if (strpos($node->getAttribute('href'), 'doaddresses.php?_MATRIXaction=Modify') !== FALSE) {
        if ($odd) {
          $names[] = $node->nodeValue;
        }
        else $emails[] = $node->nodeValue;
        $odd = !$odd;
      }
    }
    if (!empty($names)) foreach ($names as $key => $value) if (!empty($emails[$key])) {
      $contacts[$emails[$key]] = array('first_name' => $value, 'email_1' => $emails[$key]);
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
    $res = $this->get("http://kids.co.uk/email/dologout.php", TRUE);
    $this->debugRequest();
    $this->resetDebugger();
    $this->stopPlugin();
    return TRUE;
  }
}



