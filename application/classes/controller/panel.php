<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');
class Controller_Panel extends Controller_Site {

  public function action_user($id) {
    $this->template = View::factory('site/layouts/layout_empty');
    $this->data['contact'] = new Model_User($id);
    $this->template->content = View::factory('panel/user', $this->data);
  }

  public function action_company($id) {
    $companies = array();
    $companies['kw'] = array(
      'name' => 'Kwinji',
    );

    $this->data['company'] = $companies[$id];
    $this->template->content = View::factory('panel/company', $this->data);
  }

  public function action_editnote() {
    $this->template->content = View::factory('panel/editnote', $this->data);
  }
  public function action_event($id) {
    $this->template = View::factory('site/layouts/layout_empty');
    $this->data['event'] = KData::getEvent($id);
    $this->template->content = View::factory('panel/event', $this->data);
  }
}

