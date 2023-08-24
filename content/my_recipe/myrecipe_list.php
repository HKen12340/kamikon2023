<!DOCTYPE html>
<html lang="en">
<?php require('../../components/header.php'); ?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<h2>Myレシピ一覧</h2>
  <?php 
    require('../../database/recipe_model.php');
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
  }
    if(empty($_SESSION['user_id'])){
      header('location:../../login.view.php');
    }

    $recipe = new Recipe_model();
    $result = $recipe->get_MyrecipeList(1,$_SESSION['user_id']);
    foreach($result as $res){
      print($res['recipe_name']."<br>");
    }
  ?>
  <a href="regist_recipe.php">レシピを作る</a>
</body>
</html>