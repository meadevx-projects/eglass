<?php

if($_SERVER['SERVER_NAME']!="localhost")
{
	if($_SERVER['SERVER_NAME']=="eglass.arceon.bitnamiapp.com")
	{
		$SITE_MODE="LIVE";
	}
}
else
{
//Site Mode
$SITE_MODE="LOCAL"; 	// LOCAL | DEVTEST | DEV | LIVETEST | LIVE 
//Site Mode END
}
?>