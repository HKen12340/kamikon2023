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
  include('../database/user_model.php');
  include('../database/validation.php');

  if(!empty($_POST)){
    $user = new User();
    $valid = new Validation();

    //ユーザ作成
    if(strlen($_POST['name']) > 0 && strlen($_POST['email']) > 0){
      if(!$valid->name_dupcheck($_POST['name']) && !$valid->mail_dupcheck($_POST['email'])){
        $user->create_user($_POST['name'],$_POST['email'],$_POST['password']);
        header('Location: ../login.view.php');
      }
    }
  
  //エラーメッセージ表示
  if($valid->name_dupcheck($_POST['name']) && strlen($_POST['name']) > 0){
    print '<p>このニックネームは既に登録されています。</p>';
  }

  if($valid->mail_dupcheck($_POST['email']) && strlen($_POST['email']) > 0){
    print '<p>このメールアドレスは既に登録されています。</p>';
  }

  if(empty($_POST['name'])){
    print '<p>ニックネームの入力は必須です。</p>';
  }

  if(empty($_POST['email'])){
    print '<p>メールアドレスの入力は必須です。</p>';
  }

  if(empty($_POST['password'])){
    print '<p>メールアドレスの入力は必須です。</p>';
  }
}

?>
  <section class = "RegistAccount_Card">
    <p class="RegistAccount_Cardtitle">ユーザー登録</p>
    <form method="post">
      <table>
        <tr>
          <td><input type="text" name="name" class="RegistAccount_ip" placeholder="ユーザー名" required></td>
        </tr>
        <tr>
          <td><input type="email" name="email" class="RegistAccount_ip" placeholder="メールアドレス" required></td>
        </tr>
        <tr>
          <td><input type="password" name="password" class="RegistAccount_ip" placeholder="パスワード" required></td>
        </tr>
        <tr>
          <td class="RegistAccount_submit">
              <input type="submit" value="登録">
          </td>
        </tr>
      </table>
    </form>
    </section>
  </div>
</body>
</html>
