<?php
// $Id$


defined('SYSPATH') or die('No direct script access.');
class KData {

	/**
	 * Get the comments written by a user
	 *
	 * @param MongoId $user_id
	 *
	 * @return array Comments
	 */
	public static function getUserComments($user_id) {
		$collection = Mongo_Collection::factory('comment');
		$criteria = array(
      'user' => $user_id,
      'parent' => array(),
		);
		$sort = array(
      'dt_created' => Mongo_Collection::DESC,
		);
		$limit = 20;
		$comments = $collection->find($criteria)->limit(20)->sort($sort)->as_array();
		return $comments;
	}

	/**
	 * Get the comments written by a user
	 *
	 * @param MongoId $user_id
	 *
	 * @return array Comments
	 */
	public static function getUserDefaultResume($user_id) {
		// Pas possible tu charges une collection au lieu d'un document unique
		// $collection = Mongo_Collection::factory('resume');
		// $criteria = array(
		//   'user' => $user_id,
		// );
		// $sort = array(
		//  'dt_created' => Mongo_Collection::DESC,
		//);
		//$resumes = $collection->find($criteria)->sort($sort)->as_array();
		//return $resumes;

		// Pour charger uniquement un document (et non pas une collection)
		$document = Mongo_Document::factory('resume');
		$criteria = array(
      'user' => $user_id,
      'default' => TRUE,
		);
		$document->load($criteria);
		return $document;
	}

	/**
	 * Get all events of the user
	 *
	 * @param MongoId $user_id
	 *
	 * @return array Events
	 */
	public static function getUserEvents($user_id) {
		$collection = Mongo_Collection::factory('event');
		$criteria = array(
      'user' => $user_id,
		);
		$sort = array(
      'dt_starts' => Mongo_Collection::DESC,
		);
		$limit = 20;
		$events = $collection->find($criteria)->limit($limit)->sort($sort)->as_array();
		return $events;
	}

	/**
	 * Get the answers for a comment
	 *
	 * @param MongoId $comment_id
	 *
	 * @return array Comments
	 */
	public static function getCommentComments($comment_id) {
		$collection = Mongo_Collection::factory('comment');
		$criteria = array(
      'parent.$id' => $comment_id,
      'parent.$ref' => 'comments',
		);
		$sort = array(
      'dt_created' => Mongo_Collection::ASC,
		);
		$comments = $collection->find($criteria)->sort($sort)->as_array();
		return $comments;
	}

	/**
	 * 
	 * Return a User 
	 * @param MongoId $id
	 */
	public static function getUser($id) {
		$document = Mongo_Document::factory('user');
		$document->load($id);
		return $document;
	}

	public static function getCountry($code) {
		$country = Mongo_Document::factory('place');
		$criteria = array(
      'type' => 'country', 'code' => $code
		);
		$country->load($criteria);
		return $country;
	}

	public static function getNews($id) {
		$document = Mongo_Document::factory('new');
		$document->load($id);
		return $document;
	}

	public static function getFirm($id) {
		$document = Mongo_Document::factory('firm');
		$document->load($id);
		return $document;
	}

	public static function getFirmByName($value) {
		$document = Mongo_Document::factory('firm');
		$criteria = array(
			"name" => $value,
		);
		$document->load($criteria);
		if (!$document->loaded()) {
			$document = new Model_Firm();
			$document->name = $value;
			$document->dt_created = time();
			$document->dt_updated = time();
			$document->save();
		}
		return $document;
	}

	public static function getSchoolByName($value) {
		$document = Mongo_Document::factory('school');
		$criteria = array(
			"name" => $value,
		);
		$document->load($criteria);
		if (!$document->loaded()) {
			$document = new Model_School();
			$document->name = $value;
			$document->dt_created = time();
			$document->dt_updated = time();
			$document->save();
		}
		return $document;
	}

	public static function getIndustryByName($name) {
		$document = Mongo_Document::factory('sector');
		$criteria = array(
			"name" => $name,
		);
		$document->load($criteria);
		return $document;
	}

