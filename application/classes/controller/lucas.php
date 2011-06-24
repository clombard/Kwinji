<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');
class Controller_Lucas extends Controller {

  public function action_common() {
    $u1 = '4dbfc444820e649302000002';
    $u2 = '4dd2a74a820e64fe08000000';

    $com = KData::commonContacts(new MongoId($u1), new MongoId($u2));
    print_r($com);
  }


  public function action_path() {

    $parts = Path::alias('firm/view/id/4db8203f8ead0edd38000000');
    echo $parts;
  }




  public function action_test() {
    // #####################################################################
    // Création d'un utilisateur
    $user = Mongo_Document::factory('user');

    // Soit...
    $user->set('field_string', 'toto');
    $user->set('field_boolean', TRUE);
    $user->set('field_null', NULL);
    $user->set('field_int', 123);
    $user->set('field_array', array('a' => 'b', 'c' => 'd'));

    // Soit...
    // $user->field_string  = 'toto';
    // $user->field_boolean = TRUE;
    // $user->field_null    = NULL;
    // $user->field_int     = 123;
    // $user->field_array   = array('a' => 'b', 'c' => 'd');

    // Tu enregistre l'utilisateur, l'objet user contient désormais son ID
    $user->save();

    // #####################################################################
    // Pour le mettre à jour, tu as juste besoin de faire
    $user2 = Mongo_Document::factory('user');
    // Chargement de l'objet
    $user2->load($user->id);
    // Pareil que :
    // $user2->load(array('id' => $user->id));

    // Mise à jour de la valeur :
    $user2->field_string = 'tata';

    // Enregistrement de l'objet
    $user2->save();

    $output = $user2->as_array();
    echo json_encode($output);
  }
}

