<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');
class Controller_Streamlined extends Controller_Site {


  public function action_index() {
    // Template content
    $this->template->content = view::factory('streamlined/index');
  }

  public function action_styles() {
    // Template
    $this->template = View::factory('site/layouts/layout_default');

    // Template header
    $this->template->header = View::factory('site/regions/header');
    $this->template->header->logo = View::factory('site/blocks/logo');
    $this->template->header->nav_header = View::factory('site/blocks/nav_header');
    $this->template->header->search_header = View::factory('site/blocks/search_header');

    // Template aside left
    $this->template->aside_left = View::factory('site/regions/aside_left');

    // Template footer
    $this->template->footer = View::factory('site/regions/footer');

    // Template content
    $messages = array();
    Message::info(__('This is an info message.'), __('Information'));
    $messages[] = Message::render();
    Message::success(__('This is a success message.'), __('Success!'));
    $messages[] = Message::render();
    Message::warning(__('This is a warning message.'), __('Warning!'));
    $messages[] = Message::render();
    Message::error(__('This is an error message.'), __('Error!'));
    $messages[] = Message::render();
    Message::info(__('This is a closeable info message.'), __('Information'), TRUE);
    $messages[] = Message::render();
    Message::success(__('This is a closeable success message.'), __('Success!'), TRUE);
    $messages[] = Message::render();
    Message::warning(__('This is a closeable warning message.'), __('Warning!'), TRUE);
    $messages[] = Message::render();
    Message::error(__('This is a closeable error message.'), __('Error!'), TRUE);
    $messages[] = Message::render();
    $data = array(
      'messages' => $messages,
    );
    $this->template->content = view::factory('streamlined/styles', $data);
  }

