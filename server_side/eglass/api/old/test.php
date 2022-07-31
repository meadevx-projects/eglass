<?php

$newocr_api_key = "8cb7346bc07544a60dc910ee30424792";

$file = 'uploads/testimg1.jpg';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://api.newocr.com/v1/upload?key='.$newocr_api_key);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, array('file' => '@'.$file));
$result = curl_exec($ch);
echo $result;
curl_close ($ch);

?>

