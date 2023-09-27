<?php
require("../../../database/recipe_model.php");
require('../../../database/question_model.php');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header("Content-type: application/json; charset=UTF-8");

$ques = new Recipe_model();
$point = new Question_model();
$input_json = file_get_contents('php://input');
$post = json_decode( $input_json, true );

$result["RecipeInfo"] = $ques->get_recipe($post["id"]);
$result["RecipePoint"] = $point->GetRecipePoint($post["id"]);
echo json_encode($result);
// echo "2";