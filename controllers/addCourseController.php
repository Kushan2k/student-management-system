<?php
include_once '../config/Database.php';
include_once '../config/Course.php';
if(session_status()!=PHP_SESSION_ACTIVE){
  session_start();
}
if($_SERVER['REQUEST_METHOD']=='GET'){
  header("Location:../index.php");
}

if(isset($_POST['add-course'])){
  $course = htmlspecialchars($_POST['title']);
  $fees=$_POST['fees'];

  $sql = "INSERT INTO course(name,fee) VALUES(?,?)";
  $db = Database::getDB();
  if($db==null){
    header("Location:{$_SERVER['HTTP_REFERER']}", true, 301);
    return;
  }
  $stm = $db->prepare($sql);
  $stm->bind_param('si', $course, $fees);
  if($stm->execute()){
    $_SESSION['msg'] = 'added!';
    header("Location:{$_SERVER['HTTP_REFERER']}");
    return;
  }
  $_SESSION['error'] = 'adding failed!';
  header("Location:{$_SERVER['HTTP_REFERER']}");
  return;
}






?>