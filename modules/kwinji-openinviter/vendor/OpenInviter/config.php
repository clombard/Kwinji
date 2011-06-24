<?php
// $Id$

$openinviter_settings = array(
  "username" => "semalead",
  "private_key" => "826eaf97a03876221d49c51096ace29e",
  "cookie_path" => '/tmp',
  // http://www.google.fr is the website on your account. If wrong, please update your account at OpenInviter.com
  "message_body" => "You are invited to http://www.google.fr",
  // http://www.google.fr is the website on your account. If wrong, please update your account at OpenInviter.com
  "message_subject" => " is inviting you to http://www.google.fr",
  // Replace "curl" with "wget" if you would like to use wget instead
  "transport" => "curl",
  //Available options: on_error => log only requests containing errors; always => log all requests; FALSE => don`t log anything
  "local_debug" => "on_error",
  // When set to TRUE OpenInviter sends debug information to our servers. Set it to FALSE to disable this feature
  "remote_debug" => FALSE,
  // When set to TRUE OpenInviter uses the OpenInviter Hosted Solution servers to import the contacts.
  "hosted" => FALSE,
  // If you want to use a proxy in OpenInviter by adding another key to the array. Example: "proxy_1"=>array("host"=>"1.2.3.4","port"=>"8080","user"=>"user","password"=>"pass")
  "proxies" => array(),
  //You can add as many proxies as you want and OpenInviter will randomly choose which one to use on each import.
  "stats" => TRUE,
  "plugins_cache_time" => 1800,
  "plugins_cache_file" => "oi_plugins.php",
  "update_files" => TRUE,
  // Required to access the stats
  "stats_user" => "",
  //Required to access the stats
  "stats_password" => "",
);

