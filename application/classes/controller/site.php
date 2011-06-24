<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');
class Controller_Site extends Controller_Template {

  // Default layout
  public $template = 'site/layouts/layout_index';

  // Before the child class is implemented
  public function before() {
    parent::before();
    $this->links   = array();
    $this->css     = array();
    $this->js      = array();
    $this->metas   = array();
    $this->title   = "Kwinji | ";
    $this->widgets = array();
    $this->gmap    = NULL;

    // Get data
    $this->data = $this->data();
    $this->data['browser_language'] = $this->getBrowerLanguage();
    $this->data['user'] = $this->user();
    $this->data['periods'] = $this->periods();
    $this->data['events_countries_categories'] = $this->events_countries_categories();
    $this->data['events_countries'] = $this->events_countries();
    $this->data['user_card'] = View::factory('user/items/card', $this->data);


    // User is logged user
    $this->aside_left = View::factory('site/regions/aside_left', $this->data);

    // Navigation Back to Top
    $this->back_to_top = View::factory('site/blocks/back_to_top');

    // Header templates
    $this->header = View::factory('site/regions/header');
    $this->header->logo = View::factory('site/blocks/logo');
    $this->header->nav_header = View::factory('site/blocks/nav_header', $this->data);
    $this->header->search_header = View::factory('site/blocks/search_header');
    $this->footer = View::factory('site/regions/footer');


    // Add metas
    $this->metas['keywords'] = HTML::meta(array('http-equiv' => 'Content-Type', 'content' => 'text/html; charset=ISO-8859-1'));

    // Add CSS
    StaticCss::instance()->addCssStatic('assets/css/datepicker.css');
    StaticCss::instance()->addCssStatic('assets/css/reset.css');
    StaticCss::instance()->addCssStatic('assets/css/grid.css');
    StaticCss::instance()->addCssStatic('assets/css/style.css');
    StaticCss::instance()->addCssStatic('assets/css/messages.css');
    StaticCss::instance()->addCssStatic('assets/css/forms.css');
    StaticCss::instance()->addCssStatic('assets/css/ie.css', 'lte IE 9');
    StaticCss::instance()->addCssStatic('assets/css/custom.css');
	StaticCss::instance()->addCss("assets/css/jquery.ui.autocomplete.custom.css");
    StaticCss::instance()->addCss("assets/css/jquery-ui-1.8.13.custom.css");
    StaticCss::instance()->addCss('http://fonts.googleapis.com/css?family=Artifika&subset=latin');

    // Add JS
    StaticJs::instance()->addJs('assets/js/jquery.tools.min.js');
    StaticJs::instance()->addJs('assets/js/jquery.tables.js');
    StaticJs::instance()->addJs('assets/js/jquery.ui.min.js');
    StaticJs::instance()->addJs('assets/js/global.js');
    StaticJs::instance()->addJs('assets/js/html5.js', 'lt IE 9');
    StaticJs::instance()->addJs('assets/js/PIE.js', 'lt IE 9');
    StaticJs::instance()->addJs('assets/js/ie.js', 'lt IE 9');
  }

  // Before the child class is implemented
  public function after() {
    // Get template items
    $this->template->metas = implode(NULL, $this->metas);
    $this->template->links = implode(NULL, $this->links);
    $this->template->css = StaticCss::instance()->getCssAll();
    $this->template->js = StaticJs::instance()->getJsAll();
    $this->template->title = $this->title;
    $this->template->widgets = implode(NULL, $this->widgets);


    // Get template regions
    $this->template->back_to_top = $this->back_to_top;
    $this->template->aside_left = $this->aside_left;
    $this->template->header = $this->header;
    $this->template->footer = $this->footer;
    $this->template->gmap = $this->gmap;


	// Template header content
	$this->template->content->header_tools = view::factory('_blocks/header_tools', $this->data);
	$this->template->content->header_title = view::factory('_blocks/header_title', $this->data);
    // Parent
    parent::after();
  }

  // Get all necessary data (eventually cache)
  private function data() {
    // Data array
    $data = array();

    // Get all countries
    $collection = Mongo_Collection::factory('place');
    $collection->find(array('type' => 'country', 'valid' => TRUE));
    $collection->fields(array('code', 'name'));
    $collection->load();
    $documents = $collection->as_array();
    $countries = array();
    foreach ($documents as $document) {
      $countries[$document->code] = __($document->name);
    }
    asort($countries);
    $data['countries'] = $countries;


    // Get all currencies
    $collection = Mongo_Collection::factory('currency');
    $collection->find(array('valid' => TRUE));
    $collection->sort(array('symbol' => 1));
    $collection->fields(array('iso', 'symbol'));
    $documents = $collection->as_array();
    $currencies = array();
    foreach ($documents as $document) {
      $currencies[$document->iso] = $document->symbol;
    }
    
    $data['currencies'] = $currencies;
    $data['sectors'] = KData::getFirmsSectors();
	$data['event_categories'] = KData::allEventsCategories();
    

    // Return data
    return $data;
  }

  // Get actual user
  private function user() {
    $user = Mongo_Document::factory('user');
    $user->load('4dbfc444820e649302000002');
    //$user = new Model_User('4dbfc444820e649302000002');

    global $logged_user;
    $logged_user = $user;

    return $user;
  }

  // Get periods
  private function periods() {
    $today   = new DateTime(date('Y') .'-'. date('m') .'-'. date('d'));
    $date    = $today;
    $ts      = $today->getTimestamp();
    $periods = array();

    $periods[0] = __('Anytime');
    $date = date_sub($today, date_interval_create_from_date_string('1 day'));
    $periods[$ts - $date->getTimestamp()] = __('1 day ago');
    $date = date_sub($today, date_interval_create_from_date_string('3 days'));
    $periods[$ts - $date->getTimestamp()] = __('3 days ago');
    $date = date_sub($today, date_interval_create_from_date_string('1 week'));
    $periods[$ts - $date->getTimestamp()] = __('1 week ago');
    $date = date_sub($today, date_interval_create_from_date_string('1 month'));
    $periods[$ts - $date->getTimestamp()] = __('1 month ago');
    $date = date_sub($today, date_interval_create_from_date_string('3 months'));
    $periods[$ts - $date->getTimestamp()] = __('3 months ago');

    return $periods;
  }

  // Get countries and categories for existing events
  private function events_countries_categories() {
    $collection = Mongo_Collection::factory('event');
    $documents = $collection->find()->as_array();

    $result = array();
    foreach ($documents as $document) {
      $result[$document->_place_country->code]['country']['id'] = (string) $document->_place_country->id;
      $result[$document->_place_country->code]['country']['name'] = __($document->_place_country->name);
      $result[$document->_place_country->code]['country']['code'] = $document->_place_country->code;
      $result[$document->_place_country->code]['groups']['name'] = $document->_category->group;
      $result[$document->_place_country->code]['groups']['categories'][(string)$document->_category->id] = $document->_category->category;
    }

    asort($result);
    return $result;
  }

  // Get countries for existing events
  private function events_countries() {

    $collection = Mongo_Collection::factory('event');
    $documents = $collection->find()->as_array();

    $result = array();
    foreach ($documents as $document) {
      $result[$document->_place_country->code] = __($document->_place_country->name);
    }

    asort($result);
    return ($result);
  }

  // Get browser language
  private function getBrowerLanguage() {
    $parts = explode(',', $_SERVER["HTTP_ACCEPT_LANGUAGE"]);
    $language = $parts[0];
    return $language;
  }
}

