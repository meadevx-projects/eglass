<?php

function getCopyright($year)
{
		if($year==date('Y'))
		{
			return $year;
		}
		else
		{
			return $year."-".date('Y');
		}
}







function show_value_in_xml($xmlNodeValue,$type="")
{
	if( isset($xmlNodeValue) && strlen($xmlNodeValue)>0 )
	{
		if($type=="date")
		{
			if(strtotime($xmlNodeValue)>0)
			{
				return date("m/d/Y",strtotime($xmlNodeValue));
			}
			else
			{
				//return '&#160;';
				return '-';
			}		
		}
		else
		{
			return htmlentities(stripslashes($xmlNodeValue));
		}
	}
	else
	{
		//return '&#160;';
		return '-';
	}
}





function display_data($data)
{
	if(strlen($data)>0)
	{
		return stripslashes($data);
	}
	else
	{
		return "&nbsp;";
	}
}


function get_data($data,$predata="")
{
	if(strlen(trim($data))>0)
	{
		return stripslashes($predata.$data);
	}
	else
	{
		return stripslashes($data);		
	}
}


function nojavascript()
{
	if(isset($_GET['pg']) && ($_GET['pg']!="javascript_disabled") )
	{
	echo '<noscript> 
			<meta http-equiv="Refresh" content="0; URL='.HOME_PAGE.'?pg=javascript_disabled";?>" /> 
		  </noscript>';
	}
}


function get_date($tdate,$tdateformat="m/d/Y")
{
	if(strtotime($tdate)>0)
	{ 
		return date($tdateformat,strtotime($tdate)); 
	}
	else
	{
		return "";
	}
}

function remove_specialchars($text)
{

	$code_entities_match = array
	(
	' ',
	'–',
	'"',
	'!',
	'@',
	'#',
	'$',
	'%',
	'^',
	'&',
	'*',
	'(',
	')',
	'_',
	'+',
	'{',
	'}',
	'|',
	':',
	'"',
	'’',
	'?',
	'[',
	']',
	'\\',
	';',
	'‘',
	',',
	'.',
	'/',
	'*',
	'+',
	'~',
	'',
	'=',
	"'",
	'<',
	'>'
	);
	
	$code_entities_replace = array
	(
	' ',
	'-',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',	
	'',
	'',		
	'',
	'',					
	'');
	$text = str_replace($code_entities_match, $code_entities_replace, $text);
	return $text;
}


function remove_specialchars_filename($text)
{

	$code_entities_match = array
	(
	' ',
	'–',
	'"',
	'!',
	'@',
	'#',
	'$',
	'%',
	'^',
	'&',
	'*',
	'(',
	')',
	'_',
	'+',
	'{',
	'}',
	'|',
	':',
	'"',
	'’',
	'?',
	'[',
	']',
	'\\',
	';',
	'‘',
	',',
	'/',
	'*',
	'+',
	'~',
	'',
	'=',
	"'",
	'<',
	'>'
	);
	
	$code_entities_replace = array
	(
	'_',
	'_',
	'_',
	'_',
	'_',
	'_',
	'_',
	'_',
	'_',
	'_',
	'_',
	'_',
	'_',
	'_',
	'_',
	'_',
	'_',
	'_',
	'_',
	'_',
	'_',
	'_',
	'_',
	'_',
	'_',
	'_',
	'_',
	'_',
	'_',
	'_',
	'_',
	'_',
	'_',	
	'_',
	'_',		
	'_',					
	'_');
	$text = str_replace($code_entities_match, $code_entities_replace, $text);
	return $text;
}



function drawCell($value,$height='')
{
return '<table width="100%" height="100%" border="1" cellspacing="0" cellpadding="1">
		<tr>
			<td height='.$height.'> 
			'.$value.'
			</td>
		</tr>
	   </table>';

}



function mynl2br($text) {
  return strtr($text, array("\\r\\n" => '<br />', "\r\n" => '<br />', "\r" => '<br />', "\n" => '<br />'));
} 


function get_field_name($field) {
  return str_replace(" ", "_", $field);
}


function subval_sort($a,$subkey,$sorttype="asc") {
	foreach($a as $k=>$v) {
		$b[$k] = strtolower($v[$subkey]);
	}
	
	if($sorttype=="asc")
	{
		asort($b);
	}
	else
	{
		arsort($b);
	}
	
	
	foreach($b as $key=>$val) {
		$c[] = $a[$key];
	}
	return $c;
}



