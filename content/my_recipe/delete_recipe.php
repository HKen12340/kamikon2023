<?php
require("../../database/recipe_model.php");

$recipe_id = htmlspecialchars($_POST["id"] ,ENT_QUOTES, 'UTF-8');
$recipe = new Recipe_model();

print($recipe->delete_recipe($recipe_id));

header('location: myrecipe_list.php');