<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');
class Controller_Resume extends Controller_Site {

	public function action_visit() {

		// Template
		$this->template = View::factory('site/layouts/layout_default');

		// Template header
		$this->template->header = View::factory('site/regions/header');
		$this->template->header->logo = View::factory('site/blocks/logo');
		$this->template->header->nav_header = View::factory('site/blocks/nav_header');
		$this->template->header->search_header = View::factory('site/blocks/search_header');

		// Template footer
		$this->template->footer = View::factory('site/regions/footer');

		$all_event_title = __("All Events");
		$this->data += array(
			'header_tools' => NULL,
			'all_event_title' => $all_event_title,
		);

		// Template content
		$this->template->content = view::factory('resume/visit', $this->data);
		$this->template->content->header_tools = view::factory('_blocks/header_tools', $this->data);
		$this->template->content->header_title = view::factory('_blocks/header_title', $this->data);
	}

	public function action_view($id) {

		// Template
		$this->template = View::factory('site/layouts/layout_default');

		// Add JS
		StaticJs::instance()->addJs('assets/js/highcharts/js/highcharts.js');
		StaticJs::instance()->addJs('assets/js/highcharts-utils.js');
		StaticJs::instance()->addJs('assets/js/highcharts-utils.js');
		
		// Load resume
		$resume = Mongo_Document::factory('resume');
		$resume->load($id);

		// Populate data
		$this->data += array(
			'header_title' => $this->header_title($resume->_user, NULL, __("My i-Profile")),
			'hobbies' => NULL,
			'keywords' => NULL,
			'resume' => $resume,
			'user_card' => View::factory('user/items/card', array('user' => $resume->_user)),
		);

		// Template content

		$this->template->content = view::factory('resume/view', $this->data);
		$this->template->content->header_tools = view::factory('_blocks/header_tools', $this->data);
		$this->template->content->header_title = view::factory('_blocks/header_title', $this->data);
	}

	/**
	 *
	 * Add skill in resume
	 * @param array $params
	 */
	public function action_add_keywords($params) {

		// Get params
		$p = Parameters::extract($params, "rid", 'rid');

		$post = array();

		if (isset($_POST)) {
			$post = array_merge($post, $_POST);
		}
		// If $_POST; check existance of key valid (form::button in post)
		if (array_key_exists('valid', $_POST)) {

			// Record in MongoDB
			$resume = Mongo_Document::factory('resume');
			$resume->load($p->rid);

			// Load Bean
			$resume->keywords = isset($post['item']) ? $post['item']['tags'] : array();
			$resume->save();

			// Redirect
			$this->request->redirect('user/view/' . $resume->_user->id);
			// $this->template->content = View::factory('firm/view/' . $event->_firm->id, $this->data);
		}
	}


	/**
	 *
	 * Add hobbies in resume
	 * @param array $params
	 */
	public function action_add_hobbies($params) {

		// Get params
		$p = Parameters::extract($params, "rid", 'rid');

		$post = array();

		if (isset($_POST)) {
			$post = array_merge($post, $_POST);
		}
		// If $_POST; check existance of key valid (form::button in post)
		if (array_key_exists('valid', $_POST)) {

			// Record in MongoDB
			$resume = Mongo_Document::factory('resume');
			$resume->load($p->rid);

			// Load Bean
			$resume->hobbies = isset($post['item']) ? $post['item']['tags'] : array();
			$resume->save();

			// Redirect
			$this->request->redirect('user/view/' . $resume->_user->id);
			// $this->template->content = View::factory('firm/view/' . $event->_firm->id, $this->data);
		}
	}

	/**
	 *
	 * Add experience in resume
	 * @param array $params
	 */
	public function action_add_experience($params) {

		// Get params
		$p = Parameters::extract($params, "rid", 'rid');

		$post = array();

		if (isset($_POST)) {
			$post = array_merge($post, $_POST);
		}
		// If $_POST; check existance of key valid (form::button in post)
		if (array_key_exists('valid', $_POST)) {
			// Record in MongoDB
			$resume = Mongo_Document::factory('resume');
			$resume->load($p->rid);

			$exp = new Model_Experience();
			$exp = $this->setExperience($post, $exp);
			$exp->save();
			
			// Load Bean
			$resume->addToSet("experiences", $exp->id);
			$resume->save();

			// Redirect
			$this->request->redirect('user/view/' . $resume->_user->id);
		}
	}

