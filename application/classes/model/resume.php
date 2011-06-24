<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');
class Model_Resume_Collection extends Mongo_Collection {}

class Model_Resume extends Mongo_Document {
  // Collection
  protected $name = 'resumes';

  // References
  protected $_references = array(
    '_user' => array(
      'model' => 'user',
      'field' => 'user',
      'multiple' => FALSE,
    ),
    '_experiences' => array(
      'model' => 'experience',
      'field' => 'experiences',
      'multiple' => TRUE,
    ),
    '_graduations' => array(
      'model' => 'graduation',
      'field' => 'graduations',
      'multiple' => TRUE,
    ),
    '_trainings' => array(
      'model' => 'training',
      'field' => 'trainings',
      'multiple' => TRUE,
    ),
    '_skills' => array(
      'model' => 'skill',
      'field' => 'skills',
      'multiple' => TRUE,
    ),
  );
}

