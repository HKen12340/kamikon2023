<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../../../style.css">
  <title>Document</title>
</head>
<body>
<?php
  require("../../../database/identification_model.php");

  $material_list = [
  ["eg" => "","ja" => "人参"],
  ["eg" => "","ja" => "ジャガイモ"],
  ["eg" => "meat","ja" => "肉"],
  ["eg" => "","ja" => "トマト"],
  ["eg" => "Egg","ja" => "卵"],
];

  $upload = "sample-images/target-image.jpg";
  move_uploaded_file($_FILES['img']['tmp_name'], $upload);

  $cmd = 'CCRVision.bat';
  echo exec($cmd,$opt);
  unlink($upload);
  unset($opt[0],$opt[1],$opt[2],$opt[3]);
  $name = "";
  foreach($opt as $label){
    foreach($material_list as $material){
      if (false !== strstr($material["eg"], $label)) {
        $name = $material["ja"];
      }
    }
  }
  
  $Ide = new identification_model();
  $result = $Ide->RecipeSreach($name);
  print "<div class='index_f-container'>";
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