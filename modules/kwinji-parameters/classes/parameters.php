<?php

defined('SYSPATH') or die('No direct script access.');
class Parameters {

  /**
   * 
   * @uses Create an object paramater by url (e.g. /action/key/value/key/value/...)
   * @param String url $params
   * @param String or Array define the required key $required
   * @param String or Array define the only acces key $only
   * @return Object containing all arguments passed by url
   */
	public static function extract($params, $required = NULL, $only = NULL) {
    // Get parameters array
    $params = explode('/', $params);

    // Add a trailing value if neccessary
    if (count($params) % 2 != 0) {
      $params[] = NULL;
    }

    // Set parameters
    $parameters = array();
    for ($p = 0; $p < count($params); $p = $p + 2) {
      $parameters[$params[$p]] = $params[$p + 1];
    }

    // Check required arguments
    if (isset($required)) {
      $required = is_array($required) ? $required : array($required);
      foreach ($required as $argument) {
        if (isset($parameters[$argument]) == FALSE) {
          throw new Kohana_HTTP_Exception('missing argument : '. $argument, NULL, 404);
          break;
        }
      }
    }

    // Check unauthorized arguments
    if (isset($only)) {
      $only = is_array($only) ? $only : array($only);
      $unauthorized = array_diff(array_keys($parameters), $only);
      sort($unauthorized);
      if (count($unauthorized) > 0) {
        throw new Kohana_HTTP_Exception('unauthorized argument : '. $unauthorized[0], NULL, 404);
      }
    }

    // Return arguments
    return (object)$parameters;
  }
}

