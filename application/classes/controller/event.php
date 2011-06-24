<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');
class Controller_Event extends Controller_Site {

	public function action_index() {
		global $logged_user;
		
		// Template
		$this->template = View::factory('site/layouts/layout_previewpane');

		// Window title
		$this->title .= __("My events");

		global $logged_user;

		// USER ID
		$id = $logged_user->id;

		$this->data += array(
	      'my_events' => KData::getUserEvents($id),
	      'header_title' => $this->header_title($this->data['user'], 'event/index', __("My events")),
	      'header_tools' => $this->header_tools(FALSE, $this->data['user']),
		);

		$this->template->content = View::factory('event/index', $this->data);
	}

	public function action_calendar($id) {
		// Default ID
		$id = 123224;

		// Add specific JS & CSS calendar
		StaticJs::instance()->addJs('assets/js/fullcalendar.js');
		StaticJs::instance()->addJs('assets/js/gcal.js');
		StaticJs::instance()->addJs('assets/js/kwinji.calendar.js');
		StaticCss::instance()->addCss('assets/css/fullcalendar.css');

		// Template
		$this->template = View::factory('site/layouts/layout_previewpane');

		$this->data = array(
      'header_title' => self::getContentHeader($id),
      'header_tools' => NULL,
		);
		$this->template->content = View::factory('event/calendar', $this->data);
		// Specific header content
		$this->template->content->header_tools = view::factory('_blocks/header_tools', $this->data);
		$this->template->content->header_title = view::factory('_blocks/header_title', $this->data);
	}

	public function action_view($id) {
		// Add specific JS
		StaticJs::instance()->addJs("assets/js/kwinji.googlemap.js");
		StaticJs::instance()->addJs('assets/js/kwinji.forms.widgets.js');
		StaticJs::instance()->addJs("http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=TRUE&amp;key=ABQIAAAAv8p834VqVWf-aRjmsWJ7ThTTMQXTo1dCQXMQsfv9m0aaB3o-UxSDNwj9-lLlfUop-mpbWbIU__fA-w");

		// Parameters
		//		$id = Parameters::extract($params, 'id', NULL);

		// Template
		$this->template = View::factory('site/layouts/layout_default');
		//		$this->gmap = 'onload="initialize()" onunload="GUnload()"';

		// Template content
		global $logged_user;

		$event = new Model_Event($id);
		$visitor = $this->data['user']->id != $event->_user->id;
		
		$this->data += array(
	      'his_events' => KData::getUserEvents($event->_user->id),
	      'header_title' => $this->header_title($logged_user, "#", $event->name),
	      'header_tools' => $this->header_tools($visitor, $this->data['user']),
	      'event' => $event,
		);
		$author_contacts = KData::getUserContactsAccepted($event->_user->id);
		$contacts_view = View::factory('widget/contacts', array('list_contacts' => $author_contacts, 'user' => $this->data['user']));

		// Specific widgets
		$this->widgets[] = $contacts_view;

		// Window Title
		$this->title .= __("Event") ." : ". $event->name;

		$this->template->content = View::factory('event/view', $this->data);
		// Specific header content
		$this->template->content->header_tools = view::factory('_blocks/header_tools', $this->data);
		$this->template->content->header_title = view::factory('_blocks/header_title', $this->data);
	}

	public function action_view_attendees($id) {}

	public function action_all($country_id = NULL, $type = 'none', $category_id = 0) {
		global $logged_user;

		// Get selected country (or user country)
		if ($country_id == NULL) {
			$country_id = $logged_user->_place_country->code;
		}




		// Set block title
		$all_event_title = __("All Events");

		// Set data
		$this->data += array(
			'all_event_title' => $all_event_title,
			'country_id' => $country_id,
			'type' => $type,
			'category_id' => $category_id,
			'filters' => $this->data['events_countries_categories'],
		);

		// Template
		$this->template = View::factory('site/layouts/layout_previewpane');

		// Template content
		$this->template->content = View::factory('event/all', $this->data);
		$this->template->content->header_tools = view::factory('_blocks/header_tools', $this->data);
		$this->template->content->header_title = view::factory('_blocks/header_title', $this->data);
	}

