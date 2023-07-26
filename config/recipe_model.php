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
      $num = 6 * ($page_num - 1);
      $sql = "select id, recipe_name, icon from recipe a left join recipe_picture b on
       a.id = b.recipe_id where Release_flag = 1 ORDER BY 
       a.create_at DESC limit 6 offset :num";
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

  //指定したレシピを取得 (途中)
  public function get_recipe($num){
    try{
      $sql = 'select id, user_id, recipe_name, introductions, material_names, amounts, procedures, Release_flag, create_at from recipe a inner join recipe_picture b on
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
