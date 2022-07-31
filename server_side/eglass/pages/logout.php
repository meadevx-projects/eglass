<?php
log_activity("Logout Page Viewed");


session_destroy();
if(strlen(HOME_PAGE)>0)
{
header("Location: ".HOME_PAGE."");
}
else
{
header("Location: index.php");
}
exit;
?>
