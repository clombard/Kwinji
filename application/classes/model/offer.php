<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');
class Model_Offer_Collection extends Mongo_Collection {
  //@TODO:
}

class Model_Offer extends Mongo_Document {
  // Collection
  protected $name = 'offers';

  // References
  protected $_references = array(
    'ref_user' => array(
      'model' => 'user',
      'field' => 'user',
    ),
    'ref_firm' => array(
      'model' => 'firm',
      'field' => 'firm',
    ),
    '_place_city' => array('model' => 'place', 'field' => 'place_city'),
    '_place_region' => array('model' => 'place', 'field' => 'place_region'),
    '_place_country' => array('model' => 'place', 'field' => 'place_country'),
  );
}

