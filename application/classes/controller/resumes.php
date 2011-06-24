<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');
class Controller_Resumes extends Controller_Kwi {

  public $template = '_templates/resumes';

  public function action_index($id) {
    // Add JS
    StaticJs::instance()->addJs('../static/js/highcharts/js/highcharts.src.js');
    StaticJs::instance()->addJs('../static/js/highcharts-utils.js');

    // Set breadcrumbs
    Breadcrumbs::add(Breadcrumb::factory()->set_title(__('Profile')));
    Breadcrumbs::add(Breadcrumb::factory()->set_title(__('Resumes')));
    $this->template->breadcrumbs = Breadcrumbs::render('_breadcrumbs/main');

    // Add meta
    $this->metas[] = HTML::meta(array('http-equiv' => 'X-UA-Compatible', 'content' => 'IE=EmulateIE7'));

    // Set menus
    $this->menu = Menu::factory('main');
    $this->menu->set_current(Request::$current->uri());


    // Get logged user
    $this->logged_user = View::factory('_blocks/logged_user');

    // Set regions
    $this->template->footer = View::factory('_regions/global_footer');
    $this->template->header = View::factory('_regions/global_header');

    // Set regions blocks
    $this->template->header->logo = $this->logo;
    $this->template->header->logged_user = $this->logged_user;
    $this->template->header->menu = $this->menu;

    // Set blocks
    $this->template->search = View::factory('_blocks/search');
    $this->template->resumes = View::factory('resume/resumes');
    $resumes = array(
      array(
        "title" => "3rd resume",
        "description" => "Mon premier cv de sa mère en sauce",
        "experiences" => array(
          array(
            "start_date" => time(),
            "end_date" => time(),
            "city" => "Boulogne-Billancourt",
            "region" => "IDF",
            "country" => "France",
            "firm_name" => "ALTEN SIR",
            "firm_id" => 124235,
            "job" => "Ingénieur d'affaires",
            "job_id" => 124235,
            "job_title" => "Manageur Banque / Finance",
            "industry" => "Conseil",
            "industry_id" => 124235,
            "description" => "Mission de gestion de porte-feuille clients bancaires (BNPP, CA, SG)",
            "keywords" => array(
              32457 => "Java",
              32458 => "Php",
              32459 => "SQL",
              32456 => "XML",
            ),
          ),
        ),
        "graduations" => array(
          array(
            "start_date" => time(),
            "end_date" => time(),
            "city" => "Paris",
            "region" => "IDF",
            "country" => "France",
            "school_name" => "INSIA, Institut Supérieur d'Informatique Appliquée",
            "school_id" => 124235,
            "speciality" => "SIGL, Systèmes d'Informations & Génie Logiciel",
            "description" => "Alternance Entreprise / Ecole ( 6 mois / 6 mois )",
            "keywords" => array(
              32457 => "Java",
              32458 => "Php",
              32459 => "SQL",
              32456 => "XML",
            ),
          ),
        ),
        "trainings" => array(
          array(
            "start_date" => time(),
            "end_date" => time(),
            "city" => "Paris",
            "region" => "IDF",
            "country" => "France",
            "title" => "Php pour les blairots",
            "firm_id" => 123567,
            "firm_name" => "Orsys",
            "teaser" => "Développement Php / MongoDB / jQuery",
            "title_link" => "www.chateaudequesmy.com",
            "description" => "Mission de gestion de porte-feuille clients bancaires (BNPP, CA, SG)",
            "keywords" => array(
              32457 => "Java",
              32458 => "Php",
              32459 => "SQL",
              32456 => "XML",
            ),
          ),
        ),
        "hobbies" => "Ski, Soccer, Free fold, Poker",
        "keywords" => "Java, Php, XML, MongoDB, JQuery",
        "created_at" => time(),
      ),
    );
    $this->template->resumes->resumes = $resumes;
    $this->template->skills_level = View::factory('resume/skills_level');
    $skills = array(
      "Php" => array(
        "level" => 75,
        "years" => 5,
      ),
      "MongoDB" => array(
        "level" => 35,
        "years" => 1,
      ),
      "JQuery" => array(
        "level" => 70,
        "years" => 2,
      ),
      "HTML5" => array(
        "level" => 90,
        "years" => 5,
      ),
      "CSS3" => array(
        "level" => 10,
        "years" => 5,
      ),
    );
    $this->template->skills_level->skills = $skills;
    $this->template->contacts = View::factory('_blocks/contacts');
    $contacts = array(
      "Bill Gates" => array(
        "avatar" => "",
        "function" => "CEO",
        "industry" => "Software & Hardware",
        "firm" => "Microsoft Corporation",
      ),
      "Richard Dreyfus" => array(
        "avatar" => "",
        "function" => "CEO",
        "industry" => "Software & Hardware",
        "firm" => "Microsoft Corporation",
      ),
      "François De La Tour Saint Georges" => array(
        "avatar" => "",
        "function" => "CEO",
        "industry" => "Software & Hardware",
        "firm" => "Microsoft Corporation",
      ),
    );
    $this->template->contacts->contacts = $contacts;
    $this->template->resume_tags = View::factory('_blocks/tags');
    $tags = array(
      "Php" => array(
        "level" => 10,
        "years" => 5,
      ),
      "CSS3" => array(
        "level" => 10,
        "years" => 5,
      ),
      "CSS3" => array(
        "level" => 10,
        "years" => 5,
      ),
      "CSS3" => array(
        "level" => 10,
        "years" => 5,
      ),
    );
    $this->template->user_buttons = View::factory('_blocks/user_buttons');
    $this->template->user_card = View::factory('_blocks/user_card');
    $card_infos = array(
      "display_name" => "John Doe",
      "job" => "Directeur de banque",
      "firm" => "Société Générale",
      "email" => "jdoe@sg.fr",
      "country" => "France",
      "region" => "Ile-De-France",
      "city" => "Créteil",
      "zip" => "94000",
    );
    $this->template->user_card->card_infos = $card_infos;
  }
}

