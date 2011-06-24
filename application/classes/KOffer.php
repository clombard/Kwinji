<?php
// $Id$

class KOffer {

  public static function getUserOverviewOffers($id) {
    $offers = Mongo_Collection::factory('offer');
    $criteria = array(
      'user' => new MongoId($id),
    );
    return $offers->find($criteria)->sort('dates.starts')->limit(5);
  }

  public static function enumContracts() {
    $contracts = array(
      'a' => __('CDI'),
      'b' => __('CDD / Interim / Mission'),
      'c' => __('Freelance / Indépendant / saisonnier'),
      'd' => __('Titulaire de la fonction publique'),
      'e' => __('Stage'),
    );
    return $contracts;
  }

  public static function enumTypes() {
    $types = array(
      'a' => __('Full time'),
      'b' => __('Half time'),
      'c' => __('Daily'),
    );
    return $types;
  }

  public static function enumExperiences() {
    $experiences = array(
      'a' => "Dirigeant / Entrepreneur",
      'b' => "Responsable de département",
      'c' => "Responsable d'équipe",
      'd' => "Confirmé / Senior",
      'd' => "Junior",
      'f' => "Jeune Diplômé",
      'g' => "Etudiant",
    );
    return $experiences;
  }

  // Get a specific offer
  public static function get($id) {
    // Return a dummy offer -- Nous allons enfin nous mettre d'accord sur les modèles de données
    $offer = array(
      'id' => 123,
      'title' => 'Title of the offer',
      'description' => 'Description of the offer',
      'remuneration' => '40000',
      'currency' => '€',
      'location' => array(
        'street' => '8 rue Léopold Robert',
        'street_details' => 'Etage 4',
        'zipcode' => '75014',
        'country' => array(
          'value' => 'France',
          'path' => 'offer/by_country/france',
        ),
        'geo' => array(
          'latitude' => 12, 45,
          'longitude' => 12, 45,
        ),
      ),
      'authors' => array(
        array(
          'value' => 'Lucas Michot',
          'path' => 'user/view/123',
        ),
      ),
      'firm' => array(
        // Tous les identifiants de la company qui a créé l'offre
        'id' => 456,
        'name' => 'Alten SIR',
      ),
      'skills' => array(
        array(
          'value' => 'PHP',
          'level' => 50,
        ),
        array(
          'value' => 'Apache',
          'level' => 60,
        ),
        array(
          'value' => 'MongoDB',
          'level' => 80,
        ),
      ),
      'dates' => array(
        'created' => time(),
        'updated' => 1303822944,
        'finishes' => 1303822944,
        'registration_end' => 1303822944,
        'start' => 1303822944,
        'end' => 1303822944,
      ),
      'graduations' => array(
        array(
          'value' => 'BAC+3',
          'path' => 'offer/by_graduation/bac3',
        ),
        array(
          'value' => 'It',
          'path' => 'offer/by_graduationr/bac5',
        ),
      ),
      'sectors' => array(
        array(
          'value' => 'INdustry',
          'path' => 'offer/by_Sector/industry',
        ),
        array(
          'value' => 'It',
          'path' => 'offer/by_Sector/IT',
        ),
      ),
      'contract_type' => array(
        array(
          'value' => 'CDI',
          'path' => 'offer/by_contract_type/cdi',
        ),
        array(
          'value' => 'CDD',
          'path' => 'offer/by_contract_type/cdd',
        ),
      ),
      'job_type' => array(
        array(
          'value' => 'Full time',
          'path' => 'offer/by_job_type/fulltime',
        ),
        array(
          'value' => 'Daily',
          'path' => 'offer/by_job_type/daily',
        ),
      ),
    );
    return $offer;
  }
}

