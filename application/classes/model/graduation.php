<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');
class Model_Graduation_Collection extends Mongo_Collection {}

class Model_Graduation extends Mongo_Document {
  // Collection
  protected $name = 'graduations';

  // References
  protected $_references = array(
    '_school' => array(
      'model' => 'school',
      'field' => 'school',
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
    '_level' => array(
      'model' => 'offergraduation',
      'field' => 'level',
      'multiple' => FALSE,
    ),
  );
}

