<?php
ini_set("display_errors",1);

$api_key="AIzaSyAp20GRBHJ2kV7UjhGxfdPSPzNoQN-npR0";
$lang_src="en";
$lang_dest="fr";

$qrystr=urlencode("Hello world");

echo file_get_contents("https://www.googleapis.com/language/translate/v2?key=".$api_key."&source=".$lang_src."&target=".$lang_dest."&q=".$qrystr);


?>

