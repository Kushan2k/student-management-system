<?php

session_start();
header("Access-Control-Request-Method:POST");
header("Access-Control-Allow-Origin:../view/register.view.php");
include_once '../service/RegisterService.php';

if($_SERVER['REQUEST_METHOD']=='GET'){
  header("Location:../index.php");
}

if(isset($_POST['register'])){

  // echo RegisterService::registerUser($_REQUEST, $_FILES);
  // RegisterService::registerUser($_REQUEST, $_FILES);

  
  try{
    if(RegisterService::registerUser($_REQUEST,$_FILES)){
      header("Location:../index.php");
    }else{
      throw new Exception("error happend!");
    }
    
  }catch(Exception $e){
    echo $e->getMessage();
  }
  
}