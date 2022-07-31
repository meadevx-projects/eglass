<?php
include_once("../lib/lib.dbConnection.php");
include_once("../config/constants.inc.php");
include_once("../lib/lib.commonFunc.php");
include_once("../lib/lib.sysFunc.php");
include_once("../lib/lib.syslog.php");

$app_set_default_lang = "";
$rtn_set_default_lang = "false";

if(isset($_GET['app_set_default_lang']) && isset($_GET['app_set_default_lang']))
{
	$app_set_default_lang = htmlentities($_GET['app_set_default_lang']);	
	$rtn_set_default_lang = set_default_lang($app_set_default_lang);
}

if(strpos($_SERVER['HTTP_USER_AGENT'],"MSIE")>0){
	header("Cache-Control: private, max-age=0");
	header("Expires: -1"); 
}else{
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
}
header("Content-Type: text/xml; charset=UTF-8");

echo "<?xml version='1.0' encoding='UTF-8'?>\r\n";

?>
<eglass>
	<defaultlang><?php echo $app_set_default_lang; ?></defaultlang>
    <setdefaultlang><?php echo $rtn_set_default_lang; ?></setdefaultlang>
</eglass>