<?php
require 'db_connect.php';

class User extends DB_connect{

  public function __construct()
  {
    parent::__construct();
  }

  public function user_login($mail,$password){
    try{
      session_start();
      $sql = 'SELECT * FROM user WHERE mail_address = :mail';
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(':mail',$mail);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      if(isset($result['password'])){
        if(password_verify($password,$result['password'])){
          $_SESSION["user_id"] = $result['id'];
          $_SESSION["email"] = $result['user_name'];
          return true;
        }
      }
      
      return false;
    }catch(PDOException $e){
      echo "エラーが発生しました".$e->getMessage();
    } 
  }

  public function user_logout(){
    session_start();
    $_SESSION = array();
    session_destroy();   
  }

  public function user_info($id){
    try{
      $sql = 'SELECT * FROM user WHERE id = :id';
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(':id',$id);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      return $result;
    }catch(PDOException $e){
      echo "エラーが発生しました".$e->getMessage();
    } 
 
  }


  public function create_user($name,$mail,$password){
    try{
      $sql = 'INSERT user(user_name,mail_address,password) 
      VALUES(:name,:mail,:password)';
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(':name',$name);
      $stmt->bindValue(':mail',$mail);
      $stmt->bindValue(':password',password_hash($password, PASSWORD_DEFAULT));
      $stmt->execute();
      return true;
    }catch(PDOException $e){
      echo "エラーが発生しました".$e->getMessage();
    } 
  }

  public function delete_user($id){
    try{
      $sql = 'DELETE FROM user WHERE id = :id';
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(':id',$id);
      $stmt->execute();
    }catch(PDOException $e){
      echo "エラーが発生しました".$e->getMessage();
    } 
  }  
  public function __destruct(){
    $this->pdo = null;   
  }
}

