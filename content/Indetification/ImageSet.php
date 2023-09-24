<html>
  <head>
  <link rel="stylesheet" type="text/css" href="../../style.css">
  </head>
  <?php require('../../components/header.php'); ?>
  <body>
    <form action="CCRVisionAPI/GetLabel.php" enctype="multipart/form-data" method="post">
      <input type="file" name="img" accept="">
      <input type="submit" value="送信">
    </form>
  </body>

</html>
