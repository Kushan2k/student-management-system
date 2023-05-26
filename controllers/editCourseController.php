<?php
session_start();
include_once '../config/Database.php';
include_once '../config/User.php';

if($_SERVER['REQUEST_METHOD']=='GET'){
  header("Location:../index.php");
  return;


}

if (isset($_POST['save'])){

  $user = new User(Database::getDB());

  $regid=$_POST['courseID'];
  $compled=isset($_POST['completed'])?1:0;
  $stid = htmlspecialchars($_POST['stid']);
  $id = $_POST['id'];


  if($compled==1){
    $compltedDate = $_POST['completed_date'];
    $certificatedid = $_POST['CertificateID'];
  }else{
    $compltedDate = 'N/A';
    $certificatedid='N/A';
  }


  $sql = "UPDATE registrations SET completed_date=? , completed=? ,cetificate_no=? WHERE reg_id=?";
  $db = Database::getDB();
  if($db==null){
    $_SESSION['msg'] = 'update failed!';
    header("Location:{$_SERVER['HTTP_REFERER']}");
    return;
  }
  $stm = $db->prepare($sql);
  $stm->bind_param('siii', $compltedDate, $compled, $certificatedid, $regid);
  if($stm->execute() && $user->updateStudentID($id,$stid)){
    $_SESSION['msg'] = 'Updated!';
    header("Location:{$_SERVER['HTTP_REFERER']}");
    return;
  }
  
  $_SESSION['msg'] = 'update failed!';
  header("Location:{$_SERVER['HTTP_REFERER']}");
  return;
  

}