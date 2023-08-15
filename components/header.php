<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="https://use.typekit.net/uhu1wwl.css">
    <title>Cooking Cross</title>
    <style>
      @charset "UTF-8";
        * {	box-sizing:border-box;}

        body {
        margin:0;
        }

        .header{
          background:#4169e1;
          padding-left:20px;
        }

        .header > .container {
          height:90px;
          display:flex;
          color:#fff;
          align-items:center;
        }

        .title {
          margin-left: 10px;
          font-size:30px;
          font-family: lemongrass-script, sans-serif;
          font-weight: 700;
          font-style: normal;
          margin-right:auto;
          padding-top: 10px;
        }
        
        .logo{
          width:110px;
          height:65px;
          margin-right:10px;
        }
        
        .hnav ul li{
          display:inline-block;
        }
        
        .hnav ul li a{
          display:block;
          padding:2em;
          color:#fff;
          font-size:30;
          font-weight:bold;
          text-decoration:none;
        }
                
        .hnav ul li:hover{
          background:#3cb371;
        }
    </style>
  </head>
  <body>
    <header class="header">
      <div class="container">
      <img class="logo" src="/kamikon2023/components/image/sample_logo.png" alt="ロゴ">
        <h1 class="title">COOKING CROSS</h1>
        <nav class="hnav">
          <ul>
            <li><a href="/kamikon2023/content/my_recipe/myrecipe_list.php">Myレシピ</a></li>
            <li><a href="#">みんなのレシピ</a></li>
            <li><a href="#">レシピ検索</a></li>
            <li><a href="#">献立を決める</a></li>
            <?php 
              session_start();
              if(empty($_SESSION['user_id'])){
                print "<li><a href='/kamikon2023/login.view.php'>ログイン</a></li>";
              }else{
                print "<li><a href='/kamikon2023/account/logout.view.php'>ログアウト</a></li>";
              }
            ?>
          </ul>
        </nav>
      </div>
    </header>
  </body>
</html>