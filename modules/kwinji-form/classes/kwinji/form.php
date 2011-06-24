<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');
class Kwinji_Form extends Kohana_Form {

  /**
   * Creates a textarea form input.
   *
   *     echo Form::textarea('about', $about);
   *
   * @param   string   textarea name
   * @param   string   textarea body
   * @param   array    html attributes
   * @param   boolean  encode existing HTML characters
   *
   * @return  string
   * @uses    HTML::attributes
   * @uses    HTML::chars
   */
  public static function textarea($name, $body = '', array$attributes = NULL, $double_encode = TRUE) {
    // Set the input name
    $attributes['name'] = $name;

    return '<textarea'. HTML::attributes($attributes) .'>'. HTML::chars($body, $double_encode) .'</textarea>';
  }

  /**
   * Creates a submit form input.
   *
   *     echo Form::submit(NULL, 'Login');
   *
   * @param   string  input name
   * @param   string  input value
   * @param   array   html attributes
   *
   * @return  string
   * @uses    Form::input
   */
  public static function submit($name, $value, array$attributes = NULL) {
    if (isset($attributes['type']) == FALSE) {
      $attributes['type'] = 'submit';
    }
    return Form::input($name, $value, $attributes);
  }
}

