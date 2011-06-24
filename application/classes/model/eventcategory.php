<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');
class Model_Eventcategory extends Mongo_Document {
  // Collection
  protected $name = 'eventcategories';

  // References
  protected $_references = array();
}

