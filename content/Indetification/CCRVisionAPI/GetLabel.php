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
    ["eg" => "Carrot","ja" => "人参"],
    ["eg" => "Potato","ja" => "じゃがいも"],
    ["eg" => "meat","ja" => "肉"],
    ["eg" => "beef","ja" => "肉"],
    ["eg" => "pork","ja" => "肉"],
    ["eg" => "Tomato","ja" => "トマト"],
    ["eg" => "Egg","ja" => "卵"],
    ["eg" => "Bell Pepper","ja" => "ピーマン"],
    ["eg" => "Onion","ja" => "玉ねぎ"],
    ["eg" => "Fish","ja" => "魚"],
    ["eg" => "Mushroom","ja" => "マッシュルーム"],
    ["eg" => "Garlic","ja" => "ニンニク"],
    ["eg" => "Ginger","ja" => "生姜"],
    ["eg" => "Cabbage","ja" => "キャベツ"],
    ["eg" => "Cocoa Butter","ja" => "バター"],
    ["eg" => "Pumpkin","ja" => "かぼちゃ"],
    ["eg" => "Salmon","ja" => "サーモン"],
    ["eg" => "Rice","ja" => "米"],
    ["eg" => "Spam","ja" => "スパム"],
    ["eg" => "Shrimp","ja" => "エビ"],
    ["eg" => "Cheese","ja" => "チーズ"],
    ["eg" => "Cucumber","ja" => "きゅうり"],
    ["eg" => "Parsley","ja" => "パセリ"],
    ["eg" => "Eggplant","ja" => "ナス"],
    ["eg" => "Lemon","ja" => "レモン"],
    ["eg" => "Broccoli","ja" => "ブロッコリー"]
  ];

  require('../../../database/validation.php');
  $flag = true;
  $valid = new Validation();//アイコン拡張子チェック
  $flag = $valid->check_image($_FILES['img']['tmp_name']);

  if($flag == true){
      $upload = "sample-images/target-image.jpg";
      unlink($upload);
      move_uploaded_file($_FILES['img']['tmp_name'], $upload);

      $result = GetLabel();
      unset($result[0],$result[1]);
      $name = "";
      foreach($result as $label){
        foreach($material_list as $material){
          if (strtolower($material["eg"]) == strtolower($label)) {
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
  }else{
    require('../../../components/header.php');
    print "<h1 style='text-align:center'>画像ファイルではありません</h1>";
  }
?>
</body>
  </html>