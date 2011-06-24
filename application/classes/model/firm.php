<?php
// $Id$


defined('SYSPATH') or die('No direct script access.');
class Model_Firm extends Mongo_Document {
  // Collection
  protected $name = 'firms';

  // References
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
    '_users_working' => array(
      'model' => 'user',
      'foreign_key' => 'firm',
    ),
    '_events' => array(
      'model' => 'event',
      'foreign_key' => 'firm',
    ),
    '_followers' => array(
      'model' => 'user',
      'foreign_key' => 'firms_followed',
      'multiple' => TRUE,
    ),
  );
}

