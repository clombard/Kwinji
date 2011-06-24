<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');
class Controller_User extends Controller_Site {


	// Display user_card
	public function display_user_card($document) {
		return View::factory('user/items/card', array('user' => $document))->render();
	}

	// Display a list of accepted contact
	public function display_overview_contacts_accepted($documents) {
		$more = (count($documents) > 4);
		$documents = array_slice($documents, 0, 4);

		$items = array();
		foreach ($documents as $document) {
			$items[] = View::factory('user/items/overview_contact_accepted', array('user' => $document))->render();
		}
		$list = HTML::item_list($items);
		return View::factory('user/lists/overview_contacts_accepted', array('content' => $list, 'more' => $more))->render();
	}


	// Display a list of potential contact
	public function display_overview_contacts_potential($documents) {
		$more = (count($documents) > 4);
		$documents = array_slice($documents, 0, 4);

		$items = array();
		foreach ($documents as $document) {
			$items[] = View::factory('user/items/overview_contact_potential', array('user' => $document))->render();
		}
		$list = HTML::item_list($items);
		return View::factory('user/lists/overview_contacts_potential', array('content' => $list, 'more' => $more))->render();
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
		$this->title .= __('Overview : View all your informations');

		// GET DUMMY ID
		$user = new Model_User('4dbaae03820e640907000005');

		// Content data
		$this->data = array(
      'user' => $user,
      'contacts_accepted' => $this->display_overview_contacts_accepted($user->dataOverviewContactsAcceptedOverview()),
      'contacts_potential' => $this->display_overview_contacts_potential($user->dataOverviewContactsAcceptedOverview()),
      'events' => $this->display_overview_events($user->dataOverviewEvents()),
      'offers' => $this->display_overview_offers($user->dataOverviewOffers()),
      'resumes' => $this->display_overview_resumes($user->dataOverviewResumes()),
      'news' => $this->display_overview_news($user->dataOverviewNews()),
		);
		$this->template->content = view::factory('user/overview', $this->data);


		// Left column
		$this->data['user_card'] = $this->display_user_card($user);
		$this->template->aside_left = View::factory('site/regions/aside_left', $this->data);

		// Header
		$this->data['header_tools'] = NULL;
		$this->template->content->header_tools = view::factory('_blocks/header_tools', $this->data);
	}

	public function action_edit($id = NULL) {
		// Add specifics JS and CSS
		StaticCss::instance()->addCss("assets/css/jquery.Jcrop.css");
		StaticCss::instance()->addCss("assets/css/jquery.fileupload-ui.css");
		StaticJs::instance()->addJs("assets/js/jquery.Jcrop.min.js");
		// Template
		$this->template = View::factory('site/layouts/layout_default');
		if ($id != NULL) {}

		// Template content
		$this->template->content = view::factory('user/edit', $this->data);

		// Template aside left
		$this->aside_left = View::factory('site/regions/aside_left_settings', $this->data);
	}

	public function action_index() {
		// Template
		$this->template = View::factory('site/layouts/layout_previewpane');

		// Template aside left
		$this->template->aside_left = View::factory('site/regions/aside_left');

		// Template footer
		$this->template->footer = View::factory('site/regions/footer');


		// Template content
		$this->template->content = view::factory('user/profile', $this->data);
		// Specific header content
		$this->template->content->header_tools = view::factory('_blocks/header_tools', $this->data);

		// Specific header content
		$this->template->content->header_tools = view::factory('_blocks/header_tools', $this->data);
	}

