<?php

class Validation{
  private $pdo;
  
  function __construct()
  {
    $dns = 'mysql:host=localhost;dbname=ccr_db';
      $user = 'root';
    try{
        $this->pdo = new PDO($dns,$user,'');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $this->pdo->query('SET NAMES utf8');  
      }catch(PDOException $e){
        print('エラーが発生しています:'.$e->getMessage());
        die();
      }
  }
  
  public function mail_dupcheck($mail){
    $sql = 'select * from user where mail_address = :mail';
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
    $sql = 'select * from user where user_name = :name';
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':name',$name);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if(isset($result['user_name'])){ 
      return true;
    }
    return false;
  }
}