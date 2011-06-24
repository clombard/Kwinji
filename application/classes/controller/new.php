<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');
class Controller_New extends Controller_Site {

	/**
	 *
	 * Return a news view
	 *
	 * @param NewsId $id
	 */
	public function action_view($id) {
		// Add specific JS
		StaticJs::instance()->addJs("assets/js/global.js");

		// Template
		$this->template = View::factory('site/layouts/layout_default');

		// Template content
		$news = KData::getNews($id);
		$this->data['news'] = $news;
		$this->data['header_title'] = array("type" => 'single', 'title' => $news->details['title']);
		$this->data['header_tools'] = "";

		// Specific title
		$this->title .= "News : ". $news->details['title'];

		// Template specific content
		$this->template->content = view::factory('new/view', $this->data);

		// Template header content
		$this->template->content->header_tools = view::factory('_blocks/header_tools', $this->data);
		$this->template->content->header_title = view::factory('_blocks/header_title', $this->data);
	}

	public function action_edit($params) {
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
				
		// Template
		$this->template = View::factory('site/layouts/layout_default');

		// Title
		$this->title .= "Add new Post";

		// Server variable of the User
		global $logged_user;

		// Find news to edit
		$new = Mongo_Document::factory('new');
		$new->load($p->id);
		
		// Check that the new exists
		if($new->loaded() == false) {
			// throw new erreor 404
		}
		
		// Load Form inputs
		$post = array(
			'id' => $p->id,
			'title' => $new->details['title'],
			'teaser' => $new->details['teaser'],
			'description' => $new->details['text'],
			'tags' => $new->keywords,
			'image' => NULL,
			'user' => $new->_user,
		);

		// Get Firm
		$company = new Model_Firm($new->_firm->id);
		$this->data['company'] = $company;
		
		// Widgets
		$this->widgets[] = View::factory('widget/firm_add_contact', $this->data);

		// Add new contributor.
		if($new->_user->id != $logged_user->id && !in_array($new->user, (array)$new->users)) {
			$post['users'] = $new->_user;
		}
		// Check is a Firm post.
		if ($new->_firm != null) {
			// $firm = new Model_Firm($new->_firm->id);
			$this->data += array(
				//'firm' => $firm,
				'firm' => $new->_firm,
				'header_title' => Controller_Firm::header_title($new->_firm, 'firm/view/fid/' . $new->_firm->id, $new->_firm->name),
			);
		//	$this->data['firm'] = $firm;
			$this->data['firm'] = $new->_firm;
			// $post['firm'] = $firm->id;
			$post['firm'] = $new->_firm->id;
		} else $this->data['header_title'] = $this->getContentHeader($this->data['user']);
		$this->data['header_tools'] = "";
		$this->data['post'] = $post;

		// Template specific content
		$this->template->content = view::factory('new/add', $this->data);

		// Template header content
		$this->template->content->header_tools = view::factory('_blocks/header_tools', $this->data);
		$this->template->content->header_title = view::factory('_blocks/header_title', $this->data);
	}

