<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');
class Model_School extends Mongo_Document {
  // Collection
  protected $name = 'schools';

  protected $_references = array(
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

