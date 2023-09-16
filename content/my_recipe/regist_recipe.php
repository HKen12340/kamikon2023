<!DOCTYPE html>
<html lang="en">
  <?php
 require('../../components/header.php'); 
 require('../../database/recipe_model.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
  if(empty($_SESSION['user_id'])){
      header('location:../../login.view.php');
  }
 if(!empty($_POST)){
  $res = new Recipe_model();
  $res->create_recipe($_POST); 
  header('location: myrecipe_list.php');
 }
 ?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../style.css">
  <title>Document</title>
  <script src="/kamikon2023/asset/jquery-3.7.0.min.js"></script>
</head>
<body class="registrecipe_page">
<form enctype="multipart/form-data" method="post">
  <p class="registrecipe_title">レシピ名</p>
  <input type="text" name="recipe_name" class="registrecipe_input-recipe">
  <p class="registrecipe_intro">紹介文</p>
<textarea cols="50" rows="10" name="introductions" class="registrecipe_intro-text"></textarea>
  <table class="textbox">
    <tr>
      <th></th>
      <th class="registrecipe_mate">材料</th>
      <th class="registrecipe_amou">量</th>
      <th></th>
    </tr>
    <tr>
      <td><input type="text" name="matelial[]" class="registrecipe_mate-text"></td>
      <td><input type="text" name="amount[]" class="registrecipe_amou-text"></td>
    </tr>
  </table>
  <button type="button" class="add registrecipe_add1" >追加</button>
  <button type="button" class="delete registrecipe_delete1">削除</button>
  <p class="registrecipe_method">調理手順</p>
  <table class="textarea">
  <tr>
    <td><p class="registrecipe_method-num">1.</p><textarea name="procedures[]" class="prod_textarea registrecipe_method-text" cols="50" rows="10"></textarea></td>
  </tr>
  </table>

  <button type="button" class="prod_add registrecipe_add2">追加</button>
  <button type="button" class="prod_delete registrecipe_delete2">削除</button>
  <p class="registrecipe_icon1">レシピアイコン</p>
    
  <div class="RegistRecipe_Iconform">
      この領域をクリックして画像ファイルを指定してください
      <input type="file" name="iconfile" accept="image/*" />
    </div>
    <p id="Iconpics" class="registrecipe_Iconpics"></p>

    <p class="registrecipe_icon2">レシピ画像</p>
    <div class="RegistRecipe_Picform">
      この領域をクリックして画像ファイルを指定してください
      <input type="file" name="imagefile[]" accept="image/*" multiple />
    </div>
    <p id="Imgpics" class="registrecipe_Imgpics"></p>

  <?php 
  $point_names = [
    "label_name" => ["時間ポイント","予算ポイント","量ポイント","肉料理ポイント","魚料理ポイント","野菜料理ポイント"],
    "select_name" => ["time_point","money_point","volume_point","meat_point","fish_point","vegetable_point"]
  ];
  for($i = 0;$i < count($point_names["label_name"]);$i++){
    print"
    <p class='registrecipe_point-title'>
    <label for=''>".$point_names["label_name"][$i]."・・・
      <select name=".$point_names["select_name"][$i]." id='' class='registrecipe_point'>
        <option value='1'>1</option>
        <option value='2'>2</option>
        <option value='3'>3</option>
      </select>  
    </label>
    </p>";
  }
?>

<p class='registrecipe_pub'>レシピを
  <select name="" id="" class="registrecipe_pub-sel">
    <option value="">公開</option>
    <option value="">非公開</option>
  </select>
</p>

    <input type="submit" value="レシピ登録" class="registrecipe_reg">
  </form>
    
  <script src="/kamikon2023/asset/file2.js"></script>
  <script>
    let count = 0;
    $(".add").on("click",function(){
        $(".textbox").append(`
          <tr class="ip_text${count}">
            <td><input type="text" name="matelial[]" class="registrecipe_mate-text"></td>
            <td><input type="text" name="amount[]" class="registrecipe_amou-text"></td>
          </tr>
        `);
        count++;
    });
    $(".delete").on("click",function(){
        $(`.ip_text${count}`).remove();
        count--;
    });

    let prod_count = 1;
    $(".prod_add").on("click",function(){
      prod_count++;
        $(".textarea").append(`
          <tr class="prod_textarea${prod_count}">
            <td><p class="registrecipe_method-num">${prod_count}.</p>
            <textarea name="prod[]" cols="50" rows="10" class="registrecipe_method-text"></textarea></td>
          </tr>
        `);
    });
    $(".prod_delete").on("click",function(){
        $(`.prod_textarea${prod_count}`).remove();
        prod_count--;
    });
  </script>
</html>
</body>
