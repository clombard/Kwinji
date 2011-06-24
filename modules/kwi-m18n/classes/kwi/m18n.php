<?php
// $Id$

defined('SYSPATH') or die('No direct script access.');

/**
 * Internationalization (M18n) class. Provides language loading and translation
 * methods without dependencies on [gettext](http://php.net/gettext).
 *
 * Typically this class would never be used directly, but used via the __()
 * function, which loads the message and replaces parameters:
 *
 *     // Display a translated message
 *     echo __('Hello, world');
 *
 *     // With parameter replacement
 *     echo __('Hello, :user', array(':user' => $username));
 *
 * @package    Kohana
 * @category   Base
 * @author     Kohana Team
 * @copyright  (c) 2008-2011 Kohana Team
 * @license    http://kohanaframework.org/license
 */
class Kwi_M18n {

  /**
   * @var  string   target language: en-us, es-es, zh-cn, etc
   */
  public static $lang = 'en-us';

  /**
   * @var  string  source language: en-us, es-es, zh-cn, etc
   */
  public static $source = 'en-us';

  /**
   * @var  array  cache of loaded languages
   */
  protected static $_cache = array();

  /**
   * Get and set the target language.
   *
   *     // Get the current language
   *     $lang = M18n::lang();
   *
   *     // Change the current language to Spanish
   *     M18n::lang('es-es');
   *
   * @param   string   new language setting
   *
   * @return  string
   * @since   3.0.2
   */
  public static function lang($lang = NULL) {
    if ($lang) {
      // Normalize the language
      M18n::$lang = strtolower(str_replace(array(' ', '_'), '-', $lang));
    }

    return M18n::$lang;
  }

  /**
   * Returns translation of a string. If no translation exists, the original
   * string will be returned. No parameters are replaced.
   *
   *     $hello = M18n::get('Hello friends, my name is :name');
   *
   * @param   string   text to translate
   * @param   string   target language
   *
   * @return  string
   */
  public static function get($string, $lang = NULL) {
    if ($lang == NULL) {
      // Use the global target language
      $lang = M18n::$lang;
    }

    // Load the translation table for this language
    $table = M18n::load($lang);

    // If the translation does not exist
    if (isset($table[$string]) == FALSE) {
      $m18n              = Mongo_Document::factory('m18n');
      $m18n->lang        = $lang;
      $m18n->string      = $string;
      $m18n->dates        = array(
      	'created' => time(),
     	  'updated' => NULL,
      );
      $m18n->translation = FALSE;
      $m18n->save();
    }

    // Return the translated string if it exists
    return (isset($table[$string]) && $table[$string] !== FALSE) ? $table[$string] : $string;
  }

  /**
   * Returns the translation table for a given language.
   *
   *     // Get all defined Spanish messages
   *     $messages = M18n::load('es-es');
   *
   * @param   string   language to load
   *
   * @return  array
   */
  public static function load($lang) {
    // Get cache
    if (isset(M18n::$_cache[$lang])) {
      return M18n::$_cache[$lang];
    }

    // New translation table
    $table = array();

    // Get fresh values
    $m18n = Mongo_Document::factory('m18n')->collection();
    $m18n->find	(array('lang' => $lang))->as_array();
    foreach ($m18n as $translation) {
      $table[$translation->string] = $translation->translation;
    }

    // Cache the translation table locally
    return M18n::$_cache[$lang] = $table;
  }
}


