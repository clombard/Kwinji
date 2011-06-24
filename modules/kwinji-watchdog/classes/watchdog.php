<?php


defined('SYSPATH') or die('No direct script access.');
class Watchdog extends Log_Writer {

  public function write(array$messages) {
    foreach ($messages as & $message) {
      $message['time'] = time();
    }

    $watchdog = Mongo_Document::factory('watchdog')->collection();
    $watchdog->batchInsert($messages);
  }
}

