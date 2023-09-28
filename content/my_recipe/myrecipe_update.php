<!DOCTYPE html>
<html lang="en">

<?php

 require('../../components/header.php'); 
 require('../../database/recipe_model.php');
 require('../../database/validation.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(empty($_SESSION['user_id'])){
  header('location:../../login.view.php');
}
 if(!empty($_POST)){
  $flag = true;
  $valid = new Validation();//アイコン拡張子チェック
  $flag = $valid->check_image($_FILES["iconfile"]["tmp_name"]);

  if($flag == true){
    for($i = 1;$i <= count($_FILES) - 1;$i++){//画像拡張子チェック
      $flag = $valid->check_image($_FILES["imagefile$i"]["tmp_name"]);  
    }
  }
  if($flag == true){
    $res = new Recipe_model();
    $res->update_recipe($_POST);
    header('location: myrecipe_list.php');
  }
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
  <h1 class="registrecipe_h1">レシピ編集</h1>
  
<form enctype="multipart/form-data" method="post" class="registrecipe_form">
  <input type="hidden" name="recipe_id" value=<?php print $_GET["id"];?>>
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
    </tr>
  </table>

  <div class="registrecipe_MatelialButtonArea">
    <button type="button" class="add registrecipe_addButton">追加</button>
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
  <script src="../../../asset/jquery-ui.min.js"></script>
  <script>

      let url = new URL(window.location.href);
      let params = url.searchParams;

      let Data = {
        id:params.get('id')
      }

      let MatelialCount = 0;
      let prod_count = 1;

        fetch("http://localhost/kamikon2023/content/my_recipe/API/GetRecipeAPI.php",{
          method: 'POST',
          headers:{
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(Data)
        }) .then(response => response.json()) // 返ってきたレスポンスをjsonで受け取って次のthenへ渡す
          .then(json => {
             $(".registrecipe_inputRecipeName").val(json.RecipeInfo.recipe_name);
             $(".registrecipe_inputRecipeIntro").val(json.RecipeInfo.introductions);

             let MatelialArrary = json.RecipeInfo.material_names.split(",");
             let AmountsArrary = json.RecipeInfo.amounts.split(",");

            for(let i = 0;i < MatelialArrary.length;i++){
              $(".textbox").append(`
                <tr class="ip_text${MatelialCount}">
                  <td class="registrecipe_TdRightPadding"><input type="text" name="matelial[]" 
                  class="registrecipe_inputMaterial" value="${MatelialArrary[i]}" required></td>
                  <td class="registrecipe_TdLeftPadding"><input type="text" name="amount[]" class="registrecipe_inputAmount"
                  value="${AmountsArrary[i]}" required></td>
                </tr>
        `     );
              MatelialCount++;      
            }


            let ProceduresArrary = json.RecipeInfo.procedures.split(",");
            let ImgPathArrary = json.RecipeInfo.img_name.split(",");
            
            for(let i = 0;i < ProceduresArrary.length;i++){
              $(".textarea").append(`
                <tr class="prod_textarea${prod_count}">
                  <td>
                    <p class="registrecipe_recipeNum">${prod_count}.</p>
                    <textarea rows="10" name="prod[]" class="registrecipe_inputRecipe"
                      required>${ProceduresArrary[i]}</textarea>
                    <div class="registrecipe_category"> 
                    画像追加：<input type="file" name="imagefile${prod_count}" accept="image/*">
                    </div>
                    <img src="${ImgPathArrary[i]}" width="100px">
                  </td>
                </tr>
            `);
            prod_count++;
            }

            $('select[name = "time_point"]').val(json.RecipePoint.time_point);
            $('select[name = "money_point"]').val(json.RecipePoint.money_point);
            $('select[name = "volume_point"]').val(json.RecipePoint.volume_point);
            $('select[name = "meat_point"]').val(json.RecipePoint.meat_point);
            $('select[name = "fish_point"]').val(json.RecipePoint.fish_point);
            $('select[name = "vegetable_point"]').val(json.RecipePoint.vegetable_point);
          })
          .catch(error => {
             console.log(error); // エラー表示
          });

    
    $(".add").on("click",function(){
        $(".textbox").append(`
          <tr class="ip_text${MatelialCount}">
            <td class="registrecipe_TdRightPadding"><input type="text" name="matelial[]" 
            class="registrecipe_inputMaterial" required></td>
            <td class="registrecipe_TdLeftPadding"><input type="text" name="amount[]" 
            class="registrecipe_inputAmount" required></td>
          </tr>
        `);
        MatelialCount++;
    });

    $(".delete").on("click",function(){
        if(MatelialCount > 1){
          MatelialCount--;
          $(`.ip_text${MatelialCount}`).remove();
        }
    });


    $(".prod_add").on("click",function(){
      prod_count++;
        $(".textarea").append(`
          <tr class="prod_textarea${prod_count}">
            <td>
              <p class="registrecipe_recipeNum">${prod_count}.</p>
              <textarea name="prod[]" rows="10" class="registrecipe_inputRecipe" required></textarea>
              <div class="registrecipe_category"> 
              画像追加：<input type="file" name="imagefile${prod_count}" accept="image/*">
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
