<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');
class Model_New extends Mongo_Document {
  // Collection
  protected $name = 'news';

  // References
  protected $_references = array(
    //'ref_user' => array(
    '_user' => array(
      'model' => 'user',
      'field' => 'user',
      'multiple' => FALSE,
    ),
    //'ref_firm' => array(
    '_firm' => array(
      'model' => 'firm',
      'field' => 'firm',
      'multiple' => FALSE,
    ),
    '_users' => array(
      'model' => 'user',
      'field' => 'users',
      'multiple' => TRUE,
    ),
  );
  
}