function gmap_load_unload()
{
	if(isset($_GET['pg']) && strlen($_GET['pg'])>0 && ($_GET['pg']=="map_search"))
	{
		echo 'onload="load()" onunload="GUnload()"';
	}
}

function get_gmap_geocode($gaddress)
{
	log_activity("get_gmap_geocode() Called.");
	
	$gmap_geocode_val="404"; // 404 - Url could not be loaded

	$base_url = "http://".GMAPS_HOST."/maps/geo?output=xml&key=".GMAP_KEY;

	$request_url = $base_url."&q=".urlencode($gaddress);
	$xml = @simplexml_load_file($request_url) or log_activity("get_gmap_geocode() - url not loading : ".$request_url);


	if(isset($xml) && ($xml!==FALSE))
	{
		$status = $xml->Response->Status->code;
		
		if(strcmp($status, "200") == 0)
		{
		
		  // Successful geocode
		  $geocode_pending = false;
		  $coordinates = $xml->Response->Placemark->Point->coordinates;
		  $coordinatesSplit = split(",", $coordinates);
		  // Format: Longitude, Latitude, Altitude
		  $lat = $coordinatesSplit[1];
		  $lng = $coordinatesSplit[0];
		  
		  log_activity("get_gmap_geocode() - Location : ".$gaddress." - Lat : ".$lat.", Lng : ".$lng);
		  
		  $gmap_geocode_val=$status."#".$lat."#".$lng;
		} 
		else if (strcmp($status, "620") == 0) 
		{
	
		  log_activity("get_gmap_geocode() - Location : ".$gaddress." - Sent geocode too fast");
		  
		   $gmap_geocode_val=$status;
		} 
		else 
		{
		  // failure to geocode
		  $geocode_pending = false;
		  
		  log_activity("get_gmap_geocode() - Location : ".$gaddress." failed to geocoded. ");
		  log_activity("get_gmap_geocode() - Received status : ".$status);
		  
		  $gmap_geocode_val=$status;
		  
		}
		
	}
	
	return $gmap_geocode_val;
}


function createYears($start_year, $end_year, $id='year_select', $selected=null)
{

       
        $selected = is_null($selected) ? date('Y') : $selected;

        $r = range($start_year, $end_year);

        $select = '<select name="'.$id.'" id="'.$id.'" class="common_select" style="width:auto;">';
		$select .= "<option value=''>Select Year</option>";
        foreach( $r as $year )
        {
            $select .= "<option value=\"$year\"";
            $select .= ($year==$selected) ? ' selected="selected"' : '';
            $select .= ">$year</option>\n";
        }
        $select .= '</select>';
        return $select;
}

   
function createMonths($id='month_select', $selected=null)
{
       
        $months = array(
                1=>'January',
                2=>'February',
                3=>'March',
                4=>'April',
                5=>'May',
                6=>'June',
                7=>'July',
                8=>'August',
                9=>'September',
                10=>'October',
                11=>'November',
                12=>'December');

        
        $selected = is_null($selected) ? date('m') : $selected;

        $select = '<select name="'.$id.'" id="'.$id.'" class="common_select" style="width:auto;">'."\n";
		$select .= "<option value=''>Select Month</option>";
        foreach($months as $key=>$mon)
        {
            $key = str_pad($key,2,"0",STR_PAD_LEFT);
			$select .= "<option value=\"$key\"";
            $select .= (str_pad($key,2,"0",STR_PAD_LEFT)==$selected) ? ' selected="selected"' : '';
            $select .= ">$mon</option>\n";
        }
        $select .= '</select>';
        return $select;
}

function translate_month($month_int, $abbr=false) 
{
	$months_array = array();
	if($abbr && $month_int!='00'){

		$months_array = array(  '01' => 'Jan',
								'02' => 'Feb',
								'03' => 'Mar',
								'04' => 'Apr',
								'05' => 'May',
								'06' => 'June',
								'07' => 'July',
								'08' => 'Aug',
								'09' => 'Sep',
								'10'=> 'Oct',
								'11'=> 'Nov',
								'12' => 'Dec');
							
	}
	elseif($month_int!='00') {
	
		$months_array = array(  '01' => 'January',
								'02' => 'February',
								'03' => 'March',
								'04' => 'April',
								'05' => 'May',
								'06' => 'June',
								'07' => 'July',
								'08' => 'August',
								'09' => 'September',
								'10'=> 'October',
								'11'=> 'November',
								'12' => 'December');
							
	}						
							
	if($month_int!='00')
		return $months_array[$month_int];

}
   
