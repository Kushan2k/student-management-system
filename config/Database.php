<?php

class Database{

  private $user='root';
  private $host='localhost';
  private $db='courses';
  private $password='';

  private static $DB=null;
 
  public static function getDB(){
    
    if(self::$DB==null){
      new Database();
    }
    return self::$DB;

  }

  private function __construct(){

    try{
      self::$DB = new mysqli($this->host, $this->user, $this->password, $this->db);
      $stm = "
      CREATE TABLE IF NOT EXISTS student(
        id INT AUTO_INCREMENT,
        student_id VARCHAR(20) NOT NULL DEFAULT 'N/A',
        name VARCHAR(255) NOT NULL,
        NIC VARCHAR(20) NOT NULL DEFAULT 'N/A',
        address VARCHAR(255) NOT NULL,
        parent_name VARCHAR(255) NULL DEFAULT 'None',
        email VARCHAR(255) NOT NULL,
        date_of_birth VARCHAR(20) NOT NULL,
        reg_date VARCHAR(255),
        paid_amount INT DEFAULT 0,
        fees INT DEFAULT 0,
        gender VARCHAR(20) NULL DEFAULT NULL,
        img_url VARCHAR(255),
        contact VARCHAR(11) NOT NULL,
        balance INT DEFAULT 0,
        finish_date VARCHAR(255) DEFAULT 'N/A'
      )
      ";
      self::$DB->query($stm);
    }catch(Exception $e){
      self::$DB = null;
      
    }

    

  }


}

?>