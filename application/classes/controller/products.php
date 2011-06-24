<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');
class Controller_Products extends Controller_Kwi {

  public $template = '_templates/products';

  public function action_index() {




    // Add JS
    StaticJs::instance()->addJs('static/js/jquery.tagInput.min.js');
    StaticJs::instance()->addJs('static/js/jquery.wysiwyg.min.js');

    // Set breadcrumbs
    Breadcrumbs::add(Breadcrumb::factory()->set_title(__('Samples')));
    Breadcrumbs::add(Breadcrumb::factory()->set_title(__('Products')));
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
    $this->template->styleproducts = View::factory('styles/products');
    $this->template->preview = View::factory('styles/products_preview');
    $this->template->draft = View::factory('styles/products_draft');
    $this->template->visibility = View::factory('styles/products_visbility');
    $this->template->tags = View::factory('styles/products_tags');
    $this->template->help = View::factory('styles/products_help');
  }
}

