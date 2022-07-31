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
		save_filename_in_db($filename,"qrcode");
		
		// Decode QRCode
		$qrcode_decoded = json_decode(do_qrcode_decode($filename),true);
		//var_dump($qrcode_decoded);
		$qrcode_decoded_text = $qrcode_decoded[0]['symbol'][0]['data'];
		//var_dump($qrcode_decoded_text);
		
		// Save OCR output in Database
		save_qrcode_decoded($filename,$qrcode_decoded_text);
			
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