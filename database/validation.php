<?php
require 'db_connect.php';

class Validation extends DB_connect{
  
  public function __construct()
  {
    parent::__construct();
  }
  
  public function mail_dupcheck($mail){
    $sql = 'SELECT * FROM user WHERE mail_address = :mail';
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':mail',$mail);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if(isset($result['mail_address'])){ 
      return true;
    }
    return false;
  }

  public function name_dupcheck($name){
    $sql = 'SELECT * FROM user WHERE user_name = :name';
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':name',$name);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if(isset($result['user_name'])){ 
      return true;
    }
    return false;
  }


  public function check_image($file){
    $flag = true;
    if(!empty($file)){
      $type = exif_imagetype($file);
      switch($type){
        //gifの場合
        case IMAGETYPE_GIF:
        break;
        //jpgの場合
        case IMAGETYPE_JPEG:
        break;
        //pngの場合
        case IMAGETYPE_PNG:
        break;
        //どれにも該当しない場合
        default:
          $flag = false;
      }
    }
    return $flag;
  }

  public function __destruct(){
    $this->pdo = null;   
  }
}