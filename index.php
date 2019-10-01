<?php
require 'flight/Flight.php';
require_once 'lib/UserAgentParser.php';
require_once 'classes/Database.php';
require_once 'classes/User.php';

Flight::route('/', function(){
  //require_once 'classes/Database.php';
  $db = new Database();
  //print_r($db->delete('users',array('user_id' => 1)));
    //echo md5(rand());
    echo '<br>IP: '.$_SERVER['REMOTE_ADDR'].'<br>';
    $useragent=parse_user_agent();
    echo 'Platform: '.$useragent['platform'].'<br>';
    echo 'Browser: '.$useragent['browser'].'<br>';
    echo 'Version: '.$useragent['version'].'<br>';
    //print_r(parse_user_agent());
});

Flight::route('POST /user/signup', function(){
  // validate rollno
  if(!preg_match('/[bm](se|cs|it)[fs][0-3][0-9][am][05][0-9][0-9]/', Flight::request()->query['rollno'])){
    Flight::json(array('error' => 1,'msg'=>'Invalid Roll Number'));
    return;
  }
  $user=new User(strtolower(Flight::request()->query['rollno']),Flight::request()->query['password'],Flight::request()->query['name']);
  if (!$user->signup()) {
    Flight::json(array('error' => 1,'msg'=>'Error Signing up'));
    return;
  }
  if (!$user->sendVerifications()) {
    Flight::json(array('error' => 1,'msg'=>'Error Sending Verification'));
    return;
  }
  Flight::json(array('success' => 1,'msg'=>'Sign Up Successful'));
  return;
});

Flight::start();
