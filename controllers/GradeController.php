<?php
if(session_status()!=PHP_SESSION_ACTIVE){
  session_start();
}

include_once '../config/Database.php';
include_once '../config/Course.php';
include_once '../config/User.php';

if($_SERVER['REQUEST_METHOD']=='GET'){
  header("Access-Control-Request-Method:POST");
  header("Location:../index.php",true,403);
  
}

if($_SERVER['REQUEST_METHOD']=='POST'){
  $user=new User(Database::getDB());
  $nic = htmlspecialchars($_POST['nic']);

  $id = $user->getStatus($nic);
  

  if($id!=null && $id>0){
    $_SESSION['user_id'] = $id;
    header("Location:../view/mycourse.view.php",true);
    return;
  }

  $_SESSION['error'] = 'user not found!';
  header("Location:../index.php");
  // print_r($res);

}





?>