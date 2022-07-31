<?php
// MANEESH ABRAHAM

//error_reporting(E_ALL);

session_start();
//ini_set("display_errors",1);
include_once("lib/lib.dbConnection.php");
include_once("config/constants.inc.php");
include_once("lib/lib.commonFunc.php");
include_once("lib/lib.formValidations.php");
include_once("lib/lib.formFunc.php");
include_once("lib/lib.syslog.php");
include_once("lib/lib.sysFunc.php");

include_once("logincheck.php");

ob_start();

$page="";
$pageRtn=false;
if(isset($_GET['pg']) && strlen($_GET['pg'])>0 )
{
$page=$_GET['pg'];
}
else
{
$page="default";
}



?>
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $sc_site_title; ?></title>

    <!-- Core CSS - Include with every page -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Dashboard -->
    <link href="css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    <link href="css/plugins/timeline/timeline.css" rel="stylesheet">

    <!-- SB Admin CSS - Include with every page -->
    <link href="css/sb-admin.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
    
	<!-- Bootstrap Switch -->
    <link href="css/bootstrap-switch.css" rel="stylesheet">
    
    <!-- Core Scripts - Include with every page -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    
    <script src="js/commonfunc.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="js/sb-admin.js"></script>

	<!-- Bootstrap Switch -->
	<script src="js/bootstrap-switch.js"></script>
    <!--<script type="text/javascript">
    $("[name='my-checkbox']").bootstrapSwitch();
	$('input[name="my-checkbox"]').bootstrapSwitch('size', "large", true);
	$('input[name="my-checkbox"]').bootstrapSwitch('onText', "MANUAL", true);
	$('input[name="my-checkbox"]').bootstrapSwitch('offText', "AUTO", true);
    </script>-->
    
    
    
    <script type="text/javascript" src="js/timepicker/jquery.timepicker.js"></script>
  	<link rel="stylesheet" type="text/css" href="js/timepicker/jquery.timepicker.css" />
    
    
	<script>
    $(function() {
        $('#scheduler_time_start1').timepicker({ 'scrollDefaultNow': true });
		$('#scheduler_time_end1').timepicker({ 'scrollDefaultNow': true });
		$('#scheduler_time_start2').timepicker({ 'scrollDefaultNow': true });
		$('#scheduler_time_end2').timepicker({ 'scrollDefaultNow': true });
		$('#scheduler_time_start3').timepicker({ 'scrollDefaultNow': true });
		$('#scheduler_time_end3').timepicker({ 'scrollDefaultNow': true });
    });
    </script>
    
    <script type="text/javascript" src="js/datepicker/js/bootstrap-datepicker.js"></script>
	<link rel="stylesheet" href="js/datepicker/css/datepicker3.css" type="text/css"/>
    
    
</head>
<body>
<?php
if($page=="login")
{
?>
<!--<div class="container">-->
<?php
	include_once("actions.php");
?>        
<!--</div>-->
<?php
}else{
?>
<div id="wrapper">

    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo HOME_PAGE; ?>?pg=dashboard"><?php echo $sc_site_title; ?></a>
        </div>
        <!-- /.navbar-header -->
        
        
<ul class="nav navbar-top-links navbar-right">
                
                <!-- /.dropdown -->
                
                <!-- /.dropdown -->
                
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        Welcome, <?php echo $_SESSION['username']; ?><i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo HOME_PAGE; ?>?pg=user_profile"><i class="fa fa-user fa-fw"></i>&nbsp;User Profile</a>
                        </li>
                        <li><a href="<?php echo HOME_PAGE; ?>?pg=settings"><i class="fa fa-gear fa-fw"></i>&nbsp;Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo HOME_PAGE; ?>?pg=logout"><i class="fa fa-sign-out fa-fw"></i>&nbsp;Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        <!-- /.navbar-top-links -->

    </nav>
    <!-- /.navbar-static-top -->

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">             
                <li>
                    <a href="<?php echo HOME_PAGE; ?>?pg=dashboard"><i class="fa fa-dashboard fa-fw"></i>&nbsp;Dashboard</a>
                </li>
                <li>
                    <a href="<?php echo HOME_PAGE; ?>?pg=translation_tasks"><i class="fa fa-table fa-fw"></i>&nbsp;Translation Tasks</a>
                </li>
                <li>
                    <a href="<?php echo HOME_PAGE; ?>?pg=docr_tasks"><i class="fa fa-table fa-fw"></i>&nbsp;Document OCR Tasks</a>
                </li>
                <li>
                    <a href="<?php echo HOME_PAGE; ?>?pg=qrcode_tasks"><i class="fa fa-table fa-fw"></i>&nbsp;QRCode Tasks</a>
                </li>
                <li>
                    <a href="<?php echo HOME_PAGE; ?>?pg=wheresmyglass"><i class="fa fa-wrench fa-fw"></i>&nbsp;Where's My Glass</a>
                </li>  
            </ul>
            <!-- /#side-menu -->
        </div>
        <!-- /.sidebar-collapse -->
    </nav>
    <!-- /.navbar-static-side -->

<div id="page-wrapper">
<?php
	include_once("actions.php");
?> 
</div>   
    <!-- /#page-wrapper -->

</div>
    <!-- /#wrapper -->
<?php
}
?>    



</body>

</html>
<?php
ob_flush();
?>