	public function action_add($params) {

		// Get params
		$p = Parameters::extract($params, NULL, array('fid', 'id'));
		
		// Add a specific JS and CSS for tables
		StaticCss::instance()->addCss("assets/css/jquery.ui.autocomplete.custom.css");
		StaticCss::instance()->addCss("assets/css/jquery.jgrowl.css");
		StaticCss::instance()->addCss('assets/css/tables.css');
		
		// Auto-complete tag
		StaticJs::instance()->addJs("assets/js/jquery-ui-1.8.autocomplete.min.js");
		StaticJs::instance()->addJs("assets/js/jquery-ui-1.8.core-and-interactions.min.js");
		StaticJs::instance()->addJs("assets/js/jquery.tag-it.js");
		StaticJs::instance()->addJs("assets/js/kwinji.tag-it.js");
		
		StaticJs::instance()->addJs("assets/js/kwinji.forms.validator.js");
		// Notification Pop-up
		StaticJs::instance()->addJs("assets/js/jquery.jgrowl.js");

		StaticJs::instance()->addJs('assets/js/kwinji.forms.widgets.js');
		StaticJs::instance()->addJs("assets/js/kwinji.ajax.js");

		StaticJs::instance()->addJs("assets/js/jquery.meiomask.js");
		StaticJs::instance()->addJs("assets/js/kwinji.meiomask.js");
		
		// Template
		$this->template = View::factory('site/layouts/layout_default');

		// Title
		$this->title .= "Add new Post";


		// Server variable of the User
		global $logged_user;

		// Get default post values
		$post = array(
			'id' => NULL,
			'title' => NULL,
			'teaser' => NULL,
			'description' => NULL,
			'tags' => NULL,
			'image' => NULL,
			'user' => $this->data['user']->id,
			'users' => NULL,
			'firm' => NULL,
		);

		// Check is a Firm post.
		$firm = Mongo_Document::factory('firm');
		$firm->load($p->fid);
		
		// Get Firm
		$this->data['company'] = $firm;
		
		if ($firm->loaded() == TRUE) {
			$this->data['firm'] = $firm;
			$post['firm'] = $firm->id;
			
			$this->data += array(
				'firm' => $firm,
				'header_title' => Controller_Firm::header_title($firm, strtoupper($firm->name)),
			);

		} else {
			$this->data['header_title'] = $this->getContentHeader($this->data['user']);
		}
		$this->data['header_tools'] = "";
		$this->data['post'] = $post;
		
		if (isset($_POST)) {
			$post = array_merge($post, $_POST);
		}
		// If $_POST; check existance of key valid (form::button in post)
		if (array_key_exists('valid', $_POST)) {
			// Error test
			$error = FALSE;

			// Check error
			if ($error) {
				// Show the form with error message
				// Message::error('Error title', json_encode($_POST));
				$this->template->content = View::factory('new/add', $this->data);
			} else {
				// Record in MongoDB
				$new = Mongo_Document::factory('new');
				if ($_POST['new_id'] != NULL)
					$new->load($_POST['new_id']);
				
				// Load Bean
				$new = $this->setNews($new, $post);
				$new->save();
				// Redirect
				$this->request->redirect('firm/view/id/' . $new->_firm->id . "#tabs-2");
				// $this->template->content = View::factory('firm/view/' . $new->_firm->id, $this->data);
			}
		} else {
			// Info message
			Message::info(__('Create a new post for your company'), __("Add new Post"));

			// Never submitted
			$this->template->content = View::factory('new/add', $this->data);
		}

		// Widgets
		$this->widgets[] = View::factory('widget/firm_add_contact', $this->data);
		
		// Template specific content
		$this->template->content = view::factory('new/add', $this->data);

		// Template header content
		$this->template->content->header_tools = view::factory('_blocks/header_tools', $this->data);
		$this->template->content->header_title = view::factory('_blocks/header_title', $this->data);
	}


	/**
	 *
	 * Load Bean "News" with post values.
	 * @param MongoObject $new
	 * @param array $post
	 */
	private function setNews($new, $post) {
		$new->set('details.title', $post['title']);
		$new->set('details.teaser', $post['teaser']);
		$new->set('details.text', $post['description']);
		$new->firm			= $post['firm'];
		$new->keywords 		= isset($post['item']['tags']) ? $post['item']['tags'] : null;
		$new->user 			= $post['user'];
		$new->users 		= $post['users'];
		$new->dt_created 	= time();
		$new->dt_published 	= time();
		$new->dt_updated 	= time();
		return $new;
	}


	/**
	 *
	 * Private function to get the window header without Firm.
	 */
	private function getContentHeader() {
		$header = array(
			"type" => 'multiple',
			'title' => "News - Add article",
			'url' => "new/add/",
			'titles' => array(
		array(
		          "content" => "News - View all",
		          "url" => "new/all",
		),
		),
		);
		return $header;
	}
}

