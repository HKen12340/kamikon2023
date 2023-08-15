<?php
  require '../database/user_model.php';
  $user = new User();
  $user->user_logout();
  header('location:/kamikon2023/index.php');
?>