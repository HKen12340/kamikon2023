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
			?>


<a href="" class="loginview_new">アカウントをお持ちでない方はこちら</a>

<form name="login_form">
  <div>
　　<p class = "loginview_mlad">メールアドレス</p>
  <input type="id" name="user_id" class="loginview_ip1"><br>
    <p class = "loginview_pswd">パスワード</p>
    <input type="password" name="password" class="loginview_ip2">
  </div>
  <button type="submit" class="loginview_rgin">ログイン</button>
</form>


</body>

</html>


