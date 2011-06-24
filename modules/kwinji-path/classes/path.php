<?php

defined('SYSPATH') or die('No direct script access.');
class Path {

  public static function alias($uri, $header = FALSE) {
    $path = Mongo_Document::factory('path');
    $criteria = array(
      '$or' => array(
        array('path' => $uri),
        array('target' => $uri),
        array('redirects.redirect' => $uri),
      ),
    );
    $path->load($criteria);

    if ($path->loaded()) {
      // If this is a redirect
      if ($path->path != $uri && $path->target != $uri) {
        $redirects = $path->redirects;
        foreach ($redirects as & $redirect) {
          if ($redirect['redirect'] == $uri) {
            $redirect['accessed'] = time();
            break;
          }
        }
        $path->redirects = $redirects;
        $path->save();
      }

      // Eventually redirect
      if ($uri != $path->path && $header == TRUE) {
        header('Location: '. URL::site($path->path), TRUE, 301);
        exit;
      }

      // Get real uri
      $uri = $path->target;

      // Only returns alias
      if ($header == FALSE) {
        $uri = $path->path;
      }
    }

    // Only returns alias
    if ($header == FALSE) {
      return $uri;
    }

    // Return controller, action and parameterss
    $parts = explode('/', $uri, 3);
    $result = array(
      'controller' => isset($parts[0]) ? $parts[0] : NULL,
      'action' => isset($parts[1]) ? $parts[1] : NULL,
      'params' => isset($parts[2]) ? $parts[2] : NULL,
    );
    return $result;
  }
}

