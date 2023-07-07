<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
<!--     <link rel="stylesheet" href="../style.css" type="text/css"> -->
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
          font-size:30px;
          font-weight:bold;
          margin-right:20px;
          margin-left:20px;
        }
        
        .logo{
          width:100px;
          height:80px;
          margin-right:auto;
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
        <h1 class="title">COOKING CROSS</h1>
        <img class="logo" src="/kamikon2023/components/image/sample_logo.png" alt="ロゴ">
        <nav class="hnav">
          <ul>
            <li><a href="#">Myレシピ</a></li>
            <li><a href="#">みんなのレシピ</a></li>
            <li><a href="#">レシピ検索</a></li>
            <li><a href="#">献立を決める</a></li>
            <li><a href="#">ログイン</a></li>
          </ul>
        </nav>
      </div>
    </header>
  </body>
</html>