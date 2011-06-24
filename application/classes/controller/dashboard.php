<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');
class Controller_Dashboard extends Controller_Site {

  public function action_index() {
    // Add specific JS and CSS
    StaticJs::instance()->addJs("assets/js/jquery.elastic.js");
    StaticJs::instance()->addJs("assets/js/kwinji.elastic.js");
    StaticJs::instance()->addJs("assets/js/kwinji.comment.js");
    StaticJs::instance()->addJs("assets/js/jquery.jgrowl.js");
    StaticCss::instance()->addCss("assets/css/jquery.jgrowl.css");
    StaticJs::instance()->addJs('assets/js/kwinji.forms.widgets.js');
    StaticJs::instance()->addJs("assets/js/kwinji.ajax.js");

    // Specific widgets
    $this->widgets[] = View::factory('widget/confirm');

    // Template
    $this->template = View::factory('site/layouts/layout_previewpane');

    // Specific Title
    $this->title .= __("Dashboard");

    global $logged_user;

    // USER ID
    $id = $logged_user->id;

    // USER COMMENTS
    $this->data['comments'] = KData::getUserComments($id);
    $views = array();
    $hiden_id = NULL;
    $i = 0;
    foreach ($this->data['comments'] as $comment) {
      if ($hiden_id == NULL) {
        $hiden_id = (string)$comment->id;
      }
      $bottom_id = (string)$comment->id;
      $this->data += array(
        'comment' => $comment,
        'hiden_id' => $hiden_id,
        'user' => $logged_user,
        'network_responses_infos' => NULL,
      );

      // Get all subcomments
      $collection = Mongo_Collection::factory('comment');
      $subcomments = $collection->find(array('parent' => $comment->id))->sort(Mongo_Collection::DESC)->as_array();


      $network_responses = array();
      $nb_other_comment  = count($subcomments);
      $subcomments       = array_slice($subcomments, -1, 4);

      foreach ($subcomments as $subcomment) {
        $network_responses[] = View::factory('comment/items/sub_comment', array('comment' => $subcomment));
      }
      $network_responses = implode('', $network_responses);


      $this->data['network_responses'] = $network_responses;
      $this->data['network_input'] = View::factory('comment/items/sub_comment_input', $this->data);


      $this->data += array(
        'subcomments_count' => count($subcomments),
        'nb_other_comment' => $nb_other_comment,
      );


      $views[] = View::factory("comment/items/list_item", $this->data);

      $i++;
    }

    if ($i == 20) {
      $views[] = View::factory("comment/items/see_more", array('bottom_id' => $bottom_id));
    }


    $this->data['all_comments'] = implode('', $views);


    // Template content
    $this->template->content = view::factory('dashboard/dashboard', $this->data);
    $this->template->content->news_feeds = view::factory('comment/content', $this->data);
  }
}

