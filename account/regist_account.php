<?php
  require('../components/header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style.css">
  <title>Cooking-Cross</title>
</head>
<body>
  <div class="RegistAccount_content">
    <form action="">
      <table>
        <tr class="RegistAccount_td">
          <label for="">ニックネーム</label>
        </tr>
        <tr>
          <td><input type="text" name="name" class="RegistAccount_ip"></td>
        </tr>
        <tr class="RegistAccount_td"><td><label for="">メールアドレス</label></td></tr>
        <tr>
          <td><input type="mail" name="email" class="RegistAccount_ip"></td>
        </tr>
        <tr class="RegistAccount_td">
          <td><label for="">パスワード</label></td>
        </tr>
        <tr>
          <td><input type="password" name="password" class="RegistAccount_ip"></td>
        </tr>
        <tr class="RegistAccount_td">
          <td class="RegistAccount_btn">
              <input type="submit" value="登録" class="RegistAccount_submit">
          </td>
        </tr>
      </table>
    </form>
  </div>
</body>
</html>
