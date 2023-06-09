<?php
if(session_status()!=PHP_SESSION_ACTIVE){
  session_start();
}
include_once '../config/Database.php';
include_once '../config/Course.php';
include_once '../config/User.php';

class RegisterService{


  public static function registerUser($req,$files){

    $DB = Database::getDB();
    $user = new User($DB);

    // echo '<pre>';
    // print_r($DB);
    // print_r($req);
    // print_r($files);

    if($DB==null){
      return;
    }
    $finishedDate = 'N/A';
    $stName = $req['stname'];
    $ParentName = $req['pname'];
    // $stID = $req['stid'];
    $stcontact = $req['stcontact'];
    $staddress = $req['staddress'];
    $gender = $_POST['gender'];
    $stemail = filter_var($req['stemail'], FILTER_VALIDATE_EMAIL);
    $dob = $req['stdob'];
    $course = $req['course'];
    $nic = htmlspecialchars($req['nic']);
    $regdate = $_POST['stregdate'];

    $img = $files['stimg'];
    $UPLOAD_DIR = '../public/profiles/';

    if(!$user->checkEmailExsists($stemail)){
      $_SESSION['error'] = 'Email already Registerd!';
      header("Location:../index.php");
      return;
    }

    if(!$stemail){
      $_SESSION['error'] = 'Email is not valid!';
      return;
    }

    if(empty($img)){
      throw new Exception("Image is Required!");
    }
    if ($img["size"] > 5000000) {
      $_SESSION['error'] = 'img file is too large!';
      return;
      
    }
    $img_url= $UPLOAD_DIR . time() . basename($img['name']);
    if (!move_uploaded_file($img['tmp_name'], $img_url)){
      $_SESSION['error'] = 'file upload error!';
      return;
    }
      

    try{
      $stm = $DB->prepare(
        "INSERT INTO student
        (name,parent_name,address,email,date_of_birth,reg_date,gender,img_url,contact,finished_date,NIC)
        VALUES(?,?,?,?,?,?,?,?,?,?,?)"
      );

      if($stm){

        $stm->bind_param('sssssssssss',$stName,$ParentName,$staddress,$stemail,$dob,$regdate,$gender,$img_url,$stcontact,$finishedDate,$nic
        );
        
        
        if($stm->execute()){
          $_SESSION['msg'] = 'Registration successful!';

          $currentStID = $user->getStudentID($stemail);

          EnrollCourse($course, $currentStID, $DB);
          
          
          
          return true;
        }else{
          
          return false;
          
        }
      }else{
        $DB->rollback();
        // echo $stm;
        return false;
        // print_r($DB->error);
      }
    }catch(Exception $e){
      throw new Exception($e->getMessage());
      // echo $e->getMessage();
    }



    
  }

 
}