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
	 * @param Array $params
	 */
	public function action_add($params) {
		// Current User
		global $logged_user;

		// Get params
		$p = Parameters::extract($params, NULL, array('fid', 'id'));
		
		// Load data
		$firm = Mongo_Document::factory('firm');
		$firm->load($p->fid);
		
		// Add specific JS
		StaticJs::instance()->addJs('assets/js/kwinji.forms.validator.js');
		StaticJs::instance()->addJs('assets/js/jquery.meiomask.js');
		StaticJs::instance()->addJs('assets/js/kwinji.meiomask.js');

		// Specific title
		$this->title .= __('Add an offer to the network');

		// Template
		$this->template = View::factory('site/layouts/layout_default');

		// Get default post values
		$post = array(
			'title' => NULL,
			'description' => NULL,
			'place' => $firm->street_details,
			'address' => $firm->street,
			'city' => $firm->_place_city->name,
			'country' => $firm->_place_country->name,
			'zip' => $firm->_place_city->code,
			'begin' => time(),
			'end' => time(),
			'endsof' => time(),
			'currency' => $firm->currency,
			'pcondition' => NULL,
			'remuneration' => NULL,
			'graduations' => NULL,
			'contracts' => NULL,
			'user' => $logged_user,
			'sectors' => $firm->industry,
			'experiences' => NULL,
			'jobs' => NULL,
			'firm' => $firm,
		);
		
		// Check 
		if (isset($_POST)) {
			$post = array_merge($post, $_POST);
		}

		// Data content
		$this->data += array(
			'pcondition' => NULL,
			'header_tools' => $this->header_tools(),
			'graduations' => KData::offersGraduations(),
			'experiences' => KData::experiencesLevels(),
			'sectors' => KData::getFirmsSectors(),
			'contracts' => KData::offersContracts(),
			'job_types' => KData::offersTypes(),
			'post' => $post,
		);
		
		// Firm exist ?
		if ($firm->loaded()) {
			$this->data += array(
				'firm' => $firm,
				'header_title' => Controller_Firm::header_title($firm, strtoupper($firm->name)),
			);
			$post['firm'] = new Model_Firm($p->fid);
		} else {
			// TODO: Throw error
		}

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
				Message::error(__('begin date must be superior or equal to today.'), __('Error occured'));
			}

			if ($end_date <= $begin_date) {
				$error = TRUE;
				Message::error(__('end date must be superior or equal to begin.'), __('Error occured'));
			}

			if ($ends_of_date > $end_date) {
				$error = TRUE;
				Message::error(__('end of date must be inferior to end date.'), __('Error'));
			}

			// Check error
			if ($error) {
				// Show the form with error message
				// Message::error('Error title', json_encode($_POST));
				$this->template->content = View::factory('offer/add', $this->data);
			}
			else {
				// Record in MongoDB
				$offer = Mongo_Document::factory('offer');
				$offer = $this->setOffer($offer, $post);
				$offer->save();
				// Redirect
				Message::success('Everything OK', __('Success'));
				$this->template->content = View::factory('offer/add', $this->data);
			}
		}
		else {
			// Info message
			Message::info(__('Create a new offer for your company'));
			 
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


	private function setOffer($offer, $post) {
		$offer->description = $post['description'];
		$offer->street_details = $post['place'];
		$offer->street = $post['address'];
		$offer->_place_city->name = $post['city'];
		$offer->_place_country->id = $post['country'];
		$offer->set('details.name', $post['title']);
		$offer->zip = $post['zip'];
		$offer->dt_starts = $post['begin'];
		$offer->dt_finishes = $post['end'];
		$offer->dt_endsof = $post['endsof'];
		$offer->remuneration = $post['remuneration'];
		$offer->currency = $post['currency'];
		$offer->graduations = $post['graduations'];
		$offer->experiences = $post['experiences'];
		$offer->jobs = $post['jobs'];
		$offer->sectors = $post['sectors'];
		$offer->set('contracts', $post['contracts']);
		$offer->currency = $post['currency'];
		$offer->dt_updated = time();
		return $offer;
	}

	/**
	 *
	 * Set the header tools menu and define a visitor or administration display.
	 *
	 */
	public static function header_tools() {
		global $logged_user;
		
		$header_tools = array(
			Html::anchor('/offer/settings/' . $logged_user->id, __('Settings') . '<span class="cog"></span>', array('class' => 'button button-gray no-text cog', 'title' => __('Settings'), 'rel' => "#overlay")),
			Html::anchor('/offer/infos', __('Infos') . '<span class="help"></span>', array('class' => 'button button-gray no-text help', 'title' => __('Infos'), 'rel' => "#overlay")),
			);
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
	public static function header_title($user, $url = NULL, $title) {
		$header_title['url'] = '#';
		$header_title['title'] = $title;
		$header_title['titles'] = array();
		return $header_title;
	}
	
	private function getContentHeader() {
		$header = array(
			"type" => 'multiple',
			'title' => __("Offer"),
			'url' => "offer/add",
			'titles' => array(
				array(
					"content" => "Add Offer",
					"url" => "offer/add",
				),
				array(
					"content" => "All Offers",
					"url" => "offer/all",
				),
			),
		);
		return $header;
	}
}

