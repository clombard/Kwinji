<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');
class Controller_Api extends Controller{public function before() {
  if ($_SERVER['SERVER_NAME'] != 'graph.kwinji.com') {
    throw new Kohana_HTTP_Exception('not found', NULL, 404);
    }return parent::before();
  }

  public function action_user($id) {
    $document = Mongo_Document::factory('user');
    $document->load($id);
    $user = $document->as_array();


    $user['dt_created'] = date('c', $user['dt_created']);
    $user['dt_hire'] = date('c', $user['dt_hire']);
    $user['dt_logged'] = date('c', $user['dt_logged']);
    $user['dt_updated'] = date('c', $user['dt_updated']);
    $user['dt_validated'] = date('c', $user['dt_validated']);

    $this->response->headers('Content-Type', 'application/json');
    $this->response->body(json_encode($user));
  }

  public function action_firm($id) {
    $document = Mongo_Document::factory('firm');
    $document->load($id);
    $firm = $document->as_array();

    $this->response->headers('Content-Type', 'application/json');
    $this->response->body(json_encode($firm));
  }

  public function action_school($id) {
    $document = Mongo_Document::factory('school');
    $document->load($id);
    $school = $document->as_array();

    $this->response->headers('Content-Type', 'application/json');
    $this->response->body(json_encode($school));
  }


  public function action_item($id) {
    $database    = Mongo_Database::instance();
    $collections = $database->listCollections();
    $test        = array();
    foreach ($collections as $collection) {}
    //$test = $database->listCollections() ;


    //$document = Mongo_Document::factory('school');
    //$document->load($id);
    //$school = $document->as_array();

    $this->response->headers('Content-Type', 'application/json');
    $this->response->body(json_encode($test));
  }
}

