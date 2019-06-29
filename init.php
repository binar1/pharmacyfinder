<?php
session_start();
$GLOBALS['config']= array(
	'mysql' =>array(
		'host' =>'127.0.0.1' ,
		'username'=>'binar',
		'password'=>'a*b98W@',
		'db'=>'pharmacy'
	),
	'remember'=>  array(
		'cookie_name' => 'hash',
		'cookie_expiry'=>'604800'
	 ),
    'session'=> array(
    	'session_name' =>'user' ,
    	'session_organization'=>'ouser',
    	'token_name'=>'token'
    	 )
	 );

spl_autoload_register(function($class){
    require_once 'classes/'.$class.'.php';
});

require_once 'fuctions/sanitize.php';
 if (Cookie::exists(Config::get('remember/cookie_name')) && Session::exists(Config::get('session/session_name'))) {
     $hash=Cookie::get(Config::get('remember/cookie_name'));
     $hashCheck=DB::getInstance()->get('user_session',array('hash','=',$hash));
     if (DB::getInstance()->count()) {
     	$user=new User(DB::getInstance()->first()->user_id);
     	$user->login();
     }
 }

?>