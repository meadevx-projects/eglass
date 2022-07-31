<?php
define("ACCESS_LOG_PATH",$SITE_PATH."syslogs/access_logs/");
define("ACTIVITY_LOG_PATH",$SITE_PATH."syslogs/activity_logs/");
define("INTERFACE_LOG_PATH",$SITE_PATH."syslogs/interface_logs/");




function log_access()
{
	if(LOG_ACCESS==1)
	{
		$accesslogfile=""; 
		
		$today = date("Ymd");
		$todaylogfile="accesslog".$today;
		
		$month=date("Ym");
		$monthdir="accesslog".$month."/";

		if(file_exists(ACCESS_LOG_PATH.$monthdir)==false)
		{
		mkdir(ACCESS_LOG_PATH.$monthdir);
		}
	
		
		$accesslogfile=ACCESS_LOG_PATH.$monthdir.$todaylogfile.".txt";
		
	
		$url=$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		
		if(isset($_SESSION['username']))
		{
		$user=$_SESSION['username'];
		}
		else
		{
		$user="NA";
		}
		
		$ip=$_SERVER['REMOTE_ADDR'];
	
		$date="[" . date("Y/m/d h:i:s A T", time()) . "]";
		
		$accesslogmsg = $date." | ".$user." | ".$ip." | ".$url."\r\n";
		
		error_log($accesslogmsg, 3, $accesslogfile);
		
		
		// $accesslogmsg = $date." | ".$user." | ".$url."\r\n";
		// log_write($accesslogmsg);
	
	}
}







function log_activity($activitymsg)
{
	if(LOG_ACTIVITY==1)
	{
		$activitylogfile=""; 
		
		$today = date("Ymd");
		$todaylogfile="activitylog".$today;
		
		$month=date("Ym");
		$monthdir="activitylog".$month."/";
		
		if(file_exists(ACTIVITY_LOG_PATH.$monthdir)==false)
		{
		mkdir(ACTIVITY_LOG_PATH.$monthdir);
		}	
		
		$activitylogfile=ACTIVITY_LOG_PATH.$monthdir.$todaylogfile.".txt";
		
		$url=$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		
		if(isset($_SESSION['username']))
		{
		$user=$_SESSION['username'];
		}
		else
		{
		$user="NA";
		}
		
		$ip=$_SERVER['REMOTE_ADDR'];
	
		$date="[" . date("Y/m/d h:i:s A T", time()) . "]";
		
		$activitylogmsg = "#-# ".$date." | ".$user." | ".$ip." | ".$url." | ".$activitymsg." #=#\r\n";
		
		error_log($activitylogmsg, 3, $activitylogfile);
		
		
		// $activitylogmsg = "#-# ".$date." | ".$user." | ".$url." | ".$activitymsg." #=#\r\n";
		// log_write($activitylogmsg);
	
	}
}




function log_interface($interfacemsg)
{
	if(LOG_INTERFACE==1)
	{
		$interfacelogfile=""; 
		
		$today = date("Ymd");
		$todaylogfile="interfacelog".$today;
		
		$month=date("Ym");
		$monthdir="interfacelog".$month."/";
		
		if(file_exists(INTERFACE_LOG_PATH.$monthdir)==false)
		{
		mkdir(INTERFACE_LOG_PATH.$monthdir);
		}	
		
		$interfacelogfile=INTERFACE_LOG_PATH.$monthdir.$todaylogfile.".txt";
		
		$url=$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		
		if(isset($_SESSION['username']))
		{
		$user=$_SESSION['username'];
		}
		else
		{
		$user="NA";
		}
		
		$ip=$_SERVER['REMOTE_ADDR'];
	
		$date="[" . date("Y/m/d h:i:s A T", time()) . "]";
		
		$interfacelogmsg = "#-# ".$date." | ".$user." | ".$ip." | ".$url." | ".$interfacemsg." #=#\r\n";
		
		error_log($interfacelogmsg, 3, $interfacelogfile);
		
		
		// $interfacelogmsg = "#-# ".$date." | ".$user." | ".$url." | ".$interfacemsg." #=#\r\n";
		// log_write($interfacelogmsg);
	
	}
}














function log_write($activitymsg)
{
	global $activitylogfile;
	$filename=ACTIVITY_LOG_PATH.$activitylogfile;
	
	$msg=$activitymsg;

	// open file
	$fd = fopen($filename, "a");
	
	// append date/time to message
	$str = "[" . date("Y/m/d h:i:s", time()) . "]	| " . $msg."\r\n";	
	
	// write string
	fwrite($fd, $str . "\n");
	
	// close file
	fclose($fd);
}







?>