	/**
	 *
	 * Return a Mongo Place
	 * @param String $field field filter to find place
	 * @param String $type filter type place
	 * @param String $value field value
	 *
	 * @return Model_Place object
	 */
	public static function getPlaceBy($field, $type, $value, $code = NULL) {
		$document = Mongo_Document::factory('place');
		$criteria = array(
		$field => $value,
			"type" => $type,
		);
		$document->load($criteria);
		if (!$document->loaded() || ($code != NULL && $document->code != $code)) {
			$document = new Model_Place();
			$document->name = $value;
			$document->type = $type;
			$document->parent = null;
			$document->validate = TRUE;
			$document->dt_validated = time();
			$document->dt_created = time();
			$document->dt_updated = time();
			if ($code != NULL) $document->code = $code;
			$document->save();
		}
		return $document->id;
	}

	public static function getFirmEvents($firm_id) {
		$collection = Mongo_Collection::factory('event');
		$criteria = array(
			'firm' => $firm_id,
		);
		$sort = array(
			'dt_starts' => Mongo_Collection::ASC,
		);
		$firm_events = $collection->find($criteria)->sort($sort)->as_array();
		return $firm_events;
	}

	/**
	 * Get all available events categories
	 */
	public static function allEventsCategories() {
		// Set collection
		$collection = Mongo_Collection::factory('eventcategory');

		// Get all documents
		$documents = $collection->find()->as_array(FALSE);

		// Return
		$output = array();

		// Iterate all categories
		foreach ($documents as $id => $document) {
			$group_pseudo_id = $document['group'];
			$output[$group_pseudo_id][$id] = $document['category'];
		}

		// Return
		return $output;
	}
	public static function getEvent($event_id) {
		$document = Mongo_Document::factory('event');
		$document->load(array('id' => $event_id));
		return $document;
	}

	public static function getEventAttendees($event_id) {
		$document = Mongo_Document::factory('event');
		$document->load(array('id' => $event_id));
		$attendees = NULL;
		$attendees_arr = array();
		foreach ($document->atendees as $attendees_id) {
			$attendees = new Model_User($attendees_id);
			$attendees_arr[] = $attendees;
		}
		return $attendees_arr;
	}
	
	public static function getExperienceTotalCount($experiences) {
		$total = 0;
		foreach ($experiences as $experience) {
			$total += KDate::difference($experience->dt_starts, $experience->dt_finishes);
		}
		return $total;
	}

	public static function getFirmOffers($firm_id) {
		$collection = Mongo_Collection::factory('offer');
		$criteria = array(
			'firm' => $firm_id,
		);
		$sort = array(
			'dt_created' => Mongo_Collection::ASC,
		);
		$firm_offers = $collection->find($criteria)->sort($sort)->as_array();
		return $firm_offers;
	}

	public static function getFirmUsers($firm_id) {
		$firm = Mongo_Document::factory('firm');
		$firm->load($firm_id);
		$firmUsers = array();
		foreach ($firm->groups_users as $groups_user) {
			$firmUsers[] = $groups_user['user'];
		}
		return $firmUsers;
	}

	/**
	 * 
	 * Return a Graduation
	 * @param MongoId $id
	 */
	public static function getGraduation($id) {
		$grad = Mongo_Document::factory('offergraduation');
		$grad->load($id);
		return $grad;
	}

	public static function getIndustry($industry) {
		$o = Mongo_Document::factory('sector');
		$o->load($industry);
		return $o->id;
	}

	public static function getFirmNews($firm_id) {
		$collection = Mongo_Collection::factory('new');
		$criteria = array(
			'firm' => $firm_id,
		);
		$sort = array(
			'dt_published' => Mongo_Collection::DESC,
		);
		$firm_events = $collection->find($criteria)->sort($sort)->as_array();
		return $firm_events;
	}

	public static function getFirmFollowers($firm_id) {
		$collection = Mongo_Collection::factory('user');
		$criteria = array(
      		'firms_followed' => $firm_id,
		);
		$followers = $collection->find($criteria)->as_array();
		return $followers;
	}


	public static function getUserPossibleDisplaynames($user_id) {
		$document = Mongo_Document::factory('user');
		$document->load(array('id' => $user_id));

		$possible_displaynames = array(
		ucfirst($document->firstname) .' '. strtoupper($document->lastname),
		ucwords(substr($document->firstname, 0, 1) .'. '. $document->lastname),
		ucwords($document->firstname .'. '. substr($document->lastname, 0, 1)),
		ucwords(substr($document->firstname, 0, 1) .'. '. substr($document->lastname, 0, 1)),
		);
		return $possible_displaynames;
	}


