<?php

  class sql_model{
    private $pdo;

    public function __construct(){
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

    public function select_sql($sql,...$args){
      try{
        $stmt = $this->pdo->prepare($sql);
        for($i = 0;$i < count($args);$i += 2){
          $stmt->bindValue($args[$i],$args[$i + 1]);
        }
        $stmt->execute();

        $result_arr =[];
        while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
          array_push($result_arr,$result);
        }
        return $result_arr;
      }catch(PDOException $e){
          print('エラーが発生しています:'.$e->getMessage());
          die();
      }
    }

    public function query($sql,...$args){
        try{
            $stmt = $this->pdo->prepare($sql);
            for($i = 0;$i < count($args);$i += 2){
              $stmt->bindValue($args[$i],$args[$i + 1]);
            }
            $stmt->execute();   
        }catch(PDOException $e){
            print('エラーが発生しています:'.$e->getMessage());
            die();
        }
      }

  }
?>