<?php
declare(strict_types=1);



class User{

  private mysqli $db;


  public function __construct($db){

    $this->db = $db;

  }

  public function getStatus($index):bool|array{

    $res = $this->db->query("SELECT id,status FROM student WHERE student_id={$index}");
    if($res==TRUE && $res->num_rows>0){
      $data = $res->fetch_assoc();
      return [$data['status'], $data['id']];
    }


    return false;
  }

  public function isAdmin($pass,$email):bool{
    
    $sql = "SELECT password FROM admin WHERE email=?";
    $stm = $this->db->prepare($sql);

    if($stm){
      $stm->bind_param('s', $email);

      if($stm->execute()){
        $res = $stm->get_result();
        return password_verify($pass, $res->fetch_assoc()['password']) ? true : false;
      }else{
        return false;
      }
    }else{
      return false;
    }
    
  }

  public function getAllStudents():array|null{

    $sql = "SELECT * FROM student ORDER BY id DESC";
    $res=$this->db->query($sql);
    $rows = [];
    if($res==TRUE && $res->num_rows>0){
      while($r=$res->fetch_assoc()){
        array_push($rows, $r);
      }
      return $rows;
    
    }


    return null;

   

  }
   function getStudentID($email):int{
    $sql = $this->db->prepare("SELECT id FROM student WHERE email=?");
    if($sql){
      $sql->bind_param('s', $email);
      if($sql->execute()){
        $res = $sql->get_result();
        if($res->num_rows>0){
          return $res->fetch_assoc()['id'];
        }
        return 0;
      }
      return 0;

    
    }
    return 0;
      
  }

  function checkEmailExsists($email):bool{
    $stm = $this->db->prepare("SELECT id FROM student WHERE email=?");
    $stm->bind_param('s', $email);
    if($stm->execute()){
      $res = $stm->get_result();
      if($res->num_rows>0){
        return false;
      }
      return true;

    }
    return true;

  }

  


}


?>