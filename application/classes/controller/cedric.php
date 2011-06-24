<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');
class Controller_Cedric extends Controller {

	public function action_firm() {
		echo strtotime("now"), "\n";
		echo strtotime("10 September 2000"), "\n";
		echo strtotime("+1 day"), "\n";
		echo strtotime("+1 week"), "\n";
		echo strtotime("+1 week 2 days 4 hours 2 seconds"), "\n";
		echo strtotime("next Thursday"), "\n";
		echo strtotime("last Monday"), "\n";
	}
	
  // Lorsque le module kwinji-parameters aura été activé
  public function action_sans_parametres() {
    // cedric/sans_parametres
				$this->request->redirect('http://www.google.com', 301);
  }

  public function action_avec_parametres($params) {
    // cedric/avec_parametres/arg1/val1/arg2/val2/arg3/val3
    // Il faut d'abord récupérer les paramètres

    // L'argument de ta fonction doit être $params
    // Récupération des paramètres
    $params = Parameters::extract($params);

    // Tu peux préciser quels sont les paramètres obligatoirement renseignés et quels sont les paramètres autorisés
    // Par défaut :
    $params = Parameters::extract($params);
    $params = Parameters::extract($params, NULL, NULL);

    // Si tu n'as qu'un paramètre obligatoire tu peux le faire passer en chaine plutot qu'en tableau
    $params = Parameters::extract($params, 'required_1', NULL);
    $params = Parameters::extract($params, array('required_1'), NULL);
    $params = Parameters::extract($params, array('required_1', 'required_2'), NULL);

    // Idem pour les paramètres autorisés
    $params = Parameters::extract($params, 'required_1', 'aut_1');
    $params = Parameters::extract($params, 'required_1', array('aut_1', 'aut_2'));

    // C'est super important en terme de sécurité, car il ne faut pas que n'importe qui puisse crée des URLS bidons avec les arguments qu'il veulent
    // Un paramètres requis n'est pas autorisé par défaut; c'est à toi de le préciser

    // Les liens : désormais au lieu de faire par exemple :
    $link = HTML::anchor('user/view/123', 'Username');
    // Il faudra faire
    $link = HTML::anchor('user/view/id/123', 'Username');
    // Si tu as plusieurs arguments tu peux les faire passer dans l'ordre que tu veux :

    $req = Request::factory('user/view/id/123/format/html');
    // ==
    $req = Request::factory('user/view/format/html/id/123/');

    // L'essentiel est de metre d'abord le nom de l'argument puis sa valeur
  }


	public function action_resume() {
				// Get params
//		$p = Parameters::extract($params, "rid", 'rid');
		
		$resume = Mongo_Document::factory('resume');
		$resume->load('4dbfc7a5820e648f02000000');
		
		$chartObj = array();
		$chartObj['title'] = __("Profile Qualifications");
		$chartObj['subtitle'] = __("Source: WorldClimate.com");
		$chartObj['y_title'] = __("Skill level in %");
		$chartObj['x_items'] = array();
		$chartObj['series'] = array();
		$total_count = count($resume->experiences);
		if ($resume->loaded() && $total_count > 0) {
			$chartObj['series_name'] = $resume->_user->displayname."'s Overview Graphic";
			$i = 0;
			foreach ($resume->_experiences as $experience) {
				$chartObj['series'] = array(
					'name' => $experience->industry->name,
					'y' => (100/$total_count) * 1,
					'color' => 'highchartsOptions.colors[' . $i . ']',
				);
				$i++;
			}
		}
		
		// Send response
		echo json_encode($chartObj);
		
	}



  public function action_test() {


    $document = Mongo_Document::factory('firm');
    $document->load('4db8203f8ead0edd38000000');
    $event = $document->as_array();
    echo json_encode($event);
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

