<?php
// $Id$

/*This plugin import GMX.net contacts
 *You can send normal email   
 */

$_pluginInfo = array(
  'name' => 'GMX.net',
  'version' => '1.1.0',
  'description' => "Get the contacts from a GMX.net account",
  'base_version' => '1.6.3',
  'type' => 'email',
  'check_url' => 'http://www.gmx.net',
  'requirement' => 'email',
  'allowed_domains' => array('/(gmx.de)/i', '/(gmx.at)/i', '/(gmx.ch)/i', '/(gmx.net)/i'),
  'imported_details' => array('first_name', 'middle_name', 'last_name', 'nickname', 'email_1', 'email_2', 'email_3', 'organization', 'phone_mobile', 'phone_home', 'phone_work', 'fax', 'pager', 'address_home', 'address_work', 'website', 'address_city', 'address_state', 'address_country', 'postcode_home', 'isq_messenger', 'skype_messenger', 'yahoo_messenger', 'msn_messenger', 'aol_messenger', 'other_messenger'),
);

/**
 * GMX.net Plugin
 *
 * Imports user's contacts from GMX.net's AddressBook
 *
 * @author OpenInviter
 * @version 1.0.4
 */
class gmx_net extends openinviter_base {
  private $login_ok = FALSE;
  public $showContacts = TRUE;
  public $internalError = FALSE;
  protected $timeout = 30;

  public $debug_array = array(
    'initial_get' => 'uinguserid',
    'login' => 'Adressbuch',
    'export_file' => 'b_export',
    'contacts_file' => '","',
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
    $this->service = 'gmx_net';
    $this->service_user = $user;
    $this->service_password = $pass;
    if (!$this->init()) {
      return FALSE;
    }

    $res = $this->get("http://www.gmx.net/", TRUE);
    if ($this->checkResponse("initial_get", $res)) {
      $this->updateDebugBuffer('file_contacts', "http://www.gmx.net/", 'GET');
    }
    else {
      $this->updateDebugBuffer('file_contacts', "http://www.gmx.net/", 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }
    $form_action = "http://service.gmx.net/de/cgi/login";
    $post_elements = array('AREA' => 1,
      'EXT' => 'redirect',
      'EXT2' => '',
      'uinguserid' => $this->getElementString($res, 'name="uinguserid" value="', '"'),
      'id' => $user,
      'p' => $pass,
      'dlevel' => 'c',
      'browsersupported' => 'TRUE',
      'jsenabled' => 'FALSE',
    );
    $res = $this->post($form_action, $post_elements, TRUE);
    if ($this->checkResponse("login", $res)) {
      $this->updateDebugBuffer('login', $form_action, 'POST', TRUE, $post_elements);
    }
    else {
      $this->updateDebugBuffer('login', $form_action, 'POST', FALSE, $post_elements);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }
    $url_adress = str_replace("site=0", "site=importexport", "http://service.gmx.net/de/cgi/addrbk.fcgi?CUSTOMERNO=". html_entity_decode($this->getElementString($res, 'http://service.gmx.net/de/cgi/addrbk.fcgi?CUSTOMERNO=', '"')));
    #echo $url_adress;
    $this->login_ok = $url_adress;
    file_put_contents($this->getLogoutPath(), $url_adress);
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
    if ($this->checkResponse("export_file", $res)) {
      $this->updateDebugBuffer('export_file', $url, 'GET');
    }
    else {
      $this->updateDebugBuffer('export_file', $url, 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }
    $form_action = "http://service.gmx.net/de/cgi/addrbk.fcgi";
    $post_elements = $this->getHiddenElements($res);
    $post_elements['dataformat'] = 'o2002';
    $post_elements['language'] = 'english';
    $post_elements['b_export'] = 'Export starten';
    $res = $this->post($form_action, $post_elements);

    if ($this->checkResponse("contacts_file", $res)) {
      $this->updateDebugBuffer('contacts_file', $form_action, 'POST', TRUE, $post_elements);
    }
    else {
      $this->updateDebugBuffer('contacts_file', $form_action, 'POST', FALSE, $post_elements);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }
    $temp = $this->parseCSV($res);
    $contacts = array();

    foreach ($temp as $values) {
      if (!empty($values[29])) $contacts[$values[29]] = array('first_name' => (!empty($values[0]) ? $values[0] : FALSE),
        'middle_name' => (!empty($values[2]) ? $values[2] : FALSE),
        'last_name' => (!empty($values[1]) ? $values[1] : FALSE),
        'nickname' => FALSE,
        'email_1' => (!empty($values[29]) ? $values[29] : FALSE),
        'email_2' => (!empty($values[30]) ? $values[30] : FALSE),
        'email_3' => (!empty($values[31]) ? $values[31] : FALSE),
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
      $logout_url = "https://service.gmx.net/de/cgi/nph-logout?CUSTOMERNO=". $this->getElementString($res, "https://service.gmx.net/de/cgi/nph-logout?CUSTOMERNO=", '"');
      $res        = $this->get($logout_url, TRUE);
    }
    $this->debugRequest();
    $this->resetDebugger();
    $this->stopPlugin();
    return TRUE;
  }
}