function createDays($id='day_select', $selected=null)
{
        
        $r = range(1, 31);

        $selected = is_null($selected) ? date('d') : $selected;

        $select = "<select name='".$id."' id='".$id."' class='common_select' style='width:auto;'>\n";
		$select .= "<option value=''>Select Day</option>";
        foreach ($r as $day)
        {
            $day = str_pad($day,2,"0",STR_PAD_LEFT);
			$select .= "<option value=\"$day\"";
            $select .= ($day==$selected) ? ' selected="selected"' : '';
            $select .= ">$day</option>\n";
        }
        $select .= '</select>';
        return $select;
}




function assign_rand_value($num)
{
// accepts 1 - 36
  switch($num)
  {
    case "1":
     $rand_value = "a";
    break;
	
    case "2":
     $rand_value = "b";
    break;
	
    case "3":
     $rand_value = "c";
    break;
	
    case "4":
     $rand_value = "d";
    break;
	
    case "5":
     $rand_value = "e";
    break;
	
    case "6":
     $rand_value = "f";
    break;
	
    case "7":
     $rand_value = "g";
    break;
	
    case "8":
     $rand_value = "h";
    break;
	
    case "9":
     $rand_value = "i";
    break;
	
    case "10":
     $rand_value = "j";
    break;
	
    case "11":
     $rand_value = "k";
    break;
	
    case "12":
     $rand_value = "l";
    break;
	
    case "13":
     $rand_value = "m";
    break;
	
    case "14":
     $rand_value = "n";
    break;
	
    case "15":
     $rand_value = "o";
    break;
	
    case "16":
     $rand_value = "p";
    break;
	
    case "17":
     $rand_value = "q";
    break;
	
    case "18":
     $rand_value = "r";
    break;
	
    case "19":
     $rand_value = "s";
    break;
	
    case "20":
     $rand_value = "t";
    break;
	
    case "21":
     $rand_value = "u";
    break;
	
    case "22":
     $rand_value = "v";
    break;
	
    case "23":
     $rand_value = "w";
    break;
	
    case "24":
     $rand_value = "x";
    break;
	
    case "25":
     $rand_value = "y";
    break;
	
    case "26":
     $rand_value = "z";
    break;
	
    case "27":
     $rand_value = "0";
    break;
	
    case "28":
     $rand_value = "1";
    break;
	
    case "29":
     $rand_value = "2";
    break;
	
    case "30":
     $rand_value = "3";
    break;
	
    case "31":
     $rand_value = "4";
    break;
	
    case "32":
     $rand_value = "5";
    break;
	
    case "33":
     $rand_value = "6";
    break;
	
    case "34":
     $rand_value = "7";
    break;
	
    case "35":
     $rand_value = "8";
    break;
	
    case "36":
     $rand_value = "9";
    break;
  }
return $rand_value;
}


function get_rand_id($length)
{
  	if($length>0) 
  	{ 
		$rand_id="";
		for($i=1; $i<=$length; $i++)
		{
			mt_srand((double)microtime() * 1000000);
			$num = mt_rand(1,36);
			$rand_id .= assign_rand_value($num);
		}
  	}
return $rand_id;
}





function is_date($val,$tdateformat="m/d/Y")
{

	if(strtotime($val)>0)
	{ 
		return date($tdateformat,strtotime($val)); 
	}
	else if($val=="0000-00-00 00:00:00")
	{
		return "";
	}
	else
	{
		return $val;
	}

}

function formatMoney($number)
{
    if (strlen($number) == 0) { $number = 0; }
    $number = str_replace(",","",$number);
    $number = str_replace("$","",$number);
    return '$' . number_format($number,2);
}

define('GLOB_NODIR',256);
define('GLOB_PATH',512);
define('GLOB_NODOTS',1024);
define('GLOB_RECURSE',2048);

