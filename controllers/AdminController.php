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
$user = new User(Database::getDB());

if(isset($_POST['admin-login'])){

  $pass = $_POST['password'];
  $email = filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
  if(!$email){
    header("Location:../index.php", true, 301);
    return;
  }
  
  // echo $user->isAdmin($pass,$email);

  if ($user->isAdmin($pass,$email)) {
    $_SESSION['isadmin'] = true;
    $_SESSION['email'] = $email;


    header("Location:../view/admin.dashboard.php");
    return;
  }
  $_SESSION['error'] = 'invalid creadentials!';

  header("Location:../index.php", true, 301);
  return;
  



}


if(isset($_POST['edit-admin'])){
  $newp = $_POST['newpass'];
  $currentp = $_POST['cpass'];
  $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
  $id=$_POST['adminid'];

  if(!$email){
    $_SESSION['error'] = 'Invalid user!';
    return;
  }

  if($email!=$_SESSION['email']){
    if($user->updateAdminEmail($email,$id)){
      $_SESSION['msg'] = 'Email Changed!';
      $_SESSION['email'] = $email;
    }  
  }

  if(!empty($newp) && !empty($currentp)){
    if($user->updateAdminPassword($currentp, $newp, $id)){
      $_SESSION['msg'] = 'Password changed!';
      $_SESSION['isadmin'] = null;
      header("Location:../view/adminlogin.view.php");
      return;
    }else{
      $_SESSION['error'] = 'opration failed!';
      header("Location:{$_SERVER['HTTP_REFERER']}");
      return;
    }

  }else{
    $_SESSION['error'] = 'All inputs are required!';
    header("Location:{$_SERVER['HTTP_REFERER']}");
    return;
  }

}



?>