<?php
 require_once '../init.php';
$user=new Admin();
$user->logout();
Redirect::to('index.php');
?>