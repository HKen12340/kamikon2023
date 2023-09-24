<?php
require("../../database/question_model.php");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header("Content-type: application/json; charset=UTF-8");

$ques = new Question_model();
$input_json = file_get_contents('php://input');
$post = json_decode( $input_json, true );

$result = $ques->QuestionResult($post);
echo json_encode($result);