  public function action_resume() {
    // Add JS
    StaticJs::instance()->addJs('static/js/highcharts/js/highcharts.js');
    StaticJs::instance()->addJs('static/js/highcharts-utils.js');

    // Template
    $this->template = View::factory('site/layouts/layout_default');

    // Template header
    $this->template->header = View::factory('site/regions/header');
    $this->template->header->logo = View::factory('site/blocks/logo');
    $this->template->header->nav_header = View::factory('site/blocks/nav_header');
    $this->template->header->search_header = View::factory('site/blocks/search_header');

    // Template aside left
    $this->template->aside_left = View::factory('site/regions/aside_left');

    // Template footer
    $this->template->footer = View::factory('site/regions/footer');

    // Template content
    $this->template->content = view::factory('streamlined/resume/view');
    $resumes = array(23425 => "Fr", 342552 => "En");
    $resume = array(
      "id" => 324356,
      "lang" => "fr",
      "title" => "3rd resume",
      "description" => "Mon premier cv de sa mère en sauce",
      "experiences" => array(
        array(
          "start_date" => time(),
          "end_date" => time(),
          "city" => "Boulogne-Billancourt",
          "zip" => "92600",
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
          "zip" => "75011",
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
          "zip" => "75009",
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
    );
    $this->template->content->resume = $resume;
    $this->template->content->resumes = $resumes;
    $card_infos = array(
      "display_name" => "John Doe",
      "avatar" => "",
      "job" => "Directeur de banque",
      "firm" => "Société Générale",
      "email" => "jdoe@sg.fr",
      "country" => "France",
      "region" => "Ile-De-France",
      "city" => "Créteil",
      "zip" => "94000",
    );
    $this->template->content->user_infos = $card_infos;
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
    $this->template->content->skills = $skills;
  }

  public function action_tables() {
    // Template
    $this->template = View::factory('site/layouts/layout_default');

    // Add a specific JS and CSS for tables
    StaticJs::instance()->addJs('assets/js/jquery.tables.js');
    StaticCss::instance()->addCss('assets/css/tables.css');

    // Template header
    $this->template->header = View::factory('site/regions/header');
    $this->template->header->logo = View::factory('site/blocks/logo');
    $this->template->header->nav_header = View::factory('site/blocks/nav_header');
    $this->template->header->search_header = View::factory('site/blocks/search_header');

    // Template aside left
    $this->template->aside_left = View::factory('site/regions/aside_left');

    // Template footer
    $this->template->footer = View::factory('site/regions/footer');

    // Template content
    $data = array();
    $data['browsers'] = $this->table_data();
    $this->template->content = view::factory('streamlined/tables', $data);
  }


  public function action_forms() {
    // Add widgets to the Parent template controller
    $this->widgets[] = View::factory('widget/prompt');
    $this->widgets[] = View::factory('widget/simpledialog');
    $this->widgets[] = View::factory('widget/yesno');

    // Add a specific JS for widgets forms
    StaticJs::instance()->addJs('assets/js/kwinji.forms.widgets.js');

    // Template
    $this->template = View::factory('site/layouts/layout_default');

    // Template header
    $this->template->header = View::factory('site/regions/header');
    $this->template->header->logo = View::factory('site/blocks/logo');
    $this->template->header->nav_header = View::factory('site/blocks/nav_header');
    $this->template->header->search_header = View::factory('site/blocks/search_header');

    // Template aside left
    $this->template->aside_left = View::factory('site/regions/aside_left');

    // Template footer
    $this->template->footer = View::factory('site/regions/footer');

    // Template content
    $this->template->content = view::factory('streamlined/forms');
  }


  public function action_dashboard() {
    // Template
    $this->template = View::factory('site/layouts/layout_default');

    // Template header
    $this->template->header = View::factory('site/regions/header');
    $this->template->header->logo = View::factory('site/blocks/logo');
    $this->template->header->nav_header = View::factory('site/blocks/nav_header');
    $this->template->header->search_header = View::factory('site/blocks/search_header');

    // Template aside left
    $this->template->aside_left = View::factory('site/regions/aside_left');

    // Template footer
    $this->template->footer = View::factory('site/regions/footer');

    // Template content
    $this->template->content = view::factory('streamlined/dashboard');
  }


  public function action_profile() {
    // Template
    $this->template = View::factory('site/layouts/layout_previewpane');

    // Template header
    $this->template->header = View::factory('site/regions/header');
    $this->template->header->logo = View::factory('site/blocks/logo');
    $this->template->header->nav_header = View::factory('site/blocks/nav_header');
    $this->template->header->search_header = View::factory('site/blocks/search_header');

    // Template aside left
    $this->template->aside_left = View::factory('site/regions/aside_left');

    // Template footer
    $this->template->footer = View::factory('site/regions/footer');

    $user = array(
      'fullname' => 'Cédric Lombard',
      'company' => 'Kwinji',
      'position' => 'PDG',
      'firstname' => 'Cédric',
      'mail' => 'cedric@semalead.com',
      'phone' => '+ 33 (0) 9 50 11 51 31',
      'mobile' => '+ 33 (0) 6 78 70 77 19',
      'fax' => '+ 33 (0) 9 50 11 51 31',
      'birthday' => '15 octobre 1979',
      'hire' => '15 octobre 1979',
      'street' => 'Chateau de Quesmy',
      'building' => 'une autre adresse',
      'activities' => array(
        array(
          'type' => 'note',
          'timestamp' => 'Dec 28, 2010',
          'text' => 'Vestibulum ultrices vehicula leo ac tristique. Mauris id nisl nibh.',
          'meta' => __('Posted by Administrator'),
        ),
        array(
          'type' => 'contact',
          'timestamp' => 'Dec 28, 2010',
          'text' => 'Vestibulum ultrices vehicula leo ac tristique. Mauris id nisl nibh.',
          'meta' => __('Posted by Administrator'),
        ),
        array(
          'type' => 'company',
          'timestamp' => 'Dec 28, 2010',
          'text' => 'Vestibulum ultrices vehicula leo ac tristique. Mauris id nisl nibh.',
          'meta' => __('Posted by Administrator'),
        ),
      ),
    );

    // Template content
    $data = array();
    $data['user'] = $user;
    $this->template->content = view::factory('streamlined/profile', $data);
  }


  public function action_activity() {
    // Template
    $this->template = View::factory('site/layouts/layout_previewpane');

    // Template header
    $this->template->header = View::factory('site/regions/header');
    $this->template->header->logo = View::factory('site/blocks/logo');
    $this->template->header->nav_header = View::factory('site/blocks/nav_header');
    $this->template->header->search_header = View::factory('site/blocks/search_header');

    // Template aside left
    $this->template->aside_left = View::factory('site/regions/aside_left');

    // Template footer
    $this->template->footer = View::factory('site/regions/footer');

    // Template content
    $activities = array(
      array(
        'type' => 'note',
        'details_panel' => 'panel/user/lm',
        'timestamp' => 'Dec 28, 2010',
        'title' => 'Lucas Michot',
        'text' => 'Vestibulum ultrices vehicula leo ac tristique. Mauris id nisl nibh.',
        'meta' => __('Posted by Administrator'),
      ),
      array(
        'type' => 'contact',
        'details_panel' => 'panel/user/cl',
        'timestamp' => 'Dec 28, 2010',
        'title' => 'Cédric Lombard',
        'text' => 'Vestibulum ultrices vehicula leo ac tristique. Mauris id nisl nibh.',
        'meta' => __('Posted by Administrator'),
      ),
      array(
        'type' => 'company',
        'details_panel' => 'panel/company/kw',
        'timestamp' => 'Dec 28, 2010',
        'title' => 'Kwinji',
        'text' => 'Vestibulum ultrices vehicula leo ac tristique. Mauris id nisl nibh.',
        'meta' => __('Posted by Administrator'),
      ),
    );
    $data = array();
    $data['activities'] = $activities;
    $this->template->content = view::factory('streamlined/activity', $data);
  }


  public function action_layouts() {
    // Template
    $this->template = View::factory('site/layouts/layout_default');

    // Template header
    $this->template->header = View::factory('site/regions/header');
    $this->template->header->logo = View::factory('site/blocks/logo');
    $this->template->header->nav_header = View::factory('site/blocks/nav_header');
    $this->template->header->search_header = View::factory('site/blocks/search_header');

    // Template aside left
    $this->template->aside_left = View::factory('site/regions/aside_left');

    // Template footer
    $this->template->footer = View::factory('site/regions/footer');

    // Template content
    $data = array();
    $layouts = array(
      array(
        'href' => 'streamlined/layouts',
        'title' => __('Default layout'),
      ),
      array(
        'href' => 'streamlined/layout2',
        'title' => __('Preview Pane'),
      ),
      array(
        'href' => 'streamlined/layout3',
        'title' => __('3 columns'),
      ),
      array(
        'href' => 'streamlined/layout4',
        'title' => __('Promo layout'),
      ),
    );
    $data['layouts'] = $layouts;
    $this->template->content = view::factory('streamlined/layouts', $data);
  }

  private function calendar_data() {
    // TAB EVENTS
    $events = array(
      array(
        "id" => 12424,
        "title" => "Title Event",
        "teaser" => "Teaser Event",
        "teaser" => "Teaser Event",
        "start_date" => time(),
        "end_date" => time(),
        "endsof" => time(),
        "authors" => array(
          array(
            "id" => 12324,
            "avatar" => "",
            "display_name" => "John Doe",
            "job" => "Directeur Marketing & Communication",
            "city" => "Paris",
            "zip" => "75014",
            "country" => "France",
          ),
          array(
            "id" => 12324,
            "avatar" => "",
            "display_name" => "John Doe",
            "job" => "Directeur Marketing & Communication",
            "city" => "Paris",
            "zip" => "75014",
            "country" => "France",
          ),
        ),
        "tags" => array("tag1", "tag2", "tag3"),
      ),
    );
    return $events;
  }

  private function firm_data() {
    $firm = array(
      "name" => "ALTEN SA",
      "industry" => "Conseil en systèmes et logiciels informatiques",
      "address" => "221 Boulevard Jean Jaurès",
      "zip" => "92100",
      "city" => "Boulogne-Billancourt",
      "country" => "France",
      "phones" => array(
        "standard" => "01 46 08 75 00",
        "fax" => "01 46 08 75 01",
      ),
      "website" => "www.alten.fr",
      "identity" => "B 348 607 417",
      "nbemployees" => 15000,
      "ca" => "950 000",
      "currency" => "€",
      "international" => array(
        "fr" => "streamlined/firm/123345/fr",
        "de" => "streamlined/firm/123345/de",
        "es" => "streamlined/firm/123345/es",
      ),
      "announces" => count($this->announces_data()),
      "events" => count($this->calendar_data()),
      "followers" => count($this->followers_data()),
    );
    return $firm;
  }

  private function getContentHeader($id) {
    $record = $this->getRecord($id);
    $header = array(
      "type" => 'multiple',
      'title' => $record['title'],
      'url' => "firm/view/". $id,
      'titles' => array(
        array(
          "content" => "Add news",
          "url" => "add_news",
        ),
        array(
          "content" => "Add event",
          "url" => "add_event",
        ),
        array(
          "content" => "Add announce",
          "url" => "add_announce",
        ),
        array(
          "content" => "Add contact",
          "url" => "add_news",
        ),
      ),
    );
    return $header;
  }

  private function followers_data() {
    // TAB CONTACTS
    $contacts = array(
      array(
        "avatar" => "",
        "display_name" => "John Doe",
        "job" => "Directeur Marketing & Communication",
        "city" => "Paris",
        "zip" => "75014",
        "country" => "France",
      ),
      array(
        "avatar" => "",
        "display_name" => "Jane Doe",
        "job" => "Assistante Marketing & Communication",
        "city" => "Paris",
        "zip" => "75014",
        "country" => "France",
      ),
    );
    return $contacts;
  }

  private function contacts_data() {
    // TAB CONTACTS
    $contacts = array(
      array(
        "group_name" => "Marketing",
        "group" => array(
          array(
            "avatar" => "",
            "display_name" => "John Doe",
            "job" => "Directeur Marketing & Communication",
            "city" => "Paris",
            "zip" => "75014",
            "country" => "France",
          ),
          array(
            "avatar" => "",
            "display_name" => "Jane Doe",
            "job" => "Assistante Marketing & Communication",
            "city" => "Paris",
            "zip" => "75014",
            "country" => "France",
          ),
          array(
            "avatar" => "",
            "display_name" => "John Doe",
            "job" => "Directeur Marketing & Communication",
            "city" => "Paris",
            "zip" => "75014",
            "country" => "France",
          ),
          array(
            "avatar" => "",
            "display_name" => "Jane Doe",
            "job" => "Assistante Marketing & Communication",
            "city" => "Paris",
            "zip" => "75014",
            "country" => "France",
          ),
          array(
            "avatar" => "",
            "display_name" => "John Doe",
            "job" => "Directeur Marketing & Communication",
            "city" => "Paris",
            "zip" => "75014",
            "country" => "France",
          ),
          array(
            "avatar" => "",
            "display_name" => "Jane Doe",
            "job" => "Assistante Marketing & Communication",
            "city" => "Paris",
            "zip" => "75014",
            "country" => "France",
          ),
          array(
            "avatar" => "",
            "display_name" => "John Doe",
            "job" => "Directeur Marketing & Communication",
            "city" => "Paris",
            "zip" => "75014",
            "country" => "France",
          ),
          array(
            "avatar" => "",
            "display_name" => "Jane Doe",
            "job" => "Assistante Marketing & Communication",
            "city" => "Paris",
            "zip" => "75014",
            "country" => "France",
          ),
        ),
      ),
      array(
        "group_name" => "RH",
        "group" => array(
          array(
            "avatar" => "",
            "display_name" => "John Doe",
            "job" => "Directeur RH",
            "city" => "Paris",
            "zip" => "75014",
            "country" => "France",
          ),
          array(
            "avatar" => "",
            "display_name" => "Jane Doe",
            "job" => "Recruteur Banque / Finance",
            "city" => "Lille",
            "zip" => "59005",
            "country" => "France",
          ),
        ),
      ),
    );
    return $contacts;
  }

  private function firm_description_data() {
    // TAB DESCRIPTION
    $description = array(
      "description" => "Ekfdjbglkdjsbgdlfgnsdf kfn gkljnd glkdfjn gfdlkg dfklg fg fg  ig hergir egkljner gkj erghergier eri ergih",
    );
    return $description;
  }

  private function news_data() {
    // TAB NEWS
    $news = array(
      12345 => array(
        "date" => time(),
        "title" => "Nouvelle centrale nucléaire développer à Tchernobyl",
        "teaser" => "Un défi à relever, pour les 30 ingénieurs d'Alten",
        "content" => "lkfjbskjlfslg nrign relg,r egmrengiuren gnjkz iulgne rlzngeizognrezkjnglkjenrzg erizgireng religu erli guehr",
        "tags" => array("Tchernobyl", "Centrale", "Nucléaire"),
        "authors" => array(
          134234245,
          234234253,
          345435465,
        ),
      ),
      12346 => array(
        "date" => time(),
        "title" => "ALTEN soutient Renault dans la tourmante",
        "teaser" => "Malgrès une mauvaise pub, ALTEN reste partenaire avec son plus fidèle client",
        "content" => "lkfjbskjlfslg nrign relg,r egmrengiuren gnjkz iulgne rlzngeizognrezkjnglkjenrzg erizgireng religu erli guehr",
        "tags" => array("Renault", "Crise", "ALTEN"),
        "authors" => array(
          134234245,
          234234253,
          345435465,
        ),
      ),
    );
    return $news;
  }

  private function announces_data() {
    $data = array(
      array(
        "id" => 12343,
        "category" => "Job",
        "img" => "",
        "title" => "Ingénieur d'affaires",
        "description" => "jhbsfdklgjnfdkgnklfmdg,mdflsg,rstmlg,sr vz s ertgkj ner kg htjhtreh erthtrh tr",
        "begin" => time(),
        "end" => time(),
        "end_registration" => time(),
        "place" => "Immeuble La victoire",
        "address" => "221 Boulevard Jean Jaurès",
        "zip" => "92100",
        "city" => "Boulogne-Billancourt",
        "country" => "France",
        "industry" => "Conseil et Ingénierie en Systèmes d'informations",
        "job" => array(12, 34, 56),
        "experience" => array(12, 34, 56),
        "studies" => array(12, 34, 56),
        "engagement" => array(12, 34, 56),
        "job_type" => array(12, 34, 56),
        "authors" => array(12, 34, 56),
      ),
    );
    return $data;
  }

  private function table_data() {
    $data = array(
      array(
        'browser' => 'Firefox 3.0',
        'os' => 'Windows',
      ),
      array(
        'browser' => 'Firefox 3.0',
        'os' => 'OS X',
      ),
      array(
        'browser' => 'Firefox 3.6',
        'os' => 'Windows',
      ),
      array(
        'browser' => 'Firefox 3.6',
        'os' => 'OS X',
      ),
      array(
        'browser' => 'Firefox 3.6',
        'os' => 'Ubuntu',
      ),
      array(
        'browser' => 'Chrome 6.0',
        'os' => 'Windows',
      ),
      array(
        'browser' => 'Chrome 7.0',
        'os' => 'Windows',
      ),
      array(
        'browser' => 'Chrome 7.0',
        'os' => 'OS X',
      ),
      array(
        'browser' => 'Internet Explorer 6.0',
        'os' => 'Windows',
      ),
      array(
        'browser' => 'Internet Explorer 7.0',
        'os' => 'Windows',
      ),
      array(
        'browser' => 'Internet Explorer 8.0',
        'os' => 'Windows',
      ),
      array(
        'browser' => 'Internet Explorer 9.0',
        'os' => 'Windows',
      ),
      array(
        'browser' => 'Safari 5.0',
        'os' => 'Windows',
      ),
      array(
        'browser' => 'Safari 5.0',
        'os' => 'OS X',
      ),
      array(
        'browser' => 'Opera 9.5',
        'os' => 'Windows',
      ),
      array(
        'browser' => 'Firefox 3.0',
        'os' => 'Windows',
      ),
      array(
        'browser' => 'Firefox 3.0',
        'os' => 'OS X',
      ),
      array(
        'browser' => 'Firefox 3.6',
        'os' => 'Windows',
      ),
      array(
        'browser' => 'Firefox 3.6',
        'os' => 'OS X',
      ),
      array(
        'browser' => 'Firefox 3.6',
        'os' => 'Ubuntu',
      ),
      array(
        'browser' => 'Chrome 6.0',
        'os' => 'Windows',
      ),
      array(
        'browser' => 'Chrome 7.0',
        'os' => 'Windows',
      ),
      array(
        'browser' => 'Chrome 7.0',
        'os' => 'OS X',
      ),
      array(
        'browser' => 'Internet Explorer 6.0',
        'os' => 'Windows',
      ),
      array(
        'browser' => 'Internet Explorer 7.0',
        'os' => 'Windows',
      ),
      array(
        'browser' => 'Internet Explorer 8.0',
        'os' => 'Windows',
      ),
      array(
        'browser' => 'Internet Explorer 9.0',
        'os' => 'Windows',
      ),
      array(
        'browser' => 'Safari 5.0',
        'os' => 'Windows',
      ),
      array(
        'browser' => 'Safari 5.0',
        'os' => 'OS X',
      ),
      array(
        'browser' => 'Opera 9.5',
        'os' => 'Windows',
      ),
      array(
        'browser' => 'Firefox 3.0',
        'os' => 'Windows',
      ),
      array(
        'browser' => 'Firefox 3.0',
        'os' => 'OS X',
      ),
      array(
        'browser' => 'Firefox 3.6',
        'os' => 'Windows',
      ),
      array('browser' => 'Firefox 3.6',
        'os' => 'OS X',
      ),
      array(
        'browser' => 'Firefox 3.6',
        'os' => 'Ubuntu',
      ),
      array(
        'browser' => 'Chrome 6.0',
        'os' => 'Windows',
      ),
      array(
        'browser' => 'Chrome 7.0',
        'os' => 'Windows',
      ),
      array(
        'browser' => 'Chrome 7.0',
        'os' => 'OS X',
      ),
      array(
        'browser' => 'Internet Explorer 6.0',
        'os' => 'Windows',
      ),
      array(
        'browser' => 'Internet Explorer 7.0',
        'os' => 'Windows',
      ),
      array(
        'browser' => 'Internet Explorer 8.0',
        'os' => 'Windows',
      ),
      array(
        'browser' => 'Internet Explorer 9.0',
        'os' => 'Windows',
      ),
      array(
        'browser' => 'Safari 5.0',
        'os' => 'Windows',
      ),
      array(
        'browser' => 'Safari 5.0',
        'os' => 'OS X',
      ),
      array(
        'browser' => 'Opera 9.5',
        'os' => 'Windows',
      ),
      array(
        'browser' => 'Firefox 3.0',
        'os' => 'Windows',
      ),
      array(
        'browser' => 'Firefox 3.0',
        'os' => 'OS X',
      ),
      array(
        'browser' => 'Firefox 3.6',
        'os' => 'Windows',
      ),
      array(
        'browser' => 'Firefox 3.6',
        'os' => 'OS X',
      ),
      array(
        'browser' => 'Firefox 3.6',
        'os' => 'Ubuntu',
      ),
      array(
        'browser' => 'Chrome 6.0',
        'os' => 'Windows',
      ),
      array(
        'browser' => 'Chrome 7.0',
        'os' => 'Windows',
      ),
      array(
        'browser' => 'Chrome 7.0',
        'os' => 'OS X',
      ),
      array(
        'browser' => 'Internet Explorer 6.0',
        'os' => 'Windows',
      ),
      array(
        'browser' => 'Internet Explorer 7.0',
        'os' => 'Windows',
      ),
      array(
        'browser' => 'Internet Explorer 8.0',
        'os' => 'Windows',
      ),
      array(
        'browser' => 'Internet Explorer 9.0',
        'os' => 'Windows',
      ),
      array(
        'browser' => 'Safari 5.0',
        'os' => 'Windows',
      ),
      array(
        'browser' => 'Safari 5.0',
        'os' => 'OS X',
      ),
      array(
        'browser' => 'Opera 9.5',
        'os' => 'Windows',
      ),
    );
    return $data;
  }

  private function getRecord($id) {
    // Set title News with $id;
    $news = array(
      "id" => 12324,
      "img" => "",
      "title" => "ALTEN",
      "url" => 1242,
      "authors" => array(
        array(
          "id" => 32243,
          "display_name" => "John Doe",
          "job" => "Marketing manager",
          "avatar" => "",
          "firm" => "ALTEN",
          "firm_id" => 1234,
        ),
        array(
          "id" => 32244,
          "display_name" => "Martin Solveig",
          "job" => "Marketing manager",
          "avatar" => "",
          "firm" => "ALTEN",
          "firm_id" => 1234,
        ),
        array(
          "id" => 32245,
          "display_name" => "Bob Sainclar",
          "job" => "Marketing manager",
          "avatar" => "",
          "firm" => "ALTEN",
          "firm_id" => 1234,
        ),
      ),
      "teaser" => "Bla Bla Bla Bla ",
      "description" => "Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla Bla ",
      "tags" => array(
        "firstname", "John",
        "lastname", "Doe",
        "job", "Marketing manager",
      ),
      "created_at" => time(),
      "updated_at" => time(),
    );
    return $news;
  }
}

