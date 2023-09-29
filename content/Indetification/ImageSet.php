<html>
  <head>
  <link rel="stylesheet" type="text/css" href="../../style.css">
  <title>Cooking Cross</title>
  </head>
  <?php require('../../components/header.php'); ?>
  <body class="imageset_page">
  <h1 class="registrecipe_h1">画像識別</h1>
    <h2>冷蔵庫の中にある食材の写真から、可能な限り最適なレシピを提案します</h2>
    <form action="CCRVisionAPI/GetLabel.php" enctype="multipart/form-data" method="post">
      <input type="file" name="img" accept="image/*">
      <input type="submit" value="送信" class="myrecipelist_make">
    </form>
  </body>

</html>
