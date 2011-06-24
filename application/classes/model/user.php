<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');
class Model_User_Collection extends Mongo_Collection {}

class Model_User extends Mongo_Document {
  // Collection
  protected $name = 'users';
  
  // References
  protected $_references = array(
    '_firm' => array(
      'model' => 'firm',
      'field' => 'firm',
      'multiple' => FALSE,
    ),
    '_place_city' => array(
      'model' => 'place',
      'field' => 'place_city',
      'multiple' => FALSE,
    ),
    '_place_region' => array(
      'model' => 'place',
      'field' => 'place_region',
      'multiple' => FALSE,
    ),
    '_place_country' => array(
      'model' => 'place',
      'field' => 'place_country',
      'multiple' => FALSE,
    ),
    '_contacts_accepted' => array(
      'model' => 'user',
      'field' => 'contacts_accepted',
      'multiple' => TRUE,
    ),
    '_contacts_waiting' => array(
      'model' => 'user',
      'field' => 'contacts_waiting',
      'multiple' => TRUE,
    ),
    '_contacts_wished' => array(
      'model' => 'user',
      'field' => 'contacts_wished',
      'multiple' => TRUE,
    ),
    '_comments' => array(
      'model' => 'comment',
      'foreign_field' => 'user',
    ),
  );

  
  // Get common contacts with another user
  public function getCommonContacts($first_id, $second_id) {
    $user1 = Mongo_Document::factory('user');
    $user1->load($first_id);
    $contacts1 = array();
    foreach ($user1->_contacts_accepted as $c) {
      $contacts1[(string)$c->id] = $c->id;
    }

    $user2 = Mongo_Document::factory('user');
    $user2->load($second_id);
    $contacts2 = array();
    foreach ($user2->_contacts_accepted as $c) {
      $contacts2[(string)$c->id] = $c->id;
    }

    $users = Mongo_Collection::factory('user');
    $common = $users->find(array('id' => array('$in' => array_intersect($contacts1, $contacts2))))->values(array('id'))->as_array();
    return $common;
  }
  
}

