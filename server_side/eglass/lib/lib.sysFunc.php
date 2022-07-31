<?php

function save_qrcode_decoded($filename,$qrcode_decoded)
{
	global $dbObj;
	
	$updateQry="UPDATE qrcode_tasks SET qrc_decoded='".mysql_real_escape_string($qrcode_decoded)."' 
				WHERE qrc_imgfile = '".$filename."' ";
	$updateRes=$dbObj->fireQuery($updateQry,"update");

}

function save_translation_output($filename,$translated_text)
{
	global $dbObj;
	
	$updateQry="UPDATE translation_tasks SET trn_transtext='".mysql_real_escape_string($translated_text)."' 
				WHERE trn_imgfile = '".$filename."' ";
	$updateRes=$dbObj->fireQuery($updateQry,"update");

}

function save_ocr_output($filename,$ocr_text,$dbname)
{
	global $dbObj;
	
	$prefix="";
	if($dbname=="translation")
	{
		$prefix="trn";
	}
	elseif($dbname=="docr")
	{
		$prefix="docr";
	}
	elseif($dbname=="qrcode")
	{
		$prefix="qrc";
	}
	
	
	$updateQry="UPDATE ".$dbname."_tasks SET ".$prefix."_ocrtext='".mysql_real_escape_string($ocr_text)."' 
				WHERE ".$prefix."_imgfile = '".$filename."' ";
	$updateRes=$dbObj->fireQuery($updateQry,"update");

}

function save_filename_in_db($filename,$dbname)
{
	global $dbObj;
	
	$mysqlnow=date('Y-m-d H:i:s');
	
	$prefix="";
	if($dbname=="translation")
	{
		$prefix="trn";
	}
	elseif($dbname=="docr")
	{
		$prefix="docr";
	}
	elseif($dbname=="qrcode")
	{
		$prefix="qrc";
	}
	
	
	$insertQry="INSERT INTO ".$dbname."_tasks SET 
				".$prefix."_imgfile='".$filename."', 
				created_date='".$mysqlnow."', 
				updated_date='".$mysqlnow."' ";
	
	$insertRes=$dbObj->fireQuery($insertQry,"insert");
	
}

function do_cooccuring_wc_job($filename)
{

	file_put_contents("/opt/bitnami/apache2/htdocs/eglass/output/fileprocess.txt", $filename);

	//exec("sh /opt/bitnami/apache2/htdocs/eglass/scripts/mrjob.sh ".$filename);
}

function do_ocr($filename)
{
	$path_upload = "/opt/bitnami/apache2/htdocs/eglass/uploads/";
	$path_output = "/opt/bitnami/apache2/htdocs/eglass/uploads/";
	
	exec("tesseract ".$path_upload.$filename." ".$path_output.$filename);
	
	$ocr_text = trim(file_get_contents($path_output.$filename.".txt"));
	
	return $ocr_text;
}

function do_gtranslate_detect($qrystr)
{
	$api_key="AIzaSyAp20GRBHJ2kV7UjhGxfdPSPzNoQN-npR0";
	
	$qry_url = "https://www.googleapis.com/language/translate/v2/detect?key=".$api_key."&q=".urlencode($qrystr);
	//echo $qry_url;
	$rtn = file_get_contents($qry_url);
	
	return $rtn;
}

function do_gtranslate_translate($lang_src,$lang_dest,$qrystr)
{
	$api_key="AIzaSyAp20GRBHJ2kV7UjhGxfdPSPzNoQN-npR0";
	
	$qry_url = "https://www.googleapis.com/language/translate/v2?key=".$api_key."&source=".$lang_src."&target=".$lang_dest."&q=".urlencode($qrystr);

	$rtn = file_get_contents($qry_url);
	
	return $rtn;
}



function do_qrcode_decode($filename)
{
	$qry_url = "https://api.qrserver.com/v1/read-qr-code/?fileurl=".urlencode(WEBSITE_URL."uploads/".$filename);
	//echo $qry_url;
	$rtn = file_get_contents($qry_url);
	
	return $rtn;
}

function get_default_lang()
{
	global $dbObj;
	
	$settingsQry="select * from settingsconfig where sc_id = 1";
	$settingsRes=$dbObj->fireQuery($settingsQry);
	
	$default_lang="";
	if(isset($settingsRes) && count($settingsRes)>0 && $settingsRes!=false)
	{ 
	$default_lang=get_data($settingsRes[0]['sc_default_lang']); 
	}
	
	return $default_lang;
}

function set_default_lang($default_lang)
{
	global $dbObj;
	
	$updateQry="UPDATE settingsconfig SET sc_default_lang='".$default_lang."' WHERE sc_id = 1 ";
	$updateRes=$dbObj->fireQuery($updateQry,"update");
	
	return "true";
}

function set_location($loc_lat,$loc_long)
{
	global $dbObj;
	
	$updateQry="UPDATE settingsconfig SET sc_glass_lat='".$loc_lat."', sc_glass_long='".$loc_long."' WHERE sc_id = 1 ";
	$updateRes=$dbObj->fireQuery($updateQry,"update");
	
	return "true";
}

function get_glass_location_lat()
{
	global $dbObj;
	
	$settingsQry="select * from settingsconfig where sc_id = 1";
	$settingsRes=$dbObj->fireQuery($settingsQry);
	
	$glass_location_lat="";
	if(isset($settingsRes) && count($settingsRes)>0 && $settingsRes!=false)
	{ 
	$glass_location_lat=get_data($settingsRes[0]['sc_glass_lat']); 
	}
	
	return $glass_location_lat;
}

function get_glass_location_long()
{
	global $dbObj;
	
	$settingsQry="select * from settingsconfig where sc_id = 1";
	$settingsRes=$dbObj->fireQuery($settingsQry);
	
	$glass_location_long="";
	if(isset($settingsRes) && count($settingsRes)>0 && $settingsRes!=false)
	{ 
	$glass_location_long=get_data($settingsRes[0]['sc_glass_long']); 
	}
	
	return $glass_location_long;
}


function cleanData($value)
{
	$value = str_replace('"','',$value);
	return trim(mysql_real_escape_string($value));
}

function cleanData2($value)
{	
	$value = convert_smart_quotes($value);
	$value = preg_replace('/[^(\x20-\x7F)]*/','', $value);
	return trim(mysql_real_escape_string($value));
}

function custom_date_diff_days($date_start,$date_end)
{
	$date_diff = $date_end-$date_start;
	$date_diff_days = floor($date_diff/86400);
	return $date_diff_days;
}

function get_global_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
 
    return $ipaddress;
}

function curl_get_file_contents($URL)
{
	$c = curl_init();
	//curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($c, CURLOPT_URL, $URL);
	$contents = curl_exec($c);
	curl_close($c);
	
	if ($contents) return $contents;
	else return FALSE;
}

?>