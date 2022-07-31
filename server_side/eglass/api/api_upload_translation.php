<?php
include_once("../lib/lib.dbConnection.php");
include_once("../config/constants.inc.php");
include_once("../lib/lib.commonFunc.php");
include_once("../lib/lib.sysFunc.php");
include_once("../lib/lib.syslog.php");

//ini_set("display_errors",1);

//$path_upload = "../uploads/";

$path_upload = "/opt/bitnami/apache2/htdocs/eglass/uploads/";

if(isset($_FILES['imgfile']['tmp_name']))
{
	if(is_uploaded_file($_FILES['imgfile']['tmp_name']))
	{ 
		echo "File '".$_FILES['imgfile']['name']."' uploaded successfully.\n";
		
		$filename = time()."_".$_FILES['imgfile']['name'];
		
		copy($_FILES['imgfile']['tmp_name'], $path_upload.$filename); 
		
		// Save filename in Database
		save_filename_in_db($filename,"translation");
		
		// Do OCR
		$ocr_text = do_ocr($filename);
		
		// Save OCR output in Database
		save_ocr_output($filename,$ocr_text,"translation");
		
		// Detect Language	
		$detected_lang_json = json_decode(do_gtranslate_detect($ocr_text),true);
		$detected_lang = $detected_lang_json['data']['detections'][0][0]['language'];
		
		// Translate
		$lang_src=$detected_lang;
		$lang_dest=get_default_lang();
		$translated_json = json_decode(do_gtranslate_translate($lang_src,$lang_dest,$ocr_text),true);		
		$translated_text = $translated_json['data']['translations'][0]['translatedText'];
		
		// Save Translated output in Database
		save_translation_output($filename,$translated_text);
		
	}
	else
	{ 
		echo "Error";
	}
}
else
{ 
	echo "File Not Sent";
}
?>