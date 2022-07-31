<?php

define("SITE_NAME","eGlass");

define("SITE_SHORT_NAME","eGlass");

//---------------------------------------------------------------------------------------


//Site Mode
include_once("sitemode.inc.php");
//Site Mode END


//Database Related Constants - Start
switch($SITE_MODE)
{
case "LOCAL":
// http://localhost/xyz/

define("DB_HOST","localhost");
define("DB_USER","root");
define("DB_PASSWORD","rootx");
define("DB_HOST_REPLICA","");
define("DB_USER_REPLICA","");
define("DB_PASSWORD_REPLICA","");
define("DB_NAME","eglass");
break;

case "DEV":
// http://www.xyz.com

define("DB_HOST","localhost");
define("DB_USER","root");
define("DB_PASSWORD","rootx");
define("DB_HOST_REPLICA","");
define("DB_USER_REPLICA","");
define("DB_PASSWORD_REPLICA","");
define("DB_NAME","eglass");
break;

case "LIVE":
// http://esprinkler.1eko.com

define("DB_HOST","localhost");
define("DB_USER","root");
define("DB_PASSWORD","rootx"); //AKRr8O2ZBEKj
define("DB_HOST_REPLICA","");
define("DB_USER_REPLICA","");
define("DB_PASSWORD_REPLICA","");
define("DB_NAME","eglass");
break;


}
//Database Related Constants - End






$dbObj = new dbConnection();

//Config Related Constants - Start
switch($SITE_MODE)
{
case "LOCAL":
// http://localhost/xyz/
error_reporting(E_ALL);

define("SYSPLATFORM","windows"); // windows | linux
date_default_timezone_set("America/Chicago");
$PROTOCOL = "http://";
$SITE_DOMAIN = $_SERVER['SERVER_NAME']."/";
$SITE_FOLDER = "eglass/"; // when goes to live set value to blank Eg. $SITE_FOLDER = "";
$DOC_ROOT = $_SERVER['DOCUMENT_ROOT'];
$SITE_URL = $PROTOCOL.$SITE_DOMAIN.$SITE_FOLDER;
$SITE_PATH = $DOC_ROOT.$SITE_FOLDER;
break;

case "DEV":
// http://www.xyz.com

define("SYSPLATFORM","linux"); // windows | linux
date_default_timezone_set("America/Chicago");
$PROTOCOL = "http://";
$SITE_DOMAIN = $_SERVER['SERVER_NAME']."/";
$SITE_FOLDER = ""; // when goes to live set value to blank Eg. $SITE_FOLDER = "";
$DOC_ROOT = $_SERVER['DOCUMENT_ROOT']."/";
$SITE_URL = $PROTOCOL.$SITE_DOMAIN.$SITE_FOLDER;
$SITE_PATH = $DOC_ROOT.$SITE_FOLDER;
break;

case "LIVE":
// http://www.xyz.com

define("SYSPLATFORM","linux"); // windows | linux
date_default_timezone_set("America/Chicago");
$PROTOCOL = "http://";
$SITE_DOMAIN = $_SERVER['SERVER_NAME']."/";
$SITE_FOLDER = "/"; // when goes to live set value to blank Eg. $SITE_FOLDER = "";
$DOC_ROOT = $_SERVER['DOCUMENT_ROOT'];
$SITE_URL = $PROTOCOL.$SITE_DOMAIN.$SITE_FOLDER;
$SITE_PATH = $DOC_ROOT.$SITE_FOLDER;
break;

}
//Config Related Constants - End



// Site Config - Start

$scQry="select * from settingsconfig where sc_id=1";
$scRes=$dbObj->fireQuery($scQry);

$sc_site_title="";

if(isset($scRes) && count($scRes)>0 && $scRes!=false)
{
	$sc_site_title=$scRes[0]['sc_site_title'];
}

// Site Config - End






// SITE URL AND SITE PATH - Start

define("SITE_URL_CONST",$SITE_URL);

define("WEBSITE_URL",$SITE_URL);
define("WEBSITE_PATH",$SITE_PATH);

// SITE URL AND SITE PATH - End




// Configuration - Start 

define("HOME_PAGE","index.php");
define("RUN_CRON",1); // Turn On/Off Cron
define("LOG_ACCESS",1); // Turn On/Off Access Log
define("LOG_ACTIVITY",1); // Turn On/Off Activity Log

// Configuration - End

//---------------------------------------------------------------------------------------

set_include_path(WEBSITE_PATH."lib/");

//---------------------------------------------------------------------------------------




?>
