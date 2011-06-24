<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');
class Controller_Widget extends Controller_Site {

  public function action_display($id) {
    $widget = View::factory('widget/'. $id);
    $this->response->body($widget);
  }

  public function action_attendees($event_id) {
    $this->template = View::factory('site/layouts/layout_empty');
    $this->data['list_contacts'] = KData::getEventAttendees($event_id);
    $this->template->content = View::factory('widget/contacts', $this->data);
  }
}