	/**
	 *
	 * Add experience in resume
	 * @param array $params
	 */
	public function action_add_graduation($params) {

		// Get params
		$p = Parameters::extract($params, "rid", 'rid');

		$post = array();

		if (isset($_POST)) {
			$post = array_merge($post, $_POST);
		}
		// If $_POST; check existance of key valid (form::button in post)
		if (array_key_exists('valid', $_POST)) {
			// Record in MongoDB
			$resume = Mongo_Document::factory('resume');
			$resume->load($p->rid);

			$grad = new Model_Graduation();
			$grad = $this->setGraduation($post, $grad);
			$grad->save();
			
			// Load Bean
			$resume->addToSet("graduations", $grad->id);
			$resume->save();

			// Redirect
			$this->request->redirect('user/view/' . $resume->_user->id);
		}
	}

	/**
	 *
	 * Edit experience in pop-up
	 * @param array $params
	 */
	public function action_edit_experience($params) {

		// Get params
		$p = Parameters::extract($params, "id", 'id');

		// Find news to edit
		$experience = Mongo_Document::factory('experience');
		$experience->load($p->id);

		// Check that the event exists
		if($experience->loaded() == false) {
			// throw event erreor 404
		}

		// Load Form inputs
		$post = array(
			'id' => $p->id,
			'begin' => KDate::display($experience->dt_starts, KDate::FMT_DATE_TIME),
			'end' => KDate::display($experience->dt_finishes, KDate::FMT_DATE_TIME),
			'frim' => $experience->_firm->name,
			'industry' => $experience->indusrtry,
			'description' => $experience->content,
			'tags' => isset($experience->keywords) && $experience->keywords != NULL ? json_encode($experience->keywords) : json_encode(array()),
			'place' => $experience->street_details,
			'address' => $experience->street,
			'city' => $experience->_place_city->name,
			'zip' => $experience->_place_city->code,
			'country' => $experience->_place_country->code,
			'user' => $experience->_user,
		);

		// If $_POST; check existance of key valid (form::button in post)
		if (array_key_exists('valid', $_POST)) {
			// Record in MongoDB
			$resume = Mongo_Document::factory('experience');
			$resume->load($p->rid);

			$exp = new Model_Experience();
			$exp = $this->setExperience($post, $exp);
			$exp->save();
			
			// Load Bean
			$resume->addToSet("experiences", $exp->id);
			$resume->save();

			// Redirect
			$this->request->redirect('user/view/' . $resume->_user->id);
		}
	}

	/**
	 *
	 * Add Skill in resume
	 * @param array $params
	 */
	public function action_add_skill($params) {

		// Get params
		$p = Parameters::extract($params, "rid", 'rid');

		$post = array();

		if (isset($_POST)) {
			$post = array_merge($post, $_POST);
		}
		// If $_POST; check existance of key valid (form::button in post)
		if (array_key_exists('valid', $_POST)) {

			// Record in MongoDB
			$resume = Mongo_Document::factory('resume');
			$resume->load($p->rid);

			$value = array(
				'item' => ucfirst(strtolower($post['item'])),
				'value' => $post['value'],
				'type' => $post['type'],
			);
			$resume->addToSet('skills', $value);

			// Load Bean
			$resume->save();

			// Redirect
			$this->request->redirect('user/view/' . $resume->_user->id);
			// $this->template->content = View::factory('firm/view/' . $event->_firm->id, $this->data);
		}
	}

	/**
	 *
	 * Delete selected skill from resume
	 * @param String $params
	 */
	public function action_delete_skill($params) {
		// Get params
		$p = Parameters::extract($params, array('id', 'rid'), array('id', 'rid'));

		// Find news to remove
		$resume = Mongo_Document::factory('resume');
		$resume->load($p->rid);
		if ($resume->loaded()) {
			foreach ($resume->skills as $id => $skill) {
				if ($id == $p->id) {
					unset($resume->skills[$id]);
					break;
				}
			}
		}
		
		// Save update
		$resume->save();

		// Redirect
		$this->request->redirect('user/view/' . $resume->_user->id);
	}

