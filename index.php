<!DOCTYPE html>
<html lang="en">
  <?php require('components/header.php'); ?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php
    require("database/recipe_model.php");
    $recipe = new Recipe_model();
    print($recipe->maxpage());
  ?>
</body>
</html>