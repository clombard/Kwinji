<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');
class Controller_Kwi extends Controller_Template {

  public $template = '_templates/aside';

  public function before() {
    parent::before();
    $this->html_namespaces = array();
    $this->links = array();
    $this->css = array();
    $this->js_header = array();
    $this->js_footer = array();
    $this->metas = array();
    $this->title = NULL;
    $this->menu = NULL;

    // Add namespaces
    $this->html_namespaces[] = HTML::html_namespace('http://www.facebook.com/2008/fbml', 'fb');
    $this->html_namespaces[] = HTML::html_namespace('http://ogp.me/ns#', 'og');

    // Add links
    $this->links[] = HTML::link(array('rel' => 'shortcut icon', 'type' => 'image/png', 'href' => 'http://www.kwi.local/static/img/favicons/favicon.png'));
    $this->links[] = HTML::link(array('rel' => 'icon', 'type' => 'image/png', 'href' => 'http://www.kwi.local/static/img/favicons/favicon.png'));
    $this->links[] = HTML::link(array('rel' => 'apple-touch-icon', 'href' => 'http://www.kwi.local/static/img/favicons/apple.png'));

    // Add metas
    $this->metas['charset'] = HTML::meta(array('charset' => 'utf-8'));
    $this->metas['description'] = HTML::meta(array('name' => 'description', 'content' => __('Administry - Admin Template by Zoran Juric')));
    $this->metas['keywords'] = HTML::meta(array('name' => 'keywords', 'content' => __('Admin,Template')));

    // Add CSS
    StaticCss::instance()->addCssStatic('static/css/style.css');
    StaticCss::instance()->addCssStatic('static/css/custom.css');
    StaticCss::instance()->addCssStatic('static/css/ie.css', 'IE');
    StaticCss::instance()->addCssStatic('static/css/kwinji.css');

    // Add JS in header
    StaticJs::instance()->addJs('static/js/modernizr-1.7.min.js');
    StaticJs::instance()->addJs('static/js/swfobject.js');
    StaticJs::instance()->addJs('static/js/jquery-1.4.2.min.js');
    //StaticJs::instance()->addJs('static/js/jquery.ui.core.min.js');
    //StaticJs::instance()->addJs('static/js/jquery.ui.widget.min.js');
    //StaticJs::instance()->addJs('static/js/jquery.ui.tabs.min.js');
    // Test with new versions
    StaticJs::instance()->addJs('static/js/jquery-1.5.1.min.js');
    StaticJs::instance()->addJs('static/js/jquery-ui-1.8.11.custom.min.js');
    // End test
    StaticJs::instance()->addJs('static/js/jquery.tipTip.min.js');
    StaticJs::instance()->addJs('static/js/jquery.superfish.min.js');
    StaticJs::instance()->addJs('static/js/jquery.supersubs.min.js');
    StaticJs::instance()->addJs('static/js/jquery.validate_pack.js');
    StaticJs::instance()->addJs('static/js/jquery.datepick.pack.js');
    StaticJs::instance()->addJs('static/js/jquery.datepick-en-GB.js');
    StaticJs::instance()->addJs('static/js/swfobject.js');
    StaticJs::instance()->addJs('static/js/jquery.nyroModal.pack.js');
    StaticJs::instance()->addJs('static/js/html5.js', 'IE');
    StaticJs::instance()->addJs('static/js/IE8.js', 'lt IE 8');
    StaticJs::instance()->addJs('static/js/jquery.wysiwyg.min.js');
    StaticJs::instance()->addJs('static/js/administry.js');
    StaticJs::instance()->addJs('static/js/administry-utils.js');

    // Set logo
    $this->logo = HTML::image('static/img/logo.png', array('alt' => __('Administry')));

    // Set default title
    $this->template->title = __('Welcome to Kwinji');
  }

  public function after() {
    $this->template->html_namespaces = implode(' ', $this->html_namespaces);
    $this->template->metas = implode(NULL, $this->metas);
    $this->template->links = implode(NULL, $this->links);
    $this->template->css = StaticCss::instance()->getCssAll();
    $this->template->js_header = StaticJs::instance()->getJsAll();
    $this->template->js_footer = implode(NULL, $this->js_footer);
    parent::after();
  }
}

