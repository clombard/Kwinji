<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');
class Controller_School extends Controller {

  public function action_view($id) {
    $school = Mongo_Document::factory('school');
    $school->load(array('id' => $id));

    // get the followers of that school
    $users_following = Mongo_Document::factory('user')->collection();
    $users_following->find(array('schools' => array('$in' => array($school->id))))->as_array();

    // Load view
    $view = View::factory('school/view');
    $view->set('school', $school);
    $view->set('users_following', $users_following);
    $this->response->body($view);
  }
}

