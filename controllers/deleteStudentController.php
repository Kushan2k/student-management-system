<?php
session_start();
include_once '../config/Database.php';

if(isset($_POST['delete'])){
  $stid = $_POST['stid'];

  if(empty($stid)){
    header("Location:{$_SERVER['HTTP_REFERER']}", true, 301);
    return;
  }

  $sql = "DELETE FROM student WHERE id=?";
  $db = Database::getDB();
  if($db==null){
    header("Location:{$_SERVER['HTTP_REFERER']}", true, 301);
    return;
  }
  $stm = $db->prepare($sql);
  $stm->bind_param('i', $stid);
  if($stm->execute()){
    $_SESSION['msg'] = 'deleted!';
    header("Location:{$_SERVER['HTTP_REFERER']}");
    return;
  }

  $_SESSION['error'] = 'deleting failed!';
  header("Location:{$_SERVER['HTTP_REFERER']}");
  return;

}




?>