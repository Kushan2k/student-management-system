<?php
session_start();
include_once '../config/Database.php';
include_once '../config/User.php';
include_once '../service/StudentService.php';

if($_SERVER['REQUEST_METHOD']=='GET'){
  header("Location:../index.php");
  return;

}



if (isset($_POST['save'])){
  $db = Database::getDB();
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
  
  if($db==null){
    $_SESSION['msg'] = 'update failed!';
    header("Location:{$_SERVER['HTTP_REFERER']}");
    return;
  }
  $stm = $db->prepare($sql);
  $stm->bind_param('siii', $compltedDate, $compled, $certificatedid, $regid);
  if($stm->execute() && StudentService::upDateOne($id,$_POST) ){
    $_SESSION['msg'] = 'Updated!';
    header("Location:{$_SERVER['HTTP_REFERER']}");
    return;
  }
  
  $_SESSION['msg'] = 'Update failed!';
  header("Location:{$_SERVER['HTTP_REFERER']}");
  return;
  

}

if(isset($_POST['edit-course'])){
  $db = Database::getDB();
  if($db==null){
    $_SESSION['error'] = 'update failed!';
    header("Location:{$_SERVER['HTTP_REFERER']}");
    return;
  }
  $cid = $_POST['cid'];
  $name = htmlspecialchars($_POST['cname']);
  $fee = htmlentities($_POST['cfee']);

  if(empty($cid) || empty($name) || empty($fee)){
    $_SESSION['error'] = 'Not a valid input!';
    header("Location:{$_SERVER['HTTP_REFERER']}");
    return;
  }

  $sql = "UPDATE course SET name=? , fee=? WHERE id=?";
  
  $stm = $db->prepare($sql);
  
  
  $stm->bind_param('sii', $name, $fee, $cid);
  if($stm->execute()){
    $_SESSION['msg'] = 'Updated!';
    header("Location:{$_SERVER['HTTP_REFERER']}");
    return;
  }else{
     $_SESSION['error'] = 'update failed!';
     header("Location:{$_SERVER['HTTP_REFERER']}");
    return;
  }
}