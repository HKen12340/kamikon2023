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

  <?php
  require('../config/user_model.php');
  require('../config/validation.php');

  if(!empty($_POST)){
    $user = new User();
    $valid = new Validation();

  if(!$valid->name_dupcheck($_POST['name']) && !$valid->mail_dupcheck($_POST['email'])){
    $user->create_user($_POST['name'],$_POST['email'],$_POST['password']);
  }

  if($valid->name_dupcheck($_POST['name'])){
    print '<p>このニックネームは既に登録されています。</p>';
  }


  if($valid->mail_dupcheck($_POST['email'])){
    print '<p>このメールアドレスは既に登録されています。</p>';
  }

}

?>

    <form method="post">
      <table>
        <tr class="RegistAccount_td">
          <label for="">ニックネーム</label>
        </tr>
        <tr>
          <td><input type="text" name="name" class="RegistAccount_ip"></td>
        </tr>
        <tr class="RegistAccount_td"><td><label for="">メールアドレス</label></td></tr>
        <tr>
          <td><input type="email" name="email" class="RegistAccount_ip"></td>
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
