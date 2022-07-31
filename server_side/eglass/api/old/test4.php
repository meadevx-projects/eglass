<?php
ini_set("display_errors",1);

//  tesseract /opt/bitnami/apache2/htdocs/eglass/uploads/ocr-test.jpg /opt/bitnami/apache2/htdocs/eglass/uploads/ocr-test

$path_upload = "/opt/bitnami/apache2/htdocs/eglass/uploads/";
$path_output = "/opt/bitnami/apache2/htdocs/eglass/uploads/";

exec("tesseract ".$path_upload."ocr-test.jpg ".$path_output."ocr-test");

echo file_get_contents($path_output."ocr-test.txt");
?>

