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
	$docr_id=$_GET['docr_id'];
	
	$deleteQry="DELETE from docr_tasks WHERE docr_id = '".$docr_id."'";
	
	$deleteRes=$dbObj->fireQuery($deleteQry,'delete');
	
	$_SESSION['successMsg']="Document OCR Task Deleted Successfully";
	log_activity("Document OCR Task Deleted Successfully : Id-".$docr_id."");
	header("Location: ".HOME_PAGE."?pg=docr_tasks");
	exit;
}

$docrTasksQry="SELECT * FROM docr_tasks ORDER BY docr_id ASC";
$docrTasksRes=$dbObj->fireQuery($docrTasksQry);

?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Document OCR Tasks</h1>
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
                                <th>OCR Text</th>
                                <th><img src="images/tagcloud.png" width="20" height="20" /></th>
                                <th><img src="images/cooccuring.png" width="20" height="20" /></th>
                                <th><img src="images/view.png" width="20" height="20" /></th>                        
        						<th><img src="images/delete.png" width="20" height="20" /></th>                                
                              	</tr>
                            </thead>
                            <tbody>
                            <?php
							if(isset($docrTasksRes) && $docrTasksRes!=false && count($docrTasksRes)>0)
							{
								for($k=0;$k<count($docrTasksRes);$k++)
								{
							?>
                              <tr>
                                <td><?php echo $docrTasksRes[$k]['docr_imgfile']; ?></td>
                                <td><?php if(strlen($docrTasksRes[$k]['docr_ocrtext'])>80){
									 echo htmlentities(substr($docrTasksRes[$k]['docr_ocrtext'],0,80))." ..."; }else{ 
									 echo htmlentities($docrTasksRes[$k]['docr_ocrtext']);  } ?></td>
                                <td><a href="?pg=docr_tagcloud&docr_id=<?php echo $docrTasksRes[$k]['docr_id'];?>&docr_file=<?php echo $docrTasksRes[$k]['docr_imgfile'];?>"><img src="images/tagcloud.png" width="20" height="20" /></a></td> 
                                <td><a href="?pg=docr_cooccuring&docr_id=<?php echo $docrTasksRes[$k]['docr_id'];?>&docr_file=<?php echo $docrTasksRes[$k]['docr_imgfile'];?>"><img src="images/cooccuring.png" width="20" height="20" /></a></td>            
                                <td><a href="?pg=docr_tasks_view&docr_id=<?php echo $docrTasksRes[$k]['docr_id'];?>"><img src="images/view.png" width="20" height="20" /></a></td> 
        						<td><a href="?pg=docr_tasks&docr_id=<?php echo $docrTasksRes[$k]['docr_id'];?>&do=delete"><img src="images/delete.png" width="20" height="20" /></a></td>                                  
                              </tr>
							<?php
								}
							}
							else
							{
							?>
                            <tr>
                                <td colspan="6" style="text-align:center">No Data Available</td>                                
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
