<?php




switch($page)
{
case "login":
$pageRtn=include_once("pages/login.php");
break;

case "logout":
$pageRtn=include_once("pages/logout.php");
break;

case "dashboard":
$pageRtn=include_once("pages/dashboard.php");
break;

case "user_profile":
$pageRtn=include_once("pages/user_profile.php");
break;

case "settings":
$pageRtn=include_once("pages/settings.php");
break;

case "translation_tasks":
$pageRtn=include_once("pages/translation_tasks.php");
break;

case "translation_tasks_view":
$pageRtn=include_once("pages/translation_tasks_view.php");
break;

case "docr_tasks":
$pageRtn=include_once("pages/docr_tasks.php");
break;

case "docr_tasks_view":
$pageRtn=include_once("pages/docr_tasks_view.php");
break;

case "docr_cooccuring":
$pageRtn=include_once("pages/docr_cooccuring.php");
break;

case "docr_tagcloud":
$pageRtn=include_once("pages/docr_tagcloud.php");
break;

case "qrcode_tasks":
$pageRtn=include_once("pages/qrcode_tasks.php");
break;

case "qrcode_tasks_view":
$pageRtn=include_once("pages/qrcode_tasks_view.php");
break;

case "wheresmyglass":
$pageRtn=include_once("pages/wheresmyglass.php");
break;

default:
$pageRtn=include_once("pages/404page.php");
break;
}




if($pageRtn==false)
{
include_once("pages/404page.php");
}




?>
