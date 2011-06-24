<?php
// $Id$

$_pluginInfo = array(
  'name' => 'Mynet.com',
  'version' => '1.0.5',
  'description' => "Get the contacts from an Mynet account",
  'base_version' => '1.6.3',
  'type' => 'email',
  'check_url' => 'http://uyeler.mynet.com/login/?loginRequestingURL=http%3A%2F%2Feposta.mynet.com%2Findex%2Fmymail.html&formname=eposta',
  'requirement' => 'user',
  'allowed_domains' => FALSE,
  'imported_details' => array('first_name', 'middle_name', 'last_name', 'nickname', 'email_1', 'email_2', 'email_3', 'organization', 'phone_mobile', 'phone_home', 'phone_work', 'fax', 'pager', 'address_home', 'address_work', 'website', 'address_city', 'address_state', 'address_country', 'postcode_home', 'isq_messenger', 'skype_messenger', 'yahoo_messenger', 'msn_messenger', 'aol_messenger', 'other_messenger'),
);

/**
 * Mynet Plugin
 *
 * Imports user's contacts from Mynet
 *
 * @author OpenInviter
 * @version 1.0.0
 */
class mynet extends openinviter_base {
  private $login_ok = FALSE;
  public $showContacts = TRUE;
  public $internalError = FALSE;
  protected $timeout = 30;

  public $debug_array = array('initial_get' => 'faultyUser',
    'post_login' => 'mymail',
    'url_adress' => 'adres',
    'url_file' => 'adres',
    'file_contacts' => 'Name',
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
    $this->service = 'mynet';
    $this->service_user = $user;
    $this->service_password = $pass;
    if (!$this->init()) {
      return FALSE;
    }

    $res = $this->get("http://uyeler.mynet.com/login/?loginRequestingURL=http%3A%2F%2Feposta.mynet.com%2Findex%2Fmymail.html&formname=eposta");
    if ($this->checkResponse('initial_get', $res)) {
      $this->updateDebugBuffer('initial_get', "http://uyeler.mynet.com/login/?loginRequestingURL=http%3A%2F%2Feposta.mynet.com%2Findex%2Fmymail.html&formname=eposta", 'GET');
    }
    else {
      $this->updateDebugBuffer('initial_get', "http://uyeler.mynet.com/login/?loginRequestingURL=http%3A%2F%2Feposta.mynet.com%2Findex%2Fmymail.html&formname=eposta", 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $form_action = "https://uyeler.mynet.com/index/uyegiris.html";
    $post_elements = array('nameofservice' => 'epost',
      'pageURL' => 'http://uyeler.mynet.com/login/login.asp?loginRequestingURL=http%3A%2F%2Feposta.mynet.com%2Findex%2Fmymail.html&formname=eposta',
      'faultCoun' => '',
      'faultyUser' => '',
      'loginRequestingURL' => 'http://eposta.mynet.com/index/mymail.html',
      'rememberstate' => 2,
      'username' => $user,
      'password' => $pass,
      'x' => rand(1, 50),
      'y' => rand(1, 20),
      'rememberstatep' => 2,
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

    $res = $this->get("http://eposta.mynet.com/index/mymail.html", TRUE);
    $base_url = "http://". $this->getElementString($res, "var mySrvName = '", "'") .".mynet.com";
    if ($this->checkResponse('url_adress', $res)) {
      $this->updateDebugBuffer('url_adress', "http://eposta.mynet.com/index/mymail.html", 'GET');
    }
    else {
      $this->updateDebugBuffer('url_adress', "http://eposta.mynet.com/index/mymail.html", 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $url_adressbook = 'http://adres.email'. $this->getElementString($res, 'http://adres.email', '"');
    $res = $this->get($url_adressbook);
    if ($this->checkResponse('url_file', $res)) {
      $this->updateDebugBuffer('url_file', $url_adressbook, 'GET');
    }
    else {
      $this->updateDebugBuffer('url_file', $url_adressbook, 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }
    $url_file_contacts = "http://adres.email.mynet.com/Exim/ExportFileDownload.aspx?format=microsoft_csv";
    $this->login_ok = $url_file_contacts;
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
    else $url = $this->login_ok;
    $res = $this->get($url);
    if ($this->checkResponse('file_contacts', $res)) {
      $this->updateDebugBuffer('file_contacts', $url, 'GET');
    }
    else {
      $this->updateDebugBuffer('file_contacts', $url, 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $temp = $this->parseCSV($res);
    $contacts = array();
    foreach ($temp as $values) {
      if (!empty($values[9])) $contacts[$values[9]] = array('first_name' => (!empty($values[0]) ? $values[0] : FALSE),
        'middle_name' => FALSE,
        'last_name' => (!empty($values[1]) ? $values[1] : FALSE),
        'nickname' => FALSE,
        'email_1' => (!empty($values[9]) ? $values[9] : FALSE),
        'email_2' => FALSE,
        'email_3' => FALSE,
        'organization' => FALSE,
        'phone_mobile' => (!empty($values[7]) ? $values[7] : FALSE),
        'phone_home' => (!empty($values[6]) ? $values[6] : FALSE),
        'pager' => FALSE,
        'address_home' => FALSE,
        'address_city' => FALSE,
        'address_state' => FALSE,
        'address_country' => FALSE,
        'postcode_home' => (!empty($values[4]) ? $values[4] : FALSE),
        'company_work' => (!empty($values[2]) ? $values[2] : FALSE),
        'address_work' => FALSE,
        'address_work_city' => FALSE,
        'address_work_country' => FALSE,
        'address_work_state' => FALSE,
        'address_work_postcode' => FALSE,
        'fax_work' => FALSE,
        'phone_work' => FALSE,
        'website' => FALSE,
        'isq_messenger' => FALSE,
        'skype_essenger' => FALSE,
        'yahoo_essenger' => FALSE,
        'msn_messenger' => FALSE,
        'aol_messenger' => FALSE,
        'other_messenger' => FALSE,
      );
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
      $url_logout = file_get_contents($this->getLogoutPath()) ."/webmail/src/signout.php";
      $res = $this->get($url_logout, TRUE);
    }
    $this->debugRequest();
    $this->resetDebugger();
    $this->stopPlugin();
  }
}


