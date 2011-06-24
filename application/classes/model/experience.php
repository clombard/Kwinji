<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');
class Model_Experience_Collection extends Mongo_Collection {}

class Model_Experience extends Mongo_Document {
  // Collection
  protected $name = 'experiences';

  // References
  protected $_references = array(
    '_firm' => array(
      'model' => 'firm',
      'field' => 'firm',
      'multiple' => FALSE,
    ),
    '_industry' => array(
      'model' => 'sector',
      'field' => 'industry',
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
    '_skills' => array(
      'model' => 'skill',
      'field' => 'skills',
      'multiple' => TRUE,
    ),
  );
}