function safe_glob($pattern, $flags=0) {
    $split=explode('/',str_replace('\\','/',$pattern));
    $mask=array_pop($split);
    $path=implode('/',$split);
    if (($dir=opendir($path))!==false) {
        $glob=array();
        while(($file=readdir($dir))!==false) {
            // Recurse subdirectories (GLOB_RECURSE)
            if( ($flags&GLOB_RECURSE) && is_dir($file) && (!in_array($file,array('.','..'))) )
                $glob = array_merge($glob, array_prepend(safe_glob($path.'/'.$file.'/'.$mask, $flags),
                    ($flags&GLOB_PATH?'':$file.'/')));
            // Match file mask
            if (fnmatch($mask,$file)) {
                if ( ( (!($flags&GLOB_ONLYDIR)) || is_dir("$path/$file") )
                  && ( (!($flags&GLOB_NODIR)) || (!is_dir($path.'/'.$file)) )
                  && ( (!($flags&GLOB_NODOTS)) || (!in_array($file,array('.','..'))) ) )
                    $glob[] = ($flags&GLOB_PATH?$path.'/':'') . $file . ($flags&GLOB_MARK?'/':'');
            }
        }
        closedir($dir);
        if (!($flags&GLOB_NOSORT)) sort($glob);
        return $glob;
    } else {
        return false;
    }   
}

//******************************  ACCESS LOG ******************************/

function setlogintime()
{
    global $dbObj;
    session_regenerate_id();
	$mysqlnow=date('Y-m-d H:i:s');
	
	$insaccess = "INSERT INTO accesslog 
						(
                                                        sessionId,
							userId,
							userName,
							userType,
							timeLoggedIn,
                                                        timeLastActive,
							ipAddress,
							isLogin
						)
						VALUES
						(
                                                        '".session_id()."',
							'".$_SESSION["userId"]."',
							'".$_SESSION["username"]."',
							'".$_SESSION['usertype']."',
							'".$mysqlnow."',
                                                        '".$mysqlnow."',
							'".$_SERVER['REMOTE_ADDR']."',
							'1'
						)
					   ";
        //echo $insaccess;die;
	$resaccess = $dbObj->fireQuery($insaccess,"insert");
	$_SESSION["accessLogId"] = $resaccess;
	
}

function setlogouttime()
{
	if(isset($_SESSION["userId"]) && $_SESSION["userId"] != "")
	{
	
		global $dbObj;
	    
		$mysqlnow=date('Y-m-d H:i:s');
		
		$upd = "UPDATE accesslog SET timeLoggedOut = '".$mysqlnow."' ,
		     islogin = 0 
			 WHERE userId = '".$_SESSION["userId"]."' 
			 AND accessLogId = '".$_SESSION["accessLogId"]."'
		   ";
		$resupd = $dbObj->fireQuery($upd,"update");
		
		$sel = "SELECT timeLoggedIn,timeLoggedOut,TIMEDIFF(`timeLoggedOut`,`timeLoggedIn`) AS totTime
 FROM accesslog WHERE userId = '".$_SESSION["userId"]."' AND accessLogId = '".$_SESSION["accessLogId"]."'
				";
		$ressel = $dbObj->fireQuery($sel);
		
		$totaltime = $ressel[0]['totTime'];
		
		$updttime = "UPDATE accesslog 
						  SET totalTime = '".$totaltime."' 
						  WHERE userId = '".$_SESSION["userId"]."' 
						  AND accessLogId = '".$_SESSION["accessLogId"]."'
						 ";
		$dbObj->fireQuery($updttime,"update");
	}
}

function updateLastActiveTime()
{
    if(isset($_SESSION["userId"]) && $_SESSION["userId"] != "")
    {
        global $dbObj;
        $mysqlnow=date('Y-m-d H:i:s');
        $upd = "UPDATE accesslog SET timeLastActive = '".$mysqlnow."' 
			 WHERE userId = '".$_SESSION["userId"]."'
			 AND accessLogId = '".$_SESSION["accessLogId"]."'";
        $resupd = $dbObj->fireQuery($upd,"update");
    }
}
//******************************  ACCESS LOG ******************************/





function write_to_file($filename,$str)
{
	// open file
	$fd = fopen($filename, "a");
	
	// write string
	fwrite($fd, $str . "\n");
	
	// close file
	fclose($fd);
}


function encrypt_keyenc($string, $key) {
	$result = '';
	for($i=0; $i<strlen($string); $i++) {
	$char = substr($string, $i, 1);
	$keychar = substr($key, ($i % strlen($key))-1, 1);
	$char = chr(ord($char)+ord($keychar));
	$result.=$char;
	}
	
	return base64_encode($result);
}

function decrypt_keyenc($string, $key) {
	$result = '';
	$string = base64_decode($string);
	
	for($i=0; $i<strlen($string); $i++) {
	$char = substr($string, $i, 1);
	$keychar = substr($key, ($i % strlen($key))-1, 1);
	$char = chr(ord($char)-ord($keychar));
	$result.=$char;
	}
	
	return $result;
}




?>
