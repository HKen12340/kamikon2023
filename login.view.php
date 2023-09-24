<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" href="https://use.typekit.net/uhu1wwl.css">
  <title>Cooking-Cross</title>
</head>
<style>
.loginview_Cardtitle{
  text-align:center;
  font-family: lemongrass-script, sans-serif;
  font-weight: 700;
  font-style: normal; 
  font-size:30px;
  color:gray;
}
.loginview_ErrorMes{
  text-align: center;
  color: red;
}
</style>
<body>

  <section class="loginview_card">
    <h1 class="loginview_Cardtitle" >COOKING CROSS</h1>
    <form name="login_form" method="post">
      <table>
      <?php       
      require './database/user_model.php';

    if(!empty($_POST)){
      $user = new User();      
      if(strlen($_POST['email']) > 0 && strlen($_POST['password']) > 0){
        if($user->user_login($_POST['email'],$_POST['password'])){
          header('Location: index.php');
        }else{
          print '<div class="loginview_ErrorMes">
                  <label>メールアドレスかパスワードが間違っています</label>
                 </div>';
        }
      }

      if(empty($_POST['email'])){
        print '<div class="loginview_ErrorMes">
                <label>メールアドレスの入力は必須です</label>
               </div>';
      }
    
      if(empty($_POST['password'])){
        print '<div class="loginview_ErrorMes">
                <label>パスワードの入力は必須です</label>
               </div>';
      }
    }
?>
        <tr>
          <td class=""><input class="loginview_mlad" type="email" name="email" placeholder="メールアドレス" required></td>
        </tr>
        <tr>
          <td><input class="loginview_pswd" type="password" name="password" placeholder="パスワード" required></td>
        </tr>
        <tr>
          <td class="loginview_submit"><input type="submit" value="ログイン"></td>
        </tr>
      </table>
    </form>
    <div class="loginview_new">
      <a href="./account/regist_account.php">アカウントをお持ちでない方はこちら</a>
    </div>
  </section>
</body>
</html>
