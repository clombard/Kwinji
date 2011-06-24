<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');
class Model_Training_Collection extends Mongo_Collection {}

class Model_Training extends Mongo_Document {
  // Collection
  protected $name = 'trainings';
}