	private function setExperience($post, $exp) {
		$firm = KData::getFirmByName(ucfirst(strtolower($post['firm'])));
		$exp->dt_starts = strtotime($post['begin']);
		$exp->dt_finishes = strtotime($post['end']);
		$exp->firm = $firm->id;
		$exp->industry = KData::getIndustry($post['industry']);
		$exp->function = isset($post['function']) ? $post['function'] : "";
		$exp->place_country = KData::getPlaceBy('code', 'country', $post['country']);
		$exp->place_city = KData::getPlaceBy('name', 'city', $post['city'], $post['zip']);
		$exp->description = isset($post['description']) ? $post['description'] : "";
		$exp->skills = KData::getSkills(isset($post['item']) ? $post['item']['tags'] : array());
		return $exp;
	}

	private function setGraduation($post, $grad) {
		$school = KData::getSchoolByName(ucfirst(strtolower($post['school'])));
		$level = KData::getGraduation($post['level']);
		$grad->dt_starts = strtotime($post['begin']);
		$grad->dt_finishes = strtotime($post['end']);
		$grad->school = $school->id;
		$grad->speciality = $post['speciality'];
		$grad->level = $level->id;
		$grad->place_country = KData::getPlaceBy('code', 'country', $post['country']);
		$grad->place_city = KData::getPlaceBy('name', 'city', $post['city'], $post['zip']);
		$grad->description = isset($post['description']) ? $post['description'] : "";
		$grad->skills = KData::getSkills(isset($post['item']) ? $post['item']['tags'] : array());
		return $grad;
	}

	private function setTraining($post, $training) {
		$firm = KData::getFirmByName(ucfirst(strtolower($post['trainer'])));
		$training->dt_starts = strtotime($post['begin']);
		$training->dt_finishes = strtotime($post['end']);
		$training->name = $school->id;
		$training->trainer = $firm->id;
		$training->description = isset($post['description']) ? $post['description'] : "";
		$training->skills = KData::getSkills(isset($post['item']) ? $post['item']['tags'] : array());
		return $grad;
	}

	/**
	 *
	 * Set the header tools menu and define a visitor or administration display.
	 * True = visitor view
	 *
	 *
	 * @param Boolean $visitor
	 * @param Model_Resume $resume
	 */
	public static function header_tools($visitor = TRUE, $resume = NULL) {
		if ($visitor) {
			$header_tools = array(
			Html::anchor('/user/add_watchlist/' . $resume->_user->id, __('Add to watchlist') . '<span class="star"></span>', array('class' => 'button button-gray no-text star', 'title' => __('Add to watchlist'))),
			Html::anchor('/user/add_contact/' . $resume->_user->id, __('Add as contact') . '<span class="user_add"></span>', array('class' => 'button button-gray no-text user_add', 'title' => __('Add as contact'))),
			Html::anchor('/messenger/send_mail/' . $resume->_user->id, __('Send mail') . '<span class="email"></span>', array('class' => 'button button-gray no-text email', 'title' => __('Send mail'))),
			Html::anchor('/resume/graphic/' . $resume->id, __('Graphic view') . '<span class="chart_bar"></span>', array('class' => 'button button-gray no-text chart_bar', 'title' => __('Graphic view'))),
			);
		} else {
			$header_tools = array(
			Html::anchor('/resume/edit/' . $resume->id, __('Edit resume') . '<span class="pencil"></span>', array('class' => 'button button-gray no-text pencil', 'title' => __('Edit resume'))),
			Html::anchor('/resume/add', __('Add resume') . '<span class="add"></span>', array('class' => 'button button-gray no-text add', 'title' => __('Add resume'))),
			Html::anchor('/resume/delete/' . $resume->id, __('Delete resume') . '<span class="delete"></span>', array('class' => 'button button-gray no-text delete', 'title' => __('Delete resume'))),
			Html::anchor('/resume/settings/' . $resume->id, __('Settings') . '<span class="cog"></span>', array('class' => 'button button-gray no-text cog', 'title' => __('Settings'), 'rel' => "#overlay")),
			Html::anchor('/resume/infos', __('Infos') . '<span class="help"></span>', array('class' => 'button button-gray no-text help', 'title' => __('Infos'), 'rel' => "#overlay")),
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
	public static function header_title($user, $url = NULL, $title) {
		$header_title['url'] = $url;
		$header_title['title'] = $title;
		$header_title['titles'] = array();
		return $header_title;
	}

}

