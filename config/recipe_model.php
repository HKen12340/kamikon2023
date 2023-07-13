<?php
require('db_connect.php');

class Recipe_model extends DB_connect{
  
  public function __construct()
  {
    parent::__construct();
  }

 //複数のレシピを取得
  public function get_recipeList($page_num){
    try{
      $num = 9 * $page_num;
      $sql = "select * from recipe a inner join recipe_picture b on
       a.id = b.recipe_id  limit :num ";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(":num",(int)$num, PDO::PARAM_INT);//$numをint型に変換
      $stmt->execute();
      
      $result_arr =[];
      while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        array_push($result_arr,$result);
      }
      return $result_arr;
    }catch(PDOException $e){
      echo "エラーが発生しました".$e->getMessage();
    }
  }

  //指定したレシピを取得
  public function get_recipe($num){
    try{
      $sql = 'select * from recipe a inner join recipe_picture b on
      a.id = b.recipe_id  where id = :id';
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(":id",$num);
      $stmt->execute();
      
      return $stmt->fetch(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
      echo "エラーが発生しました".$e->getMessage();
    }
  }

  public function create_recipe(){
      
  }

  public function delete_recipe(){
    
  }
}
