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
      $sql = 'SELECT t1.id, user_id, recipe_name,icon,introductions, material_names, amounts,img_name ,
      procedures, create_at FROM recipe t1 INNER JOIN recipe_picture t2 ON
      t1.id = t2.recipe_id  WHERE t1.id = :id';
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
      $sql = "SELECT a.id, recipe_name, icon,user_name FROM recipe a 
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
      amounts,procedures) VALUES(:user_id,:recipe_name,:introductions,:material_names
      ,:amounts,:procedures)";

      $stmt = $this->pdo->prepare($CreateRecipeSql);
      $stmt->bindValue(":user_id",$_SESSION["user_id"]);
      $stmt->bindValue(":recipe_name",$post["recipe_name"]);
      $stmt->bindValue(":introductions",$post["introductions"]);

      $material_names = implode(",",$post["matelial"]);
      $stmt->bindValue(":material_names",$material_names);

      $amounts = implode(",",$post["amount"]);
      $stmt->bindValue(":amounts",$amounts);

      $procedures = implode(",",$post["prod"]);
      $stmt->bindValue(":procedures",$procedures);
      
      $res = $stmt->execute();

      //レシピ用写真の削除
      $sql = "INSERT INTO recipe_picture(recipe_id,icon,img_name) VALUES ((SELECT max(id)
        FROM recipe WHERE user_id = ".$_SESSION['user_id']."),:icon,:img_name);";
      $stmt = $this->pdo->prepare($sql);

      if($_FILES["iconfile"]['name'] != null){
        $icon = uniqid(mt_rand());
        $icon .= '.' . substr(strrchr($_FILES['iconfile']['name'], '.'), 1);//アップロードされたファイルの拡張子を取得
        $iconfile = "../../upload/$icon";

        $stmt->bindValue(':icon', "/kamikon2023/upload/".$icon, PDO::PARAM_STR);
        move_uploaded_file($_FILES['iconfile']['tmp_name'], $iconfile);//imagesディレクトリにファイル保存
      }else{
        $stmt->bindValue(':icon',"", PDO::PARAM_STR);
      }
          $image_path = [];
          $ImageCount = count($_FILES) - 1;

          for($i = 1;$i <= $ImageCount;$i++){
            if($_FILES["imagefile$i"]['name'] != null){
              $image = uniqid(mt_rand());
              //アップロードされたファイルの拡張子を取得
              $image .= '.' . substr(strrchr($_FILES["imagefile$i"]['name'], '.'), 1);
              $imagefile = "../../upload/$image";

              array_push($image_path,"/kamikon2023/upload/".$image);
              move_uploaded_file($_FILES["imagefile$i"]['tmp_name'],$imagefile);//imagesディレクトリにファイル保存
              
            }else{
              array_push($image_path,"");
            }
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

          
        $stmt->execute();
      
  }

  public function update_recipe($post){

    $RecipeTable = "UPDATE 	recipe SET  recipe_name = :recipe_name,
    introductions = :introductions,material_names = :material_names,
    amounts = :amounts,procedures = :procedures WHERE  id = :id"; 

    $stmt = $this->pdo->prepare($RecipeTable);
    $stmt->bindValue(':id', $post["recipe_id"] , PDO::PARAM_INT);

    $stmt->bindValue(":recipe_name",$post["recipe_name"]);
    $stmt->bindValue(":introductions",$post["introductions"]);

    $material_names = implode(",",$post["matelial"]);
    $stmt->bindValue(":material_names",$material_names);

    $amounts = implode(",",$post["amount"]);
    $stmt->bindValue(":amounts",$amounts);

    $procedures = implode(",",$post["prod"]);
    $stmt->bindValue(":procedures",$procedures);
    $stmt->execute();

    $RecipePicture = "UPDATE recipe_picture SET icon =:icon,
    img_name =:img_name WHERE recipe_id = :id";
    $stmt = $this->pdo->prepare($RecipePicture);

    if($_FILES["iconfile"]['name'] != null){
      $icon = uniqid(mt_rand());
      $icon .= '.' . substr(strrchr($_FILES['iconfile']['name'], '.'), 1);//アップロードされたファイルの拡張子を取得
      $iconfile = "../../upload/$icon";
      $stmt->bindValue(':icon', "/kamikon2023/upload/".$icon, PDO::PARAM_STR);
      move_uploaded_file($_FILES['iconfile']['tmp_name'], $iconfile);//imagesディレクトリにファイル保存
    }else{
      $stmt->bindValue(':icon',"", PDO::PARAM_STR);
    }
        $image_path = [];
        $ImageCount = count($_FILES) - 1;
        for($i = 1;$i <= $ImageCount;$i++){
          if($_FILES["imagefile$i"]['name'] != null){
            $image = uniqid(mt_rand());
            $image .= '.' . substr(strrchr($_FILES["imagefile$i"]['name'], '.'), 1);//アップロードされたファイルの拡張子を取得
            $imagefile = "../../upload/$image";

            array_push($image_path,"/kamikon2023/upload/".$image);
            move_uploaded_file($_FILES["imagefile$i"]['tmp_name'],$imagefile);//imagesディレクトリにファイル保存
            
          }else{
            array_push($image_path,"");
          }
        }

        $imgages = implode(',',$image_path);
        $stmt->bindValue(':img_name', $imgages , PDO::PARAM_STR);
        $stmt->bindValue(':id', $post["recipe_id"] , PDO::PARAM_INT);
        $stmt->execute();

        $RecipePoint = "UPDATE recipe_point SET time_point = :time_point,money_point = :money_point,
        volume_point = :volume_point,meat_point = :meat_point,fish_point = :fish_point,
        vegetable_point = :vegetable_point WHERE recipe_id = :id";
        $stmt = $this->pdo->prepare($RecipePoint);

        $stmt->bindValue(':time_point', $post["time_point"] , PDO::PARAM_INT);
        $stmt->bindValue(':money_point', $post["money_point"] , PDO::PARAM_INT);
        $stmt->bindValue(':volume_point', $post["volume_point"] , PDO::PARAM_INT);
        $stmt->bindValue(':meat_point', $post["meat_point"] , PDO::PARAM_INT);
        $stmt->bindValue(':fish_point', $post["fish_point"] , PDO::PARAM_INT);
        $stmt->bindValue(':vegetable_point', $post["vegetable_point"] , PDO::PARAM_INT);
        $stmt->bindValue(':id', $post["recipe_id"] , PDO::PARAM_INT);
        $stmt->execute();
  }

  public function delete_recipe($recipe_id){
    try{
      $select = "SELECT icon,img_name FROM recipe_picture WHERE recipe_id = :id";
      $stmt = $this->pdo->prepare($select);
      $stmt->bindValue(':id',$recipe_id, PDO::PARAM_INT);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      $IconPath = basename($result["icon"]);
      unlink("../../upload/".$IconPath);
      $ImgPath = explode(",",$result["img_name"]);
      
      foreach($ImgPath as $img){
        if($img != ""){
          unlink("../../upload/".basename($img));
        }
      }

      $DeleteRecipePicture = "DELETE FROM recipe_picture WHERE recipe_id = :id";
      $stmt = $this->pdo->prepare($DeleteRecipePicture);
      $stmt->bindValue(':id',$recipe_id, PDO::PARAM_INT);
      $stmt->execute();


      $DeleteRecipePoint = "DELETE FROM recipe_point WHERE recipe_id  = :id";
      $stmt = $this->pdo->prepare($DeleteRecipePoint);
      $stmt->bindValue(':id',$recipe_id, PDO::PARAM_INT);
      $stmt->execute();

      $DeleteRecipe = "DELETE FROM `recipe` WHERE id = :id";
      $stmt = $this->pdo->prepare($DeleteRecipe);
      $stmt->bindValue(':id',$recipe_id, PDO::PARAM_INT);
      $stmt->execute();

    }catch(PDOException $e){
      echo "エラーが発生しました".$e->getMessage();
    }

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

  public function __destruct(){
    $this->pdo = null;   
  }
}
