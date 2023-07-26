<!DOCTYPE html>
<html lang="en">
  <?php
 require('../../components/header.php'); ?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="/kamikon2023/asset/jquery-3.7.0.min.js"></script>
</head>
<body>
  <p>レシピ名</p>
  <input type="text">
  <p>紹介文</p>
<textarea cols="50" rows="10"></textarea>
  <table class="textbox">
    <tr>
      <th></th>
      <th>材料</th>
      <th>量</th>
      <th></th>
    </tr>
    <tr>
      <td><button class="add">追加</button></td>
      <td><input type="text" name="matelial[]"></td>
      <td><input type="text" name="amount[]"></td>
      <td><button class="delete">削除</button></td>
    </tr>
  </table>
  <p>調理手順</p>
  <table class="textarea">
  <tr>
    <td><p>1.</p><textarea name="prod[]" class="prod_textarea" cols="50" rows="10"></textarea></td>
  </tr>
  </table>
  <button class="prod_add">追加</button><button class="prod_delete">削除</button>

  <form method="post" enctype="multipart/form-data" action="">
     <input type="file" name="up[]" multiple>
     <input type="submit" value="アップロード">
   </form>
  <p id="pics"></p>
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
        $(`.ip_text${count}`).remove();
        count--;
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
    });

  </script>
</html>
</body>
