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

$docr_file="";
if(isset($_GET['docr_file']))
{
	$docr_file=htmlentities($_GET['docr_file']);
}

$cooccuring_data = file_get_contents("/opt/bitnami/apache2/htdocs/eglass/output/".$docr_file.".txt_co");

?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Document Cooccuring Words</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
        	<div class="panel-heading">
                Filename : <?php echo $docr_file; ?>
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
                    <table width="100%" border="0">
                    	    <tr>
                    	      <td>
                                <div align="center" style="border:1px dashed #666666; padding:10px; text-align:left">
                                <?php echo nl2br($cooccuring_data); ?>     
                                </div>    
                              </td>
                  	      </tr>
                          <tr>
                    	      <td>&nbsp;</td>
                          </tr>
                          <tr>
                    	      <td align="center"><button class="btn btn-success" onclick="window.history.back();">Back</button></td>
                          </tr>
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
