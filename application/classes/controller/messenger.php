<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');
class Controller_Messenger extends Controller_Site {

  public function action_view($id) {
    // Template
    $this->template = View::factory('site/layouts/layout_previewpane');

    // Template content
    $this->template->content = view::factory('messenger/view', $this->data);

    // Specific header content
    $this->template->content->header_tools = view::factory('_blocks/header_tools', $this->data);
  }


  public function action_index() {
    // Add specific JS
    StaticJs::instance()->addJs('assets/js/kwinji.forms.widgets.js');
    // Specific widgets
    $this->widgets[] = View::factory('widget/new_message');

    // Template
    $this->template = View::factory('site/layouts/layout_previewpane');
    $this->title .= __('Messenger');

    // Template content
    $this->data['header_tools'] = NULL;
    $this->template->content = View::factory('messenger/index', $this->data);

    // Specific header content
    $this->template->content->header_tools = view::factory('_blocks/header_tools', $this->data);
  }
}

