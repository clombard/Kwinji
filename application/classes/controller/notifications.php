<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');
class Controller_Notifications extends Controller {

  public function action_index() {
    $this->response->body($this->view_name());
  }

  public function action_list() {
    $this->response->body($this->view_name());
  }

  private function view_name() {
    return 'View file views/'. Request::current()->controller() .'/'. Request::current()->action() .'.php';
  }
}

