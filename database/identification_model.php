<?php 
require('db_connect.php');
class identification_model extends DB_connect{
  function __construct(){
    parent::__construct();
  }

  function RecipeSreach($name){
    try{
      $sql = "SELECT a.id, recipe_name, icon,user_name FROM recipe a 
      LEFT JOIN recipe_picture b ON a.id = b.recipe_id 
      LEFT JOIN user c ON c.id = a.user_id WHERE material_names LIKE '%$name%' limit 6";
      $stmt = $this->pdo->prepare($sql);
      // $stmt->bindValue(":material",$name);
      
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
}