<?php


defined('SYSPATH') or die('No direct script access.');
class Kwinji_Html extends Kohana_HTML {

  /**
   * Surcharge de HTML anchot
   */
  public static function anchor($uri, $title = NULL, array$attributes = NULL, $protocol = NULL, $index = FALSE) {
    if ($title === NULL) {
      // Use the URI as the title
      $title = $uri;
    }
    if ($uri === '' || $uri === NULL) {
      // Only use the base URL
      //$uri = URL::base($protocol, $index);
    }
    else {
    	
    	$uri = Path::alias($uri, false);
    	//$uri = $parts['alias'];
    	
      if (strpos($uri, '://') !== FALSE) {
        if (HTML::$windowed_urls === TRUE AND empty($attributes['target'])) {
          // Make the link open in a new window
          $attributes['target'] = '_blank';
        }
      }
      elseif ($uri[0] !== '#') {
        // Make the URI absolute for non-id anchors
        $uri = URL::site($uri, $protocol, $index);
      }

      $attributes['href'] = $uri;
    }

    // Add the sanitized link to the attributes
    //$attributes['href'] = $uri;

    return '<a'. HTML::attributes($attributes) .'>'. $title .'</a>';
  }

  /**
   * Creates a progress bar element.
   *
   *     echo HTML::progress(50, 'orange', 'title');
   *
   */
  public static function progress($percentage, $text, $color = NULL) {

    if ($color == NULL) {
      if ($percentage <= 20) {
        $color = 'red';
      }
      if ($percentage > 20 && $percentage <= 40) {
        $color = 'orange';
      }
      if ($percentage > 40 && $percentage <= 70) {
        $color = 'blue';
      }
      if ($percentage > 70) {
        $color = 'green';
      }
    }

    $output = '<div class="progress progress-'. $color .'">';
    $output .= '<span style="width: '. $percentage .'%">';
    $output .= '<b>'. $text .'</b>';
    $output .= '</span>';
    $output .= '</div>';

    return $output;
  }

  /**
   * Creates a meta element.
   *
   *     echo HTML::meta(array('encoding' => 'utf-8'));
   *
   * @param   array    default attributes
   *
   * @return  string
   * @uses    HTML::attributes
   */
  public static function meta(array$attributes = NULL) {
    return '<meta'. HTML::attributes($attributes) .' />';
  }

  /**
   * Creates a link element.
   *
   *     echo HTML::link(array('href' => 'favicon.png', 'type' => 'image/png', 'rel' => 'shortcut icon));
   *
   * @param   array    default attributes
   *
   * @return  string
   * @uses    HTML::attributes
   */
  public static function link(array$attributes = NULL) {
    return '<link'. HTML::attributes($attributes) .' />';
  }

  /**
   * Creates a video tag.
   *
   *     echo HTML::video(array('poster' => 'snapshot.png'), array(array('src' => 'video.m4v', 'type' => 'video.m4v')));
   *
   * @param   array    default attributes
   * @param   array    sources
   *
   * @return  string
   * @uses    HTML::attributes
   */
  public static function video(array$attributes = NULL, array$sources = NULL, $protocol = NULL, $index = FALSE) {

    $poster = $attributes['poster'];

    if (strpos($poster, '://') === FALSE) {
      // Add the base URL
      $poster = URL::base($protocol, $index) . $poster;
    }
    $source['poster'] = $poster;

    $video = NULL;
    foreach ($sources as $source) {
      $src = $source['src'];
      if (strpos($src, '://') === FALSE) {
        // Add the base URL
        $src = URL::base($protocol, $index) . $src;
      }
      $source['src'] = $src;
      $video .= '<source '. HTML::attributes($source) .'/>';
    }

    return '<video'. HTML::attributes($attributes) .'>'. $video .'</video>';
  }

  /**
   * Creates an HTML namespace.
   *
   *     echo HTML::html_namespace('http://www.w3.org/1999/xhtml');
   *     echo HTML::html_namespace('http://www.facebook.com/2008/fbml', 'fb');
   *
   * @param   string   namespace
   * @param   String   namespace prefix
   *
   * @return  string
   * @uses    HTML::attributes
   */

  public static function html_namespace($namespace, $prefix = NULL) {
    if (isset($prefix)) {
      $attributes = array('xmlns:'. $prefix => $namespace);
    }
    else {
      $attributes = array('xmlns' => $namespace);
    }
    return HTML::attributes($attributes);
  }

  /**
   * Return an item_list
   */
  public static function item_list(array$items, $type = 'ul', array$attributes = NULL) {
    $content = NULL;
    foreach ($items as $key => $item) {
      $content .= '<li>'. $item .'</li>';
    }
    return '<'. $type . HTML::attributes($attributes) .'>'. $content .'</'. $type .'>';
  }
}

