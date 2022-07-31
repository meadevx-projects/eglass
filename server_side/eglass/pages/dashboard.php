<?php
$qry="SELECT * FROM pi_track ORDER BY pt_id DESC LIMIT 1";
$res=$dbObj->fireQuery($qry,'select');

$db_ext_ip = "";
$db_int_ip = "";
$db_created_date = "";
$db_updated_date = "";
$pi_status = "offline";
$pi_status_color = "#FC6A6C";

if(isset($res) && count($res)>0 && $res!=false)
{
	$db_ext_ip = $res[0]['pt_ext_ip'];
	$db_int_ip = $res[0]['pt_int_ip'];
	$db_created_date = $res[0]['created_date'];
	$db_updated_date = $res[0]['updated_date'];
	
	$time_diff=(time()-strtotime($db_updated_date))/60;
	
	if($time_diff < 5)
	{
		$pi_status = "online";
		$pi_status_color = "#99CC00";
	}
}

?>
<meta http-equiv="refresh" content="15">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <span style="font-size:18px">Welcome to <?php echo $sc_site_title; ?> Admin Panel</span>
  

    </div>
    <!-- /.col-lg-12 -->
    
</div>
<!-- /.row -->
