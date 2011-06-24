<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');
class Controller_Search extends Controller_Site {


  public function action_index() {
    // Template
    $this->template = View::factory('site/layouts/layout_default');
    $this->title .= __('Search Members');

    // Content data
    $this->data += array(
      'header_tools' => NULL,
      'expertise_area' => KData::getExpertiseAreas(),
      'languages' => KData::getResumesLanguages(),
    );
    $this->template->content = view::factory('search/index', $this->data);
    $this->template->content->tab_all_members = View::factory("search/tab_all_members", $this->data);
    $this->template->content->tab_freelance = View::factory("search/tab_freelance", $this->data);
    $this->template->content->tab_offer = View::factory("search/tab_offer", $this->data);
    $this->template->content->tab_event = View::factory("search/tab_event", $this->data);
    $this->template->content->tab_alumni = View::factory("search/tab_alumni", $this->data);
    $this->template->content->tab_quick = View::factory("search/tab_quick", $this->data);
  }

  public function action_result() {
    // Template
    $this->template = View::factory('site/layouts/layout_previewpane');
    $this->title .= __('Result Research');
    $this->data += array(
      'header_tools' => NULL,
    );
    $this->template->content = view::factory('search/result/user_result', $this->data);
    $this->template->content->ads = View::factory('_blocks/ads', $this->data);
  }
}

