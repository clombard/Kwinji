<?php

defined('SYSPATH') or die('No direct script access.');

// -- Environment setup --------------------------------------------------------

// Load the core Kohana class
require SYSPATH .'classes/kohana/core'. EXT;

if (is_file(APPPATH .'classes/kohana'. EXT)) {
  // Application extends the core
  require APPPATH .'classes/kohana'. EXT;
}
else {
  // Load empty core extension 
  require SYSPATH .'classes/kohana'. EXT;
}

/**
 * Set the default time zone.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 * @see  http://php.net/timezones
 */
date_default_timezone_set('Europe/Paris');

/**
 * Set the default locale.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 * @see  http://php.net/setlocale
 */
setlocale(LC_ALL, 'en_US.utf-8');

/**
 * Enable the Kohana auto-loader.
 *
 * @see  http://kohanaframework.org/guide/using.autoloading
 * @see  http://php.net/spl_autoload_register
 */
$loaded_files = array(
	'Kohana', 
	'auto_load',
);
spl_autoload_register($loaded_files);

/**
 * Enable the Kohana auto-loader for unserialization.
 *
 * @see  http://php.net/spl_autoload_call
 * @see  http://php.net/manual/var.configuration.php#unserialize-callback-func
 */
ini_set('unserialize_callback_func', 'spl_autoload_call');

// -- Configuration and initialization -----------------------------------------

/**
 * Set the default language
 */
I18n::lang('fr-fr');

/**
 * Set Kohana::$environment if a 'KOHANA_ENV' environment variable has been supplied.
 *
 * Note: If you supply an invalid environment name, a PHP warning will be thrown
 * saying "Couldn't find constant Kohana::<INVALID_ENV_NAME>"
 */
if (isset($_SERVER['KOHANA_ENV'])) {
  Kohana::$environment = constant('Kohana::'. strtoupper($_SERVER['KOHANA_ENV']));
}

/**
 * Initialize Kohana, setting the default options.
 *
 * The following options are available:
 *
 * - string   base_url    path, and optionally domain, of your application   NULL
 * - string   index_file  name of your index file, usually "index.php"       index.php
 * - string   charset     internal character set used for input and output   utf-8
 * - string   cache_dir   set the internal cache directory                   APPPATH/cache
 * - boolean  errors      enable or disable error handling                   TRUE
 * - boolean  profile     enable or disable internal profiling               TRUE
 * - boolean  caching     enable or disable internal caching                 FALSE
 */
$init = array(
  'base_url' => 'http://www.kwinji.com/',
  'index_file' => FALSE,
  'errors' => TRUE,
  'charset' => 'utf-8',
);
Kohana::init($init);

/**
 * Attach a file reader to config. Multiple readers are supported.
 */
Kohana::$config->attach(new Config_File);

/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 */
$modules = array(
  // 'auth' => MODPATH .'auth',
  // 'cache' => MODPATH .'cache',
  // 'codebench' => MODPATH .'codebench',
  // 'database' => MODPATH .'database',
  // 'image' => MODPATH .'image',
  // 'orm' => MODPATH .'orm',
  // 'unittest' => MODPATH .'unittest',
  // 'userguide' => MODPATH .'userguide',
  'kohana-menu' => MODPATH .'kohana-menu',
  'kohana-static-files' => MODPATH .'kohana-static-files',
  'kohana-breadcrumbs' => MODPATH .'kohana-breadcrumbs',
  'mongodb-php-odm' => MODPATH .'mongodb-php-odm',
  'kwinji-form' => MODPATH .'kwinji-form',
  'kwinji-html' => MODPATH .'kwinji-html',
  'kwinji-message' => MODPATH .'kwinji-message',
  'kwinji-watchdog' => MODPATH .'kwinji-watchdog',
	'kwinji-path' => MODPATH .'kwinji-path',
  'kwinji-parameters' => MODPATH .'kwinji-parameters',
  // 'kwi-m18n' => MODPATH .'kwi-m18n',
);
Kohana::modules($modules);

/**
 * Attach the Watchdof write to logging.
 */
Kohana::$log->attach(new Watchdog());

/**
 * Specific settings for storing unstranslated strings in MongoDB
 */
// M18n::lang('fr-fr');

/**
 * Salt string for hashing
 */
define('SALT', 'ç!è!çsqèq!çsdfc!ç,yuq,7NY78G8OG8?ç!suydc,L?NJHVTUNVUCFCçsfqdiuydsçpcuç!,sf,hdsçf,');

// Set route for "graph" subdomain
switch ($_SERVER['SERVER_NAME']) {
  case 'www.kwinji.com':
  case 'kwinji.com':
    $controller = 'welcome';
    break;

  case 'graph.kwinji.com':
    $controller = 'graph';
    break;
}

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */
Route::set('default', '(<controller>(/<action>(/<id>)))')->defaults(array(
    'controller' => $controller,
    // 'controller' => 'welcome',
    'action' => 'index',
  ));
