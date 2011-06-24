<?php
// $Id$

/*Import Friends from Flickr.com
 * You can send private message using Flickr system to your Friends
 */

$_pluginInfo = array(
  'name' => 'Flickr',
  'version' => '1.0.8',
  'description' => "Get the contacts from a Flickr account",
  'base_version' => '1.8.0',
  'type' => 'social',
  'check_url' => 'http://www.flickr.com',
  'requirement' => 'email',
  'allowed_domains' => FALSE,
);

/**
 * Flickr Plugin
 *
 * Imports user's contacts from Flickr and send messages
 * using Flickr's internal system
 *
 * @author OpenInviter
 * @version 1.0.2
 */
class flickr extends openinviter_base {
  private $login_ok = FALSE;
  public $showContacts = TRUE;
  public $internalError = FALSE;
  protected $timeout = 30;

  public $debug_array = array(
    'ini_get' => 'login.yahoo',
    'login_post' => 'window.location.replace(',
    'redirect_cookie' => 'magic_cookie',
    'frinds_page' => 'Who',
    'send_message_url' => 'magic_cookie',
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
    $this->service = 'flickr';
    $this->service_user = $user;
    $this->service_password = $pass;
    if (!$this->init()) {
      return FALSE;
    }

    $res = $this->get("http://www.flickr.com/signin/", TRUE);
    if ($this->checkResponse("ini_get", $res)) {
      $this->updateDebugBuffer('ini_get', "http://www.flickr.com/signin/", 'GET');
    }
    else {
      $this->updateDebugBuffer('ini_get', "http://www.flickr.com/signin/", 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $form_action = "https://login.yahoo.com/config/login?";
    $post_elements = $this->getHiddenElements($res);
    $post_elements["save"] = "Sign In";
    $post_elements['login'] = $user;
    $post_elements['passwd'] = $pass;
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

    $url_redirect = $this->getElementString($res, 'window.location.replace("', '"');
    $res = $this->get($url_redirect, TRUE);
    if ($this->checkResponse("redirect_cookie", $res)) {
      $this->updateDebugBuffer('redirect_cookie', $url_redirect, 'GET');
    }
    else {
      $this->updateDebugBuffer('redirect_cookie', $url_redirect, 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $url_friends = "http://www.flickr.com/people/". $this->getElementString("$res", '<span><a href="/photos/', '"') ."contacts/?see=friends";

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

    if ($this->checkResponse("frinds_page", $res)) {

      $this->updateDebugBuffer('frinds_page', $url, 'GET');

    }
    else {
      $this->updateDebugBuffer('frinds_page', $url, 'GET', FALSE);
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
    $query = "//a[@rel='contact']";
    $data  = $xpath->query($query);
    foreach ($data as $node) {
      if (strpos($node->getAttribute('title'), 'photos') !== FALSE) {
        $name = $node->nodeValue;
        $id = str_replace('/', '', str_replace('/photos/', '', (string)$node->getAttribute('href')));
        if (!empty($name)) {
          $contacts[$id] = $name;
        }
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
    foreach ($contacts as $id => $name) {
      $countMessages++;
      $url_send_message = "http://www.flickr.com/messages_write.gne?to={$id}";
      $res = $this->get($url_send_message);
      if ($this->checkResponse("send_message_url", $res)) {
        $this->updateDebugBuffer('send_message_url', $url_send_message, 'GET');
      }
      else {
        $this->updateDebugBuffer('send_message_url', $url_send_message, 'GET', FALSE);
        $this->debugRequest();
        $this->stopPlugin();
        return FALSE;
      }
      $form_action = "http://www.flickr.com/messages_write.gne";
      $post_elements = array("magic_cookie" => $this->getElementString($res, 'name="magic_cookie" value="', '"'),
        "to" => $this->getElementString($res, 'name="to" value="', '"'),
        "to_nsid" => $this->getElementString($res, 'name="to_nsid" value="', '"'),
        "reply" => "",
        "done" => 1,
        "subject" => $message['subject'],
        "message" => $message['body'],
      );
      $res = $this->post($form_action, $post_elements);
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
    $res        = $this->get("http://www.flickr.com/");
    $logout_url = "http://www.flickr.com/logout.gne?magic_cookie=". $this->getElementString($res, '/logout.gne?magic_cookie=', '"');
    $res        = $this->get($logout_url);
    $res        = $this->get("http://login.yahoo.com/config/login?logout=1&.intl=us&.done=http://us.yahoo.com");
    $this->debugRequest();
    $this->resetDebugger();
    $this->stopPlugin();
    return TRUE;
  }
}



