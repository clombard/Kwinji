<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');
class Controller_Ajax extends Controller {

	public function action_see_more() {

		//$last_post =
		//$user_id =

		//print_r($_POST);
		$comment_id = $_POST['s'];

		$comment = Mongo_Document::factory('comment');
		$comment->load($comment_id);

		$contacts = $comment->_user->_contacts_accepted;
		$ids = array(c);
		foreach ($contacts as $contact) {
			$ids[] = $contact->id;
		}

		$comments = Mongo_Collection::factory('comment');
		$criteria = array(
      'user' => array('$in' => $ids),
      'dt_created' => array('$lt' => $comment->dt_created),
      'hidden_for_users' => array('$nin' => $comment->_user->id),
		);
		$comments->find($criteria)->limit(20)->sort(array('dt_created' => Mongo_Collection::DESC));

		$results = $comments->as_array();

		$views = array();
		$hiden_id = NULL;
		foreach ($results as $comment) {
			if ($hiden_id == NULL) {
				$hiden_id = (string)$comment->id;
			}
			$bottom_id = (string)$comment->id;
			$views[] = View::factory("comment/items/list_item", array('comment' => $comment, array('hiden_id' => $hiden_id)));
		}

		$view = implode('', $views);
		$view = str_replace("\r\n", "", $view);
		$view = str_replace("\r", "", $view);
		$view = str_replace("\t", "", $view);
		$view = stripcslashes($view);
		$view = nl2br($view);

		$count = count($results);

		$response = array(
      'count' => $count,
      'view' => $view,
      'bottom_id' => $bottom_id,
		//'see_more'=>View::factory("comment/items/see_more"),
		);

		//echo json_encode($response);
		echo json_encode($response);
		return;
	}

	public function action_post_new() {
		// Get text
		$text = $_POST['s'];
		$parent_id = NULL;
		if (isset($_POST['parent_id'])) {
			$parent_id = $_POST['parent_id'];
		}

		// Insert new comment in database
		$comment = Mongo_Document::factory('comment');
		$comment->dt_created = time();
		$comment->text = $_POST['s'];
		$comment->user = new MongoId($_POST['uid']);
		$comment->parent = $parent_id ? new MongoId($parent_id) : array();
		$comment->hidden_for_users = array();
		$comment->save();


		$this->data['comment'] = $comment;
		$this->data['user'] = new Model_User($_POST['uid']);
		$this->data['network_responses_infos'] = NULL;
		$this->data['network_responses'] = NULL;
		$this->data['network_input'] = View::factory('comment/items/sub_comment_input', $this->data);

		// Render view
		if ($parent_id != NULL) {
			$view = View::factory('comment/items/sub_comment', $this->data);
		}
		else {
			$view = View::factory('comment/items/list_item', $this->data);
		}
		$view = str_replace("\r\n", "", $view);
		$view = str_replace("\r", "", $view);
		$view = str_replace("\t", "", $view);
		$view = stripcslashes($view);
		$view = nl2br($view);

		// The response array
		$response = array(
      'view' => $view,
      'comment' => $comment,
		);

		// The response is returned as JSON
		echo json_encode($response);
		return;
	}


	public function action_post_refresh() {

		//$last_post =
		//$user_id =

		//print_r($_POST);
		$comment_id = $_POST['c'];

		$comment = Mongo_Document::factory('comment');
		$comment->load($comment_id);

		$contacts = $comment->_user->_contacts_accepted;
		$ids = array($comment->_user->id);
		foreach ($contacts as $contact) {
			$ids[] = $contact->id;
		}

		$comments = Mongo_Collection::factory('comment');
		$criteria = array(
      'user' => array('$in' => $ids),
      'dt_created' => array('$gt' => $comment->dt_created),
		);
		$comments->find($criteria)->sort(array('dt_created' => Mongo_Collection::DESC));

		$results = $comments->as_array();

		$views = array();
		$hiden_id = NULL;
		foreach ($results as $comment) {
			if ($hiden_id == NULL) {
				$hiden_id = (string)$comment->id;
			}
			$views[] = View::factory("comment/items/list_item", array('comment' => $comment, array('hiden_id' => $hiden_id)));
		}
		$view = implode('', $views);
		$view = str_replace("\r\n", "", $view);
		$view = str_replace("\r", "", $view);
		$view = str_replace("\t", "", $view);
		$view = stripcslashes($view);
		$view = nl2br($view);

		$count = count($results);

		$response = array(
      'count' => $count,
      'view' => $view,
		//'see_more'=>View::factory("comment/items/see_more"),
		);

		echo json_encode($response);
		return;
	}


