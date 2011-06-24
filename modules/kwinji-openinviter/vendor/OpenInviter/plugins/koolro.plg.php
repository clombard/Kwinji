<?php
// $Id$

/*Import Friends from Koolro
 * You can send message to your Friends Inbox
 */

$_pluginInfo = array(
  'name' => 'Koolro',
  'version' => '1.0.1',
  'description' => "Get the contacts from a Koolro account",
  'base_version' => '1.8.0',
  'type' => 'social',
  'check_url' => 'http://www.koolro.com/',
  'requirement' => 'user',
  'allowed_domains' => FALSE,
);

/**
 * Koolro Plugin
 *
 * Imports user's contacts from Koolro and sends
 * messages using Koolro's internal system.
 *
 * @author OpenInviter
 * @version 1.0.8
 */
class koolro extends openinviter_base {
  private $login_ok = FALSE;
  public $showContacts = TRUE;
  public $internalError = FALSE;
  protected $timeout = 30;

  public $debug_array = array(
    'initial_get' => 'username',
    'login_post' => 'contacts.contacts',
    'url_friends' => 'option',
    'send_message' => 'ajFetch',
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
    $this->service = 'koolro';
    $this->service_user = $user;
    $this->service_password = $pass;
    if (!$this->init()) {
      return FALSE;
    }

    $res = $this->get("http://www.koolro.com/", TRUE);
    if ($this->checkResponse("initial_get", $res)) {
      $this->updateDebugBuffer('initial_get', "http://www.koolro.com/", 'GET');
    }
    else {
      $this->updateDebugBuffer('initial_get', "http://www.koolro.com/", 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $form_action   = "http://www.koolro.com/index.php?L";
    $post_elements = array('username' => $user, 'password' => $pass, 'userlogin' => FALSE);
    $res           = $this->post($form_action, $post_elements, TRUE);
    if ($this->checkResponse("login_post", $res)) {
      $this->updateDebugBuffer('login_post', "{$form_action}", 'POST', TRUE, $post_elements);
    }
    else {
      $this->updateDebugBuffer('login_post', "{$form_action}", 'POST', FALSE, $post_elements);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }


    $url_my_friends = 'http://www.koolro.com/index.php?L=mails.write';
    $this->login_ok = $url_my_friends;
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
    if ($this->checkResponse("url_friends", $res)) {
      $this->updateDebugBuffer('url_friends', $url, 'GET');
    }
    else {
      $this->updateDebugBuffer('url_friends', $url, 'GET', FALSE);
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
    $query = "//option";
    $data  = $xpath->query($query);
    foreach ($data as $node) {
      $value = $node->getAttribute('value');
      if (!empty($value)) {
        $contacts[$value] = $value;
      }
    }
    return $contacts;
  }

  /**
   * Send message to contacts
   *
   * Sends a message to the contacts using
   * the service's inernal messaging system
   *
   * @param string $session_id The OpenInviter user's session ID
   * @param string $message The message being sent to your contacts
   * @param array $contacts An array of the contacts that will receive the message
   *
   * @return mixed FALSE on failure.
   */
  public function sendMessage($session_id, $message, $contacts) {
    $countMessages = 0;
    foreach ($contacts as $name) {
      $countMessages++;
      $form_action = "http://www.koolro.com/index.php?L=mails.write";
      $post_elements = array('subject' => $message['subject'],
        'body' => $message['body'],
        'username' => FALSE,
        'contact' => $name,
        'Submit' => 'Submit',
      );
      $res = $this->post($form_action, $post_elements, TRUE);
      if ($this->checkResponse("send_message", $res)) {
        $this->updateDebugBuffer('send_message', "{$form_action}", 'POST', TRUE, $post_elements);
      }
      else {
        $this->updateDebugBuffer('send_message', "{$form_action}", 'POST', FALSE, $post_elements);
        $this->debugRequest();
        $this->stopPlugin();
        return FALSE;
      }
      sleep($this->messageDelay);
      if ($countMessages > $this->maxMessages) {
        $this->debugRequest();
        $this->resetDebugger();
        $this->stopPlugin();
        break;
      }
    }
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
    $res = $this->get("http://www.koolro.com/index.php?logout", TRUE);
    $this->debugRequest();
    $this->resetDebugger();
    $this->stopPlugin();
    return TRUE;
  }
}



