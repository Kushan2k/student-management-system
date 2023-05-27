<?php
declare(strict_types=1);
if(session_status()!=PHP_SESSION_ACTIVE){
  session_start();
}
include_once '../config/Database.php';
include_once '../config/Course.php';
include_once '../config/User.php';

class StudentService{


  public static function upDateOne(int $id, $req):bool{
    $DB = Database::getDB();
    if($DB==null){
      return false;
    }

    if(empty($req)){
      return false;
    }

    $name = htmlspecialchars($req['name']);
    $email = htmlspecialchars($req['email']);
    $address = htmlspecialchars($req['address']);
    $dob = htmlspecialchars($req['dob']);
    $regdate = htmlspecialchars($req['regdate']);
    $stid = htmlspecialchars($req['stid']);
    $contact = htmlspecialchars($req['contact']);
    $nic = htmlspecialchars($req['nic']);
    $paid = htmlspecialchars($req['paid']);
    $fee = htmlspecialchars($req['fee']);
    $balance = htmlspecialchars($req['balance']);

    if(empty($name) || empty($email) || empty($dob)){
      return false;
    }

    $sql = 
    "
    UPDATE student SET name=? ,address=? , email=? , contact=? ,NIC=?, date_of_birth=? ,
    reg_date=? , paid_amount=? , fees=? , balance=? , student_id=? WHERE id=?
    
    ";
    $stm = $DB->prepare($sql);
    if($stm){
      $stm->bind_param('sssssssiiisi', $name, $address, $email, $contact, $nic, $dob, $regdate, $paid, $fee, $balance,$stid, $id);
      if($stm->execute()){
        return true;
      }
    }
    return false;
  }
}