<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');
class Controller_Member extends Controller_Site {

  // Display member_card
  public function display_member_card($document) {
    return View::factory('member/items/card', array('member' => $document))->render();
  }

  // Display a list of accepted contact
  public function display_overview_contacts_accepted($documents) {
    $more = (count($documents) > 4);
    $documents = array_slice($documents, 0, 4);

    $items = array();
    foreach ($documents as $document) {
      $items[] = View::factory('member/items/overview_contact_accepted', array('member' => $document))->render();
    }
    $list = HTML::item_list($items);
    return View::factory('member/lists/overview_contacts_accepted', array('content' => $list, 'more' => $more))->render();
  }

  // Display a list of potential contact
  public function display_overview_contacts_potential($documents) {
    $more = (count($documents) > 4);
    $documents = array_slice($documents, 0, 4);

    $items = array();
    foreach ($documents as $document) {
      $items[] = View::factory('member/items/overview_contact_potential', array('member' => $document))->render();
    }
    $list = HTML::item_list($items);
    return View::factory('member/lists/overview_contacts_potential', array('content' => $list, 'more' => $more))->render();
  }

  // Display a list of my resumes
  public function display_overview_resumes($documents) {
    $items = array();
    foreach ($documents as $document) {
      $items[] = View::factory('resume/items/overview_resume', array('resume' => $document))->render();
    }
    $list = HTML::item_list($items);
    return View::factory('resume/lists/overview_resumes', array('content' => $list))->render();
  }

  // Display a list of my offers
  public function display_overview_offers($documents) {
    $more = (count($documents) > 4);
    $documents = array_slice($documents, 0, 4);

    $items = array();
    foreach ($documents as $document) {
      $items[] = View::factory('offer/items/overview_offer', array('offer' => $document))->render();
    }
    $list = HTML::item_list($items);
    return View::factory('offer/lists/overview_offers', array('content' => $list, 'more' => $more))->render();
  }

  // Display a list of my events
  public function display_overview_events($documents) {
    $more = (count($documents) > 4);
    $documents = array_slice($documents, 0, 4);

    $items = array();
    foreach ($documents as $document) {
      $items[] = View::factory('event/items/overview_event', array('event' => $document))->render();
    }
    $list = HTML::item_list($items);
    return View::factory('event/lists/overview_events', array('content' => $list, 'more' => $more))->render();
  }

  // Display a list of my news
  public function display_overview_news($documents) {
    $more = (count($documents) > 4);
    $documents = array_slice($documents, 0, 4);

    $items = array();
    foreach ($documents as $document) {
      $items[] = View::factory('new/items/overview_new', array('new' => $document))->render();
    }
    $list = HTML::item_list($items);
    return View::factory('new/lists/overview_news', array('content' => $list, 'more' => $more))->render();
  }

  public function action_overview() {
    // Template
    $this->template = View::factory('site/layouts/layout_default');
    $this->title = __('Kwinji | Overview : View all your informations');

    // Template header
    $this->template->header = View::factory('site/regions/header');
    $this->template->header->logo = View::factory('site/blocks/logo');
    $this->template->header->nav_header = View::factory('site/blocks/nav_header');
    $this->template->header->search_header = View::factory('site/blocks/search_header');

    // Template footer
    $this->template->footer = View::factory('site/regions/footer');

    // GET DUMMY ID
    //$member = new Model_member('4dbaae03820e640907000005');
    $member = Mango::factory('member', array('_id' => '4dbf9604820e649502000000'))->load();

    // Content data
    $data = array(
      'member' => $member,
      //'contacts_accepted' => $this->display_overview_contacts_accepted($member->dataOverviewContactsAcceptedOverview()),
      //'contacts_potential' => $this->display_overview_contacts_potential($member->dataOverviewContactsAcceptedOverview()),
      //'events' => $this->display_overview_events($member->dataOverviewEvents()),
      //'offers' => $this->display_overview_offers($member->dataOverviewOffers()),
      //'resumes' => $this->display_overview_resumes($member->dataOverviewResumes()),
      //'news' => $this->display_overview_news($member->dataOverviewNews()),
      'contacts_accepted' => '',
      'contacts_potential' => '',
      'events' => '',
      'offers' => '',
      'resumes' => '',
      'news' => '',
    );

    $this->template->content = view::factory('member/overview', $data);

    // Left column
    $data['member_card'] = $this->display_member_card($member);
    $this->template->aside_left = View::factory('site/regions/aside_left', $data);

    // Header
    $data['header_tools'] = NULL;
    $this->template->content->header_tools = view::factory('_blocks/header_tools', $data);
  }


  public function action_index() {
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
    $data = array();
    $data['member'] = Kmember::get();
    $this->template->content = view::factory('member/profile', $data);
    // Specific header content
    $this->template->content->header_tools = view::factory('_blocks/header_tools', $data);

    // Specific header content
    $this->template->content->header_tools = view::factory('_blocks/header_tools', $data);
  }



  public function action_login() {
    $post = array(
      'mail' => '',
      'password' => '',
    );

    $data = array(
      'post' => $post,
    );

    $this->title = __('Kwinji | member login');
    Message::info(__('Please fill in all the following fields.'), __('Login to Kwinji Network'));
    $this->template->content = View::factory('member/login', $data);
  }

  public function action_register() {
    $post = array(
      'firstname' => '',
      'lastname' => '',
      'mail' => '',
      'password' => '',
      'password_repeat' => '',
    );

    $data = array(
      'post' => $post,
    );

    $this->title = __('Kwinji | member registration');
    Message::info(__('Please fill in all the required fields.'), __('Register now'));
    $this->template->content = View::factory('member/register', $data);
  }
}