	public static function userIsContactOf($user_id, $me_id) {
		$user = Mongo_Document::factory('user');
		$criteria = array(
			'id' => $me_id,
			'contacts_accepted' => $user_id,
		);
		$user->load($criteria);
		return (bool)$user->loaded();
	}

	public static function acceptUser($accepter_id, $accepted_id) {
		$user_accepter = Mongo_Document::factory('user');
		$user_accepter->load($accepter_id);

		$user_accepted = Mongo_Document::factory('user');
		$user_accepted->load($accepted_id);

		$user_accepter->addToSet('contacts_accepted', $user_accepted);
		$user_accepter->pull('contacts_waiting', $user_accepted);
		$user_accepter_ > save();

		$user_accepted->addToSet('contacts_accepted', $user_accepter);
		$user_accepted->pull('contacts_wished', $user_accepted);
		$user_accepted->save();
	}


	public static function blacklistUser($blacklister_id, $blacklisted_id) {
		$user_blacklister = Mongo_Document::factory('user');
		$user_blacklister->load($blacklister_id);

		$user_blacklisted = Mongo_Document::factory('user');
		$user_blacklisted->load($blacklisted_id);

		$user_blacklister->addToSet('contacts_blacklisted', $user_blacklisted);
		$user_blacklister->pull('contacts_accepted', $user_blacklisted);
		$user_blacklister->save();
	}


	public static function inviteUser($inviter_id, $invited_id) {
		$user_inviter = Mongo_Document::factory('user');
		$user_inviter->load($inviter_id);

		$user_invited = Mongo_Document::factory('user');
		$user_invited->load($invited_id);

		$user_inviter->addToSet('contacts_wished', $user_invited);
		$user_inviter->pull('contacts_accepted', $user_invited);
		$user_inviter->save();
	}


	public static function commonContacts($first_user_id, $second_user_id) {
		$first_user = Mongo_Document::factory('user');
		$first_user->load($first_user_id);

		$second_user = Mongo_Document::factory('user');
		$second_user->load($second_user_id);



		$ids      = array_intersect($first_user->_contacts_accepted, $second_user->_contacts_accepted);
		$users    = Mongo_Collection::factory('user');
		$criteria = array(
			'id' => array('$in' => ids),
		);
		$sort = array(
			'displayname' => Mongo_Collection::ASC,
		);
		$common = $users->find($criteria)->sort($sort)->as_array();
		return $common;
	}


	public static function userMail($user_id) {
		$user = Mongo_Document::factory('user');
		$user->load($user_id);
		foreach ($user->identities as $identity) {
			if ($identity['default'] == TRUE) {
				return $identity['mail'];
			}
		}
	}

	public static function sortCollection($collection, array$sorts = array()) {
		if (is_array($sorts) && isset($sorts) && isset($collection)) {
			$collection->sort($sorts);
		}
		return $collection;
	}


	public static function getUserContactsAcceptedLetters($user_id) {
		$user = Mongo_Document::factory('user');
		$user->load($user_id);
		$letters = array();
		foreach ($user->_contacts_accepted as $contact) {
			$letter           = substr($contact->lastname, 0, 1);
			$letter           = strtolower($letter);
			$letters[$letter] = $letter;
		}
		return array_values($letters);
	}

	public static function getUserContactsAccepted($user_id) {
		$user = Mongo_Document::factory('user');
		$user->load($user_id);
		$contact_list = array();
		foreach ($user->_contacts_accepted as $contact) {
			$contact_list[] = $contact;
		}
		return $contact_list;
	}


	public static function getUserIdentitiesProviders() {
		$providers = array(
	      'gmail' => 'Gmail',
	      'live' => 'Windows Live',
	      'yahoo' => 'Yahoo Mail',
	      'facebook' => 'Facebook',
	      'viadeo' => 'Viadeo',
	      'linkedin' => 'Linkedin',
	      'aol' => 'AOL',
	      'openid' => 'OpenID',
		);
		return $providers;
	}


	public static function commomFriends(array$user_ids = array(), $strict = TRUE) {
		$friends = array();

		if ($strict) {
			$documents = Mongo_Collection::factory('user');
			$users = $documents->find(array('contacts_accepted' => array('$in' => $user_ids)));
		}
	}