	public function action_upload() {
		$upload = isset($_FILES[$this->field_name]) ? $_FILES[$this->field_name] : array(
      'tmp_name' => NULL,
      'name' => NULL,
      'size' => NULL,
      'type' => NULL,
      'error' => NULL,
		);
		if (is_array($upload['tmp_name']) && count($upload['tmp_name']) > 1) {
			$info = array();
			foreach ($upload['tmp_name'] as $index => $value) {
				$info[] = $this->handle_file_upload(
				$upload['tmp_name'][$index],
				$upload['name'][$index],
				$upload['size'][$index],
				$upload['type'][$index],
				$upload['error'][$index]
				);
			}
		}
		else {
			if (is_array($upload['tmp_name'])) {
				$upload = array(
          'tmp_name' => $upload['tmp_name'][0],
          'name' => $upload['name'][0],
          'size' => $upload['size'][0],
          'type' => $upload['type'][0],
          'error' => $upload['error'][0],
				);
			}
			$info = $this->handle_file_upload(
			$upload['tmp_name'],
			isset($_SERVER['HTTP_X_FILE_NAME']) ?
			$_SERVER['HTTP_X_FILE_NAME'] : $upload['name'],
			isset($_SERVER['HTTP_X_FILE_SIZE']) ?
			$_SERVER['HTTP_X_FILE_SIZE'] : $upload['size'],
			isset($_SERVER['HTTP_X_FILE_TYPE']) ?
			$_SERVER['HTTP_X_FILE_TYPE'] : $upload['type'],
			$upload['error']
			);
		}
		if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
		$_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'
		) {
			header('Content-type: application/json');
		}
		else {
			header('Content-type: text/plain');
		}
		echo json_encode($info);
	}

	public function action_add_user() {
		$message = __("has been added to your adrees book");
		$response = array(
      		'message' => $message,
		);

		// @TODO :
		// Add user to wished list

		echo json_encode($response);
		return;
	}

	/**
	 * 
	 * Add skill to resume
	 */
	public function action_add_skill($params) {
		// Get params
		$p = Parameters::extract($params, 'uid', 'uid');
		
		// Find user
		$user = Mongo_Document::factory('user');
		$user->load($p->uid);
		try {
//			$user->skills[$_POST['name']] = $_POST['level'];
			$user->save();
			$message = __("This skill has been added to your Resume");
		} catch (MongoException $message) {
			$message = __("Skill not added");
		}

		// Send notification
		$response = array(
			'message' => $message,
		);

		echo json_encode($response);
		return;
	}
	
	
	/**
	 *
	 * Delete experience selected by user
	 * @param String $params
	 */
	public function action_delete_experience($params) {
		// Get params
		$p = Parameters::extract($params, array('id', 'rid'), array('id', 'rid'));

		// Find news to remove
		$exp = Mongo_Document::factory('experience');
		$exp->load($p->id);
		$exp->delete();

/*		$res = Mongo_Document::factory('resume');
		$res->load($p->rid);
		$res->_experiences->pull($name, $value);
*/		
		// Send notification
		$message = __("Your experience has been deleted");
		$id = $p->id;
		$response = array(
			'id' => $id,
			'message' => $message,
		);

		echo json_encode($response);
		return;
	}

	/**
	 *
	 * Delete graduation selected by user
	 * @param String $params
	 */
	public function action_delete_graduation($params) {
		// Get params
		$p = Parameters::extract($params, array('id', 'rid'), array('id', 'rid'));

		// Find news to remove
		$grad = Mongo_Document::factory('graduation');
		$grad->load($p->id);
		$grad->delete();

		// Send notification
		$message = __("Your graduation has been deleted");
		$id = $p->id;
		$response = array(
			'id' => $id,
			'message' => $message,
		);

		echo json_encode($response);
		return;
	}

	/**
	 *
	 * Delete event selected by user
	 * @param String $params
	 */
	public function action_delete_event($params) {
		// Get params
		$p = Parameters::extract($params, 'id', 'id');

		// Find news to remove
		$new = KData::getEvent($p->id);
		$new->delete();

		// Send notification
		$message = __("Your event has been deleted");
		$id = $p->id;
		$response = array(
			'id' => $id,
			'message' => $message,
		);

		echo json_encode($response);
		return;
	}

	/**
	 *
	 * Delete news selected by user
	 * @param String $params
	 */
	public function action_delete_news($params) {
		// Get params
		$p = Parameters::extract($params, 'id', 'id');

		// Find news to remove
		$new = KData::getNews($p->id);
		$new->delete();

		// Send notification
		$message = __("Your article has been deleted");
		$id = $p->id;
		$response = array(
			'id' => $id,
			'message' => $message,
		);

		echo json_encode($response);
		return;
	}

	/**
	 *
	 * Delete news selected by user
	 * @param String $params
	 */
	public function action_publish_news($params) {
		// Get params
		$p = Parameters::extract($params, 'id', 'id');

		// Find news to remove
		$new = Mongo_Document::factory('new');
		$new->load($p->id);
		if ($new->published == FALSE) {
			$new->published = TRUE;
			$new->dt_published = time();
			try {
				$new->save();
				$message = __("Your article has been published");
			} catch (MongoException $message) {
				$message = __("Your article was not published");
			}
		} else $message = __("This article is already published !");

		// Send notification
		$response = array(
			'message' => $message,
		);

		echo json_encode($response);
		return;
	}

	public function action_follow_firm($params) {
		// Get params
		$p = Parameters::extract($params, array('fid', 'uid'), null);

		// Find firm to follow
		$firm = Mongo_Document::factory('firm');
		$firm->load($p->fid);
		$user = Mongo_Document::factory('user');
		$user->load($p->uid);

		// Add new firm to follow.
		if(!in_array($firm->id, (array)$user->firms_followed)) {
			$user->firms_followed = ($user->firms_followed == NULL) ? $user->firms_followed : array();
			try {
				$user->addToSet('firms_followed', $firm->id);
				$user->save();
				$message = strtoupper($firm->name) . " " .__("has been added to your watchlist");
				$id = $p->fid.$p->uid;
				$response['id'] = $id;
			} catch (MongoException $e) {
				$message = __("Problem occured during add &laquo; :company &raquo; to your watchlist", array(":company" => strtoupper($firm->name)));
			}
		} else {
			$message = __("You're already following this company !");
		}

		// Send notification
		$response['message'] = $message;
		echo json_encode($response);
		return;
	}

	public function action_tagit() {
		// TODO: Requête dynamique sur les tags 
		$tags = array( "c++", "java", "php", "coldfusion", "xylophen",
								"javascript", "asp", "ruby", "python", "c",
								"scala", "groovy", "haskell", "perl");
		

		// Send response
		$response['tags'] = $tags;
		echo json_encode($response);
		return;
	}
	
	/**
	 * 
	 * 
	 * 
	 */
	public function action_autocomplete() {
		$search = strtolower($_GET['name_startsWith']);
		if (!$search) return;
		$collectionName = strtolower($_GET['collectionName']);
		$fieldName = strtolower($_GET['fieldName']);
		
		$documents = Mongo_Document::factory($collectionName)->collection();
		$criteria = array(
			$fieldName => new MongoRegex("/.*" . $search . ".*/i"),
		);
		
		// Define filter to search.
		if (isset($_GET['scope'])) {
			$scope = strtolower($_GET['scope']);
			$scopeData = strtolower($_GET['scopeData']);
			$criteria[$scope] = $scopeData;
		}
		$results = $documents->find($criteria)-> as_array();
		$item_results = array();
		foreach ($results as $item) {
			array_push($item_results, array(
				"label" => $item->name
			));
		}
		if (count($item_results) > 12)
			asort($item_results);
		// Send response
		$response['result'] = $item_results;
		echo json_encode($response);
		return;
	}
		
	/**
	 * 
	 * @return JSON array
	 * @param String $params
	 */
	public function action_resume_chart($params) {

		// Get params
		$p = Parameters::extract($params, "rid", 'rid');
		
		$resume = Mongo_Document::factory('resume');
		$resume->load($p->rid);
		
		$chartObj = array();
		$chartObj['title'] = __("Profile Qualifications");
		$chartObj['subtitle'] = __("Source: WorldClimate.com");
		$chartObj['y_title'] = __("Skill level in %");
		$chartObj['x_items'] = array();
		$chartObj['series'] = array();
		$chartObj['series_type'] = array();
		$chartObj['series_name'] = $resume->_user->displayname."'s Overview Graphic";
		if (isset($resume->skills) && count($resume->skills) > 0) {
			$chartObj['series_type'][] = "column";
			foreach ($resume->skills as $skill) {
				$chartObj['x_items'][] = $skill['item'];
				$chartObj['series'][] = intval($skill['value']);
			}
		}
		
		// Send response
		echo json_encode($chartObj);
		return;
	}

	/**
	 * 
	 * @return JSON array
	 * @param String $params
	 */
	public function action_resume_industries($params) {

		// Get params
		$p = Parameters::extract($params, "rid", 'rid');
		
		$resume = Mongo_Document::factory('resume');
		$resume->load($p->rid);
		
		$chartObj = array();
		$chartObj['title'] = __("Global Ratio Industries Practiced");
		$chartObj['subtitle'] = __("Source: WorldClimate.com");
		$chartObj['y_title'] = __("Skill level in %");
		$chartObj['x_items'] = array();
		$chartObj['series'] = array();
		$total_count = KData::getExperienceTotalCount($resume->_experiences);
		if ($resume->loaded() && $total_count > 0) {
			$chartObj['series_name'] = $resume->_user->displayname."'s Overview Graphic";
			$i = 0;
			foreach ($resume->_experiences as $experience) {
				$datas = count($chartObj['series']);
				$data_value_added = false;
				$expInterval = KDate::difference($experience->dt_starts, $experience->dt_finishes);
				if ($datas > 0) {
					for ($index = 0; $index < $datas; $index++ ) {
						if ($chartObj['series'][$index]['name'] == $experience->_industry->name) {
							$chartObj['series'][$index]['y'] += round((100/$total_count) * $expInterval);
							$data_value_added = true;
						}
					}
				}
				if (!$data_value_added) {
					$chartObj['series'][] = array(
						'name' => $experience->_industry->name,
						'y' => round((100/$total_count) * $expInterval),
					);
				}
				$i++;
			}
		}
		
		// Send response
		echo json_encode($chartObj);
		return;
	}
}

