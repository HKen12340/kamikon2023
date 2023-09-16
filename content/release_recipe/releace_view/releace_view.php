<?php $cssPath = "../../../style.css"; ?>
<?php
  require("../../../database/recipe_model.php");
  $recipe = new Recipe_model;
  $result = $recipe->get_recipe($_GET["id"]);
  $title = $result["recipe_name"];
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <link rel="stylesheet" type="text/css" href="<?php echo $cssPath; ?>">
    <title><?php echo $title; ?></title>
  </head>
  <body>
    <?php
      print $result["recipe_name"];
      print $result["introductions"];
      $material = explode(",", $result["material_names"]);
      $amounts = explode(",", $result["amounts"]);
      $procedures = explode(",", $result["procedures"]);
      print '<br/>';

      echo '<div class="ReleaceView_Table"><table>';
      echo '<tr><th>材料</th><th>量</th>';
      for ($i = 0; $i < count($material); $i++){
        echo '<tr><td>'.$material[$i].'</td><td>'.$amounts[$i].'</td></tr>';
      }
      echo '</table></div>';

      print '<br/>';
      for ($i = 0; $i < count($procedures); $i++){
        echo '['.($i+1).'] '.$procedures[$i].'<br/>';
      }
    ?>
  </body>
</html>
