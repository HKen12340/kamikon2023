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
<body>
<form enctype="multipart/form-data" method="post">
  <p>レシピ名</p>
  <input type="text" name="recipe_name">
  <p>紹介文</p>
<textarea cols="50" rows="10" name="introductions"></textarea>
  <table class="textbox">
    <tr>
      <th></th>
      <th>材料</th>
      <th>量</th>
      <th></th>
    </tr>
    <tr>
      <td><button type="button" class="add">追加</button></td>
      <td><input type="text" name="matelial[]"></td>
      <td><input type="text" name="amount[]"></td>
      <td><button type="button" class="delete">削除</button></td>
    </tr>
  </table>
  <p>調理手順</p>
  <table class="textarea">
  <tr>
    <td><p>1.</p><textarea name="procedures[]" class="prod_textarea" cols="50" rows="10"></textarea></td>
  </tr>
  </table>

  <button type="button" class="prod_add">追加</button>
  <button type="button" class="prod_delete">削除</button>
  <p>レシピアイコン</p>
    
  <div class="RegistRecipe_Iconform">
      この領域にアイコンファイルをドロップしてください
      <input type="file" name="iconfile" accept="image/*" />
    </div>
    <p id="Iconpics"></p>

    <p>レシピ画像</p>
    <div class="RegistRecipe_Picform">
      この領域にファイルをドロップしてください
      <input type="file" name="imagefile[]" accept="image/*" multiple />
    </div>

  <p id="Imgpics"></p>

  <?php 
  $point_names = [
    "label_name" => ["時間ポイント","予算ポイント","量ポイント","肉料理ポイント","魚料理ポイント","野菜料理ポイント"],
    "select_name" => ["time_point","money_point","volume_point","meat_point","fish_point","vegetable_point"]
  ];
  for($i = 0;$i < count($point_names["label_name"]);$i++){
    print"
    <p>
    <label for=''>".$point_names["label_name"][$i]."・・・
      <select name=".$point_names["select_name"][$i]." id=''>
        <option value='1'>1</option>
        <option value='2'>2</option>
        <option value='3'>3</option>
      </select>  
    </label>
    </p>";
  }
?>
<p>レシピを
  <select name="" id="">
    <option value="">公開</option>
    <option value="">非公開</option>
  </select>
</p>

    <input type="submit" value="送信">
  </form>
    
  <script src="/kamikon2023/asset/file2.js"></script>
  <script>
    let count = 0;
    $(".add").on("click",function(){
        $(".textbox").append(`
          <tr class="ip_text${count}">
            <td></td>
            <td><input type="text" name="matelial[]"></td>
            <td><input type="text" name="amount[]""</td>
            <td></td>
          </tr>
        `);
        count++;
    });
    $(".delete").on("click",function(){
        count--;
        $(`.ip_text${count}`).remove();
    });

    let prod_count = 1;
    $(".prod_add").on("click",function(){
      prod_count++;
        $(".textarea").append(`
          <tr class="prod_textarea${prod_count}">
            <td><p>${prod_count}.</p>
            <textarea name="prod[]" cols="50" rows="10"></textarea></td>
          </tr>
        `);
    });

    $(".prod_delete").on("click",function(){
        $(`.prod_textarea${prod_count}`).remove();
        prod_count--;
        if(prod_count == 0){
          prod_count = 1;
        }
    });
  </script>
</html>
</body>
