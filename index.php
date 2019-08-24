<?php
require 'flight/Flight.php';
require_once 'lib/UserAgentParser.php';

Flight::route('/', function(){
  require_once 'classes/Database.php';
  $db = new Database();
  //print_r($db->delete('users',array('user_id' => 1)));
    //echo md5(rand());
    //echo '<br>IP: '.$_SERVER['REMOTE_ADDR'].'<br>';
    //$useragent=parse_user_agent();
    //echo 'Platform: '.$useragent['platform'].'<br>';
    //echo 'Browser: '.$useragent['browser'].'<br>';
    //echo 'Version: '.$useragent['version'].'<br>';
    //print_r(parse_user_agent());
});

Flight::route('POST /user/signup', function(){
  print_r(Flight::request()->query['rollno']);
  // validate rollno
  // check weather already joined
  // add in User
  // add in verifications send email

  //print_r(Flight::request());
  //Flight::json(array('id' => 123));
});

Flight::start();
