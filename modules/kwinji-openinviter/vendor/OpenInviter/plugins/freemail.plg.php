<?php
// $Id$

$_pluginInfo = array(
  'name' => 'Freemail',
  'version' => '1.0.5',
  'description' => "Get the contacts from a freemail.hu account",
  'base_version' => '1.8.0',
  'type' => 'email',
  'check_url' => 'http://freemail.hu/',
  'requirement' => 'email',
  'allowed_domains' => array('/(freemail.hu)/i'),
  'imported_details' => array('first_name', 'email_1'),
);

/**
 * Freemail.hu Plugin
 *
 * Imports user's contacts from Freemail.hu AddressBook
 *
 * @author OpenInviter
 * @version 1.0.0
 */
class freemail extends openinviter_base {
  private $login_ok = FALSE;
  public $showContacts = TRUE;
  public $internalError = FALSE;
  protected $timeout = 30;

  public $debug_array = array(
    'initial_get' => 'userwithoutdomain',
    'login_post' => 'auth=ok',
    'url_adressbook' => 'first',
  );

  /**
   * Login function
   * fr
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
    $this->service = 'freemail';
    $this->service_user = $user;
    $this->service_password = $pass;
    if (!$this->init()) {
      return FALSE;
    }

    $res = $this->get("http://freemail.hu/levelezes/login.fm");
    if ($this->checkResponse("initial_get", $res)) {
      $this->updateDebugBuffer('initial_get', "http://freemail.hu/levelezes/login.fm", 'GET');
    }
    else {
      $this->updateDebugBuffer('initial_get', "http://freemail.hu/levelezes/login.fm", 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $userStriped   = str_replace("@freemail.hu", "", $user);
    $form_action   = "http://belepes.t-online.hu/auth.html";
    $post_elements = array('.formId' => 'commands.PlusAuth',
      'backurl' => 'http://freemail.hu/levelezes/auth.fm?cmd=checkuser&page=levelezes',
      'cmd' => 'plusauth',
      'remoteform' => 1,
      'user' => $user,
      'userwithoutdomain' => $userStriped,
      'pass' => $pass,
    );
    $res = $this->post($form_action, $post_elements, TRUE);
    if ($this->checkResponse('login_post', $res)) {
      $this->updateDebugBuffer('login_post', $form_action, 'POST', TRUE, $post_elements);
    }
    else {
      $this->updateDebugBuffer('login_post', $form_action, 'POST', FALSE, $post_elements);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }
    $url_redirect   = $this->getElementString($res, 'url=', '"');
    $url_adressbook = str_replace(array('levelezes/auth.fm?cmd=checkuser&page=levelezes&status=ok&auth=ok&', 'tid', 'email', 'freul_Id.hu'), array('cc/fsAddressBook.do?', 'ul_Tid', 'ul_Id', 'freemail.hu'), $url_redirect);
    $this->login_ok = $url_adressbook;
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
    if ($this->checkResponse("url_adressbook", $res)) {
      $this->updateDebugBuffer('url_adressbook', $url, 'GET');
    }
    else {
      $this->updateDebugBuffer('url_adressbook', $url, 'GET', FALSE);
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
    $query = "//tr[@class='data']";
    $data  = $xpath->query($query);
    foreach ($data as $node) {
      $names = trim(preg_replace('/[^(\x20-\x7F)]*/', '', utf8_decode((string)$node->childNodes->item(2)->nodeValue)));
      $emails = trim(preg_replace('/[^(\x20-\x7F)]*/', '', (utf8_decode((string)$node->childNodes->item(4)->nodeValue))));
      if (!empty($emails)) $contacts[$emails] = array('first_name' => (!empty($name) {
        ? $name : FALSE), 'email_1' => $emails);
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
    $res = $this->get('http://freemail.hu/levelezes/main.fm?page=logout', TRUE);
    $this->debugRequest();
    $this->resetDebugger();
    $this->stopPlugin();
    return TRUE;
  }
}