	/**
	 * 
	 * User's resume view
	 * @param userId $id
	 */
	public function action_view($id) {
		// Current User
		global $logged_user;
		
		// Retrieve user
		$user = new Model_User($id);
		// Get default user resume
		$resume = KData::getUserDefaultResume($user->id);
		$this->data['resume'] = $resume;

		// Title Page
		$title = ($resume->_user->id == $logged_user->id)? __("My i-Profile") : __(":username's i-Profil", array(":username" => $resume->_user->displayname));
		$this->title .= $title;
		$this->data['header_title'] = Controller_Resume::header_title($user, NULL, $title);
		
		// Add a specific JS and CSS for tables
		StaticCss::instance()->addCss("assets/css/jquery.jgrowl.css");
		
		// Auto-complete tag
		StaticJs::instance()->addJs("assets/js/jquery-ui-1.8.autocomplete.min.js");
		StaticJs::instance()->addJs("assets/js/jquery-ui-1.8.core-and-interactions.min.js");
		StaticJs::instance()->addJs("assets/js/jquery.tag-it.js");
		StaticJs::instance()->addJs("assets/js/kwinji.tag-it.js");
		StaticJs::instance()->addJs("assets/js/kwinji.autocomplete.js");
		
		// Notification Pop-up
		StaticJs::instance()->addJs("assets/js/jquery.jgrowl.js");
  
		// Widgets
		StaticJs::instance()->addJs('assets/js/kwinji.forms.widgets.js');
		StaticJs::instance()->addJs('assets/js/kwinji.forms.validator.js');
		
		// Ajax post
		StaticJs::instance()->addJs("assets/js/kwinji.ajax.js");
		
		// Grapics
		StaticJs::instance()->addJs('assets/js/highcharts/js/highcharts.js');
		StaticJs::instance()->addJs('assets/js/highcharts-utils.js');

		// Default Form Data
		$post = array(
			'country' => $logged_user->_place_country->code,
			'city' => $logged_user->_place_city->name,
			'zip' => $logged_user->_place_city->code,
		);
		
		// Widget Data to autosuggest
		$this->data['industries'] = KData::getFirmsSectors();
		$this->data['graduations'] = KData::offersGraduations();
		$this->data['skills'] = KData::resumeSkillsList($resume->skills);
		$this->data['post'] = $post;
		
		// Add Widgets
		$this->widgets[] = View::factory('widget/resume_add_experience', $this->data);
		$this->widgets[] = View::factory('widget/resume_add_graduation', $this->data);
		$this->widgets[] = View::factory('widget/resume_add_hobbie', $this->data);
		$this->widgets[] = View::factory('widget/resume_add_keyword', $this->data);
		$this->widgets[] = View::factory('widget/resume_add_training', $this->data);
		$this->widgets[] = View::factory('widget/resume_add_skill', $this->data);
		$this->widgets[] = View::factory('widget/resume_edit_skill', $this->data);
		$this->widgets[] = View::factory('widget/confirm', $this->data);
		
		// Template
		$this->template = View::factory('site/layouts/layout_default');

		
		$visitor = $this->data['user']->id != $resume->_user->id;
		// Template aside left
		if ($visitor) {
			$this->aside_left = View::factory('site/regions/aside_left_visitor', $this->data);
		}
		// Data Header tools
		$this->data['header_tools'] = Controller_Resume::header_tools($visitor, $resume);

		// Template content
		$this->template->content = view::factory('resume/view', $this->data);
	}



	public function action_logout() {
		global $user;
		$user = NULL;
		$this->request->redirect('/');
	}


	public function action_login() {
		global $logged_user;

		if (isset($logged_user->id)) {
			$this->request->redirect('dashboard');
		}

		$post = array(
      'mail' => isset($_POST['mail']) ? $_POST['mail'] : '',
      'password' => isset($_POST['password']) ? $_POST['password'] : '',
      'agreement' => isset($_POST['agreement']) ? $_POST['agreement'] : 'on',
		);

		// Default message
		Message::info(__('Please fill in all the following fields.'), __('Login to Kwinji Network'));

		// Check authentification
		if (empty($post['mail']) == FALSE && empty($post['password']) == FALSE) {
			if (KAuthenticate::checkGrants($post['mail'], $post['password']) == FALSE) {
				$post = array(
          'mail' => '',
          'password' => '',
				);
				Message::error(__('Unkwnown login / password. Please try again'), __('Login to Kwinji Network'));
			}
			else {
				Message::success(__('Login successful'), __('Login to Kwinji Network'));
				//Request::instance()->redirect('dashboard');
				$this->request->redirect('dashboard');
			}
		}

		// Set page title
		$this->title = __('Kwinji | User login');

		// Load view
		$this->data = array(
      'post' => $post,
		);
		$this->template->content = View::factory('user/login', $this->data);
	}

	public function action_register() {
		$post = array(
      'firstname' => '',
      'lastname' => '',
      'mail' => '',
      'password' => '',
      'password_repeat' => '',
		);

		$this->data = array(
      'post' => $post,
		);

		$this->title = __('Kwinji | User registration');
		Message::info(__('Please fill in all the required fields.'), __('Register now'));
		$this->template->content = View::factory('user/register', $this->data);
	}
}

