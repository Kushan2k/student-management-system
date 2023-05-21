<?php
declare(strict_types=1);

function getAllCourse($db):array|null{

  $res = $db->query("SELECT name,id FROM course");
  $cs = [];
  if($res==TRUE && $res->num_rows>0){

    while($r=$res->fetch_assoc()){
      array_push($cs, $r);
    }
    return $cs;

  }
  return null;


}

function EnrollCourse($coursID,$userID,$db):bool{
  $sql = "INSERT INTO registrations(course_id,student_id) VALUES(?,?)";
  $stm = $db->prepare($sql);
  if($stm){
    $stm->bind_param('ii', $coursID, $userID);
    if($stm->execute()){
      return true;
    }
    return false;
  }
  return false;

}

function GetEntroledCourse($userid,$db):array|null{
  $stm = $db->prepare("SELECT * FROM registrations  LEFT JOIN course ON registrations.course_id=course.id WHERE student_id=?");
  $stm->bind_param('i', $userid);
  $courses = [];
  if($stm->execute()){
    $res = $stm->get_result();
   if($res->num_rows>0){
     while($r=$res->fetch_assoc()){
      array_push($courses, $r);
      }
      return $courses;
   }
    return null;

  }
  return null;

}
