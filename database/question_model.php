<?php 

require('db_connect.php');

class Question_model extends DB_connect{
  public function __construct()
  {
    parent::__construct();
  }

  public function get_question($id){
    try{
      $sql = 'SELECT * FROM `question` WHERE 
      ques_id = :rand 
      AND category = :ques2';

      $rand = mt_rand(1, 2);
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(":rand",(int)$rand, PDO::PARAM_INT);
      $stmt->bindValue(":ques2",(int)$id, PDO::PARAM_INT);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      return $result;
    }catch(PDOException $e){
      return "エラーが発生しました".$e->getMessage();
    } 
  }

  public function QuestionResult($post){
    $Type = $post["Type"];
    $Point = $post["Point"];
    try{
    // $step1 = "CREATE VIEW STEP1
    // AS SELECT * FROM recipe_point WHERE :Type ORDER BY ABS(:Type - :Point) LIMIT 30"; 

    // $step1 = "SELECT * FROM recipe_point WHERE :Type ORDER BY ABS(:Type - :Point)";

    $str1 = str_replace("_point","",$Type[0]);
    $step1 = "CREATE VIEW STEP1
     AS SELECT * FROM recipe_point WHERE $Type[0] ORDER BY ABS($Type[0] - $Point[$str1]) LIMIT 30"; 
    $stmt1 = $this->pdo->prepare($step1);
    // $stmt1->bindValue(":Type",$Type[0]);
    // $stmt1->bindValue(":Point",(int)$Point[$str],PDO::PARAM_INT);
    $stmt1->execute();

    $str2 = str_replace("_point","",$Type[1]);
    $step2 = "CREATE VIEW STEP2
    AS SELECT * FROM STEP1 WHERE $Type[1] ORDER BY ABS($Type[1] - $Point[$str2]) LIMIT 25";
    $stmt2 = $this->pdo->prepare($step2);
//     $stmt2->bindValue(":Type",$Type[1]);
//     $stmt2->bindValue(":Type2",$Type[1]);
//     $stmt2->bindValue(":Point",(int)$Point[$str], PDO::PARAM_INT);
    $stmt2->execute();

  $str3 = str_replace("_point","",$Type[2]);
  $step3 =  "CREATE VIEW STEP3
  AS SELECT * FROM STEP2 WHERE $Type[2] ORDER BY ABS($Type[2] - $Point[$str3]) LIMIT 20";
  $stmt3 = $this->pdo->prepare($step3);
  $stmt3->execute();

  $str4 = str_replace("_point","",$Type[3]);
  $step4 =  "CREATE VIEW STEP4
  AS SELECT * FROM STEP3 WHERE $Type[3] ORDER BY ABS($Type[3] - $Point[$str4]) LIMIT 15";
  $stmt4 = $this->pdo->prepare($step4);
  $stmt4->execute();

  $str5 = str_replace("_point","",$Type[4]);
  $step5 =  "CREATE VIEW STEP5
  AS SELECT * FROM STEP4 WHERE $Type[4] ORDER BY ABS($Type[4] - $Point[$str5]) LIMIT 10";
  $stmt5 = $this->pdo->prepare($step5);
  $stmt5->execute();

  $str6 = str_replace("_point","",$Type[5]);
  $step6 =  "CREATE VIEW STEP6
  AS SELECT * FROM STEP5 WHERE $Type[5] ORDER BY ABS($Type[5] - $Point[$str6]) LIMIT 6";
  $stmt6 = $this->pdo->prepare($step6);
  $stmt6->execute();

  $ResSql = "SELECT * FROM recipe WHERE id IN(SELECT recipe_id FROM STEP6)";
  $ResStmt = $this->pdo->prepare($ResSql);
  $ResStmt->execute();
  $result_arr = [];
  while($result = $ResStmt->fetch(PDO::FETCH_ASSOC)){
    array_push($result_arr,$result["id"]);
  }

  $ViewDrop = "
   DROP VIEW STEP1;
   DROP VIEW STEP2;
   DROP VIEW STEP3;
   DROP VIEW STEP4;
   DROP VIEW STEP5;
   DROP VIEW STEP6;
   ";
   $DropStmt = $this->pdo->prepare($ViewDrop);
   $DropStmt->execute();

  }catch(PDOException $e){
    return "エラーが発生しました".$e->getMessage();
  }    
    return $result_arr;
}
  function GetRecipes($nums){
    try{
      $GetSql = "SELECT a.id, recipe_name, icon,user_name FROM recipe a 
        LEFT JOIN recipe_picture b ON a.id = b.recipe_id 
        LEFT JOIN user c ON c.id = a.user_id WHERE a.id IN(:num1,:num2,:num3,:num4,:num5,:num6)";
      $stmt = $this->pdo->prepare($GetSql);
      $NumArray = explode(",",$nums);
      $stmt->bindValue(":num1",$NumArray[0]);
      $stmt->bindValue(":num2",$NumArray[1]);
      $stmt->bindValue(":num3",$NumArray[2]);
      $stmt->bindValue(":num4",$NumArray[3]);
      $stmt->bindValue(":num5",$NumArray[4]);
      $stmt->bindValue(":num6",$NumArray[5]);
      $stmt->execute();
      $result_arr = [];
      while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        array_push($result_arr,$result);
      } 
      return $result_arr;
  }catch(PDOException $e){
    return "エラーが発生しました".$e->getMessage();
  }
 }

 public function GetRecipePoint($recipe_id){
  $sql = "SELECT  time_point,money_point,volume_point,meat_point,
  fish_point,vegetable_point FROM recipe_point WHERE recipe_id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":id",$recipe_id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
 }

 public function __destruct(){
  $this->pdo = null;   
}
}
