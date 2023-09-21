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
  require("VisionApi.php");
  $material_list = [
    ["eg" => "","ja" => "人参"],
    ["eg" => "Potato","ja" => "ジャガイモ"],
    ["eg" => "meat","ja" => "肉"],
    ["eg" => "beef","ja" => "肉"],
    ["eg" => "pork","ja" => "肉"],
    ["eg" => "","ja" => "トマト"],
    ["eg" => "egg","ja" => "卵"],
  ];

  $upload = "sample-images/target-image.jpg";
  unlink($upload);
  move_uploaded_file($_FILES['img']['tmp_name'], $upload);

  $result = GetLabel();
  unset($result[0],$result[1]);
  $name = "";
  foreach($result as $label){
    foreach($material_list as $material){
      if (false !== strstr(strtolower($material["eg"]), strtolower($label))) {
        $name = $material["ja"];
      }
    }
  }

  
  $Ide = new identification_model();
  $result = $Ide->RecipeSreach($name);
  
  //ヘッダー呼び出し
  require('../../../components/header.php');

  //材料リストにしているかつRecipiテーブルに対象の材料を使ったレシピが存在する
  if($name != "" && count($result) >= 1){
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
  }else{
    print '
    <div">
      <h1 style="  display: flex;
      justify-content: center;
      align-items: center;">対象の材料を使ったレシピが見つかりませんでした</h1>
    </div>
    ';
  }
?>
</body>
  </html>