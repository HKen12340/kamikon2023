<?php
  require("../../../database/recipe_model.php");
  $recipe = new Recipe_model;
  $result = $recipe->get_recipe($_GET["id"]);
  $title = $result["recipe_name"];

  require("../../../database/user_model.php");
  $user = new User;
  $user_info = $user->user_info($result["user_id"]);
  $user_name = $user_info["user_name"];
?>

<!DOCTYPE html>
<html lang="ja">
  <?php require('../../../components/header.php'); ?>
  <head>
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="slick/slick.css">
    <script src="../../../asset/jquery-3.7.0.min.js"></script>
    <script src="../../../asset/file3.js"></script>
    <script src="slick/slick.js"></script>
    <link rel="stylesheet" type="text/css" href="../../../style.css">
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
      echo '<section class="ReleaceView_Set"><div class="ReleaceView_Image"><div style="width: 500px; margin-top: 65px; margin-left: 200px;">';
      echo '<div align="left"><img src="../../../upload/1.jpg" width="500" height="300"><p class="caption"></p></div>';
      echo '</div>';
      print '<br/>';

      // 紹介文
      echo '<div class="ReleaceView_Intro">';
      echo $result["introductions"];
      echo '</div></div>';

      // 材料＆量
      $material = explode(",", $result["material_names"]);
      $amounts = explode(",", $result["amounts"]);
      echo '<div class="ReleaceView_Table"><table>';
      echo '<tr><th>材料</th><th>量</th>';
      for ($i = 0; $i < count($material); $i++){
        echo '<tr><td>'.$material[$i].'</td><td>'.$amounts[$i].'</td></tr>';
      }
      echo '</table></div></section>';
      print '<br/>';
      
      // 調理方法
      echo '<div class="ReleaceView_proc">';
      $procedures = explode(",", $result["procedures"]);
      for ($i = 0; $i < count($procedures); $i++){
        echo '['.($i+1).'] '.$procedures[$i].'<br/>';
      }
      echo '</div>';
    ?>
  </body>
</html>
