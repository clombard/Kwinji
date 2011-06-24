<?php
// $Id$

/*Import Friends from Konnects
 * You can Write Private Messages using Konnects system
 */

$_pluginInfo = array(
  'name' => 'Konnects',
  'version' => '1.0.5',
  'description' => "Get the contacts from a Konnects account",
  'base_version' => '1.6.7',
  'type' => 'social',
  'check_url' => 'http://www.konnects.com/',
  'requirement' => 'email',
  'allowed_domains' => FALSE,
);

/**
 * Konnects Plugin
 *
 * Import Friends from Konnects
 * You can Write Private Messages using Konnects system
 *
 * @author OpenInviter
 * @version 1.0.0
 */
class konnects extends openinviter_base {
  private $login_ok = FALSE;
  public $showContacts = TRUE;
  public $internalError = FALSE;
  protected $timeout = 30;

  public $debug_array = array(
    'initial_get' => 'UserName',
    'login_post' => 'fncRedirect',
    'get_friends' => 'links_inbox',
    'url_friend' => 'a',
    'url_send_message' => 'a',
    'send_message' => 'sent',
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
    $this->service = 'konnects';
    $this->service_user = $user;
    $this->service_password = $pass;
    if (!$this->init()) {
      return FALSE;
    }

    $res = $this->get("http://www.konnects.com/", TRUE);
    if ($this->checkResponse("initial_get", $res)) {
      $this->updateDebugBuffer('initial_get', "http://www.konnects.com/", 'GET');
    }
    else {
      $this->updateDebugBuffer('initial_get', "http://www.konnects.com/", 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $form_action = "https://www.konnects.com/login.jsp?Flag=R";
    $post_elements = array('Return' => 'member_homepage.jspf',
      'UserName' => $user,
      'Password' => $pass,
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
    $url_friends = 'http://www.konnects.com/member_connections.jsp';
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

    $contacts    = array();
    $names_array = $this->getElementDOM($res, "//a[@class='links_inbox']");
    $hrefs_array = $this->getElementDOM($res, "//a[@class='links_inbox']", 'href');
    if (!empty($hrefs_array)) foreach ($hrefs_array as $key => $value) $contacts[$value] = (!empty($names_array[$key]) {
      ? $names_array[$key] : FALSE);
    }
    return $contacts;
  }

  /**
   * Send message to contacts
   *
   * Sends a message to the contacts using
   * the service's inernal messaging system
   *
   * @param string $cookie_file The location of the cookies file for the current session
   * @param string $message The message being sent to your contacts
   * @param array $contacts An array of the contacts that will receive the message
   *
   * @return mixed FALSE on failure.
   */
  public function sendMessage($session_id, $message, $contacts) {
    $countMessages = 0;
    foreach ($contacts as $href => $name) {
      $countMessages++;
      $url_friend = 'http://www.konnects.com/'. $href;
      $res = $this->get($url_friend, TRUE);
      if ($this->checkResponse("url_friend", $res)) {
        $this->updateDebugBuffer('url_friend', $url_friend, 'GET');
      }
      else {
        $this->updateDebugBuffer('url_friend', $url_friend, 'GET', FALSE);
        $this->debugRequest();
        $this->stopPlugin();
        return FALSE;
      }

      $url_send_message = "http://www.konnects.com/profiles_message". $this->getElementString($res, 'profiles_message', '"');
      $res = $this->get($url_send_message, TRUE);
      if ($this->checkResponse("url_send_message", $res)) {
        $this->updateDebugBuffer('url_send_message', $url_send_message, 'GET');
      }
      else {
        $this->updateDebugBuffer('url_send_message', $url_send_message, 'GET', FALSE);
        $this->debugRequest();
        $this->stopPlugin();
        return FALSE;
      }

      $form_action = 'http://www.konnects.com/'. $this->getElementString($res, 'name="profile" id="profile" action="', '"');
      $post_elements = $this->getHiddenElements($res);
      $post_elements['Message'] = $message['body'];
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
    $res = $this->get("http://www.konnects.com/logout.jsp");
    $this->debugRequest();
    $this->resetDebugger();
    $this->stopPlugin();
    return TRUE;
  }
}



