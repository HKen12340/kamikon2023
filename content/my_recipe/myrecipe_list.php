<!DOCTYPE html>
<html lang="en">
<?php require('../../components/header.php'); ?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../../style.css">
  <title>Document</title>
</head>

<body class="myrecipelist_page">
<div class="myrecipelist_HedContent">
  <?php 
    require('../../database/user_model.php');
    $user = new User();
    $result = $user->user_info($_SESSION["user_id"]);
    print '<p class="myrecipelist_user">ユーザ名:'.$result["user_name"].'</p>';
  ?>
  <h2 class="myrecipelist_title">Myレシピ一覧</h2>    
  <a href="regist_recipe.php" class="myrecipelist_make">レシピ作成</a>
</div>

<div class="index_f-container">
  <?php 
    require('../../database/recipe_model.php');
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
  }

    if(empty($_SESSION['user_id'])){
      header('location:../../login.view.php');
    }

    $recipe = new Recipe_model();
 
 if(!isset($_GET['page_id'])){
  $now = 1;
}else{
  $now = $_GET['page_id'];
}
$result = $recipe->get_MyrecipeList($now,$_SESSION["user_id"]);
if($result == null){
  print '<h2 style = "text-align:center">レシピはまだ登録されていません</h2>';
}else{
  foreach($result as $res){
    print '
    <div class="index_f-item">
      <a href = "../release_recipe/releace_view/releace_view.php?id='.$res["id"].'">'.
        '<img src='.$res["icon"].'>'.'</img>'.$res["recipe_name"].'
      </a>
    </div>';
  }
  print '</div>'; //index_f-containerクラスここまで
}

if($result != null){
  $max_page = $recipe->maxMypage($_SESSION['user_id']);
  $max_recipe = $recipe->maxMyrecipe($_SESSION['user_id']);
  $from_record = ($now - 1) * 6 + 1;

  if($now == $max_page && $max_recipe % 5 !== 0) {
    $to_record = ($now - 1) * 6 + $max_recipe % 6;
  } else {
    $to_record = $now * 6;
  }

  if($now == 1 || $now == $max_page) {
    $range = 4;
  } elseif ($now == 2 || $now == $max_page - 1) {
    $range = 3;
  } else {
    $range = 2;
  }

  print '<section class="index_footer">';
  if ($now >= 2){
  print'<ul class="index_Pagination"><li class="index_Pagination-Item"><a class="index_Pagination-Item-Link" href="./myrecipe_list.php?page_id='.''.($now - 1).''.'"><svg xmlns="http://www.w3.org/2000/svg" class="index_Pagination-Item-Link-Icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
  </svg></a></li>';}
  else{
    print '<ul class="index_Pagination"><li class="index_Pagination-Item"><div class="index_Pagination-Item-Link isActive"><svg xmlns="http://www.w3.org/2000/svg" class="index_Pagination-Item-Link-Icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
    <path stroke-linecap="round" stroke-linejoin="round" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
  </svg><div></li>';
  }

  for ($i = 1; $i <= $max_page; $i++){
    if($i >= $now - $range && $i <= $now + $range){
        if($i == $now){
            print ' <li class="index_Pagination-Item"> <div class="index_Pagination-Item-Link isActive">'.'<span>'. $i.'</span>';}
        else{
          print ' <li class="index_Pagination-Item"> <a class="index_Pagination-Item-Link" href="myrecipe_list.php?page_id='.''.$i.''.' ">'.'<span>'. $i.'</span>'. '</a>';
        }
        }
      }

  if($now < $max_page){
    print ' <li class="index_Pagination-Item">
    <a class="index_Pagination-Item-Link" href="myrecipe_list.php?page_id='.''.($now + 1).''.'">
        <svg xmlns="http://www.w3.org/2000/svg" class="index_Pagination-Item-Link-Icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
        </svg>
    </a>
  </li>
  </ul>';
  }else{
    print '<li class="index_Pagination-Item"><div class="index_Pagination-Item-Link isActive"><svg xmlns="http://www.w3.org/2000/svg" class="index_Pagination-Item-Link-Icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
    <path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
  </svg>
  </div>
  </li>
  </ul>';
  }
  print "<p class='index_search'>$max_recipe 件中 $from_record - $to_record 件目を表示</p> ";
}
  ?>

 </section>

</body>
</html>
