<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');
class Model_Comment extends Mongo_Document {
  // Collection
  protected $name = 'comments';

  // References
  protected $_references = array(
    '_user' => array(
      'model' => 'user',
      'field' => 'user',
      'multiple' => FALSE,
    ),
    '_comments' => array(
      'model' => 'comment',
      'foreign_key' => 'parent',
    ),
  );


  protected function after_save($action) {
    if ($action == Mongo_Document::SAVE_INSERT) {
      $notification = Mongo_Document::factory('notification');
      $notification->type = 'new_comment_created';
      $notification->dt_created = time();
      $notification->from = $this->_user->id;
      $notification->to = array();
      $notification->what = $this->id;
      $notification->save();
    }
  }
}

