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
  <main class="registrecipe_content">
  <h1 class="registrecipe_h1">レシピ作成</h1>
  
<form enctype="multipart/form-data" method="post" class="registrecipe_form">
  <p class="registrecipe_category">レシピ名</p>
  <input type="text" name="recipe_name" class="registrecipe_inputRecipeName" required>

  <p class="registrecipe_category">紹介文</p>
  <textarea rows="10" name="introductions" class="registrecipe_inputRecipeIntro" required></textarea>

  <table class="textbox">
    <tr>
      <th class="registrecipe_category">材料</th>
      <th class="registrecipe_category">量</th>
    </tr>
    <tr>
      <td class="registrecipe_TdRightPadding"><input type="text" name="matelial[]" class="registrecipe_inputMaterial" required></td>
      <td class="registrecipe_TdLeftPadding"><input type="text" name="amount[]" class="registrecipe_inputAmount" required></td>
    </tr>
  </table>

  <div class="registrecipe_MatelialButtonArea">
    <button type="button" class="add registrecipe_addButton" >追加</button>
    <button type="button" class="delete registrecipe_deleteButton">削除</button>
  </div>

  <p class="registrecipe_category">調理手順</p>
  <div class="registrecipe_category"> 
    レシピアイコン：<input type="file" name="iconfile" accept="image/*" >
  </div>
  

  <table class="textarea">
  </table>

  <div class="registrecipe_MatelialButtonArea">
  <button type="button" class="prod_add registrecipe_addButton">追加</button>
  <button type="button" class="prod_delete registrecipe_deleteButton">削除</button>
  </div>


  <p class="registrecipe_category">点数入力(「今日の献立を決める」モードで使用します)</p>
  <?php 
  $point_names = [
    "label_name" => ["時間ポイント","予算ポイント","量ポイント","肉料理ポイント","魚料理ポイント","野菜料理ポイント"],
    "select_name" => ["time_point","money_point","volume_point","meat_point","fish_point","vegetable_point"]
  ];
  for($i = 0;$i < count($point_names["label_name"]);$i++){
    print"
    <p class='registrecipe_pointName'>
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
<div class="registrecipe_MatelialButtonArea">
    <input type="submit" value="レシピ登録" class="registrecipe_submit">
</div>
  </form>
  </main>
  <script>

    let count = 0;
    
    $(".add").on("click",function(){
        $(".textbox").append(`
          <tr class="ip_text${count}">
            <td class="registrecipe_TdRightPadding"><input type="text" name="matelial[]" class="registrecipe_inputMaterial" required></td>
            <td class="registrecipe_TdLeftPadding"><input type="text" name="amount[]" class="registrecipe_inputAmount" required></td>
          </tr>
        `);
        count++;
    });

    $(".delete").on("click",function(){
        count--;
        $(`.ip_text${count}`).remove();
    });

    let prod_count = 1;

    $(".textarea").append(`
          <tr class="prod_textarea${prod_count}">
            <td>
              <p class="registrecipe_recipeNum">${prod_count}.</p>
              <textarea rows="10" name="prod[]" class="registrecipe_inputRecipe" required></textarea>
              <div class="registrecipe_category"> 
              画像追加：<input type="file" name="iconfile" accept="image/*">
              </div>
            </td>
          </tr>
        `);

    $(".prod_add").on("click",function(){
      prod_count++;
        $(".textarea").append(`
          <tr class="prod_textarea${prod_count}">
            <td>
              <p class="registrecipe_recipeNum">${prod_count}.</p>
              <textarea name="prod[]" rows="10" class="registrecipe_inputRecipe" required></textarea>
              <div class="registrecipe_category"> 
              画像追加：<input type="file" name="iconfile" accept="image/*">
              </div>
            </td>
          </tr>
        `);
    });

    $(".prod_delete").on("click",function(){
      if(prod_count > 1){
        $(`.prod_textarea${prod_count}`).remove();
        prod_count--;
      }
    });
  </script>

</body>
</html>
