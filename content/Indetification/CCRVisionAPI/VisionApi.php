<?php
require __DIR__ . '/vendor/autoload.php';
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

function GetLabel(){
$imageAnnotator = new ImageAnnotatorClient();
$image = file_get_contents(__DIR__ . '/sample-images/target-image.jpg');// ここにファイル名
$response = $imageAnnotator->labelDetection($image);
$labels = $response->getLabelAnnotations();

$results = [];
if ($labels) {
    
    foreach ($labels as $label) {
         array_push($results,$label->getDescription());
    }
    
    // echo("Labels:" . PHP_EOL);
    // foreach ($labels as $label) {
    //     echo($label->getDescription() . PHP_EOL);
    // }
}
return $results;
}

