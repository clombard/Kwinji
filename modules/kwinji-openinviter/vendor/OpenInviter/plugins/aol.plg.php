<?php
// $Id$

$_pluginInfo = array(
  'name' => 'AOL',
  'version' => '1.5.4',
  'description' => "Get the contacts from an AOL account",
  'base_version' => '1.9.0',
  'type' => 'email',
  'check_url' => 'http://webmail.aol.com',
  'requirement' => 'email',
  'allowed_domains' => array('/(aol.com)/i'),
  'imported_details' => array('nickname', 'email_1', 'email_2', 'phone_mobile', 'phone_home', 'phone_work', 'pager', 'fax_work', 'last_name'),
);

/**
 * AOL Plugin
 *
 * Imports user's contacts from AOL's AddressBook
 *
 * @author OpenInviter
 * @version 1.4.7
 */
class aol extends openinviter_base {
  private $login_ok = FALSE;
  public $showContacts = TRUE;
  public $internalError = FALSE;
  protected $timeout = 30;

  public $debug_array = array(
    'initial_get' => 'pwderr',
    'login_post' => 'loginForm',
    'url_redirect' => 'var gSuccessURL',
    'inbox' => 'aol.wsl.afExternalRunAtLoad = []',
    'print_contacts' => 'Email1',
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
    $this->service = 'aol';
    $this->service_user = $user;
    $this->service_password = $pass;
    if (!$this->init()) {
      return FALSE;
    }

    $user = (strpos($user, '@aol') !== FALSE ? str_replace('@aol.com', '', $user) : $user);

    $res = $this->get("https://my.screenname.aol.com/_cqr/login/login.psp?sitedomain=sns.webmail.aol.com&lang=en&locale=us&authLev=0&uitype=mini&siteState=ver%3a4|rt%3aSTANDARD|at%3aSNS|ld%3awebmail.aol.com|uv%3aAOL|lc%3aen-us|mt%3aAOL|snt%3aScreenName|sid%3a22e31aa7-4747-4133-9015-842e000780b6&seamless=novl&loginId=&_sns_width_=174&_sns_height_=196&_sns_fg_color_=373737&_sns_err_color_=C81A1A&_sns_link_color_=0066CC&_sns_bg_color_=FFFFFF&redirType=js&xchk=FALSE", TRUE);
    if ($this->checkResponse('initial_get', $res)) {
      $this->updateDebugBuffer('initial_get', "https://my.screenname.aol.com/_cqr/login/login.psp?sitedomain=sns.webmail.aol.com&lang=en&locale=us&authLev=0&uitype=mini&siteState=ver%3a4|rt%3aSTANDARD|at%3aSNS|ld%3awebmail.aol.com|uv%3aAOL|lc%3aen-us|mt%3aAOL|snt%3aScreenName|sid%3a22e31aa7-4747-4133-9015-842e000780b6&seamless=novl&loginId=&_sns_width_=174&_sns_height_=196&_sns_fg_color_=373737&_sns_err_color_=C81A1A&_sns_link_color_=0066CC&_sns_bg_color_=FFFFFF&redirType=js&xchk=FALSE", 'GET');
    }
    else {
      $this->updateDebugBuffer('initial_get', "https://my.screenname.aol.com/_cqr/login/login.psp?sitedomain=sns.webmail.aol.com&lang=en&locale=us&authLev=0&uitype=mini&siteState=ver%3a4|rt%3aSTANDARD|at%3aSNS|ld%3awebmail.aol.com|uv%3aAOL|lc%3aen-us|mt%3aAOL|snt%3aScreenName|sid%3a22e31aa7-4747-4133-9015-842e000780b6&seamless=novl&loginId=&_sns_width_=174&_sns_height_=196&_sns_fg_color_=373737&_sns_err_color_=C81A1A&_sns_link_color_=0066CC&_sns_bg_color_=FFFFFF&redirType=js&xchk=FALSE", 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $post_elements = $this->getHiddenElements($res);
    $post_elements['loginId'] = $user;
    $post_elements['password'] = $pass;
    $res = $this->post("https://my.screenname.aol.com/_cqr/login/login.psp", $post_elements, TRUE);
    if ($this->checkResponse('login_post', $res)) {
      $this->updateDebugBuffer('login_post', "https://my.screenname.aol.com/_cqr/login/login.psp", 'POST', TRUE, $post_elements);
    }
    else {
      $this->updateDebugBuffer('login_post', "https://my.screenname.aol.com/_cqr/login/login.psp", 'POST', FALSE, $post_elements);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }


    $url_redirect = $this->getElementString($res, "'loginForm', 'FALSE', '", "')");
    $res = $this->get($url_redirect);
    if ($this->checkResponse('url_redirect', $res)) {
      $this->updateDebugBuffer('url_redirect', "{$url_redirect}", 'GET');
    }
    else {
      $this->updateDebugBuffer('url_redirect', "{$url_redirect}", 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }
    $url_redirect = "http://mail.aol.com". $this->getElementString($res, 'var gSuccessURL = "', '"', $res);
    $url_redirect = str_replace("Suite.aspx", "Lite/Today.aspx", $url_redirect);
    $res          = $this->get($url_redirect, TRUE);;
    if ($this->checkResponse('inbox', $res)) {
      $this->updateDebugBuffer('inbox', "{$url_redirect}", 'GET');
    }
    else {
      $this->updateDebugBuffer('inbox', "{$url_redirect}", 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $url_contact = $this->getElementDOM($res, "//a[@id='contactsLnk']", 'href');
    $this->login_ok = $this->login_ok = $url_contact[0];
    file_put_contents($this->getLogoutPath(), $url_contact[0]);
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
    $res      = $this->get($url, TRUE);
    $url_temp = $this->getElementString($res, "command.','','", "'");
    $version  = $this->getElementString($url_temp, 'http://mail.aol.com/', '/');
    $urlEx    = "http://mail.aol.com/{$version}/aol-6/en-us/AB/ABExport.aspx?command=all&format=csv&user=". $this->getElementString($res, "addresslist-print.aspx','", "'");
    $res      = $this->get($urlEx);
    $contacts = array();
    if ($this->checkResponse("print_contacts", $res)) {
      $this->updateDebugBuffer('print_contacts', "{$urlEx}", 'GET');
    }
    else {
      $this->updateDebugBuffer('print_contacts', "{$urlEx}", 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }
    $contacts = array();
    $temp     = $this->parseCSV($res);
    $contacts = array();
    foreach ($temp as $values) {
      if (!empty($values[4])) $contacts[$values[4]] = array('first_name' => (!empty($values[0]) ? $values[0] : FALSE),
        'middle_name' => (!empty($values[2]) ? $values[2] : FALSE),
        'last_name' => (!empty($values[1]) ? $values[1] : FALSE),
        'nickname' => FALSE,
        'email_1' => (!empty($values[4]) ? $values[4] : FALSE),
        'email_2' => FALSE,
        'email_3' => FALSE,
        'organization' => FALSE,
        'phone_mobile' => (!empty($values[11]) ? $values[11] : FALSE),
        'phone_home' => (!empty($values[9]) ? $values[9] : FALSE),
        'pager' => FALSE,
        'address_home' => FALSE,
        'address_city' => (!empty($values[5]) ? $values[5] : FALSE),
        'address_state' => (!empty($values[7]) ? $values[7] : FALSE),
        'address_country' => (!empty($values[8]) ? $values[8] : FALSE),
        'postcode_home' => (!empty($values[6]) ? $values[6] : FALSE),
        'company_work' => (!empty($values[14]) ? $values[14] : FALSE),
        'address_work' => FALSE,
        'address_work_city' => (!empty($values[16]) ? $values[16] : FALSE),
        'address_work_country' => (!empty($values[19]) ? $values[19] : FALSE),
        'address_work_state' => (!empty($values[17]) ? $values[17] : FALSE),
        'address_work_postcode' => (!empty($values[18]) ? $values[18] : FALSE),
        'fax_work' => (!empty($values[21]) ? $values[21] : FALSE),
        'phone_work' => (!empty($values[20]) ? $values[20] : FALSE),
        'website' => (!empty($values[12]) ? $values[12] : FALSE),
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
      $url        = file_get_contents($this->getLogoutPath());
      $res        = $this->get($url, TRUE);
      $url_logout = $this->getElementDOM($res, "//a[@class='signOutLink']", 'href');
      if (!empty($url_logout)) {
        $res = $this->get($url_logout[0]);
      }
    }
    $this->debugRequest();
    $this->resetDebugger();
    $this->stopPlugin();
    return TRUE;
  }
}


