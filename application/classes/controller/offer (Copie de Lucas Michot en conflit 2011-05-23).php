<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');
class Controller_Offer extends Controller_Site {

  /**
   *
   * Retrieve an offer by ID
   *
   * @param OfferId $id
   */
  public function action_view($params) {

    // Get params
    $p = Parameters::extract($params, 'id', 'id');

    // Template
    $this->template = View::factory('site/layouts/layout_default');

    // Data
    $offer = new Model_Offer($p->id);
    $this->data += array(
      'offer' => $offer,
      'header_title' => $this->getContentHeader($p->id),
      'header_tools' => NULL,
    );
    $this->title .= __("Offer : ") . $offer->details['name'];
    $this->template->content = View::factory('offer/view', $this->data);
    // Specific header content
    $this->template->content->header_tools = view::factory('_blocks/header_tools', $this->data);
    $this->template->content->header_title = view::factory('_blocks/header_title', $this->data);
  }

  /**
   *
   * Add an Offer for Company / School / User
   *
   * @param MongoId $id
   */
  public function action_add($id = NULL) {

    // Add specific JS
    StaticJs::instance()->addJs('assets/js/kwinji.forms.validator.js');
    StaticJs::instance()->addJs('assets/js/jquery.meiomask.js');
    StaticJs::instance()->addJs('assets/js/kwinji.meiomask.js');

    // Specific title
    $this->title .= __('Add an offer to the network');

    // Template
    $this->template = View::factory('site/layouts/layout_default');

    // Server variable of the User
    global $logged_user;

    // Get default post values
    $post = array(
      'title' => NULL,
      'description' => NULL,
      'place' => NULL,
      'address' => NULL,
      'city' => NULL,
      'zip' => NULL,
      'begin' => NULL,
      'end' => NULL,
      'endsof' => NULL,
      'currency' => NULL,
      'pcondition' => NULL,
      'remuneration' => NULL,
      'graduations' => NULL,
      'sectors' => NULL,
      'experiences' => NULL,
      'jobs' => NULL,
    );
    if (isset($_POST)) {
      $post = array_merge($post, $_POST);
    }

    // Data content
    $this->data += array(
      'country_default' => $logged_user->_place_country->code,
      'pcondition' => NULL,
      'header_title' => Controller_Firm::getContentHeader($id),
      'header_tools' => NULL,
      'graduations' => KData::offersGraduations(),
      'experiences' => KData::experiencesLevels(),
      'sectors' => KData::getFirmsSectors(),
      'contracts' => KData::offersContracts(),
      'job_types' => KData::offersTypes(),
      'post' => $post,
    );

    // If $_POST; check existance of key valid (form::button in post)
    if (array_key_exists('valid', $_POST)) {
      // Error test
      $error = FALSE;

      // Check begin date
      $today_date = mktime(0, 0, 0, date('n'), date('j'), date('Y'));

      $parts = explode('/', $_POST['begin']);
      $begin_date = mktime(0, 0, 0, $parts[0], $parts[1], $parts[2]);

      $parts = explode('/', $_POST['end']);
      $end_date = mktime(0, 0, 0, $parts[0], $parts[1], $parts[2]);

      $parts = explode('/', $_POST['endsof']);
      $ends_of_date = mktime(0, 0, 0, $parts[0], $parts[1], $parts[2]);

      // Check begin date
      if ($begin_date < $today_date) {
        $error = TRUE;
        Message::error(__('begin date must be superior or equal to today.'), __('Error'));
      }

      if ($end_date <= $begin_date) {
        $error = TRUE; 
        Message::error(__('end date must be superior or equal to begin.'), __('Error'));
      }

      if ($ends_of_date > $end_date) {
        $error = TRUE;
        Message::error(__('Error'), __('end of date must be inferior to en d date.'), __('Error'));
      }

      // Check error
      if ($error) {
        // Show the form with error message
        //Message::error('Error title', json_encode($_POST));
        $this->template->content = View::factory('offer/add', $this->data);
      }
      else {
        // Record in MongoDB
        // Redirect
        Message::success('Everything OK', __('Success'));
        $this->template->content = View::factory('offer/add', $this->data);
      }
    }
    else {
      // Info message
      Message::info(__('Create a new offer', __('Info')));
           
      // Never submitted
      $this->template->content = View::factory('offer/add', $this->data);
    }

    // Specific header content
    $this->template->content->header_tools = view::factory('_blocks/header_tools', $this->data);
    $this->template->content->header_title = view::factory('_blocks/header_title', $this->data);
  }

  /**
   *
   * Delete offer
   *
   * @param Object $params
   */
  public function action_delete($params) {
    // Get params
    $p = Parameters::extract($params, 'id', 'id');

    // Delete this record
    $offer = new Model_Offer($p->id);
    $offer->delete();
    $message = __("Offer has been deleted");
    $response = array(
      'message' => $message,
    );

    echo json_encode($response);
    return;
  }


  private function getContentHeader($id) {
    $firm = new Model_Firm($id);
    $header = array(
      "type" => 'multiple',
      'title' => strtoupper($firm->name),
      'url' => "firm/view/". $id,
      'titles' => array(
        array(
          "content" => "Add news",
          "url" => "add_news/". $id,
        ),
        array(
          "content" => "Add event",
          "url" => "add_event/". $id,
        ),
        array(
          "content" => "Add announce",
          "url" => "../offer/add/". $id,
        ),
        array(
          "content" => "Add contact",
          "url" => "add_contact/". $id,
        ),
      ),
    );
    return $header;
  }
}

