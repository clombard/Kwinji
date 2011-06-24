<?php
// $Id$

$_pluginInfo = array(
  'name' => 'Zapakmail',
  'version' => '1.0.3',
  'description' => "Get the contacts from an Zapakmail account",
  'base_version' => '1.6.5',
  'type' => 'email',
  'check_url' => 'http://www.zapak.com/zapakmail.zpk',
  'requirement' => 'user',
  'allowed_domains' => FALSE,
  'imported_details' => array('first_name', 'email_1'),
);

/**
 * Zapakmail Plugin
 *
 * Imports user's contacts from Zapakmail's AddressBook
 *
 * @author OpenInviter
 * @version 1.6.5
 */
class zapak extends openinviter_base {
  private $login_ok = FALSE;
  public $showContacts = TRUE;
  protected $timeout = 30;
  public $debug_array = array(
    'initial_get' => 'uid',
    'login_post' => 'msgid',
    'url_adress' => 'onclick',
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
    $this->service = 'zapakmail';
    $this->service_user = $user;
    $this->service_password = $pass;
    if (!$this->init()) {
      return FALSE;
    }

    $res = $this->get("http://www.zapak.com/zapakmail.zpk", TRUE);
    if ($this->checkResponse('initial_get', $res)) {
      $this->updateDebugBuffer('initial_get', "http://www.zapak.com/zapakmail.zpk", 'GET');
    }
    else {
      $this->updateDebugBuffer('initial_get', "http://www.zapak.com/zapakmail.zpk", 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $form_action = "http://www.zapak.com/authenticateuser.zpk?redirect=/emailr.zpk? ";
    $post_elements = array('uid' => $user,
      'password' => $pass,
      'Submit32.x' => rand(10, 50),
      'Submit32.y' => rand(10, 50),
      'isemail' => 'y',
      'regflag' => 1,
    );
    $res = $this->post($form_action, $post_elements, TRUE);
    if ($this->checkResponse('login_post', $res)) {
      $this->updateDebugBuffer('login_post', "$form_action", 'POST', TRUE, $post_elements);
    }
    else {
      $this->updateDebugBuffer('login_post', "$form_action", 'POST', FALSE, $post_elements);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $url_address = 'http://www.zapak.com/mc.zpk';
    $this->login_ok = $url_address;
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
    //go to url inbox
    $res = $this->get($url, TRUE);
    if ($this->checkResponse("url_adress", $res)) {
      $this->updateDebugBuffer('url_adress', "{$url}", 'GET');
    }
    else {
      $this->updateDebugBuffer('url_adress', "{$url}", 'GET', FALSE);
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
    $query = "//a[@onclick]";
    $data  = $xpath->query($query);
    foreach ($data as $node) {
      if ($node->nodeValue == 'Edit') {
        $emails       = str_replace('firstname=', "", str_replace("lastname=", "", str_replace("email=", "", $this->getElementString((string)$node->getAttribute('onclick'), '?', '&id'))));
        $emails_array = explode("&", $emails);
        $name         = (isset($emails_array[0]) ? $emails_array[0] : FALSE) ." ". (isset($emails_array[1]) ? $emails_array[1] : FALSE);
        if ($emails_array[2]) $contacts[$emails_array[2]] = array('first_name' => (!empty($name) {
          ? $name : FALSE), 'email_1' => $emails_array[2]);
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
    echo $res = $this->get("http://www.zapak.com/mlor.z?zmail=y", TRUE);
    $this->debugRequest();
    $this->resetDebugger();
    $this->stopPlugin();
    return TRUE;
  }
}


