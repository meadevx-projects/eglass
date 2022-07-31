<?php
include_once("../lib/lib.dbConnection.php");
include_once("../config/constants.inc.php");
include_once("../lib/lib.commonFunc.php");
include_once("../lib/lib.sysFunc.php");
include_once("../lib/lib.syslog.php");

$app_set_location_lat = "";
$app_set_location_long = "";
$rtn_set_location = "false";

if(isset($_GET['app_set_location_lat']) && isset($_GET['app_set_location_long']))
{
	$app_set_location_lat = htmlentities($_GET['app_set_location_lat']);	
	$app_set_location_long = htmlentities($_GET['app_set_location_long']);
	$rtn_set_location = set_location($app_set_location_lat,$app_set_location_long);
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
	<locationlat><?php echo $app_set_location_lat; ?></locationlat>
    <locationlong><?php echo $app_set_location_long; ?></locationlong>
    <setlocation><?php echo $rtn_set_location; ?></setlocation>
</eglass>