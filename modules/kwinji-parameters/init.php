<?php

Route::set('params', '(<controller>(/<action>(/<params>)))', array('params'=>'.*'))
 	->defaults(array(
  	'controller' => 'welcome',
   	'action'     => 'index',
	));