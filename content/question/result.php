<!DOCTYPE html>
<html lang="en">
  <?php require('../../components/header.php'); ?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../../style.css">
  <title>Document</title>
</head>
<body>
  <h2 style="text-align:center">おすすめレシピ</h2>
<div class="index_f-container">
  <?php
require("../../database/question_model.php");


  $ques = new Question_model();
  $result = $ques->GetRecipes($_COOKIE["Ques_ansawer"]);
  foreach($result as $res){
    print '
    <div class="index_f-item">
      <a href = "/kamikon2023/content/release_recipe/releace_view/releace_view.php?id='.$res["id"].'">'.
        '<img src='.$res["icon"].'>'.'</img>'.$res["recipe_name"].'
      </a>
      <p>by '.$res['user_name'].'</p>
    </div>';
  }
  print '</div>'; //index_f-containerクラスここまで

?>
</body>
</html>