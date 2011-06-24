<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');
class Controller_Welcome extends Controller {

  public function action_index() {
    $this->response->body('hello, world!');
  }

  public function action_test() {
    $user = Mongo_Document::factory('user')->set('name', 'colin')->set('email', 'colin@mollenhour.com');
    $user->save();

    $post        = Mongo_Document::factory('post');
    $post->user  = $user;
    $post->title = 'MongoDb';
    $post->save();

    //print_r($post);

    // $post = new Model_Post($id);
    echo ($post->_user) . PHP_EOL;
    // "colin" - the post was loaded lazily.
    echo ($post->user->id) . PHP_EOL;
    // "colin" - the user object was created lazily but not loaded.
    echo ($post->user->email) . PHP_EOL;
    // "colin@mollenhour.com" - now the user document was loaded as well.
  }
}
// End Welcome

