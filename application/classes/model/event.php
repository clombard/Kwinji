<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');
class Model_Event extends Mongo_Document {
  // Collection
  protected $name = 'events';

  // References
  protected $_references = array(
    '_firm' => array(
      'model' => 'firm',
      'field' => 'firm',
      'multiple' => FALSE,
    ),
    '_user' => array(
      'model' => 'user',
      'field' => 'user',
      'multiple' => FALSE,
    ),
    '_users' => array(
      'model' => 'user',
      'field' => 'users',
      'multiple' => TRUE,
    ),
    '_category' => array(
      'model' => 'eventcategory',
      'field' => 'category',
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
  );
}