	public function action_edit($params) {
		// Server variable of the User
		global $logged_user;

		// Title
		$this->title .= "Add new Post";

		// Get params
		$p = Parameters::extract($params, 'id', 'id');

		// Add specific JS
		//StaticJs::instance()->addJs("assets/js/jquery.meiomask.js");
		//StaticJs::instance()->addJs("assets/js/kwinji.meiomask.js");

		StaticJs::instance()->addJs("assets/js/jquery-ui-1.8.autocomplete.min.js");
		StaticJs::instance()->addJs("assets/js/jquery-ui-1.8.core-and-interactions.min.js");
		StaticJs::instance()->addJs("assets/js/jquery.tag-it.js");
		StaticJs::instance()->addJs("assets/js/kwinji.tag-it.js");

		StaticJs::instance()->addJs("assets/js/kwinji.forms.validator.js");
		StaticJs::instance()->addJs('assets/js/kwinji.forms.widgets.js');
		StaticJs::instance()->addJs("assets/js/kwinji.ajax.js");

		StaticJs::instance()->addJs("assets/js/jquery-ui-1.8.13.custom.min.js");
		StaticJs::instance()->addJs("assets/js/jquery-ui-timepicker-addon.js");
		StaticJs::instance()->addJs("assets/js/kwinji.datetimepicker.js");

		// Template
		$this->template = View::factory('site/layouts/layout_default');

		// Find news to edit
		$event = Mongo_Document::factory('event');
		$event->load($p->id);

		// Check that the event exists
		if($event->loaded() == false) {
			// throw event erreor 404
		}

		// Load Form inputs
		$post = array(
			'id' => $p->id,
			'title' => $event->name,
			'teaser' => $event->teaser,
			'description' => $event->content,
			'tags' => isset($event->keywords) && $event->keywords != NULL ? json_encode($event->keywords) : json_encode(array()),
			'begin' => KDate::display($event->dt_starts, KDate::FMT_DATE_TIME),
			'category' => $event->_category->id,
			'end' => KDate::display($event->dt_finishes, KDate::FMT_DATE_TIME),
			'endsof' => $event->dt_register_ends,
			'attendees' => $event->attendees_max_count,
			'contribution' => $event->contribution,
			'place' => $event->street_details,
			'address' => $event->street,
			'city' => $event->_place_city->name,
			'zip' => $event->zip,
			'country' => $event->_place_country->code,
			'currency' => $event->currency,
			'image' => NULL,
			'user' => $event->_user,
		);

		// Add new contributor.
		if($event->_user->id != $logged_user->id && !in_array($event->user, (array)$event->users)) {
			$post['users'] = $event->_user;
		}

		// Check is a Firm post.
		if ($event->_firm != null) {

			$this->data += array(
				'firm' => $event->_firm,
				'header_title' => Controller_Firm::getContentHeader($event->_firm->id),
			);

			$post['firm'] = $event->_firm->id;

		} else $this->data['header_title'] = $this->header_tools($event->_user->id != $this->data['user']->id, $event->_user->id);


		// Data Header tools
		$this->data['header_tools'] = $this->header_tools($event->_user->id != $this->data['user']->id, $event->_user->id);
		$this->data['post'] = $post;

		// Template specific content
		$this->template->content = view::factory('event/add', $this->data);

		// Widgets
		$this->widgets[] = View::factory('widget/firm_add_contact', $this->data);
	}


