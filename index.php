<!DOCTYPE html>
<html lang="en">
  <?php require('components/header.php'); ?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>Document</title>
</head>
<body>

<div class="index_f-container">
  <?php
  require("database/recipe_model.php");
  $recipe = new Recipe_model;
 
 if(!isset($_GET['page_id'])){
  $now = 1;
}else{
  $now = $_GET['page_id'];
}

$result = $recipe->get_recipeList($now);
foreach($result as $res){
  print '
  <div class="index_f-item">
    <a href = "./content/release_recipe/release_view/release_view.php?id='.$res["id"].'">'.
      '<img src='.$res["icon"].'>'.'</img>'.$res["recipe_name"].'
    </a>
    <p>by '.$res['user_name'].'</p>
  </div>';
}

 $max_page = $recipe->maxpage();

if($now > 1){ 
    print '<ul class="index_Pagination"><li class="index_Pagination-Item"><a class="index_Pagination-Item-Link" href="./index.php?page_id='.''.($now - 1).''.'"><svg xmlns="http://www.w3.org/2000/svg" class="index_Pagination-Item-Link-Icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
    <path stroke-linecap="round" stroke-linejoin="round" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
</svg></a></li>';
} else {
    print '<ul class="index_Pagination"><li class="index_Pagination-Item"><div class="index_Pagination-Item-Link isActive"><svg xmlns="http://www.w3.org/2000/svg" class="index_Pagination-Item-Link-Icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
    <path stroke-linecap="round" stroke-linejoin="round" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
</svg><div></li>';
}
  
for($i = 1; $i <= $max_page; $i++){
    if ($i == $now) {
        print ' <li class="index_Pagination-Item"> <div class="index_Pagination-Item-Link isActive">'.'<span>'. $i.'</span>'; 
    } else {
        print ' <li class="index_Pagination-Item"> <a class="index_Pagination-Item-Link" href="index.php?page_id='.''.$i.''.' ">'.'<span>'. $i.'</span>'. '</a>';
    }
}

if($now < $max_page){
  print ' <li class="index_Pagination-Item">
  <a class="index_Pagination-Item-Link" href="./index.php?page_id='.''.$max_page.''.'">
      <svg xmlns="http://www.w3.org/2000/svg" class="index_Pagination-Item-Link-Icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
      </svg>
    </a>
  </li>
  </ul>';
} else{
  print '<li class="index_Pagination-Item"><div class="index_Pagination-Item-Link isActive"><svg xmlns="http://www.w3.org/2000/svg" class="index_Pagination-Item-Link-Icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
  <path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
</svg>
</div>
</li>
</ul>';
}


  ?>

</div>
</body>
</html>
