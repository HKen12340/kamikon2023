<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>Cooking-Cross</title>
</head>
<body>
<?php 
      require './components/header.php';	
      require './config/user_model.php';

    if(!empty($_POST)){
      $user = new User();      
      if(strlen($_POST['email']) > 0 && strlen($_POST['password']) > 0){
        if($user->user_login($_POST['email'],$_POST['password'])){
          header('Location: login_db.php');
        }else{
          print '<p>メールアドレスかパスワードが間違っています</p>';
        }
      }

      if(empty($_POST['email'])){
        print '<p>メールアドレスの入力は必須です。</p>';
      }
    
      if(empty($_POST['password'])){
        print '<p>パスワードの入力は必須です。</p>';
      }
    }
?>

<form name="login_form" method="post">
  <div class="loginview_form">
    <div>
      <p class = "loginview_mlad">メールアドレス</p>
      <input type="email" name="email" class="loginview_ip1" required><br>
      <p class = "loginview_pswd">パスワード</p>
      <input type="password" name="password" class="loginview_ip2" required>
    </div>
    <button type="submit" class="loginview_rgin">ログイン</button>
  </div>
</form>
<a href="./account/regist_account.php" class="loginview_new">アカウントをお持ちでない方はこちら</a>
</body>
</html>
