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
	$trn_id=$_GET['trn_id'];
	
	$deleteQry="DELETE from translation_tasks WHERE trn_id = '".$trn_id."'";
	
	$deleteRes=$dbObj->fireQuery($deleteQry,'delete');
	
	$_SESSION['successMsg']="Translation Task Deleted Successfully";
	log_activity("Translation Task Deleted Successfully : Id-".$trn_id."");
	header("Location: ".HOME_PAGE."?pg=translation_tasks");
	exit;
}

$translationTasksQry="SELECT * FROM translation_tasks ORDER BY trn_id ASC";
$translationTasksRes=$dbObj->fireQuery($translationTasksQry);


?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Translation Tasks</h1>
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
                                <th>Translated Text</th>
                                <th><img src="images/view.png" width="20" height="20" /></th> 
        						<th><img src="images/delete.png" width="20" height="20" /></th>                                
                              	</tr>
                            </thead>
                            <tbody>
                            <?php
							if(isset($translationTasksRes) && $translationTasksRes!=false && count($translationTasksRes)>0)
							{
								for($k=0;$k<count($translationTasksRes);$k++)
								{
							?>
                              <tr>
                                <td><?php echo $translationTasksRes[$k]['trn_imgfile']; ?></td>
                                <td><?php if(strlen($translationTasksRes[$k]['trn_ocrtext'])>80){
									 echo htmlentities(substr($translationTasksRes[$k]['trn_ocrtext'],0,80))." ..."; }else{ 
									 echo htmlentities($translationTasksRes[$k]['trn_ocrtext']);  } ?></td>
                                <td><?php if(strlen($translationTasksRes[$k]['trn_transtext'])>80){
									 echo htmlentities(substr($translationTasksRes[$k]['trn_transtext'],0,80))." ..."; }else{ 
									 echo htmlentities($translationTasksRes[$k]['trn_transtext']);  } ?></td>
                                <td><a href="?pg=translation_tasks_view&trn_id=<?php echo $translationTasksRes[$k]['trn_id'];?>"><img src="images/view.png" width="20" height="20" /></a></td> 
        						<td><a href="?pg=translation_tasks&trn_id=<?php echo $translationTasksRes[$k]['trn_id'];?>&do=delete"><img src="images/delete.png" width="20" height="20" /></a></td>                                  
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