	/**
	 *
	 * Add an event
	 */
	public function action_add($params) {
		// Current User
		global $logged_user;

		// Get params
		$p = Parameters::extract($params, NULL, array('fid', 'id'));

		// Add specific JS
		//StaticJs::instance()->addJs("assets/js/jquery.meiomask.js");
		//StaticJs::instance()->addJs("assets/js/kwinji.meiomask.js");

		StaticJs::instance()->addJs("assets/js/jquery-ui-1.8.autocomplete.min.js");
		StaticJs::instance()->addJs("assets/js/jquery-ui-1.8.core-and-interactions.min.js");
		StaticJs::instance()->addJs("assets/js/jquery.tag-it.js");
		StaticJs::instance()->addJs("assets/js/kwinji.tag-it.js");

		StaticJs::instance()->addJs("assets/js/jquery-ui-1.8.13.custom.min.js");
		StaticJs::instance()->addJs("assets/js/jquery-ui-timepicker-addon.js");
		StaticJs::instance()->addJs("assets/js/kwinji.datetimepicker.js");

		StaticJs::instance()->addJs("assets/js/kwinji.forms.validator.js");
		StaticJs::instance()->addJs('assets/js/kwinji.forms.widgets.js');
		StaticJs::instance()->addJs("assets/js/kwinji.ajax.js");

		// Title page
		$this->title .= __("Add a new event");

		// Template
		$this->template = View::factory('site/layouts/layout_default');

		// Check is a Firm post.
		$firm = Mongo_Document::factory('firm');
		$firm->load($p->fid);
		
		// Get default post values
		$post = array(
			'id' => NULL,
			'title' => NULL,
			'teaser' => NULL,
			'description' => NULL,
			'category' => NULL,
			'tags' => NULL,
			'begin' => KDate::display(time(), KDate::FMT_DATE_TIME),
			'end' => KDate::display(time(), KDate::FMT_DATE_TIME),
			'endsof' => time(),
			'attendees' => NULL,
			'contribution' => NULL,
			'place' => $firm->street_details,
			'address' => $firm->street,
			'city' => $firm->_place_city->name,
			'zip' => $firm->_place_city->code,
			'country' => $firm->_place_country->code,
			'currency' => $firm->currency,
		);

		if ($firm->loaded() == TRUE) {
			// Add Data-view for company
			$this->data['company'] = $firm;
			$this->data['firm'] = $firm;
			$post['firm'] = $firm->id;

			$this->data += array(
				'firm' => $firm,
				'header_title' => Controller_Firm::header_title($firm, strtoupper($firm->name)),
			);

		} else {
			$this->data['header_title'] = $this->header_title($logged_user, __('Add new event'));
		}
		$this->data['header_tools'] = NULL;
		$this->data['post'] = $post;

		if (isset($_POST)) {
			$post = array_merge($post, $_POST);
		}
		// If $_POST; check existance of key valid (form::button in post)
		if (array_key_exists('valid', $_POST)) {
			// Error test
			$error = FALSE;

			// Check begin date
			$today_date = time();

			$begin = strtotime($_POST['begin']);
			$end = strtotime($_POST['end']);
			$endsof = strtotime($_POST['endsof']);

			// Check begin date
			if ($begin < $today_date) {
				$error = TRUE;
				Message::error(__('Begin date must be superior or equal to today.'), __('Error occured'));
			}

			if ($end <= $begin) {
				$error = TRUE;
				Message::error(__('End date must be superior or equal to begin.'), __('Error occured'));
			}

			if ($endsof > $end) {
				$error = TRUE;
				Message::error(__('Registration ends must be inferior to end date.'), __('Error'));
			}

			if ($endsof < $today_date) {
				$error = TRUE;
				Message::error(__('Registration ends must be superior to Today.'), __('Error'));
			}

			// Check error
			if ($error) {
				// Show the form with error message
				$this->data['post'] = $post;
				$this->template->content = View::factory('event/add', $this->data);
			} else {
				// Record in MongoDB
				$event = Mongo_Document::factory('event');
				if ($_POST['event_id'] != NULL)
				$event->load($_POST['event_id']);

				// Load Bean
				$event = $this->setEvent($event, $post);
				$event->save();

				// Redirect
				$this->request->redirect('firm/view/id/' . $event->_firm->id . "#tabs-4");
				// $this->template->content = View::factory('firm/view/' . $event->_firm->id, $this->data);
			}
		} else {
			// Info message
			Message::info(__('Create a new post for your company'), __("Add new Post"));
		}

		// Widgets
		$this->widgets[] = View::factory('widget/firm_add_contact', $this->data);

		// Template content
		$this->template->content = View::factory('event/add', $this->data);

		// Specific header content
		$this->template->content->header_tools = view::factory('_blocks/header_tools', $this->data);
		$this->template->content->header_title = view::factory('_blocks/header_title', $this->data);
	}

