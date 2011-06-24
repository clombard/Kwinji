<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');
class Controller_Firm extends Controller_Site {

	public function action_view($params) {
		global $logged_user;
		// Get params
		$p = Parameters::extract($params, 'id', 'id');

		// Add a specific JS and CSS for tables
		StaticCss::instance()->addCss("assets/css/jquery.ui.autocomplete.custom.css");
		StaticCss::instance()->addCss("assets/css/jquery.jgrowl.css");
		StaticCss::instance()->addCss('assets/css/tables.css');
		StaticCss::instance()->addCss('assets/css/datepicker.css');

		// Auto-complete tag
		StaticJs::instance()->addJs("assets/js/jquery-ui-1.8.autocomplete.min.js");
		StaticJs::instance()->addJs("assets/js/jquery-ui-1.8.core-and-interactions.min.js");
		StaticJs::instance()->addJs("assets/js/jquery.tag-it.js");
		StaticJs::instance()->addJs("assets/js/kwinji.tag-it.js");

		// Notification Pop-up
		StaticJs::instance()->addJs("assets/js/jquery.jgrowl.js");

		StaticJs::instance()->addJs('assets/js/kwinji.forms.widgets.js');
		StaticJs::instance()->addJs("assets/js/kwinji.ajax.js");

		// Wysiwyg Editor
		StaticJs::instance()->addJs("assets/js/tiny_mce/tiny_mce.js");
		StaticJs::instance()->addJs("assets/js/kwinji.wysiwyg.js");

		// Template
		$this->template = View::factory('site/layouts/layout_default');

		// Template content
		$firm = Mongo_Document::factory('firm');
		$firm->load($p->id);

		// Title
		$this->title .= $firm->name;

		$this->data += array(
		//'user'=>
			'firm' => $firm,
			'header_tools' => $this->header_tools($logged_user, $firm),
			'header_title' => $this->header_title($firm, strtoupper($firm->name)),
			'events' => KData::getFirmEvents($firm->id),
			'offers' => KData::getFirmOffers($firm->id),
			'news' => KData::getFirmNews($firm->id),
		);

		// Specific widgets
		$this->widgets[] = View::factory('widget/confirm');
		$this->widgets[] = View::factory('widget/firm_add_contact', $this->data);

		$this->template->content = view::factory('firm/view', $this->data);
		$this->template->content->tab_presentation = View::factory("firm/tab_presentation", $this->data);
		$this->template->content->tab_news = View::factory("firm/tab_news", $this->data);
		$this->template->content->tab_announces = View::factory("firm/tab_announces", $this->data);
		$this->template->content->tab_events = View::factory("firm/tab_events", $this->data);
		$this->template->content->tab_contacts = View::factory("firm/tab_contacts", $this->data);
		$this->template->content->tab_followers = View::factory("firm/tab_followers", $this->data);
		$this->template->content->header_tools = view::factory('_blocks/header_tools', $this->data);
		$this->template->content->header_title = view::factory('_blocks/header_title', $this->data);
	}


	public function action_index() {
		// Template
		$this->template = View::factory('site/layouts/layout_default');

		// Find all firms
		$this->data['firms'] = KData::getFirms();

		$this->template->content = view::factory('firm/all', $this->data);

	}

	/**
	 * 
	 * Show view form to add a new firm
	 * @param String parameters $params
	 */
	public function action_add($params) {
		// Current User
		global $logged_user;
		
		// Get params
		$p = Parameters::extract($params, 'fid', 'fid');
		
		// Window title
		$this->title .= __("Add a new Company");
		
		// Add JS
		StaticJs::instance()->addJs('assets/js/jquery.meiomask.js');
		StaticJs::instance()->addJs('assets/js/kwinji.meiomask.js');

		StaticJs::instance()->addJs("assets/js/jquery.jgrowl.js");

		StaticJs::instance()->addJs('assets/js/kwinji.forms.validator.js');
		StaticJs::instance()->addJs('assets/js/kwinji.forms.widgets.js');
		StaticJs::instance()->addJs("assets/js/kwinji.ajax.js");

		// Template content
		$this->template = View::factory('site/layouts/layout_default');

		// Find firm to 
		$firm = Mongo_Document::factory('firm');
		$firm->load($p->fid);
		
		// Get default post values
		$post = array(
			'name' => $firm->name,
			'employees' => $firm->employees,
			'turnover' => $firm->turnover,
			'industry' => $firm->industry,
			'currency' => $firm->currency,
			'website' => $firm->website,
			'firm_staff' => $firm->firm_staff,
			'street' => $firm->street,
			'street_details' => $firm->street_details,
			'city' => $firm->_place_city->name,
			'country' => $firm->_place_country->name,
			'zip' => $firm->_place_city->code,
			'std' => $firm->phones['office'],
			'fax' => $firm->phones['fax'],
			'employees' => $firm->employees,
			'identity' => $firm->identities[0]['value'],
			'user' => $logged_user,
		);
		
		// Check 
		if (isset($_POST)) {
			$post = array_merge($post, $_POST);
		}
		
		// Load data
		$this->data += array(
			'post' => $post,
			'firm' => $firm,
			'header_title' => $this->header_title($firm, strtoupper($firm->name)),
			'header_tools' => $this->header_tools($logged_user, $firm),
			'sectors' => KData::getFirmsSectors(),
			'firm_staff' => KData::firmsStaff(),
			'sector' => KData::getFirmSector($firm->id),
		);
		
		// Add message describe this view.
		Message::info(__("Add your company to this directory and create some News, Carreer opportunities, Events around your activities..."), __("Create my company"));
		
		// Widgets
		$this->widgets[] = View::factory('widget/firm_add_contact', $this->data);

		// Template specific content
		$this->template->content = View::factory('firm/add', $this->data);
	}

