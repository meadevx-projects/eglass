<?php
// Access Rights - Start
$_SESSION['pageaccesstype']="superadmin#admin#agent";
// Access Rights - End

include_once("lib/lib.dbConnection.php");
include_once("config/constants.inc.php");
include_once("lib/lib.commonFunc.php");
include_once("lib/lib.sysFunc.php");
include_once("lib/lib.syslog.php");

$errorMsg=""; // Clear Error Msg

// Permanent Delete
if( (isset($_GET['do']) && strlen($_GET['do'])>0 && ($_GET['do']=="delete")) )
{
	$qrc_id=$_GET['qrc_id'];
	
	$deleteQry="DELETE from qrcode_tasks WHERE qrc_id = '".$qrc_id."'";
	
	$deleteRes=$dbObj->fireQuery($deleteQry,'delete');
	
	$_SESSION['successMsg']="QRCode Task Deleted Successfully";
	log_activity("QRCode Task Deleted Successfully : Id-".$qrc_id."");
	header("Location: ".HOME_PAGE."?pg=qrcode_tasks");
	exit;
}

$qrcodeTasksQry="SELECT * FROM qrcode_tasks ORDER BY qrc_id ASC";
$qrcodeTasksRes=$dbObj->fireQuery($qrcodeTasksQry);


?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">QRCode Tasks</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
        	<div class="panel-heading">
                
            </div>
            <div class="panel-body">
                <div class="row">
                	<div id="msgdiv">
                    <p>
                    <?php if(isset($errorMsg) && strlen($errorMsg)>0 ) { ?>
                    <div align="center" class="errorMsg"><strong><?php echo $errorMsg; ?></strong></div>
                    <?php } else if(isset($_SESSION['successMsg']) && strlen($_SESSION['successMsg'])>0 ) { ?>
                    <div align="center" class="successMsg"><strong><?php echo $_SESSION['successMsg']; ?></strong></div>
                    <?php } ?>
                    </p>
                    </div>
                    <div class="col-lg-12">
                            <table class="table table-striped table-bordered table-hover" style="margin-bottom:0px;">
                            <thead>
                                <tr>
                                <th>Image Filename</th>
                                <th>Decoded Text</th>
                                <th><img src="images/view.png" width="20" height="20" /></th> 
        						<th><img src="images/delete.png" width="20" height="20" /></th>                                
                              	</tr>
                            </thead>
                            <tbody>
                            <?php
							if(isset($qrcodeTasksRes) && $qrcodeTasksRes!=false && count($qrcodeTasksRes)>0)
							{
								for($k=0;$k<count($qrcodeTasksRes);$k++)
								{
							?>
                              <tr>
                                <td><?php echo $qrcodeTasksRes[$k]['qrc_imgfile']; ?></td>
                                <td><?php if(strlen($qrcodeTasksRes[$k]['qrc_decoded'])>80){
									 echo htmlentities(substr($qrcodeTasksRes[$k]['qrc_decoded'],0,80))." ..."; }else{ 
									 echo htmlentities($qrcodeTasksRes[$k]['qrc_decoded']);  } ?></td>
                                <td><a href="?pg=qrcode_tasks_view&qrc_id=<?php echo $qrcodeTasksRes[$k]['qrc_id'];?>"><img src="images/view.png" width="20" height="20" /></a></td> 
        						<td><a href="?pg=qrcode_tasks&qrc_id=<?php echo $qrcodeTasksRes[$k]['qrc_id'];?>&do=delete"><img src="images/delete.png" width="20" height="20" /></a></td>                                  
                              </tr>
							<?php
								}
							}
							else
							{
							?>
                            <tr>
                                <td colspan="5" style="text-align:center">No Data Available</td>                                
                             </tr>
                            <?php
							}
							?>
                              </tbody>
                          </table> 
                    </div>
                    <!-- /.col-lg-12 (nested) -->
                    
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<?php
// Clear Success Msg
$_SESSION['successMsg']="";
?>
