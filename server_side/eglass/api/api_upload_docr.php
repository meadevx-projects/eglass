<?php
include_once("../lib/lib.dbConnection.php");
include_once("../config/constants.inc.php");
include_once("../lib/lib.commonFunc.php");
include_once("../lib/lib.sysFunc.php");
include_once("../lib/lib.syslog.php");

//ini_set("display_errors",1);

//$path_upload = "../uploads/";

ini_set("display_errors",1);
error_reporting(E_ALL);

$path_upload = "/opt/bitnami/apache2/htdocs/eglass/uploads/";

if(isset($_FILES['imgfile']['tmp_name']))
{
	if(is_uploaded_file($_FILES['imgfile']['tmp_name']))
	{ 
		echo "File '".$_FILES['imgfile']['name']."' uploaded successfully.\n";
		
		$filename = time()."_".$_FILES['imgfile']['name'];
		
		copy($_FILES['imgfile']['tmp_name'], $path_upload.$filename); 
		
		// Save filename in Database
		save_filename_in_db($filename,"docr");
		
		// Do OCR
		$ocr_text = do_ocr($filename);
		
		// Save OCR output in Database
		save_ocr_output($filename,$ocr_text,"docr");
		
		// Run MapReduce Job
		$job_output = do_cooccuring_wc_job($filename);
				
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