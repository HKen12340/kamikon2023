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
      $sql = "SELECT a.id, recipe_name, icon,user_name FROM recipe a 
      LEFT JOIN recipe_picture b ON a.id = b.recipe_id 
      LEFT JOIN user c ON c.id = a.user_id  ORDER BY 
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

  //指定したレシピを取得 
  public function get_recipe($num){
    try{
      $sql = 'SELECT id, user_id, recipe_name,icon,introductions, material_names, amounts, 
      procedures, Release_flag, create_at FROM recipe a INNER JOIN recipe_picture b ON
      a.id = b.recipe_id  WHERE id = :id';
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(":id",$num);
      $stmt->execute();
      
      return $stmt->fetch(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
      echo "エラーが発生しました".$e->getMessage();
    }
  }

  public function get_MyrecipeList($page_num,$user_id){
    try{
      $num = 6 * ($page_num - 1);
      $sql = "SELECT a.id, recipe_name, icon,user_name,Release_flag FROM recipe a 
      LEFT JOIN recipe_picture b ON a.id = b.recipe_id 
      LEFT JOIN user c ON c.id = a.user_id WHERE a.user_id = :user_id ORDER BY 
      a.create_at DESC limit 6 offset :num";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(":num",(int)$num, PDO::PARAM_INT);//$numをint型に変換
      $stmt->bindValue(":user_id",(int)$user_id, PDO::PARAM_INT);//$numをint型に変換
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

  public function create_recipe($post){
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }

      $CreateRecipeSql = "INSERT INTO recipe(user_id,recipe_name,introductions,material_names,
      amounts,procedures,Release_flag) VALUES(:user_id,:recipe_name,:introductions,:material_names
      ,:amounts,:procedures,:Release_flag)";

      $this->pdo->beginTransaction();
      $stmt = $this->pdo->prepare($CreateRecipeSql);
      $stmt->bindValue(":user_id",$_SESSION["user_id"]);
      $stmt->bindValue(":recipe_name",$post["recipe_name"]);
      $stmt->bindValue(":introductions",$post["introductions"]);

      $material_names = implode(",",$post["matelial"]);
      $stmt->bindValue(":material_names",$material_names);

      $amounts = implode(",",$post["amount"]);
      $stmt->bindValue(":amounts",$amounts);

      $procedures = implode(",",$post["procedures"]);
      $stmt->bindValue(":procedures",$procedures);

      $stmt->bindValue(":Release_flag",1);
      
      $res = $stmt->execute();

      // var_dump($_FILES['iconfile']);
      $icon = uniqid(mt_rand());
      $icon .= '.' . substr(strrchr($_FILES['iconfile']['name'], '.'), 1);//アップロードされたファイルの拡張子を取得
      $iconfile = "../../upload/$icon";
      
      $sql = "INSERT INTO recipe_picture(recipe_id,icon,img_name) VALUES ((SELECT max(id)
      FROM recipe WHERE user_id = ".$_SESSION['user_id']."),:icon,:img_name);";
      
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(':icon', "/kamikon2023/upload/".$icon, PDO::PARAM_STR);
      //if (!empty($_FILES['iconfile']['name'])) {//ファイルが選択されていれば$imageにファイル名を代入
          move_uploaded_file($_FILES['iconfile']['tmp_name'], $iconfile);//imagesディレクトリにファイル保存

          $image_path = [];
        foreach($_FILES['imagefile']['name'] as $no => $tmp){
          $image = uniqid(mt_rand());
          $image .= '.' . substr(strrchr($_FILES['imagefile']['name'][$no], '.'), 1);//アップロードされたファイルの拡張子を取得
          $imagefile = "../../upload/$image";

          array_push($image_path,"/kamikon2023/upload/".$image);
          move_uploaded_file($_FILES['imagefile']['tmp_name'][$no],$imagefile);//imagesディレクトリにファイル保存
        }
        $imgages = implode(',',$image_path);
        $stmt->bindValue(':img_name', $imgages , PDO::PARAM_STR);
        $stmt->execute();

        $Point_sql = "INSERT INTO recipe_point(recipe_id,time_point,money_point,volume_point,meat_point,fish_point,vegetable_point)
        VALUES((SELECT max(id) FROM recipe WHERE user_id = ".$_SESSION['user_id']."),
      :time_point,:money_point,:volume_point,:meat_point,:fish_point,:vegetable_point)";
      $stmt = $this->pdo->prepare($Point_sql);

        $stmt->bindValue(':time_point', $post["time_point"] , PDO::PARAM_INT);
        $stmt->bindValue(':money_point', $post["money_point"] , PDO::PARAM_INT);
        $stmt->bindValue(':volume_point', $post["volume_point"] , PDO::PARAM_INT);
        $stmt->bindValue(':meat_point', $post["meat_point"] , PDO::PARAM_INT);
        $stmt->bindValue(':fish_point', $post["fish_point"] , PDO::PARAM_INT);
        $stmt->bindValue(':vegetable_point', $post["vegetable_point"] , PDO::PARAM_INT);

          // if (exif_imagetype($iconfile)) {//画像ファイルかのチェック
             // $message = '画像をアップロードしました';
        $stmt->execute();
          // } else {
          //     $message = '画像ファイルではありません';
          // }
      //}
      // var_dump($_FILES['userfile']);
      //if( $res ) {
        $this->pdo->commit();
      //}
      
  }

  public function update_recipe(){

  }
  public function delete_recipe(){
    
  }

  //最大ページ数
  public function maxpage(){
    $sql = "SELECT CEILING(COUNT(id) / 6) AS maxpage FROM recipe";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['maxpage'];
  }

  public function maxMypage($userid){
    $sql = "SELECT CEILING(COUNT(id) / 6) AS maxpage FROM recipe WHERE user_id = :userid";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(":userid",(int)$userid, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['maxpage'];
  }


  //最大レシピ数
  public function maxrecipe(){
    $sql = "SELECT COUNT(id) AS maxrecipe FROM recipe";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['maxrecipe'];
 }

 public function maxMyrecipe($userid){
  $sql = "SELECT COUNT(id) AS maxrecipe FROM recipe WHERE  user_id = :userid";
  $stmt = $this->pdo->prepare($sql);
  $stmt->bindValue(":userid",(int)$userid, PDO::PARAM_INT);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  return $result['maxrecipe'];
}
}
