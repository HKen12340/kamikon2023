<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style.css">
  <title>Cooking Cross</title>
</head>
<style>
  .RegistAccount_ErrorMsg{
    text-align: center;
    color: red;
  }
</style>
<body>

  <div class="RegistAccount_content">
  
  <section class = "RegistAccount_Card">
    <p class="RegistAccount_Cardtitle">ユーザー登録</p>
    <form method="post">
      <table>
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
              print '<div class="RegistAccount_ErrorMsg">
                        <label>ユーザ名は既に登録されています。</label>
                     </div>';
            }

            if($valid->mail_dupcheck($_POST['email']) && strlen($_POST['email']) > 0){
              print '<div class="RegistAccount_ErrorMsg">
                       <label>このメールアドレスは既に登録されています。</label>
                     </div>';
            }

            if(empty($_POST['name'])){
              print '<div class="RegistAccount_ErrorMsg">
                        <label>ニックネームの入力は必須です。</label>
                      </div>';
            }

            if(empty($_POST['email'])){
              print '<div class="RegistAccount_ErrorMsg">
                        <label>メールアドレスの入力は必須です。</label>
                      </div>';
            }

            if(empty($_POST['password'])){
              print '<div class="RegistAccount_ErrorMsg">
                        <label>メールアドレスの入力は必須です。</label>
                      </div>';
            }
          }
        ?>
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
