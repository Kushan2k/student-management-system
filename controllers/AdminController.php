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

if(isset($_POST['admin-login'])){

  $pass = $_POST['password'];
  $email = filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
  if(!$email){
    header("Location:../index.php", true, 301);
    return;
  }
  $user = new User(Database::getDB());
  // echo $user->isAdmin($pass,$email);

  if ($user->isAdmin($pass,$email)) {
    $_SESSION['isadmin'] = true;


    header("Location:../view/admin.dashboard.php");
    return;
  }
  $_SESSION['error'] = 'invalid creadentials!';

  header("Location:../index.php", true, 301);
  return;
  



}




?>