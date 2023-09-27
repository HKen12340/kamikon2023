<?php

  // if(empty($_SESSION['user_id'])){
  //   header('location:../../login.view.php');
  // }
  require("../../database/recipe_model.php");
  $recipe = new Recipe_model;
  $result = $recipe->get_recipe($_GET["id"]);
  $title = $result["recipe_name"];

  $photo = $result["icon"];
  if (!empty($photo)) {
    $icon = $photo;
  } else {
      $icon = "../../components/NoImage.png";
  }

  require("../../database/user_model.php");
  $user = new User;
  $user_info = $user->user_info($result["user_id"]);
  $user_name = $user_info["user_name"];
?>

<!DOCTYPE html>
<html lang="ja">
  <?php require('../../components/header.php'); ?>
  <head>
    <script src="../../asset/jquery-3.7.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../style.css">
    <title><?php echo $title; ?></title>
  </head>

  <body>
    <?php
      // ユーザ名
      echo '<div class="ReleaceView_User">ユーザ名：';
      print $user_name;
      echo '</div>';
      // レシピ名
      echo '<div class="ReleaceView_Recipe">';
      print $result["recipe_name"];
      echo '</div>';
      print '<br/>';

      // レシピ画像
      echo '<section class="ReleaceView_Set">
              <div class="ReleaceView_Image">
                   <img src="'.$icon.'">
                   <p class="caption"></p>';

      // 紹介文
      echo '<div class="ReleaceView_Intro">';
      echo $result["introductions"];
      echo '</div>
        </div>';

      // 材料＆量
      $material = explode(",", $result["material_names"]);
      $amounts = explode(",", $result["amounts"]);
      echo '<div class="ReleaceView_Table"><table>';
      echo '<tr>
              <th class="ReleaceView_TableCaption">材料</th>
              <th class="ReleaceView_TableCaption">量</th>
            </tr>';
      for ($i = 0; $i < count($material); $i++){
        echo '<tr><td>'.$material[$i].'</td><td>'.$amounts[$i].'</td></tr>';
      }
      echo '</table></div></section>';
      print '<br/>';
      
      // 調理方法
      $procedures = explode(",", $result["procedures"]);
      
      $images = explode(",",$result['img_name']);
      echo '<h2 class="ReleaceView_Method">作り方</h2>';
      for ($i = 0; $i < count($procedures); $i++){
        echo '<div class="ReleaceView_Proc">';
        echo '<div class="ReleaceView_ProcP"> ['.($i+1).'] '.$procedures[$i].'</div>';
        if($images[$i] != null){
          echo 
            "
            <img src=".$images[$i]."  width='100px'>
            ";
        }
        echo "<br/>";
        echo "</div>";
      }

      
    ?>

    <form action="delete_recipe.php" method="post">
      <input type="hidden" name="id" value="<?php print $_GET["id"];?>">
      <input type="submit" value="レシピ削除" class="myrecipeview_deleteButton">
    </form>

    <form action="myrecipe_update.php" method="get">
      <input type="hidden" name="id" value="<?php print $_GET["id"];?>">
      <input type="submit" value="レシピ編集" class="myrecipeview_deleteButton">
    </form>
    <!-- <div height='100%' style='text-align: right'> </div>-->
  </body>
</html>
