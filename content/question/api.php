<?php
require("../../database/question_model.php");
header('Content-Type: application/json; charset=UTF-8');

if(isset($_GET['ques'])&& !preg_match('/[^0-9]/',$_GET['ques'])){
  $ques = new Question_model();
  $result = $ques->get_question($_GET['ques']);
  $arr['status'] = "yes";
  $arr["question"] = $result["ques"];
  $arr["YesPointType"] = explode(",",$result["YesPointType"]);
  $arr["NoPointType"] = explode(",",$result["NoPointType"]);

  $ButtonText = explode(",",$result["ButtonText"]);
  $arr["YesButtonText"] = $ButtonText[0];
  $arr["NoButtonText"] = $ButtonText[1];

}else{
    $arr['status'] = "no";
}
print json_encode($arr,JSON_PRETTY_PRINT);
?>