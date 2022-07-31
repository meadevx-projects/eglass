<?php
ini_set("display_errors",1);
require_once '../lib/tesseract_ocr/TesseractOCR/TesseractOCR.php';
$tesseract = new TesseractOCR('myimage.png');
$text = $tesseract->recognize();
echo PHP_EOL, "The recognized text is:", $text, PHP_EOL;

?>