	/**
	 * Get all skills MongoId or insert unknown values
	 */
	public static function getSkills($skill_arr) {
		$collection = Mongo_Collection::factory('skill');
		$skills  = $collection->find()->as_array();
		asort($skills);

		// response array
		$result = array();
		for ($i = 0; $i < count($skill_arr); $i++) {
			$needle = $skill_arr[$i];
			if (!in_array($needle, $skills)) {
				// Add new skill and get skill id.
				$s = new Model_Skill();
				$s->name = $needle;
				$s->save();
				$result[] = $s->id;
			} else {
				// Get the skill id.
				$document = Mongo_Document::factory('skill');
				$criteria = array(
					"name" => $value,
				);
				$document->load($criteria);
				$result[] = $document->id;
			}
		}
		return $result;
	}

	/**
	 * Get all firms
	 */
	public static function getFirms() {
		$collection = Mongo_Collection::factory('firm');
		$firms  = $collection->find()->as_array();
		asort($firms);
		return $firms;
	}

	/**
	 * Get all firms sectors
	 */
	public static function getFirmsSectors() {
		$collection = Mongo_Collection::factory('sector');
		$documents  = $collection->find()->as_array();
		$sectors    = array();
		foreach ($documents as $id => $document) {
			$sectors[$id] = __($document->name);
		}
		asort($sectors);
		return $sectors;
	}

	/**
	 * Get the firm industry.
	 * @param MongoId $firmId
	 */
	public static function getFirmSector($firmId) {
		$firm = Mongo_Document::factory('firm');
		$firm->load($firmId);
		$sector = Mongo_Document::factory('sector');
		$sector->load(array("name" => $firm->industry));
		return $sector;
	}

	/**
	 * Get all expertise areas
	 */
	public static function getExpertiseAreas() {
		$collection = Mongo_Collection::factory('expertisearea');
		$documents  = $collection->find()->as_array();
		$areas      = array();
		foreach ($documents as $id => $document) {
			$areas[$id] = __($document->name);
		}
		asort($areas);
		return $areas;
	}

	/**
	 * Get all resumes languages
	 */
	public static function getResumesLanguages() {

		$database = Mongo_Database::instance();
		$test     = $database->command(array('distinct' => 'resumes', 'key' => 'language'));
		$values   = array_values($test['values']);

		$collection = Mongo_Collection::factory('language');
		$languages = $collection->find(array('code' => array('$in' => $values)))->as_array();

		$result = array();
		foreach ($languages as $id => $language) {
			$result[$language->code] = __($language->name);
		}
		asort($result);
		return $result;
	}

	public static function offersGraduations() {
		$collection = Mongo_Collection::factory('offergraduation');
		$documents  = $collection->find()->as_array();
		$values     = array();
		foreach ($documents as $id => $document) {
			$values[$id] = __($document->value);
		}
		//asort($values);
		return $values;
	}

	public static function firmsStaff() {
		$collection = Mongo_Collection::factory('firmstaff');
		$documents  = $collection->find()->as_array();
		$values     = array();
		foreach ($documents as $id => $document) {
			$values[$id] = __($document->value);
		}
		//		asort($values);
		return $values;
	}

	public static function offersTypes() {
		$collection = Mongo_Collection::factory('offertype');
		$documents  = $collection->find()->as_array();
		$values     = array();
		foreach ($documents as $id => $document) {
			$values[$id] = __($document->value);
		}
		//asort($values);
		return $values;
	}

	public static function offersPeriods() {
		$collection = Mongo_Collection::factory('offerperiod');
		$documents  = $collection->find()->as_array();
		$values     = array();
		foreach ($documents as $id => $document) {
			$values[$id] = __($document->value);
		}
		asort($values);
		return $values;
	}

	public static function experiencesLevels() {
		$collection = Mongo_Collection::factory('experiencelevel');
		$documents  = $collection->find()->as_array();
		$values     = array();
		foreach ($documents as $id => $document) {
			$values[$id] = __($document->value);
		}
		//asort($values);
		return $values;
	}

	public static function resumeSkillsList($skills_list) {
		$values     = array();
		foreach ($skills_list as $id => $skill) {
			$values[$id] = __($skill['item']);
		}
		//asort($values);
		return $values;
	}

	public static function offersContracts() {
		$collection = Mongo_Collection::factory('offercontract');
		$documents  = $collection->find()->as_array();
		$values     = array();
		foreach ($documents as $id => $document) {
			$values[$id] = __($document->value);
		}
		//asort($values);
		return $values;
	}
}

