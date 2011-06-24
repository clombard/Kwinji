<?php
// $Id$

$_pluginInfo = array(
  'name' => 'Plaxo',
  'version' => '1.0.9',
  'description' => "Get the contacts from a plaxo account",
  'base_version' => '1.8.0',
  'type' => 'email',
  'check_url' => 'http://m.plaxo.com',
  'requirement' => 'email',
  'allowed_domains' => FALSE,
  'imported_details' => array('first_name', 'middle_name', 'last_name', 'nickname', 'email_1', 'email_2', 'email_3', 'organization', 'phone_mobile', 'phone_home', 'phone_work', 'fax', 'pager', 'address_home', 'address_work', 'website', 'address_city', 'address_state', 'address_country', 'postcode_home', 'isq_messenger', 'skype_messenger', 'yahoo_messenger', 'msn_messenger', 'aol_messenger', 'other_messenger'),
);

/**
 * plaxo.com Plugin
 *
 * Imports user's contacts from plaxo.com's AddressBook
 *
 * @author OpenInviter
 * @version 1.4.7
 */
class plaxo extends openinviter_base {
  private $login_ok = FALSE;
  public $showContacts = TRUE;
  public $debug_array = array(
    'initial_get' => 'signin.email',
    'login_post' => 'dojoBlankHtmlUrl',
    'export_url' => 'paths.0.folder_id',
    'contact_files' => 'Title',
  );

  /**
   * Login function
   *
   * Makes all the necessary requests to authenticate
   * the current user to the server.
   *
   * @param string $user The current user.c
   * @param string $pass The password for the current user.
   *
   * @return bool TRUE if the current user was authenticated successfully, FALSE otherwise.
   */
  public function login($user, $pass) {
    $this->resetDebugger();
    $this->service = 'plaxo';
    $this->service_user = $user;
    $this->service_password = $pass;
    if (!$this->init()) {
      return FALSE;
    }
    $res = $this->get("https://www.plaxo.com/signin", TRUE);
    if ($this->checkResponse("initial_get", $res)) {
      $this->updateDebugBuffer('initial_get', "https://www.plaxo.com/signin", 'GET');
    }
    else {
      $this->updateDebugBuffer('initial_get', "https://www.plaxo.com/signin", 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $form_action   = "https://www.plaxo.com/signin";
    $post_elements = array("r" => "https://www.plaxo.com", "t" => FALSE, "originalEmail" => FALSE, "signin" => TRUE, "smi" => 0, "signin_method" => "email", "signin.email" => $user, "signin.password" => $pass, "signin.keeplive" => 1);
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

    $this->login_ok = "http://www.plaxo.com/export?t=ab_contacts_export_all&memberImport=1";
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
    if ($this->checkResponse("export_url", $res)) {
      $this->updateDebugBuffer('export_url', "{$url}", 'GET');
    }
    else {
      $this->updateDebugBuffer('export_url', "{$url}", 'GET', FALSE);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $form_action   = "http://www.plaxo.com/export/plaxo_ab_outlook.csv";
    $post_elements = array("paths.0.folder_id" => $this->getElementString($res, 'name="paths.0.folder_id" value="', '"'), "paths.0.checked" => "on", "NumPaths" => 1, "type" => "O", "do_submit" => 1, "x" => 51, "y" => 19);
    $res           = $this->post($form_action, $post_elements);
    if ($this->checkResponse("contact_files", $res)) {
      $this->updateDebugBuffer('contact_files', "{$form_action}", 'POST', TRUE, $post_elements);
    }
    else {
      $this->updateDebugBuffer('contact_files', "{$form_action}", 'POST', FALSE, $post_elements);
      $this->debugRequest();
      $this->stopPlugin();
      return FALSE;
    }

    $temp             = $this->parseCSV($res);
    $contacts         = array();
    $descriptionArray = array();
    foreach ($temp as $values) {
      $contacts[$values[5]] = array('first_name' => (!empty($values[1]) ? $values[1] : FALSE),
        'middle_name' => (!empty($values[2]) ? $values[2] : FALSE),
        'last_name' => (!empty($values[3]) ? $values[3] : FALSE),
        'email_1' => (!empty($values[5]) ? $values[5] : FALSE),
        'email_2' => (!empty($values[6]) ? $values[6] : FALSE),
        'email_3' => (!empty($values[7]) ? $values[7] : FALSE),
        'phone_mobile' => (!empty($values[34]) ? $values[34] : FALSE),
        'phone_home' => (!empty($values[35]) ? $values[35] : FALSE),
        'phone_work' => (!empty($values[36]) ? $values[36] : FALSE),
        'fax' => FALSE,
        'pager' => FALSE,
        'address_home' => FALSE,
        'address_work' => FALSE,
        'website' => FALSE,
        'address_city' => FALSE,
        'address_state' => FALSE,
        'address_country' => FALSE,
        'postcode_home' => FALSE,
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
   * debugger.
   *
   * @return bool TRUE if the session was terminated successfully, FALSE otherwise.
   */
  public function logout() {
    if (!$this->checkSession()) {
      return FALSE;
    }
    $res = $this->get('http://www.plaxo.com/signout?r=%2Fsignin&lang=en', TRUE);
    $this->debugRequest();
    $this->resetDebugger();
    $this->stopPlugin();
    return TRUE;
  }
}