	public function action_edit($params) {
		// Current User
		global $logged_user;
		
		// Get params
		$p = Parameters::extract($params, 'fid', 'fid');

		// Add specific JS
		StaticJs::instance()->addJs('assets/js/jquery.meiomask.js');
		StaticJs::instance()->addJs('assets/js/kwinji.meiomask.js');

		StaticJs::instance()->addJs("assets/js/jquery.jgrowl.js");

		StaticJs::instance()->addJs('assets/js/kwinji.forms.validator.js');
		StaticJs::instance()->addJs('assets/js/kwinji.forms.widgets.js');
		StaticJs::instance()->addJs("assets/js/kwinji.ajax.js");

		// Find firm
		$firm = Mongo_Document::factory('firm');
		$firm->load($p->fid);
		// Get default post values
		$post = array(
			'name' => $firm->name,
			'employees' => $firm->employees,
			'turnover' => $firm->turnover,
			'industry' => $firm->industry,
			'currency' => $firm->currency,
			'website' => $firm->website,
			'firm_staff' => $firm->firm_staff,
			'street' => $firm->street,
			'street_details' => $firm->street_details,
			'city' => $firm->_place_city->name,
			'country' => $firm->_place_country->name,
			'zip' => $firm->_place_city->code,
			'std' => $firm->phones['office'],
			'fax' => $firm->phones['fax'],
			'employees' => $firm->employees,
			'identity' => $firm->identities[0]['value'],
			'user' => $logged_user,
		);
		
		// Check 
		if (isset($_POST)) {
			$post = array_merge($post, $_POST);
		}
		
		// Load data
		$this->data += array(
			'post' => $post,
			'firm' => $firm,
			'header_title' => $this->header_title($firm, strtoupper($firm->name)),
			'header_tools' => $this->header_tools($logged_user, $firm),
			'sectors' => KData::getFirmsSectors(),
			'firm_staff' => KData::firmsStaff(),
			'sector' => KData::getFirmSector($firm->id),
		);

		// Template content
		$this->template = View::factory('site/layouts/layout_default');

		// Widgets
		$this->widgets[] = View::factory('widget/firm_add_contact', $this->data);

		// Template specific content
		$this->template->content = View::factory('firm/add', $this->data);
	}



	/**
	 *
	 * Set the header titles navigation menu
	 *
	 * @param Model_Firm $firm
	 * @param String $url
	 * @param String $title
	 */
	public static function header_title($firm, $title) {
		$header_title['titles'] = array(
		Html::anchor("new/add/fid/". $firm->id, __("Add News Post")),
		Html::anchor("event/add/fid/". $firm->id, __("Add Event")),
		Html::anchor("offer/add/fid/". $firm->id, __("Add Offer (Career)")),
		Html::anchor("#", __("Add Contact"), array("class" => "modalInput", "rel" => "#firm_add_contact", "data-url" => "firm/add_contact/fid/". $firm->id)),
		Html::anchor("firm/add/fid/". $firm->id, __("Add New Company")),
		);
		$header_title['url'] = "firm/view/id/" . $firm->id;
		$header_title['title'] = $title;
		return $header_title;
	}

	/**
	 *
	 * Set the header tools menu and define a visitor or administration display.
	 * True = visitor view
	 *
	 *
	 * @param Boolean $visitor
	 * @param Model_Firm $firm
	 */
	public static function header_tools($logged_user, $firm) {
		// Define user habilities
		$visitor = !in_array($logged_user->id, KData::getFirmUsers($firm->id));
		if ($visitor) {
			$header_tools = array();
		} else {
			$header_tools = array(
			Html::anchor('/firm/edit/fid/' . $firm->id, __('Edit firm') . '<span class="pencil"></span>', array('class' => 'button button-gray no-text pencil', 'title' => __('Edit firm'))),
			Html::anchor('/firm/add/fid/' . $firm->id, __('Add a new firm') . '<span class="add"></span>', array('class' => 'button button-gray no-text add', 'title' => __('Add a new firm'))),
			Html::anchor('/firm/settings/' . $firm->id, __('Settings') . '<span class="cog"></span>', array('class' => 'button button-gray no-text cog', 'title' => __('Settings'), 'rel' => "#overlay")),
			Html::anchor('/firm/infos', __('Infos') . '<span class="help"></span>', array('class' => 'button button-gray no-text help', 'title' => __('Infos'), 'rel' => "#overlay")),
			);
		}
		return $header_tools;
	}

}

