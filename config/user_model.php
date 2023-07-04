<?php

class User{
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

  public function user_login($mail,$password){
    try{
      $sql = 'select * from user where mail_address = :mail';
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(':mail',$mail);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      if(password_verify($password,$result['password'])){
        return true;
      }
      return false;
    }catch(PDOException $e){
      echo "エラーが発生しました".$e->getMessage();
    } 
  }

  public function user_info($id){
    try{
      $sql = 'select * from user where id = :id';
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

      $sql = 'insert user(user_name,mail_address,password) 
      values(:name,:mail,:password)';
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
      $sql = 'delete from user where id = :id';
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(':id',$id);
      $stmt->execute();
    }catch(PDOException $e){
      echo "エラーが発生しました".$e->getMessage();
    } 
  }  
}