	/**
	 *
	 * Load Bean "Event" with post values.
	 * @param MongoObject $event
	 * @param array $post
	 */
	private function setEvent($event, $post) {
		$event->name				= $post['title'];
		$event->teaser				= $post['teaser'];
		$event->content				= $post['description'];
		$event->dt_starts			= strtotime($post['begin']);
		$event->dt_finishes			= strtotime($post['end']);
		$event->dt_register_ends	= strtotime($post['endsof']);
		$event->attendees_max_count = $post['attendees'];
		$event->contribution		= $post['contribution'];
		$event->category			= $post['category'];
		$event->street				= $post['address'];
		$event->street_details		= $post['place'];
		$event->place_city			= $post['city'];
		$event->zip					= $post['zip'];
		$country = KData::getCountry($post['country']);
		$event->place_country		= $country->id;
		$event->firm				= isset($event->_firm) ? $event->_firm : $this->data['user']->_firm->id;
		$event->keywords 			= isset($post['item']) ? $post['item']['tags'] : array();
		$event->user 				= isset($event->_user) ? $event->_user : $this->data['user']->id;
		/*		if (count((array)$event->_users) == 0) $event->_users = array();
		 if (!in_array($this->data['user']->id, (array)$event->_users) && $event->_user != $this->data['user'])
			$event->addToSet('_users', $this->data['user']);
			*/		$event->dt_created 			= time();
		$event->dt_published		= time();
		$event->dt_updated 			= time();
		return $event;
	}



	/**
	 *
	 * Set the header tools menu and define a visitor or administration display.
	 * True = visitor view
	 *
	 *
	 * @param Boolean $visitor
	 * @param Model_User $user
	 */
	public static function header_tools($visitor = TRUE, $user = NULL) {
		if ($visitor) {
			$header_tools = array(
			Html::anchor('/user/add_watchlist/' . $user->id, __('Add to watchlist') . '<span class="star"></span>', array('class' => 'button button-gray no-text star', 'title' => __('Add to watchlist'))),
			Html::anchor('/user/add_contact/' . $user->id, __('Add as contact') . '<span class="user_add"></span>', array('class' => 'button button-gray no-text user_add', 'title' => __('Add as contact'))),
			Html::anchor('/messenger/send_mail/' . $user->id, __('Send mail') . '<span class="email"></span>', array('class' => 'button button-gray no-text email', 'title' => __('Send mail'))),
			Html::anchor('/resume/add_contact', __('Graphic view') . '<span class="chart_bar"></span>', array('class' => 'button button-gray no-text chart_bar', 'title' => __('Graphic view'))),
			);
		} else {
			$header_tools = array(
			Html::anchor('/event/add', __('Add event') . '<span class="add"></span>', array('class' => 'button button-gray no-text add', 'title' => __('Add event'))),
			Html::anchor('/event/settings/' . $user->id, __('Settings') . '<span class="cog"></span>', array('class' => 'button button-gray no-text cog', 'title' => __('Settings'), 'rel' => "#overlay")),
			Html::anchor('/event/infos', __('Infos') . '<span class="help"></span>', array('class' => 'button button-gray no-text help', 'title' => __('Infos'), 'rel' => "#overlay")),
			);
		}
		return $header_tools;
	}


	/**
	 *
	 * Set the header titles navigation menu 
	 *
	 * @param Model_User $user
	 * @param String $url
	 * @param String $title
	 */
	public static function header_title($user, $url, $title) {
		$header_title['titles'] = array(
		Html::anchor('/event/all', __('View all events') . '<span class="star"></span>', array('class' => '')),
		);
		$header_title['url'] = $url;
		$header_title['title'] = $title;
		return $header_title;
	}
}

