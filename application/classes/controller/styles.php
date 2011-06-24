<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');
class Controller_Styles extends Controller_Kwi {

  public $template = '_templates/styles';

  public function action_index() {
    // Set breadcrumbs
    Breadcrumbs::add(Breadcrumb::factory()->set_title(__('Styles')));
    Breadcrumbs::add(Breadcrumb::factory()->set_title(__('Basic')));
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
    $this->template->basic = View::factory('styles/basic');
    $this->template->shortcuts = View::factory('styles/basic_shortcuts');
    $this->template->quickinfo = View::factory('styles/basic_quickinfo');
  }
}

