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


if(isset($_GET['trn_id']))
{
	$trn_id=$_GET['trn_id'];
	
	$translationTasksEachQry="SELECT * FROM translation_tasks WHERE trn_id='".$trn_id."'";
	$translationTasksEachRes=$dbObj->fireQuery($translationTasksEachQry);
}




?>
<style>
.imgtable{
    height:250px;
    width:250px;
}    
img{
    height:auto;
     width:100%;
}
.imgtable td,tr,tbody{
    height:100%;
    height:100%;
}
</style>
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
                            <tbody>
                               <tr>
                                <td><strong>Image Filename:</strong></td>
                                <td><?php echo htmlentities($translationTasksEachRes[0]['trn_imgfile']); ?></td>
                               </tr>
                               <tr>
                                <td><strong>Image:</strong></td>
                                <td><table  border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td><img src="<?php echo $SITE_URL."uploads/".htmlentities($translationTasksEachRes[0]['trn_imgfile']); ?>" alt="<?php echo htmlentities($translationTasksEachRes[0]['trn_imgfile']); ?>"/>
                                        </td>       
                                    </tr>
                                </table>
                                </td>
                               </tr>
                               <tr>
                                <td><strong>OCR Text:</strong></td>
                                <td><?php echo htmlentities($translationTasksEachRes[0]['trn_ocrtext']); ?></td>
                               </tr>
                               <tr>
                                <td><strong>Translated Text:</strong></td>
                                <td><?php echo htmlentities($translationTasksEachRes[0]['trn_transtext']); ?></td>
                               </tr>
                               <tr>
                                 <td colspan="2">&nbsp;</td>
                               </tr>
                               <tr>
                                 <td colspan="2" align="center"><button class="btn btn-success" onclick="window.history.back();">Back</button></td>
                               </tr>
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
