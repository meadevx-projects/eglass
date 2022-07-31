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

$cooccuring_data = file_get_contents("/opt/bitnami/apache2/htdocs/eglass/output/".$docr_file.".txt_wc");

$coMainArr=array();
$coRangeArr=array();
$codataArr = explode("\n",$cooccuring_data);
for($k=0;$k<count($codataArr)-1;$k++)
{
	$wcArr = explode(",",$codataArr[$k]);
	if($wcArr[1]!=NULL)
	{
	array_push($coRangeArr,$wcArr[1]);
	}
}

$val_min = min($coRangeArr);
$val_max = max($coRangeArr);

function getTagWeight($min,$max,$count)
{
	$range0=$min;
	$range1=$max/4;
	$range2=$range1+$range1;
	$range3=$range2+$range1;
	$range4=$range3+$range1;
	
	//echo "min-".$min; echo "<br/>";
	//echo "max-".$max; echo "<br/>";
	//echo "count-".$count; echo "<br/>";
	//echo "R0-".$range0; echo "<br/>";
	//echo "R1-".$range1; echo "<br/>";
	//echo "R2-".$range2; echo "<br/>";
	//echo "R3-".$range3; echo "<br/>";
	//echo "R4-".$range4; echo "<br/>";
	
	if($count>=$range0 && $count<=$range1)
	{
		return "small";
	}
	elseif($count>=$range1 && $count<=$range2)
	{
		return "medium";
	}
	elseif($count>=$range2 && $count<=$range3)
	{
		return "large";
	}
	elseif($count>=$range3 && $count<=$range4)
	{
		return "huge";
	}
	
}

?>
<script src="js/tagcloud/jquery.tagcanvas.min.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function() {
	if(!$('#myCanvas').tagcanvas({
	  textColour: '#445569',
	  outlineColour: '#000000',
	  reverse: true,
	  depth: 0.8,
	  maxSpeed: 0.05,
	  weight: true
	},'tags')) {
	  // something went wrong, hide the canvas container
	  $('#myCanvasContainer').hide();
	}
  });
</script>
<style type="text/css">
<!--

ul.weighted {
 float: left;
 display: block;
 overflow: auto;
 padding: 20px;
 margin: 0 10px 20px 0;
 background-color: #fff;
 border: 4px solid #aaa;
 border-radius: 20px;
 -moz-border-radius: 20px;
}
ul.weighted li { display: inline }
ul.weighted li a { margin: 2px }
.centred p { width: 320px; float: left; margin-left: 20px }
.preright { float: left }
.huge { font-family: Impact,sans-serif; font-size: 56px }
.large { font-family: 'Arial Black',sans-serif; font-size: 40px }
.medium { font-family: Verdana,sans-serif; font-size: 18px }
.small { font-family: Georgia,sans-serif; font-size: 11px }
a.red { color: #f00 }
a.green { color: #0c0 }
a.purple { color: #f09 }

-->
</style>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Document TagCloud Visualization</h1>
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
                              <div align="center" style="border:1px dashed #666666">
                          <div id="myCanvasContainer">
                              <canvas width="300" height="300" id="myCanvas">
                                <p>Anything in here will be replaced on browsers that support the canvas element</p>
                              </canvas>
                            </div>
                            <div id="tags">
                                <ul class="weighted" style="font-size: 50%" id="weightTags">
                                <?php
								for($k=0;$k<count($codataArr)-1;$k++)
								{
									$wcArr = explode(",",$codataArr[$k]);
								?>
                                <li><a href="#" class="<?php echo getTagWeight($val_min,$val_max,$wcArr[1]); ?>"><?php echo $wcArr[0]; ?></a></li>
                                <?php
								}
								?>
                                </ul>
                            </div>  
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
