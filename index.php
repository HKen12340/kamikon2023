<!DOCTYPE html>
<html lang="en">
  <?php require('components/header.php'); ?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>Document</title>
</head>
<body>

<div class="index_f-container">
  <?php
  require("database/recipe_model.php");
  $recipe = new Recipe_model;
  $result = $recipe->get_recipeList(1);
  foreach($result as $res){
    print '
    <div class="index_f-item">
      <a href = "./content/release_recipe/release_view/release_view.php?id='.$res["id"].'">'.
        '<img src='.$res["icon"].'>'.'</img>'.$res["recipe_name"].'
      </a>
      <p>by '.$res['user_name'].'</p>
    </div>';
 }
  ?>
</div>
<footer>
</footer>
</body>
</html>
