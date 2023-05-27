<?php
declare(strict_types=1);



class User{

  private mysqli $db;


  public function __construct($db){

    $this->db = $db;

  }

  public function getStatus($index){

    $res = $this->db->query("SELECT id FROM student INNER JOIN registrations ON student.id=registrations.student_id WHERE student.NIC={$index} OR student.student_id='{$index}' OR registrations.cetificate_no='{$index}'");
    if($res==TRUE && $res->num_rows>0){
      $data = $res->fetch_assoc();
      return  $data['id'];
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
        if($res->num_rows>0){
          return password_verify($pass, $res->fetch_assoc()['password']) ? true : false;
        }else{
          return false;
        }
        
      }else{
        return false;
      }
    }else{
      return false;
    }
    
  }

  public function getAdmin($email):array|null{

    $sql = "SELECT email,id FROM admin wHERE email='{$email}'";
    $res = $this->db->query($sql);
    if($res==TRUE && $res->num_rows>0){
      return $res->fetch_assoc();
    }

    return null;
  }

  public function updateAdminPassword($currentPass,$newPass,$id):bool{

    $pass = "SELECT password FROM admin WHERE id={$id}";
    $newhash = password_hash($newPass, PASSWORD_BCRYPT);
    $query = $this->db->query($pass);
    if($query==TRUE && $query->num_rows>0){
      $hash = $query->fetch_assoc()['password'];
      if(password_verify($currentPass,$hash)){
        $sql = "UPDATE admin SET password='{$newhash}' WHERE id={$id}";
        if($this->db->query($sql)==TRUE){
          return true;
        }
      }

    }

    return false;
    


  }

  public function updateAdminEmail($email,$id){
    $sql = "UPDATE admin SET email='{$email}' WHERE id={$id}";
    if($this->db->query($sql)==TRUE){
      return true;
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

  function getCourseForUser($id){

    $sql = "SELECT * FROM student LEFT JOIN registrations ON student.id=registrations.student_id WHERE student.id={$id}";

    $res = $this->db->query($sql);
    if($res==TRUE && $res->num_rows>0){
      return $res->fetch_assoc();
    }else{
      return null;
    }
  }

  function getStudentByID($id):array|null{
    $sql = "SELECT * FROM student WHERE id=?";
    $stm = $this->db->prepare($sql);
    $stm->bind_param('i', $id);
    if($stm->execute()){
      $res = $stm->get_result();
      if($res->num_rows>0){
        return $res->fetch_assoc();
      }
      return null;
    }
    return null;
  }

  function updateStudentID($stid,$newid){
    $sql = "UPDATE student SET student_id='{$newid}' WHERE id={$stid}";

    if($this->db->query($sql)==TRUE){
      return true;
    }else{
      return false;
    }
  }

  


}


?>