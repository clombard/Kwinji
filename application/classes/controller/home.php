<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');
class Controller_Home extends Controller_Template {

  public $template = '_templates/home';

  public function _before() {
    $css   = array();
    $css   = HTML::style('media/css/screen.css');
    $css   = HTML::style('media/css/test.css');
    $js    = array();
    $metas = array();
  }

  public function _after() {
    $css = implode(NULL, $css);
    $js = implode(NULL, $js);
    $metas = implode(NULL, $metas);
    $this->template->css = $css;
    $this->template->js = NULL;
    $this->template->metas = $metas;
  }

  public function action_register() {
    $this->template->title = __('Welcome to Kwinji');
    $this->template->content = 'home/register';
  }

  public function action_signin() {
    $this->template->title = __('Welcome to Kwinji');
    $this->template->content = 'home/signin';
  }

  public function action_lost_password() {
    $this->template->title = __('Welcome to Kwinji');
    $this->template->content = 'home/lost-password';
  }

  public function action_reset_password() {
    $this->template->title = __('Welcome to Kwinji');
    $this->template->content = 'home/reset-password';
  }
}

