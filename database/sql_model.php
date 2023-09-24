<?php
  require_once('db_connect.php');

  class Sql_model extends DB_connect{

    public function __construct()
    {
      parent::__construct();
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
        return  $result_arr;
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

      public function __destruct(){
        $this->pdo = null;   
      }

  }
?>