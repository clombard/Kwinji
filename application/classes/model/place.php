<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');
class Model_Place extends Mongo_Document {
  // Collection
  protected $name = 'places';

  // References
  protected $_references = array(
    '_place' => array(
      'model' => 'place',
      'field' => 'parent',
      'multiple' => FALSE,
    ),
  );
}

