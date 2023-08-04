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
      $sql = "SELECT id, recipe_name, icon FROM recipe a LEFT JOIN recipe_picture b ON
       a.id = b.recipe_id WHERE Release_flag = 1 ORDER BY 
       a.create_at DESC LIMIT 6 offset :num";
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
      $sql = 'SELECT id, user_id, recipe_name, introductions, material_names, amounts, 
      procedures, Release_flag, create_at FROM recipe a INNER JOIN recipe_picture b ON
      a.id = b.recipe_id  WHERE id = :id AND Release_flag = 1';
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(":id",$num);
      $stmt->execute();
      
      return $stmt->fetch(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
      echo "エラーが発生しました".$e->getMessage();
    }
  }

  public function create_recipe($post){
      var_dump($post);
      var_dump($_FILES['userfile']);
  }

  public function update_recipe(){

  }
  public function delete_recipe(){
    
  }

  //最大ページ数
  public function maxpage(){
    $sql = "SELECT CEILING(COUNT(id) / 6) AS maxpage FROM recipe WHERE Release_flag = 1";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['maxpage'];
  }
}
