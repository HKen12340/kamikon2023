<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>Cooking-Cross</title>
</head>
<body>
<?php require './components/header.php';	
      require './config/user_model.php';

      if(!empty($_POST)){
      $user = new User();
      if($user->user_login($_POST['email'],$_POST['password'])){
        header('Location: login_db.php');
      }
    }
?>

<form name="login_form" method="post">
  <div class="loginview_form">
    <div>
      <p class = "loginview_mlad">メールアドレス</p>
      <input type="email" name="email" class="loginview_ip1"><br>
      <p class = "loginview_pswd">パスワード</p>
      <input type="password" name="password" class="loginview_ip2">
    </div>
    <button type="submit" class="loginview_rgin">ログイン</button>
  </div>
</form>
<a href="./account/regist_account.php" class="loginview_new">アカウントをお持ちでない方はこちら</a>
</body>
</html>
