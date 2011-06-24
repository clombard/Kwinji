<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');
class Controller_Contacts extends Controller_Site {

  public function action_index() {
    // Template
    $this->template = View::factory('site/layouts/layout_previewpane');

    global $logged_user;

    // USER ID
    $id = $logged_user->id;

    // TITLE
    $this->title .= __("Address book");

    $this->data['providers'] = KData::getUserIdentitiesProviders();
    $this->data['options'] = array(
      'alpha' => TRUE,
      'pager' => FALSE,
      'contacts_accepted' => $logged_user->_contacts_accepted,
    );
    $this->data['all_infos'] = array(
      "contactsToConfirm" => $logged_user->_contacts_waiting,
      "contactsWished" => $logged_user->_contacts_wished,
    );

    // Template view
    $this->template->content = View::factory('contacts/addressbook', $this->data);
    $this->template->content->contacts_list = View::factory('_blocks/contacts', $this->data);
    $this->template->content->infos = View::factory('contacts/infos', $this->data);
    $this->template->content->search_contacts = View::factory('_blocks/search_contacts', $this->data);
    $this->template->content->ads = View::factory('_blocks/ads', $this->data);
  }

  public function action_confirm() {
    global $logged_user;
    // Template
    $this->template = View::factory('site/layouts/layout_previewpane');

    // TITLE
    $this->title .= __("Contacts to confirm");

    $this->data['providers'] = KData::getUserIdentitiesProviders();
    $this->data['options'] = array(
      'alpha' => TRUE,
      'pager' => FALSE,
      'contacts_wished' => $logged_user->_contacts_wished,
    );
    $this->data['all_infos'] = array(
      "contactsToConfirm" => $logged_user->_contacts_waiting,
      "contactsWished" => $logged_user->_contacts_wished,
    );
    // Set blocks
    $this->template->content = View::factory('contacts/confirm', $this->data);
    $this->template->content->contacts_list = View::factory('_blocks/contacts', $this->data);
    $this->template->content->infos = View::factory('contacts/infos', $this->data);
    $this->template->content->search_contacts = View::factory('_blocks/search_contacts', $this->data);
    $this->template->content->ads = View::factory('_blocks/ads', $this->data);
  }

  public function action_invite() {}
}

